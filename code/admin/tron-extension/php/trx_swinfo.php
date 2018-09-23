<?php
/* --------------------------------------------------------------
   Tron Europe Dev Team
   Filename: trx_swinfo.php 
   
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
	include 'inc/global_lib.php';
	include 'inc/global_settings.php';

	// generate table
	echo '<td class="boxCenter" width="100%" valign="top">
				<div class="pageHeading" float: none; left: 200px; top: 46px; position: fixed;">'.fieldvalue('SYSTEM_INFO','language').'</div>
					<div class="main" >
						<table width="30%" cellspacing="0" cellpadding="0"><tbody><tr class="gx-container">
						   <td>
							   <img align="middle" src="./tron-extension/img/troneurope_logo.png" width="300" height="100" align="bottom">							   
							   <table class="gx-configuration">
								   <tbody>
									  <tr><th colspan="2" class="dataTableHeadingContent_gm"></tr>
									  <tr><td>Software Version</td><td>0.1-24092018</td></tr>	
									  <tr><td>Releasedate</td><td>24.09.2018</td></tr>
									  <tr><td>Report an Issue</td><td><a href="https://github.com/Tron-Europe-DevTeam/Gambio-TronBlockchainConnector/issues/new" target="_blank" rel="noopener">Github Issue</a></td></tr>
									  <tr><td>Website</td><td><a href="https://tron-europe.org" target="_blank" rel="noopener">tron-europe.org</a></td></tr>
								   </tbody>
								</table>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
		</td>';
?>
