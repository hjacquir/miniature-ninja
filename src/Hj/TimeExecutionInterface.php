<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 29 déc. 2013
 * Time: 11:26:04
 */

namespace Hj;

/**
 * Constract to calculate execution time
 */
interface TimeExecutionInterface
{
    /**
     * Start counting the time execution of the script here
     */
    public function start();
    
     /**
     * Stop here the counting of the time execution of the script
     */
    public function stop();
    
    /**
     * Set the begin in microtime
     * 
     * @param float $begin
     */
    public function setBegin($begin);
    
     /**
     * Set the end of the script
     * 
     * @param float $end The end value of the script in microtime
     */
    public function setEnd($end);
    
    /**
     * Set the duration
     * 
     * @param float $duration The duration of the script
     */
    public function setDuration($duration);
    
    /**
     * Get the microtime begin at the beginning of the script
     * 
     * @return float
     */
    public function getBegin();
    
     /**
     * Get the microtime end at the end of the script
     * 
     * @return float
     */
    public function getEnd();
    
    /**
     * Get the duration into microtime
     * 
     * @return float
     */
    public function getDuration();
}
