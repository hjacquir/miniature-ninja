<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 5 janv. 2014
 * Time: 15:19:26
 */

namespace Hj\Tests\Unit;

use \Hj\TimeExecution;
use \PHPUnit_Framework_TestCase;

require_once '../../vendor/autoload.php';

/**
 * @covers \Hj\TimeExecution
 */
class TimeExecutionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var TimeExecution
     */
    private $timeExecution;
    
    public function setUp()
    {
        $this->timeExecution = new TimeExecution();
    }
    
    public function testShouldBeATimeExecution()
    {
        $this->assertInstanceOf('Hj\TimeExecutionInterface', $this->timeExecution);
    }
    
    public function testShouldReturnTheBeginValue()
    {
        $this->timeExecution->start();
        $this->assertInternalType('float', $this->timeExecution->getBegin());
    }
    
    public function testShouldReturnTheEndValue()
    {
        $this->timeExecution->stop();
        $this->assertInternalType('float', $this->timeExecution->getEnd());
    }
    
    public function testShouldReturnTheDuration()
    {
        $this->timeExecution->start();
        $this->timeExecution->stop();
        
        $begin = $this->timeExecution->getBegin();
        $end   = $this->timeExecution->getEnd();
        
        $duration = $end - $begin;
        
        $this->assertSame($duration, $this->timeExecution->getDuration());
    }
}   
