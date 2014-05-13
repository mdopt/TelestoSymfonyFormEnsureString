<?php

namespace Telesto\VendorExt\Symfony\Form\EnsureString\Tests\Type;

use Telesto\VendorExt\Symfony\Form\EnsureString\EventListener\EnsureStringListener;
use Telesto\VendorExt\Symfony\Form\EnsureString\Type\FormTypeEnsureStringExtension;

class FormTypeEnsureStringExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildForm()
    {
        $mockFormBuilder = $this->getMock('Symfony\\Component\\Form\\FormBuilderInterface');
        $mockFormBuilder
            ->expects($this->once())
            ->method('addEventSubscriber')
            ->with(
                $this->callback(function($listener) {
                    return ($listener == new EnsureStringListener(array('text'), 'defaultValue'));
                })
            )
        ;
        
        $typeExtension = new FormTypeEnsureStringExtension(array('text'), 'defaultValue');
        $typeExtension->buildForm($mockFormBuilder, array());
    }
}
