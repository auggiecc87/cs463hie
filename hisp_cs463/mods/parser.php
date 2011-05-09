<?php
$hispuname = $_POST['user'];
$hisppwd   = $_POST['pwd'];


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

    $desired_pid = choose_pid($_SESSION['session_pid_auth'] );
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


// function to choose the patient history to look at
    function choose_pid($pid_list)
    {   
        //list the pids and make user choose one
        $token = strtok($pid_list, ",");

        $tokened;
        $patient_ind = 0;
        while ($token != false)
        {
            $tokened[$patient_ind] = $token;
            //echo $tokened[$patient_ind];
            $patient_ind++;
            //echo $token;
            $token = strtok(",");
        }
        $patient_ind--;

        echo"<form method='post' action='/index.php?disp=fetchpatient' >
            Which patient? <br />";

        $ind = 0;
        while ($patient_ind >= $ind)
        {
            $patient = parse_patient($tokened[$ind]);
            echo"
                <input type='radio' name='uid' value='$tokened[$ind]'>
                $patient <br />";
            $ind++;
        }
        echo" <input type='submit' value='Submit'/>
            </form/>";

        echo" <form method='post' action='/index.php?disp=newpatient'>
            <input type='submit' value='Add New Patient'/></form/>";

    return $_POST['uid'];
    }

    //function to get basic patient data for display
    function parse_patient($patient_ind)
    {
        $datastore_server = "127.0.0.1:3307";
        $datastoreuname = $_SESSION['dstore_uname'];
        $datastorepass  = $_SESSION['dstorepwd'];
        $PHR_DATASTORE = mysql_connect($datastore_server, $datastoreuname, 
            $datastorepass);
        $patient_dbname ="Health Records";
        if(!mysql_select_db($patient_dbname, $PHR_DATASTORE))
        {
            echo "can't connect";
        }

        $encrypt_pid = $_SESSION['session_pid_auth'];
        $EHR_QUERY = "SELECT * FROM Patient WHERE Patient_ID = '$patient_ind'";
        
        $finalquery = mysql_query($EHR_QUERY, $PHR_DATASTORE);
        while($row = mysql_fetch_array($finalquery))
        {
            $patient_name = $row['Name']; 
            $SSN = $row['SSN'];
        }

        $key   = $_SESSION['key'];
        $cipher_alg = MCRYPT_RIJNDAEL_128; 
        $iv = $_SESSION['iv'];
        $iv = hex2bin($iv);
        //Decrypt the Patient Data
        $patient_name = mcrypt_decrypt($cipher_alg, $key,
            hex2bin($patient_name), MCRYPT_MODE_CBC, $iv);

        $SSN = mcrypt_decrypt($cipher_alg, $key,
            hex2bin($SSN), MCRYPT_MODE_CBC, $iv);
        
        //obsure SSN
        $repl = "XXX-XX-";
        $SSN = substr_replace($SSN,$repl,0,7);

        return $patient_name." ".$SSN;
    }

?>
