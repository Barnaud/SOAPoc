<?php
ini_set("soap.wsdl_cache_enabled","0");
ini_set('default_socket_timeout', 120);
require_once('bddWebService.php');


try{
$server = new SoapServer('bddServ.wsdl');
$server->setClass('bddWebService', $mdp);
$server->handle();
}
catch(SoapFault $e) {
     error_log("SOAP ERROR: ". $e->getMessage());
 }

 ?>