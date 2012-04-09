<?php
// $Id: compatible.php,v 1.1 2012/04/09 10:20:05 ohwada Exp $

// 2008-02-17 K.OHWADA
// pagerank, pagerank_update

// 2007-11-01 K.OHWADA
// _AM_WEBLINKS_GM_MARKER_WIDTH

// 2007-09-01 K.OHWADA
// waiting list

// 2007-08-01 K.OHWADA
// config 0

// 2007-07-14 K.OHWADA
// highlight

// 2007-06-10 K.OHWADA
// d3forum

// 2007-04-08 K.OHWADA
// _WEBLINKS_GM_TYPE

// 2007-03-25 K.OHWADA
// _WEBLINKS_ALBUM_ID

// 2007-02-20 K.OHWADA
// forum, performance

// 2006-12-11 K.OHWADA
// google map: googleGeocode
// _WEBLINKS_TIME_PUBLISH

// 2006-11-26 K.OHWADA
// google map: JP Geocode

// 2006-11-04 K.OHWADA
// google map: JP inverse Geocoder
// google map: inline mode

// 2006-10-05 K.OHWADA
// add _WEBLINKS_RSSC_LID
// google map

// 2006-05-15 K.OHWADA
// this is new file

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================
// _LANGCODE: ru
// _CHARSET : cp1251
// Translator: Houston (Contour Design Studio http://www.cdesign.ru/)

//---------------------------------------------------------
// compatible for v1.90
//---------------------------------------------------------
if( !defined('_WEBLINKS_PAGERANK') ) 
{
// linkitem
	define('_WEBLINKS_PAGERANK', 'Важность страницы');
	define('_WEBLINKS_PAGERANK_UPDATE', 'Время обновления важности страницы');
	define('_WEBLINKS_GM_KML_DEBUG', 'Просмотр отладки KML');

// gmap
	define('_WEBLINKS_SITE_GMAP', 'Сайт карт Google');
	define('_WEBLINKS_KML_LIST',  'Список KML');
	define('_WEBLINKS_KML_LIST_DESC', 'Скачать KML и показать в Земле Google');
	define('_WEBLINKS_KML_PERPAGE', 'Число разделителя');

// pagerank
	define('_WEBLINKS_SITE_PAGERANK', 'Сайт с высокой важностью страницы');
}

if( !defined('_AM_WEBLINKS_CONF_MENU') ) 
{
// config
	define('_AM_WEBLINKS_MODULE_CONFIG_7','Конфигурация модуля 7');
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_7','Меню');
	define('_AM_WEBLINKS_CONF_MENU', 'Вид меню');
	define('_AM_WEBLINKS_CONF_MENU_DESC', 'Настройка, которая относится к виду меню');
	define('_AM_WEBLINKS_CONF_TITLE','Заголовок меню');

// htmlout
	define('_AM_WEBLINKS_OUTPUT_PLUGIN_MANAGE', 'Управление плагином вывода HTML');
	define('_AM_WEBLINKS_HTMLOUT', 'Плагин HTML вывода');
	define('_AM_WEBLINKS_RSSOUT',  'Плагин RSS вывода');
	define('_AM_WEBLINKS_KMLOUT',  'Плагин KML вывода');

// pagerank
	define('_AM_WEBLINKS_LINK_CHECK_MANAGE', 'Управление проверкой ссылок');
	define('_AM_WEBLINKS_USE_PAGERANK', 'Показать важность страницы');
	define('_AM_WEBLINKS_USE_PAGERANK_DESC', '"Показать" : показать важность страницы в меню, списке ссылок, одиночной ссылке');
	define('_AM_WEBLINKS_USE_PAGERANK_NON',   'Не показывать');
	define('_AM_WEBLINKS_USE_PAGERANK_SHOW',  'Показывать');
	define('_AM_WEBLINKS_USE_PAGERANK_CACHE', 'Показывать, используя кэш колученной важности страницы');

// kml
	define('_AM_WEBLINKS_KML_USE', 'Показать KML');
}

//---------------------------------------------------------
// compatible for v1.80
//---------------------------------------------------------
if( !defined('_WEBLINKS_ERROR_LENGTH') ) 
{
	define('_WEBLINKS_ERROR_LENGTH', "Ошибка: %s должно быть меньше, чем %s символов");
}

if( !defined('_AM_WEBLINKS_GM_MARKER_WIDTH') ) 
{
// google map
	define('_AM_WEBLINKS_GM_MARKER_WIDTH',  '[Указатель] Ширина (пиксели)');
	define('_AM_WEBLINKS_GM_MARKER_WIDTH_DESC',  'Ширина информационного указателя карты<br /><b>-1</b> не указан');
	define('_AM_WEBLINKS_LINK_IMG_USE', 'Использовать %s');

	define('_AM_WEBLINKS_RSS_SITE', 'Этот сайт');
	define('_AM_WEBLINKS_RSS_FEED', 'RSS канал');

// nameflag mainflag
	define('_AM_WEBLINKS_CONF_LINK_USER','Конфигурация регистрации ссылки пользователя');
	define('_AM_WEBLINKS_USER_NAMEFLAG','Выберите показ имени');
	define('_AM_WEBLINKS_USER_MAILFLAG','Выберите показ электронной почты');
	define('_AM_WEBLINKS_USER_NAME_MAIL_FLAG_DESC','Значение по умолчанию, когда пользователь регистрируется<br />Администратор может изменить значение');
	define('_AM_WEBLINKS_USER_NAME_MAIL_FLAG_SEL','Выбор пользователя');

// description length
	define('_AM_WEBLINKS_DESC_LENGTH', 'Максимальная длина символов');
	define('_AM_WEBLINKS_DESC_LENGTH_DSC', '<b>-1</b> или административная настройка : лимит 64KB<br />');
}

//---------------------------------------------------------
// compatible for v1.70
//---------------------------------------------------------
if( !defined('_WEBLINKS_ADMIN_WAITING_LIST') ) 
{
// waiting list
	define('_WEBLINKS_ADMIN_WAITING_LIST', "Список ожидания администратора");
	define('_WEBLINKS_USER_WAITING_LIST',  'Ваш список ожидания');
	define('_WEBLINKS_USER_OWNER_LIST',    'Ваш список отправленных');

// submit form
	define('_WEBLINKS_TIME_PUBLISH_SET', 'Установите дату публикации');
	define('_WEBLINKS_TIME_PUBLISH_DESC','Если Вы не установите это, дата публикации станет бессрочной');
	define('_WEBLINKS_TIME_EXPIRE_SET',  'Установите дату истечения');
	define('_WEBLINKS_TIME_EXPIRE_DESC', 'Если Вы не установите это, дата истечения станет бессрочной');
	define('_WEBLINKS_DEL_LINK_CONFIRM','Подтвердите удаление');
	define('_WEBLINKS_DEL_LINK_REASON', 'Причина удаления');
}

