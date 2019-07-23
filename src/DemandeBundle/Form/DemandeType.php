<?php

namespace DemandeBundle\Form;


use AppBundle\Repository\AdresseRepository;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dis',TextareaType::class)
            ->add('photo',FileType::class)
            ->add('cat',EntityType::class,
                array(
                    'class' => 'AppBundle\Entity\Categorie',
                    'choice_label' => 'nom',
                    'multiple' => false))

            ->add('prix',NumberType::class,[
                    'scale' => 2,
                ])
            ->add('address',EntityType::class,
                array(
                    'class' => 'AppBundle\Entity\Adresse',
                    'query_builder' => function (AdresseRepository $er) {
                        return $er->createQueryBuilder('a')
                            ->andWhere('a.IdParent is null');
                    },
                    'choice_label' => 'Libelle',
                ))
            ->add('contact')
            ->remove('iduser')
            ->add('Demander',SubmitType::class);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DemandeBundle\Entity\Demande'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'demandebundle_demande';
    }
}
