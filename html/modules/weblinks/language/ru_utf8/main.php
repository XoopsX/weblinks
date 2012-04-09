<?php
// $Id: main.php,v 1.1 2012/04/09 10:20:05 ohwada Exp $

// 2008-02-17 K.OHWADA
// pagerank, pagerank_update

// 2007-11-01 K.OHWADA
// _WEBLINKS_ERROR_LENGTH
// remove _WEBLINKS_INIT_NOT

// 2007-09-01 K.OHWADA
// waiting list
// change _WLS_NOTIFYAPPROVE

// 2007-08-01 K.OHWADA
// _WEBLINKS_GM_CURRENT_ADDRESS
// <br> => <br />

// 2007-04-08 K.OHWADA
// _WEBLINKS_GM_TYPE

// 2007-03-25 K.OHWADA
// _WEBLINKS_ALBUM_ID

// 2007-02-20 K.OHWADA
// forum

// 2007-01-20 K.OHWADA
// _WEBLINKS_CAT_AUX_TEXT_1

// 2006-12-11 K.OHWADA
// google map: googleGeocode
// _WEBLINKS_TIME_PUBLISH

// 2006-11-26 K.OHWADA
// google map: JP Geocode

// 2006-11-04 K.OHWADA
// google map: JP inverse Geocoder
// google map: inline mode

// 2006-10-01 K.OHWADA
// conflict with rssc
// add _WEBLINKS_RSSC_LID
// google map

// 2006-05-15 K.OHWADA
// weblinks ver 1.1
// _WEBLINKS_MID, etc

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// language main
// 2004-10-24 K.OHWADA
//=========================================================
// _LANGCODE: ru
// _CHARSET : utf-8
// Translator: Houston (Contour Design Studio http://www.cdesign.ru/)

