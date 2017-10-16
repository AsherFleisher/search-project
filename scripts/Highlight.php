<?php

class highlight
{
    function highlight()
    {
        $directory = '..\..\page';
        $myArray=array();
        
        $di = new RecursiveDirectoryIterator($directory);
    
        foreach (new RecursiveIteratorIterator($di) as $filename => $file) 
        {   
            if($filename != false && $filename != "..\..\page\." && $filename != "..\..\page\.." )
            {
                $replace = file_get_contents($filename);
                $replace = str_replace("<script src='../shared/scripts/highlight.js'></script>", '', $replace);
                file_put_contents($filename, $replace);  
            
               file_put_contents($filename,"<script src='../shared/scripts/highlight.js'></script>",FILE_APPEND);
    
               $replace = file_get_contents($filename);
               $replace = str_replace("<body>", "<body onload='highlight()'>", $replace);
               file_put_contents($filename, $replace);  
            }
        }
    }  
    
}
    
?>