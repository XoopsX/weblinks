<?php
// $Id: admin.php,v 1.1 2012/04/09 10:20:05 ohwada Exp $

// 2008-02-17 K.OHWADA
// htmlout

// 2007-12-09 K.OHWADA
// remove _WEBLINKS_ADMIN_CHECK
// add AM_WEBLINKS_D3FORUM_VIEW

// 2007-11-01 K.OHWADA
// _AM_WEBLINKS_GM_MARKER_WIDTH

// 2007-09-01 K.OHWADA
// nofitication
// change _WEBLINKS_LINK_APPROVED _AM_WEBLINKS_USE_HITS

// 2007-08-01 K.OHWADA
// config 0

// 2007-07-14 K.OHWADA
// highlight

// 2007-06-10 K.OHWADA
// d3forum

// 2007-04-08 K.OHWADA
// _AM_WEBLINKS_CAT_DESC_MODE

// 2007-03-25 K.OHWADA
// _AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE

// 2007-02-20 K.OHWADA
// performance

// 2006-12-11 K.OHWADA
// _AM_WEBLINKS_TIME_PUBLISH

// 2006-10-05 K.OHWADA
// _AM_WEBLINKS_MODULE_CONFIG_3
// google map

// 2006-05-15 K.OHWADA
// weblinks ver 1.1
// _AM_WEBLINKS_INDEX_DESC, etc

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module duplication

//=========================================================
// WebLinks Module
// language for admin
// 2004-10-20 K.OHWADA
//=========================================================
// _LANGCODE: ru
// _CHARSET : utf-8
// Translator: Houston (Contour Design Studio http://www.cdesign.ru/)

