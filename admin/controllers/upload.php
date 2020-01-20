<?php

/*
 * Example PHP implementation used for the index.html example
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
		Field::inst( 'phone' ),
		Field::inst( 'city' ),
		Field::inst( 'image' )
			->setFormatter( Format::ifEmpty( null ) )
			->upload( Upload::inst( $_SERVER['DOCUMENT_ROOT'].'/uploads/__ID__.__EXTN__' )
				->db( 'files', 'id', array(
					'filename'    => Upload::DB_FILE_NAME,
					'filesize'    => Upload::DB_FILE_SIZE,
					'web_path'    => Upload::DB_WEB_PATH,
					'system_path' => Upload::DB_SYSTEM_PATH
				) )
				->validator( Validate::fileSize( 500000, 'Files must be smaller that 500K' ) )
				->validator( Validate::fileExtensions( array( 'png', 'jpg', 'jpeg', 'gif' ), "Please upload an image" ) )
			)
	)
	->process( $_POST )
	->json();
