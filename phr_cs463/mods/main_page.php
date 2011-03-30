<?php
echo "<div class='tempcolor'>";
if($_SESSION['loggedin']!= 1)
{
    echo "<p>Welcome,<br/>Please <a href='./index.php?disp=login'>login</a><p>";
}else
{
echo "You are currently logged in";
}
echo "</div>";
?>
