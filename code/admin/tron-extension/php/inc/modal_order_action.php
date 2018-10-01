<?php
/* --------------------------------------------------------------
   Tron Europe Dev Team
   Filename: modal_order_action.php 
   
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
	$data=$_GET['data'];
	
    // extract transaction hash
	$action=$_GET['action'];

	//create dbconnection
	$dbconn = dbconnect($dbname[0]);
	
	// generate default error
	$default_error = '<option value="-1">No Data</option>';
	
	// check dbconnection
	if (dbconncheck($dbconn)) {
		
		// action -> search	
		if ($action == 'search'){
			// generate sql query
			$dbquery = "SELECT orders_id FROM orders WHERE orders_id like '%".$data."%' LIMIT 10";
			
			// send db query
			$result=dbquery($dbquery);
			
			// check db result
			if (mysqli_num_rows($result) > 0) {
				
				// generate option values
				while($data = mysqli_fetch_assoc($result)) {
					echo '<option value="'.$data['orders_id'].'">'.$data['orders_id'].'</option>';
				}			
			}
			// error message
			else echo $default_error;
		}
		// action -> change
		else if ($action == 'change'){
			if ($data<>'-1'){
			   
			    echo '<option value="'.$data['orders_id'].'">'.$data.'</option>';
			   
				$gambio_order_data = mysqli_fetch_assoc(dbquery(system_gen_gambio_orderquery($data,''));
				
				//tokenName,amount,timestamp,transactionHash,transferFromAddress
				
				
				//order_assignment($gambio_order_data,$transaction_entry,$dbconn,getdbparameter('shopaddress'),$db_transaction_data);				
			}
		}
		
	}	
	// error message
	else echo $default_error;	
?>