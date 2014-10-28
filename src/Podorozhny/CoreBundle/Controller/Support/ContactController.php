<?php

namespace Podorozhny\CoreBundle\Controller\Support;

use Podorozhny\CoreBundle\Controller\AbstractController;
use Podorozhny\CoreBundle\Event\Support\FilterContactResponseEvent;
use Podorozhny\CoreBundle\Event\Support\ContactEvents;
use Podorozhny\CoreBundle\Form\Factory\FactoryInterface;
use Podorozhny\Manager\Support\ContactManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController {
    private $formFactory;
    private $contactManager;

    public function __construct(FactoryInterface $formFactory, ContactManager $contactManager) {
        $this->formFactory    = $formFactory;
        $this->contactManager = $contactManager;
    }

    public function newAction() {
        $contact = $this->contactManager->create();
        $form    = $this->formFactory->createForm();

        return $this->render('CoreBundle:Support/Contact:new.html.twig', [
            'contact' => $contact,
            'form'    => $form->createView(),
        ]);
    }

    public function createAction(Request $request) {
        $contact = $this->contactManager->create();

        $form = $this->formFactory->createForm();
        $form->setData($contact);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->contactManager->update($contact);

            $url      = $this->generateUrl('shop_product_category_list');
            $response = new RedirectResponse($url);

            $this->dispatcher->dispatch(ContactEvents::CREATED, new FilterContactResponseEvent($contact, $request, $response));

            return $response;
        }

        return $this->render('CoreBundle:Support/Contact:new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}