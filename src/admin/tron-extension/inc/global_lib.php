<?php
// include external library
include 'global_settings.php';
// set default timezone
date_default_timezone_set('europe/berlin');

// apicall function
function apiclient($url,$conn) {
    // set connection option
    curl_setopt_array($conn, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
    ));
    // return the response
    return curl_exec($conn);
}

// dbconnect function
function dbconnect($db) {
	global $server;
	global $username;
	global $password;
    // return connect
    return mysqli_connect($server, $username, $password, $db);
}

// check dbconnect function
function dbconncheck() {
	global $dbconn;
	$result=true;
	// check db connection
	foreach ($dbconn as $dbcheck) {
		if (!$dbcheck) {
			die("DB Connection Error : ".mysqli_connect_error(dbcheck).'</br>');
		}
		else {$result=false;}
	}
	// return
	return $result;
}

// dbquery function
function dbquery($conn,$query) {
    // send query
    return mysqli_query($conn, $query);
}

// query dbparameter function
function getdbparameter($parameter) {
	global $dbconn;
	// generate query
	$dbvalue = mysqli_fetch_assoc(mysqli_query($dbconn[0], "SELECT value FROM globalsetup WHERE parameter ='".$parameter."'"));
    // send query
    return $dbvalue['value'];
}

// set dbparameter function
function setdbparameter($parameter, $value) {
	global $dbconn;
	// update parameter
	$dbresult = mysqli_query($dbconn[0], "UPDATE globalsetup SET value ='".$value."' WHERE parameter = '".$parameter."'");
    // return result
    return $dbresult;
}

// set gambio orderhistory function
function set_dbquery_gambio_orderhistory($order_id,$orders_status_id,$date_added,$comments) {
	// return result
    return "INSERT INTO orders_status_history(orders_id,orders_status_id,date_added,comments) values ('".$order_id."','".$orders_status_id."','".$date_added."','".$comments."')";
}

// function to generate an hyperlink (tronscan.org)
function hyperlink_tronscan_hash($hash,$url) {
  // return hlink
  return '<a href="https://tronscan.org/#/'.$url.'/'.$hash.'" target="_blank" rel="noopener">'.$hash.'</a>';
}

// function to generate an hyperlink (gambio)
function hyperlink_gambio_ordersummary($orderid) {
  // return hlink
  return '<a href="/admin/orders.php?oID='.$orderid.'&action=edit&overview[do]=OrdersOverview" target="_blank" rel="noopener">'.$orderid.'</a>';
}

// function to generate tabledata
function system_gen_setuptable($top,$para,$val,$name) {
	// reset values
	$topic = '';
	$i = 0;
	
	// generate header
	foreach ($top as $topname) {
    if ($topic <> $topname){
		$tabledata .= '<tr><th colspan="2" class="dataTableHeadingContent_gm"><img align="middle" src="./tron-extension/img/tron_icon.png" width="26" height="26" align="bottom">'.$topname.'</th></tr>';
		$topic = $topname;
	}
	
	// generate tablerows
	$tabledata .= '<tr class="visibility_switcher"><td class="dataTableContent_gm configuration-label">';
	$tabledata .= '<label for="'.$name[$i].'">'.$para[$i].'</label></td>';
	$tabledata .= '<td class="dataTableContent_gm"><input style="width:300px;" id="'.$name[$i].'" value="'.$val[$i].'" required="" ></td>';
	
    if ($top[$i+1] <> $topname){
		$tabledata .= '</tr>';
		}
	$i++;
	}
	return $tabledata;
}

