<?php 


//When a user visits this website they will be able to control the doll house
//by selecting hot maps on the machine

echo "<p>testing</p>";
$command = ("echo n >> /dev/ttyUSB0");
$output = shell_exec($command);
//shell_exec("echo 'm' > /dev/ttyUSB0");
//shell_exec("echo 'a' > /dev/ttyUSB0");

echo "$output";



?>
