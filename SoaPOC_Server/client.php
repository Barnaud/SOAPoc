<?php
session_start();
// model
class Book
{
	public $name;
	public $year;
}

// create instance and set a book name
$book      =new Book();
$book->name='test 2';

// initialize SOAP client and call web service function
$client=new SoapClient('http://localhost:8888/SoaPOC/test.wsdl',['trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE]);
$resp  =$client->bookYear($book->name);

// dump response
var_dump($resp);
echo '</br>'.$_SERVER['REQUEST_URI'];
?>