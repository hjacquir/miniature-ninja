<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 22 déc. 2013
 * Time: 14:24:38
 */

namespace Hj;

/**
 * Constract to construct your file
 */
interface FileInterface
{
    /**
     * Set the name of the file
     * 
     * @param string $fileName The name of the file
     */
    public function setFileName($fileName);
    
    /**
     * Set the string objetc
     * 
     * @param StringInterface $string The string object
     */
    public function setString(StringInterface $string);
}
