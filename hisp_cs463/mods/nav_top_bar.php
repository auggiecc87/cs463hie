<?php
echo "<div class= 'LRPanel'>";
echo "<div id = 'top_nav_bar'>";
echo "<a href = './index.php?disp=m'>Home</a>";
if (($_SESSION['loggedin']) != 1)
{
echo " | ";
echo "<a href = './index.php?disp=login'>Login</a>";
}
echo " | ";
echo "<a href = './index.php?disp=about'>About</a>";

if (($_SESSION['loggedin']) == 1)
{
	echo " | ";
	echo "<a href= './index.php?disp=Data'> Patient Data</a>";
	echo " | ";
	echo "<a href= './index.php?disp=Data'> Health Care Provider Data</a>";
	echo " | ";
	echo "<a href = './index.php?disp=logout'>Logout</a>";
} 
echo "</div>";
echo "</div>";


?>
