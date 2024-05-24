define( [
	"../var/rnothtmlwhite"
], function( rnothtmlwhite ) {
	"use strict";

	// Strip and collapse whitespace according to HTML spec
	
	function stripAndCollapse( value ) {
		var tokens = value.match( rnothtmlwhite ) || [];
		return tokens.join( " " );
	}

	return stripAndCollapse;
} );
