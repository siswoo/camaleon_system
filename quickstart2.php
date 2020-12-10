<?php
require('vendor/autoload.php');
use SheetDB\SheetDB;

$sheetdb = new SheetDB('cdq2nce5q24u7');
//$response = $sheetdb->get(); // returns all spreadsheets data
//$response = $sheetdb->keys(); // returns all spreadsheets key names
//$response = $sheetdb->name(); // returns name of a spreadsheet document

$sheetdb->create(['name'=>'Mark','age'=>'35']);
$sheetdb->create([
	['name'=>'Chris','age'=>'34'],
	['name'=>'Amanda','age'=>'29'],
]);

?>