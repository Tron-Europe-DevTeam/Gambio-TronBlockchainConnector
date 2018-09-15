<?php
/* --------------------------------------------------------------
   Tron Europe Dev Team
   Filename: global_language.php 
   
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
 
// translation
$translationvar = array( 
	"WALLET_SETTINGS" => array (
			"german" => "Wallet Einstellungen",
			"english" => "Wallet Settings"
			),
	"TRON_WALLET_ADDRESS" => array (
			"german" => "TRON Wallet Shop Adresse",
			"english" => "TRON Wallet Shop Address"
			),
	"BLOCKCHAIN_SYNC" => array (
			"german" => "Blockchain Abgleich (automatisch)",
			"english" => "Automatic Blockchain Sync"
			),	
	"TBL_ONLY_TRANS_WITH_NOTES" => array (
			"german" => "Nur Transaktionen mit Verwendungszweck anzeigen",
			"english" => "Display transactions with notes only"
			),		
	"SYNC_INFOS" => array (
			"german" => "Informationen zur Synchronisation",
			"english" => "Sync Information"
			),
	"SYNC_TIMESTAMP" => array (
			"german" => "Letzte Synchronisation",
			"english" => "Last synchronization"
			),
	"SYNC_TRANSACTIONS" => array (
			"german" => "Anzahl der synchronisierten Transaktionen",
			"english" => "Number of sync. Transactions"
			),	
	"BACKEND_SETTINGS" => array (
			"german" => "Backend Einstellungen",
			"english" => "Backend Settings"
			),
	"WALLET_ASSOCIATION" => array (
			"german" => "Wallet/Kundenzuweisung",
			"english" => "Wallet/Customer assignment"
			),
	"ORDER_ASSIGNMENT" => array (
			"german" => "Automatische Bestellzuweisung",
			"english" => "Automatic order assignment"
			),		
	"BLOCKCHAIN_DEFAULTSETTINGS" => array (
			"german" => "TRON Grundeinstellungen",
			"english" => "TRON Defaultsettings"
			),
	"GLOBAL_SAVE" => array (
			"german" => "Speichern",
			"english" => "Save"
			),
);

function fieldvalue($value){
	global $translationvar;
	// return value
	return $translationvar[$value][$_SESSION['language']];
}
?>