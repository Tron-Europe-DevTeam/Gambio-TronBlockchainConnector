<?php
/* --------------------------------------------------------------
   Tron Europe Dev Team
   Filename: blockchain_sync.php 
   
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
include '/var/www/html/admin/tron-extension/php/inc/global_lib.php';
include '/var/www/html/admin/tron-extension/php/inc/global_settings.php';
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
