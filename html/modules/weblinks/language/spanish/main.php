<?php
// =======>Kirby Traductions<======= \\
// =======>  Dynamic Noiser  <======= \\

//=========================================================
// Modulo de Enlaces
// Idioma por defecto
// Idioma : Español
// 13-10-2007 Kirby & Dynamic Noiser
//=========================================================

// --- define language begin ---
if( !defined('WEBLINKS_LANG_MB_LOADED') ) 
{

define('WEBLINKS_LANG_MB_LOADED', 1);

//---------------------------------------------------------
// same as mylinks
//---------------------------------------------------------

//======	 singlelink.php	======
define("_WLS_CATEGORY","Categoría");
define("_WLS_HITS","Visitas");
define("_WLS_RATING","Calificación");
define("_WLS_VOTE","Voto");
define("_WLS_ONEVOTE","1 voto");
define("_WLS_NUMVOTES","%s votos");
define("_WLS_RATETHISSITE","Califica éste Enlace");
define("_WLS_REPORTBROKEN","Reporta un problema con éste Enlace");
define("_WLS_TELLAFRIEND","Díselo a un amigo");
define("_WLS_EDITTHISLINK","Edita éste Enlace");
define("_WLS_MODIFY","Modifica");

//======	submit.php	======
define("_WLS_SUBMITLINKHEAD","Envía un nuevo Enlace");
define("_WLS_SUBMITONCE","Envía éste Enlace una sola vez.");
define("_WLS_DONTABUSE","El nombre e IP del usuario quedan registradas, por favor no abuse del sistema.");
define("_WLS_TAKESHOT","Se tomará una impresión de pantalla del sitio y puede tomar unos días para que sea agregado a nuestro directorio comercial.");
define("_WLS_ALLPENDING","El envío de su enlace es registrado <b>temporaralmente</b>, y es publicado despues de su verificación por parte del staff. <br />Puede agregar información del enlace antes de su aprobación.");
//define("_WLS_WHENAPPROVED","Recibirá un E-mail cuando sea aprobado");
define("_WLS_RECEIVED","Recibimos la información del Enlace, gracias!");

//======	modlink.php	======
define("_WLS_REQUESTMOD","Solicitar modificación de enlace");
define("_WLS_THANKSFORINFO","racias por la información. Su solicitud será revisada a la brevedad.");
define("_WLS_THANKSFORHELP","Gracias por ayudar a mantener la integridad de este directorio.");
define("_WLS_FORSECURITY","Por razones de seguridad su usuario e Ip serán almacenados temporaralmente.");
define("_WLS_SEARCHFOR","Buscar por"); //-no use
define("_WLS_ANY","cualquiera");
define("_WLS_SEARCH","Buscar");
define("_WLS_MAIN","Inicio");
define("_WLS_SUBMITLINK","Enviar Enlace");
define("_WLS_POPULAR","Popular");
define("_WLS_TOPRATED","Más valorado");
define("_WLS_NEWTHISWEEK","Nuevo ésta semana");
define("_WLS_UPTHISWEEK","Actualizado ésta semana");
define("_WLS_POPULARITYLTOM","Popular (de menos a más valorados)");
define("_WLS_POPULARITYMTOL","Popular (de más a menos visitados)");
define("_WLS_TITLEATOZ","Título (A a Z)");
define("_WLS_TITLEZTOA","Título (Z a A)");
define("_WLS_DATEOLD","Fecha (Enlaces más antiguos primero)");
define("_WLS_DATENEW","Fecha (Enlaces más nuevos primero)");
define("_WLS_RATINGLTOH","Valoración (De menos a más)");
define("_WLS_RATINGHTOL","Valoración (De más a menos)");
define("_WLS_NOSHOTS","Captura de pantalla no disponible");
define("_WLS_DESCRIPTIONC","Nombre: ");
define("_WLS_EMAILC","E-mail: ");
define("_WLS_CATEGORYC","Categoría: ");
define("_WLS_LASTUPDATEC","Última actualización: ");
define("_WLS_HITSC","Visitas: ");
define("_WLS_RATINGC","Valoración: ");
define("_WLS_THEREARE","Existen <b>%s</b> Enlaces en nuestro directorio comercial");
define("_WLS_LATESTLIST","últimos listados");

//define("_WLS_LINKID","ID del Enlace: ");
//define("_WLS_SITETITLE","Título de Web: ");
//define("_WLS_SITEURL","URL de la Web: ");
//define("_WLS_OPTIONS","Opciones: ");
define("_WLS_LINKID","ID del Enlace: ");
define("_WLS_SITETITLE","Título de Web: ");
define("_WLS_SITEURL","URL de la Web: ");
define("_WLS_OPTIONS","Opciones: ");
define("_WLS_NOTIFYAPPROVE", "Notificarme de si este Enlace es aceptado o rechazado");
define("_WLS_SHOTIMAGE","Imagen: ");
define("_WLS_SENDREQUEST","Enviar Solicitud");
define("_WLS_VOTEAPPRE","Aprecieamos tu voto.");
define("_WLS_THANKURATE","Gracias por tu tiempo y por ponerle un %s a este Enlace");
define("_WLS_VOTEFROMYOU","Aportaciones de los usuarios, tales como a ti mismo ayudará a otros visitantes decidir mejor que Enlace elegir.");
define("_WLS_VOTEONCE","Por favor, no votes más de una vez a un Enlace.");
define("_WLS_RATINGSCALE","La escala es del 1 al 10, con 1 es pésimo y con 10 es excelente.");
define("_WLS_BEOBJECTIVE","Por favor, sea objetivo, si se recibe siempre 1 ó 10, la valoración no será útil.");
define("_WLS_DONOTVOTE","No votes a tu Enlace.");
define("_WLS_RATEIT","¡Vótalo!");
define("_WLS_INTRESTLINK","Webs interesantes en %s");  // %s es tu sitio
define("_WLS_INTLINKFOUND","Hay Webs interesantes en %s");  // %s es tu sitio
define("_WLS_RANK","Votos");
define("_WLS_TOP10","%s Top 10"); // %s is a link category title
define("_WLS_SEARCHRESULTS","Resultados de la busqueda <b>%s</b>:"); // %s is search keywords
define("_WLS_SORTBY","Ordenar por:");
define("_WLS_TITLE","Título");
define("_WLS_DATE","Fecha");
define("_WLS_POPULARITY","Popularidad");
define("_WLS_CURSORTEDBY","Sitios actualmente ordenados por: %s");
define("_WLS_PREVIOUS","Anterior");
define("_WLS_NEXT","Siguiente");
define("_WLS_NOMATCH","No se encontró nada");
define("_WLS_SUBMIT","Enviar");
define("_WLS_CANCEL","Cancelar");
define("_WLS_ALREADYREPORTED","Ya habias reportado este Enlace roto.");
define("_WLS_MUSTREGFIRST","No tienes permisos para hacer esto.<br />¡Necesitas registrarte o loguearte!");
define("_WLS_NORATING","Ningun Voto seleccionado.");
define("_WLS_CANTVOTEOWN","No puedes votar a tu Enlace.<br />Todos los votos son registrados y repasados.");
define("_WLS_VOTEONCE2","Vota solo una vez.<br />Todos los votos son registrados y repasados.");

//%%%%%%	Admin	  %%%%%

define("_WLS_WEBLINKSCONF","Configuración de Enlaces");
define("_WLS_GENERALSET","Ajustes Generales");
define("_WLS_ADDMODDELETE","Añade, modifica y/o elimina categorías/Enlaces");
define("_WLS_LINKSWAITING","Nuevos Enlaces esperando validación");
define("_WLS_MODREQUESTS","Enlaces modificados esperando validación");
define("_WLS_BROKENREPORTS","Reportar Enlaces para reparar");
define("_WLS_SUBMITTER","Emisor");
define("_WLS_VISIT","Visita");

//define("_WLS_SHOTMUST","La imagen de captura de pantalla debe ser un archivo válido en el directorio %s (ejemplo. shot.gif). Deja ésta en blanco si no hay imagen.");
define("_WLS_LINKIMAGEMUST"," Introduce el enlace de la imagen %s. (ejemplo. shot.gif). Deja ésta en blanco si no hay imagen.");
define("_WLS_APPROVE","Aprobado");
define("_WLS_DELETE","Borrado");
define("_WLS_NOSUBMITTED","No hay Enlaces nuevos.");
define("_WLS_ADDMAIN","Crea una nueva categoría");
define("_WLS_TITLEC","Título: ");
define("_WLS_IMGURL","Dirección de imagen (OPCIONAL, ancho redimensionado a 50): ");
define("_WLS_ADD","Agregar");
define("_WLS_ADDSUB","Crear una nueva subcategoría");
define("_WLS_IN","En");
define("_WLS_ADDNEWLINK","Agregar un nuevo Enlace");
define("_WLS_MODCAT","Modificar categoría");
define("_WLS_MODLINK","Modificar Enlace");
define("_WLS_TOTALVOTES","Votos del Enlace (total votos: %s)");
define("_WLS_USERTOTALVOTES","Votos de usuarios registrados (total votos: %s)");
define("_WLS_ANONTOTALVOTES","Votos de usuarios anónimos (total votos: %s)");
define("_WLS_USER","Usuarios");
define("_WLS_IP","Dirección IP");
define("_WLS_USERAVG","Calificación AVG del usuario");
define("_WLS_TOTALRATE","Calificaciones totales");
define("_WLS_NOREGVOTES","No hay votos de usuarios registrados");
define("_WLS_NOUNREGVOTES","No hay votos de usuarios anónimos");
define("_WLS_VOTEDELETED","Datos de votos borrados.");
define("_WLS_NOBROKEN","No hay reporte de Enlaces para reparar.");
define("_WLS_IGNOREDESC","Ignorar (Ignorar el reporte  y borrar el <b>enlace de Enlace para reparar</b>)");
define("_WLS_DELETEDESC","Borrar (Borrar <b>los datos de sitios web</b> y <b>Enlaces para reparar reportados)");
define("_WLS_REPORTER","Envió el reporte");
define("_WLS_IGNORE","Rechazado");
define("_WLS_LINKDELETED","Enlace borrado.");
define("_WLS_BROKENDELETED","Enlace para reparar borrado.");

//define("_WLS_USERMODREQ","Usuario que solicita la modificación del Enlace");
define("_WLS_ORIGINAL","Original");
define("_WLS_PROPOSED","Propuesto");
define("_WLS_OWNER","Propietario");
define("_WLS_NOMODREQ","No hay solicitud de modificación.");
define("_WLS_DBUPDATED","Directorio comercial actualizado correctamente");
define("_WLS_MODREQDELETED","Solicitud de modificación borrada.");
define("_WLS_IMGURLMAIN","Dirección de imagen (OPCIONAL y sólo válido para categorías principales, ancho redimensionado a 50): ");
define("_WLS_PARENT","Categoría padre:");
define("_WLS_SAVE","Grabar cambios");
define("_WLS_CATDELETED","Categorías borradas.");
define("_WLS_WARNING","ATENCION: Estás seguro que quieres borrar ésta categoría? Si lo haces, borrarás todos los Enlaces que hay en ella");
define("_WLS_YES","SI");
define("_WLS_NO","NO");
define("_WLS_NEWCATADDED","Nueva categoría creada correctamente");
//define("_WLS_ERROREXIST","ERROR: El Enlace ya está en el directorio");
//define("_WLS_ERRORTITLE","ERROR: Escribe un TÍTULO");
//define("_WLS_ERRORDESC","ERROR: Escribe una DESCRIPCIÓN");
define("_WLS_NEWLINKADDED","Nuevo Enlace agregado al directorio.");
define("_WLS_YOURLINK","Enlace a página web en %s");
define("_WLS_YOUCANBROWSE","Puedes ven nuestros Enlaces en %s");
define("_WLS_HELLO","Hola %s");
define("_WLS_WEAPPROVED","Envío de Enlace al directorio aprobado.");
define("_WLS_THANKSSUBMIT","Gracias por añadir otro Enlace");
define("_WLS_ISAPPROVED","Enlace aprobado");


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------

//======	index.php	======
// guidance bar
define("_WLS_SUBMIT_NEW_LINK","Envía un nuevo Enlace");
define("_WLS_SITE_POPULAR","Enlace popular");
define("_WLS_SITE_HIGHRATE","Enlace mejor calificado");
define("_WLS_SITE_NEW","Nuevo Enlace");
define("_WLS_SITE_UPDATE","Enlace actualizado");

// corrected typo
define("_WLS_SITE_RECOMMEND","Enlace recomendado");

// BUG 3032: "mutual site" is not suitable English
define("_WLS_SITE_MUTUAL","Enlace asociado");
define("_WLS_SITE_RANDOM","Enlace aleatorio");
define("_WLS_NEW_SITELIST","Nuevo Enlace");
define("_WLS_NEW_ATOMFEED","Nueva RSS/ATOM");
define("_WLS_SITE_RSS","Enlace RSS/ATOM");
define("_WLS_ATOMFEED","Semilla RSS/ATOM");
define("_WLS_LASTUPDATE","Última actualización");
define("_WLS_MORE","Más detalles");

//======	 singlelink.php	======
define("_WLS_DESCRIPTION","Descripción");
define("_WLS_PROMOTER","Promotor");
define("_WLS_ZIP","Código postal");
define("_WLS_ADDR","Dirección");
define("_WLS_TEL","Número de teléfono");
define("_WLS_FAX","Número de fax");

//======	 submit.php	======
define("_WLS_BANNERURL","Dirección del Banner");
define("_WLS_NAME","Nombre");
define("_WLS_EMAIL","E-mail");
define("_WLS_COMPANY","Empresa");
define("_WLS_STATE","Provincia");
define("_WLS_CITY","Ciudad");
define("_WLS_ADDR2","Dirección 2");
define("_WLS_PUBLIC","Publicar");
define("_WLS_NOTPUBLIC","No publicar");
define("_WLS_NOTSELECT","No especificado");
define("_WLS_SUBMIT_INDISPENSABLE","Lo que está marcado con una estrella <b>*</b> es indispensable.");
define("_WLS_SUBMIT_USER_COMMENT",'"Comentar al administrador" usa éste campo para escribirle al administrador.<br />Lo que aquí escribas no saldrá en la web.<br />No te olvides de poner la web del Enlace si es que tiene".');
define("_WLS_USER_COMMENT","Comentar al administrador");
define("_WLS_NOT_DISPLAY","Esto no se verá en la web.");

//======	modlink.php	======
define("_WLS_MODIFYAPPROVED","La modificación solicitada ha sido aprobada.");
define("_WLS_MODIFY_NOT_OWNER","Por favor, asegúrate de que eres tú la misma persona que insertó el Enlace.");
define("_WLS_MODIFY_PENDING","Grabado. Pendiente de aprobación");
define("_WLS_LINKSUBMITTER","Ha enviado el Enlace");

//======	user.php	======
//define('_WLS_PLEASEPASSWORD','Escribe contraseña');
define('_WLS_REGSTERED','Usuario registrado');
define('_WLS_REGSTERED_DSC','Cualquiera puede modificar el Enlace. <br />Se verificará antes de publicar.');
define('_WLS_EMAILNOTFOUND',"El e-mail no coincide.");

// error message
define("_WLS_ERROR_FILL", "Error: Introduce %s");
define("_WLS_ERROR_ILLEGAL","Error: Formato incorrecto %s");
define("_WLS_ERROR_CID","Error: Selecciona categoría");
define("_WLS_ERROR_URL_EXIST","Error: El Enlace ya está registrado. ");
define("_WLS_WARNING_URL_EXIST","Advertencia: Un Enlace similar ya existe en el directorio. ");
define("_WLS_ERRORNOLINK","Error: No se encuentra el Enlace");
define("_WLS_CATLIST","Listado de categorías");
define("_WLS_LINKIMAGE","Enlace a la imagen: ");
//define("_WLS_USERID","ID de usuario: ");
define("_WLS_CATEGORYID","IDde categoría: ");
//define("_WLS_CREATEC","Fecha de registro: ");
define("_WLS_TIMEUPDATE","Actualizado");
define("_WLS_NOTTIMEUPDATE","No actualizado");
define("_WLS_LINKFLAG","Crear un enlace bajo ésto");
define("_WLS_NOTLINKFLAG","No crear un enlace bajo éstos");
define("_WLS_GOTOADMIN","Ir a la página de administración");

// category delete
define("_WLS_DELCAT","Borrar categoría");
define("_WLS_SUBCATEGORY","Subcategoría");
define("_WLS_SUBCATEGORY_NON","No hay subcategoría");
define("_WLS_LINK_BELONG","Enlaces relacionados");
define("_WLS_LINK_BELONG_NUMBER","Number Enlaces relacionados");
define("_WLS_LINK_BELONG_NON","No hay Enlaces relacionados");
define("_WLS_LINK_MAYBE_DELETE","Enlaces a ser borrados");
define("_WLS_LINK_MAYBE_DELETE_DSC","Los resultados de la operaciónpueden ser diferentes si hay subcategorías. Algunos Enlaces pueden ser borrados.");
define("_WLS_LINK_DELETE_NON","No hay coemrcios para borrar");
define("_WLS_CATEGORY_LINK_DELETE_EXCUTE","Borrar categoría y Enlaces que hay en ella");
define("_WLS_CATEGORY_LINK_DELETED","Categoría y Enlaces borrados.");
define("_WLS_CATEGORY_DELETED","Categorías borradas");
define("_WLS_LINK_DELETED","Enlaces borrados");
define("_WLS_ERROR_CATEGORY","Error: Categoría no seleccionada");
define("_WLS_ERROR_MAX_SUBCAT","Error: Number of selected categories exceeds the maximum to be deleted at a time");
define("_WLS_ERROR_MAX_LINK_BELONG","Error: El número de Enlaces seleccionados para borrar supera el máximo permitido. ");
define("_WLS_ERROR_MAX_LINK_DEL","Error: El número de Enlaces seleccionados para borrar supera el máximo permitido de una sola vez.");

// recommend site, mutual site
define("_WLS_MARK","Marcador");
define("_WLS_ADMINCOMMENT","Comentario del administrador");

// broken link check
define("_WLS_BROKEN_COUNTER","Contador de Enlaces debe ser reparado");

// RSS/ATOM URL
define("_WLS_RSS_URL","Dirección de RSS/ATOM");
define("_WLS_RSS_URL_0","No se usa");
define("_WLS_RSS_URL_1","Tipo RSS");
define("_WLS_RSS_URL_2","Tipo ATOM");
define("_WLS_RSS_URL_3","Automático");

define("_WLS_ATOMFEED_DISTRIBUTE","Distribuir semillas RSS/ATOM mostradas aquí.");
define("_WLS_ATOMFEED_FIREFOX","Espero que estés usando <a href='http://www.mozilla.org/products/firefox/' target='_blank'>Firefox</a>. Si es así, añade a marcadores");

// 2005-10-20
define("_WLS_EMAIL_APPROVE","Se notificará si se aprueba");
define("_WLS_TOPTEN_TITLE","%s Top %u");
// %s es un título de Enlace
// %u es el número de Enlaces
define("_WLS_TOPTEN_ERROR", "Hay demasiadas categorías principales. Detenido para mostrar %u");
// %u es el número de categorías

// 2006-04-02
define('_WEBLINKS_MID', 'Modificar ID');
define('_WEBLINKS_USERID', 'ID de usuario');
define('_WEBLINKS_CREATE', 'Creado');

// conflict with rssc
//define('_HOME',  'Inicio');
//define('_SAVE',  'Grabar');
//define('_SAVED', 'Grabado');
//define('_CREATE', 'Crear');
//define('_CREATED','Creado');
define('_FINISH',   'Finalizar');
define('_FINISHED', 'Finalizado');
//define('_EXECUTE', 'Ejecutar');
//define('_EXECUTED','Ejecutado');
define('_PRINT','Imprimir');
define('_SAMPLE','Ejemplo');
define('_NO_MATCH_RECORD','No hay coincidencias');
define('_MANY_MATCH_RECORD','Hay dos o más coincidencias');
define('_NO_CATEGORY', 'No hay categoría');	
define('_NO_LINK', 'No hay Enlace');
define('_NO_TITLE', 'No hay título');
define('_NO_URL', 'No hay web');
define('_NO_DESCRIPTION','No hay descripción');
define('_GOTO_MAIN',   'Ir al principio');
define('_GOTO_MODULE', 'Ir al módulo');

// config
define('_WEBLINKS_INIT_NOT', 'La tabla de configuración no ha sido inicializada');
define('_WEBLINKS_INIT_EXEC', 'Configuración de la tabla inicializada');
define('_WEBLINKS_VERSION_NOT','Este módulo es la versión %s . Actulízalo');
define('_WEBLINKS_UPGRADE_EXEC','Actualiza la tabla de configuración');

// html tag
define('_WEBLINKS_OPTIONS', 'Opciones');
define('_WEBLINKS_DOHTML', ' Activar etiquetas HTML');
define('_WEBLINKS_DOIMAGE', ' Activar imágenes');
define('_WEBLINKS_DOBREAK', ' Activar salto de línea');
define('_WEBLINKS_DOSMILEY', ' Activar iconos gestuales');
define('_WEBLINKS_DOXCODE', ' Activar código de XOOPS');
define('_WEBLINKS_PASSWORD_INCORRECT','Contraseña incorrecta');
define('_WEBLINKS_ETC', 'etc');
define('_WEBLINKS_AUTH_UID',    'ID de usuario coincide');
define('_WEBLINKS_AUTH_PASSWD', 'Contraseña coincide');
define('_WEBLINKS_BANNER_SIZE', 'Tamaño del Banner');

// === 2006-10-01 ===
// conflict with rssc
if( !defined('_HOME') ) 
{
	define('_HOME',  'Inicio');
	define('_SAVE',  'Grabar');
	define('_SAVED', 'Grabado');
	define('_CREATE', 'Crear');
	define('_CREATED','Creado');
	define('_EXECUTE', 'Ejecutar');
	define('_EXECUTED','Ejecutado');
}

define('_WEBLINKS_MAP_USE', 'Usar icono de mapa');

// rssc
define('_WEBLINKS_RSSC_LID',  'Lid RSSC');
define('_WEBLINKS_RSS_MODE',  'Modo RSS');
define('_WEBLINKS_RSSC_NOT_INSTALLED', 'Módulo RSSC ( %s ) no instalado');
define('_WEBLINKS_RSSC_INSTALLED',     'Módulo RSSC ( %s ) versión %s instalado');
define('_WEBLINKS_RSSC_REQUIRE', 'Requiere módulo RSSC versión %s o superior');
define('_WEBLINKS_GOTO_SINGLELINK', 'Ir a información de Enlace');

// warnig
define('_WEBLINKS_WARN_NOT_READ_URL', 'ATENCION: No se puede leer la página web');
define('_WEBLINKS_WARN_BANNER_NOT_GET_SIZE', 'ATENCIÓN: No se puede determinar el tamaño del banner');

// google map: hacked by wye <http://never-ever.info/>
define('_WEBLINKS_GM_LATITUDE',  'Latitud');
define('_WEBLINKS_GM_LONGITUDE', 'Longitud');
define('_WEBLINKS_GM_ZOOM',      'Nivel de Zoom');
define('_WEBLINKS_GM_GET_LOCATION', 'Información tomada de GoogleMaps');
//define('_WEBLINKS_GM_GET_BUTTON', 'Adquirir Latitud/Longitud/Zoom');
define('_WEBLINKS_GM_DEFAULT_LOCATION', 'Localización por defecto');
define('_WEBLINKS_GM_CURRENT_LOCATION', 'Localización actual');

// === 2006-11-04 ===
// google map inline mode
define('_WEBLINKS_GOOGLE_MAPS', 'Google Maps');
define('_WEBLINKS_JAVASCRIPT_INVALID', 'Tu navegador no está usando JavaScript');
define('_WEBLINKS_GM_NOT_COMPATIBLE',  'Tu navegador no puede usar GoogleMaps');
define('_WEBLINKS_GM_NEW_WINDOW', 'Ver en nueva ventana');
define('_WEBLINKS_GM_INLINE',   'Visualización en línea');
define('_WEBLINKS_GM_DISP_OFF', 'Deshabilitar visualización');

// google map: inverse Geocoder
define('_WEBLINKS_GM_GET_LATITUDE', 'Adquirir Latitud/Longitud/Zoom');
define('_WEBLINKS_GM_GET_ADDR', 'Adquirir dirección');

// === 2006-12-11 ===
// google map: Geocode
define('_WEBLINKS_GM_SEARCH_MAP_FROM_ADDRESS', 'Buscar mapa desde dirección');
define('_WEBLINKS_GM_NO_MATCH_PLACE', 'No se encuentra el sitio');
define('_WEBLINKS_GM_JP_SEARCH_MAP_FROM_ADDRESS', 'Mapa de búsqueda de Japón');
define('_WEBLINKS_GM_JP_TOKYO_AC_GEOCODE', 'Universidad de Tokyo Japón');
define('_WEBLINKS_GM_JP_MLIT_ISJ', 'Ministerio de infraestructura y transporte de Japón');

// link item
define('_WEBLINKS_TIME_PUBLISH', 'Fecha de publicación');
define('_WEBLINKS_TIME_EXPIRE',  'Fecha de caducidad');
define('_WEBLINKS_TEXTAREA',     'Area de texto');
define('_WEBLINKS_WARN_TIME_PUBLISH', 'En espera para publicar');
define('_WEBLINKS_WARN_TIME_EXPIRE',  'En breve finalizará');
define('_WEBLINKS_WARN_BROKEN', 'Este Enlace debe ser verificado');

// === 2007-02-20 ===
// forum
define('_WEBLINKS_LATEST_FORUM', 'Último foro');
define('_WEBLINKS_FORUM',  'Foro');
define('_WEBLINKS_THREAD', 'Hilo');
define('_WEBLINKS_POST',   'Post');
define('_WEBLINKS_FORUM_ID',  'ID del foro');
define('_WEBLINKS_FORUM_SEL', 'Seleccionar foro');
define('_WEBLINKS_COMMENT_USE',  'Usar comentarios de XOOPS');

// aux
define('_WEBLINKS_CAT_AUX_TEXT_1', 'Texto auxiliar 1');
define('_WEBLINKS_CAT_AUX_TEXT_2', 'Texto auxiliar 2');
define('_WEBLINKS_CAT_AUX_INT_1',  'Texto auxiliar interno 1');
define('_WEBLINKS_CAT_AUX_INT_2',  'Texto auxiliar interno 2');

// captcha
define('_WEBLINKS_CAPTCHA', 'Captcha');
define('_WEBLINKS_CAPTCHA_DESC', 'Anti-Spam');
define('_WEBLINKS_ERROR_CAPTCHA','Error: No coincide la imagen Captcha con lo que escribes');
define('_WEBLINKS_ERROR', 'Error');

// hack for multi site
define('_WEBLINKS_CAT_TITLE_JP', 'Título en Japonés');
define('_WEBLINKS_DISABLE_FEATURE', 'Desactivar ésta característica');
define('_WEBLINKS_REDIRECT_JP_SITE', 'Ir a sitio japonés');

// === 2007-03-25 ===
define('_WEBLINKS_ALBUM_ID',  'ID de album');
define('_WEBLINKS_ALBUM_SEL', 'Seleccionar album');

// === 2007-04-08 ===
define('_WEBLINKS_GM_TYPE',  'Tipo de mapa de Google');
define('_WEBLINKS_GM_TYPE_MAP',       'Vista de Mapa');
define('_WEBLINKS_GM_TYPE_SATELLITE', 'Vista satelital');
define('_WEBLINKS_GM_TYPE_HYBRID',    'Vista híbrida');

// === 2007-08-01 ===
define('_WEBLINKS_GM_CURRENT_ADDRESS', 'Dirección actual');
define('_WEBLINKS_GM_SEARCH_LIST', 'Lista de resultados de la búsqueda');

// === 2007-09-01 ===
// waiting list
define('_WEBLINKS_ADMIN_WAITING_LIST', "Lista de espera del administrador");
define('_WEBLINKS_USER_WAITING_LIST',  'Tu lista de espera');
define('_WEBLINKS_USER_OWNER_LIST',    'Tu lista de enviados');

// submit form
define('_WEBLINKS_TIME_PUBLISH_SET', 'Ajusta la fecha de publicación');
define('_WEBLINKS_TIME_PUBLISH_DESC','Si no ajustas ésto, se publicará sin fecha');
define('_WEBLINKS_TIME_EXPIRE_SET',  'Ajusta la fecha de finalización');
define('_WEBLINKS_TIME_EXPIRE_DESC', 'Si no ajustas ésto, finalizará sin fecha');
define('_WEBLINKS_DEL_LINK_CONFIRM','Confirma el borrado');
define('_WEBLINKS_DEL_LINK_REASON', 'Razón para borrar');

}
// --- define language end ---

?>