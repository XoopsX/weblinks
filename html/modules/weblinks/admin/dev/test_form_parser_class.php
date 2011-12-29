<?php
// $Id: test_form_parser_class.php,v 1.1 2011/12/29 14:32:56 ohwada Exp $

//=========================================================
// WebLinks Module
// 2007-10-30 K.OHWADA
//=========================================================

//=========================================================
// class weblinks_test_form_parser
//=========================================================
class weblinks_test_form_parser
{
	var $_DEBUG = false;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_test_form_parser()
{
	// dummy
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function &parse( $text )
{
	$parser = new HtmlParser( $text );

	$arr = array();
	$form_loop      = false;
	$select_loop    = false;
	$textarea_loop  = false;
	$select_name    = null;
	$select_value   = null;
	$textarea_name  = null;
	$textarea_value = null;

	while ( $parser->parse() ) 
	{
		if ( $this->_DEBUG )
		{
			echo "<br><br>\n";
			echo "Name=" . $parser->iNodeName . ";";
			echo "Type=" . $parser->iNodeType . ";";
		}

		$node_name  = strtolower( $parser->iNodeName );
		$form_begin = false;
		if ( $node_name == 'form' )
		{
			if ( $parser->iNodeType == '1' )
			{
				$form_begin = true;
				$form_loop  = true;	
			}
			elseif ( $parser->iNodeType == '2' )
			{
				$form_loop = false;
			}
		}

		if ( !$form_loop )
		{	continue;	}

		if ( $node_name == 'select' )
		{
			if ( $parser->iNodeType == '1' )
			{
				$select_loop = true;	
				$select_name = null;
				$select_value = null;
			}
			elseif ( $parser->iNodeType == '2' )
			{
				$select_loop = false;
				if ( $select_name == 'cid[]' ) {
					$arr['cid_arr'][] = $select_value;
				} elseif ( $select_name ) {
					$arr[ $select_name ] = $select_value;
				}
			}
		}
		elseif ( $node_name == 'textarea' )
		{
			if ( $parser->iNodeType == '1' )
			{
				$textarea_loop = true;	
				$textarea_name = null;
				$textarea_value = null;
			}
			elseif ( $parser->iNodeType == '2' )
			{
				$textarea_loop = false;
				if ( $textarea_name )
				{	$arr[ $textarea_name ] = $textarea_value;	}
			}
		}

		if ( $parser->iNodeType == NODE_TYPE_TEXT ) 
		{
			if ( $this->_DEBUG )
			{	echo "Value='" . $parser->iNodeValue . "'";	}

			if ( $textarea_loop )
			{	$textarea_value = $parser->iNodeValue;	}
		}
		elseif ( $parser->iNodeType == NODE_TYPE_ELEMENT ) 
		{
			if ( $this->_DEBUG )
			{	echo "ATTRIBUTES: ";	}

			$attrValues = $parser->iNodeAttributes;
			$attrNames  = array_keys($attrValues);
			$size       = count($attrNames);

			$action   = null;
			$type     = null;
			$name     = null;
			$value    = null;
			$selected = false;
			$checked  = false;

			for ($i = 0; $i < $size; $i++) 
			{
				$attr_name  = $attrNames[$i];
				$attr_value = $attrValues[$attr_name];

				if ( $this->_DEBUG )
				{	echo $attr_name . "=\"" . $attr_value . "\" ";	}

				switch ( $attr_name )
				{
					case 'name':
						$name = $attr_value;
						break;

					case 'value':
						$value = $attr_value;
						break;

					case 'type':
						$type = $attr_value;
						break;

					case 'selected':
						$selected = true;
						break;

					case 'checked':
						$checked = true;
						break;

					case 'action':
						$action = $attr_value;
						break;
				}

				if ( $select_loop )
				{
					if ( $name )
					{	$select_name = $name;	}
					if ( $selected )
					{	$select_value = $value;	}
				}
				elseif ( $textarea_loop )
				{
					if ( $name )
					{	$textarea_name = $name;	}
				}
				elseif ( $form_begin )
				{
					$arr['action'] = $action;
				}
				elseif ( $type == 'radio' )
				{
					if ( $checked )
					{	$arr[ $name ] = $value;	}
				}
				elseif ( $type == 'checkbox' )
				{
					if ( $checked )
					{	$arr[ $name ] = $value;	}
				}
				elseif ( $name && ( $value != null) )
				{
					$arr[ $name ] = $value;
				}
			}
		}
	}

	return $arr;
}

// --- class end ---
}

?>