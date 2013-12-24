<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 22 déc. 2013
 * Time: 14:18:57
 */

namespace Hj\Tests\Functional;

use \Hj\File;
use \Hj\Scan;
use \Hj\String;
use \PHPUnit_Framework_TestCase;

require_once '../../vendor/autoload.php';

/**
 * @covers Hj\Scan
 */
class ScanTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
       $file  = new File('../Fixtures/test2.php', 'c+');
       $file2 = new File('../Fixtures/test3.php', 'c+');
       
       $contentString  = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string before change';\n";
       $contentString2 = "<?php\n\n/* Created by Hatim Jacquir\n * User: Hatim Jacquir <jacquirhatim@gmail.com>\n * Date: 22 déc. 2013\n * Time: 15:06:25\n */\n\necho 'I am a string after change';\n";
       file_put_contents($file, $contentString);
       file_put_contents($file2, $contentString2);
    }

    public function testShouldReplaceTheStringInAllFile()
    {
        $scan  = new Scan();
        $file  = new File('../Fixtures/test2.php', 'c+');
        $file2 = new File('../Fixtures/test3.php', 'c+');
                
        $string = new String();
        $string->setReplacedString('before');
        $string->setStringReplacement('after');
        
        $scan->doReplaceInAllFile($file, $string);
        
        $this->assertSame(
                file_get_contents($file2), 
                file_get_contents($file)
        );
    }
}