if( !defined('_AM_WEBLINKS_AUTH_DELETE') ) 
{
// auth
	define('_AM_WEBLINKS_AUTH_DELETE','Могут удалять');
	define('_AM_WEBLINKS_AUTH_DELETE_DSC','Укажите группы, которым разрешено отправлять запросы на удаление ссылки');
	define('_AM_WEBLINKS_AUTH_DELETE_AUTO','Могут утверждать удаление ссылки');
	define('_AM_WEBLINKS_AUTH_DELETE_AUTO_DSC','Укажите группы, которым разрешено утверждать запросы на удаление ссылки');

// nofitication
	define('_AM_WEBLINKS_NOTIFICATION_MANAGE', 'Управление оповещениями');
	define('_AM_WEBLINKS_NOTIFICATION_MANAGE_DESC', 'Настройка для каждого администратора модуля<br />Это тоже самое, что и главная страница модуля');
	define('_AM_WEBLINKS_NOTIFICATION_MANAGE_NOT_USE', "Вы не можете использовать в некоторых версиях XOOPS");
	define('_AM_WEBLINKS_NOTIFICATION_MANAGE_PLEASE', 'В данном случае, пожалуйста, используйте главную страницу этого модуля');
	define('_AM_WEBLINKS_SUBJ_LINK_MOD_APPROVED', '[{X_SITENAME}] {X_MODULE}: Ваш запрос изменения ссылки утвержден');
	define('_AM_WEBLINKS_SUBJ_LINK_MOD_REFUSED',  '[{X_SITENAME}] {X_MODULE}: Ваш запрос изменения ссылки отклонен');
	define('_AM_WEBLINKS_SUBJ_LINK_DEL_APPROVED', '[{X_SITENAME}] {X_MODULE}: Ваш запрос на удаление ссылки утвержден');
	define('_AM_WEBLINKS_SUBJ_LINK_DEL_REFUSED',  '[{X_SITENAME}] {X_MODULE}: Ваш запрос на удаление ссылки отклонен');

// config
	define('_AM_WEBLINKS_ADMIN_WAITING_SHOW', 'Показать список ожидания администратора');
	define('_AM_WEBLINKS_USER_WAITING_NUM',   'Количество ссылок списка ожидания пользователя');
	define('_AM_WEBLINKS_USER_OWNER_NUM',     'Количество списка пользователей отправленного списка');
	define('_AM_WEBLINKS_USE_HITS_SINGLELINK','Увеличивать счетчик, когда показывается одиночная ссылка');
	define('_AM_WEBLINKS_USE_HITS_SINGLELINK_DSC','ДА позволяет увеличивать счетчик посещений, когда показывается одиночная ссылка');
	define('_AM_WEBLINKS_MODE_RANDOM', 'Переадресация со случайным переходом');
	define('_AM_WEBLINKS_MODE_RANDOM_URL', 'зарегистрированный адрес сайта');
	define('_AM_WEBLINKS_MODE_RANDOM_SINGLE', 'одиночная ссылка в этом модуле');

// request list
	define('_AM_WEBLINKS_DEL_REQS', 'Удаляющиеся ссылки ожидающие проверки');
	define('_AM_WEBLINKS_NO_DEL_REQ','Нет запроса удаляющейся ссылки');
	define('_AM_WEBLINKS_DEL_REQ_DELETED','Удаляющийся запрос удален');

// link list
	define('_AM_WEBLINKS_LINK_USERCOMMENT_DESC','Список ссылок с комментариями для администратора (список по новым ID)');

// clone
	define('_AM_WEBLINKS_CLONE_LINK', 'Клонировать');
	define('_AM_WEBLINKS_CLONE_MODULE', 'Клонировать в другой модуль');
	define('_AM_WEBLINKS_CLONE_CONFIRM', 'Подтвердить клонирование');
	define('_AM_WEBLINKS_NO_MODULE', 'Нет соответствующего модуля');

// link form
	define('_AM_WEBLINKS_MODIFIED', 'Изменено');
	define('_AM_WEBLINKS_CHECK_CONFIRM', 'Подтверждено');
	define('_AM_WEBLINKS_WARN_CONFIRM', 'Предупреждение: Проверить "Подтверждено" из %s');
	define('_AM_WEBLINKS_RSSC_LID_EXIST_MORE', 'Есть две или более ссылок, у которых такой же "RSSC ID"');

// web shot
	define('_AM_WEBLINKS_LINK_IMG_THUMB', 'Замена изображения ссылки');
	define('_AM_WEBLINKS_LINK_IMG_THUMB_DSC', 'Заменить изображение, когда не установлено изображение ссылки');
	define('_AM_WEBLINKS_LINK_IMG_NON', 'нет');
	define('_AM_WEBLINKS_LINK_IMG_MOZSHOT', 'Использовать <a href="http://mozshot.nemui.org/" target="_blank">MozShot</a>');
	define('_AM_WEBLINKS_LINK_IMG_SIMPLEAPI', 'Использовать <a href="http://img.simpleapi.net/" target="_blank">SimpleAPI</a>');

}

//---------------------------------------------------------
// compatible for v1.60
//---------------------------------------------------------
if( !defined('_WEBLINKS_GM_CURRENT_ADDRESS') ) 
{
	define('_WEBLINKS_GM_CURRENT_ADDRESS', 'Текущий адрес');
	define('_WEBLINKS_GM_SEARCH_LIST', 'Список результатов поиска');
}

