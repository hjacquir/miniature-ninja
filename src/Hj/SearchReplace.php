<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 10 janv. 2014
 * Time: 12:23:38
 */

namespace Hj;

use \DirectoryIterator;
use \Exception;
use \Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of SearchReplace
 */
class SearchReplace
{
    /**
     * @var FileInterface
     */
    private $file;
    
    /**
     * @var StringInterface
     */
    private $string;
    
    public function __construct($file, $initial, $final)
    {
        $this->file   = $file;
        
        $this->string = new String();
        $this->string->setReplacedString($initial);
        $this->string->setStringReplacement($final);
    }
    /**
     * @param string                 $fileName      The file or directory name
     * @param StringInterface        $string        A string object
     * @param OutputInterface        $output        The console Output
     */
    public function searchReplace(
            $fileName, 
            OutputInterface $output
    ) {
        try {
            if (false === is_dir($fileName)) { 
                $this->replaceInAFile($fileName, $output);
            } else {
                $this->replaceInADirectory($fileName, $output);
            }
        } 
        catch (Exception $ex) {
                $output->writeln('<error>' . $ex->getMessage() . '</error>');
        } 
    }
    
     /**
     * @param string          $fileName The file or directory name
     * @param StringInterface $string A string object
     * @param OutputInterface $output The console Output
     */
     private function replaceInAFile($fileName, OutputInterface $output) 
    {
       $this->file->setFileName($fileName);
       fopen($this->file->getFileName(), 'c+');
       $this->file->setString($this->string);
       
       try {
           $output->writeln('<info>' . $this->file->doReplaceInAllFile() . '</info>');
       } catch (Exception $ex) {
           $output->writeln('<error>' . $ex->getMessage() . '</error>');
         } 
    }

    /**
     * @param string          $directory The directory name
     * @param StringInterface $string A string object
     * @param OutputInterface $output The console Output
     * 
     * @todo Remove the instance of DirectoryIterator and use DI
     */
    private function replaceInADirectory($directory, OutputInterface $output)
    {
        $dir = new DirectoryIterator($directory);
        
        foreach ($dir as $fileName) {
            if (false === $dir->isDot()) {
                $this->searchReplace($dir->getPathname(), $output);
            }
        }
    }
}
