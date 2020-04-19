<?php


/**
 * @param string $root
 * Function that returns root path
 *
 * @return string|null
 */

function getHtmlRootFolder( string $root = '/home/paravinj/' ) {
	// -- try to use DOCUMENT_ROOT first --
	$ret = str_replace( ' ', '', $_SERVER['DOCUMENT_ROOT'] );
	$ret = rtrim( $ret, '/' ) . '/';

	// -- if doesn't contain root path, find using this file's loc. path --
	if ( ! preg_match( "#" . $root . "#", $ret ) ) {
		$root     = rtrim( $root, '/' ) . '/';
		$root_arr = explode( "/", $root );
		$pwd_arr  = explode( "/", getcwd() );
		$ret      = $root . $pwd_arr[ count( $root_arr ) - 1 ];
	}

	return ( preg_match( "#" . $root . "#", $ret ) ) ? rtrim( $ret, '/' ) . '/' : null;
}


require_once getHtmlRootFolder() . 'valkyrie/vendor/autoload.php';

// Classes
include_once getHtmlRootFolder() . 'valkyrie/DisplayWebsiteEnitres.php';
include_once getHtmlRootFolder() . 'valkyrie/Firestore.php';
//include_once getHtmlRootFolder() . 'valkyrie/SaveData.php';
