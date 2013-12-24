<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 18 déc. 2013
 * Time: 18:32:43
 */

namespace Hj\Tests\Unit;

use \Hj\File;
use \PHPUnit_Framework_TestCase;

require_once '../..../../../vendor/autoload.php';

/**
 * @covers \Hj\File
 */
class FileTest extends PHPUnit_Framework_TestCase
{
    public function testShouldBeAFileInterface()
    {
        $fileName   = '../Fixtures/test.php';
        $this->file = new File($fileName);
        
        $this->assertInstanceOf('Hj\FileInterface', $this->file);
    }
}