<?php
/* --------------------------------------------------------------
   Tron Europe Dev Team
   Filename: transaction_search.php
   
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
   
    // extract transaction hash
	$hash = $_GET['hash'];

	// extract sender
	$sender = $_GET['sender'];
	
	// extract orderid
	$order = $_GET['order'];
	
	// extract transaction status
	$trstatus = $_GET['trstatus'];
	
	// extract order status
	$ordstatus = $_GET['ordstatus'];
	
	// extract order status
	$purpose = $_GET['purpose'];
	
    // extract language
	$language = $_GET['language'];	

	//create dbconnection
	$dbconn = dbconnect($dbname[0]);
	
	// check dbconnection
	if (dbconncheck($dbconn)) {		
	
		// generate transaction table
		gen_transtbl_values($language,$hash,$sender,$order,$trstatus,$ordstatus,$purpose);
	}
	
?>