if( !defined('_AM_WEBLINKS_MODULE_CONFIG_0') ) 
{
// config
	define('_AM_WEBLINKS_MODULE_CONFIG_0','Конфигурация модуля');
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_0','Главная');
	define('_AM_WEBLINKS_MODULE_CONFIG_5','Конфигурация модуля 5');
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_5','Регистрация ссылки');
	define('_AM_WEBLINKS_MODULE_CONFIG_6','Конфигурация модуля 6');
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_6','Карта Google');

// google map
	define('_AM_WEBLINKS_GM_MAP_CONT',  'Управление карты');
	define('_AM_WEBLINKS_GM_MAP_CONT_DESC',  'GLargeMapControl, GSmallMapControl, GSmallZoomControl');
	define('_AM_WEBLINKS_GM_MAP_CONT_NON',   'Не показывать');
	define('_AM_WEBLINKS_GM_MAP_CONT_LARGE', 'Большое управление');
	define('_AM_WEBLINKS_GM_MAP_CONT_SMALL', 'Маленькое управление');
	define('_AM_WEBLINKS_GM_MAP_CONT_ZOOM',  'Управление увеличением');
	define('_AM_WEBLINKS_GM_USE_TYPE_CONT',  'Использовать тип управления карты');
	define('_AM_WEBLINKS_GM_USE_TYPE_CONT_DESC',  'GMapTypeControl');
	define('_AM_WEBLINKS_GM_USE_SCALE_CONT',  'Использовать управление шкалой');
	define('_AM_WEBLINKS_GM_USE_SCALE_CONT_DESC',  'GScaleControl');
	define('_AM_WEBLINKS_GM_USE_OVERVIEW_CONT',  'Использовать управление обзором карты');
	define('_AM_WEBLINKS_GM_USE_OVERVIEW_CONT_DESC',  'GOverviewMapControl');
	define('_AM_WEBLINKS_GM_MAP_TYPE', '[Поиск] Тип карты');
	define('_AM_WEBLINKS_GM_MAP_TYPE_DESC', 'GMapType');
	define('_AM_WEBLINKS_GM_GEOCODE_KIND',  '[Поиск] Вид геокода');
	define('_AM_WEBLINKS_GM_GEOCODE_KIND_DESC',  'Поиск широты и долготы из адреса<br /><b>Единственный результат</b><br />GClientGeocoder - getLatLng<br /><b>Множественный результат</b><br />GClientGeocoder - getLocations');
	define('_AM_WEBLINKS_GM_GEOCODE_KIND_LATLNG', 'Единственный результат: getLatLng');
	define('_AM_WEBLINKS_GM_GEOCODE_KIND_LOCATIONS',   'Множественный результат: getLocations');
	define('_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO',  '[Поиск][Япония] Использовать CSIS');
	define('_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO_DESC',  'Действительно в Японии<br />Поиск широты и долготы из адреса');
	define('_AM_WEBLINKS_GM_USE_NISHIOKA',  '[Поиск][Япония] Использование обратного геокода');
	define('_AM_WEBLINKS_GM_USE_NISHIOKA_DESC',  'Действительно в Японии<br />Поиск адреса из широты и долготы<br /><a href="http://nishioka.sakura.ne.jp/google/" target="_blank">http://nishioka.sakura.ne.jp/google/</a>');
	define('_AM_WEBLINKS_GM_TITLE_LENGTH',  '[Указатель] Максимум символов для заголовка');
	define('_AM_WEBLINKS_GM_TITLE_LENGTH_DESC',  'Максимальноу число символов используемых для заголовка в указателе<br /><b>-1</b> не ограничено');
	define('_AM_WEBLINKS_GM_DESC_LENGTH',  '[Указатель] Максимум символов для наполнения');
	define('_AM_WEBLINKS_GM_DESC_LENGTH_DESC',  'Максимальноу число символов используемых для наполнения в указателе<br /><b>-1</b> не ограничено');
	define('_AM_WEBLINKS_GM_WORDWRAP',  '[Указатель] Максимум символов для переноса строк');
	define('_AM_WEBLINKS_GM_WORDWRAP_DESC',  'Максимальноу число символов используемых для каждой строки (перенос трок) в указателе<br /><b>-1</b> не ограничено');
	define('_AM_WEBLINKS_GM_USE_CENTER_MARKER',  '[Указатель] Показывать центральный указатель');
	define('_AM_WEBLINKS_GM_USE_CENTER_MARKER_DESC',  'На главной странице и странице категории, показывать центральный указатель');

// map jp
	define('_AM_WEBLINKS_MAP_JP_MANAGE', 'Конфигурация карты Японии');

// column
	define('_AM_WEBLINKS_COLUMN_MANAGE', 'Управление колонками');
	define('_AM_WEBLINKS_COLUMN_MANAGE_DESC', 'Добавьте колонки etc в таблицу link и измените таблицу');
	define('_AM_WEBLINKS_COLUMN_MANAGE_NOT_USE', 'Не используется');
	define('_AM_WEBLINKS_THERE_ARE_COLUMN', 'Всего <b>%s</b> etc колонок в таблице link');
	define('_AM_WEBLINKS_COLUMN_NUM', 'Количество добавленных etc колонок');
	define('_AM_WEBLINKS_COLUMN_BIGGER_USE', 'Количество etc колонок больше, чем число в таблице link');
	define('_AM_WEBLINKS_COLUMN_UNMATCH',  'Колонки несовпадают в таблице link, измените таблицу');
	define('_AM_WEBLINKS_PHPMYADMIN',  'Исправте в инструменте управления, таком как phpMyAdmin');
	define('_AM_WEBLINKS_LINK_NUM_ETC', 'Количество etc колонок');

// latest
	define('_AM_WEBLINKS_INDEX_MODE_LATEST', 'Порядок последних ссылок');
	define('_AM_WEBLINKS_INDEX_MODE_LATEST_UPDATE', 'Дата обновления');
	define('_AM_WEBLINKS_INDEX_MODE_LATEST_CREATE', 'Дата создания');

// header
	define('_AM_WEBLINKS_CONF_HTML_STYLE', 'Конфигурация HTML стиля');
	define('_AM_WEBLINKS_HEADER_MODE', 'Использовать заголовок модуля XOOPS');
	define('_AM_WEBLINKS_HEADER_MODE_DESC', 'Когда "Нет", показывать таблицу стилей и Javascript в теге body<br />Когда "Да", показывать это в теге header, используя заголовок модуля XOOPS. Однако, есть некоторые темы, которые не могут быть использованы');

// bulk
	define('_AM_WEBLINKS_BULK_SAMPLE','Вы можете посмотреть пример, нажав кнопку пример');
	define('_AM_WEBLINKS_BULK_LINK_DSC10','Регистрация пунктов фиксирована');
	define('_AM_WEBLINKS_BULK_LINK_DSC20','Администратор определяет регистрацию пунктов');
	define('_AM_WEBLINKS_BULK_LINK_DSC21','Первый параграф');
	define('_AM_WEBLINKS_BULK_LINK_DSC22','Второй параграф и следующие');
	define('_AM_WEBLINKS_BULK_LINK_DSC23','Введите имена зарегистрированных пунктов в 1-ой строке.<br />Введите горизонтальную полосу (---)');
	define('_AM_WEBLINKS_BULK_LINK_DSC24','Опишите зарегистрированные пункты по порядку в первом параграфе, разделенных запятой(,) во 2-ой строке.');
	define('_AM_WEBLINKS_BULK_CHECK_URL','Проверьте установку адреса');
	define('_AM_WEBLINKS_BULK_CHECK_DESCRIPTION','Проверьте установку описания');

}

//---------------------------------------------------------
// compatible for v1.51
//---------------------------------------------------------
if( !defined('_AM_WEBLINKS_USE_HIGHLIGHT') ) 
{
// highlight
	define('_AM_WEBLINKS_USE_HIGHLIGHT', 'Использовать подсветку ключевых слов');
	define('_AM_WEBLINKS_CHECK_MAIL', 'Проверять формат элекстронной почты');
	define('_AM_WEBLINKS_CHECK_MAIL_DSC', 'НЕТ позволяется в любой форме. <br /> ДА проверяется, что адрес электронной почты в формате abc@efg.com, когда регистрируется ссылка. ');
	define('_AM_WEBLINKS_NO_EMAIL', 'Не указан адрес электронной почты');
}

