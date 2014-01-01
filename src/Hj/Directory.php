<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 1 janv. 2014
 * Time: 11:01:36
 */

namespace Hj;

use \DirectoryIterator;

/**
 * Description of Directory
 */
class Directory extends DirectoryIterator
{
    
    private $path;
    
    /**
     * Override the construct method because we don't want to use a path in first instance see console.php
     */
    public function __construct()
    {
    }

    public function initDirectory()
    {
        parent::__construct($this->path);
    }
    
    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
}
