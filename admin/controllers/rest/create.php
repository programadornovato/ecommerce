<?php

/*
 * Example PHP implementation used for the REST 'create' interface.
 */

include( "staff-rest.php" );

$data = $editor
	->process($_POST)
	->data();

// If there is an error, indicate it like a REST service would with a status code
if ( isset($data['fieldErrors']) && count($data['fieldErrors']) ) {
	http_response_code( 400 );
}

echo json_encode( $data );