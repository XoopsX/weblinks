<?php
// $Id: blocks.php,v 1.1 2012/04/09 10:20:06 ohwada Exp $

// 2008-02-17 K.OHWADA
// _MB_WEBLINKS_GM_CONTROL

// 2007-10-10 K.OHWADA
// _MB_WEBLINKS_GM_MARKER_WIDTH

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
// _LANGCODE: ru
// _CHARSET : cp1251
// Translator: Houston (Contour Design Studio http://www.cdesign.ru/)

// --- define language begin ---
if( !defined('WEBLINKS_LANG_BL_LOADED') ) 
{

define('WEBLINKS_LANG_BL_LOADED', 1);
// top.html
define("_MB_WEBLINKS_DISP","Показывать");
define("_MB_WEBLINKS_LINKS","Ссылок");
define("_MB_WEBLINKS_CHARS","Длина заголовка");
define("_MB_WEBLINKS_LENGTH"," Символов");
define("_MB_WEBLINKS_NEWDAYS","Дней новой ссылки");
define("_MB_WEBLINKS_DAYS"," Дней");
define("_MB_WEBLINKS_POPULAR","Посещений популярной ссылки");
define("_MB_WEBLINKS_HITS"," Посещений");
define("_MB_WEBLINKS_PIXEL"," Пикселей");
define("_MB_WEBLINKS_RATING","Оценка");
define("_MB_WEBLINKS_VOTES","Голосов");
define("_MB_WEBLINKS_COMMENTS","Комментариев");

// catlist.html
define('_MB_WEBLINKS_TOTAL_LINKS',"Всего");
define("_MB_WEBLINKS_IMAGE_MODE","Выберите изображение категории");
define("_MB_WEBLINKS_IMAGE_MODE_0","NONE");
define("_MB_WEBLINKS_IMAGE_MODE_1","folder.gif");
define("_MB_WEBLINKS_IMAGE_MODE_2","Настройка изображения");
define('_MB_WEBLINKS_MAX_WIDTH',"Максимальная ширина изображения");
define('_MB_WEBLINKS_WIDTH_DEFAULT',"Ширина изображения по умолчанию");
define("_MB_WEBLINKS_DISPSUB","Максимальное число подкатегорий");

// atom feed
define("_MB_WEBLINKS_NUM_FEED","Количество каналов");
define("_MB_WEBLINKS_NUM_TITLE","Длина заголовка");
define("_MB_WEBLINKS_NUM_SUMMARY","Длина краткого содержания");
define("_MB_WEBLINKS_NUM_CONTENT","Количество каналов, которые показывают содержание");
define("_MB_WEBLINKS_LINK_ID","ID ссылки");
define("_MB_WEBLINKS_NO_LINK_ID","Вы забыли ввести ID ссылки");
define("_MB_WEBLINKS_NO_ATOMFEED","Нет соответствующего канала");
define("_MB_WEBLINKS_MORE","Подробнее");

// 2006-11-03
// random block
define('_MB_WEBLINKS_MAX_DESC','Максимальная длина описания');
define('_MB_WEBLINKS_SHOW_DATE', 'Показывать дату');
define('_MB_WEBLINKS_MODE_URL','Стиль показа адреса');
define('_MB_WEBLINKS_MODE_URL_SINGLE','singlelink.php');
define('_MB_WEBLINKS_MODE_URL_VISIT','visit.php');
define('_MB_WEBLINKS_MODE_URL_DIRECT','Показывать прямой адрес');
define('_MB_WEBLINKS_URL_EMPTY','Пустой адрес');
define('_MB_WEBLINKS_URL_EMPTY_INCLUDE','Включать пустой адрес');
define('_MB_WEBLINKS_URL_EMPTY_EXCLUDE','Исключать пустой адрес');
define('_MB_WEBLINKS_CATEGORY','Категория');
define('_MB_WEBLINKS_WITH_SUBCAT','С подкатегориями');
define('_MB_WEBLINKS_MODE','Режим ссылки');
define('_MB_WEBLINKS_RECOMMEND','Рекомендованный сайт');
define('_MB_WEBLINKS_MUTUAL','Лучший сайт');
define('_MB_WEBLINKS_RANDOM','Случайная сортировка');
define('_MB_WEBLINKS_ORDER','Порядок');
define('_MB_WEBLINKS_ORDER_DESC','Действительно, когда "Случайная сортировка" Нет');
define('_MB_WEBLINKS_TIME_UPDATE','Время обновления');
define('_MB_WEBLINKS_TIME_CREATE','Время создания');
define('_MB_WEBLINKS_TITLE','Заголовок');
define('_MB_WEBLINKS_ASC', 'Возрастание');
define('_MB_WEBLINKS_DESC','Убывание');

// === 2007-03-25 ===
// google map
define('_MB_WEBLINKS_GM_MODE','Режим карты Google');
define('_MB_WEBLINKS_GM_MODE_DSC','0:Не показывать, 1:По умолчанию, 2:Следующие значения');
define('_MB_WEBLINKS_GM_LATITUDE','Широта');
define('_MB_WEBLINKS_GM_LONGITUDE','Долгота');
define('_MB_WEBLINKS_GM_ZOOM','Увеличение');
define('_MB_WEBLINKS_GM_HEIGHT','Высота размера карты');
define('_MB_WEBLINKS_GM_TIMEOUT','Время задержки для рисования');
define('_MB_WEBLINKS_GM_TIMEOUT_DSC','мс  -1:window.onload');

// 2007-04-08
define('_MB_WEBLINKS_PHOTOS', 'Количество фотографий');

// === 2007-08-01 ===
define('_MB_WEBLINKS_CAT_TITLE_LENGTH','Длина заголовка категории');
define('_MB_WEBLINKS_GM_DESC_LENGTH','Длина наполнения в указателе карты');
define('_MB_WEBLINKS_GM_WORDWRAP','Длина переноса строк в указателе карты');

// === 2007-10-10 ===
define('_MB_WEBLINKS_GM_MARKER_WIDTH','Ширина указателя карты');

// === 2008-02-17 ===
define('_MB_WEBLINKS_GM_CONTROL','Управление карты');
define('_MB_WEBLINKS_GM_CONTROL_DSC','0:Не показывать, 1:Показывать');
define('_MB_WEBLINKS_GM_TYPE_CONTROL','Тип управления карты');

}
// --- define language end ---

?>