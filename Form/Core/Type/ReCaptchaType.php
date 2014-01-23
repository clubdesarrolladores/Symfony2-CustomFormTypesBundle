<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\InvalidConfigurationException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;

use Umbrellaweb\Bundle\CustomFormTypesBundle\Service\ReCaptcha;
use Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\DataTransformer\ReCaptchaTransformer;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
* A ReCaptcha type for use with Google ReCatpcha services. It embeds two fields that are used
* for manual validation and show of the widget.
*
* The DataTransformer takes the entered request information and validates them agains the
* Google Recaptcha API.
*/
class ReCaptchaType extends AbstractType
{
    /**
     * @var Recaptcha
     */
    protected $recaptcha;

    /**
     * @var string
     */
    protected $publicKey;

    /**
     * @param Recaptcha $recaptcha
     * @param string $publicKey
     */
    public function __construct(Recaptcha $recaptcha, $publicKey)
    {
        $this->recaptcha = $recaptcha;
        $this->publicKey = $publicKey;
    }

    /**
     * Configures the Type
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ((string) $this->publicKey === '') {
            throw new InvalidConfigurationException('A public key must be set and not empty.');
        }

        $builder
            ->add('recaptcha_challenge_field', 'text')
            ->add('recaptcha_response_field', 'hidden', array(
                'data' => 'manual_challenge',
            ));

        $builder->addViewTransformer(new ReCaptchaTransformer($this->recaptcha));
    }

    /**
     * Sets attributes for use with the renderer
     *
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['public_key'] = $this->publicKey;
        $view->vars['widget_options'] = $options['widget_options'];
    }

    /**
     * Options for this type
     *
     * @param array $options
     *
     * @return array
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'required' => true,
            'widget_options' => array(
                'theme' => 'white'
            ),
            'invalid_message' => 'recaptcha.invalid'
        ));
    }

    /**
     * Because this have property_path = null and it shouldnt be written this parent
     * is a field.
     *
     * @return string
     */
    public function getParent()
    {
        return 'form';
    }

    /**
     * Used to identify the rendering block
     *
     * @return string
     */
    public function getName()
    {
        return 'recaptcha';
    }
}