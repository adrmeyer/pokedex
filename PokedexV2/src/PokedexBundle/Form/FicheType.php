<?php

namespace PokedexBundle\Form;

use PokedexBundle\Entity\Fiche;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('nationalID', IntegerType::class,
                array('label'=>'National ID'))
            ->add('description', TextareaType::class)
            ->add(
                'evolution',
                EntityType::class,
                array(
                    'class'     => Fiche::class,
                    'required'  => false,
                )
            )
            ->add('image', ImageType::class,
                array('required' => false))
            ->add('types', ChoiceType::class, array(
                'choices' => array(
                    'Physiques' => array(
                        'Acier' => 'Acier',
                        'Combat' => 'Combat',
                        'Insecte' => 'Insecte',
                        'Normal' => 'Normal',
                        'Poison' => 'Poison',
                        'Roche' => 'Roche',
                        'Sol' => 'Sol',
                        'Spectre' => 'Spectre',
                        'Vol' => 'Vol',
                    ),
                    'Spéciaux' => array(
                        'Dragon' => 'Dragon',
                        'Eau' => 'Eau',
                        'Electrik' => 'Electrik',
                        'Feu' => 'Feu',
                        'Glace' => 'Glace',
                        'Plante' => 'Plante',
                        'Psy' => 'Psy',
                        'Ténèbres' => 'Ténèbres',
                    ),
                    'Autres' => array(
                        'Fée' => 'Fée',
                        'Obscur' => 'Obscure'
                    )
                ),
                'multiple' => true,
                    'attr'   =>  array(
                        'multiple'   => 'multiple')
                )
            )
            ->add('add', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PokedexBundle\Entity\Fiche'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pokedexbundle_fiche';
    }


}
