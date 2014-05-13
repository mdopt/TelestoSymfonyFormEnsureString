<?php

namespace Telesto\VendorExt\Symfony\Form\EnsureString\Tests\EventListener;

use Telesto\VendorExt\Symfony\Form\EnsureString\EventListener\EnsureStringListener;
use Symfony\Component\Form\FormEvent;

class EnsureStringListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidDataType()
    {
        $mockForm = $this->createMockForm('text');
        
        $data = array();
        $event = new FormEvent($mockForm, $data);
        
        $listener = new EnsureStringListener(array('text'));
        $listener->preSubmit($event);
        
        $this->assertSame('', $event->getData());
    }
    
    public function testValidDataType()
    {
        $mockForm = $this->createMockForm('text');
        
        $data = 'Valid string that should not get replaced';
        $event = new FormEvent($mockForm, $data);
        
        $listener = new EnsureStringListener(array('text'));
        $listener->preSubmit($event);
        
        $this->assertSame('Valid string that should not get replaced', $event->getData());
    }
    
    public function testInvalidDataTypeWithDefaultValue()
    {
        $mockForm = $this->createMockForm('text');
        
        $data = array();
        $event = new FormEvent($mockForm, $data);
        
        $listener = new EnsureStringListener(array('text'), 'defaultValue');
        $listener->preSubmit($event);
        
        $this->assertSame('defaultValue', $event->getData());
    }
    
    public function testNotAffectedFormType()
    {
        $mockForm = $this->createMockForm('array');
        
        $data = array();
        $event = new FormEvent($mockForm, $data);
        
        $listener = new EnsureStringListener(array('text'));
        $listener->preSubmit($event);
        
        $this->assertSame(array(), $event->getData());
    }
    
    protected function createMockForm($type)
    {
        $mockType = $this->getMock('Symfony\\Component\\Form\\ResolvedFormTypeInterface');
        $mockType
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue($type))
        ;
        
        $mockConfig = $this->getMock('Symfony\\Component\\Form\\FormConfigInterface');
        $mockConfig
            ->expects($this->any())
            ->method('getType')
            ->will($this->returnValue($mockType))
        ;
        
        $mockForm = $this->getMock('Symfony\\Component\\Form\\FormInterface');
        $mockForm
            ->expects($this->any())
            ->method('getConfig')
            ->will($this->returnValue($mockConfig))
        ;
        
        return $mockForm;
    }
}
