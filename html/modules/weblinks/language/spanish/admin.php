<?php
//=========================================================
// Módulo WebLinks
// Traducido por Kirby y Dynamic Noiser
// Octubre 2007
//=========================================================

// --- define language begin ---
if( !defined('WEBLINKS_LANG_AM_LOADED') ) 
{

define('WEBLINKS_LANG_AM_LOADED', 1);

define("_WEBLINKS_ADMIN_INDEX","Inicio de Administración");

// BUG 2931: unmatch popup menu 'preference' and index menu 'module setting'
define("_WEBLINKS_ADMIN_MODULE_CONFIG_1","Configurar módulo 1 (Preferencias)");

define("_WEBLINKS_ADMIN_MODULE_CONFIG_2","Configurar módulo 2");
//define("_WEBLINKS_ADMIN_ADDMODDEL_CATEGORY","Agregar, modificar, y borrar categorías");
define("_WEBLINKS_ADMIN_ADD_LINK","Agregar nuevo enlace");
define("_WEBLINKS_ADMIN_OTHERFUNC","Otras funciones");
define("_WEBLINKS_ADMIN_GOTO_ADMIN_INDEX","Ir a inicio de Administración");

//======	config.php 	======
// Permisos de acceso
define('_WEBLINKS_ADMIN_AUTH','Permisos');
define('_WEBLINKS_ADMIN_AUTH_TEXT', 'El administrador tiene toda la autoridad');
define('_WEBLINKS_AUTH_SUBMIT','Puede agregar un nuevo enlace');
define('_WEBLINKS_AUTH_SUBMIT_DSC','Especificar los grupos que pueden enviar un nuevo enlace');
define('_WEBLINKS_AUTH_SUBMIT_AUTO','Pueden automáticamente aprobar nuevos enlaces');
define('_WEBLINKS_AUTH_SUBMIT_AUTO_DSC','Especificar aquellos grupos cuyos enlaces serán aprobados automáticamente');
define('_WEBLINKS_AUTH_MODIFY','Pueden modificar');
define('_WEBLINKS_AUTH_MODIFY_DSC','Especificar aquellos grupos cuyas modificaciones de los enlaces serán aprobados automáticamente');
define('_WEBLINKS_AUTH_MODIFY_AUTO','Pueden aprobar modificaciones de los enlaces');
define('_WEBLINKS_AUTH_MODIFY_AUTO_DSC','Especificar aquellos grupos que pueden aprobar solicitudes de modificaciones de los enlaces');
define('_WEBLINKS_AUTH_RATELINK','Pueden calificar los enlaces');
define('_WEBLINKS_AUTH_RATELINK_DSC',"Especificar aquellos grupos que pueden calificar los enlaces.<br />");
define('_WEBLINKS_USE_PASSWD','Usar contraseña de autenticación cuando modifiques un enlace');
define('_WEBLINKS_USE_PASSWD_DSC','Mostrar campo de contraseña de autenticación cuando SI/YES esté seleccionado, <br />para los grupos que no esté permitido enviar/aprobar solicitudes de modificación. ');
define('_WEBLINKS_USE_RATELINK','Permitir calificaciones');
define('_WEBLINKS_USE_RATELINK_DSC',"SI/YES permite a los usuarios calificar los enlaces.");
define('_WEBLINKS_AUTH_UPDATED', 'Permissions Updated');


// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS','Ajustes de RSS/ATOM');
define('_WEBLINKS_RSS_MODE_AUTO','Actualización automática de RSS/ATOM');
define('_WEBLINKS_RSS_MODE_AUTO_DSC', "SI/YES realiza 'Descubrimiento automático de la dirección RSS/ATOM' y 'actualiza automáticamente' si los enlaces RSS/ATOM son incluidos en el formulario del enlace ");
define('_WEBLINKS_RSS_MODE_DATA','Datos de RSS/ATOM a mostrar');
define('_WEBLINKS_RSS_MODE_DATA_DSC', "ATOM FEED, utiliza los datos de la tabla tras hacer el análisis. <br />XML utiliza los datos desde la tabla de enlace antes del análisis. <br />Algunos datos pueden no ser grabado después del filtrado de tabla.");
define('_WEBLINKS_RSS_CACHE','Tiempo de cacheado de RSS/ATOM');
define('_WEBLINKS_RSS_CACHE_DSC', 'En horas.');
define('_WEBLINKS_RSS_LIMIT','Número máximo de RSS/ATOM');
define('_WEBLINKS_RSS_LIMIT_DSC', 'Entra el número máximo de RSS/ATOM que se grabarán en la tabla<br />Los datos antiguos se borrarán si se excede éste valor. <br />Cero se considera ilimitado. ');
define('_WEBLINKS_RSS_SITE','Búsqueda RSS');
define('_WEBLINKS_RSS_SITE_DSC',"Entra una lista de direcciones RSS en el sito de búsqueda RSS.<br />Separa cada entrada con una nueva línea cuando especifíques más de una. <br />No metas direcciones ATOM. ");
define('_WEBLINKS_RSS_BLACK','Lista negra de direcciones RSS/ATOM');
define('_WEBLINKS_RSS_BLACK_DSC','Entra una lista de direcciones que se rechazarán cuando colecten RSS/ATOM. <br />Separa cada entrada con una nueva línea cuando especifíques más de una.<br />Puedes usar expresiones regulares en lenguaje PERL. ');
define('_WEBLINKS_RSS_WHITE','Lista blanca de direcciones RSS/ATOM');
define('_WEBLINKS_RSS_WHITE_DSC','Entra una lista de direcciones a colectar cuando coincidan con entradas en la lista negra. <br />Separa cada entrada con una nueva línea cuando especifíques más de una. <br />Puedes usar expresiones regulares en lenguaje PERL. ');
define('_WEBLINKS_RSS_URL_CHECK', 'Hay algunas direcciones que están en la lista negra ');
define('_WEBLINKS_RSS_URL_CHECK_DSC', 'Por favor, copia y pega desde abajo de la lista blanca al formulario de registro si es necesario. ');
define('_WEBLINKS_RSS_UPDATED', 'Ajustes RSS/ATOM actualizados');


// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS_VIEW','Ver ajustes RSS/ATOM');
define('_WEBLINKS_RSS_MODE_TITLE','Usar etiquetas HTML en el título');
define('_WEBLINKS_RSS_MODE_TITLE_DSC', "SI/YES muestra etiquetas HTML en los enlaces del título, si el título tiene ésas etiquetas HTML. <br />NO desecha las etiquetas HTML del título. ");
define('_WEBLINKS_RSS_MODE_CONTENT','Usar etiquetas HTML en el contenido');
define('_WEBLINKS_RSS_MODE_CONTENT_DSC', "SI/YES muestra etiquetas HTML en los enlaces del comntenido, si el contenido tiene ésas etiquetas HTML <br />NO desecha las todas las etiquetas HTML del contenido mostrado. ");
define('_WEBLINKS_RSS_NEW','Selecciona el máximo número de "nuevos RSS/ATOM" mostrados en el tope de la página');
define('_WEBLINKS_RSS_NEW_DSC', 'Selecciona el máximo número de "nuevos RSS/ATOM" mostrados en la página principal.');
define('_WEBLINKS_RSS_PERPAGE','Selecciona el máximo número de "nuevos RSS/ATOM" mostrados en la página de detalles de los enlaces y en la página de RSS/ATOM');
define('_WEBLINKS_RSS_PERPAGE_DSC', 'Selecciona el máximo número de "nuevos RSS/ATOM" mostrados en la página RSS/ATOM. ');
define('_WEBLINKS_RSS_NUM_CONTENT','Número de enlaces que serán mostrados');
define('_WEBLINKS_RSS_NUM_CONTENT_DSC', 'Entra el número de enlaces que mostrarán contenido de los enlaces RSS/ATOM en los enlaces que contiene el detalle de la páginas. <br />Un sumario será mostrado en los enlaces remanentes. ');
define('_WEBLINKS_RSS_MAX_CONTENT','Máximo número de caracteres usados para el contenido de los enlaces RSS/ATOM');
define('_WEBLINKS_RSS_MAX_CONTENT_DSC', 'Máximo número de caracteres usados para el contenido de los enlaces RSS/ATOM enla página RSS/ATOM.  <br />Para se usados cuando esté activada la utilización de etiquetas HTML ');
define('_WEBLINKS_RSS_MAX_SUMMARY','Máximo número de caracteres usado para el sumario de RSS/ATOM');
define('_WEBLINKS_RSS_MAX_SUMMARY_DSC', 'Máximo número de caracteres usado para el sumario de RSS/ATOM en la página principal. ');


// use link field
define('_WEBLINKS_ADMIN_POST','Ajustes de los campos de enlaces');
define('_WEBLINKS_ADMIN_POST_TEXT_1', "	
No usar ésto significa que el campo no se mostrará en el formulario. ");
define('_WEBLINKS_ADMIN_POST_TEXT_2', "Usar ésto significa que el campo se mostrará en el formulario para permitir a quién lo rellena la opción de meter datos en él o no.");
define('_WEBLINKS_ADMIN_POST_TEXT_3', " Obligatorio usar el campo que debe ser rellenado.");
define('_WEBLINKS_NO_USE',"No usar");
define('_WEBLINKS_USE','Usar');
define('_WEBLINKS_INDISPENSABLE','Obligatorio');
define('_WEBLINKS_TYPE_DESC','Usar caja de texto XOOPS DHTML para envio de formulario');
define('_WEBLINKS_TYPE_DESC_DSC', 'NO usa una caja de texto normal.<br />SI/YES usa una caja de texto del tipo XOOPS DHTML para enviar el formulario. ');
define('_WEBLINKS_CHECK_DOUBLE','Aceptar envío de enlaces existentes');
define('_WEBLINKS_CHECK_DOUBLE_DSC', 'NO permite el registro de enlaces existente. <br /> SI/YES chequea si ya existe un enlace en la base de datos. ');
define('_WEBLINKS_POST_UPDATED', 'Ajustes de los campos de enlaces actualizados');

// categorías
define('_WEBLINKS_ADMIN_CAT_SET','Ajustes de categorías');
define('_WEBLINKS_CAT_SEL', 'Máximo número de categorías/subcategorías que pueden ser elegidas para incluir un enlace en ellas');
define('_WEBLINKS_CAT_SEL_DSC', 'Máximo número de categorías/subcategorías que pueden ser elegidas para categorizar un enlace en ellas');
define('_WEBLINKS_CAT_SUB','Núemro de subcategorías a mostrar');
define('_WEBLINKS_CAT_SUB_DSC','Ajusta el número de subcategorías mostradas en la lista de categorías en página principal');
define('_WEBLINKS_CAT_IMG_MODE','Selecciona una imagen para ésta categoría');
define('_WEBLINKS_CAT_IMG_MODE_DSC', 'NONE/NINGUNA no muestra imagen. <br />Folder.gif muestra una imagen de una carpeta. <br />Ajusta la imagen que se mostrará en cada categoría. ');
//define("_WEBLINKS_CAT_IMG_MODE_0","NONE/NINGUNA");
define("_WEBLINKS_CAT_IMG_MODE_1","folder.gif");
define("_WEBLINKS_CAT_IMG_MODE_2","Ajuste de imagen");
define('_WEBLINKS_CAT_IMG_WIDTH','Ancho máximmo para la imagen de categoría');
define('_WEBLINKS_CAT_IMG_HEIGHT','Alto máximmo para la imagen de categoría');
define('_WEBLINKS_CAT_IMG_SIZE_DSC','Usar cuando elija "Ajuste de imagen". ');
define('_WEBLINKS_CAT_UPDATED', 'Ajustes de categorías actualizados');


//======	category_list.php 	======
define("_WEBLINKS_ADMIN_CATEGORY_MANAGE","Manejo de categorías");
define("_WEBLINKS_ADMIN_CATEGORY_LIST","Listado de categorías");
//define("_WEBLINKS_ORDER_ID"," Enlaces listados por Identificador ID");
define("_WEBLINKS_ORDER_TREE"," Enlaces listados por árbol");
define("_WEBLINKS_CAT_ORDER","Orden de categorías");
define("_WEBLINKS_THERE_ARE_CATEGORY","Existen <b>%s</b> categorías en la base de datos");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_1","Haz click en el <b>Identificador ID de categoría</b> para editar una categoría específica. ");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_2","Haz click en la <b>categoría padre</b> ó <b>título</b>, para mostrar las categorías en orden. ");
define("_WEBLINKS_NO_CATEGORY","No existe la categoría correspondiente. ");
define("_WEBLINKS_NUM_SUBCAT","Número de subcategoría");
define('_WEBLINKS_ORDERS_UPDATED', 'Actualización de las categorías');

//======	category_manage.php 	======
define("_WEBLINKS_IMGURL_MAIN","Direccíon de la imagen para la categoría");
define("_WEBLINKS_IMGURL_MAIN_DSC1","Opcional. <br />Los tamaños de las imágenes se ajustarán automáticamente");
//define("_WEBLINKS_IMGURL_MAIN_DSC2","Las imágenes sólo se mostrarán para las categorías, no para las subcategorías. ");

//======	link_list.php 	======
define("_WEBLINKS_ADMIN_LINK_MANAGE","Manejo de enlaces");
define("_WEBLINKS_ADMIN_LINK_LIST","Listado de enlaces");
define("_WEBLINKS_ADMIN_LINK_BROKEN","Listado de enlaces que se deben reparar");
define("_WEBLINKS_ADMIN_LINK_ALL_ASC","Listado de todos los enlaces desde el más antiguo");
define("_WEBLINKS_ADMIN_LINK_ALL_DESC","Listado de todos los enlaces desde el más nuevo");
define("_WEBLINKS_ADMIN_LINK_NOURL","Listado de enlaces cuyas direcciones web aún no han sido insertadas");
define("_WEBLINKS_COUNT_BROKEN","Contador de enlaces que se deben reparar");
define("_WEBLINKS_NO_LINK","No existe el enlace. ");
define("_WEBLINKS_ADMIN_PRESENT_SAVE","Los datos grabados en la base de datos serán mostrados aquí.");

//======	link_manage.php 	======
//define("_WEBLINKS_USERID","Número de usuario");
//define("_WEBLINKS_CREATE","Creado");

//======	link_broken_check.php 	======
define("_WEBLINKS_ADMIN_LINK_CHECK_UPDATE","Chequear enlaces y actualizar");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK","Chequear enlaces para reparar");
define("_WEBLINKS_ADMIN_BROKEN_CHECK","Chequear");
define("_WEBLINKS_ADMIN_BROKEN_RESULT","Chequear resultados");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_CAUTION","Si hay muchos enlaces que se deben reparar, puede ocurrir que el servidor te devuelva un mensaje de error por una espera muy larga. <br />Si ésto sucede, cambia el valor numérico para limitar y compensar ésto. <br />Si el límite es igual a cero, no habrán restricciones en cuanto a cantidad.");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_NOTICE","Haciendo click <b>en el identificador ID del enlace</b> se abre una página que te permite modificarlo. <br /><b>La dirección de la página web</b> te llevará al sitio del enlace si haces click en él. <br />");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_GOOGLE","La búsqueda de Google se abrirá al hacer click en el <b>título de página web</b>. <br />");
define("_WEBLINKS_ADMIN_LIMIT","Máximo número de enlaces a chequear (límite)");
define("_WEBLINKS_ADMIN_OFFSET","Compensación");
define("_WEBLINKS_ADMIN_CHECK","Chequeo");
define("_WEBLINKS_ADMIN_TIME_START","Tiempo de inicio");
define("_WEBLINKS_ADMIN_TIME_END","Tiempo de finalización");
define("_WEBLINKS_ADMIN_TIME_ELAPSE","Tiempo transcurrido");
define("_WEBLINKS_ADMIN_LINK_NUM_ALL","Todos los enlaces");
define("_WEBLINKS_ADMIN_LINK_NUM_CHECK","Enlaces chequeados");
define("_WEBLINKS_ADMIN_LINK_NUM_BROKEN","Enlaces a reparar");
define("_WEBLINKS_ADMIN_NUM","enlaces");
define("_WEBLINKS_ADMIN_MIN_SEC","%s min %s seg");
define("_WEBLINKS_ADMIN_CHECK_NEXT","Chequear los próximos %s enlaces");
//define("_WEBLINKS_ADMIN_RSS_REFRESH_NOTE","Simultáneamente ejecutar el descubrimiento automático de direcciones RSS/ATOM");

