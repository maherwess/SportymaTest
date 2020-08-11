<?php

namespace App\Form;

use App\Entity\Saison;
use App\Entity\SaisonSearch;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SaisonSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('saison', EntityType::class, array(
            'class' => Saison::class,
            'placeholder' => 'Toute les saisons',
            'attr'=>['novalidate'=>'novalidate'],
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c');
            },
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SaisonSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}
