<?php
// include external library
include '/var/www/html/admin/tron-extension/inc/global_lib.php';
include '/var/www/html/admin/tron-extension/inc/global_settings.php';
// set default timezone
date_default_timezone_set('europe/berlin');

// vars set to default
$autosync = 0;
// init curl connection
$curlconn = curl_init();
// create db connection - backend
$dbconn[0] = dbconnect($dbname[0]);
// create db connection - gambio
$dbconn[1] = dbconnect($dbname[1]);
// read shop address
$shop_wallet_address = getdbparameter('shopaddress');

// check dbconnection
if(dbconncheck()){
	mysqli_close($dbconn[0]);
	mysqli_close($dbconn[1]);
}
else {	
	blockchainsync($dbconn,$curlconn,$shop_wallet_address);
}

// close request to clear up some resources
    curl_close($curlconn);
	mysqli_close($dbconn[0]);
	mysqli_close($dbconn[1]);
?>
