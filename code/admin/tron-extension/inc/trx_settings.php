<?php
/* --------------------------------------------------------------
   Tron Europe Dev Team
   Filename: trx_settings.php 
   
   15.09.2018 - Init Version
   
   Released under the GNU General Public License (Version 2)
   [http://www.gnu.org/licenses/gpl-2.0.html]

   IMPORTANT! THIS FILE IS DEPRECATED AND WILL BE REPLACED IN THE FUTURE. 
   MODIFY IT ONLY FOR FIXES. DO NOT APPEND IT WITH NEW FEATURES, USE THE
   NEW GX-ENGINE LIBRARIES INSTEAD.
   --------------------------------------------------------------

   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(orders_status.php,v 1.19 2003/02/06); www.oscommerce.com
   (c) 2003	 nextcommerce (orders_status.php,v 1.9 2003/08/18); www.nextcommerce.org
   (c) 2003 XT-Commerce - community made shopping http://www.xt-commerce.com ($Id: orders_status.php 1125 2005-07-28 09:59:44Z novalis $)

   Released under the GNU General Public License
   --------------------------------------------------------------*/
   
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
