<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class USStatesType extends AbstractType
{
    private $kernel;

    public function __construct(\Symfony\Component\HttpKernel\Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

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
            'choices' => $this->getUSStates()
        ));
    }

    /**
     * Get list of US states for choice list
     */
    protected function getUSStates()
    {
        // get current locale if null
        $locale = \Locale::getDefault();
        
        // load file with list of states
        $locator = new FileLocator($this->kernel->locateResource("@UmbrellawebBundleCustomFormTypesBundle/Resources/data/states"));
        $country_file = $locator->locate('us_states.'.$locale.'.yml');
        
        // parse yaml file to array
        $countries = Yaml::parse(file_get_contents($country_file));

        return $countries;
    }
}
