<?php


namespace App\Form;

use App\Entity\Map;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class Form extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Название',
                    'class' => 'type-2'
                )
            ])
            ->add('length', NumberType::class, [
                'attr' => array(
                    'placeholder' => 'Долгота',
                    'class' => 'type-2'
                )
            ])
            ->add('width', NumberType::class, [
                'attr' => array(
                    'placeholder' => 'Широта',
                    'class' => 'type-2'
                )
                ]);
    }
}