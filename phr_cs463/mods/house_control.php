<?php

$device       = "/dev/ttyUSB0";
$command      = "n";
$switch_loc   = $_GET['loc'];
$switch_state = $_GET['state'];
$commit       = $_GET['set'];


if(($commit == 1)&& isset($switch_state) && isset($switch_loc))
{


    switch($switch_loc)
    {
    case 'attic':
	if($switch_state == 0)
	    $command = 'a';
	else
	    $command = 'b';
	break;


    case 'livingroom':
	if($switch_state == 0)
	    $command = 'c';
	else
	    $command = 'd';
	break;

    case 'bedroomlamp':
	if($switch_state == 0)
	    $command = 'e';
	else
	    $command = 'f';
	break;

    case 'bedroomfan':
	if($switch_state == 0)
	    $command = 'g';
	else
	    $command = 'h';
	break;

    case 'kitchen':
	if($switch_state == 0)
	    $command = 'i';
	else
	    $command = 'j';
	break;

    case 'restroom':
	if($switch_state == 0)
	    $command = 'k';
	else
	    $command = 'l';
	break;

    case 'all':
	if($switch_state == 0)
	    $command = 'm';
	else
	    $command = 'n';
	break;

    default:
    }
    $complete_command = "echo $command > $device";
    shell_exec("$complete_command");
}

$device_stat  = fopen("/var/www/solarhouse/py/stat.dat", "r");
sleep(1);

$parse_floors = fgets($device_stat, 8);
echo("$parse_floors");





//the following objects are passed to ./mods/socket_control.php which will 
//modify the sockets to run

echo "<table class='sidebox'>";

//loc = attic state={1 for on, 0 for off}
echo "<tr><td rowspan='8'><img src='./imgs/house_schematic.png'></td>
    <td><strong>1.</strong> Attic Lights</td>
    <td>";
if (strpos($parse_floors, 'a'))
echo "<a href='index.php?disp=panel&loc=attic&state=1&set=1'><img height = '35px' src='./imgs/on.png'></a>";
echo"</td>";
echo "<td>";
if (strpos($parse_floors, 'b'))
    echo"<a href='index.php?disp=panel&loc=attic&state=0&set=1' ><img height = '35px' src='./imgs/off.png'></a>";
echo "</td></tr>";

//loc = livingroom state={1 for on, 0 for off}
echo "<tr><td><strong>2.</strong>Livingroom Lights</td>
    <td><a href='index.php?disp=panel&loc=livingroom&state=1&set=1'><img height = '35px' src='./imgs/on.png'></a></td>";
echo "<td><a href='index.php?disp=panel&loc=livingroom&state=0&set=1'><img height = '35px' src='./imgs/off.png'></a></td></tr>";



//loc = bedroomlamp state={1 for on, 0 for off}
echo "<tr><td><strong>3.</strong>Bedroom Lights</td>
    <td><a href='index.php?disp=panel&loc=bedroomlamp&state=1&set=1'><img height = '35px' src='./imgs/on.png'></a></td>";
echo "<td><a href='index.php?disp=panel&loc=bedroomlamp&state=0&set=1'><img height = '35px' src='./imgs/off.png'></a></td></tr>";


//loc = bedroomfan state={1 for on, 0 for off}
echo "<tr><td><strong>3.</strong>Bedroom Fan</td>
    <td><a href='index.php?disp=panel&loc=bedroomfan&state=1&set=1'><img height = '35px' src='./imgs/on.png'></a></td>";
echo "<td><a href='index.php?disp=panel&loc=bedroomfan&state=0&set=1'><img height = '35px' src='./imgs/off.png'></a></td></tr>";


//loc = kitchen state={1 for on, 0 for off}
echo "<tr><td><strong>4.</strong>Kitchen Lights</td>
    <td><a href='index.php?disp=panel&loc=kitchen&state=1&set=1'><img height = '35px' src='./imgs/on.png'></td>";
echo "<td><a href='index.php?disp=panel&loc=kitchen&state=0&set=1'><img height = '35px' src='./imgs/off.png'></td></tr>";


//loc = restroom state={1 for on, 0 for off}
echo "<tr><td><strong>5.</strong>Restroom Lights</td>
    <td><a href='index.php?disp=panel&loc=restroom&state=1&set=1'><img height = '35px' src='./imgs/on.png'></td>";
echo "<td><a href='index.php?disp=panel&loc=restroom&state=0&set=1'><img height = '35px' src='./imgs/off.png'></td></tr>";


//loc = all state={1 for on, 0 for off}
echo "<tr><td><strong></strong>Entire House</td>
    <td><a href='index.php?disp=panel&loc=all&state=1&set=1'><img height = '35px' src='./imgs/on.png'></td>";

echo "<td><a href='index.php?disp=panel&loc=all&state=0&set=1'><img height = '35px' src='./imgs/off.png'></td></tr>";
echo "</table>";

fclose($device_stat);

?>
    
