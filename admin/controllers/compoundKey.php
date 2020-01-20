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


// The key thing to note for compound key support is the use of an array as the
// third parameter for the Editor constructor, which is used to tell Editor what
// the primary key column(s) are called (default is just `id`).
Editor::inst( $db, 'users_visits', array('user_id', 'visit_date') )
	->debug( true )
	->field( 
		Field::inst( 'users_visits.user_id' )
            ->options( Options::inst()
                ->table( 'users' )
                ->value( 'id' )
                ->label( array('first_name', 'last_name') )
            )
			->validator( Validate::dbValues() ),
		Field::inst( 'users_visits.site_id' )
            ->options( Options::inst()
                ->table( 'sites' )
                ->value( 'id' )
                ->label( 'name' )
            )
			->validator( Validate::dbValues() ),
		Field::inst( 'users_visits.visit_date' )
			->validator( Validate::dateFormat( 'Y-m-d' ) )
			->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
			->setFormatter( Format::dateFormatToSql('Y-m-d' ) ),
		Field::inst( 'sites.name' )
			->set( false ),
		Field::inst( 'users.first_name' )
			->set( false ),
		Field::inst( 'users.last_name' )
			->set( false )
	)
	->leftJoin( 'sites', 'users_visits.site_id', '=', 'sites.id' )
	->leftJoin( 'users', 'users_visits.user_id', '=', 'users.id' )
	->validator( function ($editor, $action, $data) {
		if ( $action == Editor::ACTION_EDIT ) {
			// Detect duplicates
			foreach ($data['data'] as $key => $values) {
				// Get the row's primary key components
				$pkey = $editor->pkeyToArray( $key );

				// Discount the row being edited
				if ( $pkey['users_visits']['user_id'] != $values['users_visits']['user_id'] ||
					 $pkey['users_visits']['visit_date'] != $values['users_visits']['visit_date'] )
				{
					// Are there any rows that conflict?
					$any = $editor->db()->any( 'users_visits', function ($q) use ($pkey, $values) {
						$q->where( 'user_id', $values['users_visits']['user_id']);
						$q->where( 'visit_date', $values['users_visits']['visit_date'] );
					} );

					// If there was a matching row, then report an error
					if ( $any ) {
						return 'This staff member is already busy that day.';
					}
				}
			}
		}
	} )
	->process($_POST)
	->json();