// --- define language begin ---
if( !defined('WEBLINKS_LANG_AM_LOADED') ) 
{

define('WEBLINKS_LANG_AM_LOADED', 1);

define("_WEBLINKS_ADMIN_INDEX","Администрирование");

// BUG 2931: unmatch popup menu 'preference' and index menu 'module setting'
define("_WEBLINKS_ADMIN_MODULE_CONFIG_1","Конфигурация модуля 1 (Настройки)");

define("_WEBLINKS_ADMIN_MODULE_CONFIG_2","Конфигурация модуля 2");
//define("_WEBLINKS_ADMIN_ADDMODDEL_CATEGORY","Add, Modify, and Delete Categories");
define("_WEBLINKS_ADMIN_ADD_LINK","Добавить новую ссылку");
define("_WEBLINKS_ADMIN_OTHERFUNC","Другие функции");
define("_WEBLINKS_ADMIN_GOTO_ADMIN_INDEX","Перейти к администрированию");

//======	config.php 	======
// Access Authority
define('_WEBLINKS_ADMIN_AUTH','Разрешения');
define('_WEBLINKS_ADMIN_AUTH_TEXT', 'Администратор имеет все полномочия управления');
define('_WEBLINKS_AUTH_SUBMIT','Могут отправлять новую ссылку');
define('_WEBLINKS_AUTH_SUBMIT_DSC','Укажите группы, которым разрешено отправлять новую ссылку');
define('_WEBLINKS_AUTH_SUBMIT_AUTO','Могут автоматически утвердить вновь отправленные ссылки');
define('_WEBLINKS_AUTH_SUBMIT_AUTO_DSC','Укажите группы, от которых присланные ссылки автоматически утверждаются');
define('_WEBLINKS_AUTH_MODIFY','Могут изменять');
define('_WEBLINKS_AUTH_MODIFY_DSC','Укажите группы, которым разрешено отправлять запросы на изменение ссылки');
define('_WEBLINKS_AUTH_MODIFY_AUTO','Могут утверждать изменения ссылки');
define('_WEBLINKS_AUTH_MODIFY_AUTO_DSC','Укажите группы, которые могут утверждать запросы изменения ссылки');
define('_WEBLINKS_AUTH_RATELINK','Могут оценивать ссылку');
define('_WEBLINKS_AUTH_RATELINK_DSC',"Укажите группы, которые могут оценивать ссылку.<br />Эта функция работает, когда пользователям разрешено оценивать ссылку.");
define('_WEBLINKS_USE_PASSWD','Использование пароля при изменении ссылки');
define('_WEBLINKS_USE_PASSWD_DSC','Отображает поле использование пароля когда ДА, если выбрано, <br />для групп, которым не разрешено отправлять/утверждать запросы на изменения. ');
define('_WEBLINKS_USE_RATELINK','Разрешено оценивать');
define('_WEBLINKS_USE_RATELINK_DSC',"ДА - разрешить пользователям оченивать ссылки.");
define('_WEBLINKS_AUTH_UPDATED', 'Разрешения обновлены');


// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS','Настройки RSS/ATOM каналов');
define('_WEBLINKS_RSS_MODE_AUTO','Автоматическое обновление RSS/ATOM каналов');
define('_WEBLINKS_RSS_MODE_AUTO_DSC', "ДА разрешает 'автоматическое обнаружение RSS/ATOM адреса' и 'автоматическое обновление' если RSS/ATOM ссылки включены в отправленную ссылку. ");
define('_WEBLINKS_RSS_MODE_DATA','Данные RSS/ATOM, чтобы показать');
define('_WEBLINKS_RSS_MODE_DATA_DSC', "ATOM FEED, использует данные в таблице Atom каналах после разбора. <br />XML использует данные из таблицы ссылки до разбора. <br />Некоторые данные могут быть не сохранены в таблице atomfeed после фильтрации. ");
define('_WEBLINKS_RSS_CACHE','Время кэша RSS/ATOM каналов');
define('_WEBLINKS_RSS_CACHE_DSC', 'Измеряется в часах.');
define('_WEBLINKS_RSS_LIMIT','Максимальное количество RSS/ATOM каналов');
define('_WEBLINKS_RSS_LIMIT_DSC', 'Введите максимальное количество RSS/ATOM каналов сохраняемых в таблице atomfeed<br />Старые данные будут удалены, если это значение превышено. <br />0 не ограничено. ');
define('_WEBLINKS_RSS_SITE','Сайты поиска RSS');
define('_WEBLINKS_RSS_SITE_DSC',"Введите список адресов RSS из сайтов поиска RSS. <br />Начинайте каждую запись с новой строки, когда указывается больше чем одна. <br />Не вводите адреса ATOM. ");
define('_WEBLINKS_RSS_BLACK','Черный список RSS/ATOM адресов');
define('_WEBLINKS_RSS_BLACK_DSC','Введите список адресов для отказа, когда собираются RSS/ATOM каналы. <br />Начинайте каждую запись с новой строки, когда указывается больше чем одна. <br />Вы можете использовать регулярные выражения PERL. ');
define('_WEBLINKS_RSS_WHITE','Белый список RSS/ATOM адресов');
define('_WEBLINKS_RSS_WHITE_DSC','Введите список адресов для сбора, которые соответствуют черному списку. <br />Начинайте каждую запись с новой строки, когда указывается больше чем одна. <br />Вы можете использовать регулярные выражения PERL. ');
define('_WEBLINKS_RSS_URL_CHECK', 'Какие-либо адреса ссылки соответствующие черному списку. ');
define('_WEBLINKS_RSS_URL_CHECK_DSC', 'Пожалуйста, скопируйте и вставте из нижнего белого списка в регистрационную форму, если необходимо. ');
define('_WEBLINKS_RSS_UPDATED', 'Настройки RSS/ATOM обновлены');


// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS_VIEW','Настройки просмотра RSS/ATOM каналов');
define('_WEBLINKS_RSS_MODE_TITLE','Использовать HTML-тегов в заголовке');
define('_WEBLINKS_RSS_MODE_TITLE_DSC', "ДА показывать HTML-теги заголовке ссылок, если заголовок имеет HTML-теги. <br />НЕТ удалять HTML-теги из заголовка. ");
define('_WEBLINKS_RSS_MODE_CONTENT','Использовать HTML-теги в наполнении');
define('_WEBLINKS_RSS_MODE_CONTENT_DSC', "ДА показывать наполнение ссылок с HTML-тегами, если наполнение имеет HTML-теги. <br />НЕТ удалять все HTML-теги из отображаемого наполнения. ");
define('_WEBLINKS_RSS_NEW','Выберите максимальное число "новые RSS/ATOM каналы" отображаемых на главной странице');
define('_WEBLINKS_RSS_NEW_DSC', 'Введите максимальное число новых RSS/ATOM каналов, которые будут отображаться на главной странице.');
define('_WEBLINKS_RSS_PERPAGE','Выберите максимальное число RSS/ATOM каналов для отображения на странице Подробнее о ссылке и на странице RSS/ATOM');
define('_WEBLINKS_RSS_PERPAGE_DSC', 'Введите максимальное число RSS/ATOM каналов для показа на странице RSS/ATOM. ');
define('_WEBLINKS_RSS_NUM_CONTENT','Число каналов при отображении наполнения');
define('_WEBLINKS_RSS_NUM_CONTENT_DSC', 'Введите число каналов отображаемых наполнение RSS/ATOM каналов на странице Подробнее о ссылке. <br />Краткое содержание отображается на остальные каналы. ');
define('_WEBLINKS_RSS_MAX_CONTENT','Максимальное число символов, используемых для наполнения RSS/ATOM канала');
define('_WEBLINKS_RSS_MAX_CONTENT_DSC', 'Введите максимальное число символов, которые будут использоваться для наполнения RSS/ATOM канала на странице RSS/ATOM.  <br />Используется при "Использовать HTML-теги в наполнении" в "да." ');
define('_WEBLINKS_RSS_MAX_SUMMARY','Максимальное число символов, используемых для краткого содержания RSS/ATOM канала');
define('_WEBLINKS_RSS_MAX_SUMMARY_DSC', 'Введите максимальное число символов, которое будет использоваться для краткого содержания RSS/ATOM канала на главной странице. ');


// use link field
define('_WEBLINKS_ADMIN_POST','Настройки полей ссылки');
define('_WEBLINKS_ADMIN_POST_TEXT_1', "Не использовать  - поле не будет отображаться на форме заполнения. ");
define('_WEBLINKS_ADMIN_POST_TEXT_2', "Использовать - поле будет показано на форме заполнения для возможности отправителю вводить данные в поле или нет ");
define('_WEBLINKS_ADMIN_POST_TEXT_3', "Обязательный -  поле ДОЛЖНО быть заполнено. ");
define('_WEBLINKS_NO_USE',"Не использовать");
define('_WEBLINKS_USE','Использовать');
define('_WEBLINKS_INDISPENSABLE','Обязательный');
define('_WEBLINKS_TYPE_DESC','Использовать XOOPS DHTML текстовое поле для заполнения');
define('_WEBLINKS_TYPE_DESC_DSC', 'НЕТ использовать нормальное текстовое поле.<br />ДА использовать XOOPS DHTML-тип текстовых полей для заполнения формы. ');
define('_WEBLINKS_CHECK_DOUBLE','Принимать представление существующих ссылок');
define('_WEBLINKS_CHECK_DOUBLE_DSC', 'НЕТ позволяет регистрировать существующие ссылки. <br /> ДА проверяет, является ли ссылка уже присутствующей в базе данных. ');
define('_WEBLINKS_POST_UPDATED', 'Настройки полей ссылки обновлены');

// cateogry
define('_WEBLINKS_ADMIN_CAT_SET','Настройки категории');
define('_WEBLINKS_CAT_SEL', 'Максимальное число категорий, которое пользователь может выбрать для отправки ссылок');
define('_WEBLINKS_CAT_SEL_DSC', 'Введите максимальное число категорий, которое пользователь может выбрать, чтобы классифицировать отправленные ссылки');
define('_WEBLINKS_CAT_SUB','Количество подкатегорий для отображения');
define('_WEBLINKS_CAT_SUB_DSC','Установите число подкатегорий отображаемых в списке категорий на главной странице');
define('_WEBLINKS_CAT_IMG_MODE','Выберите изображение категории');
define('_WEBLINKS_CAT_IMG_MODE_DSC', 'NONE нет изображения. <br />Folder.gif показывает folder.gif. <br />Настройка изображения показывает ностройки изображения для каждой категории. ');
//define("_WEBLINKS_CAT_IMG_MODE_0","NONE");
define("_WEBLINKS_CAT_IMG_MODE_1","folder.gif");
define("_WEBLINKS_CAT_IMG_MODE_2","Настройка изображения");
define('_WEBLINKS_CAT_IMG_WIDTH','Максимальная ширина изображения категории');
define('_WEBLINKS_CAT_IMG_HEIGHT','Максимальная высота изображения категории');
define('_WEBLINKS_CAT_IMG_SIZE_DSC','Используется, когда выбрано "Настройка изображения". ');
define('_WEBLINKS_CAT_UPDATED', 'Настройки категории обновлены');


//======	cateogry_list.php 	======
define("_WEBLINKS_ADMIN_CATEGORY_MANAGE","Управление категориями");
define("_WEBLINKS_ADMIN_CATEGORY_LIST","Список категорий");
//define("_WEBLINKS_ORDER_ID"," Listed by ID");
define("_WEBLINKS_ORDER_TREE"," Список как дерево");
define("_WEBLINKS_CAT_ORDER","Порядок категорий");
define("_WEBLINKS_THERE_ARE_CATEGORY","Есть <b>%s</b> категорий в базе данных");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_1","Нажмите <b>ID категории</b> для редактирования конкретной категории. ");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_2","Нажмите <b>Родительская категория</b> или <b>Заголовок</b>, для показа порядка списка категорий . ");
define("_WEBLINKS_NO_CATEGORY","Не существует соотвествующей категории. ");
define("_WEBLINKS_NUM_SUBCAT","Количество подкатегории");
define('_WEBLINKS_ORDERS_UPDATED', 'Порядок категорий обновлен');

