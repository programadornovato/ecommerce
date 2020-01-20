<?php

/*
 * Example PHP implementation used for date time examples
 */

// DataTables PHP library
include( "../lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;


// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'users' )
	->fields(
		Field::inst( 'first_name' ),
		Field::inst( 'last_name' ),
		Field::inst( 'updated_date' )
			->validator( Validate::dateFormat(
				'm-d-Y g:i A',
				ValidateOptions::inst()
					->allowEmpty( false )
			) )
			->getFormatter( Format::datetime(
				'Y-m-d H:i:s',
				'm-d-Y g:i A'
			) )
			->setFormatter( Format::datetime(
				'm-d-Y g:i A',
				'Y-m-d H:i:s'
			) ),
		Field::inst( 'registered_date' )
			->validator( Validate::dateFormat(
				'j M Y H:i'
			) )
			->getFormatter( Format::datetime(
				'Y-m-d H:i:s',
				'j M Y H:i'
			) )
			->setFormatter( Format::datetime(
				'j M Y H:i',
				'Y-m-d H:i:s'
			) )
	)
	->process( $_POST )
	->json();
