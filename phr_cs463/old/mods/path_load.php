<?php 


$display = $_GET['disp'];

switch($display)
{
    case "m";
    include("$serverroot/mods/main_page.php");
    break; 

    case "view";
    include("$serverroot/mods/view_company.php");
    break; 

    case "login";
    include("$serverroot/mods/login.php");
    break; 

Default;
include("$serverroot/mods/main_page.php");

}

?>
