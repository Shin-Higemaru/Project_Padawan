<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('email',TextType::class,['label'=>'Votre email *','attr'=>['class'=>'form-control']])
            ->add('email',TextType::class,['label'=>'Votre email :','attr'=>['class'=>'form-control mb-3']])
            ->add('prenom',TextType::class,['label'=>'Votre prenom :','attr'=>['class'=>'form-control mb-3']])
            ->add('nom',TextType::class,['label'=>'Votre nom :','attr'=>['class'=>'form-control mb-3']])
            ->add('bio',TextareaType::class,['label'=>'Quelques mots sur vous :','attr'=>['class'=>'form-control mb-3']])
            ->add('github',TextType::class,['label'=>'Votre pseudo github :','attr'=>['class'=>'form-control mb-3']])
            ->add('plainPassword', PasswordType::class, ['label'=>'Votre mot de passe :',
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr'=>['class'=>'form-control mb-3']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
