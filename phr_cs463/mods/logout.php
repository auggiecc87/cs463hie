<?php
if($_SESSION['VALID']== 1)
{
$uname = $_SESSION['USERNAME'];
echo "<p>$uname, you have been logged out of the system, have a good day</p>";
session_destroy();
}
else
{
include("$serverroot/mods/login.php");

}

?>
