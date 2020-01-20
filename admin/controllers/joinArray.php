<?php

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


/*
 * Example PHP implementation used for the join.html example
 */
Editor::inst( $db, 'users' )
	->field( 
		Field::inst( 'users.first_name' ),
		Field::inst( 'users.last_name' ),
		Field::inst( 'users.site' )
			->options( Options::inst()
				->table( 'sites' )
				->value( 'id' )
				->label( 'name' )
			),
		Field::inst( 'sites.name' )
	)
	->leftJoin( 'sites', 'sites.id', '=', 'users.site' )
	->join(
		Mjoin::inst( 'permission' )
			->link( 'users.id', 'user_permission.user_id' )
			->link( 'permission.id', 'user_permission.permission_id' )
			->order( 'name asc' )
			->validator( 'permission[].id', Validate::mjoinMaxCount(4, 'No more than four selections please') )
			->fields(
				Field::inst( 'id' )
					->validator( Validate::required() )
					->options( Options::inst()
						->table( 'permission' )
						->value( 'id' )
						->label( 'name' )
					),
				Field::inst( 'name' )
			)
	)
	->process($_POST)
	->json();
