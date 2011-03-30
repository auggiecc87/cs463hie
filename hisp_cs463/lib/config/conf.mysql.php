<?php
/* 
 * This file sets up some global variables so we don't have to repeat them. 
 * Makes things safer too, since there's passwords up in hurr.
 * Also makes it easier to change them, should we ever have to. 
 */
         
$mysql = "127.0.0.1:3307";
$dbuname = "keystore_user";
$password = 'keystore**';
$dbname = "keystore";


//global $dbname;
//global $link;
//$link = mysql_connect($mysql, $dbuname, $password);    
//$link = mysql_connect('127.0.0.1:3307', 'root', 'cs463');


global $PHR_KEYSTORE;
$PHR_KEYSTORE= mysql_connect($mysql, $dbuname, $password);    

//global $allowregister;
//$allowregister = "no"

?>
