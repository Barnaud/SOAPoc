<?php
session_start();
// turn off WSDL caching
ini_set("soap.wsdl_cache_enabled","0");

// model, which uses in web service functions as parameter
class Book
{
	public $name;
	public $year;
}

/**
 * Determines published year of the book by name.
 * @param Book $book book instance with name set.
 * @return int published year of the book or 0 if not found.
 */
function bookYear($book)
{
	
	if(isset($_SESSION["a"])){
		$_SESSION["a"]+=1;
	}
	else{
		$_SESSION["a"]=1;
	}
	// list of the books
	$_books=[
		['name'=>'test 1','year'=>2011],
		['name'=>'test 2','year'=>2012],
		['name'=>'test 3','year'=>2013],
	];
	// search book by name
/*	foreach($_books as $bk)
		if($bk['name']==$book)
			return $bk['year']; // book found

	return 0;*/
	return($_SESSION["a"]);
}

// initialize SOAP Server
$server=new SoapServer("test.wsdl");

// register available functions
$server->addFunction('bookYear');

// start handling requests
$server->handle();
?>