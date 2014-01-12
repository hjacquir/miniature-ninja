<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 3 janv. 2014
 * Time: 19:08:05
 */

namespace Hj\Tests\Functional;

use \Hj\Explore;
use \Hj\File;
use \Hj\String;
use \Hj\TimeExecution;
use \PHPUnit_Framework_TestCase;
use \Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

require_once '../../vendor/autoload.php';

/**
 * @covers \Hj\Explore
 */
class ExploreTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $commandName;
    
    /**
     * @var CommandTester
     */
    private $commandTester;
    
    public function setUp()
    {
        $application   = new Application();
        $application->add(new Explore());
        
        $command = $application->find('s:r');
        $this->commandName = $command->getName();
        
        $this->commandTester = new CommandTester($command);
    }
    
    public function testExecuteForAFile()
    {
        $fileName = '../Fixtures/Explore/FileForTestingExploreClass.php';
        $this->assertTrue(file_exists($fileName));
        
        $initialContent = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n" . 
                " * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string before change';\n";
        file_put_contents($fileName, $initialContent);
        
        $input = array(
            'command' => $this->commandName,
            'file'    => $fileName,
            'initial' => 'before',
            'final'   => 'after',
        );
        
        $this->commandTester->execute($input);
        
        $output = 'The string [before] was succesfully replaced by [after] in ../Fixtures/Explore/FileForTestingExploreClass.php' .
                "\n" . '1 files are done in ';
        $this->assertContains($output, $this->commandTester->getDisplay());
    }
    
     public function testExecuteForADirectory()
    {
        $fileName = '../Fixtures/Explore/';
        $this->assertTrue(is_dir($fileName));
        $initialContent = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n" . 
                " * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string before change';\n";
        
        file_put_contents('../Fixtures/Explore/FileForTestingExploreClass.php', $initialContent);
        file_put_contents('../Fixtures/Explore/FileForTestingExploreClass2.php', $initialContent);
        
        $input = array(
            'command' => $this->commandName,
            'file'    => $fileName,
            'initial' => 'before',
            'final'   => 'after',
        );
        
        $this->commandTester->execute($input);
        
        $output = 'The string [before] was succesfully replaced by [after] in ../Fixtures/Explore/FileForTestingExploreClass.php' . "\n" .
                'The string [before] was succesfully replaced by [after] in ../Fixtures/Explore/FileForTestingExploreClass2.php' . "\n". 
                '2 files are done in ';
        $this->assertContains($output, $this->commandTester->getDisplay());
    }
    
    public function testShouldReturnAnExceptionErrorMessageWhenTheFileDoNotExist()
    {
        $fileName = '../qsdqdsdq/';
        $this->assertFalse(is_dir($fileName));
        
        $initialContent = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n" . 
                " * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string before change';\n";
        file_put_contents('../Fixtures/Explore/FileForTestingExploreClass.php', $initialContent);
        
        $input = array(
            'command' => $this->commandName,
            'file'    => $fileName,
            'initial' => 'before',
            'final'   => 'after',
        );
        
        $this->commandTester->execute($input);
        
        $output = 'The file or directory [../qsdqdsdq/] should not exist' . "\n" . 'No file are done';
        $this->assertContains($output, $this->commandTester->getDisplay());
        
    }
    
    public function testShouldReturnAnExceptionErrorMessageWhenTheStringDoNotExist()
    {
        $fileName = '../Fixtures/Explore/FileForTestingExploreClass.php';
        $this->assertTrue(file_exists($fileName));
        
        $initialContent = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n" . 
                " * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string before change';\n";
        file_put_contents('../Fixtures/Explore/FileForTestingExploreClass.php', $initialContent);
        
        $input = array(
            'command' => $this->commandName,
            'file'    => $fileName,
            'initial' => 'sdfds',
            'final'   => 'after',
        );
        
        $this->commandTester->execute($input);
        
        $output = 'The string [sdfds] was not found in ../Fixtures/Explore/FileForTestingExploreClass.php' . "\n\n" . 'No file are done';
        $this->assertContains($output, $this->commandTester->getDisplay()); 
    }
}
