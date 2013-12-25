<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 18 déc. 2013
 * Time: 18:15:12
 */

namespace Hj;

use \Exception;
use \SplFileObject;
use \Symfony\Component\Console\Output\OutputInterface;

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
     *
     * @var OutputInterface
     */
    private $output;
    
    public function __construct(
            $filename,
            StringInterface $string,
            OutputInterface $output
    ) {
        if (false === file_exists($filename)) {
            throw new Exception('The file [' . $filename . '] should not exist');
        }
        parent::__construct($filename, 'c+');
        $this->string = $string;
        $this->output = $output;
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
            $this->output->writeln('<info>The string was succesfully replaced');
        } catch (Exception $ex) {
            /**
             * @todo Not cover by unit test. Why ?
             */
            $this->output->writeln('<error>' . $ex->getMessage() . '</error>');
        }
    }
    
    /**
     * @param string $content
     * 
     * @return string
     */
    public function replaceTheString($content)
    {
        if (false === strpos($content, $this->string->getReplacedString())) {
           $message = 'The string [' . $this->string->getReplacedString() . 
                   '] was not found in the file' . "\n";
           
           throw new Exception($message) ;
        }
        $str = str_replace(
                $this->string->getReplacedString(), 
                $this->string->getStringReplacement(), 
                $content
        );
        
        return $str;
    }
}