<?php
echo "<div class='tempcolor'>";
if ($_SESSION['VALID'] == 1)
{
$user_name = $_SESSION['USERNAME'];
    echo "<p>Welcome Home $user_name<p>";

}else
{
    echo "<p>Welcome Home,<br/>Please <a href='./index.php?disp=login'>login</a> to control the energy settings<p>";

}
echo "</div>";
?>
