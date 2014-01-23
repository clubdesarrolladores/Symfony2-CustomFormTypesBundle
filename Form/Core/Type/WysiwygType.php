<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\DataTransformerInterface;

class WysiwygType extends AbstractType
{
    private $purifierTransformer;

    public function __construct(DataTransformerInterface $purifierTransformer)
    {
        $this->purifierTransformer = $purifierTransformer;
    }
    
    public function getParent()
    {
        return 'textarea';
    }
    
    public function getName()
    {
        return 'wysiwyg';
    }        

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this->purifierTransformer);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'compound' => false,
            'attr' => array(
                'class' => 'wysiwyg'
            )
        ));
    }
}
