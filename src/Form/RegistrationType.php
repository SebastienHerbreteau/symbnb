<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration("Prénom", ""))
            ->add('lastName', TextType::class, $this->getConfiguration("Nom", ""))
            ->add('email', EmailType::class, $this->getConfiguration("Email", ""))
            ->add('picture', UrlType::class, $this->getConfiguration("photo de profil", ""))
            ->add('hash', PasswordType::class, $this->getConfiguration("Mot de passe", ""))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Confirmation de mot de passe", ""))
            ->add('introduction', TextType::class, $this->getConfiguration("Introduction", ""))
            ->add('description', TextareaType::class, $this->getConfiguration("Description détaillée", ""));

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