//======	rss_manage.php 	======
define("_WEBLINKS_ADMIN_RSS_MANAGE","Manejo de RSS/ATOM");
define("_WEBLINKS_ADMIN_RSS_REFRESH","Actualizar RSS/ATOM");
define("_WEBLINKS_ADMIN_RSS_REFRESH_LINK","Actualizar datos del enlace del enlace que están en caché ");
define("_WEBLINKS_ADMIN_RSS_REFRESH_SITE","Actualizar búsquedas RSS");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_URL","Número de direcciones web RSS/ATOM que han sido actualizadas");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_SITE","Número de sitios RSS que han sido actualizados");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOM_SITE","Número de sitios ATOM que han sido actualizados");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOMFEED","Número de semillas ATOM que han sido actualizadas");
define("_WEBLINKS_ADMIN_RSS_CACHE_CLEAR","Limpiar caché de RSS/ATOM");
define("_WEBLINKS_RSS_CLEAR_NUM","Limpiar caché de RSS/ATOM por fecha, si es mayor del número especificado en el módulo de configuración 1.");
define("_WEBLINKS_RSS_NUMBER","Número de RSS");
define("_WEBLINKS_RSS_CLEAR_LID","Limpiar caché de las ID especificadas");
define("_WEBLINKS_RSS_CLEAR_ALL","Borrar toda la caché");
define("_WEBLINKS_NUM_RSS_CLEAR_LINK","Número de enlaces RSS/ATOM en la caché que han sido limpiados");
define("_WEBLINKS_NUM_RSS_CLEAR_ATOMFEED","Número de semillas RSS/ATOM en la caché que han sido limpiados");

