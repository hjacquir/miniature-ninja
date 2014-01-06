<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 20 déc. 2013
 * Time: 19:45:32
 */

namespace Hj\Tests\Unit;

use \Hj\String;
use \PHPUnit_Framework_MockObject_MockObject;
use \PHPUnit_Framework_TestCase;

require_once '../../vendor/autoload.php';

/**
 * Description of StringTest
 * 
 * @covers Hj\String
 */
class StringTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var String
     */
    private $string;
    
    public function setUp()
    {
        $this->string = new String();
    }
    
    public function testShouldReturnTheReplacedString()
    {
        $this->string->setReplacedString('zezer');
        $this->assertSame('zezer', $this->string->getReplacedString());
    }
    
    public function testShouldReturnTheStringReplacement()
    {
        $this->string->setStringReplacement('rerer');
        $this->assertSame('rerer', $this->string->getStringReplacement());
    }
}
