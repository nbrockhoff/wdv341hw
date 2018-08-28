<?php
try {
	$DB = new PDO( "mysql:host=wdv341hw.db;dbname=wdv341", "nderrb", "reaver42", array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ) );
	//die( json_encode( array( 'outcome' => true ) ) );
	$DB->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$connection_status = "successful";
} catch ( PDOException $e ) {

	die( json_encode( array( 'outcome' => false, 'message' => 'Unable to connect' ) ) );
	$result_message = "<h1><strong>Connection unsuccessful. </strong></h1>";
	die( "Could not connect to database" );
}

?>