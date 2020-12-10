<?php

require __DIR__ . '/vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('Google Sheets and PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credenciales.json');
//$client->setPrompt('select_account consent');

$service = new Google_Service_Sheets($client);
$spreadsheetId = "1FSae6xGTcmmHjAFFQObKjIq0IKmjUh5f_0HdHQG9WG8";

/***************LEER DATOS*****************/
/*
$range = 'Hoja 1!A1:B3';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

if (empty($values)) {
    print "No data found.\n";
} else {
    print "Nombre, Apellido:\n";
    foreach ($values as $row) {
        // Print columns A and E, which correspond to indices 0 and 4.
        printf("%s, %s\n", $row[0], $row[1]);
    }
}
/**********************************************/


/******************EDITAR DATOS***************/
/*
$range = 'Hoja 1!A1:E3';
$values = [
	["Test","OK","Jeje","Ok2","Klous"]
];

$body = new Google_Service_Sheets_ValueRange([
	'values' => $values
]);

$params = [
	'valueInputOption' => 'RAW'
];

$result = $service->spreadsheets_values->update(
	$spreadsheetId,
	$range,
	$body,
	$params
);
/*********************************************/


/***********INGRESAR DATOS***********/
/*
$range = 'Hoja 1';
$values = [
	["Test","OK","Jeje","Ok2","Klous"]
];

$body = new Google_Service_Sheets_ValueRange([
	'values' => $values
]);

$params = [
	'valueInputOption' => 'RAW'
];

$insert = [
	"insertDataOption" => "INSERT_ROWS"
];

$result = $service->spreadsheets_values->append(
	$spreadsheetId,
	$range,
	$body,
	$params,
	$insert
);
/*************************************/

