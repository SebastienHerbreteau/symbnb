<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{
    /**
     * Permet d'avoir la configuration de base d'un champ
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder)
    {
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration("Titre", ""))
            ->add('slug', TextType::class, $this->getConfiguration("Adresse web", ""))
            ->add('coverImage', urlType::class, $this->getConfiguration("URL de l'image principale", ""))
            ->add('introduction', TextType::class, $this->getConfiguration("Introduction", ""))
            ->add('content', TextareaType::class, $this->getConfiguration("Description détaillée", ""))
            ->add('rooms', IntegerType::class, $this->getConfiguration("Indiquez le nombre de chambres", ""))
            ->add('price', MoneyType::class, $this->getConfiguration("Prix par nuit", ""));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}