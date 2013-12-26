<?php

use \Hj\StringInterface;

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 20 déc. 2013
 * Time: 19:40:31
 */

namespace Hj;

/**
 * Define your string here
 */
class String implements StringInterface
{
    /**
     * The string which been replaced in the file
     * 
     * @var string The initial string
     */
    private $replacedString;
    
    /**
     * The string which replace
     * 
     * @var string The final string
     */
    private $stringReplacement;
    
    /**
     * @return string Get the initial string
     */
    public function getReplacedString()
    {
        return $this->replacedString;
    }
    
    /**
     * @return string Get the final string
     */
    public function getStringReplacement()
    {
        return $this->stringReplacement;
    }
    
    /**
     * @param string $replacedString Set the initial string
     */
    public function setReplacedString($replacedString)
    {
        $this->replacedString = $replacedString;
    }
    
    /**
     * @param string $stringReplacement Set the final string
     */
    public function setStringReplacement($stringReplacement)
    {
        $this->stringReplacement = $stringReplacement;
    }
}