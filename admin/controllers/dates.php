<?php

/*
 * Example PHP implementation used for date examples
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

// Allow a number of different formats to be submitted for the various demos
$format = isset( $_GET['format'] ) ?
	$_GET['format'] :
	'';

if ( $format === 'custom' ) {
	$update = 'n/j/Y';
	$registered = 'l j F Y';
}
else {
	$update = "Y-m-d";
	$registered = "Y-m-d";
}

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'users' )
	->fields(
		Field::inst( 'first_name' ),
		Field::inst( 'last_name' ),
		Field::inst( 'updated_date' )
			->validator( Validate::dateFormat(
				$update,
				ValidateOptions::inst()
					->allowEmpty( false )
			) )
			->getFormatter( Format::dateSqlToFormat( $update ) )
			->setFormatter( Format::dateFormatToSql( $update ) ),
		Field::inst( 'registered_date' )
			->validator( Validate::dateFormat( $registered ) )
			->getFormatter( Format::dateSqlToFormat( $registered ) )
			->setFormatter( Format::dateFormatToSql( $registered ) )
	)
	->process( $_POST )
	->json();
