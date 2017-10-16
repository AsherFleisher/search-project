<?php
session_start();
error_reporting(0); //stop error report
require_once "addPageDataLink.php";
require_once "catalogDB.php";
require_once "pageDB.php";
require_once "Highlight.php";

 $links3=["a"];
 $action = $_POST["action"];
 $catalogName = $_POST["catalogName"];
 $catalogPath = $_POST["catalogPath"];
 $catalogPath = "..\\..\\" . $catalogPath;
 $_SESSION["catalogName"] = $catalogName;
 $_SESSION["catalogPath"] = $catalogPath;

if($action === "pageDB")
{
    $go = new pageDB;
    $go->createPageDB();
}    
if($action === "catalogDB")
{
    $go = new catalogDB;
    $go->createCatalogDB();       
}

if($action === "addPageDataLink")
{
    $go = new addPageDataLink;
    $go->addPageDataLink();
}

if($action === "highlight")
{
    $go = new highlight;
    $go->highlight();
}
?>
