<?php
// $Id: weblinks_catlist.php.\040CDS\040Patch.php,v 1.1 2012/04/09 10:21:09 ohwada Exp $

// 2006-05-15 K.OHWADA
// change $moduel_url to $dirname

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// 2004-10-20 K.OHWADA
//=========================================================

// ========================================================
// FILE		::	weblinks_catlist.php
// AUTHOR	::	Ryuji AMANO <info@ryus.biz>
// WEB		::	Ryu's Planning <http://ryus.biz/>
// ========================================================

// --- block function begin ---
if( !function_exists( 'b_weblinks_catlist_show' ) ) 
{

//---------------------------------------------------------
// $options
// [0] module directory name (weblinks)
// [1] the display number of subcategory (5)
// [2] category image mode (1)
//       0: none
//       1: folder.gif
//       2: category image
// [3] max width of catergory image (100)
//       when 0, not show
// [4] default width of catergory image (50)
//       when 0, use original size
//---------------------------------------------------------

function b_weblinks_catlist_show($options) 
{
	global $xoopsDB;

	require_once(XOOPS_ROOT_PATH."/class/xoopstree.php");

	$dirname = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];
	$num_show      = $options[1];
	$image_mode    = $options[2];
	$max_width     = $options[3];
	$width_default = $options[4];

	$WEBLINKS_URL   = XOOPS_URL."/modules/".$dirname;
	$table_category = $xoopsDB->prefix( $dirname."_category" );
	$table_catlink  = $xoopsDB->prefix( $dirname."_catlink" );
	$table_link     = $xoopsDB->prefix( $dirname."_link" );

    (method_exists('MyTextSanitizer', 'sGetInstance') and $myts =& MyTextSanitizer::sGetInstance()) || $myts =& MyTextSanitizer::getInstance(); // MyTextSanitizer object
    $mytree = new XoopsTree($table_category,"cid","pid");

    $count = 1;
    $retVars = array();

	$MAX_BROKEN = 5;

	$sql = "SELECT count(*) FROM ".$table_link." WHERE broken < $MAX_BROKEN";
	$array = $xoopsDB->fetchRow( $xoopsDB->query( $sql ) );
	$num   = $array[0];
	if (empty($num)) $num = 0;
	$retVars["total_links"] = $num;

	$retVars["lang_total_links"] = _MB_WEBLINKS_TOTAL_LINKS;
	$retVars["lang_links"]       = _MB_WEBLINKS_LINKS;

// top catergory
	$sql = "SELECT * FROM ".$table_category." WHERE pid=0 ORDER BY orders, cid";
	$result = $xoopsDB->query($sql);
	while($record = $xoopsDB->fetchArray($result))
	{
		$cid    = $record['cid'];
		$title  = $record['title'];
		$imgurl = $record['imgurl'];

// image
		$imgurl_myts = '';
		$width       = 0;
		$height      = 0;
		if (($image_mode == 2) && ($max_width > 0) && $imgurl && ($imgurl != "http://"))
		{
			$imgurl_myts = htmlspecialchars($imgurl, ENT_QUOTES);

			if ( get_cfg_var('allow_url_fopen') )
			{
				$size = GetImageSize( $imgurl );
				if ($size)
				{
					$width = intval( $size[0] );

					if ($width > $max_width)
					{
						$width = $max_width;
					}
				}
			}

			if (($width == 0) && ($width_default > 0))
			{
				$width = $width_default;
			}
		}

// number of links by category
		$sql = "SELECT count(DISTINCT lid) FROM ".$table_catlink." WHERE cid=".$cid;
		$child_array = $mytree->getAllChildId($cid);

		if ( count($child_array) > 0 )
		{
			$sql .= " OR cid=";
			$sql .= implode(" OR cid=", $child_array);
		}

		$countResult = $xoopsDB->query($sql);
		list($totallink) = $xoopsDB->fetchRow($countResult);

// sub category list
		$subcategories="";
/* CDS Patch. Weblinks. 2.00. 9. BOF */
		$subcategories_list = '';
		$subcategories_more = '';
/* CDS Patch. Weblinks. 2.00. 9. EOF */

// bug fix: show all sub categories when $options[0] = 0
		if ( $num_show > 0 )
		{
			$sql = "SELECT count(*) FROM ".$table_category." WHERE pid=".$cid;
			$subCategoriesCountResult = $xoopsDB->query($sql);
			list($subCategoriesCount) = $xoopsDB->fetchRow($subCategoriesCountResult);

			if ( $subCategoriesCount > 0 )
			{
				$sql = "SELECT cid,title FROM ".$table_category." WHERE pid=".$cid." ORDER BY orders ASC, cid ASC";
				$subCategoreisResult = $xoopsDB->query($sql, $num_show, 0);
				$subcategories = array();
/* CDS Patch. Weblinks. 2.00. 9. BOF */
				$subcategories_list = array();
/* CDS Patch. Weblinks. 2.00. 9. EOF */

/* CDS Patch. Weblinks. 2.00. 9. BOF */
				$i = 0;
/* CDS Patch. Weblinks. 2.00. 9. EOF */
				while( $subCategory = $xoopsDB->fetchArray($subCategoreisResult) )
				{
					$ch_id    = $subCategory['cid'];
					$ch_title = $myts->makeTboxData4Show( $subCategory['title'] );
					$subcategories[] = "<a href='".$WEBLINKS_URL."/viewcat.php?cid=".$ch_id."'>".$ch_title."</a>";
/* CDS Patch. Weblinks. 2.00. 9. BOF */
					$subcategories_list[$i] = array();
					$subcategories_list[$i]['id'] = $ch_id;
					$subcategories_list[$i]['title'] = $ch_title;
					$i++;
/* CDS Patch. Weblinks. 2.00. 9. EOF */
				}

				$subcategories = implode(", ", $subcategories);

				if ($subCategoriesCount > $num_show)
				{
					$subcategories .= "...";
/* CDS Patch. Weblinks. 2.00. 9. BOF */
					$subcategories_more = 1;
/* CDS Patch. Weblinks. 2.00. 9. EOF */
				}
			}
		}

		$retVars["categories"][] = array(
			'id'            => $cid,
			'imgurl'        => $imgurl_myts,
			'width'         => $width,
			'subcategories' => $subcategories, 
/* CDS Patch. Weblinks. 2.00. 9. BOF */
			'subcategories_list' => $subcategories_list, 
			'subcategories_more' => $subcategories_more, 
/* CDS Patch. Weblinks. 2.00. 9. EOF */
			'totallink'     => $totallink, 
			'count'         => $count,
			'title'         => $myts->makeTboxData4Show($title),
		);

		$count++;
	}

	$retVars["dirname"]    = $dirname;
	$retVars["image_mode"] = $image_mode;
	return $retVars;
}

