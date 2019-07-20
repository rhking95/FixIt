<?php

namespace ServiceBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->remove('DateCreationService')
            ->remove('EtatService')
            ->remove('NoteService')
            ->add('CategorieService',EntityType::class,[
                'class' => 'DemandeBundle\Entity\Categorie',
                'choice_label' => 'nom',
                'multiple' => false
            ])
            ->remove('UtilisateurService')
            ->add('GouvernoratService')
            ->add('DelegationService')
            ->add('Enregistrer le service',SubmitType::class);
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
