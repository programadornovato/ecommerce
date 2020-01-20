<?php

/*
 * Example PHP implementation used for the REST 'create' interface.
 */

include( "staff-rest.php" );

// The REST example uses 'PUT' for the input, so we need to get the 
// parameters being sent to us from php://input
parse_str( file_get_contents('php://input'), $args );

$data = $editor
	->process($args)
	->data();

// If there is an error, indicate it like a REST service would with a status code
if ( isset($data['fieldErrors']) && count($data['fieldErrors']) ) {
	http_response_code( 400 );
}

echo json_encode( $data );
