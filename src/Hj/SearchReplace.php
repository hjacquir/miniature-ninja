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
     * @var StringInterface
     */
    private $string;
    
    /**
     * @var File
     */
    private $file;
    
    /**
     * @param string $initial
     * @param string $final
     */
    public function __construct($initial, $final)
    {
        $this->file = new File();
        $this->file->setCountFiles(0);
        
        $this->string = new String();
        $this->string->setReplacedString($initial);
        $this->string->setStringReplacement($final);
    }
    
    /**
     * @param string          $fileName The file or directory name
     * @param OutputInterface $output   The console Output
     */
    public function searchReplace($fileName, OutputInterface $output) 
    {
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
        
        return $this->file->getCountFiles();
    }
    
     /**
     * @param string          $fileName The file or directory name
     * @param OutputInterface $output The console Output
     */
     private function replaceInAFile($fileName, OutputInterface $output) 
     {
         
         $this->file->setFileName($fileName);
         $this->file->setString($this->string);
       
         fopen($this->file->getFileName(), 'c+');
       
         try {
             $output->writeln('<info>' . $this->file->doReplaceInAllFile() . '</info>');
         } catch (Exception $ex) {
             $output->writeln('<error>' . $ex->getMessage() . '</error>');
           } 
      }

    /**
     * @param string          $directory The directory name
     * @param OutputInterface $output The console Output
     */
    private function replaceInADirectory($directory, OutputInterface $output)
    {
        $dir = new DirectoryIterator($directory);
        
        foreach ($dir as $file) {
            if (false === $dir->isDot()) {
                $this->searchReplace($dir->getPathname(), $output);
            }
        }
    }
}
