<?php
// $Id: weblinks_constant.php,v 1.2 2012/04/10 18:52:29 ohwada Exp $

// 2008-02-17 K.OHWADA
// WEBLINKS_C_KML_PERPAGE

// 2007-11-01
// WEBLINKS_OP_APPROVE_NEW

// 2007-08-01 K.OHWADA
// admin can add etc column

// 2007-06-01
// WEBLINKS_DEBUG_LINK_CATLINK_BASIC_SQL

// 2007-03-01 K.OHWADA
// hack for multi site
// performance

// 2006-12-10 K.OHWADA
// add WEBLINKS_DEV_PERMIT

// 2006-10-05 K.OHWADA
// add WEBLINKS_DEBUG_TABLE_CHECK_SQL

// 2006-05-15 K.OHWADA
// this is new file
// move from conf.php
// add WEBLINKS_ID_AUTH_PASSWD, etc

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// 2004/01/21 K.OHWADA
//=========================================================

// --- define language begin ---
if( !defined('WEBLINKS_CONSTANT_LOADED') ) 
{

define('WEBLINKS_CONSTANT_LOADED', 1);

// --- for debug ---
define('WEBLINKS_DEBUG_ERROR', 0);

define('WEBLINKS_DEBUG_CONFIG2_SQL',   0 );
define('WEBLINKS_DEBUG_LINKITEM_SQL',  0 );
define('WEBLINKS_DEBUG_CATEGORY_SQL',  0 );
define('WEBLINKS_DEBUG_CATLINK_SQL',   0 );
define('WEBLINKS_DEBUG_LINK_SQL',      0 );
define('WEBLINKS_DEBUG_MODIFY_SQL',    0 );
define('WEBLINKS_DEBUG_BROKEN_SQL',    0 );
define('WEBLINKS_DEBUG_VOTEDATA_SQL',  0 );

// define('WEBLINKS_DEBUG_LINK_CATLINK_SQL',    0 );


// 2007-03-01
define('WEBLINKS_DEBUG_CONFIG2_BASIC_SQL',   0 );
define('WEBLINKS_DEBUG_LINKITEM_BASIC_SQL',  0 );
define('WEBLINKS_DEBUG_CATEGORY_BASIC_SQL',  0 );
define('WEBLINKS_DEBUG_CATLINK_BASIC_SQL',   0 );
define('WEBLINKS_DEBUG_LINK_BASIC_SQL',      0 );

// 2007-05-26
define('WEBLINKS_DEBUG_LINK_CATLINK_BASIC_SQL', 0 );

define('WEBLINKS_DEBUG_TIME', 0 );

// 2006-10-05
define('WEBLINKS_DEBUG_TABLE_CHECK_SQL',   0 );

// 2006-12-10
define('WEBLINKS_DEV_PERMIT',       0 );
define('WEBLINKS_DEV_PERMIT_GUEST', 0 );

// 2007-11-01
define('WEBLINKS_DEBUG_MEMORY',   0 );

// 2008-02-17
define('WEBLINKS_DEBUG_MAX_SQL', 4000 );

// --- contant ---
define('WEBLINKS_ID_AUTH_UID',    '-99');
define('WEBLINKS_ID_AUTH_PASSWD', '-88');

define('WEBLINKS_C_MODE_NON',  0);
define('WEBLINKS_C_MODE_RDF',  1);
define('WEBLINKS_C_MODE_RSS',  2);
define('WEBLINKS_C_MODE_ATOM', 3);
define('WEBLINKS_C_MODE_AUTO', 4);

define('WEBLINKS_CODE_NORMAL',               0);
define('WEBLINKS_CODE_DB_ERROR',           201);
define('WEBLINKS_CODE_PARAM_ERROR',        202);
define('WEBLINKS_CODE_ADD_RSSC_SUCCEEDED', 203);
define('WEBLINKS_CODE_NOT_READ_URL',       204);

define('WEBLINKS_CODE_RSSC_NO_RSS_FLAG',    211);
define('WEBLINKS_CODE_RSSC_NO_RDF_URL',     212);
define('WEBLINKS_CODE_RSSC_NO_RSS_URL',     213);
define('WEBLINKS_CODE_RSSC_NO_ATOM_URL',    214);
define('WEBLINKS_CODE_RSSC_MODE_AUTO',      215);
define('WEBLINKS_CODE_RSSC_NOT_FIND_PARAM', 216);

// 2007-08-01
define('WEBLINKS_LINK_BROKEN_DEFAULT', 5);

// 2007-11-01
define('WEBLINKS_OP_APPROVE_NEW', 'approve_new');
define('WEBLINKS_OP_APPROVE_MOD', 'approve_mod');
define('WEBLINKS_OP_APPROVE_DEL', 'approve_del');

// 2008-02-17
define('WEBLINKS_C_KML_PERPAGE', 100);

// 2012-04-02
define('WEBLINKS_C_GM_MODE_NON',       0);
define('WEBLINKS_C_GM_MODE_DEFAULT',   1);
define('WEBLINKS_C_GM_MODE_PARENT',    2);
define('WEBLINKS_C_GM_MODE_FOLLOWING', 3);

//---------------------------------------------------------
// hack for etc columns in link table
// do NOT change
//---------------------------------------------------------
define('WEBLINKS_USE_LINK_NUM_ETC', 0);
define('WEBLINKS_LINK_NUM_ETC',     5);

//---------------------------------------------------------
// hack for multi site
// do NOT change
//---------------------------------------------------------
define('WEBLINKS_FLAG_MULTI_SITE', '0');
define('WEBLINKS_DB_PREFIX', 'multi');

}

?>