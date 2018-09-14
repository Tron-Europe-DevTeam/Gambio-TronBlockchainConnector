<?php

require('includes/application_top.php');
?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html <?php echo HTML_PARAMS; ?>>
		<head>
			<meta http-equiv="x-ua-compatible" content="IE=edge">
			<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['language_charset']; ?>">
			<title><?php echo TITLE; ?></title>
			<link rel="stylesheet" type="text/css" href="html/assets/styles/legacy/stylesheet.css">
		</head>
		<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="SetFocus();">
			<!-- header //-->
			<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
			<!-- header_eof //-->
			
			<!-- body //-->
			<table border="0" width="100%" cellspacing="2" cellpadding="0">
				<tr>
					<td class="columnLeft2" width="<?php echo BOX_WIDTH; ?>" valign="top">						
						<table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="0" class="columnLeft">
							<!-- left_navigation //-->
							<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
							<!-- left_navigation_eof //-->
						</table>
					</td>					
					<!-- body_text //-->
						<?php require('tron-extension/inc/trx_settings.php'); ?>
					<!-- body_text_eof //-->
				</tr>
			</table>
			<!-- body_eof //-->

			<!-- footer //-->
			<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
			<!-- footer_eof //-->
			<br />
		</body>
	</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php');
