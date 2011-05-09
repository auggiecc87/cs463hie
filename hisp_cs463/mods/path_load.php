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

    case "fetchpatient";
    include("$serverroot/mods/fetch_patient.php");
    break; 

    case "editpatient";
    include("$serverroot/mods/edit_patient.php");
    break;

    case "newpatient";
    include("$serverroot/mods/new_patient.php");
    break;

    case "allow";
    include("serverroot/mods/allow_update.php");
    break;

Default;
include("$serverroot/mods/main_page.php");

}

?>
