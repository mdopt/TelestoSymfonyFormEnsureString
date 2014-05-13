<?php

namespace Telesto\VendorExt\Symfony\Form\EnsureString\Tests;

use Telesto\VendorExt\Symfony\Form\EnsureString\EnsureStringExtension;
use Telesto\VendorExt\Symfony\Form\EnsureString\Type\FormTypeEnsureStringExtension;
use Symfony\Component\Form\Forms;

class EnsureStringExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadTypeExtensions()
    {
        $extension = new EnsureStringExtension(array('text'), 'defaultValue');
        
        $this->assertEquals(
            array(
                new FormTypeEnsureStringExtension(array('text'), 'defaultValue')
            ),
            $extension->getTypeExtensions('form')
        );
    }
}
