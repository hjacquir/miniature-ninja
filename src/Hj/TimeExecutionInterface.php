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
     * Stop the counting of the time execution of the script
     * 
     * @return float The end of the counting script in microtime
     */
    public function stop();
    
    /**
     * Set the begin in microtime to 0
     */
    public function setBegin();
    
     /**
     * Set the end of the script
     * 
     * @param float $end
     */
    public function setEnd($end);
    
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
}
