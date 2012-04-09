<?php
// $Id: mailusers.php,v 1.1 2012/04/09 10:21:09 ohwada Exp $

//=========================================================
// WebLinks Module
// 2007-07-16 K.OHWADA
//=========================================================

//---------------------------------------------------------
// this file is for XC 2.1
// dont use this in XOOPS 2.0.x
// same as modules/system/language/english/admin/mailusers.php
//---------------------------------------------------------
// _LANGCODE: ru
// _CHARSET : utf-8
// Translator: Houston (Contour Design Studio http://www.cdesign.ru/)

//%%%%%%	Admin Module Name  MailUsers	%%%%%
define("_AM_DBUPDATED",_MD_AM_DBUPDATED);

//%%%%%%	mailusers.php 	%%%%%
define("_AM_SENDTOUSERS","Отправить сообщение пользователям, которые:");
define("_AM_SENDTOUSERS2","Отправить для:");
define("_AM_GROUPIS","Входят в группу (опционально)");
define("_AM_TIMEFORMAT", "(Формат гггг-мм-дд, опционально)");
define("_AM_LASTLOGMIN","Последний раз входили после");
define("_AM_LASTLOGMAX","Последний раз входили до");
define("_AM_REGDMIN","Зарегистрировались после");
define("_AM_REGDMAX","Зарегистрировались до");
define("_AM_IDLEMORE","Последний раз входили более чем X дней назад (опционально)");
define("_AM_IDLELESS","Последний раз входили менее чем X дней назад (опционально)");
define("_AM_MAILOK","Отправить сообщение только пользователям принимающим предупреждения (опционально)");
define("_AM_INACTIVE","Отправить сообщение только неактивным пользователям (опционально)");
define("_AMIFCHECKD", "Если это отмечено, то все вышеуказанное и личные сообщения будут игнорироваться");
define("_AM_MAILFNAME","От имени (только электронная почта)");
define("_AM_MAILFMAIL","От адреса электронной почты (только электронная почта)");
define("_AM_MAILSUBJECT","Тема");
define("_AM_MAILBODY","Сообщение");
define("_AM_MAILTAGS","Используемые теги:");
define("_AM_MAILTAGS1","{X_UID} будет отображен как ID пользователя");
define("_AM_MAILTAGS2","{X_UNAME} будет отображен как имя пользователя");
define("_AM_MAILTAGS3","{X_UEMAIL} будет отображен как электронная почта пользователя");
define("_AM_MAILTAGS4","{X_UACTLINK} будет отображен как ссылка на активацию пользователя");
define("_AM_SENDTO","Отправить для");
define("_AM_EMAIL","Электронная почта");
define("_AM_PM","Личное сообщение");
define("_AM_SENDMTOUSERS", "Отправка сообщений пользователям");
define("_AM_SENT", "Отправлено пользователям");
define("_AM_SENTNUM", "%s - %s (всего: %s пользователей)");
define("_AM_SENDNEXT", "Дальше");
define("_AM_NOUSERMATCH", "Нет подходящих пользователей");
define("_AM_SENDCOMP", "Отправка сообщений выполнена.");

?>