//======	user_list.php 	======
define("_WEBLINKS_ADMIN_USER_MANAGE", "Manejo de usuarios");
define("_WEBLINKS_ADMIN_USER_EMAIL", "Listado de usuarios con e-mail");
define("_WEBLINKS_ADMIN_USER_LINK", "Listado de usuarios registrados con información de enlace");
define("_WEBLINKS_ADMIN_USER_NOLINK", "Listado de usuarios registrados sin información de enlace");
define("_WEBLINKS_ADMIN_USER_EMAIL_DSC", "Mostrar sólo un e-mail si está duplicado");
//define("_WEBLINKS_ADMIN_USER_LINK_DSC", 'Usar "Enviar Mensaje a Usuarios" del núcleo de  XOOPS');
//define("_WEBLINKS_USER_ALL", " Todos ");
//define("_WEBLINKS_USER_MAX", " cada %s usuarios ");
define("_WEBLINKS_THERE_ARE_USER", "<b>%s</b> usuarios encontrados");
define("_WEBLINKS_USER_NUM", "Mostrar desde el %s usuario al %s de usuario.");
define("_WEBLINKS_USER_NOFOUND", "Usuarios no encontrados");
define("_WEBLINKS_UID_EMAIL", "E-mail de quién envía");

//======	mail_users.php 	======
define("_WEBLINKS_ADMIN_SENDMAIL", "Enviar e-mail");
define("_WEBLINKS_THERE_ARE_EMAIL","Hay <b>%s</b> e-mails");
define("_WEBLINKS_SEND_NUM", "Enviar e-mail desde %s al usuario %s al usuario");
//define("_WEBLINKS_SEND_NEXT","Enviar los próximos %s e-mails");
//define("_WEBLINKS_SUBJECT_FROM", "Informacion desde %s");
//define("_WEBLINKS_HELLO", "Hola %s");
define("_WEBLINKS_MAIL_TAGS1","{W_NAME} puedes imprimir el nombre de usuario");
define("_WEBLINKS_MAIL_TAGS2","{W_EMAIL} puedes imprimir el e-mail del usuario");
define("_WEBLINKS_MAIL_TAGS3","{W_LID} puedes imprimir el número de usuario");

// general
define('_WEBLINKS_WEBMASTER', 'Webmaster');
define('_WEBLINKS_SUBMITTER', 'Enviado por');
//define("_WEBLINKS_MID","Modificar ID");
define("_WEBLINKS_UPDATE","Actualizar");
define("_WEBLINKS_SET_DEFAULT","Ajustar a valores de fábrica");
define("_WEBLINKS_CLEAR","Borrar");
define("_WEBLINKS_CHECK","Chequear");
define("_WEBLINKS_NON","No hay nada que hacer");
define("_WEBLINKS_SENDMAIL", "Enviar e-Mail");

// 2005-08-09
// BUG 2827: RSS refresh: Invalid argument supplied for foreach()
define("_WEBLINKS_ADMIN_NO_LINK_BROKEN_CHECK","No hay enlace para chequear");
define("_WEBLINKS_ADMIN_NO_RSS_REFRESH","No hay enlace para actualizar RSS");

// 2005-10-20
define("_WEBLINKS_LINK_APPROVED", "[{X_SITENAME}] {X_MODULE}: El enlace ha sido aprobado");
define("_WEBLINKS_LINK_REFUSED",  "[{X_SITENAME}] {X_MODULE}: El enlace ha sido rechazado");

// 2006-05-15
define('_AM_WEBLINKS_INDEX_DESC','Texto de introducción en página principal');
define('_AM_WEBLINKS_INDEX_DESC_DSC', 'Puedes utilizar ésta sección para mostrar texto descriptivo. HTML permitido.');
define('_AM_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Aquí va tu página de introducción.<br />Puedes editarlo en el "Módulo de configuración 2".<br /></div>');

