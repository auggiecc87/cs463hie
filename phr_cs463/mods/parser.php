<?php
$phruname = $_POST['user'];
$phrpwd   = $_POST['pwd'];


//Authorize the PHR
//
Tools::InitMysql();
$login_query = "Select * FROM PHR_AUTH WHERE uname = '$phruname' 
    AND active = '1'";


$login_results = Tools::Query($login_query);

while($row = mysql_fetch_array($login_results))
{
    if(md5($phrpwd)==$row['passwd'])
    {
        $_SESSION['session_pid_auth'] = $row['pid_auth'];
        $_SESSION['first_name']       = $row['fname'];
        $_SESSION['last_name']        = $row['lname'];
        $_SESSION['PHR_ID']           = $row['PHR_ID'];
        $_SESSION['key']              = $row['decryptkey'];
        $_SESSION['dstore_uname']     = $row['dstore_uname'];
        $_SESSION['dstorepwd']        = $row['dstorepwd'];
        $_SESSION['loggedin']         = '1';

    }else
    { 
        echo "Wrong login information";
    }



}

echo  $_SESSION['session_pid_auth']; 
echo  $_SESSION['first_name'];       
echo  $_SESSION['last_name'];        
echo  $_SESSION['PHR_ID'];           
echo  $_SESSION['dstore_uname'];     
echo  $_SESSION['dstorepwd'];        

?>

