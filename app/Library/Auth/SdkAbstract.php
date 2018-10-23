<?php
namespace APP\Library\Auth;
/**
 * 参数说明：
 *  允许的所有php类型：boolean integer float(double) string array object(stdClass)
 *
 * 返回值说明：
 * 	所有返回值都是一个stdClass，value属性是调用结果，如果errorCode大于零表示调用没有成功运行。
 * 	stdClass Object
 *	(
 *	    [errorCode] => 0
 *	    [errorMessage] => null
 *	    [value] => null
 *		[timecost] => 0
 *	)
 *
 * @author xiepeng@joyport.com
 */

define("SOAP_SERVER_DOMAIN","SOAP_SERVER_DOMAIN");
class SdkAbstract {

	private $client;
	public function __construct($sdk_name) {
		$config = config('auth.sdk');
		$url = $config ['url'];
		$key = $config ['key'];
		$this->client = new \SoapClient ( null, array (
				"location" => $url,
				"uri" => 'SDK'
		) );
		$time = time ();
		$obj = new \stdClass ();
		$obj->project = $sdk_name;
		$obj->time = $time;
		$obj->sign = md5 ( $obj->project . $time . $key );
		$soapVar = new \SoapVar ( $obj, SOAP_ENC_OBJECT, 'proving_user', SOAP_SERVER_DOMAIN );
		$header = new \SoapHeader ( $url, '__auth', $soapVar, true, SOAP_ACTOR_NEXT );
		$this->client->__setSoapHeaders ( array (
				$header
		) );
	}

	function getClient(){
		return $this->client;
	}
}
