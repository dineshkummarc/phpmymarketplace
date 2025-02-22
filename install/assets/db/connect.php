<?php 

require_once("../SCRIPT/apl_core_configuration.php");
require_once("../SCRIPT/apl_core_functions.php");

$server = "localhost";
$dbusername = "root";
$dbpassword = "";
$database = "slippa";

//MySQL port
$DB_PORT="3306";

$mysqli = new mysqli($server, $dbusername, $dbpassword, $database);


/*DB EXTRA*/

if (!empty($server) && !empty($dbusername) && !empty($database) && filter_var($DB_PORT, FILTER_VALIDATE_INT))
    {
    $GLOBALS["mysqli"]=mysqli_connect($server, $dbusername, $dbpassword, $database, $DB_PORT);
    if (!$GLOBALS["mysqli"])
        {
        echo "Impossible to connect to MySQL database. Check database connection details.";
        exit();
        }
    }
else
    {
    $GLOBALS["mysqli"]=null;
    }



function getFullDetails($LICENSE_CODE,$CLIENT_EMAIL,$ROOT_URL)
{
	$curl_handle = curl_init();
	curl_setopt($curl_handle, CURLOPT_URL, 'http://onlinetoolhub.com/licence/licence');
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_handle, CURLOPT_POST, 1);
	curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
	'purchase_code' => $LICENSE_CODE,
	'CLIENT_EMAIL' => $CLIENT_EMAIL,
	'ROOT_URL' => $ROOT_URL));
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	$object = json_decode($buffer);
	return $object->purchase_status;	
}


?>