// function blockchainsync
function blockchainsync($dbconn,$curlconn,$shop_wallet_address){
do {
	// vars set to default
	$page = 0;
	$synceddata = 0;
	$procstop = 0;
	global $url;
	
	// set api request url
	$urladdress = $url[0].$shop_wallet_address.'&start='.$page.'&limit=100&sort=-timestamp';
	$page = $page + 100;
	
	// send api request
	$jresponse = json_decode(apiclient($urladdress,$curlconn),true);

	foreach ($jresponse['data'] as $value) {
		
			// set value to default
			$order_assignment = 0;
			$order_state = 'Offen';
			$trans_orderid = '';
			$trans_amount = '';
			
			// check last hashvalue
			$result = dbquery($dbconn[0], "SELECT transactionHash FROM transactions WHERE transactionHash = '".$value['transactionHash']."' ORDER BY pkid DESC" );
			
			if ((mysqli_num_rows($result) == 0) && ($value['transferToAddress'] == $shop_wallet_address)){
				// extract currency name
				$trans_currency = $value['tokenName'];	
				
				// formating TRX amount (sun)
				if ($trans_currency == 'TRX'){$trans_amount = $value['amount']/1000000;}
				else {$trans_amount = $value['amount'];}		
				
				// request transaction information -> note
				$transferdata = json_decode(apiclient($url[1].$value['transactionHash'],$curlconn),true);
				
				// parsing transaction information
				if ($transferdata['data']<>''){
					preg_match("/(\d+)/", str_replace('%20',' ',(hex2bin($transferdata['data']))) , $trans_orderid);
					
					// check orderinformations -> create sql query
					$gambiopaymentcheck = "SELECT orders.customers_id AS customers_id, orders.orders_id AS orders_id, orders.orders_status AS orders_status, orders_products.final_price AS final_price, currencies.title AS currencytitle, orders.currency AS currency, orders.currency_value AS currency_value FROM orders ";
					$gambiopaymentcheck .= "INNER JOIN orders_products ON orders.orders_id = orders_products.orders_id ";
					$gambiopaymentcheck .= "INNER JOIN currencies ON orders.currency = currencies.code WHERE orders.orders_id ='".$trans_orderid[1]."'";
					
					// check orderinformations -> send sql query to database
					$gambioresult = mysqli_query($dbconn[1], $gambiopaymentcheck);
					
					// check if order exists
					if (mysqli_num_rows($gambioresult) > 0) {
						// orderid and purpose of use match
						$order_assignment = 1;
						
						// extract data
						$orderdata = mysqli_fetch_assoc($gambioresult);
						
						// create sql query -> modify gambio db -> change orderstate to 'payment error'
						$gambio_update_orderstate="UPDATE orders SET orders_status = 162 WHERE orders_status='1' AND orders_id='".$trans_orderid[1]."'";
						
						// check if the currency matches
						if ($orderdata['currencytitle'] == $value['tokenName']){
						    // order complete
							if ($orderdata['final_price'] == $value['amount']){
								$gambio_update_orderstate = "UPDATE orders SET orders_status = 161 WHERE orders_status='1' AND orders_id='".$trans_orderid[1]."'";
								$gambio_update_history = set_dbquery_gambio_orderhistory($trans_orderid[1],'161',date("Y-m-d H:i:s",$value['timestamp']/1000),'Zahlung erhalten - '.$trans_amount.' '.$trans_currency.' Transaktion-Hash: '.$value['transactionHash']);
								$order_state = "Zahlung erhalten";
							}
							// Value bill value does not match
							else {
								$gambio_update_history = set_dbquery_gambio_orderhistory($trans_orderid[1],'162',date("Y-m-d H:i:s",$value['timestamp']/1000),'Betrag entspricht nicht der Rechnung - '.$trans_amount.' '.$trans_currency.' Transaktion-Hash: '.$value['transactionHash']);
								$order_state = "Betrag entspricht nicht der Rechnung";
							}
						}
						
						// currency of the transfer is not correct
						else {
							$gambio_update_history = set_dbquery_gambio_orderhistory($trans_orderid[1],'162',date("Y-m-d H:i:s",$value['timestamp']/1000),'Coin/Token entspricht nicht der Rechnung - '.$trans_amount.' '.$trans_currency.' Transaktion-Hash: '.$value['transactionHash']);
							$order_state = "Coin/Token entspricht nicht der Rechnung";
						}
												
						// check if ordersync option true
						if (getdbparameter('ordersync') == '1'){						
							// send status to database
							dbquery($dbconn[1], $gambio_update_orderstate);
							
							// set orderhistory
							if(mysqli_affected_rows($dbconn[1])){
								dbquery($dbconn[1], $gambio_update_history);
							}
						}
						
						// check if the wallet address should be learned
						if (getdbparameter('walletuserassociation')=='1'){
												
							// generate query
							$query="SELECT COUNT(*) AS count FROM customers_memo WHERE ((customers_id = '".$orderdata['customers_id']."') AND (memo_title = 'TRON Wallet Address') AND (memo_text='".$value['transferFromAddress']."'))";
							
							// check if order exists
							if (mysqli_fetch_assoc(mysqli_query($dbconn[1], $query))['count']=='0'){								
								dbquery($dbconn[1],"INSERT INTO customers_memo(customers_id,memo_date,memo_title,memo_text) VALUES ('".$orderdata['customers_id']."','".date("d.m.Y",time())."','TRON Wallet Address','".$value['transferFromAddress']."')");
							}
						}
					} 
					else {
						// reset order id
						$trans_orderid[1] = '';
						$orderdata['currencytitle'] = '';
						$orderdata['final_price'] = '';
					}					
				} 
				else {
					// set orderstate
					$order_state = 'Verwendungszweck fehlt';
					$orderdata['currencytitle'] = '';
					$orderdata['final_price'] = '';
				}
				// write values into table
				$dbquery  = "INSERT INTO transactions( transactionHash,block,timestamp,transferFromAddress,transferToAddress,amount,tokenName,data,confirmed,orderstatus,orderid,currency,orderprice ) ";
				$dbquery .= "VALUES ('".$value['transactionHash']."','".$value['block']."','".$value['timestamp']."','".$value['transferFromAddress']."','".$value['transferToAddress']."','".$trans_amount."','".$value['tokenName']."','".$transferdata['data']."','".$order_assignment."','".$order_state."','".$trans_orderid[1]."','".$orderdata['currencytitle']."','".$orderdata['final_price']."')";
				
				// check if data was written successfully
				if (mysqli_query($dbconn[0], $dbquery)) {$synceddata++;}
				else { echo "Error: " . $sql . "<br>" . mysqli_error($conn);}
			}
			else {$procstop=1;}
		}
		// set last sync value
		setdbparameter('synctime',date("d.m.Y H:i:s",time()));
		setdbparameter('syncdatacount',$synceddata);
	}
	while(((count($jresponse['data']))>0)&&($procstop==0)); 
}


