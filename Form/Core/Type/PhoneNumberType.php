<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Options;
use Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\DataTransformer\PhoneNumberTransformer;
use Umbrellaweb\Bundle\CustomFormTypesBundle\Service\PhoneCodesService;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

/**
 * Phone Number Type
 * 
 * Combine select and input fields for creating valid phone number
 */
class PhoneNumberType extends AbstractType
{
    private $container;

    public function __construct(\Symfony\Component\DependencyInjection\Container $container)
    {
        $this->container = $container;
    }

    public function getParent()
    {
        return 'form';
    }
    
    public function getName()
    {
        return 'phone_number';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('code', 'choice', array(
                    'choices' => $this->getPhoneCodes(),
                    'empty_value' => false,
                    'invalid_message' => 'The entered phone code is not valid.',
                    'preferred_choices' => array('+1'),
                ))
                ->add('phone', 'text', array(
                    'constraints' => array(
                        new Length(array('max' => '11', 'maxMessage' => 'Phone number is too long. It should have {{ limit }} characters or less.'))
                    )
                ))
        ;
        
        $builder->addModelTransformer(new PhoneNumberTransformer());
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => false,
            'constraints' => array(
                new Regex(array('pattern' => "/^\+\d{1,4}\s\d{0,11}$/"))
            )
        ));
    }

    /**
     * Get list of phone codes for choice list
     */
    protected function getPhoneCodes()
    {
        // get current locale if null
        $locale = \Locale::getDefault();
        
        // load file with list of phone codes
        $locator = new FileLocator($this->container->get('kernel')->locateResource("@UmbrellawebBundleCustomFormTypesBundle/Resources/data/phone_codes"));
        $codes_file = $locator->locate('codes.'.$locale.'.yml');
        
        // parse yaml file to array
        $codes = Yaml::parse(file_get_contents($codes_file));

        return $codes;
    }
}
