<?php
echo "<div class= 'LRPanel'>";
echo "<div id = 'top_nav_bar'>";
echo "<a href = './index.php?disp=m'>Home</a>";
echo " | ";
echo "<a href = './index.php?disp=login'>Login</a>";
if (isset($_SESSION['netid']))
{
echo " | ";
echo "<a href = './index.php?disp=panel'>Control Panel</a>";
}

if (($_SESSION['LOGGED_IN']) == 1)
{
echo " | ";
	echo "<a href = './index.php?disp=l'>Logout</a>";
} 
echo "</div>";
echo "</div>";


?>
