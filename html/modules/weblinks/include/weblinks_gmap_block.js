/* ========================================================
 * $Id: weblinks_gmap_block.js,v 1.1 2011/12/29 14:32:34 ohwada Exp $
 * http://code.google.com/apis/maps/index.html
 * ========================================================
 */

/* --------------------------------------------------------
 * change log
 * 2008-02-17
 *   show_map_control, show_map_type_control
 * --------------------------------------------------------
 */

function weblinks_gm_b_show( gmap, point, info_arr, show_map_control, show_map_type_control ) 
{
	if ( show_map_control == 1 ) {
		gmap.addControl( new GSmallMapControl() );
	}
	if ( show_map_type_control == 1 ) {
		gmap.addControl( new GMapTypeControl() );
	}
	gmap.setCenter( new GLatLng( parseFloat( point[0] ) , parseFloat( point[1] ) ) , Math.floor( point[2] ) );
	for( i=0 ; i<info_arr.length ; i++ ){
		gmap.addOverlay( weblinks_gm_b_create_marker( info_arr[i] ) );
	}
}

function weblinks_gm_b_create_marker( info ) 
{
	var marker = new GMarker( new GLatLng( parseFloat( info[0] ) , parseFloat( info[1] ) ) );
	GEvent.addListener( marker , "click" , function() {
		marker.openInfoWindowHtml( info[2] );
	});
	return marker;
}
