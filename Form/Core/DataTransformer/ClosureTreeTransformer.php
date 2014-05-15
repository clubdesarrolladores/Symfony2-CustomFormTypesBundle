<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class ClosureTreeTransformer implements DataTransformerInterface
{

    protected $_usedIds = array();
    protected $_reversedValue;

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($value)
    {
        return $value;
    }

    public function reverseTransform($value)
    {
        $this->_reversedValue = new \Doctrine\Common\Collections\ArrayCollection();
        
        if (!$value)    return $this->_reversedValue;

        foreach ($value as $one)
        {
            $this->iterate($one);
        }
        return $this->_reversedValue;
    }

    protected function iterate($entity)
    {
        if (!in_array($entity->getId(), $this->_usedIds))
        {
            $this->_usedIds[] = $entity->getId();
            $this->_reversedValue->add($entity);
        }

        if ($entity->getChildren()->isEmpty())
            return;
        
        foreach($entity->getChildren() as $child)
        {
            $this->iterate($child);
        }
        
        return;
    }
}
