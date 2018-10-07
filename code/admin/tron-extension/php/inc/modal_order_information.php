<?php
/* --------------------------------------------------------------
   Tron Europe Dev Team
   Filename: modal_order_information.php 
   
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
	
	// extract language
	$language = $_GET['language'];
	
	// extract order
	$orderid = $_GET['orderid'];
	
	// extract action
	$action = $_GET['action'];
	
	//create dbconnection
	$dbconn = dbconnect($dbname[0]);
	
	// btn remove
	$btn_remove = '';
	
	// check dbconnection
	if (dbconncheck($dbconn)) {
		
		// create sql query
		$dbquery = "SELECT trx_transaction.transactionstate,trx_transaction.transactionHash,trx_transaction.block,trx_transaction.timestamp,trx_transaction.transferFromAddress,trx_transaction.transferToAddress,trx_transaction.amount,trx_transaction.tokenName,trx_transaction.data,trx_transaction.orderassignment,trx_transaction.orderid, trx_order.orderprice, trx_order.currency, trx_order.orderstatus FROM trx_transaction "; 
		$dbquery .= "LEFT OUTER JOIN trx_order ON  trx_order.orderid = trx_transaction.orderid WHERE transactionHash = '".$hash."'";
		
		// collect sql db data
		$data = mysqli_fetch_assoc(dbquery($dbquery));
		
		// format orderprice
		if ($data['orderprice']<>''){$orderprice=round($data['orderprice'],2).' '.$data['currency'];}else{$orderprice='';};
		if ($data['orderassignment']=='1'){$trnscnf=fieldvalue('GLOBAL_YES','language',$language);} else {$trnscnf=fieldvalue('GLOBAL_NO','language',$language);};

		if ($action == 'order-assignment'){
												
			// generate modal-content
			echo system_gen_modal_header ('Transaction - '.$hash,true);
			echo '<div class="trx-modal-content content-transaction">
					  <table>
						  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_BLOCK','language',$language).'</td><td class="td-global">'.hyperlink_tronscan_hash($data['block'],'block').'</td></tr>
						  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_TRANSACTION_HASH','language',$language).'</td><td class="td-global">'.hyperlink_tronscan_hash($data['transactionHash'],'transaction').'</td></tr>
						  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_TIMESTAMP','language',$language).'</td><td class="td-global">'.date("d.m.Y H:i:s",$data['timestamp']/1000).'</td></tr>
						  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_SENDER','language',$language).'</td><td class="td-global">'.hyperlink_tronscan_hash($data['transferFromAddress'],'address').'</td></tr>
						  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_RECEIVER','language',$language).'</td><td class="td-global">'.hyperlink_tronscan_hash($data['transferToAddress'],'address').'</td></tr>
						  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_QUANTITY','language',$language).'</td><td class="td-global">'.$data['amount'].' '.$data['tokenName'].'</td></tr>
						  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_TRANSFERSTATUS','language',$language).'</td><td class="td-global"><span class="label '.fieldvalue($data['transactionstate'],'label').'">'.fieldvalue($data['transactionstate'],'language',$language).'</span></td>
						  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_PURPOSE_OF_USE','language',$language).'</td><td class="td-global">'.rawurldecode(hex2bin($data['data'])).'</td></tr>
					  </table>
				  </div>';
				  if ($orderid<>''){
					  echo system_gen_modal_header ('Order - '.$orderid,false);
					  echo '
					  <div class="trx-modal-content content-order">
						  <table>
							  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_ORDERASSIGNMENT','language',$language).'</td><td class="td-global">'.$trnscnf.'</td></tr>
							  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_ORDERNUMBER','language',$language).'</td><td class="td-global">'.hyperlink_gambio_ordersummary($data['orderid']).'</td></tr>
							  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_TOTAL_AMOUNT','language',$language).'</td><td class="td-global">'.$orderprice.'</td></tr>
							  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_STATUS','language',$language).'</td><td class="td-global"><span class="label '.fieldvalue($data['orderstatus'],'label').'">'.fieldvalue($data['orderstatus'],'language',$language).'</span></td></tr>
						  </table>
					  </div>';
					  $btn_remove = '<button type="button" onclick="ordersearch(event,\'remove\',\''.$data['orderid'].'\',\'trx-orderform\',\''.$data['transactionHash'].'\')" class="btn btn-primary save btn-data">'.fieldvalue('BTN_REMOVE_ORDERASSIGNMENT','language',$language).'</button>';
					  };  
			echo system_gen_modal_header ('Order Assignment',false);
			echo '<div class="trx-modal-content content-order-useraction">
					  <table>
						  <tr><td class="td-global td-title">'.fieldvalue('GLOBAL_SEARCH','language',$language).'</td><td class="dataTableContent_gm"><input style="width:300px;" id="trx-search" autocomplete="off" onkeypress="ordersearch(event,\'search\',this.value,\'trx-orderform\',\''.$data['transactionHash'].'\')"></td></tr>
						  <tr><td class="td-global td-title">'.fieldvalue('MANUAL_ORDERASSIGNMENT','language',$language).'</td>
							  <td class="dataTableContent_gm">
									<select id="trx-orderform" class="form-control"><option value="-1">No Data</option></select>
							  </td>
						  </tr>
					  </table>
				  </div>
				  <div class="trx-modal-header">
					<table>
					<tr><td class="td-global td-title"><p><img align="middle" src="./tron-extension/img/tron_icon_grey.png" width="26" height="26"></p></td>
						<td>
						<button type="button" onclick="ordersearch(event,\'change\',\'data\',\'trx-orderform\',\''.$data['transactionHash'].'\')" class="btn btn-primary save btn-data">'.fieldvalue('BTN_ORDERASSIGNMENT','language',$language).'</button>'.$btn_remove.'						
					</td></tr>
					</table>
				  </div>';
		}
		else if ($action == 'order-information'){
			echo system_gen_modal_header ('Order - '.$orderid,true);
			echo '
			<div class="trx-modal-content content-order">
			  <table>
				  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_ORDERASSIGNMENT','language',$language).'</td><td class="td-global">'.$trnscnf.'</td></tr>
				  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_ORDERNUMBER','language',$language).'</td><td class="td-global">'.hyperlink_gambio_ordersummary($data['orderid']).'</td></tr>
				  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_TOTAL_AMOUNT','language',$language).'</td><td class="td-global">'.$orderprice.'</td></tr>
				  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_STATUS','language',$language).'</td><td class="td-global"><span class="label '.fieldvalue($data['orderstatus'],'label').'">'.fieldvalue($data['orderstatus'],'language',$language).'</span></td></tr>
			  </table>
			</div>';

			// create sql query
			$dbquery = "SELECT transactionHash,timestamp,transferFromAddress,amount,tokenName,transactionstate FROM trx_transaction WHERE orderid = '".$orderid."'";
			$result = dbquery($dbquery);
			
			// Tokensummary
			echo system_gen_modal_header ('Transactionsummary',false);
			
			unset($token);
			// collect sql db data
			while($data = mysqli_fetch_assoc($result)) {
				echo '<div class="trx-modal-content content-transaction-summary"><table>
					  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_TIMESTAMP','language',$language).'</td><td class="td-global" colspan="2">'.date("d.m.Y H:i:s",$data['timestamp']/1000).'</td></tr>
					  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_TRANSACTION_HASH','language',$language).'</td><td class="td-global" colspan="2">'.hyperlink_tronscan_hash($data['transactionHash'],'transaction').'</td></tr>
					  <tr><td class="td-global td-title">'.fieldvalue('TBL_TITLE_QUANTITY','language',$language).'</td><td class="td-global td-title">'.$data['amount'].' '.$data['tokenName'].'</td><td class="td-global"><span class="label '.fieldvalue($data['transactionstate'],'label').'">'.fieldvalue($data['transactionstate'],'language',$language).'</span></td></tr>
					  </table></div>';
				$tokensummary[$data['tokenName']]['amount']=$tokensummary[$data['tokenName']]['amount']+$data['amount'];	  
				}
			// generate tokeninformation	
			echo system_gen_modal_header ('Summary'.$token['TRX']['amount'],false);		
			
			foreach ($tokensummary as $token => $value) {
				echo '<div class="trx-modal-content content-token-summary"><table>';
				echo '<tr><td>'.$value['amount'].' '.$token.'</td></tr>';
				echo '</table></div>';
				
			}
		}
	}	

		  
?>