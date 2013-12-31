<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 29 déc. 2013
 * Time: 14:06:32
 */

namespace Hj\Test\Unit;

use \Hj\TimeExecution;
use \PHPUnit_Framework_TestCase;

/**
 * @covers \Hj\TimeExecution
 */
class TimeExecutionTest extends PHPUnit_Framework_TestCase
{
    /**
     * The execution time
     * 
     * @var TimeExecution 
     */
    private $executionTime;
    
    public function setUp()
    {
        $this->executionTime = new TimeExecution();
    }
    
    
}