//======	cateogry_manage.php 	======
define("_WEBLINKS_IMGURL_MAIN","Адрес изабражения категории");
define("_WEBLINKS_IMGURL_MAIN_DSC1","Необязательно. <br />Размеры изображения регулируются автоматически");
//define("_WEBLINKS_IMGURL_MAIN_DSC2","Images are for the main category only. ");

//======	link_list.php 	======
define("_WEBLINKS_ADMIN_LINK_MANAGE","Управление ссылками");
define("_WEBLINKS_ADMIN_LINK_LIST","Список ссылок");
define("_WEBLINKS_ADMIN_LINK_BROKEN","Список неработающих ссылок");
define("_WEBLINKS_ADMIN_LINK_ALL_ASC","Список всех ссылок (Список по старым ID) ");
define("_WEBLINKS_ADMIN_LINK_ALL_DESC","Список всех ссылок (Список по новым ID) ");
define("_WEBLINKS_ADMIN_LINK_NOURL","Список ссылок, у которых адрес не установлен");
define("_WEBLINKS_COUNT_BROKEN","Счетчик неработающих ссылок");
define("_WEBLINKS_NO_LINK","Не существует соответствующей ссылки. ");
define("_WEBLINKS_ADMIN_PRESENT_SAVE","Данные, сохраненные в базе данных показано здесь. ");