//---------------------------------------------------------
// compatible for v1.50
//---------------------------------------------------------
if( !defined('_AM_WEBLINKS_CONF_D3FORUM') ) 
{
// d3forum
	define('_AM_WEBLINKS_CONF_D3FORUM', 'Интеграция комментариев с модулем d3forum');
	define('_AM_WEBLINKS_PLUGIN_SEL',   'Выберите плагин');
	define('_AM_WEBLINKS_DIRNAME_SEL',  'Выберите модуль');

// category
	define('_AM_WEBLINKS_CAT_PATH_STYLE', 'Стиль просмотра пути категории');

// category page
	define('_AM_WEBLINKS_CONF_CAT_PAGE', 'Настройка страницы категории');
	define('_AM_WEBLINKS_CAT_COLS', 'Число колонок в категориях');
	define('_AM_WEBLINKS_CAT_COLS_DESC', 'На странице категории, укажите число колонок, при показе категорий под одной иерархией');
	define('_AM_WEBLINKS_CAT_SUB_MODE', 'Диапазон просмотра подкатегорий');
	define('_AM_WEBLINKS_CAT_SUB_MODE_1', 'Только категорий под одной иерархией');
	define('_AM_WEBLINKS_CAT_SUB_MODE_2', 'Все категории под одной и более иерархией');

}

//---------------------------------------------------------
// compatible for v1.42
//---------------------------------------------------------
if( !defined('_WEBLINKS_GM_TYPE') ) 
{
	define('_WEBLINKS_GM_TYPE',  'Тип карты Google');
	define('_WEBLINKS_GM_TYPE_MAP',       'Карта');
	define('_WEBLINKS_GM_TYPE_SATELLITE', 'Спутник');
	define('_WEBLINKS_GM_TYPE_HYBRID',    'Гибрид');
}

if( !defined('_AM_WEBLINKS_CAT_DESC_MODE') ) 
{
	define('_AM_WEBLINKS_CAT_DESC_MODE',  'Показать описание');
	define('_AM_WEBLINKS_CAT_SHOW_FORUM', 'Показать форум');
	define('_AM_WEBLINKS_CAT_SHOW_ALBUM', 'Показать альбом');
	define('_AM_WEBLINKS_MODE_SETTING',   'Настройка значения');
	define('_AM_WEBLINKS_MODE_OMIT_PARENT', 'Такое же, как родительская категория, когда пропускается');
}

//---------------------------------------------------------
// compatible for v1.41
//---------------------------------------------------------
if( !defined('_WEBLINKS_ALBUM_ID') ) 
{
	define('_WEBLINKS_ALBUM_ID',  'ID альбома');
	define('_WEBLINKS_ALBUM_SEL', 'Выберите альбом');
}

if( !defined('_AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE') ) 
{
	define('_AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE','Обновление размера изображения категории');

	define('_AM_WEBLINKS_CONF_INDEX', 'Конфигурация главной страницы');
	define('_AM_WEBLINKS_CONF_INDEX_GM_MODE', 'Режим карты Google');

	define('_AM_WEBLINKS_CAT_SHOW_GM',   'Показать карту Google');
	define('_AM_WEBLINKS_MODE_NON',       'Не показывать');
	define('_AM_WEBLINKS_MODE_DEFAULT',   'Значение по умолчанию');
	define('_AM_WEBLINKS_MODE_PARENT',    'Такой же, как родительская категория');
	define('_AM_WEBLINKS_MODE_FOLLOWING', 'следующие значения');

	define('_AM_WEBLINKS_CONF_CAT_ALBUM',  'Просмотр альбома в категории');
	define('_AM_WEBLINKS_CONF_LINK_ALBUM', 'Просмотр альбома в ссылке');
	define('_AM_WEBLINKS_ALBUM_SEL', 'Выберите модуль альбома');
	define('_AM_WEBLINKS_ALBUM_LIMIT', 'Количество показываемых фотографий');
	define('_AM_WEBLINKS_WHEN_OMIT', 'Процесс, когда пропускается');

	define('_AM_WEBLINKS_MODULE_INSTALLED',     '%s модуль ( %s ) версии %s установлен');
	define('_AM_WEBLINKS_MODULE_NOT_INSTALLED', '%s модуль ( %s ) не установлен');
}

//---------------------------------------------------------
// compatible for v1.4x
//---------------------------------------------------------
if( !defined('_WEBLINKS_LATEST_FORUM') ) 
{
// forum
	define('_WEBLINKS_LATEST_FORUM', 'Последний форум');
	define('_WEBLINKS_FORUM',  'Форум');
	define('_WEBLINKS_THREAD', 'Тема');
	define('_WEBLINKS_POST',   'Сообщение');
	define('_WEBLINKS_FORUM_ID',  'ID форума');
	define('_WEBLINKS_FORUM_SEL', 'Выберите форум');
	define('_WEBLINKS_COMMENT_USE',  'Использовать комментарии XOOPS');

// aux
	define('_WEBLINKS_CAT_AUX_TEXT_1', 'aux_text_1');
	define('_WEBLINKS_CAT_AUX_TEXT_2', 'aux_text_2');
	define('_WEBLINKS_CAT_AUX_INT_1',  'aux_int_1');
	define('_WEBLINKS_CAT_AUX_INT_2',  'aux_int_2');

// captcha
	define('_WEBLINKS_CAPTCHA', 'Captcha');
	define('_WEBLINKS_CAPTCHA_DESC', 'Анти-спам');
	define('_WEBLINKS_ERROR_CAPTCHA','Ошибка: Несоответствие Captcha');
	define('_WEBLINKS_ERROR', 'Ошибка');

// hack for multi site
	define('_WEBLINKS_CAT_TITLE_JP', 'Японский заголовок');
	define('_WEBLINKS_DISABLE_FEATURE', 'Отключить эту функцию');
	define('_WEBLINKS_REDIRECT_JP_SITE', 'Перейти на японский сайт');

}

