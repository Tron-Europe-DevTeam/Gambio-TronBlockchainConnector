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
			"language" => array (
				"german" => "Wallet Einstellungen",
				"english" => "Wallet Settings"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TRON_WALLET_ADDRESS" => array (
			"language" => array (
				"german" => "TRON Wallet Shop Adresse",
				"english" => "TRON Wallet Shop Address"
				),
			"data" => array (
					"label" => ""
				)
			),
		"BLOCKCHAIN_SYNC" => array (
			"language" => array (
				"german" => "Blockchain Abgleich (automatisch)",
				"english" => "Automatic Blockchain Sync"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_ONLY_TRANS_WITH_NOTES" => array (
			"language" => array (
				"german" => "Nur Transaktionen mit Verwendungszweck anzeigen",
				"english" => "Display transactions with notes only"
				),
			"data" => array (
					"label" => ""
				)
			),	
		"SYNC_INFOS" => array (
			"language" => array (
				"german" => "Informationen zur Synchronisation",
				"english" => "Sync Information"
				),
			"data" => array (
					"label" => ""
				)
			),
		"SYNC_TIMESTAMP" => array (
			"language" => array (
				"german" => "Letzte Synchronisation",
				"english" => "Last synchronization"
				),
			"data" => array (
					"label" => ""
				)
			),
		"SYNC_TRANSACTIONS" => array (
			"language" => array (
				"german" => "Anzahl der synchronisierten Transaktionen",
				"english" => "Number of sync. Transactions"
				),
			"data" => array (
					"label" => ""
				)
			),	
		"SYNC_DURATION" => array (
			"language" => array (
				"german" => "Synchronisationszeit (in Sekunden)",
				"english" => "Synchronization time (in seconds)"
				),
			"data" => array (
					"label" => ""
				)
			),	
		"BACKEND_SETTINGS" => array (
			"language" => array (
				"german" => "Backend Einstellungen",
				"english" => "Backend Settings"
				),
			"data" => array (
					"label" => ""
				)
			),
		"WALLET_ASSOCIATION" => array (
			"language" => array (
				"german" => "Wallet/Kundenzuweisung",
				"english" => "Wallet/Customer assignment"
				),
			"data" => array (
					"label" => ""
				)
			),
		"REGEX_ORDERID" => array (
			"language" => array (
				"german" => "Regex Bestellnummer",
				"english" => "Regex Order number"
				),
			"data" => array (
					"label" => ""
				)
			),
		"REGEX_BILLID" => array (
			"language" => array (
				"german" => "Regex Rechnungsnummer",
				"english" => "Regex Bill number"
				),
			"data" => array (
					"label" => ""
				)
			),
		"ASSIGNMENT_BY_ORDERNUMBER" => array (
			"language" => array (
				"german" => "Bestellzuweisung per Bestellnummer (default on)",
				"english" => "Order assignment via ordernumber (default on)"
				),
			"data" => array (
					"label" => ""
				)
			),
		"ASSIGNMENT_BY_BILLNUMBER" => array (
			"language" => array (
				"german" => "Bestellzuweisung per Rechnungsnummer",
				"english" => "Order assignment via invoice number"
				),
			"data" => array (
					"label" => ""
				)
			),
		"ORDER_ASSIGNMENT" => array (
			"language" => array (
				"german" => "Automatische Bestellzuweisung",
				"english" => "Automatic order assignment"
				),
			"data" => array (
					"label" => ""
				)
			),		
		"BLOCKCHAIN_DEFAULTSETTINGS" => array (
			"language" => array (
				"german" => "TRON Grundeinstellungen",
				"english" => "TRON Defaultsettings"
				),
			"data" => array (
					"label" => ""
				)
			),
		"WALLET_TRANSACTIONS" => array (
			"language" => array (
				"german" => "Wallet Transaktionseingang",
				"english" => "Wallet Receive Transaction"
				),
			"data" => array (
					"label" => ""
				)
			),
		"SYSTEM_INFO" => array (
			"language" => array (
				"german" => "Info",
				"english" => "Info"
				),
			"data" => array (
					"label" => ""
				)
			),
		"GLOBAL_SAVE" => array (
			"language" => array (
				"german" => "Speichern",
				"english" => "Save"
				),
			"data" => array (
					"label" => ""
				)
			),
		"GLOBAL_YES" => array (
			"language" => array (
				"german" => "Ja",
				"english" => "Yes"
				),
			"data" => array (
					"label" => ""
				)
			),
		"GLOBAL_NO" => array (
			"language" => array (
				"german" => "Nein",
				"english" => "No"
				),
			"data" => array (
					"label" => ""
				)
			),
		"GLOBAL_SEARCH" => array (
			"language" => array (
				"german" => "Suche",
				"english" => "Search"
				),
			"data" => array (
					"label" => ""
				)
			),
		"MANUAL_ORDERASSIGNMENT" => array (
			"language" => array (
				"german" => "Bestellnummer </br>(manuelle Zuweisung)",
				"english" => "Order number </br>(manual assignment)"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_TITLE_BLOCK" => array (
			"language" => array (
				"german" => "Block",
				"english" => "Block"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_TITLE_TIMESTAMP" => array (
			"language" => array (
				"german" => "Zeitpunkt",
				"english" => "Timestamp"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_TITLE_TRANSACTION_HASH" => array (
			"language" => array (
				"german" => "Transaktions Hash",
				"english" => "Transaction Hash"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_TITLE_SENDER" => array (
			"language" => array (
				"german" => "Absender",
				"english" => "Sender"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_TITLE_RECEIVER" => array (
			"language" => array (
				"german" => "Empfänger",
				"english" => "Receiver"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_TITLE_QUANTITY" => array (
			"language" => array (
				"german" => "Anzahl",
				"english" => "Quantity"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_TITLE_TRANSFERSTATUS" => array (
			"language" => array (
				"german" => "Transferstatus",
				"english" => "Transferstate"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_TITLE_CURRENCY" => array (
			"language" => array (
				"german" => "Währung",
				"english" => "Currency"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_TITLE_PURPOSE_OF_USE" => array (
			"language" => array (
				"german" => "Verwendungszweck",
				"english" => "Purpose of use"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_TITLE_ORDERASSIGNMENT" => array (
			"language" => array (
				"german" => "Automatisch Zugewiesen",
				"english" => "Automatically Assigned"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_TITLE_ORDERNUMBER" => array (
			"language" => array (
				"german" => "Bestellnummer",
				"english" => "Ordernumber"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_TITLE_TOTAL_AMOUNT" => array (
			"language" => array (
				"german" => "Rechnungsbetrag",
				"english" => "Total amount"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TBL_TITLE_STATUS" => array (
			"language" => array (
				"german" => "Status",
				"english" => "State"
				),
			"data" => array (
					"label" => ""
				)
			),
		"TRX_ORDERSTATE_1" => array (
			"language" => array (
					"german" => "Zahlung erhalten",
					"english" => "Payment received"
				),
			"data" => array (
					"label" => "label-success"
				)
			),	
		"TRX_ORDERSTATE_2" => array (
			"language" => array (
				"german" => "Rechnungsbetrag fehlerhaft",
				"english" => "Incorrect bill amount"
				),
			"data" => array (
					"label" => "label-error"
				)
			),
		"TRX_ORDERSTATE_3" => array (
			"language" => array (
				"german" => "Währungsfehler",
				"english" => "Currency error"
				),
			"data" => array (
					"label" => "label-error"
				)
			),
		"TRX_TRANSACTIONTATE_1" => array (
			"language" => array (
					"german" => "Offen",
					"english" => "Open"
					),
			"data" => array (
					"label" => "label-processing"
				)
			),
		"TRX_TRANSACTIONTATE_2" => array (
			"language" => array (
					"german" => "Bestellung zugewiesen",
					"english" => "Order assigned"
					),
			"data" => array (
					"label" => "label-success"
				)
			),
		"TRX_TRANSACTIONTATE_3" => array (
			"language" => array (
					"german" => "Keine Bestellung gefunden",
					"english" => "No Order found"
					),
			"data" => array (
					"label" => "label-error"
				)
			),
		"TRX_TRANSACTIONTATE_4" => array (
			"language" => array (
				"german" => "Kein Verwendungszweck",
				"english" => "No purpose of use"
				),
			"data" => array (
					"label" => "label-processing"
				)
			),
		"TRX_TRANSACTIONTATE_5" => array (
			"language" => array (
				"german" => "Teilüberweisung",
				"english" => "Partial transfer"
				),
			"data" => array (
					"label" => "label-processing"
				)
			)
	);

	function fieldvalue(){
		// incl. transvar
		global $translationvar;	
		// fetch parameters
		$value = func_get_args();
		// check attribute
		if ($value[1] == 'language'){
			if (func_num_args() == 2){
				$data = $translationvar[$value[0]]['language'][$_SESSION['language']];
			}			
			else $data = $translationvar[$value[0]]['language'][$value[2]];
		}
		else $data = $translationvar[$value[0]]['data'][$value[1]];
		// return value
		return $data;
	}

?>