define('_AM_WEBLINKS_ADD_CATEGORY', 'Agrega una nueva categoría');
define('_AM_WEBLINKS_ERROR_SOME', 'Hay mensajes de error');
define('_AM_WEBLINKS_LIST_ID_ASC',  'Listado desde el más antiguo');
define('_AM_WEBLINKS_LIST_ID_DESC', 'Listado desde el más nuevo');

// config
define('_AM_WEBLINKS_WARNING_NOT_WRITABLE','El directorio no se puede escribir.');
define('_AM_WEBLINKS_CONF_LINK','Configuración de enlace');
define('_AM_WEBLINKS_CONF_LINK_IMAGE','Configuración de las imágenes del enlace');
define('_AM_WEBLINKS_CONF_VIEW','Ver configuración');
define('_AM_WEBLINKS_CONF_TOPTEN','Configuración del Top Ten');
define('_AM_WEBLINKS_CONF_SEARCH','Configuración de la búsqueda');

define('_AM_WEBLINKS_USE_BROKENLINK','Reportar enlaces a reparar');
define('_AM_WEBLINKS_USE_BROKENLINK_DSC','SI/YES permite a los usuario reportar cualquier enlace que contenga errores');
define('_AM_WEBLINKS_USE_HITS','Contabilizar visita cuando visiten el sitio del enlace');
define('_AM_WEBLINKS_USE_HITS_DSC','SI/YES activa el contador de visitas cuando visiten el enlace');
define('_AM_WEBLINKS_USE_PASSWD','Autentificación por contraseña');
define('_AM_WEBLINKS_USE_PASSWD_DSC','SI/YES, <b>usuario anónimo</b> puede modificar un enlace con autentificación de contraseña.<br />NO, <br />ocultará los campos de la contraseña.');
define('_AM_WEBLINKS_PASSWD_MIN','Longitud mínima de la contraseña');
define('_AM_WEBLINKS_POST_TEXT', 'El administrador tiene toda la autoridad');
define('_AM_WEBLINKS_AUTH_DOHTML', 'Permiso para utilizar etiquetas HTML');
define('_AM_WEBLINKS_AUTH_DOHTML_DSC', 'Especificar que grupos pueden utilizar etiquetas HTML');
define('_AM_WEBLINKS_AUTH_DOSMILEY', 'Permiso para utilizar iconos gestuales');
define('_AM_WEBLINKS_AUTH_DOSMILEY_DSC', 'Especificar que grupos pueden utilizar iconos gestuales');
define('_AM_WEBLINKS_AUTH_DOXCODE', 'Permiso para utilizar códigos de XOOPS');
define('_AM_WEBLINKS_AUTH_DOXCODE_DSC', 'Especificar que grupos pueden utilizar códigos de XOOPS');
define('_AM_WEBLINKS_AUTH_DOIMAGE', 'Permiso para utilizar imágenes');
define('_AM_WEBLINKS_AUTH_DOIMAGE_DSC', 'Especificar que grupos pueden utilizar images');
define('_AM_WEBLINKS_AUTH_DOBR', 'Permiso para utilizar líneas');
define('_AM_WEBLINKS_AUTH_DOBR_DSC', 'Especificar que grupos pueden utilizar líneas');
define('_AM_WEBLINKS_SHOW_CATLIST','Mostrar listado de categorías en submenú');
define('_AM_WEBLINKS_SHOW_CATLIST_DSC','SI/YES muestra listado de categorías en submenú');
define('_AM_WEBLINKS_VIEW_URL','Ver estilo de web');
define('_AM_WEBLINKS_VIEW_URL_DSC','NONE <br />no hay web ó se mostrará etiqueta.<br />Indirectamente<br /> se mostrará visit.php en el campo de referencia de la web. <br />Directamente <br />se mostrará la dirección web del enlace en el campo de referencia, usando el ratón hacia abajo y haciendo click en él, será contabilizado via JavaScript.');
define('_AM_WEBLINKS_VIEW_URL_0','NONE');
define('_AM_WEBLINKS_VIEW_URL_1','Dirección web indirecta');
define('_AM_WEBLINKS_VIEW_URL_2','Dirección web directa');
define('_AM_WEBLINKS_RECOMMEND_PRI','Prioridad de los sitios recomendados');
define('_AM_WEBLINKS_RECOMMEND_PRI_DSC','NONE <br />No se muestran.<br />NORMAL <br />Sitios recomendados se mostrarán en la cabecera.<br />ALTA <br />Sitios recomendados se mostrarán en la primera posición de cada categoría.');
define('_AM_WEBLINKS_MUTUAL_PRI','Prioridad de los sitios asociados');
define('_AM_WEBLINKS_MUTUAL_PRI_DSC','NONE <br />No se muestran.<br />NORMAL <br />Sitios asociados se mostrarán en la cabecera.<br />ALTA <br />Sitios asociadose mostrarán en la primera posición de cada categoría.');
define('_AM_WEBLINKS_PRI_0','NONE');
define('_AM_WEBLINKS_PRI_1','NORMAL');
define('_AM_WEBLINKS_PRI_2','ALTA');
define('_AM_WEBLINKS_LINK_IMAGE_AUTO','Actualizar automáticamente tamaño de la imagen del banner.');
define('_AM_WEBLINKS_LINK_IMAGE_AUTO_DSC', "SI/YES <br />Actualizar automáticamente tamaño de la imagen del banner.");
define('_AM_WEBLINKS_RSS_USE','Usar semilla RSS');
define('_AM_WEBLINKS_RSS_USE_DSC','SI/YES <br />Tomar y mostrar semilla RSS/ATOM.');

// bulk import
define('_AM_WEBLINKS_BULK_IMPORT','Importación por bloque');
define('_AM_WEBLINKS_BULK_IMPORT_FILE','Importación por bloque de cada archivo');
define('_AM_WEBLINKS_BULK_CAT','Importación por bloque de las categorías');
define('_AM_WEBLINKS_BULK_CAT_DSC1','Describir categorías');
define('_AM_WEBLINKS_BULK_CAT_DSC2','Usar una flecha entre paréntesis(>) al comienzo de la categoría para definir una categoría cómo subcategoría.');
define('_AM_WEBLINKS_BULK_LINK','Importación por bloque de los enlaces');
define('_AM_WEBLINKS_BULK_LINK_DSC1', 'Introduce una categoría en la primera línea.');
define('_AM_WEBLINKS_BULK_LINK_DSC2', 'Describe título del enlace, dirección web, y una explicación dividad por comas(,) en la segunda línea.');
define('_AM_WEBLINKS_BULK_LINK_DSC3', 'Usar guiones para separar cómo una barra horizontal (---) .');
define('_AM_WEBLINKS_BULK_ERROR_LAYER','Especifica dos o más capas bajo la categoría en la estructura. Esto necesita clarificación G.S.');
define('_AM_WEBLINKS_BULK_ERROR_CID','Error de ID de la categoría');
define('_AM_WEBLINKS_BULK_ERROR_PID','Error de ID de la categoría padre');
define('_AM_WEBLINKS_BULK_ERROR_FINISH','Un error ha detenido la operación');

// command
define('_AM_WEBLINKS_CREATE_CONFIG', 'Crear arcTest execute forión');
define('_AM_WEBLINKS_TEST_EXEC', 'Ejecutar test para %s');

