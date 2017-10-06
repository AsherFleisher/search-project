<?php
error_reporting(0); //stop error report
 $links3=["a"];
 $action = $_POST["action"];
 $catalogName = $_POST["catalogName"];
 $catalogPath = $_POST["catalogPath"];
 $catalogPath = "..\..\\" . $catalogPath;

if($action === "pageDB")
{
    $directory = '..\..\page';
    $myArray=array();
    
    $di = new RecursiveDirectoryIterator($directory);

    foreach (new RecursiveIteratorIterator($di) as $filename => $file) 
    {   
        if(file_get_contents($filename)!= false)
        {
            $title2=[];
            $table2=[];
            $html = file_get_contents($filename);
            $dom = new DOMDocument;
            @$dom->loadHTML($html);
            
            $titles = $dom->getElementsByTagName('h1');
            $tables = $dom->getElementsByTagName("td");
            $images = $dom->getElementsByTagName("img")[0];
            if($images !=null)
            $image2 = $images->getAttribute('src');
                foreach ($titles as $title)
                { 
                         array_push($title2,$title->textContent);
                        // $title2 = $title->textContent;
                        
                }        
                        
                        foreach ($tables as $table) 
                        { 
                            array_push($table2,$dom->saveHTML($table));
                            // $table2 = $dom->saveHTML($table);
                            
                        }
                            $table2=implode("|",$table2);
                            $title2=implode("|",$title2);
                            $link =   $filename;
                            $go= array( "title" => $title2, "link" => $link, "table"=>$table2,"image"=>$image2 );
                                    
                             array_push($links3,$go);               
        }                  
    }
    if (file_exists(".\pageData.js")) {
        unlink(".\pageData.js");
        $links3 = "var pageData = " . json_encode($links3);
        $handle = fopen(".\pageData.js", "a");
        fwrite($handle, $links3);
    }
    else{
        $links3 = "var pageData = " . json_encode($links3);
        $handle = fopen(".\pageData.js", "a");
        fwrite($handle, $links3);
    }
    
    echo "Page data was created NO LINK WAS ATTACHED";     
}    
if($action === "catalogDB")
{
    $di = new RecursiveDirectoryIterator($catalogPath);
    foreach (new RecursiveIteratorIterator($di) as $filename => $file)
    {
        if(file_get_contents($filename)!="" && file_get_contents($filename)!= "."&&file_get_contents($filename)!=".")
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
                $replace = str_replace("<script src=..\..\shared\scripts\\"   . $catalogName . ".js></script>", '', $replace);
                file_put_contents($catalogPath . "\\home.htm", $replace);  
            
            file_put_contents($catalogPath . "\\home.htm","<script src=..\..\shared\scripts\\"   . $catalogName . ".js></script>",FILE_APPEND);
            
        } 
        else{
            $links3 = "var catalogData = " . json_encode($links3);
            $handle = fopen(".\\" . $catalogName . ".js", "a");
            fwrite($handle, $links3);
            
                $replace = file_get_contents($catalogPath . "\\home.htm");
                $replace = str_replace("<script src=..\..\shared\scripts\\"   . $catalogName . ".js></script>", '', $replace);
                file_put_contents($catalogPath . "\\home.htm", $replace);  
            
            file_put_contents($catalogPath . "\\home.htm","<script src=..\..\shared\scripts\\"   . $catalogName . ".js></script>",FILE_APPEND);
        }    
        echo "Catalog data was created and a link was attached";         
}

if($action === "addLink")
{
    $replace = file_get_contents($catalogPath . "\\home.htm");
    $replace = str_replace("<script src=..\..\shared\scripts\pageData.js></script>", '', $replace);
    file_put_contents($catalogPath . "\\home.htm", $replace);  

    file_put_contents($catalogPath . "\\home.htm","<script src=..\..\shared\scripts\pageData.js></script>",FILE_APPEND);
    echo " A link was attached to 'home.htm'";
}



?>