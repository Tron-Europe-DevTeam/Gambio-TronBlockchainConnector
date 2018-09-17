<?php
/* --------------------------------------------------------------
   Tron Europe Dev Team
   Filename: trx_settings_vars.php 
   
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
	 
	// Settingsmenue
	$topic = array( 
		"0" => array (
				"title" => "WALLET_SETTINGS",
				"data" => array (
					"0" => array (
							"name"  => "TRON_WALLET_ADDRESS", 	
							"value" => getdbparameter('shopaddress'),
							"type"  => "edit",
							"id"    => "shopaddress"
					),
					"1" => array (
							"name"  => "BLOCKCHAIN_SYNC", 	
							"value" => getdbparameter('autosync'),
							"type"  => "switch",
							"id"    => "autosync"
					),
					"2" => array (
							"name"  => "TBL_ONLY_TRANS_WITH_NOTES", 	
							"value" => getdbparameter('tblonlytransnote'),
							"type"  => "switch",
							"id"    => "tblonlytransnote"
					)
				)
			),
		"1" => array (
				"title" => "SYNC_INFOS", 
				"data" => array (
					"0" => array (
							"name"  => "SYNC_TIMESTAMP", 	
							"value" => getdbparameter('synctime'),
							"type"  => "edit_disabled",
							"id"    => "synctime"
					),
					
					"1" => array (
							"name"  => "SYNC_TRANSACTIONS", 	
							"value" => getdbparameter('syncdatacount'),
							"type"  => "edit_disabled",
							"id"    => "syncdatacount"
					)
				)
			),
		"2" => array (
				"title" => "BACKEND_SETTINGS", 
				"data" => array (
					"0" => array (
							"name"  => "ORDER_ASSIGNMENT", 	
							"value" => getdbparameter('ordersync'),
							"type"  => "switch",
							"id"    => "ordersync"
					),
					"1" => array (
							"name"  => "WALLET_ASSOCIATION", 	
							"value" => getdbparameter('walletuserassociation'),
							"type"  => "switch",
							"id"    => "walletuserassociation"
					)
				)
			)
	);

?>