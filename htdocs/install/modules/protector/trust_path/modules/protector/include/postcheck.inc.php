<?php

require_once dirname(__FILE__).'/postcheck_functions.php' ;

if( ! defined( 'PROTECTOR_PRECHECK_INCLUDED' ) ) {
	require dirname(__FILE__).'/precheck.inc.php' ;
	return ;
}

define( 'PROTECTOR_POSTCHECK_INCLUDED' , 1 ) ;
if( ! class_exists( 'icms_db_legacy_Factory' ) ) return ;
protector_postcommon() ;
