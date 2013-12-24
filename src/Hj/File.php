<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 18 déc. 2013
 * Time: 18:15:12
 */

namespace Hj;

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
    
    public function __construct(
            $filename,
            StringInterface $string
    ) {
        if (false === file_exists($filename)) {
            throw new \Exception('The file should not exist');
        }
        parent::__construct($filename, 'c+');
        $this->string = $string;
    }

    /**
      * Replace the initial string by the final
      */
    public function doReplaceInAllFile()
    {
        $fileGetContent = file_get_contents($this);
        try {
            $filePutContent = $this->replaceTheString($fileGetContent);
            file_put_contents($this, $filePutContent);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    /**
     * @param string $content
     * 
     * @return string
     */
    private function replaceTheString($content)
    {
        if (false === strpos($content, $this->string->getReplacedString())) {
           $message = 'The string ' . $this->string->getReplacedString() . 
                   ' was not found in the file' . "\n";
           throw new \Exception($message) ;
        }
        $str = str_replace(
                $this->string->getReplacedString(), 
                $this->string->getStringReplacement(), 
                $content
        );
        
        return $str;
    }
}