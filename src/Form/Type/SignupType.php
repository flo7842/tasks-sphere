<?php

namespace App\Form\Type;

use App\Entity\Project;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'placeholder' => "Nom d'utilisateur"
                ],
                'required' => true,
                'label' => "Nom d'utilisateur",
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => [
                    'attr' => [
                        'placeholder' => 'Mot de passe'
                    ],
                    'label' => "Mot de passe",
                ],
                'second_options' => [
                    'attr' => [
                        'placeholder' => 'Confirmez votre mot de passe'
                    ],
                    'label' => "Confirmez votre mot de passe",
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-lg btn-primary w-100'
                ],
                'label' => "S'inscrire"
            ])
            // ->add('projects', EntityType::class, [
            //     'class' => Project::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            // ->add('selectedProject', EntityType::class, [
            //     'class' => Project::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
