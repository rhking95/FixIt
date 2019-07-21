<?php


namespace EvenementBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EvenementEditType extends AbstractType
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
            ->add('adresse');
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