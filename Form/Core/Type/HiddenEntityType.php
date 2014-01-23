<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\DataTransformer\EntityIdTransformer;

/**
 * Entity Hidden Form Type
 *      Use it to process entity as a form hidden field
 */
class HiddenEntityType extends AbstractType
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->_em = $em;
    }

    public function getParent()
    {
        return 'hidden';
    }
    
    public function getName()
    {
        return 'hidden_entity';
    }
    
    /**
     * Integrates a Model Transformer into field
     * 
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new EntityIdTransformer($this->_em, $options['entity_class'], $options['property']));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {                
        $resolver->setOptional(array(
            'property'
        ));
        
        $resolver->setRequired(array(
            'entity_class'
        ));
        
        $resolver->setAllowedTypes(array(
            'entity_class' => 'string',
            'property' => 'string'
        ));
        
        // set property in which entity will be transform
        $resolver->setDefaults(array(
            'property' => 'id'
        ));
        
        parent::setDefaultOptions($resolver);
    }
}
