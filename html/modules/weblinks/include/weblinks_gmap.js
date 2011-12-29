/* ========================================================
 * $Id: weblinks_gmap.js,v 1.1 2011/12/29 14:32:34 ohwada Exp $
 * http://code.google.com/apis/maps/index.html
 * ========================================================
 */

/* --------------------------------------------------------
 * change log
 * 2008-02-12
 *   add G_PHYSICAL_MAP to MapType
 * --------------------------------------------------------
 */

var weblinks_gm_gmap = null;

/* 37.0 -95.0 : Chetopa Kansas: center point of USA */
var weblinks_gm_latitude  =  37.0;
var weblinks_gm_longitude = -95.0;
var weblinks_gm_zoom      = 4;

var weblinks_gm_url          = '';
var weblinks_gm_map_control  = 'small';
var weblinks_gm_type         = 'normal';
var weblinks_gm_use_type     = true;
var weblinks_gm_use_scale    = false;
var weblinks_gm_use_overview = false;
var weblinks_gm_use_center_marker   = false;

var weblinks_gm_lang_not_compatible = "Your browser cannot use GoogleMaps";

var weblinks_gm_info = new Array();

function weblinks_gm_load() 
{
	if ( GBrowserIsCompatible() ) {
		weblinks_gm_show();
	} else {
		document.getElementById("weblinks_gm_not_compatible").innerHTML = weblinks_gm_lang_not_compatible;
	}
}

function weblinks_gm_show() 
{
	weblinks_gm_gmap = new GMap2( document.getElementById( "weblinks_gm_map" ) );
	if ( weblinks_gm_map_control == 'large' ) {
		weblinks_gm_gmap.addControl( new GLargeMapControl() );
	} else if ( weblinks_gm_map_control == 'small' ) {
		weblinks_gm_gmap.addControl( new GSmallMapControl() );
	} else if ( weblinks_gm_map_control == 'zoom' ) {
		weblinks_gm_gmap.addControl( new GSmallZoomControl() );
	}
	if ( weblinks_gm_use_type ) {
		weblinks_gm_gmap.addControl( new GMapTypeControl() );
		weblinks_gm_gmap.addMapType( G_PHYSICAL_MAP );
	}
	if ( weblinks_gm_use_scale ) {
		weblinks_gm_gmap.addControl( new GScaleControl() );
	}
	if ( weblinks_gm_use_overview ) {
		weblinks_gm_gmap.addControl( new GOverviewMapControl() );
	}
	weblinks_gm_gmap.setCenter( new GLatLng( parseFloat( weblinks_gm_latitude ) , parseFloat( weblinks_gm_longitude ) ) , Math.floor( weblinks_gm_zoom ) );

/* MUST be setMapType() after setCenter() */
	if ( weblinks_gm_type == 'satellite' ) {
		weblinks_gm_gmap.setMapType( G_SATELLITE_MAP );
	} else if ( weblinks_gm_type == 'hybrid' ) {
		weblinks_gm_gmap.setMapType( G_HYBRID_MAP );
	} else if ( weblinks_gm_type == 'physical' ) {
		weblinks_gm_gmap.setMapType( G_PHYSICAL_MAP );
	}

	if ( weblinks_gm_use_center_marker ) {
		weblinks_gm_show_center_marker();
	}
	for ( i=0 ; i<weblinks_gm_info.length ; i++ ) {
		weblinks_gm_gmap.addOverlay( weblinks_gm_create_marker( weblinks_gm_info[i] ) );
	}
}
function weblinks_gm_show_center_marker() 
{
	var icon = new GIcon();
	icon.image = weblinks_gm_url + "/images/marker/marker_cross.png";
	icon.iconSize = new GSize(20, 34);
	icon.iconAnchor = new GPoint(9, 34);
	icon.infoWindowAnchor = new GPoint(9, 2);
	var marker = new GMarker( 
		weblinks_gm_gmap.getCenter(), { icon:icon }
	);
	weblinks_gm_gmap.addOverlay( marker );
}
function weblinks_gm_create_marker( info ) 
{
	var marker = new GMarker( new GLatLng( parseFloat( info[0] ) , parseFloat( info[1] ) ) );
	GEvent.addListener( marker , "click" , function() {
		marker.openInfoWindowHtml( info[2] );
	});
	return marker;
}
