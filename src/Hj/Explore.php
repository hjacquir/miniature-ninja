<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 20 déc. 2013
 * Time: 19:25:24
 */

namespace Hj;

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
     * The string object
     * 
     * @var StringInterface
     */
    private $string;
    
    /**
     * The execution time of the script
     * 
     * @var float
     */
    private $executionTime;
    
    /**
     * 
     * @param string|null            $name          The name of the command
     * @param StringInterface        $string        A string object
     * @param TimeExecutionInterface $executionTime A time execution object
     * @param FileInterface          $file          A file object
     */
    public function __construct(
            $name, 
            StringInterface $string, 
            TimeExecutionInterface $executionTime,
            FileInterface $file
    ) {
        parent::__construct(null);
        
        $this->executionTime = $executionTime;
        $this->file          = $file;
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
                        'The initial string you try to replace'
                  )
                ->addArgument(
                        'final', 
                        InputArgument::REQUIRED,
                        'The final string which replace the initial'
                    )
                ->addArgument(
                        'file', 
                        InputArgument::REQUIRED,
                        'Your file or directory'
                    );
    }
    
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getArgument('file');
        $initial  = $input->getArgument('initial');
        $final    = $input->getArgument('final');
        
        $searchReplace = new SearchReplace($this->file, $initial, $final);
        
        $this->executionTime->setBegin(0);
        $this->executionTime->setEnd(0);
        $this->executionTime->setDuration(0);
        $this->executionTime->start();
        $searchReplace->searchReplace($fileName, $output);
        $this->executionTime->stop();
        
        $message              = '<comment>No file are done</comment>';
        $numberOfFilesSuccess = $this->file->getCountFiles();
        
        if ( $numberOfFilesSuccess > 0) {
            $message = '<comment>' . $numberOfFilesSuccess . ' files are done in ' 
                . $this->executionTime->getDuration() . ' secondes.</comment>';
        }
                
        $output->writeln($message);
    }
}