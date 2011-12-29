<?php
// $Id: weblinksD3commentContent.class.php,v 1.1 2011/12/29 14:33:05 ohwada Exp $

// === class begin ===
if( !class_exists('weblinksD3commentContent') ) 
{

//=========================================================
// class weblinksD3commentContent
// a class for d3forum comment integration
// 2007-06-10 photosite <http://www.photositelinks.com/>
//=========================================================
class weblinksD3commentContent extends D3commentAbstract 
{

function fetchSummary( $external_link_id )
{
	$db =& Database::getInstance() ;
	$myts =& MyTextSanitizer::getInstance();
	
	$module_handler =& xoops_gethandler( 'module' ) ;
	$module =& $module_handler->getByDirname( $this->mydirname ) ;
	
	$weblinks_id = intval( $external_link_id ) ;
	$mydirname = $this->mydirname ;
	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	$content_row = $db->fetchArray( $db->query( "SELECT lid, title, description FROM ".$db->prefix($mydirname."_link")." WHERE lid=$weblinks_id" ) ) ;
	if( empty( $content_row ) ) return '' ;

	$uri = XOOPS_URL.'/modules/'.$mydirname.'/singlelink.php?&lid='.$weblinks_id;

	$str = strip_tags($myts->displayTarea(strip_tags($content_row['description'])));
	$summary = xoops_substr( $str , 0 , 255 );

	return array(
		'dirname' => $mydirname ,
		'module_name' => $module->getVar( 'name' ) ,
		'subject' => $myts->makeTboxData4Show( $content_row['title'] ) ,
		'uri' => $uri,
		'summary' => $summary,
	) ;
}

function validate_id( $link_id )
{
	$weblinks_id = intval( $link_id ) ;
	$mydirname = $this->mydirname ;

	$db =& Database::getInstance() ;
	
	$time   = time();

	list( $count ) = $db->fetchRow( $db->query( "SELECT COUNT(*) FROM ".$db->prefix($mydirname."_link")." WHERE lid=$weblinks_id AND comment_use AND ( time_publish = 0 OR time_publish < ". $time ." ) AND ( time_expire = 0 OR time_expire > ". $time ." )" ) ) ;

	if( $count <= 0 ) return false ;
	else return $weblinks_id ;
}

function onUpdate( $mode , $link_id , $forum_id , $topic_id , $post_id = 0 )
{
	$weblinks_id = intval( $link_id ) ;
	$mydirname = $this->mydirname ;

	$db =& Database::getInstance() ;

	list( $count ) = $db->fetchRow( $db->query( "SELECT COUNT(*) FROM ".$db->prefix($this->d3forum_dirname."_posts")." p LEFT JOIN ".$db->prefix($this->d3forum_dirname."_topics")." t ON t.topic_id=p.topic_id WHERE t.forum_id=$forum_id AND t.topic_external_link_id='$weblinks_id'" ) ) ;
	$db->queryF( "UPDATE ".$db->prefix($mydirname."_link")." SET comments=$count WHERE lid=$weblinks_id" ) ;

	return true ;
}

// --- class end ---
}

// === class end ===
}

?>