<?php

  class pageDB
  {
      function createPageDB()
      {
        $links3=["a"];
        $catalogName = $_SESSION["catalogName"];
        $catalogPath = $_SESSION["catalogPath"];
        $directory = '..\..\page';
        $myArray=array();
        
        $di = new RecursiveDirectoryIterator($directory);
    
        foreach (new RecursiveIteratorIterator($di) as $filename => $file) 
        {   
            if($filename != false && $filename != "..\..\page\." && $filename != "..\..\page\.." )
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
    
  }
?>