/* ========================================================
 * $Id: weblinks_gmap_location.js,v 1.1 2011/12/29 14:32:33 ohwada Exp $
 * http://code.google.com/apis/maps/index.html
 * ========================================================
 */

/* --------------------------------------------------------
 * change log
 * 2008-02-12
 *   remove setMapType
 * --------------------------------------------------------
 */

/* object */
var weblinks_gmap        = null;
var weblinks_geocoder    = null;
var weblinks_bounds      = null;
var weblinks_bounds_zoom = 0;
var weblinks_drag_icon   = null;
var weblinks_base_icon   = null;
var weblinks_small_icon  = null;
var weblinks_draggable_marker = null;

/* parameter */
var weblinks_map_control  = 'small';
var weblinks_map_type     = 'normal';	/* not use */
var weblinks_use_type     = true;
var weblinks_use_overview = false;
var weblinks_use_scale    = false;
var weblinks_url          = '';
var weblinks_opener_mode  = '';
var weblinks_geocode_kind = '';

/* 37.0 -95.0 : Chetopa Kansas: center point of USA */
var weblinks_default_latitude  = 37.0;
var weblinks_default_longitude = -95.0;
var weblinks_default_zoom      = 4;

/* constant */
var weblinks_zoom_max = 17;
var weblinks_zoom_geocode_default = 12;
var weblinks_zoom_accuracy = 12;
var weblinks_zoom_accuracy_tokyo_univ = 12;

/* language */
var weblinks_lang_not_compatible = "Your browser cannot use GoogleMaps";
var weblinks_lang_no_match_place = "There are no place to match the address";
var weblinks_lang_latitude  = "Latitude";
var weblinks_lang_longitude = "Longitude";
var weblinks_lang_zoom      = "Zoom";

/* for Japanese */
var weblinks_is_japanese = false;

/* Japanese inverse geocoder */
var weblinks_use_nishioka_inverse = false;
var weblinks_address_jp = null;
var weblinks_pref_jp    = null;
var weblinks_city_jp    = null;
var weblinks_town_jp    = null;
var weblinks_number_jp  = null;

/* debug */
var weblinks_DEBUG_geocoder_tokyo_univ = false;
var weblinks_DEBUG_inverse_nishioka    = false;

/* --------------------------------------------------------
 * public functon
 * --------------------------------------------------------
 */

