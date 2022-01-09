<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, [
                'label'=>'Votre nom',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre nom'
                ]
            ])
            ->add('last_name',TextType::class, [
                'label'=>'Votre prénom',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre prénom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label'=>'Votre email',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre email'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type'=>PasswordType::class,
                'invalid_message'=>'Le mot de passe et la confirmation doivent être identiques.',
                'label'=>'Votre mot de passe',
                'required'=>true,
                'first_options'=>['label'=>'Mot de passe',
                    'attr'=>[
                        'placeholder'=>'Votre mot de passe'
                    ]],
                'second_options'=>['label'=>'Confirmer votre mot de passe',
                    'attr'=>[
                        'placeholder'=>'Confirmer le mot de passe'
                    ]],
            ])
            ->add('submit',SubmitType::class, [
                'label'=>"S'incrire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}