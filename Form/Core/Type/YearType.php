<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Options;
use Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\DataTransformer\YearTransformer;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class YearType extends \Symfony\Component\Form\Extension\Core\Type\ChoiceType
{

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'year';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new YearTransformer());
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $years = range(1950, intval(date('Y')));
        $resolver
                ->setDefaults(array('choices' => array_combine($years, $years)))
        ;
        
    }

}
