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
     * @return string
     */
    public function getReplacedString();
    
    /**
     * @return string
     */
    public function getStringReplacement();
    
    /**
     * @param string $replacedString
     */
    public function setReplacedString($replacedString);
    
    /**
     * @param string $stringReplacement
     */
    public function setStringReplacement($stringReplacement);
}
