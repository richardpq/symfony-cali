<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmRollType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('film', EntityType::class, [
                'attr' => ['class' => 'select2', 'style' => 'width:100%;'],
                'query_builder' => function (EntityRepository $er) {
                    return $er->findAll(true);
                },
                'class' => 'AppBundle\Entity\Film',
                'placeholder' => 'Choose a film',
                'empty_data'  => null
            ])
            ->add('rollWidth',null, [
                'placeholder' => 'Choose a roll width',
                'empty_data'  => null
            ])
            ->add('linearFt')
            ->add('fullWeight')
            ->add('currentWeight')
            ->add('lot', null, [
                'required' => false
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\FilmRoll',
            'validation_groups' => array('newFilm', 'editFilm'),
        ));
    }
}
