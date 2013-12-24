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
 * Comsole command to put the file
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
        $initial = $input->getArgument('initial');
        $final = $input->getArgument('final');
        
        $scan = new Scan();
        $file = new File($fileName, 'c+');
        $string = new String();
        $string->setReplacedString($initial);
        $string->setStringReplacement($final);
        $scan->doReplaceInAllFile($file, $string);
        
    }
}