// === 2006-10-05 ===
// menu
define('_AM_WEBLINKS_MODULE_CONFIG_3','Configuración del Módulo 3');
define('_AM_WEBLINKS_MODULE_CONFIG_4','Configuración del Módulo 4');
define('_AM_WEBLINKS_VOTE_LIST', 'Listado de votos');
define('_AM_WEBLINKS_CATLINK_LIST', 'Listado de enlaces por categorías');
define('_AM_WEBLINKS_COMMAND_MANAGE', 'Gestión de comandos');
define('_AM_WEBLINKS_TABLE_MANAGE',  'Gestión de tablas de la base de datos');
define('_AM_WEBLINKS_IMPORT_MANAGE', 'Gestión de importación');
define('_AM_WEBLINKS_EXPORT_MANAGE', 'Gestión de exportación');

// config
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_2','Autorizar, Categorías, etc');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_3','Enlace');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_4','RSS, Foro, Mapa');
define('_AM_WEBLINKS_LINK_REGISTER','Ajustes de enlace: Descripción');

// bin configuration
define('_AM_WEBLINKS_FORM_BIN', 'Configuración de comandos');
define('_AM_WEBLINKS_FORM_BIN_DESC', 'Es utilizado en comando binario');
define('_AM_WEBLINKS_CONF_BIN_PASS','Contraseña');
//define('_AM_WEBLINKS_CONF_BIN_PASS_DESC','Contraseña');
define('_AM_WEBLINKS_CONF_BIN_SEND','Enviar e-mail');
//define('_AM_WEBLINKS_CONF_BIN_SEND_DESC','Enviar e-mail desde el más antiguo');
define('_AM_WEBLINKS_CONF_BIN_MAILTO','Email para enviar');
//define('_AM_WEBLINKS_CONF_BIN_MAILTO_DESC','Email para enviar desde el más antiguo');

// rssc
//define('_AM_WEBLINKS_RSS_DIRNAME','Nombre del directorio del módulo RSSC');
//define('_AM_WEBLINKS_RSS_DIRNAME_DESC','Nombre del directorio del módulo RSSC desde el más antiguo');

// link manage
define('_AM_WEBLINKS_DEL_LINK', 'Borrar enlace');
define('_AM_WEBLINKS_ADD_RSSC', 'Agregar enlace en el módulo RSSC');
define('_AM_WEBLINKS_MOD_RSSC', 'Modificar enlace en el módulo RSSC');
define('_AM_WEBLINKS_REFRESH_RSSC', 'Actualizar enlace en el módulo RSSC');
define('_AM_WEBLINKS_APPROVE',     'Aprobar nuevo enlace');
define('_AM_WEBLINKS_APPROVE_MOD', 'Aprobar solicitud de modificación de nuevo enlace');
define('_AM_WEBLINKS_RSSC_LID_SAVED', 'Grabar RSSC lid');
define('_AM_WEBLINKS_GOTO_LINK_LIST', 'Volver a listado de enlaces');
define('_AM_WEBLINKS_GOTO_LINK_EDIT', 'Volver a edición de enlace');
define('_AM_WEBLINKS_ADD_BANNER', 'Agregar tamaño de imagen del banner');
define('_AM_WEBLINKS_MOD_BANNER', 'Modificar tamaño de imagen del banner');

// vote list
define('_AM_WEBLINKS_VOTE_USER', 'Votos de usuarios registrados');
define('_AM_WEBLINKS_VOTE_ANON', 'Votos de usuarios anónimos');

