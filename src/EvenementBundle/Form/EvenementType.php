<?php

namespace EvenementBundle\Form;

use AppBundle\AppBundle;
use AppBundle\Entity\Adresse;
use AppBundle\Repository\AdresseRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EvenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
            ->add('categorie',EntityType::class,
                array(
                    'class' => 'AppBundle\Entity\Categorie',
                    'choice_label' => 'nom',
                    'multiple' => false))
            ->remove('date')
            ->add('startTime', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => false

            ])
            ->add('endTime', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => false
            ])
            ->add('description',TextareaType::class)
            ->add('gouvernorat',EntityType::class,
                array(
                    'class' => 'AppBundle\Entity\Adresse',
                    'query_builder' => function (AdresseRepository $er) {
                        return $er->createQueryBuilder('a')
                            ->andWhere('a.IdParent is null');
                    },
                    'choice_label' => 'Libelle',
                ))
            ->add('delegation',EntityType::class,
                array(
                    'class' => 'AppBundle\Entity\Adresse',
                    'query_builder' => function (AdresseRepository $er) {
                        return $er->createQueryBuilder('a')
                            ->andWhere('a.IdParent is not null');
                    },
                    'choice_label' => 'Libelle',
                ))
            ->add('photo',FileType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EvenementBundle\Entity\Evenement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'evenementbundle_evenement';
    }


}
