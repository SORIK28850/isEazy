<?php

namespace App\Application\Forms;

use App\Domain\Entity\FizzBuzz;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormError;

/**
 * Class FizzBuzzType
 * @package App\Application\Forms
 */
class FizzBuzzType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * 
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numberStart')
            ->add('numberEnd')

        ;

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();

            if (abs($data->getNumberStart() - $data->getNumberEnd()) >= 50) {
                $form = $event->getForm();
                $form->addError(new FormError('La diferencia no puede ser mayor de 50 o igual entre los dos parámetros'));

            }

            if ($data->getNumberStart() >= $data->getNumberEnd()) {
                $form = $event->getForm();
                $form->addError(new FormError('El número de inicio no puede ser mayor o igual que el número final'));
            }

        });

    }

    /**
     * @param OptionsResolver $resolver
     * 
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FizzBuzz::class,
            
        ]);

    }

}