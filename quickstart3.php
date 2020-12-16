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
//$range = 'Hoja 1!A1:B3';
$range = 'Hoja 1!A1:E';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

$columnas = count($values);

if (empty($values)) {
    print "No data found.\n";
} else {
    echo '
    	<div class="col-12">
    		<table border="1">
    			<tr>
    				<td>Nombres</td>
    				<td>Apellidos</td>
    				<td>Extra1</td>
    				<td>Extra2</td>
    				<td>Extra3</td>
    			</tr>
    ';
    
    for ($i=0;$i<=$columnas;$i++) {
    	@$campo1 = $values[$i][0];
    	@$campo2 = $values[$i][1];
    	@$campo3 = $values[$i][2];
    	@$campo4 = $values[$i][3];
    	@$campo5 = $values[$i][4];

    	if(@$campo1==""){
    		$campo1 = '';
    	}

    	if(@$campo2==""){
    		$campo2 = '';
    	}

    	if(@$campo3==""){
    		$campo3 = '';
    	}

    	if(@$campo4==""){
    		$campo4 = '';
    	}

    	if(@$campo5==""){
    		$campo5 = '';
    	}

    	if($campo1!='' and $campo2!=''){
    		echo '
	    		<tr>
	    			<td>'.$campo1.'
	    			<td>'.$campo2.'
	    			<td>'.$campo3.'
	    			<td>'.$campo4.'
	    			<td>'.$campo5.'
	    		</tr>
    		';
    	}
    }
}
/**********************************************/


/******************EDITAR DATOS***************/
/*
$range = 'Hoja 1!A4'; //POR CADA CAMPO DE POSICIONA SOLA, ENTONCES SOLO INDICAR CAMPO DE INICIO
$values = [
	["Erick","Vallesteros","IMASDE","TROP","Thanos"]
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

/****************EDITAR DATOS ESPECIFICOS Y TITULO DE DOC************************/
/*
$title = 'PRUEBA DE API';
$find = 'Juan';
$replacement = 'CAMBIADO';

$requests = [
  new Google_Service_Sheets_Request([
      'updateSpreadsheetProperties' => [
          'properties' => [
              'title' => $title
          ],
          'fields' => 'title'
      ]
  ]),
  // Find and replace text.
  new Google_Service_Sheets_Request([
      'findReplace' => [
          'find' => $find,
          'replacement' => $replacement,
          'allSheets' => true
      ]
  ])
];

// Add additional requests (operations) ...
$batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
    'requests' => $requests
]);

$response = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
$findReplaceResponse = $response->getReplies()[1]->getFindReplace();
printf("%s replacements made.\n",
$findReplaceResponse->getOccurrencesChanged());

/***************************************************************************************/


/***********INGRESAR DATOS***********/
/*
$range = 'Hoja 1';
$values = [
	//["Test","OK","Jeje","Ok2","Klous"]
	["","","","",""]
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

/************CREAR HOJA DE CALCULO (PERO ENVIA INVITACION A ALGUIEN MAS)***************/
/*
$title = 'API CREADA AUTOMATICAMENTE';

$spreadsheet = new Google_Service_Sheets_Spreadsheet([
    'properties' => [
        'title' => $title
    ]
]);
$spreadsheet = $service->spreadsheets->create($spreadsheet, [
    'fields' => 'spreadsheetId'
]);
printf("Spreadsheet ID: %s\n", $spreadsheet->spreadsheetId);

/*************************************************************************************/



/***************ELIMINAR*****************/



/****************************************/