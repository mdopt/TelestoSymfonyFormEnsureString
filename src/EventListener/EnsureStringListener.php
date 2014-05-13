<?php

namespace Telesto\VendorExt\Symfony\Form\EnsureString\EventListener;

use Telesto\VendorExt\Symfony\Form\Utils\CommonUtil;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EnsureStringListener implements EventSubscriberInterface
{
    protected $formTypes;
    protected $defaultValue;
    
    /**
     * @param   string[]    $formTypes
     * @param   string      $defaultValue
     */
    public function __construct(array $formTypes, $defaultValue = '')
    {
        $this->formTypes = $formTypes;
        $this->defaultValue = $defaultValue;
    }
    
    public function preSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();
        
        if (!is_string($data) && CommonUtil::isTypeOf($form, $this->formTypes)) {
            $event->setData($this->defaultValue);
        }
    }
    
    public static function getSubscribedEvents()
    {
        return array(FormEvents::PRE_SUBMIT => 'preSubmit');
    }
}
