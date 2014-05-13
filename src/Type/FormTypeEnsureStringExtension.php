<?php

namespace Telesto\VendorExt\Symfony\Form\EnsureString\Type;

use Telesto\VendorExt\Symfony\Form\EnsureString\EventListener\EnsureStringListener;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

class FormTypeEnsureStringExtension extends AbstractTypeExtension
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

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(new EnsureStringListener($this->formTypes, $this->defaultValue));
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'form';
    }
}
