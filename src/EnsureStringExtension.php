<?php

namespace Telesto\VendorExt\Symfony\Form\EnsureString;

use Symfony\Component\Form\AbstractExtension;

class EnsureStringExtension extends AbstractExtension
{
    protected $formTypes;
    protected $defaultValue;
    
    /**
     * @param   array       $formTypes
     * @param   string      $defaltValue
     */
    public function __construct(array $formTypes, $defaultValue = '')
    {
        $this->formTypes = $formTypes;
        $this->defaultValue = $defaultValue;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function loadTypeExtensions()
    {
        return array(
            new Type\FormTypeEnsureStringExtension($this->formTypes, $this->defaultValue)
        );
    }
}
