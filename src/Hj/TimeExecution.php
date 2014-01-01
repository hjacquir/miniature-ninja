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
     * The duration of the script
     * 
     * @var float
     */
    private $duration;
    
    /**
     * Start counting the time execution of the script here
     */
    public function start()
    {
        $this->setBegin(microtime(true));
    }
    
    /**
     * Stop here the counting of the time execution of the script
     */
    public function stop()
    {
        $this->setEnd(microtime(true));
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
    public function setBegin($begin)
    {
        $this->begin = $begin;
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
    
    /**
     * Get the duration into microtime
     * 
     * @return float
     */
    public function getDuration()
    {   
        $this->duration = $this->end - $this->begin;
    
        return $this->duration;
    }
    
    /**
     * Set the duration
     * 
     * @param float $duration The duration of the script
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }
}
