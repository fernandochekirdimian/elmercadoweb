<?php

$server = 'localhost'; 
$user = 'root';
$pass = '';
$db = 'mercado';

include('adodb5/adodb.inc.php');
$DB = NewADOConnection('mysqli');
$DB->SetFetchMode(ADODB_FETCH_ASSOC);
$DB->Connect($server, $user, $pass, $db);

?>