if( !defined('_AM_WEBLINKS_UPDATE_CAT_PATH') ) 
{
// performance
	define('_AM_WEBLINKS_UPDATE_CAT_PATH','Обновление путей дерева категорий');
	define('_AM_WEBLINKS_UPDATE_CAT_COUNT','Обновление счетчика ссылок категориий');
	define('_AM_WEBLINKS_CAT_COUNT_UPDATED','Пути дерева категорий обновлены');

// config
	define('_AM_WEBLINKS_SYSTEM_POST_LINK','Количество сообщений, когда отправляется ссылка');
	define('_AM_WEBLINKS_SYSTEM_POST_LINK_DSC','ДА увеличивать сообщения XOOPS пользователя, когда пользователь отправляет новую ссылку. ');
	define('_AM_WEBLINKS_SYSTEM_POST_RATE','Количество сообщений, когда оценивается ссылка');
	define('_AM_WEBLINKS_SYSTEM_POST_RATE_DSC','ДА увеличивать сообщения XOOPS пользователя, когда пользователь оценивает ссылку. ');

	define('_AM_WEBLINKS_VIEW_STYLE_CAT','Стиль просмотра в каждой категории');
	define('_AM_WEBLINKS_VIEW_STYLE_MARK','Стиль просмотра в рекомендуемых сайтах');
	define('_AM_WEBLINKS_VIEW_STYLE_MARK_DSC','Это применяется в рекомендуемых сайтах, лучших сайтах, RSS/ATOM сайтах');
	define('_AM_WEBLINKS_VIEW_STYLE_0','Краткое');
	define('_AM_WEBLINKS_VIEW_STYLE_1','Полное');

	define('_AM_WEBLINKS_CONF_PERFORMANCE','Повышение эффективности');
	define('_AM_WEBLINKS_CONF_PERFORMANCE_DSC','Если повышение производительности, то вычисляются необходимые данные заранее, когда показываются, и они хранятся в базе данных.<br />Когда используется в первый раз, выполните "Список категорий" -> "Обновление путей дерева категорий"');
	define('_AM_WEBLINKS_CAT_PATH','Путь дерева категорий');
	define('_AM_WEBLINKS_CAT_PATH_DSC','ДА вычисляет пути дерева категорий, и он хранятся в таблице категорий.<br />НЕТ вычисляется, когда показывается.');
	define('_AM_WEBLINKS_CAT_COUNT','Счетчик ссылок категориий');
	define('_AM_WEBLINKS_CAT_COUNT_DSC','ДА вычисляет счетчик ссылок категорий, и он хранятся в таблице категорий.<br />НЕТ вычисляется, когда показывается.');

	define('_AM_WEBLINKS_POST_TEXT_4', 'Все элементы отображаются на странице администрирования');
	define('_AM_WEBLINKS_LINK_REGISTER_1','Настройки ссылки: Текстовое поле 1');

	define('_AM_WEBLINKS_CONF_LINK_GUEST','Конфигурация гостевой регистрации ссылки');
	define('_AM_WEBLINKS_USE_CAPTCHA','Использовать CAPTCHA');
	define('_AM_WEBLINKS_USE_CAPTCHA_DSC','CAPTCHA является технологией анти-спама.<br />Для этой функции нуден модуль Captcha.<br />ДА, <b>анонимные пользователи</b> должны использовать CAPTCHA когда добавляют или изменяют ссылку.<br />НЕТ не показывает поле CAPTCHA.');
	define('_AM_WEBLINKS_CAPTCHA_FINDED',     'Модуль Captcha версии %s найден');
	define('_AM_WEBLINKS_CAPTCHA_NOT_FINDED', 'Модуль Captcha не найден');

	define('_AM_WEBLINKS_CONF_SUBMIT', 'Описание регистрационной формы ссылки');
	define('_AM_WEBLINKS_SUBMIT_MAIN',    'Описание при добавлении новой ссылки: 1');
	define('_AM_WEBLINKS_SUBMIT_PENDING', 'Описание при добавлении новой ссылки: 2');
	define('_AM_WEBLINKS_SUBMIT_DOUBLE',  'Описание при добавлении новой ссылки: 3');
	define('_AM_WEBLINKS_SUBMIT_MAIN_DSC',   'Показать всегда');
	define('_AM_WEBLINKS_SUBMIT_PENDING_DSC','Показывать, когда режим "необходимо утвердить администратором"');
	define('_AM_WEBLINKS_SUBMIT_DOUBLE_DSC', 'Показывать, когда режим "проверить уже существующую ссылку"');

	define('_AM_WEBLINKS_MODLINK_MAIN',     'Описание при изменении ссылки: 1');
	define('_AM_WEBLINKS_MODLINK_PENDING',  'Описание при изменении ссылки: 2');
	define('_AM_WEBLINKS_MODLINK_NOT_OWNER','Описание при изменении ссылки: 3');
	define('_AM_WEBLINKS_MODLINK_NOT_OWNER_DSC','Показывать, когда режим "необходимо утвердить администратором" и нет владельца');

	define('_AM_WEBLINKS_CONF_CAT_FORUM', 'Просмотр форума в категории');
	define('_AM_WEBLINKS_CONF_LINK_FORUM', 'Просмотр форума в ссылке');
	define('_AM_WEBLINKS_FORUM_SEL', 'Выберите модуль форума');
	define('_AM_WEBLINKS_FORUM_THREAD_LIMIT', 'Количество показываемых тем');
	define('_AM_WEBLINKS_FORUM_POST_LIMIT', 'Количество показываемых сообщений в каждой теме');
	define('_AM_WEBLINKS_FORUM_POST_ORDER', 'Порядок сообщений');
	define('_AM_WEBLINKS_FORUM_POST_ORDER_0', 'По дате старших сообщений');
	define('_AM_WEBLINKS_FORUM_POST_ORDER_1', 'По дате новых сообщений');
	define('_AM_WEBLINKS_FORUM_INSTALLED',     'Модуль форума ( %s ) версии %s установлен');
	define('_AM_WEBLINKS_FORUM_NOT_INSTALLED', 'Модуль форума ( %s ) не установлен');

}

//---------------------------------------------------------
// compatible for v1.3x
//---------------------------------------------------------
if( !defined('_WEBLINKS_GM_SEARCH_MAP_FROM_ADDRESS') ) 
{
// google map: Geocode
	define('_WEBLINKS_GM_SEARCH_MAP_FROM_ADDRESS', 'Поиск карты из адреса');
	define('_WEBLINKS_GM_NO_MATCH_PLACE', 'Нет места, соответствующего адресу');
	define('_WEBLINKS_GM_JP_SEARCH_MAP_FROM_ADDRESS', 'Поиск карты из адреса в Японии');
	define('_WEBLINKS_GM_JP_TOKYO_AC_GEOCODE', 'Японский Токийский университет');
	define('_WEBLINKS_GM_JP_MLIT_ISJ', 'Японское Министерство Земельной Инфраструктуры и Транспорта');

// link item
	define('_WEBLINKS_TIME_PUBLISH', 'Дата публикации');
	define('_WEBLINKS_TIME_EXPIRE',  'Дата истечения');
	define('_WEBLINKS_TEXTAREA',     'Текстовое поле');

	define('_WEBLINKS_WARN_TIME_PUBLISH', 'Время побликации еще не наступило');
	define('_WEBLINKS_WARN_TIME_EXPIRE',  'Приходит дата истечения');
	define('_WEBLINKS_WARN_BROKEN', 'Ссылка может быть неработающей');
}

if( !defined('_AM_WEBLINKS_LINK_TIME_PUBLISH_BEFORE') ) 
{
// link item
//	define('_AM_WEBLINKS_TIME_PUBLISH','Set the publication time');
//	define('_AM_WEBLINKS_TIME_PUBLISH_DESC','If you do not check it, published time will become undated');
//	define('_AM_WEBLINKS_TIME_EXPIRE','Set expiration time');
//	define('_AM_WEBLINKS_TIME_EXPIRE_DESC','If you do not check it, expired setting will become undated');

	define('_AM_WEBLINKS_LINK_TIME_PUBLISH_BEFORE','Список ссылок до времени публикации');
	define('_AM_WEBLINKS_LINK_TIME_EXPIRE_AFTER',  'Список ссылок после истекшего времени');

	define('_AM_WEBLINKS_SERVER_ENV','Серверная среда');
	define('_AM_WEBLINKS_DEBUG_CONF','Переменные отладки');
	define('_AM_WEBLINKS_ALL_GREEN','Все зеленое');
}

