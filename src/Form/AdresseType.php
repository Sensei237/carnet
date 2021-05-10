<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contactName', TextType::class, [
                'label' => "Nom et prenom de la personne",
                'required' => true,
            ])
            ->add('company', TextType::class, [
                'label' => "Nom de l'entreprise",
                'required' => false,
            ])
            ->add('image', FileType::class, [
                'attr' => [
                    'placeholder' => 'Sélectionner une image',
                    'accept' => '.png, .jpg, .PNG, .JPG',
                    'class' => 'hidden'
                ],
                'required' => false,
                'label' => false
            ])
            ->add('villeResidence', TextType::class, [
                'label' => "Ville de réseidence",
                'required' => true,
            ])
            ->add('telephone', TextType::class, [
                'label' => "Téléphone 1",
                'required' => true,
            ])
            ->add('telephone2', TextType::class, [
                'label' => "Téléphone 2",
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => "Adresse e-mail",
                'required' => true,
            ])
            ->add('nationalite', TextType::class, [
                'label' => "Nationalité",
                'required' => false,
            ])
            ->add('boitePostale', TextType::class, [
                'label' => "Nom et prenom de la personne",
                'required' => false,
            ])
            ->add('sexe', ChoiceType::class, [
                'choices' => ['Masculin'=>'Masculin', 'Feminin'=>'Feminin'],
                'placeholder' => "",
                'attr' => [
                    'class' => 'select2',
                ]
            ])
            ->add('details', TextareaType::class, [
                'attr' => [
                    'class' => 'details'
                ],
                'label' => "Autres notes",
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
            "label" => false
        ]);
    }
}
