<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

use Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\EventListener\WebUrlListener;

class WebUrlType extends AbstractType
{
    public function getParent()
    {
        return 'url';
    }
    
    public function getName()
    {
        return 'web_url';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(new WebUrlListener());
    }
}
