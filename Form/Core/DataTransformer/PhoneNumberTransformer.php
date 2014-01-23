<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class PhoneNumberTransformer implements DataTransformerInterface
{
    private $fields;
    
    public function __construct()
    {
        $fields = array('code', 'phone');
        
        $this->fields = $fields;
    }
    
    /**
     * Slice phone number string on code and phone values
     */
    public function transform($value)
    {
        if (null === $value) {
            return array_intersect_key(array(
                'code' => '',
                'phone' => ''
            ), array_flip($this->fields));
        }
        
        /**
         * Explode phone number by space for getting code and phone values
         */
        $phone_number = explode(' ', $value);
        
        $result = array_intersect_key(array(
            'code' => $phone_number[0],
            'phone' => $phone_number[1]
        ), array_flip($this->fields));
        
        return $result;
    }
    
    /**
     * Concatenate code and phone number
     */
    public function reverseTransform($value)
    {
        /**
         * Save phone number with space between code and phone for
         * subsequent easy rendering
         */
        return $value['code'] . ' ' . $value['phone'];
    }
}
