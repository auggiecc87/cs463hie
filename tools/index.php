<?php
echo "<h1>Use this to enroll new users for the demo</h1>";
////////////////////////////////////////////////////////////////
//
//
$submit= $_GET['sub'];
$ftype = $_POST['sel']; 
$dbiv = '416564f31f99fb8079b6b017339a2f48';
$dbdk = "cs463cs463";
$dbu  = "datastore_user";
$dbp  = "abcd1234**";
$cipher_alg = MCRYPT_RIJNDAEL_128;
echo "<form action='/index.php?' method='post' enctype = 'multipart/form-data'>";
echo "<input type='radio' name='sel' value='0' /> New Patients</br>";
echo "<input type='radio' name='sel' value='1' /> New HISP</br>";

echo "<br>";
echo "<input type='submit' value='Display Form' name='populate'>";
echo "</form>";



echo "<form action='/index.php?sub=1' method='post' enctype = 'multipart/form-data'>";

switch($ftype)
{
    case "0":
        //to add new patients
        echo "<h3 align='center'> Adding new Patient</h3>";
        echo "<p>This adds the PHR first</p>";
    echo "<p>Login Name</p>";
    echo "<input type = 'text' name ='uname' />";
    echo "<p>Password</p>";
    echo "<input type = 'text' name ='passwd' value='password' />";
    echo "<p>Decrypt Key</p>";
    echo "<input type = 'text' name ='decryptkey' value='$dbdk' />";
    echo "<p>Who can they treat (CSV)</p>";
    echo "<input type = 'text' name ='pid_auth' />";
    echo "<p>First Name</p>";
    echo "<input type = 'text' name ='fname' />";
    echo "<p>Last Name</p>";
    echo "<input type = 'text' name ='lname' />";
    echo "<p>Active</p>";
    echo "<input type = 'text' name ='active' value='1' />";
    echo "<p>Datastore Username</p>";
    echo "<input type = 'text' name ='dstore_uname' value='$dbu' />";
    echo "<p>Datastore Password</p>";
    echo "<input type = 'text' name ='dstorepwd' value='$dbp' />";
    echo "<p>Datastore IV</p>";
    echo "<input type = 'text' name ='iv' value='$dbiv' />";
    echo "<p>Account type 0=Patient 1=Researcher 2=Auditor</p>";
    echo "<input type = 'text' name ='phr_type' />";

    echo "<p>This information adds the PHR records fake data</p>";
    echo "<p>Which Physician Can take care of patient (enter the ints)</p>";
    echo "<input type = 'text' name ='Primary_Physician_ID' />";
    
    echo "<p>Delegation Field (CSV)</p>";
    echo "<input type = 'text' name ='Authorized_Physician_ID' />";
    
    echo "<p>DOB</p>";
    echo "<input type = 'text' name ='DOB' />";
    
    echo "<p>SSN</p>";
    echo "<input type = 'text' name ='SSN' value='123-45-6789' />";
    
    echo "<p>Sex</p>";
    echo "<input type = 'text' name ='Sex' value='M' />";
    
    echo "<p>Diagnosis</p>";
    echo "<input type = 'text' name ='Diagnosis' value='Nothing' />";
    
    echo "<p>Treatment</p>";
    echo "<input type = 'text' name ='Treatment' value='Nothing' />";




    break;

    case "1";
    echo "<h3 align='center'> Adding new HISP</h3>";
    echo "<p>Login Name</p>";
    echo "<input type = 'text' name ='uname' />";
    echo "<p>Password</p>";
    echo "<input type = 'text' name ='passwd' value='password' />";
    echo "<p>Decrypt Key</p>";
    echo "<input type = 'text' name ='decryptkey' value='$dbdk' />";
    echo "<p>Who can they treat (CSV)</p>";
    echo "<input type = 'text' name ='pid_auth' />";
    echo "<p>First Name</p>";
    echo "<input type = 'text' name ='fname' />";
    echo "<p>Last Name</p>";
    echo "<input type = 'text' name ='lname' />";
    echo "<p>Active</p>";
    echo "<input type = 'text' name ='active' value='1' />";
    echo "<p>Datastore Username</p>";
    echo "<input type = 'text' name ='dstore_uname' value='$dbu' />";
    echo "<p>Datastore Password</p>";
    echo "<input type = 'text' name ='dstorepwd' value='$dbp' />";
    echo "<p>Datastore IV</p>";
    echo "<input type = 'text' name ='iv' value='$dbiv' />";
    echo "<p>Account type 0=Doctor 1=Researcher 2=Auditor</p>";
    echo "<input type = 'text' name ='hisp_type' />";

    break;


default;

echo "Select something from up there";


}
echo "<br>";


echo "<br>";
echo "<input type='submit' value='populate' name='populate'>";
echo "</form>";

//so basically we add the user to the PHR_AUTH so they can auth and get their
//key. This will create the new user to the PHR_AUTH
//then it will add their info to the health records dbase
//
//
//We can add hisps and more users to their custody


if($submit ==1)
{

    //connects to the  keystore

    $keystore_server  = "127.0.0.1:3308";
    $keystore_uname = "keystore_user";
    $keystore_pwd   = 'keystore**';
    $keystore_db    = 'keystore';
    
    $kstore= mysql_connect($keystore_server, $keystore_uname, $keystore_pwd);
    if(!mysql_select_db($keystore_db, $kstore))
    {
        echo "cant connect keystore";
    }

    //connects to the datastore
    $datastore_server = "127.0.0.1:3307";
    $datastoreuname = $dbu;
    $datastorepass  = $dbp;
    $datastore_db="Health Records";

    $dstore= mysql_connect($datastore_server, $datastoreuname, $datastorepass);
    if(!mysql_select_db($datastore_db, $dstore))
    {
        echo "cant connect datastore";
    }









    //The iv is stored in hex in the database, we need to transform it back
    //essentiall a bin2hex function


}

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

function ethis($input)
{
    $cipher_alg = MCRYPT_RIJNDAEL_128;
    $dbdk = "cs463cs463";
    $zieiv = '416564f31f99fb8079b6b017339a2f48';
    $workiv = hex2bin($zieiv);
    $encrypt_string = mcrypt_encrypt($cipher_alg, $dbdk, $input, MCRYPT_MODE_CBC, $workiv);
    $blah = bin2hex($encrypt_string);
    return $blah;

}

?>

