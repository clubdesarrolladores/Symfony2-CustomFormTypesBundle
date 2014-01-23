<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * YearTransformer - transform transform integer to date, date to integer
 */
class YearTransformer implements DataTransformerInterface
{
    /**
     * Transform date to integer
     * 
     * @param date $value
     * @return integer
     */
    public function transform($value)
    {
        if ($value)
            return date_format($value, 'Y');
    }
    
    /**
     * 
     * @param integer $value
     * @return date
     */
    public function reverseTransform($value)
    {
        if ($value)
            return date_create($value.'-01-01');
    }
}
