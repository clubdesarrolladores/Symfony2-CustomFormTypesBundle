<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Form\Core\EventListener;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/*
 * Check what was sent in web_url type field
 */
class WebUrlListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(FormEvents::SUBMIT => 'postBind');
    }
    
    // set web_url to null if only http:// was sent
    public function postBind(FormEvent $event)
    {
        $data = $event->getData();

        if (preg_match('~^\w+://$~', $data))
        {
            $event->setData(null);
        }
    }
}