//======	link_manage.php 	======
//define("_WEBLINKS_USERID","User ID");
//define("_WEBLINKS_CREATE","Created");

//======	link_broken_check.php 	======
define("_WEBLINKS_ADMIN_LINK_CHECK_UPDATE","Проверка ссылки и обновление");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK","Проверка неработающей ссылки");
define("_WEBLINKS_ADMIN_BROKEN_CHECK","Проверить");
define("_WEBLINKS_ADMIN_BROKEN_RESULT","Результаты проверки");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_CAUTION","Может произойти тайм-аут, если есть много неработающих ссылок. <br />Если да, пожалуйста, измените численные значения для лимита и смещения. <br />limit= 0, или Нет ограничений.");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_NOTICE","Нажатие <b>ID ссылки</b> открывает страницу изменения ссылки. <br /><b>Адрес веб-сайта</b> приведет вас на веб-сайт при нажатии. <br />");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_GOOGLE","Поиск Google откроется при нажатии <b>заголовка веб-сайта</b>. <br />");
define("_WEBLINKS_ADMIN_LIMIT","Максимум ссылок для проверки (limit)");
define("_WEBLINKS_ADMIN_OFFSET","Смещение (offset)");
//define("_WEBLINKS_ADMIN_CHECK","CHECK");
define("_WEBLINKS_ADMIN_TIME_START","Время начала");
define("_WEBLINKS_ADMIN_TIME_END","Время завершения");
define("_WEBLINKS_ADMIN_TIME_ELAPSE","Прошло времени");
define("_WEBLINKS_ADMIN_LINK_NUM_ALL","Все ссылки");
define("_WEBLINKS_ADMIN_LINK_NUM_CHECK","Проверено ссылок");
define("_WEBLINKS_ADMIN_LINK_NUM_BROKEN","Неработающие ссылки");
define("_WEBLINKS_ADMIN_NUM","ссылки");
define("_WEBLINKS_ADMIN_MIN_SEC","%s мин %s сек");
define("_WEBLINKS_ADMIN_CHECK_NEXT","Проверить следующие %s ссылок");
//define("_WEBLINKS_ADMIN_RSS_REFRESH_NOTE","Simultaneously execute an Auto Discovery of RSS/ATOM urls ");

