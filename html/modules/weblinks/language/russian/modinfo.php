<?php
// $Id: modinfo.php,v 1.1 2012/04/09 10:20:06 ohwada Exp $

// 2008-02-17
// remove _MI_WEBLINKS_SMNAME1

// 2007-12-09
// remove _MI_WEBLINKS_LINK_APPROVE_NOTIFYSBJ

// 2007-09-01
// notification: new_link_admin

// 2007-08-25
// small change _MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFY

// 2007-04-08
// _MI_WEBLINKS_BNAME_RANDOM_IMAGE

// 2006-11-03 hiro
// random block

// 2006-05-15 K.OHWADA
// weblinks ver 1.1
// add _MI_WEBLINKS_ADMENU0

// 2006-03-26 K.OHWADA
// REQ 3807: Description in main page
// _MI_WEBLINKS_INDEX_DESC

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// language for Module Info
// 2004-10-24 K.OHWADA
//=========================================================
// _LANGCODE: ru
// _CHARSET : cp1251
// Translator: Houston (Contour Design Studio http://www.cdesign.ru/)

// --- define language begin ---
if( !defined('WEBLINKS_LANG_MI_LOADED') ) 
{

define('WEBLINKS_LANG_MI_LOADED', 1);

//---------------------------------------------------------
// same as mylinks
//---------------------------------------------------------
// The name of this module
define("_MI_WEBLINKS_NAME","Веб-ссылки");

// A brief description of this module
define("_MI_WEBLINKS_DESC","Создает каталог веб-ссылок, где пользователи могут искать/отправлять/оценивать различные веб-сайты.");

// Names of blocks for this module (Not all module have blocks)
define("_MI_WEBLINKS_BNAME1","Последние ссылки");
define("_MI_WEBLINKS_BNAME2","Лучшие ссылки");
define("_MI_WEBLINKS_BNAME3","Популярные ссылки");

// Sub menu titles
//define("_MI_WEBLINKS_SMNAME1","Submit");
//define("_MI_WEBLINKS_SMNAME2","Popular Site");
//define("_MI_WEBLINKS_SMNAME3","Top Rated Site");

// Names of admin menu items
define("_MI_WEBLINKS_ADMENU1","Конфигурация модуля 2");
define("_MI_WEBLINKS_ADMENU2","Управление категориями");
define("_MI_WEBLINKS_ADMENU3","Управление ссылками");
define("_MI_WEBLINKS_ADMENU4","Добавить новую ссылку");
define("_MI_WEBLINKS_ADMENU5","Новые ссылки, ожидающие проверки");
define("_MI_WEBLINKS_ADMENU6","Измененные ссылки, ожидающие проверки");
define("_MI_WEBLINKS_ADMENU7","Отчеты о неработающих ссылках");
//define("_MI_WEBLINKS_ADMENU8","Link Checker");

//-------------------------------------
// Title of config items
// Description of each config items
//-------------------------------------
define('_MI_WEBLINKS_POPULAR', 'Выберите количество посещений для ссылок, чтобы пометить как популярные');
define('_MI_WEBLINKS_POPULARDSC', 'Введите минимальное количество посещений для показа иконки "ПОПУЛЯРНЫЙ". <br />  Если 0, иконка не показывается. ');
define('_MI_WEBLINKS_NEWLINKS', 'Выберите максимальное количество новых ссылок, отображаемых на главной странице');

//define('_MI_WEBLINKS_NEWLINKSDSC', 'Enter the maximum number of links to be displayed in the "New Links" block. ');
define('_MI_WEBLINKS_NEWLINKSDSC', 'Введите максимальное количество ссылок, отображаемых в главной странице. ');

define('_MI_WEBLINKS_PERPAGE', 'Выберите максимальное количество ссылок, отображаемых на каждой странице');
define('_MI_WEBLINKS_PERPAGEDSC', 'Введите максимальное количество ссылок, которое будет показано с подробной информацией на странице');

//define('_MI_WEBLINKS_USESHOTS', 'Select yes to display screenshot images for each link');
//define('_MI_WEBLINKS_USESHOTSDSC', '');
//define('_MI_WEBLINKS_SHOTWIDTH', 'Maximum allowed width of each screenshot image');
//define('_MI_WEBLINKS_SHOTWIDTHDSC', '');

//define('_MI_WEBLINKS_ANONPOST','Allow anonymous users to post links?');
//define('_MI_WEBLINKS_AUTOAPPROVE','Auto approve new links without admin intervention?');
//define('_MI_WEBLINKS_AUTOAPPROVEDSC','');

//-------------------------------------
// Text for notifications
//-------------------------------------
define('_MI_WEBLINKS_GLOBAL_NOTIFY', 'Глобальные');
define('_MI_WEBLINKS_GLOBAL_NOTIFYDSC', 'Глобальные опции оповещения о ссылках.');

define('_MI_WEBLINKS_CATEGORY_NOTIFY', 'Категория');
define('_MI_WEBLINKS_CATEGORY_NOTIFYDSC', 'Опции оповещения, которые применяются к текущей ссылке категории.');

define('_MI_WEBLINKS_LINK_NOTIFY', 'Ссылка');
define('_MI_WEBLINKS_LINK_NOTIFYDSC', 'Опции оповещения, которые применяются к текущей ссылке.');

define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFY', 'Новая категория');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Оповестить меня, когда создается новая ссылка категории.');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Получать оповещения, когда создается новая ссылка категории.');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} авто-оповещение : Новая ссылка категории');

