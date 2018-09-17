<?php
/* --------------------------------------------------------------
   Tron Europe Dev Team
   Filename: global_languagepack.php 
   
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
		"WALLET_TRANSACTIONS" => array (
				"german" => "Wallet Transaktionseingang",
				"english" => "Wallet Receive Transaction"
				),
		"SYSTEM_INFO" => array (
				"german" => "Info",
				"english" => "Info"
				),
		"GLOBAL_SAVE" => array (
				"german" => "Speichern",
				"english" => "Save"
				),
		"GLOBAL_YES" => array (
				"german" => "Ja",
				"english" => "Yes"
				),
		"GLOBAL_NO" => array (
				"german" => "Nein",
				"english" => "No"
				),
		"TBL_TITLE_BLOCK" => array (
				"german" => "Block",
				"english" => "Block"
				),
		"TBL_TITLE_TIMESTAMP" => array (
				"german" => "Zeitpunkt",
				"english" => "Timestamp"
				),
		"TBL_TITLE_TRANSACTION_HASH" => array (
				"german" => "Transaktions Hash",
				"english" => "Transaction Hash"
				),
		"TBL_TITLE_SENDER" => array (
				"german" => "Absender",
				"english" => "Sender"
				),
		"TBL_TITLE_QUANTITY" => array (
				"german" => "Anzahl",
				"english" => "Quantity"
				),
		"TBL_TITLE_CURRENCY" => array (
				"german" => "Währung",
				"english" => "Currency"
				),
		"TBL_TITLE_PURPOSE_OF_USE" => array (
				"german" => "Verwendungszweck",
				"english" => "Purpose of use"
				),
		"TBL_TITLE_ORDERASSIGNMENT" => array (
				"german" => "Automatisch Zugewiesen",
				"english" => "Automatically Assigned"
				),
		"TBL_TITLE_ORDERNUMBER" => array (
				"german" => "Bestellnummer",
				"english" => "Ordernumber"
				),
		"TBL_TITLE_TOTAL_AMOUNT" => array (
				"german" => "Rechnungsbetrag",
				"english" => "Total amount"
				),
		"TBL_TITLE_STATUS" => array (
				"german" => "Status",
				"english" => "State"
				),
		"TRX_ORDERSTATE_1" => array (
				"german" => "Offen",
				"english" => "Open"
				),
		"TRX_ORDERSTATE_2" => array (
				"german" => "Zahlung erhalten",
				"english" => "Payment received"
				),
		"TRX_ORDERSTATE_3" => array (
				"german" => "Rechnungsbetrag fehlerhaft",
				"english" => "Incorrect bill amount"
				),
		"TRX_ORDERSTATE_4" => array (
				"german" => "Coin/Token - Währungsfehler",
				"english" => "Coin/Token - Currency error"
				)
	);

	function fieldvalue($value){
		global $translationvar;
		// return value
		return $translationvar[$value][$_SESSION['language']];
	}

?>