<?php
if($_SESSION['loggedin']== 1)
{
echo "<p>You have been logged out of the system, have a good day</p>";
session_destroy();
}
else
{
include("$serverroot/mods/login.php");

}

?>