// --- define language begin ---
if( !defined('WEBLINKS_LANG_MB_LOADED') ) 
{

define('WEBLINKS_LANG_MB_LOADED', 1);

//---------------------------------------------------------
// same as mylinks
//---------------------------------------------------------

//======	 singlelink.php	======
define("_WLS_CATEGORY","Категория");
define("_WLS_HITS","Посещения");
define("_WLS_RATING","Оценка");
define("_WLS_VOTE","Голос");
define("_WLS_ONEVOTE","1 голос");
define("_WLS_NUMVOTES","%s голосов");
define("_WLS_RATETHISSITE","Оценить этот сайт");
define("_WLS_REPORTBROKEN","Сообщить о неработающей ссылке");
define("_WLS_TELLAFRIEND","Рассказать друзьям");
define("_WLS_EDITTHISLINK","Редактировать эту ссылку");
define("_WLS_MODIFY","Изменить");

//======	submit.php	======
define("_WLS_SUBMITLINKHEAD","Отправить новую ссылку");
define("_WLS_SUBMITONCE","Отправляйте вашу ссылку только один раз.");
define("_WLS_DONTABUSE","Имя пользователя и IP записаны, поэтому, пожалуйста, не злоупотребляйте системой.");
define("_WLS_TAKESHOT","Мы приняли снимок экрана вашего веб-сайта и это может занять несколько дней для ссылки вашего веб-сайта, чтобы добавить его в нашу базу данных.");
define("_WLS_ALLPENDING","Отправленная ссылка зарегистрирована и будет опубликавана после проверки. ");
//define("_WLS_WHENAPPROVED","You'll receive an E-mail when it's approved.");
define("_WLS_RECEIVED","Мы получили информацию о своем веб-сайте. Спасибо!");

//======	modlink.php	======
define("_WLS_REQUESTMOD","Запрос изменения ссылки");
define("_WLS_THANKSFORINFO","Спасибо за информацию. Мы рассмотрим ваш запрос в ближайшее время.");


define("_WLS_THANKSFORHELP","Спасибо, что помогаете в построении каталога.");
define("_WLS_FORSECURITY","По соображениям безопасности ваше имя пользователя и IP адрес будут временно записаны.");

define("_WLS_SEARCHFOR","Поиск для"); //-no use
define("_WLS_ANY","ЛЮБОЙ");
define("_WLS_SEARCH","Поиск");

//define("_WLS_MAIN","Main");
define("_WLS_SUBMITLINK","Отправить ссылку");
define("_WLS_POPULAR","Популярный");
define("_WLS_TOPRATED","Лучшие");

define("_WLS_NEWTHISWEEK","Новые на этой неделе");
define("_WLS_UPTHISWEEK","Обновленные на этой неделе");

define("_WLS_POPULARITYLTOM","Популярность (От наименьших к наибольшим посещениям)");
define("_WLS_POPULARITYMTOL","Популярность (От наибольших к наименьшим посещениям)");
define("_WLS_TITLEATOZ","Заголовок (От А до Я)");
define("_WLS_TITLEZTOA","Заголовок (От Я до А)");
define("_WLS_DATEOLD","Дата (Старые ссылки показываются вначале)");
define("_WLS_DATENEW","Дата (Новые ссылки показываются вначале)");
define("_WLS_RATINGLTOH","Оценка (От наименьшей оценки к наибольшей оценке)");
define("_WLS_RATINGHTOL","Оценка (От наибольшей оценки к наименьшей оценке)");
	define("_WLS_TIMEPUBLISHNEW","Дата публикации (Старые ссылки показываются вначале)");
	define("_WLS_TIMEPUBLISHOLD","Дата публикации (Новые ссылки показываются вначале)");

//define("_WLS_NOSHOTS","No Screenshots Available");
//define("_WLS_DESCRIPTIONC","Description: ");
//define("_WLS_EMAILC","Email: ");
//define("_WLS_CATEGORYC","Category: ");
//define("_WLS_LASTUPDATEC","Last Update: ");
//define("_WLS_HITSC","Hits: ");
//define("_WLS_RATINGC","Rating: ");

define("_WLS_THEREARE","Имеется <b>%s</b> ссылок в нашей базе данных");
define("_WLS_LATESTLIST","Последние списки");

//define("_WLS_LINKID","Link ID: ");
//define("_WLS_SITETITLE","Website Title: ");
//define("_WLS_SITEURL","Website URL: ");
//define("_WLS_OPTIONS","Options: ");
define("_WLS_LINKID","ID ссылки");
define("_WLS_SITETITLE","Заголовок веб-сайта");
define("_WLS_SITEURL","Адрес веб-сайта");
define("_WLS_OPTIONS","Опции");

define("_WLS_NOTIFYAPPROVE", "Сообщите мне, когда эта ссылка будет утверждена или отклонена");
//define("_WLS_SHOTIMAGE","Screenshot Img: ");
define("_WLS_SENDREQUEST","Отправить запрос");

define("_WLS_VOTEAPPRE","Ваш голос оценен.");
define("_WLS_THANKURATE","Спасибо, что нашли время, чтобы оценить сайт здесь, в %s.");
define("_WLS_VOTEFROMYOU","Вклад пользователей, таких, как самого себя поможет другим посетителям лучше решить, какие ссылки выбрать.");
define("_WLS_VOTEONCE","Пожалуйста не голосуйте за один и тот же ресурс более одного раза.");
define("_WLS_RATINGSCALE","Оценка по 10-бальной системе. 1 - плохо, 10 - отлично.");
define("_WLS_BEOBJECTIVE","Пожалуйста, будьте объективны, если каждый будет указывать 1 или 10, то рейтинг не будет полезным.");
define("_WLS_DONOTVOTE","Пожалуйста не голосуйте за собственный ресурс.");
define("_WLS_RATEIT","Оценить!");

define("_WLS_INTRESTLINK","Интересная ссылка веб-сайта %s");  // %s is your site name
define("_WLS_INTLINKFOUND","Вот интересная ссылка веб-сайта, которую я нашел на %s");  // %s is your site name

define("_WLS_RANK","Важность");
define("_WLS_TOP10","%s Лучшие 10"); // %s is a link category title

define("_WLS_SEARCHRESULTS","Результаты поиска для <b>%s</b>:"); // %s is search keywords
define("_WLS_SORTBY","Сортировать по:");
define("_WLS_TITLE","Заголовок");
define("_WLS_DATE","Дата");
define("_WLS_POPULARITY","Популярность");
	define("_WLS_PUBLISHED","Дата публикации");
define("_WLS_CURSORTEDBY","Сайты сортируются по: %s");
define("_WLS_PREVIOUS","Предыдущая");
define("_WLS_NEXT","Следующая");
define("_WLS_NOMATCH","Не найдено соответствий Вашему запросу");

define("_WLS_SUBMIT","Отправить");
define("_WLS_CANCEL","Отменить");

define("_WLS_ALREADYREPORTED","Вы уже отправили доклад о неработающей ссылке этого ресурса.");
define("_WLS_MUSTREGFIRST","Извините, у вас нет разрешения на выполнение этого действия.<br />Пожалуйста, сначала зарегистрируйтесь или войти!");
define("_WLS_NORATING","Оценка не выбрана.");
define("_WLS_CANTVOTEOWN","Вы не можете голосовать за ресурс, который Вы отправили.<br />Все голоса записываются и рецензируются.");
define("_WLS_VOTEONCE2","Голосуйте за выбранный ресурс только один раз.<br />Все голоса записываются и рецензируются.");

//%%%%%%	Admin	  %%%%%

define("_WLS_WEBLINKSCONF","Конфигурация Веб-ссылок");
define("_WLS_GENERALSET","Общие настройки Веб-ссылок");
//define("_WLS_ADDMODDELETE","Add, Modify, and Delete Categories/Links");
define("_WLS_LINKSWAITING","Новые ссылки, ожидающие проверки");
define("_WLS_MODREQUESTS","Измененные ссылки, ожидающие проверки");
define("_WLS_BROKENREPORTS","Отчеты о неработающих ссылках");

//define("_WLS_SUBMITTER","Submitter: ");
define("_WLS_SUBMITTER","Отправитель");

define("_WLS_VISIT","Посетить");

//define("_WLS_SHOTMUST","Screenshot image must be a valid image file under %s directory (ex. shot.gif). Leave it blank if no image file.");
define("_WLS_LINKIMAGEMUST"," Enter link image fie name under %s directory. (e.g. shot.gif) Leave the field blank if there is no image file. ");

define("_WLS_APPROVE","Утвердить");
define("_WLS_DELETE","Удалить");
define("_WLS_NOSUBMITTED","Нет новых отправленных ссылок.");
define("_WLS_ADDMAIN","Добавить ГЛАВНУЮ категорию");
define("_WLS_TITLEC","Заголовок: ");
define("_WLS_IMGURL","Адрес изображения (НЕОБЯЗАТЕЛЬНО Высота изображения изменить до 50): ");
define("_WLS_ADD","Добавить");
define("_WLS_ADDSUB","Добавить подкатегорию");
define("_WLS_IN","в");
define("_WLS_ADDNEWLINK","Добавить новую ссылку");
define("_WLS_MODCAT","Изменить категорию");
define("_WLS_MODLINK","Изменить ссылку");
define("_WLS_TOTALVOTES","Голосов ссылки (всего голосов: %s)");
define("_WLS_USERTOTALVOTES","Голосов зарегистрированных пользователей (всего голосов: %s)");
define("_WLS_ANONTOTALVOTES","Голосов анонимных пользователей (всего голосов: %s)");
define("_WLS_USER","Пользователь");
define("_WLS_IP","IP-адрес");
define("_WLS_USERAVG","Средняя оценка пользователя");
define("_WLS_TOTALRATE","Всего оценок");
define("_WLS_NOREGVOTES","Нет голосов зарегистрированных пользователей");
define("_WLS_NOUNREGVOTES","Нет голосов незарегистрированных пользователей");
define("_WLS_VOTEDELETED","Данные голосования удалены.");
define("_WLS_NOBROKEN","Не сообщается о неработающих ссылках.");
define("_WLS_IGNOREDESC","Игнорировать (Игнорирует отчет и удаляет только <b>Отчет о неработающей ссылке</b>)");
define("_WLS_DELETEDESC","Удалить (Удаляет <b>сообщенные данные веб-сайта</b> и <b>Отчет о неработающей ссылке</b> для ссылки.)");
define("_WLS_REPORTER","Отправитель отчета");

define("_WLS_IGNORE","Отклонить");
define("_WLS_LINKDELETED","Ссылка удалена.");
define("_WLS_BROKENDELETED","Отчет о неработающей ссылке удален.");
//define("_WLS_USERMODREQ","User Link Modification Requests");
define("_WLS_ORIGINAL","Подлинная");
define("_WLS_PROPOSED","Предложенный");
define("_WLS_OWNER","Владелец");
define("_WLS_NOMODREQ","Нет запроса на изменение ссылки.");
define("_WLS_DBUPDATED","База данных обновлена успешно!");
define("_WLS_MODREQDELETED","Запрос на изменение удален.");
define("_WLS_IMGURLMAIN","Адрес изображения (НЕОБЯЗАТЕЛЬНО и действительно только для главных категорий. Высота изображения изменить до 50): ");
define("_WLS_PARENT","Родительская категория:");
define("_WLS_SAVE","Сохранить изменения");
define("_WLS_CATDELETED","Категория удалена.");
define("_WLS_WARNING","ПРЕДУПРЕЖДЕНИЕ: Вы уверены, что хотите удалить эту категорию и все ссылки и комментарии в ней?");
define("_WLS_YES","Да");
define("_WLS_NO","Нет");
define("_WLS_NEWCATADDED","Новая категория успешно добавлена!");
//define("_WLS_ERROREXIST","ERROR: The Link you provided is already in the database!");
//define("_WLS_ERRORTITLE","ERROR: You need to enter a TITLE!");
//define("_WLS_ERRORDESC","ERROR: You need to enter a DESCRIPTION!");
define("_WLS_NEWLINKADDED","Новая ссылка добавлена в базу данныхNew Link added to the Database.");
define("_WLS_YOURLINK","Ссылка вашего веб-сайта на %s");
define("_WLS_YOUCANBROWSE","Вы можете просмотреть наши веб-ссылки на %s");
define("_WLS_HELLO","Здравствуйте %s");
define("_WLS_WEAPPROVED","Мы утвердили отправленную вами ссылку в нашей базе данных веб-ссылок.");
define("_WLS_THANKSSUBMIT","Спасибо за ваше отправление!");
define("_WLS_ISAPPROVED","Мы утвердили отправленную вами ссылку");


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------

//======	index.php	======
// guidance bar
define("_WLS_SUBMIT_NEW_LINK","Отправить новую ссылку");
define("_WLS_SITE_POPULAR","Популярный сайт");
define("_WLS_SITE_HIGHRATE","Лучший сайт");
define("_WLS_SITE_NEW","Последний сайт");
define("_WLS_SITE_UPDATE","Обновленный сайт");

// corrected typo
define("_WLS_SITE_RECOMMEND","Рекомендованный сайт");

// BUG 3032: "mutual site" is not suitable English
define("_WLS_SITE_MUTUAL","Лучший сайт");

define("_WLS_SITE_RANDOM","Случайный сайт");
define("_WLS_NEW_SITELIST","Последний сайт");
define("_WLS_NEW_ATOMFEED","Последний RSS/ATOM канал");
define("_WLS_SITE_RSS","RSS/ATOM сайт");
define("_WLS_ATOMFEED","RSS/ATOM канал");

define("_WLS_LASTUPDATE","Последнее обновление");
define("_WLS_MORE","Подробнее");

//======	 singlelink.php	======
define("_WLS_DESCRIPTION","Описание");
define("_WLS_PROMOTER","Промоутер");
define("_WLS_ZIP","Почтовый индекс");
define("_WLS_ADDR","Адрес");
define("_WLS_TEL","Номер телефона");
define("_WLS_FAX","Номер факса");

//======	 submit.php	======
define("_WLS_BANNERURL","Адрес баннера");
define("_WLS_NAME","Имя");
define("_WLS_EMAIL","Электронная почта");
define("_WLS_COMPANY","Компания/Организация");
define("_WLS_STATE","Страна");
define("_WLS_CITY","Город");
define("_WLS_ADDR2","Адрес 2");
define("_WLS_PUBLIC","Опубликовать");
define("_WLS_NOTPUBLIC","Не опубликовывать");
define("_WLS_NOTSELECT","Не определено");
define("_WLS_SUBMIT_INDISPENSABLE","Пометка звездочкой '<b>*</b>' означает обязательный пункт.");
define("_WLS_SUBMIT_USER_COMMENT",'"Комментарий администратору" следует использовать для мнения, запроса и т.д.<br />Этот столбец не отображается на веб.<br />Пожалуйста, заполните адрес вашего сайта и как это связано с этим сайтом, если вы хотите пометить его как "Лучший сайт".');
define("_WLS_USER_COMMENT","Комментарий администратору");
define("_WLS_NOT_DISPLAY","Этот столбец не отображается на веб.");

//======	modlink.php	======
define("_WLS_MODIFYAPPROVED","Заявка изменения вашей ссылки была утверждена. ");
define("_WLS_MODIFY_NOT_OWNER","Пожалуйста, убедитесь, что вы человек, который представил подлинную ссылку.");
define("_WLS_MODIFY_PENDING","Изменения ссылки записано. Она будет опубликована после проверки.");
define("_WLS_LINKSUBMITTER","Отправитель ссылки");

//======	user.php	======
define('_WLS_PLEASEPASSWORD','Введите ваш пароль');
define('_WLS_REGSTERED','Зарегистрированный пользователь');
define('_WLS_REGSTERED_DSC','Кто угодно может изменить информацию ссылки. <br />Веб-мастер проверит изменения перед публикацией.');
define('_WLS_EMAILNOTFOUND',"Адрес электронной почты не соответствует.");


// error message
define("_WLS_ERROR_FILL", "Ошибка: Введите %s");
define("_WLS_ERROR_ILLEGAL","Ошибка: Неправильный формат %s");
define("_WLS_ERROR_CID",  "Ошибка: Выберите категорию");
define("_WLS_ERROR_URL_EXIST","Ошибка: Ссылка уже была зарегистрирована. ");
define("_WLS_WARNING_URL_EXIST","Предупреждение: Похожая ссылка уже была зарегистрирована. ");
define("_WLS_ERRORNOLINK","Ошибка: Не найдено такой ссылки");


define("_WLS_CATLIST","Список категорий");
define("_WLS_LINKIMAGE","Изображение ссылки: ");
//define("_WLS_USERID","User ID: ");
define("_WLS_CATEGORYID","ID категории: ");
//define("_WLS_CREATEC","Registration Date: ");
define("_WLS_TIMEUPDATE","Обновить");
define("_WLS_NOTTIMEUPDATE","Не обновлять");
define("_WLS_LINKFLAG","Создавать ссылки под этим ");
define("_WLS_NOTLINKFLAG","Не создавать ссылки под этим");
define("_WLS_GOTOADMIN","Перейти к странице администрирования");

// category delete
define("_WLS_DELCAT","Удалить категорию");
define("_WLS_SUBCATEGORY","Подкатегория");
define("_WLS_SUBCATEGORY_NON","Нет подкатегорий");
define("_WLS_LINK_BELONG","Связанные ссылки");
define("_WLS_LINK_BELONG_NUMBER","Количество связанных ссылок");
define("_WLS_LINK_BELONG_NON","Нет связанных ссылок");
define("_WLS_LINK_MAYBE_DELETE","Ссылки для удаления");
define("_WLS_LINK_MAYBE_DELETE_DSC","Результаты операции могут отличаться, если есть подкатегории. Некоторые другие ссылки могут быть удалены. ");
define("_WLS_LINK_DELETE_NON","Нет ссылок для удаления");
define("_WLS_CATEGORY_LINK_DELETE_EXCUTE","Удалить категорию и связанные ссылки");
define("_WLS_CATEGORY_LINK_DELETED","Категория и связанные ссылки были удалены.");
define("_WLS_CATEGORY_DELETED","Удаленные категории");
define("_WLS_LINK_DELETED","Удаленные ссылки");

define("_WLS_ERROR_CATEGORY","Ошибка: Категория не выбранаCategory is not selected");
define("_WLS_ERROR_MAX_SUBCAT","Ошибка: Количество выбранных категорий превышает максимум для удаления за один раз");
define("_WLS_ERROR_MAX_LINK_BELONG","Ошибка: Количество выбранных связанных ссылокпревышает максимум для удаления за один раз. ");
define("_WLS_ERROR_MAX_LINK_DEL","Ошибка: Количество выбранных ссылок превышает максимум  для удаления за один раз.");

// recommend site, mutual site
define("_WLS_MARK","пометка");
define("_WLS_ADMINCOMMENT","Комментарий администратора");

// broken link check
define("_WLS_BROKEN_COUNTER","Счетчик неработающих ссылок");

// RSS/ATOM URL
define("_WLS_RSS_URL","Адрес RSS/ATOM");
define("_WLS_RSS_URL_0","не использовать");
define("_WLS_RSS_URL_1","Тип RSS");
define("_WLS_RSS_URL_2","Тип ATOM");
define("_WLS_RSS_URL_3","автоматическое обнаружение");

define("_WLS_ATOMFEED_DISTRIBUTE","Распространенные RSS/ATOM каналы отображаются здесь.");
define("_WLS_ATOMFEED_FIREFOX","Если вы используете <a href='http://www.mozilla.org/products/firefox/' target='_blank'>Firefox</a>, сделайте закладку этой страницы, для просмотра вашего RSS/ATOM канала. ");

// 2005-10-20
define("_WLS_EMAIL_APPROVE","Оповестить, если утверждено");
define("_WLS_TOPTEN_TITLE","%s Лучшие %u");
// %s is a link category title
// %u is number of links
define("_WLS_TOPTEN_ERROR", "Слишком много верхних категорий. остановился, чтобы показать по %u");
// %u is munber of categories

// 2006-04-02
define('_WEBLINKS_MID', 'Изменить ID');
define('_WEBLINKS_USERID', 'ID пользователя');
define('_WEBLINKS_CREATE', 'Создано');

// conflict with rssc
//define('_HOME',  'Home');
//define('_SAVE',  'Save');
//define('_SAVED', 'Saved');
//define('_CREATE', 'Create');
//define('_CREATED','Created');
//define('_FINISH',   'Finish');
//define('_FINISHED', 'Finished');
//define('_EXECUTE', 'Execute');
//define('_EXECUTED','Executed');
//define('_PRINT','Print');
//define('_SAMPLE','Sample');

define('_NO_MATCH_RECORD','Нет соответствующей записи');
define('_MANY_MATCH_RECORD','Есть две или более соответсвующих записи');
define('_NO_CATEGORY', 'Нет категории');	
define('_NO_LINK', 'Нет ссылки');
define('_NO_TITLE', 'Нет заголовка');
define('_NO_URL', 'Нет адреса');
define('_NO_DESCRIPTION','Нет описания');

//define('_GOTO_MAIN',   'Go to Main');
//define('_GOTO_MODULE', 'Go to Module');

// config
//define('_WEBLINKS_INIT_NOT', 'The config table is not initialized');
//define('_WEBLINKS_INIT_EXEC', 'Config Table Initialized');
//define('_WEBLINKS_VERSION_NOT','This module is not version  %s yet. Update now');
//define('_WEBLINKS_UPGRADE_EXEC','Upgrade the config table');

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

// === 2006-10-01 ===
// conflict with rssc
//if( !defined('_SAVE') ) 
//{
//	define('_HOME',  'Home');
//	define('_SAVE',  'Save');
//	define('_SAVED', 'Saved');
//	define('_CREATE', 'Create');
//	define('_CREATED','Created');
//	define('_EXECUTE', 'Execute');
//	define('_EXECUTED','Executed');
//}

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

// google map: hacked by wye <http://never-ever.info/>
define('_WEBLINKS_GM_LATITUDE',  'Широта');
define('_WEBLINKS_GM_LONGITUDE', 'Долгота');
define('_WEBLINKS_GM_ZOOM',      'Уровень увеличения');
define('_WEBLINKS_GM_GET_LOCATION', 'Информация о местоположении, полученная с карт Google');
//define('_WEBLINKS_GM_GET_BUTTON', 'Get Latitude/Longitude/Zoom');
define('_WEBLINKS_GM_DEFAULT_LOCATION', 'Местоположение по умолчанию');
define('_WEBLINKS_GM_CURRENT_LOCATION', 'Текущее местоположение');

// === 2006-11-04 ===
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

// === 2006-12-11 ===
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

// === 2007-02-20 ===
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

// === 2007-03-25 ===
define('_WEBLINKS_ALBUM_ID',  'ID альбома');
define('_WEBLINKS_ALBUM_SEL', 'Выберите альбом');

// === 2007-04-08 ===
define('_WEBLINKS_GM_TYPE',  'Тип карты Google');
define('_WEBLINKS_GM_TYPE_MAP',       'Карта');
define('_WEBLINKS_GM_TYPE_SATELLITE', 'Спутник');
define('_WEBLINKS_GM_TYPE_HYBRID',    'Гибрид');

// === 2007-08-01 ===
define('_WEBLINKS_GM_CURRENT_ADDRESS', 'Текущий адрес');
define('_WEBLINKS_GM_SEARCH_LIST', 'Список результатов поиска');

// === 2007-09-01 ===
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

// === 2007-11-01 ===
define('_WEBLINKS_ERROR_LENGTH', "Ошибка: %s должно быть меньше, чем %s символов");

// === 2008-02-17 ===
// linkitem
define('_WEBLINKS_PAGERANK', 'Важность страницы');
define('_WEBLINKS_PAGERANK_UPDATE', 'Время обновления важности страницы');
define('_WEBLINKS_GM_KML_DEBUG', 'Отладка KML');

// gmap
define('_WEBLINKS_SITE_GMAP', 'Сайт карт Google');
define('_WEBLINKS_KML_LIST',  'Список KML');
define('_WEBLINKS_KML_LIST_DESC', 'Скачать KML и показать в Земле Google');
define('_WEBLINKS_KML_PERPAGE', 'Число разделителя');

// pagerank
define('_WEBLINKS_SITE_PAGERANK', 'Сайт с высокой важностью страницы');

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
// --- define language end ---
?>