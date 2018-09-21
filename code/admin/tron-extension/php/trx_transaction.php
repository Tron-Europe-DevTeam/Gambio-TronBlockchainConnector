<?php
/* --------------------------------------------------------------
   Tron Europe Dev Team
   Filename: trx_transaction.php 
   
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
	include 'inc/global_lib.php';
	include 'inc/global_settings.php';
	include 'trx_transaction.var.php';

	//create dbconnection
	$dbconn = dbconnect($dbname[0]);
	
	// check dbconnection
	if (dbconncheck($dbconn)) {
				
		// init curl connection
		$curlconn = curl_init();
		
		// read shop address
		$shop_wallet_address = getdbparameter('shopaddress');
		
		// vars set to default
		$autosync = 0;
		
		// page header
		echo '<table border="0" width="100%" cellspacing="0" cellpadding="2">
			  <tr><td><div class="pageHeading">'.fieldvalue('WALLET_TRANSACTIONS','language').'</div></td></tr></table></br>';
		// autosync check
		if (isset($_GET['autosync'])){
			$autosync = $_GET['autosync'];
		}
		
		// blockchain sync
		if ((getdbparameter('autosync')==1) || ($autosync==1)){
		blockchainsync($dbconn,$curlconn,$shop_wallet_address);
		}
		
		// generate transaction table
		blockchain_gen_transtbl($dbconn,$column);

		// generate blockchain sync button
		echo system_gen_syncbutton('/admin/tron_wallet_transactions.php?autosync=1','Blockchain Sync','Last Sync : '.getdbparameter('syncdatacount'));
		
		// close request to clear up curl resources
		curl_close($curlconn);
	}
	
	// close request to clear up mysql resources
	mysqli_close($dbconn);
	
?>
