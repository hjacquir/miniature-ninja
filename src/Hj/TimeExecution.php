<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 29 déc. 2013
 * Time: 11:30:13
 */

namespace Hj;

/**
 * This class calculate the execution time of a script
 */
class TimeExecution implements TimeExecutionInterface
{
    /**
     * The beginnig of counting time in microtime
     * 
     * @var float $begin
     */
    private $begin;
    
    /**
     * The end of counting time in microtime
     * 
     * @var float $end
     */
    private $end;
    
    /**
     * Start counting the time execution of the script here
     */
    public function start()
    {
        $this->setBegin(microtime());
    }
    
    /**
     * Stop the counting of the time execution of the script
     * 
     * @return float The end of the counting script in microtime
     */
    public function stop()
    {
        $this->setEnd(microtime() - $this->begin);
    }
    
    /**
     * Get the microtime begin at the beginning of the script
     * 
     * @return float
     */
    public function getBegin()
    {
        return $this->begin;
    }
    
     /**
     * Get the microtime end at the end of the script
     * 
     * @return float
     */
    public function getEnd()
    {
        return $this->end;
    }
    
    /**
     * Set the begin in microtime to 0
     */
    public function setBegin()
    {
        $this->begin = 0;
    }
    
    /**
     * Set the end of the script
     * 
     * @param float $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }
}
