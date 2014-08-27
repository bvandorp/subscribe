<?php
$nieuwsbrief = $hook->getValue('nieuwsbrief');
$email = $hook->getValue('email');

if($nieuwsbrief=='ja'){

	$curl = curl_init('https://www.graphicmail.com/api.aspx?Username=username&Password=password&Function=post_subscribe&Email='.$email.'&MailinglistID=123456&SID=4');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	// Send the request
	$result = curl_exec($curl);

	$curl_error = curl_error($curl);
	
	// Free up the resources $curl is using
	curl_close($curl);
	
	if(!empty($curl_error)){
		//$hook->addError('nieuwsbrief',$error);
		$modx->log(xPDO::LOG_LEVEL_ERROR,$error);
	}else{
		$check = explode('|',$result);

		if($check[0]==1){
			return true;
		}elseif($check[0]==2){
			return true;
		}else{
			$hook->addError('nieuwsbrief',$check[1]);
			return false;
		}
	}


}else{
	return true;
}