//======	rss_manage.php 	======
define("_WEBLINKS_ADMIN_RSS_MANAGE","Управление RSS/ATOM каналами");
define("_WEBLINKS_ADMIN_RSS_REFRESH","Обновить RSS/ATOM");
define("_WEBLINKS_ADMIN_RSS_REFRESH_LINK","Обновить данные кэша ссылки");
define("_WEBLINKS_ADMIN_RSS_REFRESH_SITE","Обновить кэш сайта поиска RSS");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_URL","Количество RSS/ATOM адресов обновились");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_SITE","Количество RSS/ATOM сайтов обновились адреса");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOM_SITE","Количество RSS/ATOM сайтов обновились");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOMFEED","Количество RSS/ATOM каналов обновились");
define("_WEBLINKS_ADMIN_RSS_CACHE_CLEAR","Очистить кэш RSS/ATOM канала");
define("_WEBLINKS_RSS_CLEAR_NUM","Очистить кэш RSS/ATOM канала в порядке времени, если больше чем указанное число каналов в Конфигурации модуля 1.");
define("_WEBLINKS_RSS_NUMBER","Количество каналов");
define("_WEBLINKS_RSS_CLEAR_LID","Очистить кэш указанных ID ссылок");
define("_WEBLINKS_RSS_CLEAR_ALL","Очистить весь кэш");
define("_WEBLINKS_NUM_RSS_CLEAR_LINK","Количество кэша RSS/ATOM очищается");
define("_WEBLINKS_NUM_RSS_CLEAR_ATOMFEED","Количество каналов ATOM/RSS очищается");

//======	user_list.php 	======
define("_WEBLINKS_ADMIN_USER_MANAGE", "Управление пользователями");
define("_WEBLINKS_ADMIN_USER_EMAIL", "Список пользователей с адресами электронной почты");
define("_WEBLINKS_ADMIN_USER_LINK", "Список зарегистрированных пользователей с ссылками и информацией");
define("_WEBLINKS_ADMIN_USER_NOLINK", "Список зарегистрированных пользователей без ссылок и информации");
define("_WEBLINKS_ADMIN_USER_EMAIL_DSC", "Показать только один адрес электронной почты, если дублируется");
//define("_WEBLINKS_ADMIN_USER_LINK_DSC", 'Use "Send Message to Users" of XOOPS core');
//define("_WEBLINKS_USER_ALL", " (all) ");
//define("_WEBLINKS_USER_MAX", " (each %s persons) ");
define("_WEBLINKS_THERE_ARE_USER", "<b>%s</b> пользователей найдено");
define("_WEBLINKS_USER_NUM", "Показать с %s человек к %s человек.");
define("_WEBLINKS_USER_NOFOUND", "Пользователей не найдено");
define("_WEBLINKS_UID_EMAIL", "Адрес электронной почты отправителя");

//======	mail_users.php 	======
define("_WEBLINKS_ADMIN_SENDMAIL", "Отправить электронную почту");
define("_WEBLINKS_THERE_ARE_EMAIL","Есть <b>%s</b> электронных адресов");
define("_WEBLINKS_SEND_NUM", "Отправить форму электронного адреса от %s человек к %s человек");
//define("_WEBLINKS_SEND_NEXT","Send next %s emails");
//define("_WEBLINKS_SUBJECT_FROM", "Information from %s");
//define("_WEBLINKS_HELLO", "Hello %s");
define("_WEBLINKS_MAIL_TAGS1","{W_NAME} будет печатать имя пользователя");
define("_WEBLINKS_MAIL_TAGS2","{W_EMAIL} будет печатать электронный адрес пользователя");
define("_WEBLINKS_MAIL_TAGS3","{W_LID} будет печатать ID ссылки пользователя");

// general
//define('_WEBLINKS_WEBMASTER', 'Webmaster');
define('_WEBLINKS_SUBMITTER', 'Отправитель');
//define("_WEBLINKS_MID","Modify ID");
define("_WEBLINKS_UPDATE","ОБНОВЛЕНИЕ");
define("_WEBLINKS_SET_DEFAULT","Установить по умолчанию");
define("_WEBLINKS_CLEAR","ОЧИСТИТЬ");
define("_WEBLINKS_CHECK","ПРОВЕРИТЬ");
define("_WEBLINKS_NON","Ничего не сделано");
//define("_WEBLINKS_SENDMAIL", "SEND Email");

