<?php

namespace Telesto\VendorExt\Symfony\Form\EnsureString\Tests;

use Telesto\VendorExt\Symfony\Form\EnsureString\Util;
use Symfony\Component\Form\Forms;

class UtilTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideIsTypeOfData
     */
    public function testIsTypeOf(
        $expectedValue,
        $form,
        $typeName
    )
    {
        $this->assertSame($expectedValue, Util::isTypeOf($form, $typeName));
    }
    
    public function provideIsTypeOfData()
    {
        $formFactory = Forms::createFormFactory();
        
        return array(
            array(
                true,
                $formFactory->create('text'),
                'text'
            ),
            array(
                true,
                $formFactory->create('email'),
                'text'
            ),
            array(
                false,
                $formFactory->create('checkbox'),
                'text'
            ),
            array(
                false,
                $formFactory->create('text'),
                'checkbox'
            ),
            array(
                true,
                $formFactory->create('text'),
                array('checkbox', 'text')
            ),
            array(
                false,
                $formFactory->create('text'),
                array('checkbox', 'number')
            )
        );
    }
}
