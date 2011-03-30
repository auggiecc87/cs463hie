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
        $_SESSION['iv']               = $row['iv'];

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


    $encrypt_pid = $_SESSION['session_pid_auth'];
    $EHR_QUERY = "SELECT * FROM Patient WHERE Patient_ID = '$encrypt_pid'";
    $finalquery = mysql_query($EHR_QUERY, $PHR_DATASTORE);
    while($row = mysql_fetch_array($finalquery))
    {
        //This only obtains encrypted values
        $Name  = $row['Name'];
        $Sex   = $row['Sex'];
        $DOB   = $row['DOB'];
        $SSN   = $row['SSN'];
        $Diag  = $row['Diagnosis'];
        $Treat = $row['Treatment'];
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



    //Decrypt the Patient Data
    $Name = mcrypt_decrypt($cipher_alg, $key, 
        hex2bin($Name), MCRYPT_MODE_CBC, $iv);
    
    $Sex = mcrypt_decrypt($cipher_alg, $key, 
        hex2bin($Sex), MCRYPT_MODE_CBC, $iv);
    
    $DOB = mcrypt_decrypt($cipher_alg, $key, 
        hex2bin($DOB), MCRYPT_MODE_CBC, $iv);
    
    $SSN = mcrypt_decrypt($cipher_alg, $key, 
        hex2bin($SSN), MCRYPT_MODE_CBC, $iv);
    
    $Diag = mcrypt_decrypt($cipher_alg, $key, 
        hex2bin($Diag), MCRYPT_MODE_CBC, $iv);
    
    $Treat = mcrypt_decrypt($cipher_alg, $key, 
        hex2bin($Treat), MCRYPT_MODE_CBC, $iv);


    echo "<p align='left'>
        <strong>Name</strong>: $Name <br/>
        <strong>Sex </strong>: $Sex<br/>
        <strong>DOB </strong>: $DOB <br/>
        <strong>SSN </strong>: $SSN <br/>
        <strong>Diag</strong>: $Diag<br/>
        <strong>Treat</strong>: $Treat <br/>";

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

