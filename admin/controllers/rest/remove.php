<?php

/*
 * Example PHP implementation used for the REST 'delete' interface.
 */

include( "staff-rest.php" );

$editor
	->process( $_GET )
	->json();