define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFY', '[Администрирование] Изменение / Удаление запрашиваемой ссылки');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYCAP', '[Администрирование] Оповестить меня о какой-либо запросе изменения / удаления ссылки.');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYDSC', 'Получать оповещения, когда отправлен какой-либо запрос изменения / удаления ссылки.');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} авто-оповещение : Запрос на изменение / удаление ссылки');

define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFY', '[Администрирование] Отправлена неработающая ссылка');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYCAP', '[Администрирование] Оповестить меня о каком-либо отчете о неработающей ссылке.');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYDSC', 'Получать оповещения, когда отправлен какой-либо отчет о неработающей ссылке.');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} авто-оповещение : Отчет о неработающей ссылке');

define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFY', '[Администрирование] Отправлена новая ссылка');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYCAP', '[Администрирование] Оповестить меня, когда отправлена какая-либо новая ссылка (ожидает утверждения).');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYDSC', 'Получать оповещения, когда отправлена какая-либо новая ссылка (ожидает утверждения).');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} авто-оповещение : Отправлена новая ссылка');

define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFY', 'Новая ссылка');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYCAP', 'Оповестить меня, когда опубликована какая-либо новая ссылка.');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYDSC', 'Получать оповещения, когда опубликована какая-либо новая ссылка.');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} авто-оповещение : Новая ссылка');

define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFY', '[Администрирование] Отправлена новая ссылка');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYCAP', '[Администрирование] Оповестить меня, когда отправлена какая-либо новая ссылка (ожидает утверждения) в текущей категории.');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYDSC', 'Получать оповещения, когда отправлена какая-либо новая ссылка (ожидает утверждения) в текущей категории.');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} авто-оповещение : Отправлена новая ссылка в категории');

define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFY', 'Новая ссылка');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYCAP', 'Оповестить меня, когда опубликована какая-либо новая ссылка в текущей категории.');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYDSC', 'Получать оповещения, когда опубликована какая-либо новая ссылка в текущей категории.');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} авто-оповещение : Новая ссылка в категории');

//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFY', 'Link Approved');
//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYCAP', 'Notify me when this link is approved.');
//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYDSC', 'Receive notification when this link is approved.');
//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} : Your submit link is approved');


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
// === Names of blocks for this module ===
define("_MI_WEBLINKS_BNAME4","Список категорий веб-ссылок");
define("_MI_WEBLINKS_BNAME5","Последние RSS/ATOM каналы веб-ссылок");
define("_MI_WEBLINKS_BNAME6","Показать блог веб-ссылок");

