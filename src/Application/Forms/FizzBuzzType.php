<?php

namespace App\Application\Forms;

use App\Domain\Entity\FizzBuzz;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormError;

class FizzBuzzType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numberStart')
            ->add('numberEnd')
        ;

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();

            if (abs($data->getNumberStart()- $data->getNumberEnd()) >= 50) {
                $form = $event->getForm();
                $form->addError(new FormError('La diferencia no puede ser mayor de 50 o igual entre los dos parámetros'));
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FizzBuzz::class,
        ]);
    }

}