//---------------------------------------------------------
// compatible for v1.2x
//---------------------------------------------------------
// main
if( !defined('_WEBLINKS_GOOGLE_MAPS') ) 
{
// google map inline mode
	define('_WEBLINKS_GOOGLE_MAPS', 'Карты Google');
	define('_WEBLINKS_JAVASCRIPT_INVALID', 'Ваш браузер не может использовать JavaScript');
	define('_WEBLINKS_GM_NOT_COMPATIBLE',  'Ваш браузер не может использовать карты Google');
	define('_WEBLINKS_GM_NEW_WINDOW', 'Показать в новом окне');
	define('_WEBLINKS_GM_INLINE',   'Показать встроенно');
	define('_WEBLINKS_GM_DISP_OFF', 'Отключить показ');

// google map: inverse Geocoder
	define('_WEBLINKS_GM_GET_LATITUDE', 'Получить Широту/Долготу/Уровень увеличения');
	define('_WEBLINKS_GM_GET_ADDR', 'Получить адрес');

}

//---------------------------------------------------------
// compatible for v1.1x
//---------------------------------------------------------
// main
if( !defined('_WEBLINKS_MAP_USE') ) 
{
	define('_WEBLINKS_MAP_USE', 'Использовать иконку карты');

// rssc
	define('_WEBLINKS_RSSC_LID',  'RSSC Lid');
	define('_WEBLINKS_RSS_MODE',  'Режим RSS');
	define('_WEBLINKS_RSSC_NOT_INSTALLED', 'Модуль RSSC ( %s ) не установлен');
	define('_WEBLINKS_RSSC_INSTALLED',     'Модуль RSSC ( %s ) версии %s is установлен');
	define('_WEBLINKS_RSSC_REQUIRE', 'Требуется модуль RSSC версии %s или поздней');
	define('_WEBLINKS_GOTO_SINGLELINK', 'Перейти к информации ссылки');

// warnig
	define('_WEBLINKS_WARN_NOT_READ_URL', 'Предупреждение: Не удалось прочитать адрес');
	define('_WEBLINKS_WARN_BANNER_NOT_GET_SIZE', 'Предупреждение: Не удалось получить размер баннера');

// google map
	define('_WEBLINKS_GM_LATITUDE',  'Широта');
	define('_WEBLINKS_GM_LONGITUDE', 'Долгота');
	define('_WEBLINKS_GM_ZOOM',      'Уровень увеличения');
	define('_WEBLINKS_GM_GET_LOCATION', 'Информация о местоположении, полученная с карт Google');
	define('_WEBLINKS_GM_GET_BUTTON', 'Получить Широту/Долготу/Уровень увеличения');
	define('_WEBLINKS_GM_DEFAULT_LOCATION', 'Местоположение по умолчанию');
	define('_WEBLINKS_GM_CURRENT_LOCATION', 'Текущее местоположение');
}

// admin
if( !defined('_AM_WEBLINKS_MODULE_CONFIG_3') ) 
{
// menu
	define('_AM_WEBLINKS_MODULE_CONFIG_3','Конфигурация модуля 3');
	define('_AM_WEBLINKS_MODULE_CONFIG_4','Конфигурация модуля 4');
	define('_AM_WEBLINKS_VOTE_LIST', 'Список голосования');
	define('_AM_WEBLINKS_CATLINK_LIST', 'Список ссылок по категориям');
	define('_AM_WEBLINKS_COMMAND_MANAGE', 'Управление командой');
	define('_AM_WEBLINKS_TABLE_MANAGE',  'Управление таблицами базы данных');
	define('_AM_WEBLINKS_IMPORT_MANAGE', 'Управление импортом');
	define('_AM_WEBLINKS_EXPORT_MANAGE', 'Управление экспортом');

// config
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_2','Аутентификация, категории, т.д.');
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_3','Ссылки');
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_4','RSS, форум, карта');
	define('_AM_WEBLINKS_LINK_REGISTER','Настройки ссылки: Описание');

// bin configuration
	define('_AM_WEBLINKS_FORM_BIN', 'Конфигурация команды');
	define('_AM_WEBLINKS_FORM_BIN_DESC', 'Он используется на бинарной команде');
	define('_AM_WEBLINKS_CONF_BIN_PASS','Пароль');
	//define('_AM_WEBLINKS_CONF_BIN_PASS_DESC','');
	define('_AM_WEBLINKS_CONF_BIN_SEND','Отправить почту');
	//define('_AM_WEBLINKS_CONF_BIN_SEND_DESC','');
	define('_AM_WEBLINKS_CONF_BIN_MAILTO','Электронная почта для отправки');
	//define('_AM_WEBLINKS_CONF_BIN_MAILTO_DESC','');

// rssc
	define('_AM_WEBLINKS_RSS_DIRNAME','Директория модуля RSSC');
	//define('_AM_WEBLINKS_RSS_DIRNAME_DESC','');

// link manage
	define('_AM_WEBLINKS_DEL_LINK', 'Удалить ссылку');
	define('_AM_WEBLINKS_ADD_RSSC', 'Добавить ссылку в модуль RSSC');
	define('_AM_WEBLINKS_MOD_RSSC', 'Изменить ссылку в модуле RSSC');
	define('_AM_WEBLINKS_REFRESH_RSSC', 'Обновить ссылку в модуле RSSC');
	define('_AM_WEBLINKS_APPROVE',     'Утвердить новую ссылку');
	define('_AM_WEBLINKS_APPROVE_MOD', 'Утвердить запрос изменения ссылки');
	define('_AM_WEBLINKS_RSSC_LID_SAVED', 'Сохраненные rssc lid');
	define('_AM_WEBLINKS_GOTO_LINK_LIST', 'ПЕРЕЙТИ к списку ссылки');
	define('_AM_WEBLINKS_GOTO_LINK_EDIT', 'ПЕРЕЙТИ к изменению ссылки');
	define('_AM_WEBLINKS_ADD_BANNER', 'Добавить размера изображение баннера');
	define('_AM_WEBLINKS_MOD_BANNER', 'Изменить размер изображение баннера');

// vote list
	define('_AM_WEBLINKS_VOTE_USER', 'Голоса зарегистрированных пользователей');
	define('_AM_WEBLINKS_VOTE_ANON', 'Голоса анонимных пользователей');

// locate
	define('_AM_WEBLINKS_CONF_LOCATE','Конфигурация размещения');
	define('_AM_WEBLINKS_CONF_COUNTRY_CODE','Код страны');
	define('_AM_WEBLINKS_CONF_COUNTRY_CODE_DESC', 'Введите ccTLDs код <br/> <a href="http://www.iana.org/cctld/cctld-whois.htm" target="_blank">IANA: Коды стран доменов верхнего уровня</a>');
	define('_AM_WEBLINKS_CONF_RENEW_COUNTRY_CODE_DESC', 'Обновить пункт, который относится к коду страны. <br/> Пункт с пометкой <span style="color:#0000ff;">#</span>');
	define('_AM_WEBLINKS_RENEW', 'Обновить');

// map
	define('_AM_WEBLINKS_CONF_MAP','Конфигурация карты сайта');
	define('_AM_WEBLINKS_CONF_MAP_USE','Использовать карту сайта');
	define('_AM_WEBLINKS_CONF_MAP_TEMPLATE','Шаблон карты сайта');
	define('_AM_WEBLINKS_CONF_MAP_TEMPLATE_DESC','Введите имя шаблона файла в директории template/map/');

// google map
	define('_AM_WEBLINKS_CONF_GOOGLE_MAP','Конфигурация карт Google');
	define('_AM_WEBLINKS_CONF_GM_USE','Использовать карты Google');
	define('_AM_WEBLINKS_CONF_GM_APIKEY','Ключ API карт Google');
	define('_AM_WEBLINKS_CONF_GM_APIKEY_DESC', 'Получите ключ API на <br/> <a href="http://www.google.com/apis/maps/signup.html" target="_blank">http://www.google.com/apis/maps/signup.html</a> <br/> при использовании карт Google.' );
	define('_AM_WEBLINKS_CONF_GM_SERVER','Имя сервера');
	define('_AM_WEBLINKS_CONF_GM_LANG',  'Код языка');
	define('_AM_WEBLINKS_CONF_GM_LOCATION', 'Местоположение по умолчанию');
	define('_AM_WEBLINKS_CONF_GM_LATITUDE', 'Широта по умолчанию');
	define('_AM_WEBLINKS_CONF_GM_LONGITUDE','Долгота по умолчанию');
	define('_AM_WEBLINKS_CONF_GM_ZOOM',     'Уровень увеличения по умолчанию');

// google search
	define('_AM_WEBLINKS_CONF_GOOGLE_SEARCH','Конфигурация поиска Google');
	define('_AM_WEBLINKS_CONF_GOOGLE_SERVER','Имя сервера');
	define('_AM_WEBLINKS_CONF_GOOGLE_LANG',  'Код языка');

// template
	define('_AM_WEBLINKS_CONF_TEMPLATE','Очистить кэш шаблонов');
	define('_AM_WEBLINKS_CONF_TEMPLATE_DESC','НЕОБХОДИМО выполнить, при изменении файлов шаблона в директориях template/parts/ template/xml/ и template/map/');

}


