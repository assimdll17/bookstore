<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label'=>'Votre nom',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre nom'
                ]
            ])
            ->add('prenom',TextType::class, [
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
            ->add('password', PasswordType::class, [
                'label'=>'Votre mot de passe',
                'attr'=>[
                    'placeholder'=>'Merci de saisir un mot de passe'
                ]
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