//-------------------------------------
// Title of config items
//-------------------------------------
define('_MI_WEBLINKS_LOGOSHOW','Показать изображение логотипа модуля');
define('_MI_WEBLINKS_LOGOSHOWDSC', 'Выберите "ДА" для показа изображение логотипа модуля.');

define('_MI_WEBLINKS_TITLESHOW','Показывать заголовок модуля');
define('_MI_WEBLINKS_TITLESHOWDSC', 'Выберите "ДА" для показа заголовка модуля');

define('_MI_WEBLINKS_NEWDAYS', 'Выберите количество дней для ссылок, которые будут помечены как новые');
define('_MI_WEBLINKS_NEWDAYS_DSC', 'Введите количество дней для отображения иконки "НОВОЕ". <br /> Если 0, иконка не отображается. ');

define('_MI_WEBLINKS_DESCSHORT', 'Максимальное количество символов, используемых для объединения списка ссылок ');
define('_MI_WEBLINKS_DESCSHORTDSC', 'Введите максимальное количество символов, которое будет использовано для объединения списка ссылок. ');

define('_MI_WEBLINKS_ORDERBY', 'Значение по умолчанию сортировки отображения подробности ссылки');
define('_MI_WEBLINKS_ORDERBYDSC', 'Введите значение по умолчанию сортировки отображения подробности ссылки.');
define("_MI_WEBLINKS_ORDERBY0","Заголовок (От А до Я)");
define("_MI_WEBLINKS_ORDERBY1","Заголовок (От Я до А)");
define("_MI_WEBLINKS_ORDERBY2","Дата (Старые ссылки показываются вначале)");
define("_MI_WEBLINKS_ORDERBY3","Дата (Новые ссылки показываются вначале)");
define("_MI_WEBLINKS_ORDERBY4","Оценка (От наименьшей оценки к наибольшей оценке)");
define("_MI_WEBLINKS_ORDERBY5","Оценка (От наибольшей оценки к наименьшей оценке)");
define("_MI_WEBLINKS_ORDERBY6","Популярность (От наименьших к наибольшим посещениям)");
define("_MI_WEBLINKS_ORDERBY7","Популярность (От наибольших к наименьшим посещениям)");
	define("_MI_WEBLINKS_ORDERBY8","Дата публикации (Старые ссылки показываются вначале)");
	define("_MI_WEBLINKS_ORDERBY9","Дата публикации (Новые ссылки показываются вначале)");

define('_MI_WEBLINKS_SEARCH_LINKS','Количество ссылок, отображаемых на странице результатов поиска');
define('_MI_WEBLINKS_SEARCH_LINKSDSC', 'Введите максимальное количество ссылок, которое будет показано на странице результатов поиска');

define('_MI_WEBLINKS_SEARCH_MIN', 'Минимальное количество букв для поиска по ключевым словам');
define('_MI_WEBLINKS_SEARCH_MINDSC', 'Введите минимальное число символов для поиска по ключевым словам ');

define('_MI_WEBLINKS_USEFRAMES', 'Вы хотите, чтобы отображались связанные страницы во фрейме?');
define('_MI_WEBLINKS_USEFRAMEDSC', 'Выберите, следует ли отображать целевую страницу ссылки внутри фрейма');

define('_MI_WEBLINKS_BROKEN','Количество отчетов о неработающей ссылке, чтобы остановить показ');
define('_MI_WEBLINKS_BROKENDSC', 'Введите количество отчетов о неработающей ссылке, чтобы остановить показ. <br /> Когда ниже этого значения, то он будет рассматриваться как временная ошибка, и ничего не будет сделано. <br />Когда это значение больше, ссылка не будет отображаться.');

