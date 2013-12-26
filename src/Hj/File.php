<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 18 déc. 2013
 * Time: 18:15:12
 */

namespace Hj;

use \Exception;
use \SplFileObject;

/**
 * The current file used to been browsed
 */
class File extends SplFileObject implements FileInterface
{
    /**
     * @var StringInterface
     */
    private $string;
    
    /**
     * @param string          $filename The name of the file
     * @param StringInterface $string The string object
     * 
     * @throws Exception
     */
    public function __construct(
            $filename,
            StringInterface $string
    ) {
        if (false === file_exists($filename)) {
            throw new Exception('The file [' . $filename . '] should not exist');
        }
        parent::__construct($filename, 'c+');
        $this->string = $string;
    }

    /**
     * @return string The successful message
     */
    public function doReplaceInAllFile()
    {
        $fileGetContent = file_get_contents($this);
        
        $filePutContent = $this->replaceTheString($fileGetContent);
        file_put_contents($this, $filePutContent);
        
       return 'The string [' . $this->string->getReplacedString().
                '] was succesfully replaced by [' . 
                $this->string->getStringReplacement() . 
                '] in ' . $this->getPathname();
    }
    
    /**
     * @param string $fileContentBeforeReplace The initial content before replace
     * 
     * @return string $fileContentAfterReplace The final content after replace
     * 
     * @throws Exception
     */
    public function replaceTheString($fileContentBeforeReplace)
    {
        if (false === strpos($fileContentBeforeReplace, $this->string->getReplacedString())) {
           $message = 'The string [' . $this->string->getReplacedString() . 
                   '] was not found in ' . $this->getPathname() ."\n";
           throw new Exception($message) ;
        }
        $fileContentAfterReplace = str_replace(
                $this->string->getReplacedString(), 
                $this->string->getStringReplacement(), 
                $fileContentBeforeReplace
        );
        
        return $fileContentAfterReplace;
    }
}