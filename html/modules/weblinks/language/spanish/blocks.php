<?php
//=========================================================
// Módulo WebLinks
// Traducido por Kirby y Dynamic Noiser
// Octubre 2007
//=========================================================

// --- define language begin ---
if( !defined('WEBLINKS_LANG_BL_LOADED') ) 
{

define('WEBLINKS_LANG_BL_LOADED', 1);
// top.html
define("_MB_WEBLINKS_DISP","Mostrar");
define("_MB_WEBLINKS_LINKS","Enlaces");
define("_MB_WEBLINKS_CHARS","Longitud del título");
define("_MB_WEBLINKS_LENGTH"," Caracteres");
define("_MB_WEBLINKS_NEWDAYS","Días de nuevo Enlace");
define("_MB_WEBLINKS_DAYS"," Días");
define("_MB_WEBLINKS_POPULAR","Visitas para ser popular");
define("_MB_WEBLINKS_HITS"," Visitas");
define("_MB_WEBLINKS_PIXEL"," Pixel");
define("_MB_WEBLINKS_RATING","Calificación");
define("_MB_WEBLINKS_VOTES","Votos");
define("_MB_WEBLINKS_COMMENTS","Comentarios");

// catlist.html
define('_MB_WEBLINKS_TOTAL_LINKS',"Total");
define("_MB_WEBLINKS_IMAGE_MODE","Selecciona imagen de categoría");
define("_MB_WEBLINKS_IMAGE_MODE_0","NONE");
define("_MB_WEBLINKS_IMAGE_MODE_1","folder.gif");
define("_MB_WEBLINKS_IMAGE_MODE_2","Elige imagen");
define('_MB_WEBLINKS_MAX_WIDTH',"Ancho máximo de imagen");
define('_MB_WEBLINKS_WIDTH_DEFAULT',"Ancho de imagen por defecto");
define("_MB_WEBLINKS_DISPSUB","Máximo número de subcategorías");

// atom feed
define("_MB_WEBLINKS_NUM_FEED","Número de semillas");
define("_MB_WEBLINKS_NUM_TITLE","Longitud del título");
define("_MB_WEBLINKS_NUM_SUMMARY","Longitud del sumario");
define("_MB_WEBLINKS_NUM_CONTENT","Número de semillas que pueden mostrar contenido");
define("_MB_WEBLINKS_LINK_ID","ID de Enlace");
define("_MB_WEBLINKS_NO_LINK_ID","Olvidaste introducir el ID del Enlace");
define("_MB_WEBLINKS_NO_ATOMFEED","No hay semilla que corresponda");
define("_MB_WEBLINKS_MORE","Más detalles");

// 2006-11-03
// random block
define('_MB_WEBLINKS_MAX_DESC','Máxima logitud de la descripción');
define('_MB_WEBLINKS_SHOW_DATE', 'Mostrar fecha');
define('_MB_WEBLINKS_MODE_URL','Mostrar estilo de la dirección web');
define('_MB_WEBLINKS_MODE_URL_SINGLE','singlelink.php');
define('_MB_WEBLINKS_MODE_URL_VISIT','visit.php');
define('_MB_WEBLINKS_MODE_URL_DIRECT','Mostrar página web directamente');
define('_MB_WEBLINKS_URL_EMPTY','Sin página web');
define('_MB_WEBLINKS_URL_EMPTY_INCLUDE','Incluir sin página web');
define('_MB_WEBLINKS_URL_EMPTY_EXCLUDE','Excluir sin página web');
define('_MB_WEBLINKS_CATEGORY','Categoría');
define('_MB_WEBLINKS_WITH_SUBCAT','Con subcategorías');
define('_MB_WEBLINKS_MODE','Modo');
define('_MB_WEBLINKS_RECOMMEND','Enlace recomendado');
define('_MB_WEBLINKS_MUTUAL','Enlace asociado');
define('_MB_WEBLINKS_RANDOM','Selección de Enlace aleatoria');
define('_MB_WEBLINKS_ORDER','Ordenado');
define('_MB_WEBLINKS_ORDER_DESC','Válido cuando "Selección de Enlace aleatoria" es NO');
define('_MB_WEBLINKS_TIME_UPDATE','Actualizado');
define('_MB_WEBLINKS_TIME_CREATE','Creado');
define('_MB_WEBLINKS_TITLE','Título');
define('_MB_WEBLINKS_ASC', 'Ascendente');
define('_MB_WEBLINKS_DESC','Descendente');

// === 2007-03-25 ===
// google map
define('_MB_WEBLINKS_GM_MODE','Modo del mapa de Google');
define('_MB_WEBLINKS_GM_MODE_DSC','0:No mostrado, 1:Por defecto, 2:Siguiente valor');
define('_MB_WEBLINKS_GM_LATITUDE','Latitud');
define('_MB_WEBLINKS_GM_LONGITUDE','Longitud');
define('_MB_WEBLINKS_GM_ZOOM','Zoom');
define('_MB_WEBLINKS_GM_HEIGHT','Altura del tamaño del mapa');
define('_MB_WEBLINKS_GM_TIMEOUT','Tiempo de retraso para obtener imagen');
define('_MB_WEBLINKS_GM_TIMEOUT_DSC','msec  -1:window.onload');

// 2007-04-08
define('_MB_WEBLINKS_PHOTOS', 'Número de fotos');

// === 2007-08-01 ===
define('_MB_WEBLINKS_CAT_TITLE_LENGTH','Longitud del título de categoría');
define('_MB_WEBLINKS_GM_DESC_LENGTH','Longitud del contenido en marcador de mapa');
define('_MB_WEBLINKS_GM_WORDWRAP','Longitud de wordwrap en marcador de mapa');

}
// --- define language end ---

?>