<?php

namespace ServiceBundle\Form;

use AppBundle\Repository\AdresseRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('TitreService')
            ->add('DescriptionService')
            ->add('PrixService',NumberType::class,['scale' => 2])
            ->add('DateCreationService', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => false
            ])
            ->remove('EtatService')
            ->remove('NoteService')
            ->add('CategorieService',EntityType::class,[
                'class' => 'AppBundle\Entity\Categorie',
                'choice_label' => 'nom',
                'multiple' => false
            ])
            ->remove('UtilisateurService')
            ->add('GouvernoratService',EntityType::class,
                array(
                    'class' => 'AppBundle\Entity\Adresse',
                    'query_builder' => function (AdresseRepository $er) {
                        return $er->createQueryBuilder('a')
                            ->andWhere('a.IdParent is null');
                    },
                    'choice_label' => 'Libelle',
                ))
            ->add('DelegationService',EntityType::class,
                array(
                    'class' => 'AppBundle\Entity\Adresse',
                    'query_builder' => function (AdresseRepository $er) {
                        return $er->createQueryBuilder('a')
                            ->andWhere('a.IdParent is not null');
                    },
                    'choice_label' => 'Libelle',
                ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ServiceBundle\Entity\Service'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'servicebundle_service';
    }


}