function weblinks_load() 
{
	if ( GBrowserIsCompatible() ) {
		weblinks_show();
	} else {
		document.getElementById("weblinks_not_compatible").innerHTML = weblinks_lang_not_compatible;
	}
}
function weblinks_show() 
{
/* init gmap */
	weblinks_gmap = new GMap2( document.getElementById("weblinks_map") );
	if ( weblinks_map_control == 'large' ) {
		weblinks_gmap.addControl( new GLargeMapControl() );
	} else if ( weblinks_map_control == 'small' ) {
		weblinks_gmap.addControl( new GSmallMapControl() );
	} else if ( weblinks_map_control == 'zoom' ) {
		weblinks_gmap.addControl( new GSmallZoomControl() );
	}
	if ( weblinks_use_type ) {
		weblinks_gmap.addControl( new GMapTypeControl() );
	}
	if ( weblinks_use_scale ) {
		weblinks_gmap.addControl( new GScaleControl() );
	}
	if ( weblinks_use_overview ) {
		weblinks_gmap.addControl( new GOverviewMapControl() );
	}

/* init icon */
	weblinks_drag_icon = new GIcon();
	weblinks_drag_icon.image = weblinks_url + "/images/marker/marker_green_cross_s.png";
	weblinks_drag_icon.iconSize = new GSize(18, 30);
	weblinks_drag_icon.iconAnchor = new GPoint(9, 30);
	weblinks_drag_icon.infoWindowAnchor = new GPoint(9, 2);

	weblinks_base_icon = new GIcon();
	weblinks_base_icon.iconSize = new GSize(20, 34);
	weblinks_base_icon.iconAnchor = new GPoint(9, 34);
	weblinks_base_icon.infoWindowAnchor = new GPoint(9, 2);

	weblinks_small_icon = new GIcon();
	weblinks_small_icon.image = weblinks_url + "/images/marker/marker_small.png";
	weblinks_small_icon.iconSize = new GSize(12, 20);
	weblinks_small_icon.iconAnchor = new GPoint(5, 20);
	weblinks_small_icon.infoWindowAnchor = new GPoint(9, 2);

/* show drag maker */
	weblinks_geocoder = new GClientGeocoder();
	weblinks_moveendMap();

/* set center */
	var now_lat  = weblinks_default_latitude;
	var now_lng  = weblinks_default_longitude;
	var now_zoom = weblinks_default_zoom;

	var parent_flag  = false;
	var parent_param = weblinks_getParentLatitude();
	if ( parent_param ) {
		parent_flag = parent_param[0];
	}

/* if parent param is set */
	if( parent_flag ) {
		now_lat  = parent_param[1];
		now_lng  = parent_param[2];
		now_zoom = parent_param[3];
	}

	weblinks_setCenter( now_lat, now_lng, now_zoom );

	var now_addr = weblinks_getParentAddress();

	if ( now_addr )
	{
		document.getElementById("weblinks_address").value = now_addr.weblinks_htmlspecialchars();

/* if parent param is NOT set */
		if( parent_flag == false )
		{
			weblinks_searchAddress( now_addr );
		}
	}

}
function weblinks_searchAddress( addr )
{
	if ( weblinks_geocode_kind == 'latlng' ) {
		weblinks_geocoder_LatLng( addr )
	} else {
		weblinks_geocoder_Locations( addr );
	}
}
function weblinks_searchAddressJp()
{
	addr = document.getElementById("weblinks_address").value;
	if ( addr )
	{
		weblinks_geocoder_tokyoUniv( addr );
	}
}
function weblinks_setCenter( lat, lng, zoom ) 
{
	weblinks_gmap.setCenter( new GLatLng( parseFloat( lat ) , parseFloat( lng ) ) );
	weblinks_gmap.setZoom( Math.floor(zoom) );
}
function weblinks_setLatitude()
{
	center = weblinks_gmap.getCenter();
	xx = center.x;
	yy = center.y;
	zz = weblinks_gmap.getZoom();
	weblinks_setParentLatitude( yy, xx, zz );
}
function weblinks_dispOff()
{
	weblinks_setParentDispOff();
}
function weblinks_setAddressJp()
{
	var location = weblinks_address_jp;
	var state    = weblinks_pref_jp;
	var city     = weblinks_city_jp;
	var addr     = weblinks_town_jp + weblinks_number_jp;
	weblinks_setParentAddress(location, state, city, addr);
}

/* --------------------------------------------------------
 * private functon
 * --------------------------------------------------------
 */

/* map moveend */
function weblinks_moveendMap() 
{
	GEvent.addListener(weblinks_gmap, "moveend", function() {

		center = weblinks_gmap.getCenter();
		xx = center.x;
		yy = center.y;
		zz = weblinks_gmap.getZoom();

		var location = weblinks_lang_latitude + ': ' + yy + ' / ';
		location += weblinks_lang_longitude + ': ' + xx + ' / ';
		location += weblinks_lang_zoom + ': ' + zz;
		document.getElementById("weblinks_current_location").innerHTML = location; 

		if ( weblinks_use_nishioka_inverse ) {
			weblinks_inverse_nishioka( yy, xx );
		}

		weblinks_showDraggableMarker();
	} );

}

/* draggable marker */
function weblinks_showDraggableMarker() 
{
	if ( weblinks_draggable_marker != null ) {
		weblinks_gmap.removeOverlay( weblinks_draggable_marker );
	}
	weblinks_draggable_marker = new GMarker( 
		weblinks_gmap.getCenter(), 
		{ icon:weblinks_drag_icon , draggable:true , bouncy:true , bounceGravity:0.5 }
	);
	weblinks_gmap.addOverlay( weblinks_draggable_marker );
	weblinks_dragendMarker();
}
function weblinks_dragendMarker() 
{
	GEvent.addListener( weblinks_draggable_marker, "dragend", function() {
		window.setTimeout( function() {
			weblinks_gmap.panTo( weblinks_draggable_marker.getPoint() );
		}, 1000 );
	});
}

