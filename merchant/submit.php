<?php
include "config.php";
include "payment.php";

class ProcessPayment {
	
	function __construct(){
		$this->paymentConfig = new payment_config();
	}
	
	function requestMerchant(){
		$payment = new payment();
		$datenow = date("d/m/Y h:m:s");
		$modifiedDate = str_replace(" ", "%20", $datenow);
		$payment->url = $this->paymentConfig->Url;
		$postFields  = "";
		$postFields .= "&login=".$this->paymentConfig->Login;
		$postFields .= "&pass=".$this->paymentConfig->Password;
		$postFields .= "&ttype=".$_POST['TType'];
		$postFields .= "&prodid=".$_POST['product'];
		$postFields .= "&amt=".$_POST['amount'];
		$postFields .= "&txncurr=".$this->paymentConfig->TxnCurr;
		$postFields .= "&txnscamt=".$this->paymentConfig->TxnScAmt;
		$postFields .= "&clientcode=".urlencode(base64_encode($_POST['clientcode']));
		$postFields .= "&txnid=".rand(0,999999);
		$postFields .= "&date=".$modifiedDate;
		$postFields .= "&custacc=".$_POST['AccountNo'];
		$postFields .= "&udf1=".$_POST['udf1'];
		$postFields .= "&udf2=".$_POST['udf2'];
		$postFields .= "&udf3=".$_POST['udf3'];
		$postFields .= "&udf4=".$_POST['udf4'];
		$postFields .= "&ru=".$_POST['ru'];
		// Not required for merchant
		//$postFields .= "&bankid=".$_POST['bankid'];

		$sendUrl = $payment->url."?".substr($postFields,1)."\n";

		$this->writeLog($sendUrl);
		
		$returnData = $payment->sendInfo($postFields);
		$this->writeLog($returnData."\n");
		$xmlObjArray     = $this->xmltoarray($returnData);

		$url = $xmlObjArray['url'];
		$postFields  = "";
		$postFields .= "&ttype=".$_POST['TType'];
		$postFields .= "&tempTxnId=".$xmlObjArray['tempTxnId'];
		$postFields .= "&token=".$xmlObjArray['token'];
		$postFields .= "&txnStage=1";
		$url = $payment->url."?".$postFields;
		$this->writeLog($url."\n");
		header("Location: ".$url);
		
	}

	function writeLog($data){
		$fileName = date("Y-m-d").".txt";
		$fp = fopen("log/".$fileName, 'a+');
		$data = date("Y-m-d H:i:s")." - ".$data;
		fwrite($fp,$data);
		fclose($fp);
	}

	function xmltoarray($data){
		$parser = xml_parser_create('');
		xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); 
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($parser, trim($data), $xml_values);
		xml_parser_free($parser);
		
		$returnArray = array();
		$returnArray['url'] = $xml_values[3]['value'];
		$returnArray['tempTxnId'] = $xml_values[5]['value'];
		$returnArray['token'] = $xml_values[6]['value'];

		return $returnArray;
	}
}

$processPayment = new ProcessPayment();
$processPayment->requestMerchant();
?>