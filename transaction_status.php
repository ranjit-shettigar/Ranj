<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

	// following files need to be included
	require_once("C:/xampp/htdocs/carou/public/paytm/lib/config_paytm.php");
	require_once("C:/xampp/htdocs/carou/public/paytm/lib/encdec_paytm.php");
	// require_once("../");

	$ORDER_ID = "";
	$requestParamList = array();
	$responseParamList = array();

	if (isset($_POST["ORDER_ID"]) && $_POST["ORDER_ID"] != "") {

		// In Test Page, we are taking parameters from POST request. In actual implementation these can be collected from session or DB. 
		$ORDER_ID = $_POST["ORDER_ID"];

		// Create an array having all required parameters for status query.
		$requestParamList = array("MID" => PAYTM_MERCHANT_MID , "ORDERID" => $ORDER_ID);  
		
		$StatusCheckSum = getChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY);
		
		$requestParamList['CHECKSUMHASH'] = $StatusCheckSum;

		// Call the PG's getTxnStatusNew() function for verifying the transaction status.
		$responseParamList = getTxnStatusNew($requestParamList);
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Transaction status query</title>
<meta name="GENERATOR" content="Evrsoft First Page">
</head>
<body>
	<h2>Transaction status query</h2>
	<form method="post" action="">
		<table class="table">
			<tbody>
				<tr>
					<td><label>ORDER_ID: *</label></td>
					<td><input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo $ORDER_ID ?>">
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input class="btn btn-danger" value="Check Status" type="submit"	onclick=""></td>
				</tr>
			</tbody>
		</table>
		<br/></br/>
		<?php
		if (isset($responseParamList) && count($responseParamList)>0 )
		{ 
		?>
		<h2>Response of status query:</h2>
		<div class="table-responsive">
			<table class="table table-hover">
				<tbody>
					<?php
						foreach($responseParamList as $paramName => $paramValue) {
					?>
					<tr>
						<td><label><?php echo $paramName?></label></td>
						<td><?php echo $paramValue?></td>
					</tr>
					<?php
						}
					?>
					<tr>
						<td><label>CHECKSUMHASH</label></td>
						<td><?php echo $requestParamList['CHECKSUMHASH']; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php
		}
		?>
	</form>
</body>
</html>