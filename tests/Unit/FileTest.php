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
         $this->file   = new File();
    }

    public function testShouldBeAFileInterface()
    {
        $this->assertInstanceOf('Hj\FileInterface', $this->file);
    }
    
    public function testShouldCountFilesEqualsToZeroOnConstruct()
    {
        $this->assertEquals(0, $this->file->getCountFiles());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage The file or directory [zzz] should not exist
     */
    public function testShouldThrowAnExceptionWhenTheFileNotExist()
    {
        $this->assertFalse(file_exists('zzz'));
        
        $this->file->setFileName('zzz');
    }
    
    public function testShouldReturnTheCorrectFileNameWhenTheFileExist()
    {
        $fileName = '../Fixtures/FileForTestingFileClass.php';
        
        $this->assertTrue(file_exists($fileName));
        $this->file->setFileName($fileName);
        $this->assertSame($fileName, $this->file->getFileName());
    }
    
    public function testShouldReturnAnStringObject()
    {
        $this->file->setString($this->string);
        $this->assertInstanceOf('Hj\StringInterface', $this->file->getString());
    }
    
    public function testShouldReplaceWhenTheFileExistAndTheStringExist()
    {
        $fileNameInitial = '../Fixtures/FileForTestingFileClassWithInitialString.php';
        $fileNameFinal   = '../Fixtures/FileForTestingFileClassWithFinalString.php';
        
        //assert that the files exists
        $this->assertTrue(file_exists($fileNameInitial));
        $this->assertTrue(file_exists($fileNameFinal));
        
        $contentStringInitial = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string before change';\n";
        $contentStringFinal   = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string after change';\n";
        
        file_put_contents($fileNameInitial, $contentStringInitial);
        file_put_contents($fileNameFinal, $contentStringFinal);
        
        $this->string->expects($this->any())
                ->method('getReplacedString')
                ->will($this->returnValue('before'));
        $this->string->expects($this->any())
                ->method('getStringReplacement')
                ->will($this->returnValue('after'));
        
        // assert that the file contains the initial string 
        $this->assertGreaterThan(0, (strpos($contentStringInitial, 'before')));
        
        $this->file->setFileName($fileNameInitial);
        $this->file->setString($this->string);
        $this->file->doReplaceInAllFile();
        
        $this->assertSame(file_get_contents($fileNameFinal), file_get_contents($fileNameInitial));
    }
    
    /**
     * @expectedException        Exception
     * @expectedExceptionMessage The string [zzzzee] was not found in ../Fixtures/FileForTestingFileClassWithInitialString.php
     */
    public function testShouldThrowAnExceptionWhenTheFileExistAndTheStringDoNotExist()
    {
        $fileNameInitial = '../Fixtures/FileForTestingFileClassWithInitialString.php';
        $fileNameFinal   = '../Fixtures/FileForTestingFileClassWithFinalString.php';
        
        //assert that the files exists
        $this->assertTrue(file_exists($fileNameInitial));
        $this->assertTrue(file_exists($fileNameFinal));
        
        $contentStringInitial = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string before change';\n";
        $contentStringFinal   = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string after change';\n";
        
        file_put_contents($fileNameInitial, $contentStringInitial);
        file_put_contents($fileNameFinal, $contentStringFinal);
        
        $this->string->expects($this->any())
                ->method('getReplacedString')
                ->will($this->returnValue('zzzzee'));
        $this->string->expects($this->any())
                ->method('getStringReplacement')
                ->will($this->returnValue('after'));
        
        // assert that the file contains the initial string 
        $this->assertGreaterThan(0, (strpos($contentStringInitial, 'before')));
        
        $this->file->setFileName($fileNameInitial);
        $this->file->setString($this->string);
        $this->file->doReplaceInAllFile();
        
        $this->assertSame(file_get_contents($fileNameFinal), file_get_contents($fileNameInitial));
    }
}