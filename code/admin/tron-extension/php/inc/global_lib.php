<?php
/* --------------------------------------------------------------
   Tron Europe Dev Team
   Filename: global_lib.php 
   
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
	include 'global_settings.php';
	include 'global_languagepack.php';

	// set default timezone
	date_default_timezone_set('europe/berlin');

	// apicall function
	function apiclient ($url,$conn) {
		// set connection option
		curl_setopt_array($conn, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_TIMEOUT => 20,
			CURLOPT_URL => $url,
			CURLOPT_SSL_VERIFYPEER => 0,		
		));
		// return the response
		return curl_exec($conn);
	}

	// dbconnect function
	function dbconnect ($db) {
		global $server;
		global $username;
		global $password;
		// return connect
		return mysqli_connect($server, $username, $password, $db);
	}

	// check dbconnect function
	function dbconncheck ($dbconn) {
		// check db connection
		if (!$dbconn) {
			die("DB Connection Error : ".mysqli_connect_error(dbcheck).'</br>');
			// close DB Connection
			mysqli_close($dbconn);	
			// set checkresult to false
			$result=false;
		} 
		else {
			// set checkresult to true
			$result=true;	
		}
		// return
		return $result;
	}

	// dbquery function
	function dbquery ($query) {
		global $dbconn;
		// send query
		return mysqli_query($dbconn, $query);
	}

	// dbquery count function
	function dbquerycount ($dbconn, $query) {
		// send query as result
		return mysqli_fetch_assoc(mysqli_query($dbconn, $query))['count'];
	}
	
	// function to calculation of the deposited amounts
	function calc_summary_amounts ($conn,$walletaddress,$orderid,$tokenname) {	
		// send query as result
		return mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) AS sum, COUNT(orderid) AS count FROM trx_transaction WHERE transferToAddress='".$walletaddress."' AND orderid='".$orderid."' AND tokenName='".$tokenname."'"));
	}	
	
	// function to get orderstatus
	function get_order_status ($conn,$orderid) {	
		// send query as result
		return mysqli_fetch_assoc(mysqli_query($conn, "SELECT orderstatus FROM trx_order WHERE orderid='".$orderid."'"))['orderstatus'];
	}	
	
	// query dbparameter function
	function getdbparameter ($parameter) {
		global $dbconn;
		// generate query
		$dbvalue = mysqli_fetch_assoc(mysqli_query($dbconn, "SELECT value FROM trx_systemsetup WHERE parameter ='".$parameter."'"));
		// send query
		return $dbvalue['value'];
	}

	// set dbparameter function
	function setdbparameter ($parameter, $value) {
		global $dbconn;
		// update parameter
		$dbresult = mysqli_query($dbconn, "UPDATE trx_systemsetup SET value ='".$value."' WHERE parameter = '".$parameter."'");
		// return result
		return $dbresult;
	}
    
	// check purpose of use for db
	function format_dbdata ($value,$length){
		// check stringlength
		if ( strlen( $value ) > $length ){
			$value = substr ( $value ,0 ,$length );
		}
		// return value
		return $value;			
	}
	
	// set gambio orderhistory function
	function set_dbquery_gambio_orderhistory ($order_id,$orders_status_id,$date_added,$comments) {
		// return result
		return "INSERT INTO orders_status_history(orders_id,orders_status_id,date_added,comments) values ('".$order_id."','".$orders_status_id."','".$date_added."','".$comments."')";
	}

	// function to generate an hyperlink (tronscan.org)
	function hyperlink_tronscan_hash ($hash,$url) {
	  // return hlink
	  return '<a href="https://tronscan.org/#/'.$url.'/'.$hash.'" target="_blank" rel="noopener">'.$hash.'</a>';
	}
	
	// function to generate an hyperlink (gambio)
	function hyperlink_gambio_ordersummary ($orderid) {
	  // return hlink
	  return '<a href="/admin/orders.php?oID='.$orderid.'&action=edit&overview[do]=OrdersOverview" target="_blank" rel="noopener">'.$orderid.'</a>';
	}
	
	// function to parsing regex informations
	function system_parsing ($regex,$data){
		// apply regex filter
		preg_match("/(".$regex.")/", $data , $result);
		// return data
		return $result[1];
	}
		
	//function to generate tronscan url
	function system_gen_tsurl(){	
		global $url;
		// fetch parameters
		$value = func_get_args();
		// generate url
		switch ($value[0]) {
			case "hash":
				$resultdata = $url[0].$value[1].'&start='.$value[2].'&limit=100&sort=-timestamp';
				break;
			case "transaction":
				$resultdata = $url[1].$value[1];
				break;
		}		
		// set api request url
		return $resultdata;
	}
	
	// function to create sql query for assignment of invoice number
	function system_gen_gambio_orderquery ($orderid, $billid){
		// check orderinformations -> create sql query
		$sqlquery  = "SELECT orders.gm_orders_code AS gm_orders_code, orders.customers_id AS customers_id, orders.orders_id AS orders_id, orders.orders_status AS orders_status, orders_products.final_price AS final_price, currencies.title AS currencytitle, orders.currency AS currency, orders.currency_value AS currency_value FROM orders ";
		$sqlquery .= "INNER JOIN orders_products ON orders.orders_id = orders_products.orders_id ";
		$sqlquery .= "INNER JOIN currencies ON orders.currency = currencies.code WHERE orders.orders_id ='".$orderid."'";	
		// check invoice number value
		if ((getdbparameter('assignmentbybillnumber')=='1') && ($billid<>'')){
			$sqlquery .= " OR orders.gm_orders_code ='".$billid."'";
		}
		// return sql query
		return $sqlquery;		
	}
			
			
	// function to generate tabledata
	function system_gen_setuptable ($topic) {
		// reset values
		$tabledata = '';
		// create value
		foreach ($topic as $value) {
			$tabledata .= '<tr><th colspan="2" class="dataTableHeadingContent_gm"><img align="middle" src="./tron-extension/img/tron_icon.png" width="26" height="26">'.fieldvalue($value['title'],'language').'</th></tr>';
			foreach ($value['data'] as $data) {
				// input field									 
				if ($data['type'] == 'edit') {
					$tabledata .= '<tr class="visibility_switcher"><td class="dataTableContent_gm configuration-label">';
					$tabledata .= '<label for="'.$data['id'].'">'.fieldvalue($data['name'],'language').'</label></td>';
					$tabledata .= '<td class="dataTableContent_gm"><input style="width:300px;" name="'.$data['id'].'" value="'.$data['value'].'" required="" ></td></tr>';
				}	
				
				// input field disabled
				else if ($data['type'] == 'edit_disabled') {
					$tabledata .= '<tr class="visibility_switcher"><td class="dataTableContent_gm configuration-label">';
					$tabledata .= '<label for="'.$data['id'].'">'.fieldvalue($data['name'],'language').'</label></td>';
					$tabledata .= '<td class="dataTableContent_gm"><input style="width:300px;" value="'.$data['value'].'" required="" disabled></td></tr>';
				}
				
				// switch field
				else if ($data['type'] == 'switch') {
				$tabledata.='<tr>';
				$tabledata.=' <td class="dataTableContent_gm configuration-label">'.fieldvalue($data['name'],'language');
				$tabledata.=' </td>';
				$tabledata.=' <td class="dataTableContent_gm">';
				$tabledata.='	<div class="gx-container" data-gx-widget="checkbox">';
				$tabledata.='		<input class="pull-left" type="checkbox" name="'.$data['id'].'" value="1"'.($data['value'] == '1' ? ' checked="checked"' : '').'/>';
				$tabledata.='	</div>';
				$tabledata.=' </td>';
				$tabledata.='</tr>';				
				}	

				// switch field disabled
				else if ($data['type'] == 'switch_disabled') {
				$tabledata.='<tr>';
				$tabledata.=' <td class="dataTableContent_gm configuration-label">'.fieldvalue($data['name'],'language');
				$tabledata.=' </td>';
				$tabledata.=' <td class="dataTableContent_gm">';
				$tabledata.='	<div class="gx-container" data-gx-widget="checkbox">';
				$tabledata.='		<input class="pull-left" type="checkbox" name="'.$data['id'].'" value="1"'.($data['value'] == '1' ? ' checked="checked"' : '').'disabled/>';
				$tabledata.='	</div>';
				$tabledata.=' </td>';
				$tabledata.='</tr>';				
				}					
			}
		$tabledata .= '</tr>';
		}
		return $tabledata;
	}
		
	// function to fetch blockchain data	
	function fetch_blockchain_data ($dbconn,$curlconn,$shop_wallet_address){
		
		// vars set to default
		$synceddata = 0;
		$page = 0;
		$procstop = 0;
		unset($dataset);
		$timestamp = time();
		
		do {			    	
			// send api request
			$jresponse = json_decode(apiclient(system_gen_tsurl('hash',$shop_wallet_address,$page),$curlconn),true);
			$page = $page + 100;
			foreach ($jresponse['data'] as $value) {
					// check last hashvalue
					if (dbquerycount($dbconn,"SELECT COUNT(transactionHash) as count FROM trx_transaction WHERE transactionHash = '".$value['transactionHash']."' ORDER BY pkid DESC") == '0'){	
							// exceed transaction to array 			
							$dataset[$synceddata]=$value;
							// request transaction information -> note
							$transaction = json_decode(apiclient(system_gen_tsurl('transaction',$value['transactionHash']),$curlconn),true);
							// set purpose of use
							if ($transaction['data']<>''){
							  $dataset[$synceddata]['data'] = $transaction['data'];
							}									
							$synceddata++;
						}
					else {$procstop=1;}
				}
			}
		while(((count($jresponse['data']))>0)&&($procstop==0)); 	
		
		// set last sync value
		setdbparameter('syncduration',time()-$timestamp);
		setdbparameter('synctime',date("d.m.Y H:i:s",time()));
		setdbparameter('syncdatacount',strval($synceddata));
		
		// return blockchain data
		return $dataset;
	}
			
	// function blockchainsync
	function blockchainsync ($dbconn,$curlconn,$shop_wallet_address){
		
			// fetching blockchain data
			$transaction_data=fetch_blockchain_data ($dbconn,$curlconn,$shop_wallet_address);
			
			foreach ($transaction_data as $transaction_entry) {
				// set to default
				unset($db_transaction_data);
				// set value to default
				$db_transaction_data['order_assignment'] = 0;
				// set value to default
				$db_transaction_data['transaction_state'] = 'TRX_TRANSACTIONTATE_1';
				
				// formating TRX amount (sun)
				if ($transaction_entry['tokenName'] == 'TRX'){$transaction_entry['amount'] = $transaction_entry['amount']/1000000;}

				// parsing transaction information
				if (($transaction_entry['data']<>'') && ($transaction_entry['transferToAddress'] == $shop_wallet_address)){
					
					// parsing orderid 
					$db_transaction_data['trans_orderid'] = system_parsing(getdbparameter('ordernumberregex'), rawurldecode(hex2bin(format_dbdata($transaction_entry['data'],200))));
					
					// parsing bill number
					$db_transaction_data['trans_billid'] = system_parsing(getdbparameter('billnumberregex'), rawurldecode(hex2bin(format_dbdata($transaction_entry['data'],200))));
				
					// check orderinformations -> send sql query to database
					$gambio_order_check = mysqli_query($dbconn, system_gen_gambio_orderquery($db_transaction_data['trans_orderid'],$db_transaction_data['trans_billid']));
								
						// check if order exists
						if (mysqli_num_rows($gambio_order_check) > 0) {
							
							// extract gambio dbdata
							$gambio_order_data = mysqli_fetch_assoc($gambio_order_check);
							
							// set transactionstate -> Order assigned
							$db_transaction_data['transaction_state'] = 'TRX_TRANSACTIONTATE_2';
							
							// orderid and purpose of use match
							$db_transaction_data['order_assignment'] = 1;
							
							// set orderid 
							$db_transaction_data['trans_orderid'] = $gambio_order_data['orders_id'];
							
							// update orderstate
							$db_transaction_data = order_assignment($gambio_order_data,$transaction_entry,$dbconn,$shop_wallet_address,$db_transaction_data);
						}
						else {
							// reset order id
							$db_transaction_data['transaction_state'] = 'TRX_TRANSACTIONTATE_3';						
						}	
				} 
				else {
					// set transactionstate 
					if ($transaction_entry['transferToAddress'] == $shop_wallet_address) {
						// set transactionstate -> no purpose of use
						$db_transaction_data['transaction_state'] = 'TRX_TRANSACTIONTATE_4';	
					}
				}	
	
				// write transactiondata into the db
				$dbquery  = "INSERT INTO trx_transaction ( transactionstate,transactionHash,block,timestamp,transferFromAddress,transferToAddress,amount,tokenName,data,orderassignment,orderid ) ";
				$dbquery .= "VALUES ('".$db_transaction_data['transaction_state']."','".$transaction_entry['transactionHash']."','".$transaction_entry['block']."','".$transaction_entry['timestamp']."','".$transaction_entry['transferFromAddress']."','".$transaction_entry['transferToAddress']."','".$transaction_entry['amount']."','".$transaction_entry['tokenName']."','".format_dbdata($transaction_entry['data'],200)."','".$db_transaction_data['order_assignment']."','".$db_transaction_data['trans_orderid']."')";
				
				// check if data was written successfully
				if (mysqli_query($dbconn, $dbquery)) {$synceddata++;}
				else { echo "Error: " . $sql . "<br>" . mysqli_error($conn);}			
			}	
	}

	
	
function order_assignment($gambio_order_data,$transaction_entry,$dbconn,$shop_wallet_address,$db_transaction_data){			
	
	// create sql query -> modify gambio db -> change orderstate to 'payment error'
	$gambio_update_orderstate="UPDATE orders SET orders_status = 162 WHERE orders_status='1' AND orders_id='".$gambio_order_data['orders_id']."'";
	
	// check if the currency matches
	if ($gambio_order_data['currencytitle'] == $transaction_entry['tokenName']){						
																
		// order complete
		if ($gambio_order_data['final_price'] <= $transaction_entry['amount']+calc_summary_amounts ($dbconn,$shop_wallet_address,$gambio_order_data['orders_id'],$gambio_order_data['currencytitle'])['sum']){
			$gambio_update_orderstate = "UPDATE orders SET orders_status = 161 WHERE ((orders_status='1' OR orders_status='162' OR orders_status='149')  AND (orders_id='".$gambio_order_data['orders_id']."'))";
			$gambio_update_history = set_dbquery_gambio_orderhistory($gambio_order_data['orders_id'],'161', date("Y-m-d H:i:s",$transaction_entry['timestamp']/1000), 'Zahlung erhalten - '.$transaction_entry['amount'].' '.$transaction_entry['tokenName'].' Transaktion-Hash: '.$transaction_entry['transactionHash']);
			$order_state = "TRX_ORDERSTATE_1";										
		}
		
		// bill value does not match
		else {
			$gambio_update_history = set_dbquery_gambio_orderhistory($gambio_order_data['orders_id'],'162', date("Y-m-d H:i:s",$transaction_entry['timestamp']/1000), 'Betrag entspricht nicht der Rechnung - '.$transaction_entry['amount'].' '.$transaction_entry['tokenName'].' Transaktion-Hash: '.$transaction_entry['transactionHash']);
			$order_state = "TRX_ORDERSTATE_2";
			$db_transaction_data['transaction_state'] = "TRX_ORDERSTATE_2";
		}
		
		// partial transfer check
		if (calc_summary_amounts ($dbconn,$shop_wallet_address,$gambio_order_data['orders_id'],$gambio_order_data['currencytitle'])['count']>0){
			$dbquery  = "UPDATE trx_transaction SET transactionstate='TRX_TRANSACTIONTATE_5' WHERE orderid = '".$gambio_order_data['orders_id']."' AND transactionstate = 'TRX_ORDERSTATE_2'";
			dbquery($dbquery);
			$db_transaction_data['transaction_state'] = "TRX_TRANSACTIONTATE_5";
		}
		
	}
	
	// currency of the transfer is not correct
	else {
		$gambio_update_history = set_dbquery_gambio_orderhistory($gambio_order_data['orders_id'],'162', date("Y-m-d H:i:s",$transaction_entry['timestamp']/1000), 'Coin/Token entspricht nicht der Rechnung - '.$transaction_entry['amount'].' '.$transaction_entry['tokenName'].' Transaktion-Hash: '.$transaction_entry['transactionHash']);
		$order_state = "TRX_ORDERSTATE_3";
		$db_transaction_data['transaction_state'] = "TRX_ORDERSTATE_3";
	}				
		
	// check if ordersync option true
	if (getdbparameter('ordersync') == '1'){						
		// send status to database
		dbquery($gambio_update_orderstate);
		
		// set orderhistory
		if(mysqli_affected_rows($dbconn)){
			dbquery($gambio_update_history);
		}
	}
	
	// check if the wallet address should be learned
	if (getdbparameter('walletuserassociation')=='1'){
		
		// check if order exists
		if (dbquerycount($dbconn,"SELECT COUNT(*) AS count FROM customers_memo WHERE ((customers_id = '".$gambio_order_data['customers_id']."') AND (memo_title = 'TRON Wallet Address') AND (memo_text='".$transaction_entry['transferFromAddress']."'))") == '0'){								
			dbquery("INSERT INTO customers_memo(customers_id,memo_date,memo_title,memo_text) VALUES ('".$gambio_order_data['customers_id']."','".date("d.m.Y",time())."','TRON Wallet Address','".$transaction_entry['transferFromAddress']."')");
		}
	}
	
	// write orderdata into the db
	if ((dbquerycount($dbconn,"SELECT COUNT(*) AS count FROM trx_order WHERE orderid = '".$gambio_order_data['orders_id']."'")=='0') && ($gambio_order_data['orders_id']<>'')) {	
		// write values into table				
		$dbquery  = "INSERT INTO trx_order ( orderid,orderprice,currency,orderstatus ) ";
		$dbquery .= "VALUES ('".$gambio_order_data['orders_id']."','".$gambio_order_data['final_price']."','".$gambio_order_data['currencytitle']."','".$order_state."')";
		dbquery($dbquery);		
	}
	
	// update orderstatus
	else if ((get_order_status ($dbconn,$gambio_order_data['orders_id']) <> 'TRX_ORDERSTATE_1') AND (get_order_status ($dbconn,$gambio_order_data['orders_id']) <> $gambio_order_data['orders_id'])){
		$dbquery  = "UPDATE trx_order SET orderstatus='".$order_state."' WHERE orderid = '".$gambio_order_data['orders_id']."'";
		dbquery($dbquery);									
	}
	
	// return transactiondata
	return $db_transaction_data;
}
	
	// function blockchainsync
	function blockchain_gen_transtbl ($dbconn,$column){
		echo '<table class="gx-compatibility-table" cellspacing="0" cellpadding="0" border="0">
				<tbody>
					<tr>';				  
					foreach ($column as $columndata) {
						echo '<td class="dataTableHeadingContent" style="width: '.$columndata['width'].'px">'.fieldvalue($columndata['title'],'language').'</td>';
					};
		echo'</tr>';
		// generate table query
		$dbquery = "SELECT trx_transaction.transactionstate,trx_transaction.transactionHash,trx_transaction.block,trx_transaction.timestamp,trx_transaction.transferFromAddress,trx_transaction.transferToAddress,trx_transaction.amount,trx_transaction.tokenName,trx_transaction.data,trx_transaction.orderassignment,trx_transaction.orderid, trx_order.orderprice, trx_order.currency, trx_order.orderstatus FROM trx_transaction "; 
		$dbquery .= "LEFT OUTER JOIN trx_order ON  trx_order.orderid = trx_transaction.orderid WHERE transferToAddress = '".getdbparameter('shopaddress')."' ORDER BY block DESC";

		$result = dbquery($dbquery);
		// generate table data
		if (mysqli_num_rows($result) > 0) {
			while($value = mysqli_fetch_assoc($result)) {
					if ((getdbparameter('tblonlytransnote')=='1') && ($value['data']=='')){} 
					else {
					  // format orderprice
					  if ($value['orderprice']<>''){$orderprice=round($value['orderprice'],2).' '.$value['currency'];}else{$orderprice='';};
					  // generate row data
					  echo '<tr class="dataTableRowSelected visibility_switcher gx-container" style="cursor: pointer;">';
					  echo '<td class="dataTableContent">'.date("d.m.Y H:i:s",$value['timestamp']/1000).'</td>';
					  echo '<td class="dataTableContent">'.hyperlink_tronscan_hash($value['transactionHash'],'transaction').'</td>';
					  echo '<td class="dataTableContent">'.hyperlink_tronscan_hash($value['transferFromAddress'],'address').'</td>';
					  echo '<td class="dataTableContent">'.$value['amount'].'</td>';
					  echo '<td class="dataTableContent">'.$value['tokenName'].'</td>';
					  echo '<td class="dataTableContent">'.rawurldecode(hex2bin($value['data'])).'</td>';
					  echo '<td onclick="order_assignment(\''.$value['transactionHash'].'\',\''.$_SESSION['language'].'\',\''.$value['orderid'].'\')" class="dataTableContent"><span class="label '.fieldvalue($value['transactionstate'],'label').'">'.fieldvalue($value['transactionstate'],'language').'</span></td>';
					  echo '<td class="dataTableContent">'.hyperlink_gambio_ordersummary($value['orderid']).'</td>';
					  echo '<td class="dataTableContent">'.$orderprice.'</td>';
					  echo '<td class="dataTableContent"><span class="label '.fieldvalue($value['orderstatus'],'label').'">'.fieldvalue($value['orderstatus'],'language').'</span></td>';
					  echo '</tr>';
					}
				}
			}	
	  echo '</tbody></table></br>';
	  
	  echo'
	  <div id="trx-modal" class="trx-modal"></div>
	  
	  <script>		
        function ordersearch(action,value,divobject) {
		 if ((event.keyCode == 13)||(event.type == "click"))
			{
			if (value == "") {
				document.getElementById(divobject).innerHTML = "<option value=\"-1\">No Data</option>";
				return;
			} else {
				if (window.XMLHttpRequest) {
					xmlhttp = new XMLHttpRequest();
				} else {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						    document.getElementById(divobject).innerHTML = this.responseText;
						}															
					}
				};
				if (action == "change"){
					value = document.getElementById("trx-orderform").value;	
				}				
				
				xmlhttp.open("GET","tron-extension/php/inc/modal_order_action.php?data=" + value + "&action=" + action ,true);
				xmlhttp.send();
			}	
		}				  
	  
		function order_assignment(hash,language,orderid) {
			if (hash == "") {
				document.getElementById("txtHint").innerHTML = "";
				return;
			} else {
				if (window.XMLHttpRequest) {
					xmlhttp = new XMLHttpRequest();
				} else {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						    document.getElementById("trx-modal").innerHTML = this.responseText;
							var modal = document.getElementById("trx-modal");
							modal.style.display = "block";	
							var span = document.getElementsByClassName("trx-close")[0];
							span.onclick = function() {
								modal.style.display = "none";
							}
							window.onclick = function(event) {
								if (event.target == modal) {
									modal.style.display = "none";
								}
							}
						}															
					}
				};
				xmlhttp.open("GET","tron-extension/php/inc/modal_order_assignment.php?hash=" + hash + "&language=" + language + "&orderid=" + orderid ,true);
				xmlhttp.send();
		}	
		</script>';
	}

	function system_gen_syncbutton ($url,$title,$infotext){
	  $button = '<div class="files-not-uploaded" style="word-wrap: break-word; margin-bottom: 30px">';
	  $button .=  '<button class="btn btn-default btn-lg" type="button" onclick="location.replace(\''.$url.'\')">'.$title.'</button>   '.$infotext.'</div>';
	  // return button
	  return $button;
	}

?>
