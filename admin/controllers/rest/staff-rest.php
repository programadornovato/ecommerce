<?php

/*
 * Example PHP implementation used for the REST example.
 * This file defines a DTEditor class instance which can then be used, as
 * required, by the CRUD actions.
 */

// DataTables PHP library
include( dirname(__FILE__)."/../../lib/DataTables.php" );

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
$editor = Editor::inst( $db, 'datatables_demo' )
	->fields(
		Field::inst( 'first_name' )
		->validator( Validate::notEmpty( ValidateOptions::inst()
			->message( 'A first name is required' )	
		) ),
	Field::inst( 'last_name' )
		->validator( Validate::notEmpty( ValidateOptions::inst()
			->message( 'A last name is required' )	
		) ),
	Field::inst( 'position' ),
	Field::inst( 'email' )
		->validator( Validate::email( ValidateOptions::inst()
			->message( 'Please enter an e-mail address' )	
		) ),
	Field::inst( 'office' ),
	Field::inst( 'extn' ),
	Field::inst( 'age' )
		->validator( Validate::numeric() )
		->setFormatter( Format::ifEmpty(null) ),
	Field::inst( 'salary' )
		->validator( Validate::numeric() )
		->setFormatter( Format::ifEmpty(null) ),
	Field::inst( 'start_date' )
		->validator( Validate::dateFormat( 'Y-m-d' ) )
		->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
		->setFormatter( Format::dateFormatToSql('Y-m-d' ) )	);