define('_MI_WEBLINKS_LISTIMAGE_USE','Использовать изображения ссылки для списка ссылок');
define('_MI_WEBLINKS_LISTIMAGE_WIDTH','Максимальная ширина изображения ссылки');
define('_MI_WEBLINKS_LISTIMAGE_HEIGHT','Максимальная высота изображения ссылки');
define('_MI_WEBLINKS_LISTIMAGE_USEDSC', 'Выберите "ДА", чтобы показать изображения ссылки при отображении списка ссылок');

define('_MI_WEBLINKS_LINKIMAGE_USE','Использовать изображения ссылки для отображения подробности ссылки');
define('_MI_WEBLINKS_LINKIMAGE_WIDTH','Максимальная ширина изображения ссылки для отображения подробности ссылки');
define('_MI_WEBLINKS_LINKIMAGE_HEIGHT','Максимальная высота изображения ссылки для отображения подробности ссылки');
define('_MI_WEBLINKS_LINKIMAGE_USEDSC', 'Выберите "ДА", чтобы показать изображения ссылки при отображении подробности ссылки.');

// 2005-10-20 K.OHWADA
define('_MI_WEBLINKS_TOPTEN_STYLE','Стиль лучшей десятки');
define('_MI_WEBLINKS_TOPTEN_STYLE_DSC', 'Выберите стиль в "Популярный сайт" и "Лучший сайт". ');
define('_MI_WEBLINKS_TOPTEN_STYLE_0','Каждая верхняя категория');
define('_MI_WEBLINKS_TOPTEN_STYLE_1','Смешанный: Все категории');

define('_MI_WEBLINKS_TOPTEN_LINKS', 'Максимальное количество лучшей десятки ссылок');
define('_MI_WEBLINKS_TOPTEN_LINKS_DSC', 'Введите максимальное количество ссылок, которое будет отображаться в "Популярный сайт" и "Лучший сайт". ');

define('_MI_WEBLINKS_TOPTEN_CATS','Максимальное количество категорий в лучшей десятке');
define('_MI_WEBLINKS_TOPTEN_CATS_DSC', 'Введите максимальное количество категорий, которое будет отображаться в "Популярный сайт" и "Лучший сайт". <br />Произойдет тайм-аут, если слишком много верхних категорий выбрано');

// 2006-03-26
// REQ 3807: Main Page Introductory Text
//define('_MI_WEBLINKS_INDEX_DESC','Main Page Introductory Text');
//define('_MI_WEBLINKS_INDEX_DESC_DSC', 'You can use this section to display some descriptive or introductory text. HTML is allowed.');
//define('_MI_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center"><font color="blue">Here is where your page introduction goes.<br />You can edit it at "Module Configuration 2".</font><br /></div>');

// 2006-05-15
define('_MI_WEBLINKS_ADMENU0', 'Главная');

// 2006-11-03
// random block
define('_MI_WEBLINKS_BNAME_RANDOM',  'Случайная ссылка');
define('_MI_WEBLINKS_BNAME_GENERIC', 'Общий блок ссылок');

// 2007-04-08
define('_MI_WEBLINKS_BNAME_RANDOM_PHOTO', 'Случайная фотография');

// 2007-09-01
// notification: new_link_admin
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN', '[Администрирование] Новая ссылка (с комментарием для администратора)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_CAP', '[Администрирование] Оповестить меня, когда опубликована какая-либо новая ссылка (с комментарием для администратора)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_DSC', 'Получать оповещения, когда опубликована какая-либо новая ссылка (с комментарием для администратора)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_SBJ', '[{X_SITENAME}] {X_MODULE} авто-оповещение : Новая ссылка');

// notification: new_link_comment
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT', '[Администрирование] Новая ссылка (если введен комментарий для администратора )');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_CAP', '[Администрирование] Оповестить меня, когда опубликована какая-либо новая ссылка (если введен комментарий для администратора)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_DSC', 'Получать оповещения, когда опубликована какая-либо новая ссылка (если введен комментарий для администратора)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_SBJ', '[{X_SITENAME}] {X_MODULE} авто-оповещение : Новая ссылка)');

}
// --- define language begin ---

?>