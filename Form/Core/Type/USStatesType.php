<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Umbrellaweb\Bundle\CustomFormTypesBundle\Service\USStatesService;

class USStatesType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'choice';
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'us_states';
    }
    
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => USStatesService::getUSStates()
        ));
    }
}
