<?php
$hispuname = $_POST['user'];
$hisppwd   = $_POST['pwd'];
$patient_pid = $_POST['uid'];


//Authorize the HISP
//
Tools::InitMysql();
$login_query = "Select * FROM HISP_AUTH WHERE uname = '$hispuname' 
    AND active = '1'";


$login_results = Tools::Query($login_query);

while($row = mysql_fetch_array($login_results))
{
    if(md5($hisppwd)==$row['passwd'])
    {
        $_SESSION['session_pid_auth'] = $row['pid_auth'];
        $_SESSION['first_name']       = $row['fname'];
        $_SESSION['last_name']        = $row['lname'];
        $_SESSION['HISP_ID']           = $row['HISP_ID'];
        $_SESSION['key']              = $row['decryptkey'];
        $_SESSION['dstore_uname']     = $row['dstore_uname'];
        $_SESSION['dstorepwd']        = $row['dstorepwd'];
        $_SESSION['loggedin']         = '1';
        $_SESSION['iv']               = $row['iv'];
        $_SESSION['role']             = $row['hisp_type'];

    }else
    { 
        echo "Wrong login information";
    }



}

if($_SESSION['loggedin'] == 1)
{
    $datastore_server = "127.0.0.1:3307";
    $datastoreuname = $_SESSION['dstore_uname'];
    $datastorepass  = $_SESSION['dstorepwd'];
    $PHR_DATASTORE = mysql_connect($datastore_server, $datastoreuname, $datastorepass);
    $datastore_dbname ="Health Records";
    if(!mysql_select_db($datastore_dbname, $PHR_DATASTORE))
    {
        echo "cant connect";
    }

    //This key will help decrypt the data
    $key   = $_SESSION['key'];
    //This is the type of cipher we are using
    $cipher_alg = MCRYPT_RIJNDAEL_128;


    //This is used to create a one time key
    /*$iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher_alg, 
        MCRYPT_MODE_ECB), MCRYPT_RAND);*/
    //echo bin2hex($iv);
    //echo "<p>".$iv;

    //Obtain IV that was generated
    //

    //The IV was generated once using a crypto hash
    //it needs to be the same for all users
    //or auto generated new for each user
    $iv = $_SESSION['iv'];

    //the db doesn't like data store as binary
    //so we stored it as hex now we need
    //to turn it back to binary
    $iv = hex2bin($iv);

    /*$input = "text";
    $encrypted_string = mcrypt_encrypt($cipher_alg, $key, 
        $input, MCRYPT_MODE_CBC, $iv);
    echo "Encrypted string: ".bin2hex($encrypted_string)."<p>";
     */
    
    //$encrypted_string = hex2bin($Name);
    //
    //



    echo " <form method='post' action='/index.php?disp=newpatient' />
        <strong>Name</strong>: <input type='text' name='$Name' value=''/> <br/>
        <strong>Sex </strong>: <input type='text' name='$Sex' value=''/><br/>
        <strong>DOB </strong>: <input type='text' name='$DOB' value=''/><br/>
        <strong>SSN </strong>: <input type='text' name-'$SSN' value=''/><br/>
        <strong>Diag</strong>: <input type='text' name='$diag' value=''/><br/>
        <strong>Treat</strong>: <input type='text' name='$treat' value=''/><br/>
        <input type='submit' name='submit' value='Submit New Patient'/>
        </form/>
        ";


    // TODO: add these values to database
    // include authorized as current doctor
}



//The iv is stored in hex in the database, we need to transform it back
    //essentiall a bin2hex function


    function hex2bin($hexvalue)
    {
        if (!is_string($hexvalue)) return null;
        $bin='';
        for ($a=0; $a<strlen($hexvalue); $a+=2) 
        { 
            $bin.=chr(hexdec($hexvalue{$a}.$hexvalue{($a+1)})); 
        }
        return $bin;
    } 



?>
