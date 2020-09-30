<?php

namespace App\Form;

use App\Entity\Machines;
use App\Entity\Statistic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class StatisticType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weight',NumberType::class,[
                'scale' => 1,
                'required' =>false,
                'label'=>'Poids'
            ])
            ->add('minutes', ChoiceType::class, array(
                'mapped' => false,
                'choices' => range(0, 59),
            ))
            ->add('seconds', ChoiceType::class, array(
                'mapped' => false,
                'choices' => range(0, 59),
                'label'=>'Secondes'
            ))
            ->add('machine',EntityType::class,[
                'class' => Machines::class,
                'choice_label' => 'name'
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Statistic::class,
        ]);
    }
}