// 2005-08-09
// BUG 2827: RSS refresh: Invalid argument supplied for foreach()
define("_WEBLINKS_ADMIN_NO_LINK_BROKEN_CHECK","Нет ссылок для проверки");
define("_WEBLINKS_ADMIN_NO_RSS_REFRESH","Нет ссылок для обновления RSS");

// 2005-10-20
define("_WEBLINKS_LINK_APPROVED", "[{X_SITENAME}] {X_MODULE}: Ваша отправленная ссылка утверждена");
define("_WEBLINKS_LINK_REFUSED",  "[{X_SITENAME}] {X_MODULE}: Ваша отправленная ссылка отклонена");

// 2006-05-15
define('_AM_WEBLINKS_INDEX_DESC','Вступительный текст главной страницы');
define('_AM_WEBLINKS_INDEX_DESC_DSC', 'Вы можете использовать этот раздел, чтобы показать некоторое описание или вводный текст. HTML допускается.');
define('_AM_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Вот здесь находится введение вашей страницы.<br />Вы можете отредактировать это в "Конфигурации модуля 2".<br /></div>');

define('_AM_WEBLINKS_ADD_CATEGORY', 'Добавить новую категорию');
define('_AM_WEBLINKS_ERROR_SOME', 'Есть некоторые сообщения об ошибках');
define('_AM_WEBLINKS_LIST_ID_ASC',  'Список по старым ID');
define('_AM_WEBLINKS_LIST_ID_DESC', 'Список по новым ID');

// config
//define('_AM_WEBLINKS_WARNING_NOT_WRITABLE','The directory is not writeable');

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
//define('_AM_WEBLINKS_CREATE_CONFIG', 'Create Config File');
//define('_AM_WEBLINKS_TEST_EXEC', 'Test execute for %s');

// === 2006-10-05 ===
// menu
define('_AM_WEBLINKS_MODULE_CONFIG_3','Конфигурация модуля 3');
define('_AM_WEBLINKS_MODULE_CONFIG_4','Конфигурация модуля 4');
define('_AM_WEBLINKS_VOTE_LIST', 'Список голосования');
define('_AM_WEBLINKS_CATLINK_LIST', 'Список ссылок по категориям');
//define('_AM_WEBLINKS_COMMAND_MANAGE', 'Command Management');
define('_AM_WEBLINKS_TABLE_MANAGE',  'Управление таблицами базы данных');
define('_AM_WEBLINKS_IMPORT_MANAGE', 'Управление импортом');
define('_AM_WEBLINKS_EXPORT_MANAGE', 'Управление экспортом');

// config
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_2','Аутентификация, категории, т.д.');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_3','Ссылки');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_4','RSS, форум, карта');
define('_AM_WEBLINKS_LINK_REGISTER','Настройки ссылки: Описание');

// bin configuration
//define('_AM_WEBLINKS_FORM_BIN', 'Command Config');
//define('_AM_WEBLINKS_FORM_BIN_DESC', 'It is used on bin command');
//define('_AM_WEBLINKS_CONF_BIN_PASS','Password');
//define('_AM_WEBLINKS_CONF_BIN_PASS_DESC','');
//define('_AM_WEBLINKS_CONF_BIN_SEND','Send Mail');
//define('_AM_WEBLINKS_CONF_BIN_SEND_DESC','');
//define('_AM_WEBLINKS_CONF_BIN_MAILTO','Email to send');
//define('_AM_WEBLINKS_CONF_BIN_MAILTO_DESC','');

// rssc
//define('_AM_WEBLINKS_RSS_DIRNAME','RSSC Module Dirname');
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

// google map: hacked by wye <http://never-ever.info/>
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
//define('_AM_WEBLINKS_CONF_TEMPLATE','Clear cache of Templates');
define('_AM_WEBLINKS_CONF_TEMPLATE_DESC','НЕОБХОДИМО выполнить, при изменении файлов шаблона в директориях template/parts/ template/xml/ и template/map/');

