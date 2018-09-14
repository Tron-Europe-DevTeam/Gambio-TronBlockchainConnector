<?php
// include external library
include 'global_lib.php';
include 'global_settings.php';

// create db connection - backend
$dbconn[0] = dbconnect($dbname[0]);

// check dbconnection
if(dbconncheck()){
	mysqli_close($dbconn[0]);
	mysqli_close($dbconn[1]);
}

else {

	// wallet settings
	$topic[0] = 'Wallet Einstellungen';
	$parameter[0] = 'TRON Wallet Shop Adresse';
	$value[0] = getdbparameter('shopaddress');
	$id[0] = 'shopaddress';

	// auto blockchain sync
	$topic[1] = 'Wallet Einstellungen';
	$parameter[1] = 'Automatischer Blockchain Abgleich';
	$value[1] = getdbparameter('autosync');
	$id[1] = 'autosync';

	// last blockchain sync
	$topic[2] = 'Synchronisationsinformationen';
	$parameter[2] = 'Zeitpunkt Blockchain Sync';
	$value[2] = getdbparameter('synctime');
	$id[2] = 'synctime';

	// last data sync
	$topic[3] = 'Synchronisationsinformationen';
	$parameter[3] = 'Anzahl der Synchronisierten Transaktionen';
	$value[3] = getdbparameter('syncdatacount');
	$id[3] = 'syncdatacount';

	// backend settings
	$topic[4] = 'Backend Einstellungen';
	$parameter[4] = 'Automatischer Bestellabgleich';
	$value[4] = getdbparameter('ordersync');
	$id[4] = 'ordersync';

	// backend settings
	$topic[5] = 'Backend Einstellungen';
	$parameter[5] = 'Automatische Wallet/Kundenzuweisung';
	$value[5] = getdbparameter('walletuserassociation');
	$id[5] = 'walletuserassociation';

	// generate table
	echo '<td class="boxCenter" width="100%" valign="top">
				<div class="pageHeading" float: none; left: 200px; top: 46px; position: fixed;">TRON Blockchain Grundeinstellungen</div>
							<div class="main" >
								<table width="50%" cellspacing="0" cellpadding="0"><tbody><tr class="gx-container"><td>
											<table class="gx-configuration">
												<tbody>'.system_gen_setuptable($topic,$parameter,$value,$id).'</tbody>
											</table>
									</td></tr></tbody></table>
				</div></td>';
};
?>
