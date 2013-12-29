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
    /**
     * @var integer
     */
    private $countFiles;
    
    /**
     * @var StringInterface
     */
    private $string;
    
    /**
     * @param string|null            $name   The command name should be null
     * @param StringInterface $string A string object
     */
    public function __construct($name, StringInterface $string)
    {
        parent::__construct(null);
        $this->string = $string;
    }
    
    protected function configure()
    {
        $description = 'This command allows you to enter the name of the file' . 
                ' or directory and the string to replace it with the ' . 
                'replacement string';
        $this->setName('s:r')
                ->setDescription($description)
                ->addArgument(
                        'initial', 
                        InputArgument::REQUIRED,
                        'What string do you try to replace ?'
                  )
                ->addArgument(
                        'final', 
                        InputArgument::REQUIRED,
                        'The string which replace the initial'
                    )
                ->addArgument(
                        'file', 
                        InputArgument::REQUIRED,
                        'Your file or directory'
                    );
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getArgument('file');
        $initial  = $input->getArgument('initial');
        $final    = $input->getArgument('final');
        
        $this->string->setReplacedString($initial);
        $this->string->setStringReplacement($final);
        $this->countFiles = 0;
        $this->executeReplace($fileName, $this->string, $output);
        $message = '<comment>' . $this->countFiles . ' files are done.</comment>';
        $output->writeln($message);
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
       $file   = new File($fileName, $string);
       try {
           $output->writeln('<info>' . $file->doReplaceInAllFile() . '</info>');
           $this->countFiles ++;
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