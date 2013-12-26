<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 20 déc. 2013
 * Time: 19:25:24
 */

namespace Hj;

use \DirectoryIterator;
use \Exception;
use \Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;

/**
 * Console command to put the file
 */
class Explore extends Command
{
    protected function configure()
    {
        $description = 'This command allows you to enter the name of the file' . 
                ' or directory and the string to replace it with the ' . 
                'replacement string';
        $this->setName('replace:string')
                ->setDescription($description)
                ->addArgument(
                        'initial', 
                        InputArgument::REQUIRED,
                        'What string do you try to replace ?'
                  )
                ->addArgument(
                        'final', 
                        InputArgument::REQUIRED,
                        'The string can replace the initial'
                    )
                ->addArgument(
                        'file', 
                        InputArgument::REQUIRED,
                        'Your file'
                    );
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getArgument('file');
        $initial  = $input->getArgument('initial');
        $final    = $input->getArgument('final');
        
        $string = new String();
        $string->setReplacedString($initial);
        $string->setStringReplacement($final);
        
        $this->executeReplace($fileName, $string, $output);
    }
    
    /**
     * @param string          $fileName The file or directory name
     * @param StringInterface $string A string object
     * @param OutputInterface $output The console Output
     */
    protected function executeReplace($fileName, StringInterface $string, OutputInterface $output) 
    {
        try {
            if (false === is_dir($fileName)) {
                $this->replaceInAFile($fileName, $string, $output);
            } else {
                $this->replaceInADirectory($fileName, $string, $output);
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
    protected function replaceInAFile($fileName, StringInterface $string, OutputInterface $output) 
    {
       $file   = new File($fileName, $string, $output);
       try {
           $output->writeln('<info>' . $file->doReplaceInAllFile() . '</info>');
       } catch (Exception $ex) {
           $output->writeln('<error>' . $ex->getMessage() . '</error>');
         } 
    }
    
      /**
     * @param string          $fileName The file or directory name
     * @param StringInterface $string A string object
     * @param OutputInterface $output The console Output
     */
    protected function replaceInADirectory($fileName, StringInterface $string, OutputInterface $output)
    {
        $dir = new DirectoryIterator($fileName);
        
        foreach ($dir as $fileName) {
            if (false === $dir->isDot()) {
                $this->executeReplace($dir->getPathname(), $string, $output);
            }
        }
    }
}