// === 2006-12-11 ===
// link item
//define('_AM_WEBLINKS_TIME_PUBLISH','Set the publication time');
//define('_AM_WEBLINKS_TIME_PUBLISH_DESC','If you do not check it, published time will become undated');
//define('_AM_WEBLINKS_TIME_EXPIRE','Set expiration time');
//define('_AM_WEBLINKS_TIME_EXPIRE_DESC','If you do not check it, expired setting will become undated');
define('_AM_WEBLINKS_LINK_TIME_PUBLISH_BEFORE','Список ссылок до времени публикации');
define('_AM_WEBLINKS_LINK_TIME_EXPIRE_AFTER',  'Список ссылок после истекшего времени');

define('_AM_WEBLINKS_SERVER_ENV','Серверная среда ');
define('_AM_WEBLINKS_DEBUG_CONF','Переменные отладки');
define('_AM_WEBLINKS_ALL_GREEN','Все зеленое');

// === 2007-02-20 ===
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
//define('_AM_WEBLINKS_FORUM_SEL', 'Select Forum module');
define('_AM_WEBLINKS_FORUM_THREAD_LIMIT', 'Количество показываемых тем');
define('_AM_WEBLINKS_FORUM_POST_LIMIT', 'Количество показываемых сообщений в каждой теме');
define('_AM_WEBLINKS_FORUM_POST_ORDER', 'Порядок сообщений');
define('_AM_WEBLINKS_FORUM_POST_ORDER_0', 'По дате старших сообщений');
define('_AM_WEBLINKS_FORUM_POST_ORDER_1', 'По дате новых сообщений');
//define('_AM_WEBLINKS_FORUM_INSTALLED',     'Forum module ( %s ) ver %s is installed');
//define('_AM_WEBLINKS_FORUM_NOT_INSTALLED', 'Forum module ( %s ) is not installed');

// === 2007-03-25 ===
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
//define('_AM_WEBLINKS_ALBUM_SEL', 'Select Album module');
define('_AM_WEBLINKS_ALBUM_LIMIT', 'Количество показываемых фотографий');
define('_AM_WEBLINKS_WHEN_OMIT', 'Процесс, когда пропускается');

define('_AM_WEBLINKS_MODULE_INSTALLED',     '%s модуль ( %s ) версии %s установлен');
define('_AM_WEBLINKS_MODULE_NOT_INSTALLED', '%s модуль ( %s ) не установлен');

// === 2007-04-08 ===
define('_AM_WEBLINKS_CAT_DESC_MODE',  'Показать описание');
define('_AM_WEBLINKS_CAT_SHOW_FORUM', 'Показать форум');
define('_AM_WEBLINKS_CAT_SHOW_ALBUM', 'Показать альбом');
define('_AM_WEBLINKS_MODE_SETTING',   'Настройка значения');
define('_AM_WEBLINKS_MODE_OMIT_PARENT', 'Такое же, как родительская категория, когда пропускается');

// === 2007-06-10 ===
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

// === 2007-07-14 ===
// highlight
define('_AM_WEBLINKS_USE_HIGHLIGHT', 'Использовать подсветку ключевых слов');
define('_AM_WEBLINKS_CHECK_MAIL', 'Проверять формат элекстронной почты');
define('_AM_WEBLINKS_CHECK_MAIL_DSC', 'НЕТ позволяется в любой форме. <br /> ДА проверяется, что адрес электронной почты в формате abc@efg.com, когда регистрируется ссылка. ');
//define('_AM_WEBLINKS_NO_EMAIL', 'Not Set Email Address');

// === 2007-08-01 ===
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

// === 2007-09-01 ===
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
define('_AM_WEBLINKS_USER_WAITING_NUM',   'Количество ссылок списка ожидания пользователя ');
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
define('_AM_WEBLINKS_LINK_IMG_THUMB_DSC', 'Показать миниатюру веб-сайта, а не ссылку на изображение, <br />используя веб-сервис миниатюр, <br />если не установлена ссылка на изображение.');
define('_AM_WEBLINKS_LINK_IMG_NON', 'нет');
//define('_AM_WEBLINKS_LINK_IMG_MOZSHOT', 'Use <a href="http://mozshot.nemui.org/" target="_blank">MozShot</a>');
//define('_AM_WEBLINKS_LINK_IMG_SIMPLEAPI', 'Use <a href="http://img.simpleapi.net/" target="_blank">SimpleAPI</a>');

// === 2007-11-01 ===
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

// === 2007-12-09 ===
define("_AM_WEBLINKS_D3FORUM_VIEW", "Тип вывода комментариев");

// === 2008-02-17 ===
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
// --- define language begin ---

?>