//---------------------------------------------------------
// compatible for v1.0x
//---------------------------------------------------------
// main
if( !defined('_WEBLINKS_OPTIONS') ) 
{
//	define('_HOME',  'Home');
//	define('_SAVE',  'Save');
//	define('_SAVED', 'Saved');
//	define('_CREATE', 'Create');
//	define('_CREATED','Created');
//	define('_FINISH',   'Finish');
//	define('_FINISHED', 'Finished');
//	define('_EXECUTE', 'Execute');
//	define('_EXECUTED','Executed');
//	define('_PRINT','Print');
//	define('_SAMPLE','Sample');

	define('_NO_MATCH_RECORD','Нет соответствующей записи');
	define('_MANY_MATCH_RECORD','Есть две или более соответсвующих записи');
	define('_NO_CATEGORY', 'Нет категории');	
	define('_NO_LINK', 'Нет ссылки');
	define('_NO_TITLE', 'Нет заголовка');
	define('_NO_URL', 'Нет адреса');
	define('_NO_DESCRIPTION','Нет описания');

//	define('_GOTO_MAIN',   'Goto Main');
//	define('_GOTO_MODULE', 'Goto Module');

// config
//	define('_WEBLINKS_INIT_NOT', 'The config table is not initialized');
//	define('_WEBLINKS_INIT_EXEC', 'Initialized the config table');
//	define('_WEBLINKS_VERSION_NOT','It is not version  %s');
//	define('_WEBLINKS_UPGRADE_EXEC','Upgrad the config table');

// html tag
	define('_WEBLINKS_OPTIONS', 'Опции');
	define('_WEBLINKS_DOHTML', ' Включить HTML-теги');
	define('_WEBLINKS_DOIMAGE', ' Включить изображения');
	define('_WEBLINKS_DOBREAK', ' Включить перевод строки');
	define('_WEBLINKS_DOSMILEY', ' Включить иконки смайликов');
	define('_WEBLINKS_DOXCODE', ' Включить XOOPS-коды');

	define('_WEBLINKS_PASSWORD_INCORRECT','Неправильный пароль');
	define('_WEBLINKS_ETC', 'другое');
	define('_WEBLINKS_AUTH_UID',    'ID пользователя совпадает');
	define('_WEBLINKS_AUTH_PASSWD', 'Пароль совпадает');
	define('_WEBLINKS_BANNER_SIZE', 'Размер баннера');

}

