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
 * Example PHP implementation used for the joinLinkTable.html example
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
		Field::inst( 'sites.name' ),
		Field::inst( 'user_dept.dept_id' )
            ->options( Options::inst()
                ->table( 'dept' )
                ->value( 'id' )
                ->label( 'name' )
            ),
		Field::inst( 'dept.name' )
	)
	->leftJoin( 'sites',     'sites.id',          '=', 'users.site' )
	->leftJoin( 'user_dept', 'users.id',          '=', 'user_dept.user_id' )
	->leftJoin( 'dept',      'user_dept.dept_id', '=', 'dept.id' )
	->process($_POST)
	->json();
