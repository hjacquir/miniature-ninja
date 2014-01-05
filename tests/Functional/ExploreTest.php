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
    public function testExecute()
    {
        $application   = new Application();
        $string        = new String();
        $executionTime = new TimeExecution();
        $file          = new File();
        
        $application->add(new Explore(null, $string, $executionTime, $file));
        
        $command = $application->find('s:r');
        
        $commandTester = new CommandTester($command);
        
        $fileName = '../Fixtures/FileForTestingExploreClass.php';
        $this->assertTrue(file_exists($fileName));
        $initialContent = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string before change';\n";
        file_put_contents($fileName, $initialContent);
        
        $input = array(
            'command' => $command->getName(),
            'file'    => $fileName,
            'initial' => 'before',
            'final'   => 'after',
        );
        $output = 'The string [before] was succesfully replaced by [after] in ../Fixtures/FileForTestingExploreClass.php';
        $commandTester->execute($input);
        
        $this->assertContains($output, $commandTester->getDisplay());
    }
}
