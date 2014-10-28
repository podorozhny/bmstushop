<?php

namespace Podorozhny\CoreBundle\Form\Type\Support;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ContactFormType extends AbstractType {
    private $class;

    public function __construct($class) {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('firstname', 'text', [
            'label' => 'contact.label.firstname',
            'attr'  => ['placeholder' => 'Firstname'],
        ])
                ->add('lastname', 'text', [
                    'label' => 'contact.label.lastname',
                    'attr'  => ['placeholder' => 'Lastname'],
                ])
                ->add('email', 'email', [
                    'label' => 'contact.label.email',
                    'attr'  => ['placeholder' => 'E-mail'],
                ])
                ->add('subject', 'entity', [
                    'class'         => 'Podorozhny\Model\Support\ContactSubject',
                    'property'      => 'name',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                  ->orderBy('u.id', 'ASC');
                    },
                ])
                ->add('message', 'textarea', [
                    'label' => 'contact.label.message',
                    'attr'  => ['placeholder' => 'Let us know how we can assist', 'rows' => 4],
                ])
                ->add('submit', 'submit', [
                    'label' => 'Submit',
                ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults([
            'data_class'         => $this->class,
            'cascade_validation' => true,
            'csrf_protection'    => true,
            'csrf_field_name'    => 'csrf_token',
        ]);
    }

    public function getName() {
        return 'support_contact_form_type';
    }
}