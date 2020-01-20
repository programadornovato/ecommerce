<?php

/*
 * Example PHP implementation used for time examples
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
		Field::inst( 'city' ),
		Field::inst( 'shift_start' )
			->validator( Validate::dateFormat(
				'g:i A',
				ValidateOptions::inst()
					->allowEmpty( false )
			) )
			->getFormatter( Format::datetime( 'H:i:s', 'g:i A' ) )
			->setFormatter( Format::datetime( 'g:i A', 'H:i:s' ) ),
		Field::inst( 'shift_end' )
			->validator( Validate::dateFormat(
				'H:i:s',
				ValidateOptions::inst()
					->allowEmpty( false )
			) )
	)
	->process( $_POST )
	->json();