// function blockchainsync
function blockchain_gen_transtbl($dbconn){
	
echo '<table class="gx-compatibility-table" cellspacing="0" cellpadding="0" border="0">
			  <tbody>
				  <tr class="dataTableHeadingRow gx-container">
				  <td class="dataTableHeadingContent" style="width: 36px">Block</td>
				  <td class="dataTableHeadingContent" style="width: 130px">Zeitpunkt</td>
				  <td class="dataTableHeadingContent" style="width: 120px">Transaktion Hash</td>
				  <td class="dataTableHeadingContent" style="width: 120px">Absender</td>
				  <td class="dataTableHeadingContent" style="width: 40px">Anzahl</td>
				  <td class="dataTableHeadingContent" style="width: 60px">Währung</td>
				  <td class="dataTableHeadingContent" style="width: 120px">Verwendungszweck</td>
				  <td class="dataTableHeadingContent" style="width: 40px">Bestellung zugewiesen</td>
				  <td class="dataTableHeadingContent" style="width: 40px">Bestellnummer</td>
				  <td class="dataTableHeadingContent" style="width: 60px">Rechnungsbetrag</td>
				  <td class="dataTableHeadingContent" style="width: 40px">Status</td>
			</tr>';

$dbquery = "SELECT * FROM transactions ORDER BY block DESC";
$result = mysqli_query($dbconn[0], $dbquery);
if (mysqli_num_rows($result) > 0) {
    while($value = mysqli_fetch_assoc($result)) {

		  if ($value['orderprice']<>''){$orderprice=round($value['orderprice'],2).'('.$value['currency'].')';}else{$orderprice='';};
		  if ($value['confirmed']=='1'){$trnscnf='JA';} else {$trnscnf='NEIN';};
		  echo '<tr class="dataTableRowSelected visibility_switcher gx-container" style="cursor: pointer;">';
		  echo '<td class="dataTableContent">'.hyperlink_tronscan_hash($value['block'],'block').'</td>';
		  echo '<td class="dataTableContent">'.date("d.m.Y H:i:s",$value['timestamp']/1000).'</td>';
		  echo '<td class="dataTableContent">'.hyperlink_tronscan_hash($value['transactionHash'],'transaction').'</td>';
		  echo '<td class="dataTableContent">'.hyperlink_tronscan_hash($value['transferFromAddress'],'address').'</td>';
		  echo '<td class="dataTableContent">'.$value['amount'].'</td>';
		  echo '<td class="dataTableContent">'.$value['tokenName'].'</td>';
		  echo '<td class="dataTableContent">'.str_replace('%20',' ',(hex2bin($value['data']))).'</td>';
		  echo '<td class="dataTableContent">'.$trnscnf.'</td>';
		  echo '<td class="dataTableContent">'.hyperlink_gambio_ordersummary($value['orderid']).'</td>';
		  echo '<td class="dataTableContent">'.$orderprice.'</td>';
		  echo '<td class="dataTableContent">'.$value['orderstatus'].'</td>';
		  echo '</tr>'; 	  	
		}
	}
  echo '</tbody></table></br>';
}

function system_gen_syncbutton($url,$title,$infotext){
  $button = '<div class="files-not-uploaded" style="word-wrap: break-word; margin-bottom: 30px">';
  $button .=  '<button class="btn btn-default btn-lg" type="button" onclick="location.replace(\''.$url.'\')">'.$title.'</button>   '.$infotext.'</div>';
  // return button
  return $button;
}


?>
