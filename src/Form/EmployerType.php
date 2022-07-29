<?php

namespace App\Form;

use App\Entity\Employer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EmployerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],

            ])
            ->add('nom', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],

            ])
            ->add('telephone', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],

            ])
            ->add('email', EmailType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],

            ])
            ->add('adresse', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],

            ])
            ->add('poste', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],

            ])
            ->add('salaire', NumberType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],

            ])
            ->add('dateDeNaissance', DateType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],

            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'label' => 'Ajouter',
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employer::class,
        ]);
    }
}
