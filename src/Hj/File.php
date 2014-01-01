<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 18 déc. 2013
 * Time: 18:15:12
 */

namespace Hj;

use \Exception;

/**
 * The current file used to been browsed
 */
class File implements FileInterface
{
    /**
     * @var StringInterface A string object
     */
    private $string;
    
    /**
     * @var string The name of the file
     */
    private $fileName;
    
    /**
     * @var integer The number of files which are done
     */
    private $countFiles;
    
    public function __construct()
    {
        $this->setCountFiles(0);
    }

        /**
     * Set the name of the file
     * 
     * @param string $fileName The name of the file
     */
    public function setFileName($fileName)
    {
         if (false === file_exists($fileName)) {
            throw new Exception('The file or directory [' . $fileName . '] should not exist');
        }
        
        $this->fileName = $fileName;
    }
    
    /**
     * @return integer The number of files successfully done
     */
    public function getCountFiles()
    {
        return $this->countFiles;
    }
    
    /**
     * @param integer $countFiles
     */
    private function setCountFiles($countFiles)
    {
        $this->countFiles = $countFiles;
    }
        
    /**
     * Return the file name
     * 
     * @return string The file name
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set the string object
     * 
     * @param StringInterface $string The string object
     */
    public function setString(StringInterface $string)
    {
        $this->string = $string;
    }
    
    /**
     * Return an string object
     * 
     * @return String
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * @return string The successful message
     */
    public function doReplaceInAllFile()
    {
        $fileGetContent = file_get_contents($this->fileName);
        
        $filePutContent = $this->replaceTheString($fileGetContent, $this->string);
        file_put_contents($this->fileName, $filePutContent);
        $this->countFiles++;
        
       return 'The string [' . $this->string->getReplacedString() . '] was succesfully replaced by [' . 
                $this->string->getStringReplacement() . '] in ' . $this->fileName;
    }
    
    /**
     * @param string          $fileContentBeforeReplace The initial content before replace
     * @param StringInterface $string                   A string object
     * 
     * @return string $fileContentAfterReplace The final content after replace
     * 
     * @throws Exception
     */
    private function replaceTheString($fileContentBeforeReplace, StringInterface $string)
    {
        $this->testIfStringExistInContent($fileContentBeforeReplace, $string);
        
        $fileContentAfterReplace = str_replace(
                $string->getReplacedString(), 
                $string->getStringReplacement(), 
                $fileContentBeforeReplace
        );
                    
        return $fileContentAfterReplace;
    }
    
    /**
     * Test if the string in the file content before to do the replace
     * 
     * @param string          $fileContentBeforeReplace The initial content before replace
     * @param StringInterface $string                   An string object
     * 
     * @throws Exception
     */
    private function testIfStringExistInContent($fileContentBeforeReplace, StringInterface $string)
    {
        if (false === strpos($fileContentBeforeReplace, $string->getReplacedString())) {
           $message = 'The string [' . $string->getReplacedString() . '] was not found in ' . 
                   $this->fileName . "\n";
           throw new Exception($message) ;
        }
    }
}  