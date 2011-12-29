<?php
// $Id: blocks.php,v 1.1 2011/12/29 14:32:41 ohwada Exp $

// 2007-09-24 Luigi Trovato - Italian translation

// 2007-08-01 K.OHWADA
// _MB_WEBLINKS_CAT_TITLE_LENGTH

// 2007-04-08
// _MB_WEBLINKS_PHOTOS

// 2007-03-25 K.OHWADA
// google map

// 2006-11-03 hiro
// random block

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// language for Blocks
//=========================================================

// --- define language begin ---
if( !defined('WEBLINKS_LANG_BL_LOADED') ) 
{

define('WEBLINKS_LANG_BL_LOADED', 1);
// top.html
define("_MB_WEBLINKS_DISP","Visualizza");
define("_MB_WEBLINKS_LINKS","Links");
define("_MB_WEBLINKS_CHARS","Lunghezza del titolo");
define("_MB_WEBLINKS_LENGTH"," Caratteri");
define("_MB_WEBLINKS_NEWDAYS","Giorni di link nuovo");
define("_MB_WEBLINKS_DAYS"," Giorni");
define("_MB_WEBLINKS_POPULAR","Hits di link popolare");
define("_MB_WEBLINKS_HITS"," Hits");
define("_MB_WEBLINKS_PIXEL"," Pixel");
define("_MB_WEBLINKS_RATING","Punteggio");
define("_MB_WEBLINKS_VOTES","Voti");
define("_MB_WEBLINKS_COMMENTS","Commenti");

// catlist.html
define('_MB_WEBLINKS_TOTAL_LINKS',"Totale");
define("_MB_WEBLINKS_IMAGE_MODE","Scegli immagine categoria");
define("_MB_WEBLINKS_IMAGE_MODE_0","NESSUNA");
define("_MB_WEBLINKS_IMAGE_MODE_1","folder.gif");
define("_MB_WEBLINKS_IMAGE_MODE_2","Immagine da Settaggi");
define('_MB_WEBLINKS_MAX_WIDTH',"Max larghezza immagine");
define('_MB_WEBLINKS_WIDTH_DEFAULT',"Larghezza immagine default");
define("_MB_WEBLINKS_DISPSUB","Num. Max di sottocategorie");

// atom feed
define("_MB_WEBLINKS_NUM_FEED","Numero di feeds");
define("_MB_WEBLINKS_NUM_TITLE","Lunghezza del titolo");
define("_MB_WEBLINKS_NUM_SUMMARY","Lunghezza del sommario");
define("_MB_WEBLINKS_NUM_CONTENT","Num. di feed con contenuto visualizzato");
define("_MB_WEBLINKS_LINK_ID","Link ID");
define("_MB_WEBLINKS_NO_LINK_ID","Hai dimenticato di inserire il link ID");
define("_MB_WEBLINKS_NO_ATOMFEED","Non ci sono feed corrispondenti");
define("_MB_WEBLINKS_MORE","Maggiori dettagli");

// 2006-11-03
// random block
define('_MB_WEBLINKS_MAX_DESC','Lunghezza max descrizione');
define('_MB_WEBLINKS_SHOW_DATE', 'Mostro data');
define('_MB_WEBLINKS_MODE_URL','Mostro stile URL');
define('_MB_WEBLINKS_MODE_URL_SINGLE','singlelink.php');
define('_MB_WEBLINKS_MODE_URL_VISIT','visit.php');
define('_MB_WEBLINKS_MODE_URL_DIRECT','Mostro URL direttamente');
define('_MB_WEBLINKS_URL_EMPTY','URL vuoto');
define('_MB_WEBLINKS_URL_EMPTY_INCLUDE','Includi URL vuoti');
define('_MB_WEBLINKS_URL_EMPTY_EXCLUDE','Escludi URL vuoti');
define('_MB_WEBLINKS_CATEGORY','Categoria');
define('_MB_WEBLINKS_WITH_SUBCAT','Con sotto categorie');
define('_MB_WEBLINKS_MODE','Modo Link');
define('_MB_WEBLINKS_RECOMMEND','Sito raccomandato');
define('_MB_WEBLINKS_MUTUAL','Sito reciproco');
define('_MB_WEBLINKS_RANDOM','Ordine casuale');
define('_MB_WEBLINKS_ORDER','Ordine');
define('_MB_WEBLINKS_ORDER_DESC','Valido se "Ordine casuale" è NO');
define('_MB_WEBLINKS_TIME_UPDATE','Ora aggiornamento');
define('_MB_WEBLINKS_TIME_CREATE','Ora creazione');
define('_MB_WEBLINKS_TITLE','Titolo');
define('_MB_WEBLINKS_ASC', 'Ascend.');
define('_MB_WEBLINKS_DESC','Discend.');

// === 2007-03-25 ===
// google map
define('_MB_WEBLINKS_GM_MODE','Modo GoogleMap');
define('_MB_WEBLINKS_GM_MODE_DSC','0:Non mostrare, 1:Default, 2:Valore seguente');
define('_MB_WEBLINKS_GM_LATITUDE','Latitudine');
define('_MB_WEBLINKS_GM_LONGITUDE','Longitudine');
define('_MB_WEBLINKS_GM_ZOOM','Zoom');
define('_MB_WEBLINKS_GM_HEIGHT','Dim. altezza Mappa');
define('_MB_WEBLINKS_GM_TIMEOUT','Tempo Delay nel disegno');
define('_MB_WEBLINKS_GM_TIMEOUT_DSC','msec  -1:window.onload');

// 2007-04-08
define('_MB_WEBLINKS_PHOTOS', 'Numbero di Foto');

// === 2007-08-01 ===
define('_MB_WEBLINKS_CAT_TITLE_LENGTH','Lunghezza del Titolo Categoria');
define('_MB_WEBLINKS_GM_DESC_LENGTH','Lunghezza del Contenuto nel marker mappa');
define('_MB_WEBLINKS_GM_WORDWRAP','Lunghezza a capo nel marker mappa');

}
// --- define language end ---

?>
