<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Form Type Help Extension - adds a help option for form
 *
 * @author Umbrella-web <http://umbrella-web.com>
 */
class FormTypeHelpExtension extends AbstractTypeExtension
{

//    public function buildForm(FormBuilderInterface $builder, array $options)
//    {
//        if($options['help'])
//            $builder->setAttribute('help', $options['help']);
//    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if($options['help'])
            $view->vars['help'] = $options['help'];
    }

    public function getExtendedType()
    {
        return 'form';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'help' => null,
        ));
    }

}
