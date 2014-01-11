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
    public function __construct() 
    {
        parent::__construct(null);
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
        
        $searchReplace = new SearchReplace($initial, $final);

        $timeExecution = new TimeExecution();
        $timeExecution->setBegin(0);
        $timeExecution->setEnd(0);
        $timeExecution->setDuration(0);
        $timeExecution->start();
        
        $numberOfFilesSuccess = $searchReplace->searchReplace($fileName, $output);
        
        $timeExecution->stop();
        
        $message = '<comment>No file are done</comment>';
        
        if ( $numberOfFilesSuccess > 0) {
            $message = '<comment>' . $numberOfFilesSuccess . ' files are done in ' 
                . $timeExecution->getDuration() . ' secondes.</comment>';
        }
                
        $output->writeln($message);
    }
}