/* reference: mygmap module's mygmap_map.js */
String.prototype.weblinks_htmlspecialchars = function() {
	var tmp = this.toString();
	tmp = tmp.replace(/\//g, "");
	tmp = tmp.replace(/&/g, "&amp;");
	tmp = tmp.replace(/"/g, "&quot;");
	tmp = tmp.replace(/'/g, "&#39;");
	tmp = tmp.replace(/</g, "&lt;");
	tmp = tmp.replace(/>/g, "&gt;");
	return tmp;
}

/* --------------------------------------------------------
 * set & get parent
 * --------------------------------------------------------
 */

function weblinks_getParentLatitude() 
{
	lat  = 0;
	lng  = 0;
	zoom = 0;
	flag = false;

	if ( weblinks_opener_mode == 'self' ) 
	{
		if ( document.getElementById("gm_latitude") != null ) {
			lat  = document.getElementById("gm_latitude").value;
		}
		if ( document.getElementById("gm_longitude") != null ) {
			lng  = document.getElementById("gm_longitude").value;
		}
		if ( document.getElementById("gm_zoom") != null ) {
			zoom = document.getElementById("gm_zoom").value;
		}
	}
	else if (( weblinks_opener_mode == 'opener' )&&( opener != null )) 
	{
		if ( opener.document.getElementById("gm_latitude") != null ) {
			lat  = opener.document.getElementById("gm_latitude").value;
		}
		if ( opener.document.getElementById("gm_longitude") != null ) {
			lng  = opener.document.getElementById("gm_longitude").value;
		}
		if ( opener.document.getElementById("gm_zoom") != null ) {
			zoom = opener.document.getElementById("gm_zoom").value;
		}
	}
	else if (( weblinks_opener_mode == 'parent' )&&( parent != null )) 
	{
		if ( parent.document.getElementById("gm_latitude") != null ) {
			lat  = parent.document.getElementById("gm_latitude").value;
		}
		if ( parent.document.getElementById("gm_longitude") != null ) {
			lng  = parent.document.getElementById("gm_longitude").value;
		}
		if ( parent.document.getElementById("gm_zoom") != null ) {
			zoom = parent.document.getElementById("gm_zoom").value;
		}
	}

/* if parent param is set */
	if( (lat != 0) || (lng != 0) || (zoom != 0) ) {
		flag = true;
	}

	arr = new Array(flag, lat, lng, zoom);
	return arr;
}
function weblinks_setParentLatitude( lat , lng , zoom )
{
	if ( weblinks_opener_mode == 'self' ) 
	{
		if ( document.getElementById("gm_latitude") != null ) {
			 document.getElementById("gm_latitude").value = parseFloat( lat );
		}
		if ( document.getElementById("gm_longitude") != null ) {
			 document.getElementById("gm_longitude").value = parseFloat( lng );
		}
		if ( document.getElementById("gm_zoom") != null ) {
			 document.getElementById("gm_zoom").value = Math.floor( zoom );
		}
	}
	else if (( weblinks_opener_mode == 'opener' )&&( opener != null )) 
	{
		if ( opener.document.getElementById("gm_latitude") != null ) {
			 opener.document.getElementById("gm_latitude").value = parseFloat( lat );
		}
		if ( opener.document.getElementById("gm_longitude") != null ) {
			 opener.document.getElementById("gm_longitude").value = parseFloat( lng );
		}
		if ( opener.document.getElementById("gm_zoom") != null ) {
			 opener.document.getElementById("gm_zoom").value = Math.floor( zoom );
		}
	}
	else if (( weblinks_opener_mode == 'parent' )&&( parent != null )) 
	{
		if ( parent.document.getElementById("gm_latitude") != null ) {
			 parent.document.getElementById("gm_latitude").value = parseFloat( lat );
		}
		if ( parent.document.getElementById("gm_longitude") != null ) {
			 parent.document.getElementById("gm_longitude").value = parseFloat( lng );
		}
		if ( parent.document.getElementById("gm_zoom") != null ) {
			 parent.document.getElementById("gm_zoom").value = Math.floor( zoom );
		}
	}
}
function weblinks_getParentAddress()
{
	state = '';
	city  = '';
	addr  = '';

	if ( weblinks_opener_mode == 'self' ) 
	{
		if ( document.getElementById("state") != null ) {
			state = opener.document.getElementById("state").value;
		}
		if ( document.getElementById("city") != null ) {
			city = opener.document.getElementById("city").value;
		}
		if ( document.getElementById("addr") != null ) {
			addr = opener.document.getElementById("addr").value;
		}
	}
	else if (( weblinks_opener_mode == 'opener' )&&( opener != null ))
	{
		if ( opener.document.getElementById("state") != null ) {
			state = opener.document.getElementById("state").value;
		}
		if ( opener.document.getElementById("city") != null ) {
			city = opener.document.getElementById("city").value;
		}
		if ( opener.document.getElementById("addr") != null ) {
			addr = opener.document.getElementById("addr").value;
		}
	}
	else if (( weblinks_opener_mode == 'parent' )&&( parent != null ))
	{
		if ( parent.document.getElementById("state") != null ) {
			state  = parent.document.getElementById("state").value;
		}
		if ( parent.document.getElementById("city") != null ) {
			city  = parent.document.getElementById("city").value;
		}
		if ( parent.document.getElementById("addr") != null ) {
			addr = parent.document.getElementById("addr").value;
		}
	}

	if ( weblinks_is_japanese ) {
		addr_cat = state + city + addr;
	} else {
		addr_cat = addr + ' ' + city + ' ' + state;
	}

	return addr_cat;
}
function weblinks_setParentAddress(location, state, city, addr)
{
	if ( weblinks_opener_mode == 'self' ) 
	{
		if ((document.getElementById("gm_location") != null)&&(location != null)&&(location != '')) {
			 document.getElementById("gm_location").value = location.weblinks_htmlspecialchars();
		}
		if ((document.getElementById("state") != null)&&(state != null)&&(state != '')) {
			 document.getElementById("state").value = state.weblinks_htmlspecialchars();
		}
		if ((document.getElementById("city") != null)&&(city != '')&&(city != null)) {
			 document.getElementById("city").value = city.weblinks_htmlspecialchars();
		}
		if ((document.getElementById("addr") != null)&&(addr != null)&&(addr != '')) {
			 document.getElementById("addr").value = addr.weblinks_htmlspecialchars();
		}
	}
	else if (( weblinks_opener_mode == 'opener' )&&( opener != null ))
	{
		if ((opener.document.getElementById("gm_location") != null)&&(location != null)&&(location != '')) {
			 opener.document.getElementById("gm_location").value = location.weblinks_htmlspecialchars();
		}
		if ((opener.document.getElementById("state") != null)&&(state != null)&&(state != '')) {
			 opener.document.getElementById("state").value = state.weblinks_htmlspecialchars();
		}
		if ((opener.document.getElementById("city") != null)&&(city != null)&&(city != '')) {
			 opener.document.getElementById("city").value = city.weblinks_htmlspecialchars();
		}
		if ((opener.document.getElementById("addr") != null)&&(addr != null)&&(addr != '')) {
			 opener.document.getElementById("addr").value = addr.weblinks_htmlspecialchars();
		}
	}
	else if (( weblinks_opener_mode == 'parent' )&&( parent != null ))
	{
		if ((parent.document.getElementById("gm_location") != null)&&(location != null)&&(location != '')) {
			 parent.document.getElementById("gm_location").value = location.weblinks_htmlspecialchars();
		}
		if ((parent.document.getElementById("state") != null)&&(state != null)&&(state != '')) {
			 parent.document.getElementById("state").value = state.weblinks_htmlspecialchars();
		}
		if ((parent.document.getElementById("city") != null)&&(city != null)&&(city != '')) {
			 parent.document.getElementById("city").value = city.weblinks_htmlspecialchars();
		}
		if ((parent.document.getElementById("addr") != null)&&(addr != null)&&(addr != '')) {
			 parent.document.getElementById("addr").value = addr.weblinks_htmlspecialchars();
		}
	}
}
function weblinks_setParentDispOff()
{
	if (( weblinks_opener_mode == 'parent' )&&( parent != null ))
	{
		if ( parent.document.getElementById("weblinks_gm_iframe") != null) {
			 parent.document.getElementById("weblinks_gm_iframe").innerHTML = '';
		}
	}
}

/* --------------------------------------------------------
 * geocoder Locations
 * --------------------------------------------------------
 */

function weblinks_geocoder_Locations( addr )
{
	if ( addr ) {
		weblinks_geocoder.getLocations( addr , function( response ) {
			if ( !response || response.Status.code != 200 ) {
				alert( weblinks_lang_no_match_place + "\n" + addr );
			} else {
				weblinks_geocoder_LocationsResponse( response );
			}
		} );
	}
}
function weblinks_geocoder_LocationsResponse( response )
{
/* clear all marker */
	weblinks_gmap.clearOverlays();

	var length = response.Placemark.length;
	var weblinks_list = '<ul>';

	for(var i = 0; i< length; i++) {

/* location */
		place = response.Placemark[i];
		addr = place.address;
		lng  = place.Point.coordinates[0];
		lat  = place.Point.coordinates[1];
		zoom = place.AddressDetails.Accuracy + weblinks_zoom_accuracy;
		zoom = weblinks_maxZoom( zoom );

/* add marker */
		weblinks_addMarker( i, lat, lng, zoom, addr );

		weblinks_setBounds( i, lat, lng, zoom );
		weblinks_list += weblinks_getSearchList( i, lat, lng, zoom, addr );
	}

	weblinks_list += '</ul>';
	weblinks_setCenterBounds( length );
	document.getElementById("weblinks_list").innerHTML = weblinks_list;
}
function weblinks_addMarker( index, lat, lng, zoom, addr )
{
	icon = weblinks_createIcon( index );
	html = weblinks_getSearchHtml( index, lat, lng, zoom, addr );
	weblinks_gmap.addOverlay( weblinks_createMarker( lat, lng, icon, html ) );
}
function weblinks_createIcon( index ) 
{
	letter = weblinks_getSmallLetter( index );

	if ( letter ) {
		var icon = new GIcon(weblinks_base_icon);
		icon.image = weblinks_url + "/images/marker/marker_" + letter + ".png";
	} else {
		var icon = new GIcon(weblinks_small_icon);
	}

	return icon;
}
function weblinks_createMarker( lat, lng, icon, html ) 
{
	var marker = new GMarker( new GLatLng( parseFloat( lat ) , parseFloat( lng ) ), icon );
	GEvent.addListener(marker, "click", function() {
		marker.openInfoWindowHtml( html );
	});
	return marker;
}
function weblinks_setBounds( index, lat, lng, zoom )
{
	var point = new GLatLng( parseFloat( lat ) , parseFloat( lng ) );
	if (( Math.floor( index ) == 0 )||( weblinks_bounds_zoom == null)) {
		weblinks_bounds_zoom = Math.floor( zoom );
		weblinks_bounds = new GLatLngBounds( point );
	}
	weblinks_bounds.extend( point );
}
function weblinks_setCenterBounds( length )
{
	var northEastPoint = weblinks_bounds.getNorthEast();
	var southWestPoint = weblinks_bounds.getSouthWest();
	lat = (northEastPoint.lat() + southWestPoint.lat()) / 2;
	lng = (northEastPoint.lng() + southWestPoint.lng()) / 2;

	zoom = weblinks_bounds_zoom;
	if ( length > 1 ) {
		zoom = weblinks_gmap.getBoundsZoomLevel( weblinks_bounds );
	}

	weblinks_setCenter( lat, lng, zoom );
}
function weblinks_getSearchList( index, lat, lng, zoom, addr )
{
	html = weblinks_getSearchHtml( index, lat, lng, zoom, addr );
	list = '<li>' + html + '</li>' + "\n";
	return list;
}
function weblinks_getSearchHtml( index, lat, lng, zoom, addr)
{
	letter = weblinks_getCapitalLetter( index );
	if ( letter == '' ) {
		letter = index + 1;
	}

	func  = "weblinks_setCenter(" + lat + ', '  + lng + ', ' + zoom + ")";
	link  = '<a href="#weblinks_label" onClick="' + func + '">';
	link += addr.weblinks_htmlspecialchars();
	link += '</a>';
	html = '<b>' + letter + '</b> ' + link;
	return html;
}
function weblinks_getCapitalLetter( index ) 
{
	var char = '';
	if (index < 26)
	{
		char = String.fromCharCode("A".charCodeAt(0) + index);
	}
	return char;
}
function weblinks_getSmallLetter( index ) 
{
	var char = '';
	if (index < 26)
	{
		char = String.fromCharCode("a".charCodeAt(0) + index);
	}
	return char;
}
function weblinks_maxZoom( z )
{
	if ( z > weblinks_zoom_max ) {
		z = weblinks_zoom_max;
	}
	return z;
}

/* geocoder LatLng */
function weblinks_geocoder_LatLng( addr )
{
	if ( addr ) {
		weblinks_geocoder.getLatLng(addr, function(point) {
			if ( !point ) {
				alert( weblinks_lang_no_match_place + "\n" + addr );
			} else {
				weblinks_gmap.setCenter( point, Math.floor( weblinks_zoom_geocode_default ) );
			}
		} );
	}
}

/* --------------------------------------------------------
 * for japanese
 * --------------------------------------------------------
 */
/* japanese inverse geocoder */
function weblinks_geocoder_tokyoUniv( addr )
{
	if ( addr ) {
		var url = weblinks_url + '/gm_jp_geocode.php?query=' + encodeURI( addr );

		GDownloadUrl( url , function( data , responseCode ) {
			if( weblinks_DEBUG_geocoder_tokyo_univ ) {
				alert( data );
			}
			if( responseCode == 200 ) {
				xml = GXml.parse( data );

/* fixed javascript errors with IE6 by souhalt */
				if ( xml.documentElement != null ) {
					candidate = xml.documentElement.getElementsByTagName("candidate");
					if ( candidate.length == 0 ) {
						alert( weblinks_lang_no_match_place + "\n" + addr );
					} else {
						weblinks_geocoder_tokyoUnivResponse( xml );
					}
				} else {
					alert( weblinks_lang_no_match_place + "\n" + addr );
				}

			}
		});
	}
}
function weblinks_geocoder_tokyoUnivResponse( xml )
{
/* clear all marker */
	weblinks_gmap.clearOverlays();

	var candidate = xml.documentElement.getElementsByTagName("candidate");
	var iconf = xml.documentElement.getElementsByTagName("iConf")[0].firstChild.nodeValue;
	var length = candidate.length;

	var weblinks_list = '<ol>';

	iconf = Math.floor( iconf );
	if ( iconf >= 2 && iconf <= 5 ) {
		zoom = iconf + weblinks_zoom_accuracy_tokyo_univ;
	} else {
		zoom = weblinks_zoom_geocode_default;
	}
	zoom = weblinks_maxZoom( zoom );

	for(var i = 0; i< length; i++) {

/* location */
		place = candidate[i];
		addr = place.getElementsByTagName("address")[0].firstChild.nodeValue;
		lat  = place.getElementsByTagName('latitude')[0].firstChild.nodeValue;
		lng  = place.getElementsByTagName('longitude')[0].firstChild.nodeValue;

/* add marker */
		weblinks_addMarker( i, lat, lng, zoom, addr );

		weblinks_setBounds( i, lat, lng, zoom );
		weblinks_list += weblinks_getSearchList( i, lat, lng, zoom, addr );
	}

	weblinks_setCenterBounds( length );
	weblinks_list += '</ol>';
	document.getElementById("weblinks_list").innerHTML = weblinks_list;
}

/* japanese inverse geocoder */
function weblinks_inverse_nishioka( lat, lon )
{
	var url = weblinks_url + '/gm_jp_invgeo.php?lon=' + lon + '&lat=' + lat;

	GDownloadUrl( url , function( data , responseCode ) {
		if( weblinks_DEBUG_inverse_nishioka ) {
			alert( data );
		}
		if( responseCode == 200 ) {
			var xml = GXml.parse( data );

/* fixed javascript errors with IE6 by souhalt */
			if ( xml.documentElement != null ) {
				weblinks_inverse_nishiokaResponse( xml );
			}

		}
	});
}

function weblinks_inverse_nishiokaResponse( xml )
{
	weblinks_address_jp = null;
	weblinks_pref_jp    = null;
	weblinks_city_jp    = null;
	weblinks_town_jp    = null;
	weblinks_number_jp  = null;

	var error = null;
	var addr  = null;

	if ( xml.documentElement.getElementsByTagName("address")[0] != null) {
		weblinks_address_jp = xml.documentElement.getElementsByTagName("address")[0].firstChild.nodeValue;
	}
	if ( xml.documentElement.getElementsByTagName("pref")[0] != null) {
		weblinks_pref_jp = xml.documentElement.getElementsByTagName("pref")[0].firstChild.nodeValue;
	}
	if ( xml.documentElement.getElementsByTagName("city")[0] != null) {
		weblinks_city_jp = xml.documentElement.getElementsByTagName("city")[0].firstChild.nodeValue;
	}
	if ( xml.documentElement.getElementsByTagName("town")[0] != null) {
		weblinks_town_jp = xml.documentElement.getElementsByTagName("town")[0].firstChild.nodeValue;;
	}
	if ( xml.documentElement.getElementsByTagName("number")[0] != null) {
		weblinks_number_jp = xml.documentElement.getElementsByTagName("number")[0].firstChild.nodeValue;
	}
	if ( xml.documentElement.getElementsByTagName("Message")[0] != null) {
		error = xml.documentElement.getElementsByTagName("Message")[0].firstChild.nodeValue;
	}

	if ( weblinks_address_jp != null ) {
		addr = weblinks_address_jp;
	} else if ( error != null ) { 
		addr = error;
	} else {
		addr = "unknown";
	}
	document.getElementById("weblinks_current_address").innerHTML = addr;
}

