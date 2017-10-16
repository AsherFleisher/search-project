<?php
session_start();
   class catalogDB
   {
    function createCatalogDB()
    {
        $links3=["a"];
        $catalogName = $_SESSION["catalogName"];
        $catalogPath = $_SESSION["catalogPath"];
        $directory = '..\..\page';
        $myArray=array();
        
        $di = new RecursiveDirectoryIterator($catalogPath);
        foreach (new RecursiveIteratorIterator($di) as $filename => $file)
        {
            if($filename != false && $filename != "..\..\page\." && $filename != "..\..\page\.." )
            {
                $html = file_get_contents($filename);
                
                        $dom = new DOMDocument;
                
                        @$dom->loadHTML($html);
                
                        $links2 = $dom->getElementsByTagName('a');
                
                        foreach ($links2 as $link2)
                        {
                            $link4=$link2->getAttribute('href');
                            
                            $go= array( "link" => $link4);
                
                            array_push($links3,$go);
                        }
                    }
            }
            if (file_exists(".\\" . $catalogName . ".js")) {
                unlink(".\\" . $catalogName . ".js");
                $links3 = "var catalogData = " . json_encode($links3);
                $handle = fopen(".\\" . $catalogName . ".js", "a");
                fwrite($handle, $links3);
                
                    $replace = file_get_contents($catalogPath . "\\home.htm");
                    $replace = str_replace("<script src=..\shared\scripts\\"   . $catalogName . ".js></script>", '', $replace);
                    file_put_contents($catalogPath . "\\home.htm", $replace);  
                
                file_put_contents($catalogPath . "\\home.htm","<script src=..\shared\scripts\\"   . $catalogName . ".js></script>",FILE_APPEND);
                
            } 
            else{
                $links3 = "var catalogData = " . json_encode($links3);
                $handle = fopen(".\\" . $catalogName . ".js", "a");
                fwrite($handle, $links3);
                
                    $replace = file_get_contents($catalogPath . "\\home.htm");
                    $replace = str_replace("<script src=..\shared\scripts\\"   . $catalogName . ".js></script>", '', $replace);
                    file_put_contents($catalogPath . "\\home.htm", $replace);  
                
                file_put_contents($catalogPath . "\\home.htm","<script src=..\shared\scripts\\"   . $catalogName . ".js></script>",FILE_APPEND);
            }    
            echo "Catalog data was created and a link was attached"; 
    }
    
   }
?>