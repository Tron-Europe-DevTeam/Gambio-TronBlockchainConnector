<?php
/* --------------------------------------------------------------
   Tron Europe Dev Team
   Filename: trx_transaction.var.php 
   
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
	 
	// set table column
	$column = array( 
		"0" => array (
				"title" => "TBL_TITLE_BLOCK",	
				"width" => "30px"),
		"1" => array (
				"title" => "TBL_TITLE_TIMESTAMP",
				"width" => "60px"
				),
		"2" => array (
				"title" => "TBL_TITLE_TRANSACTION_HASH",
				"width" => "120px"
				),
		"3" => array (
				"title" => "TBL_TITLE_SENDER",
				"width" => "120px"
				),
		"4" => array (
				"title" => "TBL_TITLE_QUANTITY",
				"width" => "30px"
				),
		"5" => array (
				"title" => "TBL_TITLE_CURRENCY",
				"width" => "60px"
				),
		"6" => array (
				"title" => "TBL_TITLE_PURPOSE_OF_USE",
				"width" => "120px"
				),
		"7" => array (
				"title" => "TBL_TITLE_ORDERASSIGNMENT",
				"width" => "40px"
				),
		"8" => array (
				"title" => "TBL_TITLE_ORDERNUMBER",
				"width" => "40px"
				),
		"9" => array (
				"title" => "TBL_TITLE_TOTAL_AMOUNT",
				"width" => "80px"
				),
		"10" => array (
				"title" => "TBL_TITLE_STATUS",
				"width" => "40px"
				)
	);

?>