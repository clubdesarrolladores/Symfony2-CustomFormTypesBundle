<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Transformer for EntityHiddenType - transforms property to entity/entity to property.
 */
class EntityIdTransformer implements DataTransformerInterface
{
    /**
     * Property for transforms entity
     */
    private $property;

    /**
     * Entity class name
     * @var string
     */
    private $_entityClass;
    
    /**
     * Entity Repository
     * @var \Doctrine\ORM\EntityManager
     */
    protected $_em;
    
    public function __construct(\Doctrine\ORM\EntityManager $em, $entity_class, $property)
    {
        $this->_entityClass = $entity_class;
        $this->_em = $em;
        $this->property = $property;
    }
    
    /**
     * Transforms an entity to integer (id).
     *
     * @param  mixed [entity|null] $entity
     * @return integer
     * 
     */
    public function transform($value)
    {
        if($value)            
            switch ($this->property)
            {
                case 'slug':
                    return $value->getSlug();
                break;
                default:
                    return $value->getId();
                break;
            }
   
        return $value;
    }

    /**
     * Transforms id to entity.
     *
     * @param  integer|null $value
     * @return mixed
     */
    public function reverseTransform($value)
    {
        if(!$value){
            return null;
        }
        
        if (null !== $value && !is_scalar($value)) {
            throw new TransformationFailedException('Expected a scalar.');
        }
        
        switch ($this->property)
        {
            case 'slug':
                $entity = $this->_em->getRepository($this->_entityClass)->findOneBySlug($value);
            break;
            default:
                $entity = $this->_em->getRepository($this->_entityClass)->find($value);
            break;
        }                                
        
        if(!$entity)
            throw new TransformationFailedException("Entity does not exists");
        
        return $entity;
    }
}
