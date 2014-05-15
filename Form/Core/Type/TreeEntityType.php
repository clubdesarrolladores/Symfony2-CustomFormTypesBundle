<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\DataTransformer\ClosureTreeTransformer;

class TreeEntityType extends AbstractType
{
    public function getParent()
    {
        return 'entity';
    }
    
    public function getName()
    {
        return 'tree';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($options['select_children'])
            $builder->addModelTransformer(new ClosureTreeTransformer());
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'select_children' => false,
        ));
        
        $resolver->setOptional(array('select_children'));
        
        $resolver->setAllowedTypes(array(
            'select_children' => 'bool',
        ));
        
        parent::setDefaultOptions($resolver);
    }
}
