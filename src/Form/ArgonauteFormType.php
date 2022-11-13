<?php

namespace App\Form;

use App\Entity\Argonaute;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArgonauteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom de l'Argoanute :",
                "attr" => [
                    "class" => "input is-rounded is-medium is-danger is-mobile",
                ]
            ])
            ->add('submit', SubmitType::class, [
                "label" => "Ajouter un argonaute",
                "attr" => [
                    "class" => "button is-medium is-rounded is-danger is-light"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Argonaute::class,
        ]);
    }
}