// by Tom
function b_weblinks_catlist_edit($options)
{
	$dirname = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];

	$image_mode_checked = array('', '', '');
	$image_mode_checked[ $options[2] ] = 'checked';

	$form  = "<table><tr><td>";
	$form .= "Module Directory: ";
	$form .= "</td><td>";
	$form .= "$dirname ";
	$form .= "<input type='hidden' name='options[0]' value='".$dirname."' />\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_DISPSUB;
	$form .= "</td><td>";
	$form .= "<input type='text' name='options[1]' value='".$options[1]."' />&nbsp;"._MB_WEBLINKS_LINKS."";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_IMAGE_MODE;
	$form .= "</td><td>";
	$form .= "<input type='radio' name='options[2]' value='0' ".$image_mode_checked[0]." />&nbsp;"._MB_WEBLINKS_IMAGE_MODE_0."&nbsp";
	$form .= "<input type='radio' name='options[2]' value='1' ".$image_mode_checked[1]." />&nbsp;"._MB_WEBLINKS_IMAGE_MODE_1."&nbsp";
	$form .= "<input type='radio' name='options[2]' value='2' ".$image_mode_checked[2]." />&nbsp;"._MB_WEBLINKS_IMAGE_MODE_2." ";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_MAX_WIDTH;
	$form .= "</td><td>";
	$form .= "<input type='text' name='options[3]' value='".$options[3]."' /> ";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_WIDTH_DEFAULT;
	$form .= "</td><td>";
	$form .= "<input type='text' name='options[4]' value='".$options[4]."' /> ";
	$form .= "</td></tr></table>\n";

	return $form;
}

// --- block function begin end ---
}

?>