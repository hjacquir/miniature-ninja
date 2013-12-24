<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 18 déc. 2013
 * Time: 18:32:43
 */

namespace Hj\Tests\Unit;

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
        $this->assertInstanceOf(
                'Hj\FileInterface', 
                $this->getFile('../Fixtures/test.php')
        );
    }
    
    public function testShouldReplaceInAllFile()
    {
        $file2 = $this->getFile('../Fixtures/test2.php');
        $file3 = $this->getFile('../Fixtures/test3.php');
        
        $contentString2  = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string before change';\n";
        $contentString3 = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string after change';\n";
        
        file_put_contents($file2, $contentString2);
        file_put_contents($file3, $contentString3);
        
        $this->string->expects($this->any())
                ->method('getReplacedString')
                ->will($this->returnValue('before'));
        $this->string->expects($this->any())
                ->method('getStringReplacement')
                ->will($this->returnValue('after'));
        
        $file2->doReplaceInAllFile();
        
        $this->assertSame(
                file_get_contents($file2),
                file_get_contents($file3)
        );
    }
}