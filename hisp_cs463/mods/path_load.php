<?php 


$display = $_GET['disp'];

switch($display)
{
    case "m";
    include("$serverroot/mods/main_page.php");
    break; 

    case "about";
    include("$serverroot/mods/about.php");
    break; 
   

    case "Data";
    include("$serverroot/mods/parser.php");
    break; 

    case "login";
    include("$serverroot/mods/login.php");
    break; 
    
    case "loginp";
    include("$serverroot/mods/parser.php");
    break; 

    case "logout";
    include("$serverroot/mods/logout.php");
    break; 

    case "hispdata";
    include("$serverroot/mods/hispdata.php");
    break; 

    case "pdata";
    include("$serverroot/mods/parser.php");
    break; 

Default;
include("$serverroot/mods/main_page.php");

}

?>
