<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 20 déc. 2013
 * Time: 19:45:32
 */

namespace Hj\Tests\Unit;

use \PHPUnit_Framework_MockObject_MockObject;
use \PHPUnit_Framework_TestCase;

require_once '../../vendor/autoload.php';

/**
 * Description of StringTest
 * 
 * @covers Hj\String
 * @todo add missing tests
 */
class StringTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $sut;
    
    public function setUp()
    {
        $this->sut = $this->getMock('Hj\String');
    }
    
    public function testShouldReturnTheReplacedString()
    {
        $this->sut->expects($this->once())
                ->method('getReplacedString')
                ->will($this->returnValue('aString'));
        
        $this->assertSame('aString', $this->sut->getReplacedString());
    }
}
