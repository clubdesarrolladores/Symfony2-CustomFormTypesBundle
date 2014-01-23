<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * DatepickerType
 *
 * @author Umbrella-web <http://umbrella-web.com>
 */
class DatepickerType extends AbstractType
{

    public function getName()
    {
        return 'datepicker';
    }

    public function getParent()
    {
        return 'date';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'widget' => 'single_text',
            'format' => 'MM/dd/yyyy',
        ));
    }

}
