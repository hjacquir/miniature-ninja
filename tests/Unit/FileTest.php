<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 18 déc. 2013
 * Time: 18:32:43
 */

namespace Hj\Tests\Unit;

use \Exception;
use \Hj\File;
use \Hj\String;
use \PHPUnit_Framework_MockObject_MockObject;
use \PHPUnit_Framework_TestCase;

require_once '../..../../../vendor/autoload.php';

/**
 * @covers \Hj\File
 */
class FileTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var File
     */
    private $file;
    
    /**
     *
     * @var String|PHPUnit_Framework_MockObject_MockObject
     */
    private $string;
    
    public function setUp()
    {
         $this->string = $this->getMock('Hj\StringInterface');
    }
    
    /**
     * @param string $fileName
     * 
     * @return File
     */
    private function getFile($fileName)
    {
        $this->file = new File($fileName, $this->string);
        
        return $this->file;
    }

    public function testShouldBeAFileInterface()
    {
        $fileName = '../Fixtures/test.php';
        // assert that the file exist
        $this->assertTrue(file_exists($fileName));
        $this->assertInstanceOf(
                'Hj\FileInterface', 
                $this->getFile($fileName)
        );
    }
    
    public function testShouldReplaceExistingStringInExistingFile()
    {
        $fileName2 = '../Fixtures/test2.php';
        $fileName3 = '../Fixtures/test3.php';
        // assert that the files exists
        $this->assertTrue(file_exists($fileName2));
        $this->assertTrue(file_exists($fileName3));
        
        $file2 = $this->getFile($fileName2);
        $file3 = $this->getFile($fileName3);
        
        $contentString2 = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string before change';\n";
        $contentString3 = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string after change';\n";
        
        file_put_contents($file2, $contentString2);
        file_put_contents($file3, $contentString3);
        
        $this->string->expects($this->any())
                ->method('getReplacedString')
                ->will($this->returnValue('before'));
        // assert that the file contains the initial string 
        $this->assertGreaterThan(0, (strpos($contentString2, 'before')));
        
        $this->string->expects($this->any())
                ->method('getStringReplacement')
                ->will($this->returnValue('after'));
        
        $file2->doReplaceInAllFile();
        
        $this->assertSame(
                file_get_contents($file2),
                file_get_contents($file3)
        );
    }
    
    /**
     * @expectedException        Exception
     * @expectedExceptionMessage The file [zezerr.rer] should not exist
     */
    public function testShouldThrowAnExceptionWhenTheFileDoNotExist()
    {
       $fileName = 'zezerr.rer';
       // assert that the file not exist
       $this->assertFalse(file_exists($fileName));
       $this->getFile($fileName);
    }
    
    /**
     * @expectedException        Exception
     * @expectedExceptionMessage The string [zererz] was not found in ../Fixtures/test.php
     */
    public function testShouldThrowAnExceptionWhenTheInitialStringDoNoExist()
    {
        $fileName = '../Fixtures/test.php';
        $this->assertTrue(file_exists($fileName));
        
        $file = $this->getFile($fileName);
        $fileGetContent = file_get_contents($file);
        
        $this->string->expects($this->any())
                ->method('getReplacedString')
                ->will($this->returnValue('zererz'));
        $this->string->expects($this->any())
                ->method('getStringReplacement')
                ->will($this->returnValue('after'));
        
        $file->replaceTheString($fileGetContent);
    }
    
     /**
     * @expectedException        Exception
     * @expectedExceptionMessage The string [zererz] was not found in ../Fixtures/test.php
     */
    public function testShouldThrowAnExceptionWhenTheInitialStringDoNoExistWhenTryToReplace()
    {
        $fileName = '../Fixtures/test.php';
        $this->assertTrue(file_exists($fileName));
        
        $file = $this->getFile($fileName);
        $fileGetContent = file_get_contents($file);
        
        $this->string->expects($this->any())
                ->method('getReplacedString')
                ->will($this->returnValue('zererz'));
        
        $this->assertFalse(strpos($fileGetContent, 'zererz'));
        
        $this->string->expects($this->any())
                ->method('getStringReplacement')
                ->will($this->returnValue('after'));
        
        $file->doReplaceInAllFile();
    }
}