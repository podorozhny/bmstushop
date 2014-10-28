<?php

namespace Podorozhny\CoreBundle\Controller\Frontend;

use Podorozhny\CoreBundle\Controller\AbstractController;
use Podorozhny\CoreBundle\Event\Frontend\FilterUserResponseEvent;
use Podorozhny\CoreBundle\Event\Frontend\GetResponseUserEvent;
use Podorozhny\CoreBundle\Event\Frontend\UserEvent;
use Podorozhny\CoreBundle\Event\Frontend\UserEvents;
use Podorozhny\CoreBundle\Form\Factory\FactoryInterface;
use Podorozhny\Manager\Frontend\UserManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RegistrationController extends AbstractController {
    private $formFactory;
    private $userManager;

    public function __construct(FactoryInterface $formFactory, UserManager $userManager) {
        $this->formFactory = $formFactory;
        $this->userManager = $userManager;
    }

    public function registerAction(Request $request) {
        $user = $this->userManager->create();

        $event = new GetResponseUserEvent($user, $request);
        $this->dispatcher->dispatch(UserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new GetResponseUserEvent($user, $request);
            $this->dispatcher->dispatch(UserEvents::REGISTRATION_SUCCESS, $event);

            $this->userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url      = $this->generateUrl('shop_product_category_list');
                $response = new RedirectResponse($url);
            }

            $this->dispatcher->dispatch(UserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('CoreBundle:Frontend/Registration:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function confirmAction(Request $request, $token) {
        $user = $this->userManager->findByConfirmationToken($token);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with confirmation token "%s" does not exist', $token));
        }

        if (!$user->isConfirmationNonExpired()) {
            $user->deleteConfirmation();
            throw new NotFoundHttpException(sprintf('Confirmation token "%s" has expired', $token));
        }

        $user->deleteConfirmation();

        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $this->dispatcher->dispatch(UserEvents::REGISTRATION_CONFIRM, $event);

        $this->userManager->update($user);

        if (null === $response = $event->getResponse()) {
            $url      = $this->generateUrl('shop_product_category_list');
            $response = new RedirectResponse($url);
        }

        $this->dispatcher->dispatch(UserEvents::REGISTRATION_CONFIRMED, new FilterUserResponseEvent($user, $request, $response));

        return $response;
    }
}