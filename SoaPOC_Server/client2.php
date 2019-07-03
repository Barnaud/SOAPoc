<?php
// initialize SOAP client and call web service function
ini_set('default_socket_timeout', 3600);

    $client=new SoapClient('http://localhost:8888/SoaPOC/bddserv.wsdl', array(
    'trace' =>true,
    'connection_timeout' => 5000,
    'cache_wsdl' => WSDL_CACHE_NONE,
    'keep_alive' => false,
));
    $client->__setLocation('http://localhost:8888/SoaPOC/bddserv.php');
try{
	$resp=$client->getAll();


}
catch(SoapFault $e) {
     var_dump($e->getMessage());
 }

// dump response
 var_dump($resp);
?>
