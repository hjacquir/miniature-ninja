<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 22 déc. 2013
 * Time: 14:21:20
 */

namespace Hj;

/**
 * Constract to construct a string
 */
interface StringInterface
{
    /**
     * @return string Get the initial string
     */
    public function getReplacedString();
    
    /**
     * @return string Get the final string
     */
    public function getStringReplacement();
    
    /**
     * @param string $replacedString Set the initial string
     */
    public function setReplacedString($replacedString);
    
     /**
     * @param string $stringReplacement Set the final string
     */
    public function setStringReplacement($stringReplacement);
}
