<?php
   class addPageDataLink
   {
       function addPageDataLink()
       {
            $replace = file_get_contents($catalogPath . "\\home.htm");
            $replace = str_replace("<script src=..\shared\scripts\pageData.js></script>", '', $replace);
            file_put_contents($catalogPath . "\\home.htm", $replace);  
        
            file_put_contents($catalogPath . "\\home.htm","<script src=..\shared\scripts\pageData.js></script>",FILE_APPEND);
            echo " A link was attached to 'home.htm'";
       }
   
   }
?>