// locate
define('_AM_WEBLINKS_CONF_LOCATE','Configuración de localización');
define('_AM_WEBLINKS_CONF_COUNTRY_CODE','Código de País');
define('_AM_WEBLINKS_CONF_COUNTRY_CODE_DESC', 'Introduce el código ccTLDs <br/> <a href="http://www.iana.org/cctld/cctld-whois.htm" target="_blank">IANA: Aquí encontrarás ése código ccTLDs. En el caso de España, el código es el (punto).es</a>');
define('_AM_WEBLINKS_CONF_RENEW_COUNTRY_CODE_DESC', ' 	
Actualizar el tema que se relaciona con el código de país. <br/> El tema con <span style="color:#0000ff;">#</span> mark');
define('_AM_WEBLINKS_RENEW', 'Renovar');

// map
define('_AM_WEBLINKS_CONF_MAP','Configuración de mapa en el sitio');
define('_AM_WEBLINKS_CONF_MAP_USE','Usar mapa en el sitio');
define('_AM_WEBLINKS_CONF_MAP_TEMPLATE','Plantilla del mapa de sitio');
define('_AM_WEBLINKS_CONF_MAP_TEMPLATE_DESC','Introduce la plantilla del mapa de sitio por FTP en template/map/ directory');

// google map: hacked by wye <http://never-ever.info/>
define('_AM_WEBLINKS_CONF_GOOGLE_MAP','Configuración de mapas de Google');
define('_AM_WEBLINKS_CONF_GM_USE','Usar mapas de Google');
define('_AM_WEBLINKS_CONF_GM_APIKEY','Introduce la llave API de los mapas de Google');
define('_AM_WEBLINKS_CONF_GM_APIKEY_DESC', 'Consigue la llave API en <br/> <a href="http://www.google.com/apis/maps/signup.html" target="_blank">La cerajerría API de Google :D</a> <br/> cuando uses los mapas de Google' );
define('_AM_WEBLINKS_CONF_GM_SERVER','Nombre del servidor');
define('_AM_WEBLINKS_CONF_GM_LANG',  'Código de lenguaje');
define('_AM_WEBLINKS_CONF_GM_LOCATION', 'Localización por defecto');
define('_AM_WEBLINKS_CONF_GM_LATITUDE', 'Latitud por defecto');
define('_AM_WEBLINKS_CONF_GM_LONGITUDE','Longitud por defecto');
define('_AM_WEBLINKS_CONF_GM_ZOOM',     'Nivel de Zoom por defecto');

// google search
define('_AM_WEBLINKS_CONF_GOOGLE_SEARCH','Confirmación de la búsqueda de Google');
define('_AM_WEBLINKS_CONF_GOOGLE_SERVER','Nombre del servidor');
define('_AM_WEBLINKS_CONF_GOOGLE_LANG',  'Código de lenguaje');

// template
define('_AM_WEBLINKS_CONF_TEMPLATE','Limpiar caché de plantillas');
define('_AM_WEBLINKS_CONF_TEMPLATE_DESC','DEBES ejecutar ésto cuando hayas cambiado algo en los archivos de plantillas que están en los directorios template/parts/ template/xml/ y template/map/');

// === 2006-12-11 ===
// link item
//define('_AM_WEBLINKS_TIME_PUBLISH','Ajusta la fecha de publicación');
//define('_AM_WEBLINKS_TIME_PUBLISH_DESC','Si no marcas ésto, la publicación aparecerá sin fecha de inicio');
//define('_AM_WEBLINKS_TIME_EXPIRE','Ajusta la fecha de finalización');
//define('_AM_WEBLINKS_TIME_EXPIRE_DESC','Si no marcas ésto, la publicación aparecerá sin fecha de finalización');
define('_AM_WEBLINKS_LINK_TIME_PUBLISH_BEFORE','Listado de enlaces antes de ser publicados');
define('_AM_WEBLINKS_LINK_TIME_EXPIRE_AFTER',  'Listado de enlaces después de que hayan finalizado');

define('_AM_WEBLINKS_SERVER_ENV','Variables del servidor ');
define('_AM_WEBLINKS_DEBUG_CONF','Depurar variables');
define('_AM_WEBLINKS_ALL_GREEN','Todo es correcto');

// === 2007-02-20 ===
// performance
define('_AM_WEBLINKS_UPDATE_CAT_PATH','Actualizar la ruta del árbol de categorías');
define('_AM_WEBLINKS_UPDATE_CAT_COUNT','Actualización de la categoría de enlaces');
define('_AM_WEBLINKS_CAT_COUNT_UPDATED','Ruta del árbol de categorías actualizada');

// config
define('_AM_WEBLINKS_SYSTEM_POST_LINK','Contabilizar cuando envien enlaces');
define('_AM_WEBLINKS_SYSTEM_POST_LINK_DSC','SI/YES contabiliza al usuario cada vez que envía un enlace. ');
define('_AM_WEBLINKS_SYSTEM_POST_RATE','Contabilizar cuando califiquen enlaces');
define('_AM_WEBLINKS_SYSTEM_POST_RATE_DSC','SI/YES contabiliza al usuario cada vez que califica un enlace');

define('_AM_WEBLINKS_VIEW_STYLE_CAT','Ver estilo en cada categoría');
define('_AM_WEBLINKS_VIEW_STYLE_MARK','Ver estilo en cada sitio recomendado');
define('_AM_WEBLINKS_VIEW_STYLE_MARK_DSC','Si se aplica en cada sitio recomendado, asociado ó RSS/ATOM');
define('_AM_WEBLINKS_VIEW_STYLE_0','Sumario');
define('_AM_WEBLINKS_VIEW_STYLE_1','Todos los detalles');

define('_AM_WEBLINKS_CONF_PERFORMANCE','Mejoras del rendimiento');
define('_AM_WEBLINKS_CONF_PERFORMANCE_DSC','Debido a la mejora del rendimiento, que calcula los datos necesarios de antemano cuando se demuestre, y almacena en la base de datos.<br />Cuando se use por primera vez, ejecuta "listado de categorías/category list" -> "Actualizar la ruta del árbol de categorías/Update category path tree"');
define('_AM_WEBLINKS_CAT_PATH','Ruta del árbol de categorías');
define('_AM_WEBLINKS_CAT_PATH_DSC','SI/YES calcula la ruta del árbol de categorías y la almacena en la tabla de categorías.<br />NO las calcula mientras se muestran.');
define('_AM_WEBLINKS_CAT_COUNT','Contabilizar categorías de enlace');
define('_AM_WEBLINKS_CAT_COUNT_DSC','SIYES calcula y contabiliza las categorías de enlace y las almacena en la tabla de categorías.<br />NO las calcula mientras se muestran.');

define('_AM_WEBLINKS_POST_TEXT_4', 'Todos los temas se muestran en la página de administración');
define('_AM_WEBLINKS_LINK_REGISTER_1','Ajustes de enlace: Area de texto 1');

define('_AM_WEBLINKS_CONF_LINK_GUEST','Configuración del registro de enlace');
define('_AM_WEBLINKS_USE_CAPTCHA','Usar CAPTCHA');
define('_AM_WEBLINKS_USE_CAPTCHA_DSC','CAPTCHA Es una técnica para evitar el acceso público no deseado, robots, spammers y otros relacionados.<br />Esta característica requiere que tengas instalado el módulo CAPTCHA.<br />SI/YES, <b>usuario anónimo</b> debe usar CAPTCHA cuando agregue o modifique un enlace.<br />NO oculta el campo requerido para el módulo CAPTCHA.');
define('_AM_WEBLINKS_CAPTCHA_FINDED',     'Módulo CAPTCHA versión %s está instalado');
define('_AM_WEBLINKS_CAPTCHA_NOT_FINDED', 'Módulo CAPTCHA no está instalado');

define('_AM_WEBLINKS_CONF_SUBMIT', 'Descripción del formulario de registro del enlace');
define('_AM_WEBLINKS_SUBMIT_MAIN',    'Descripción para añadir nuevo enlace: 1');
define('_AM_WEBLINKS_SUBMIT_PENDING', 'Descripción para añadir nuevo enlace: 2');
define('_AM_WEBLINKS_SUBMIT_DOUBLE',  'Descripción para añadir nuevo enlace: 3');
define('_AM_WEBLINKS_SUBMIT_MAIN_DSC',   'Mostrar siempre');
define('_AM_WEBLINKS_SUBMIT_PENDING_DSC','Mostrar cuando "necesita ser aprobado por el administrador/supervisor" ');
define('_AM_WEBLINKS_SUBMIT_DOUBLE_DSC', 'Mostrar cuando "exista el enlace" ');

define('_AM_WEBLINKS_MODLINK_MAIN',     'Descrición del enlace modificado: 1');
define('_AM_WEBLINKS_MODLINK_PENDING',  'Descrición del enlace modificado: 2');
define('_AM_WEBLINKS_MODLINK_NOT_OWNER','Descrición del enlace modificado: 3');
define('_AM_WEBLINKS_MODLINK_NOT_OWNER_DSC','Mostrar cuando "necesita ser aprobado por el administrador/supervisor" y no eres quién envió éste enlace');

define('_AM_WEBLINKS_CONF_CAT_FORUM', 'Ver Foro en categoría');
define('_AM_WEBLINKS_CONF_LINK_FORUM', 'Ver Foro en enlace');
//define('_AM_WEBLINKS_FORUM_SEL', 'Selecciona módulo para el foro');
define('_AM_WEBLINKS_FORUM_THREAD_LIMIT', 'Número de hilos mostrados');
define('_AM_WEBLINKS_FORUM_POST_LIMIT', 'Número de opiniones por cada hilo');
define('_AM_WEBLINKS_FORUM_POST_ORDER', 'Orden de las opiniones');
define('_AM_WEBLINKS_FORUM_POST_ORDER_0', 'Opiniones más antiguas');
define('_AM_WEBLINKS_FORUM_POST_ORDER_1', 'Opiniones más nuevas');
//define('_AM_WEBLINKS_FORUM_INSTALLED',     'Módulo de foro ( %s ) versión %s está instalada');
//define('_AM_WEBLINKS_FORUM_NOT_INSTALLED', 'Módulo de foro no está instalado');

// === 2007-03-25 ===
define('_AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE','Actualizar tamaño de imagen de categoría');

define('_AM_WEBLINKS_CONF_INDEX', 'Configuración de página de inicio');
define('_AM_WEBLINKS_CONF_INDEX_GM_MODE', 'Modo del mapa de Google');

define('_AM_WEBLINKS_CAT_SHOW_GM',   'Mostrar mapa de Google');
define('_AM_WEBLINKS_MODE_NON',       'No mostrar');
define('_AM_WEBLINKS_MODE_DEFAULT',   'Valor por defecto');
define('_AM_WEBLINKS_MODE_PARENT',    'Igual que en la categoría anterior');
define('_AM_WEBLINKS_MODE_FOLLOWING', 'Siguiente valor');

define('_AM_WEBLINKS_CONF_CAT_ALBUM',  'Ver album en categoría');
define('_AM_WEBLINKS_CONF_LINK_ALBUM', 'Ver album en enlace');
//define('_AM_WEBLINKS_ALBUM_SEL', 'Seleccionar módulo de album');
define('_AM_WEBLINKS_ALBUM_LIMIT', 'Número de fotos mostradas');
define('_AM_WEBLINKS_WHEN_OMIT', 'Proceso cuando se omita');

define('_AM_WEBLINKS_MODULE_INSTALLED',     '%s Módulo ( %s ) versión %s está instalado');
define('_AM_WEBLINKS_MODULE_NOT_INSTALLED', '%s Módulo ( %s ) no está instalado');

// === 2007-04-08 ===
define('_AM_WEBLINKS_CAT_DESC_MODE',  'Mostrar descripción');
define('_AM_WEBLINKS_CAT_SHOW_FORUM', 'Mostrar foro');
define('_AM_WEBLINKS_CAT_SHOW_ALBUM', 'Mostrar album');
define('_AM_WEBLINKS_MODE_SETTING',   'Ajustar valores');
define('_AM_WEBLINKS_MODE_OMIT_PARENT', 'Igual que la categoría anterior cuando se omita');

// === 2007-06-10 ===
// d3forum
define('_AM_WEBLINKS_CONF_D3FORUM', 'Integración de comentarios con módulo d3forum');
define('_AM_WEBLINKS_PLUGIN_SEL',   'Seleccionar plugin');
define('_AM_WEBLINKS_DIRNAME_SEL',  'Seleccionar módulo');

// category
define('_AM_WEBLINKS_CAT_PATH_STYLE', 'Ver estilo en ruta de categoría');

// category page
define('_AM_WEBLINKS_CONF_CAT_PAGE', 'Ajustes de la página de categorías');
define('_AM_WEBLINKS_CAT_COLS', 'Número de columnas en categorías');
define('_AM_WEBLINKS_CAT_COLS_DESC', 'En página de categorías, especificar el número de columnas cuando se muestren las categorías bajo una jerarquía');
define('_AM_WEBLINKS_CAT_SUB_MODE', 'Ver rango de subcategorías');
define('_AM_WEBLINKS_CAT_SUB_MODE_1', 'Sólo categorías bajo una jerarquía');
define('_AM_WEBLINKS_CAT_SUB_MODE_2', 'todas las categorías bajo una o más categorías');

// === 2007-07-14 ===
// highlight
define('_AM_WEBLINKS_USE_HIGHLIGHT', 'Resaltar palabras clave');
define('_AM_WEBLINKS_CHECK_MAIL', 'Chequear formato de e-mail');
define('_AM_WEBLINKS_CHECK_MAIL_DSC', 'NO permite cualquier formato. <br /> SI/YES verifica que el formato sea del tipo abc@efg.com cuando registre un anuncio. ');
//define('_AM_WEBLINKS_NO_EMAIL', 'No poner e-mail');

// === 2007-08-01 ===
// config
define('_AM_WEBLINKS_MODULE_CONFIG_0','Configuración del módulo');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_0','Inicio');
define('_AM_WEBLINKS_MODULE_CONFIG_5','Configurar Módulo 5');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_5','Registro de enlace');
define('_AM_WEBLINKS_MODULE_CONFIG_6','Configurar Módulo 6');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_6','Mapa de Google');

// google map
define('_AM_WEBLINKS_GM_MAP_CONT', 'Control del mapa');
define('_AM_WEBLINKS_GM_MAP_CONT_DESC', 'Control del mapa largo, Control del mapa pequeño, Control del zoom del mapa');
define('_AM_WEBLINKS_GM_MAP_CONT_NON',   'No mostrar');
define('_AM_WEBLINKS_GM_MAP_CONT_LARGE', 'Control largo');
define('_AM_WEBLINKS_GM_MAP_CONT_SMALL', 'Control pequeño');
define('_AM_WEBLINKS_GM_MAP_CONT_ZOOM',  'Control de zoom');
define('_AM_WEBLINKS_GM_USE_TYPE_CONT',  'Usar control del tipo de mapa');
define('_AM_WEBLINKS_GM_USE_TYPE_CONT_DESC',  'Control del tipo de mapa');
define('_AM_WEBLINKS_GM_USE_SCALE_CONT',  'Usar control de escala');
define('_AM_WEBLINKS_GM_USE_SCALE_CONT_DESC',  'Control de escala');
define('_AM_WEBLINKS_GM_USE_OVERVIEW_CONT',  'Usar control de vista general del mapa');
define('_AM_WEBLINKS_GM_USE_OVERVIEW_CONT_DESC',  'Control de vista general del mapa');
define('_AM_WEBLINKS_GM_MAP_TYPE', '[Buscar] Tipo de mapa');
define('_AM_WEBLINKS_GM_MAP_TYPE_DESC', 'Tipo de mapa');
define('_AM_WEBLINKS_GM_GEOCODE_KIND',  '[UTF-8] Tipo de codificación');
define('_AM_WEBLINKS_GM_GEOCODE_KIND_DESC',  'Buscar latitud y longitud desde<br /><b>Resultado Simple</b><br />GClientGeocoder - Consigue latitud y longitud<br /><b>Más resultados</b><br />GClientGeocoder - Consigue sitio');
define('_AM_WEBLINKS_GM_GEOCODE_KIND_LATLNG', 'Resultado simple: Conseguir latitud y longitud');
define('_AM_WEBLINKS_GM_GEOCODE_KIND_LOCATIONS',   'Más resultados: conseguir los sitios');
define('_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO',  '[Buscar en Japón] Usa CSIS');
define('_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO_DESC',  'Válido en Japón<br />Conseguir latitud y longitud de la dirección');
define('_AM_WEBLINKS_GM_USE_NISHIOKA',  '[Buscar en Japón] Usa Inverse Geocode');
define('_AM_WEBLINKS_GM_USE_NISHIOKA_DESC',  'Valido en Japón<br />Busca direcciones desde latitud y longitud<br /><a href="http://nishioka.sakura.ne.jp/google/" target="_blank">Esta el la web de mi amigo Nishioka</a>');
define('_AM_WEBLINKS_GM_TITLE_LENGTH',  '[Marcador] Máximos caracteres para el título');
define('_AM_WEBLINKS_GM_TITLE_LENGTH_DESC',  'Máximo número de caracteres usados para el título en el marcador<br /><b>-1</b> es ilimitado');
define('_AM_WEBLINKS_GM_DESC_LENGTH',  '[Marcador] Máximos caracteres para el contenido');
define('_AM_WEBLINKS_GM_DESC_LENGTH_DESC',  'Máximo número de caracteres usados para el título en el marcador<br /><b>-1</b> es ilimitado');
define('_AM_WEBLINKS_GM_WORDWRAP',  '[Marcador] Máximos caracteres para wordwarp');
define('_AM_WEBLINKS_GM_WORDWRAP_DESC',  'Máximo número de caracteres usados para el título en el marcador<br /><b>-1</b> es ilimitado');
define('_AM_WEBLINKS_GM_USE_CENTER_MARKER',  '[Marcador] Mostrar el centro del marcador');
define('_AM_WEBLINKS_GM_USE_CENTER_MARKER_DESC', 'En página principal y de categorías, mostrar el centro del marcador');

// map jp
define('_AM_WEBLINKS_MAP_JP_MANAGE', 'Configuración de mapa de Japón');

// column
define('_AM_WEBLINKS_COLUMN_MANAGE', 'Manejo de columnas');
define('_AM_WEBLINKS_COLUMN_MANAGE_DESC', 'Agregar columnas en tabla de enlace y modificar tabla');
define('_AM_WEBLINKS_COLUMN_MANAGE_NOT_USE', 'No usar');
define('_AM_WEBLINKS_THERE_ARE_COLUMN', 'Hay <b>%s</b> etc columnas en tabla de enlace');
define('_AM_WEBLINKS_COLUMN_NUM', 'Número de columnas añadidas');
define('_AM_WEBLINKS_COLUMN_BIGGER_USE', 'El número de columnas añadidas es mayor que el número de la tabla del enlace');
define('_AM_WEBLINKS_COLUMN_UNMATCH',  'Las columnas no coinciden en la tabla de enlaces ni en la modificada');
define('_AM_WEBLINKS_PHPMYADMIN',  'phpMyAdmin es una herramienta para corregir problemas en las tablas');
define('_AM_WEBLINKS_LINK_NUM_ETC', 'El número de las columnas añadidas');

// latest
define('_AM_WEBLINKS_INDEX_MODE_LATEST', 'Orden de los últimos enlaces');
define('_AM_WEBLINKS_INDEX_MODE_LATEST_UPDATE', 'Fecha de actualización');
define('_AM_WEBLINKS_INDEX_MODE_LATEST_CREATE', 'Fecha de creación');

// header
define('_AM_WEBLINKS_CONF_HTML_STYLE', 'Configuración del estilo HTML');
define('_AM_WEBLINKS_HEADER_MODE', 'Usar cabecera del módulo XOOPS');
define('_AM_WEBLINKS_HEADER_MODE_DESC', 'Cuando es "NO", mostrar hoja de estilo y Javascript en la etiqueta<br />Cuando es "SI/YES", mostrarlos en etiqueta de cabecera, usando la cabecera del módulo de XOOPS<br />hay temas que no pueden ser utilizados');

// bulk
define('_AM_WEBLINKS_BULK_SAMPLE','Para ver el ejemplo, pulsa en el botón de ejemplo');
define('_AM_WEBLINKS_BULK_LINK_DSC10','Registrado y reparado');
define('_AM_WEBLINKS_BULK_LINK_DSC20','El administrador puede especificar temas de registro');
define('_AM_WEBLINKS_BULK_LINK_DSC21','Primer párrafo');
define('_AM_WEBLINKS_BULK_LINK_DSC22','Segundo párrafo, y siguientes');
define('_AM_WEBLINKS_BULK_LINK_DSC23','Ingrese el registro de nombres de elementos en la primera línea.<br />Pon una barra horizontal con guiones (---)');
define('_AM_WEBLINKS_BULK_LINK_DSC24','Describir el registro de productos, por el orden de en el primer párrafo, dividido por una coma (,) en la segunda línea.');
define('_AM_WEBLINKS_BULK_CHECK_URL','Verifica para ajustar la página web');
define('_AM_WEBLINKS_BULK_CHECK_DESCRIPTION','Verifica la descripción');

// === 2007-09-01 ===
// auth
define('_AM_WEBLINKS_AUTH_DELETE','Puedes borrar');
define('_AM_WEBLINKS_AUTH_DELETE_DSC','Especifica los grupos permitidos para aprobar solicitudes de borrado de enlaces');
define('_AM_WEBLINKS_AUTH_DELETE_AUTO','Pueden aprobar el borrado de enlaces');
define('_AM_WEBLINKS_AUTH_DELETE_AUTO_DSC','Especifica los grupos permitidos para aprobar solicitudes de borrado de enlaces');

// nofitication
define('_AM_WEBLINKS_NOTIFICATION_MANAGE', 'Manejo de notificaciones');
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_DESC', 'Ajustes para cada módulo de administrador<br />Es el mismo que la parte superior de la página del módulo');
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_NOT_USE', "No lo puedes usar en algunas versiones de XOOPS");
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_PLEASE', 'Si es el caso, usa la parte superior de la página de éste módulo');
define('_AM_WEBLINKS_SUBJ_LINK_MOD_APPROVED', '[{X_SITENAME}] {X_MODULE}: Tu solicitud de modificación del enlace ha sido aceptada y efectuada');
define('_AM_WEBLINKS_SUBJ_LINK_MOD_REFUSED',  '[{X_SITENAME}] {X_MODULE}: Tu solicitud de modificación del enlace ha sido rechazada');
define('_AM_WEBLINKS_SUBJ_LINK_DEL_APPROVED', '[{X_SITENAME}] {X_MODULE}: Tu solicitud de borrado del enlace ha sido aceptada y efectuada');
define('_AM_WEBLINKS_SUBJ_LINK_DEL_REFUSED',  '[{X_SITENAME}] {X_MODULE}: Tu solicitud de borrado del enlace ha sido rechazada');

// config
define('_AM_WEBLINKS_ADMIN_WAITING_SHOW', 'Mostrar lista de espera del administrador');
define('_AM_WEBLINKS_USER_WAITING_NUM',   'Número de usuarios en espera de ser aceptados');
define('_AM_WEBLINKS_USER_OWNER_NUM',     'Número de usuarios en espera ');
define('_AM_WEBLINKS_USE_HITS_SINGLELINK','Contabilizar cuando visualizen el enlace');
define('_AM_WEBLINKS_USE_HITS_SINGLELINK_DSC','SI/YES activa el contador cuando visualizen el enlace');
define('_AM_WEBLINKS_MODE_RANDOM', 'Redireccionar aleatoriamente');
define('_AM_WEBLINKS_MODE_RANDOM_URL', 'Web registrada');
define('_AM_WEBLINKS_MODE_RANDOM_SINGLE', 'Enlace de enlace en éste módulo');

// request list
define('_AM_WEBLINKS_DEL_REQS', 'Solicitud de espera de borrado en validación');
define('_AM_WEBLINKS_NO_DEL_REQ','No se requiere borrado de enlace');
define('_AM_WEBLINKS_DEL_REQ_DELETED','Solicitud de borrado de enlace denegada');

// link list
define('_AM_WEBLINKS_LINK_USERCOMMENT_DESC','Listado de enlaces con comentarios para el administrador (Listado por el más nuevo)');

// clone
define('_AM_WEBLINKS_CLONE_LINK', 'Clonar');
define('_AM_WEBLINKS_CLONE_MODULE', 'Clonar a otro módulo');
define('_AM_WEBLINKS_CLONE_CONFIRM', 'Confirmar el clonado');
define('_AM_WEBLINKS_NO_MODULE', 'No corresponde al módulo');

// link form
define('_AM_WEBLINKS_MODIFIED', 'Modificado');
define('_AM_WEBLINKS_CHECK_CONFIRM', 'Confirmado');
define('_AM_WEBLINKS_WARN_CONFIRM', 'ATENCIÓN: Marcar para "Confirmado" de %s');
define('_AM_WEBLINKS_RSSC_EXIST_MORE', 'Hay dos o más enlaces con el mismo "RSSC ID"');

// web shot
define('_AM_WEBLINKS_LINK_IMG_THUMB', 'Sustituir el enlace de la imagen');
define('_AM_WEBLINKS_LINK_IMG_THUMB_DSC', 'Mostrar el sitio WEB en miniatura en lugar de la imagen en el vínculo, <br />usando el servicio de miniaturas, <br />si no estable el vínculo de la imagen.');
define('_AM_WEBLINKS_LINK_IMG_NON', 'NINGUNA');
define('_AM_WEBLINKS_LINK_IMG_MOZSHOT', 'Usar <a href="http://mozshot.nemui.org/" target="_blank">MozShot</a>');
define('_AM_WEBLINKS_LINK_IMG_SIMPLEAPI', 'Usar <a href="http://img.simpleapi.net/" target="_blank">SimpleAPI</a>');

}
// --- define language begin ---

?>