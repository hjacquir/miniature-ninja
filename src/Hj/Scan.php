<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 18 déc. 2013
 * Time: 18:15:53
 */

namespace Hj;

/**
 * Used to browse the file
 */
class Scan
{
    /**
     * @param FileInterface   $file
     * @param StringInterface $string
     */
    public function doReplaceInAllFile(
            FileInterface   $file, 
            StringInterface $string 
    )
    {
        $fileGetContent = file_get_contents($file);
        $filePutContent = $this->replaceTheString($string, $fileGetContent);
        
        file_put_contents($file, $filePutContent);
    }
    
    /**
     * @param String $string
     * @param string $content
     * 
     * @return string
     */
    private function replaceTheString(String $string, $content)
    {
        $str = str_replace(
                $string->getReplacedString(), 
                $string->getStringReplacement(), 
                $content
        );
        
        return $str;
    }
 }