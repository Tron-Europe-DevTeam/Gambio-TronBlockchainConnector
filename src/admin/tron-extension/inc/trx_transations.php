<?php
// include external library
include 'global_lib.php';
include 'global_settings.php';

// autosync check
if (isset($_GET['autosync'])){
    $autosync = $_GET['autosync'];
}

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
	if ((getdbparameter('autosync')==1) || ($autosync==1)){
	blockchainsync($dbconn,$curlconn,$shop_wallet_address);
	}
	// generate transaction table
	blockchain_gen_transtbl($dbconn);

	// generate blockchain sync button
	echo system_gen_syncbutton('/admin/tron_wallet_transactions.php?autosync=1','Blockchain Sync','Last Sync : '.getdbparameter('syncdatacount'));
}

// close request to clear up some resources
  curl_close($curlconn);
	mysqli_close($dbconn[0]);
	mysqli_close($dbconn[1]);
?>
