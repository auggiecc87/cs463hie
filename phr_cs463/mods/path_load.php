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
   

    case "panel";
    include("$serverroot/mods/house_control.php");
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
    
Default;
include("$serverroot/mods/main_page.php");

}

?>
