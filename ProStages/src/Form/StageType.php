<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Formation;
use App\Form\StageType;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('nom')
            ->add('activiter')
            ->add('adresse')
            ->add('description')
            ->add('email')
            ->add('entreprise', EntrepriseType::class )
            ->add('formations', EntityType::class, array(
                'class' => Formation::class,
                'choice_label' => 'nomCourt',
                'multiple' => true,
                'expanded' => true,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