// admin
if( !defined('_AM_WEBLINKS_ADD_CATEGORY') ) 
{
// category
	define('_AM_WEBLINKS_ADD_CATEGORY', 'Добавить новую категорию');
	define('_AM_WEBLINKS_ERROR_SOME', 'Есть некоторые сообщения об ошибках');
	define('_AM_WEBLINKS_LIST_ID_ASC',  'Список по старым ID');
	define('_AM_WEBLINKS_LIST_ID_DESC', 'Список по новым ID');

// config
	define('_AM_WEBLINKS_WARNING_NOT_WRITABLE','Директория недоступка для записи');
	define('_AM_WEBLINKS_CONF_LINK','Конфигурация ссылки');
	define('_AM_WEBLINKS_CONF_LINK_IMAGE','Конфигурация изображения ссылки');
	define('_AM_WEBLINKS_CONF_VIEW','Конфигурация просмотра');
	define('_AM_WEBLINKS_CONF_TOPTEN','Конфигурация лучшей десятки');
	define('_AM_WEBLINKS_CONF_SEARCH','Конфигурация поиска');
	define('_AM_WEBLINKS_USE_BROKENLINK','Отчеты неработающих ссылок');
	define('_AM_WEBLINKS_USE_BROKENLINK_DSC','ДА разрешить пользователям докладывать о неработающих ссылках');
	define('_AM_WEBLINKS_USE_HITS','Увеличивать счетчик посещений когда переходят на сайт');
	define('_AM_WEBLINKS_USE_HITS_DSC','ДА позволяет увеличивать счетчик посещений, когда переходят на сайт');
	define('_AM_WEBLINKS_USE_PASSWD','Аутентификация по паролю');
	define('_AM_WEBLINKS_USE_PASSWD_DSC','ДА, <b>анонимные пользователи</b> могут изменять ссылку с аутентификацией по паролю.<br />НЕТ, <br />поле пароля не показывается.');
	define('_AM_WEBLINKS_PASSWD_MIN','Минимальная длина требуемого пароля');
	define('_AM_WEBLINKS_POST_TEXT', 'Администратор имеет все полномочия управления');
	define('_AM_WEBLINKS_AUTH_DOHTML', 'Разрешение на использование HTML-тегов');
	define('_AM_WEBLINKS_AUTH_DOHTML_DSC', 'Укажите группы, которым разрешено использовать HTML-теги');
	define('_AM_WEBLINKS_AUTH_DOSMILEY', 'Разрешение на использование иконок смайликов');
	define('_AM_WEBLINKS_AUTH_DOSMILEY_DSC', 'Укажите группы, которым разрешено использовать иконки смайликов');
	define('_AM_WEBLINKS_AUTH_DOXCODE', 'Разрешение на использование XOOPS-кодов');
	define('_AM_WEBLINKS_AUTH_DOXCODE_DSC', 'Укажите группы, которым разрешено использовать XOOPS-коды');
	define('_AM_WEBLINKS_AUTH_DOIMAGE', 'Разрешение на использование изображений');
	define('_AM_WEBLINKS_AUTH_DOIMAGE_DSC', 'Укажите группы, которым разрешено использовать изображения');
	define('_AM_WEBLINKS_AUTH_DOBR', 'Разрешение на использование переноса строк');
	define('_AM_WEBLINKS_AUTH_DOBR_DSC', 'Укажите группы, которым разрешено использовать переносы строк');
	define('_AM_WEBLINKS_SHOW_CATLIST','Показать список категорий в подменю');
	define('_AM_WEBLINKS_SHOW_CATLIST_DSC','ДА показать список верхних категорий в подменю');
	define('_AM_WEBLINKS_VIEW_URL','Стиль просмотра адреса');
	define('_AM_WEBLINKS_VIEW_URL_DSC','NONE <br />не показывать адрес или &lt;a&gt; тег.<br />Непрямой<br /> показывать visit.php в ссылке поля взамен адреса. <br />Прямой <br />Показывать адрес в ссылке поля, через JavaScript в событии onmousedown поля посещения считаются через JavaScript.');
	define('_AM_WEBLINKS_VIEW_URL_0','NONE');
	define('_AM_WEBLINKS_VIEW_URL_1','Непрямой адрес');
	define('_AM_WEBLINKS_VIEW_URL_2','Прямой адрес');
	define('_AM_WEBLINKS_RECOMMEND_PRI','Приоритет рекомендуемых сайтов');
	define('_AM_WEBLINKS_RECOMMEND_PRI_DSC','NONE <br />Не показывать.<br />Нормальное <br />Рекомендуемые сайты показываются в заголовке.<br />Высокое <br />Показывать Рекомендованные сайты наверху каждой соответствующей категории.');
	define('_AM_WEBLINKS_MUTUAL_PRI','Приоритет лучших сайтов');
	define('_AM_WEBLINKS_MUTUAL_PRI_DSC','NONE <br />Не показывать.<br />Нормальное <br />Лучшие сайты показываются в заголовке.<br />Высокое <br />Показывать Лучшие сайты наверху каждой соответствующей категории.');
	define('_AM_WEBLINKS_PRI_0','NONE');
	define('_AM_WEBLINKS_PRI_1','Нормальное');
	define('_AM_WEBLINKS_PRI_2','Высокое');
	define('_AM_WEBLINKS_LINK_IMAGE_AUTO','Автоматическое обновление размера баннера');
	define('_AM_WEBLINKS_LINK_IMAGE_AUTO_DSC', "ДА <br />обновлять размер изображения баннера автоматически.");
	define('_AM_WEBLINKS_RSS_USE','Использовать RSS каналы');
	define('_AM_WEBLINKS_RSS_USE_DSC','ДА <br />Получать и отображать RSS/ATOM каналы.');

// bulk import
	define('_AM_WEBLINKS_BULK_IMPORT','Массовый импорт');
	define('_AM_WEBLINKS_BULK_IMPORT_FILE','Массовый импорт по файлу');
	define('_AM_WEBLINKS_BULK_CAT','Массовый импорт категорий');
	define('_AM_WEBLINKS_BULK_CAT_DSC1','Опишите категории');
	define('_AM_WEBLINKS_BULK_CAT_DSC2','Используйте левую стрелку скобки (>)  в начале категории для определения категории как подкатегории.');
	define('_AM_WEBLINKS_BULK_LINK','Массовый импорт ссылок');
	define('_AM_WEBLINKS_BULK_LINK_DSC1', 'Введите категорию в 1-ю строку.');
	define('_AM_WEBLINKS_BULK_LINK_DSC2', 'Опишите заголовок ссылки, адрес и объяснения, разделенных запятой(,) во 2-ой строке.');
	define('_AM_WEBLINKS_BULK_LINK_DSC3', 'Используйте тире для разделения ссылок горизонтальной полосой (---) .');
	define('_AM_WEBLINKS_BULK_ERROR_LAYER','Указано два или более подслоев в структуре дерева категорий. Это необходимо уточнить.');
	define('_AM_WEBLINKS_BULK_ERROR_CID','Неверный ID категории');
	define('_AM_WEBLINKS_BULK_ERROR_PID','Неверноый ID родительской категории');
	define('_AM_WEBLINKS_BULK_ERROR_FINISH','Операция остановлена какой-то ошибкой');

// command
	define('_AM_WEBLINKS_CREATE_CONFIG', 'Создать файл конфигурации');
	define('_AM_WEBLINKS_TEST_EXEC', 'Выполнить тест для %s');

}

// these words are added in v1.01 
// rename MI_xx to AM_xx
if( !defined('_AM_WEBLINKS_INDEX_DESC') ) 
{
	define('_AM_WEBLINKS_INDEX_DESC','Вступительный текст главной страницы');
	define('_AM_WEBLINKS_INDEX_DESC_DSC', 'Вы можете использовать этот раздел, чтобы показать некоторое описание или вводный текст. HTML допускается.');
	define('_AM_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Вот здесь находится введение вашей страницы.<br />Вы можете отредактировать это в "Конфигурации модуля 2".<br /></div>');
}

// these words are defined in admin.php 
// use for linkitem_define
if( !defined('_WEBLINKS_MID') ) 
{
	define('_WEBLINKS_MID','Изменить ID');
	define('_WEBLINKS_USERID','ID пользователя');
	define('_WEBLINKS_CREATE','Создано');
}

// these words are NOT defined in xoops 2.2.3 english
if( !defined('_US_PASSWORD') ) 
{
	define('_US_PASSWORD','Пароль');
	define('_US_TYPEPASSTWICE','(введите новый пароль дважды, чтобы изменить его)');
	define('_US_PASSNOTSAME','Оба пароля различны. Они должны быть идентичны.');
	define('_US_PWDTOOSHORT','К сожалению, ваш пароль должен быть по крайней мере <b>%s</b> символов длинной.');
	define('_US_VERIFYPASS','Подтверждение пароля');
}

if(!defined('_WEBLINKS_FROM'))
{
	define('_WEBLINKS_FROM', 'От');		// From
	define('_WEBLINKS_EXECUTION_TIME', 'Время выполнения');		// execution time
	define('_WEBLINKS_MEMORY_USAGE', 'Использование памяти');		// memory usage
	define('_WEBLINKS_SEC', 'сек');		// sec
	define('_WEBLINKS_MB', 'МБ');		// MB
	define('_WEBLINKS_FILE', 'файл');		//file
	
	define('_WEBLINKS_RDF_FEED', 'RDF канал');		//RDF feed
	define('_WEBLINKS_RSS_FEED', 'RSS канал');		//RSS feed
	define('_WEBLINKS_ATOM_FEED', 'ATOM канал');		//ATOM feed
	define('_WEBLINKS_NOFEED', 'Нет канала');		//No Feed
	define('_WEBLINKS_IN', 'в');		//in
}
?>