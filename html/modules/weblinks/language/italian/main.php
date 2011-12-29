<?php
// $Id: main.php,v 1.1 2011/12/29 14:32:41 ohwada Exp $

// 2007-09-24 Luigi Trovato - Italian translation

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

// --- define language begin ---
if( !defined('WEBLINKS_LANG_MB_LOADED') ) 
{

define('WEBLINKS_LANG_MB_LOADED', 1);

//---------------------------------------------------------
// same as mylinks
//---------------------------------------------------------

//======	 singlelink.php	======
define("_WLS_CATEGORY","Categoria");
define("_WLS_HITS","Hits");
define("_WLS_RATING","Voti");
define("_WLS_VOTE","Vota");
define("_WLS_ONEVOTE","1 voto");
define("_WLS_NUMVOTES","%s voti");
define("_WLS_RATETHISSITE","Vota questo Sito");
define("_WLS_REPORTBROKEN","Segnala Link non valido");
define("_WLS_TELLAFRIEND","Dillo a un Amico");
define("_WLS_EDITTHISLINK","Edita questo Link");
define("_WLS_MODIFY","Modifica");

//======	submit.php	======
define("_WLS_SUBMITLINKHEAD","Invia Nuovo Link");
define("_WLS_SUBMITONCE","Invia il tuo link una volta sola.");
define("_WLS_DONTABUSE","Nome Utente e IP sono salvati, per cui non abusare del sistema per favore.");
define("_WLS_TAKESHOT","Prenderemo uno screenshot del tuo sito web e ci potrà volere qualche giorno prima che il link al sito sia aggiunto al nostro database.");
define("_WLS_ALLPENDING","L\'invio Link sarà registrato e sarà pubblicato dopo la verifica. ");
//define("_WLS_WHENAPPROVED","You'll receive an E-mail when it's approved.");
define("_WLS_RECEIVED","Abbiamo ricevuto le informazioni sul tuo Sito web. Grazie!");

//======	modlink.php	======
define("_WLS_REQUESTMOD","Richiesta Modifica Link");
define("_WLS_THANKSFORINFO","Grazie per le informazioni. Controlleremo la tua richiesta a breve.");


define("_WLS_THANKSFORHELP","Grazie per l'aiuto nel mantenere questa directory aggiornata.");
define("_WLS_FORSECURITY","Per ragioni di sicurezza il tuo nome utente e indirizzo IP saranno registrati temporaneamente.");

define("_WLS_SEARCHFOR","Ricerca per"); //-no use
define("_WLS_ANY","QUALSIASI");
define("_WLS_SEARCH","Ricerca");

define("_WLS_MAIN","Principale");
define("_WLS_SUBMITLINK","Invia Link");
define("_WLS_POPULAR","Popolare");
define("_WLS_TOPRATED","Più votato");

define("_WLS_NEWTHISWEEK","Nuovi questa settimana");
define("_WLS_UPTHISWEEK","Aggiornati questa settimana");

define("_WLS_POPULARITYLTOM","Popolarità (dai meno ai più cliccati)");
define("_WLS_POPULARITYMTOL","Popolarità (dai più ai meno cliccati)");
define("_WLS_TITLEATOZ","Titolo (A > Z)");
define("_WLS_TITLEZTOA","Titolo (Z > A)");
define("_WLS_DATEOLD","Data (Link vecchi per primi)");
define("_WLS_DATENEW","Date (Link nuovi per primi)");
define("_WLS_RATINGLTOH","Voti (Da punteggio più basso al più alto)");
define("_WLS_RATINGHTOL","Voti (Da punteggio più alto al più basso)");

define("_WLS_NOSHOTS","Nessuno Screenshot disponibile");
define("_WLS_DESCRIPTIONC","Descrizione: ");
//define("_WLS_EMAILC","Email: ");
define("_WLS_CATEGORYC","Categoria: ");
define("_WLS_LASTUPDATEC","Ultimo aggiornam.: ");
define("_WLS_HITSC","Hits: ");
define("_WLS_RATINGC","Votazione: ");

define("_WLS_THEREARE","Ci sono <b>%s</b> Link nel nostro Database");
define("_WLS_LATESTLIST","Aggiunte più recenti");

define("_WLS_LINKID","Link ID");
define("_WLS_SITETITLE","Titolo Sito");
define("_WLS_SITEURL","URL Sito");
define("_WLS_OPTIONS","Opzioni");

define("_WLS_NOTIFYAPPROVE", "Notificami quando questo link è approvato");
define("_WLS_SHOTIMAGE","Screenshot: ");
define("_WLS_SENDREQUEST","Invia Richiesta");

define("_WLS_VOTEAPPRE","Il tuo voto è apprezzato.");
define("_WLS_THANKURATE","Grazie per il tempo dedicato per votare un sito qui su %s.");
define("_WLS_VOTEFROMYOU","Il riscontro da utenti come te aiuterà altri visitatori a decidere meglio quali link scegliere.");
define("_WLS_VOTEONCE","Per favore non votare lo stesso sito più di una volta.");
define("_WLS_RATINGSCALE","La scala è 1 - 10, dove 1 indica scadente e 10 indica eccellente.");
define("_WLS_BEOBJECTIVE","Per favore sii obbiettivo, se tutti ricevono 1 o 10 le votazioni non sono molto utili.");
define("_WLS_DONOTVOTE","Non votare per il tuo stesso sito.");
define("_WLS_RATEIT","Votalo!");

define("_WLS_INTRESTLINK","Link Sito Interessante su %s");  // %s is your site name
define("_WLS_INTLINKFOUND","Questo è un link a un sito interessante che ho trovato su %s");  // %s is your site name

define("_WLS_RANK","Posizione");
define("_WLS_TOP10","%s Top 10"); // %s is a link category title

define("_WLS_SEARCHRESULTS","Risultati ricerca per <b>%s</b>:"); // %s is search keywords
define("_WLS_SORTBY","Ordinati per:");
define("_WLS_TITLE","Titolo");
define("_WLS_DATE","Data");
define("_WLS_POPULARITY","Popolarità");
define("_WLS_CURSORTEDBY","Siti attualmente ordinati per: %s");
define("_WLS_PREVIOUS","Precedente");
define("_WLS_NEXT","Seguente");
define("_WLS_NOMATCH","Nessun risultato per la tua ricerca");

define("_WLS_SUBMIT","Invia");
define("_WLS_CANCEL","Annulla");

define("_WLS_ALREADYREPORTED","Hai già inviato una segnalazione link non valido per questa risorsa.");
define("_WLS_MUSTREGFIRST","Spiacente, non hai il permesso di eseguire questa azione.<br />Per favore prima registrati o loggati!");
define("_WLS_NORATING","Nessun voto selezionato.");
define("_WLS_CANTVOTEOWN","Non puoi votare una risorsa inviata da te stesso.<br />Tutti i voti sono loggati e verificati.");
define("_WLS_VOTEONCE2","Vota per la risorsa selezionata solo una volta.<br />tutti i voti sono loggati e verificati.");

//%%%%%%	Admin	  %%%%%

define("_WLS_WEBLINKSCONF","Configurazione Web Links");
define("_WLS_GENERALSET","Impostazioni Generali Web Links");
//define("_WLS_ADDMODDELETE","Add, Modify, and Delete Categories/Links");
define("_WLS_LINKSWAITING","Nuovi Link in attesa di verifica");
define("_WLS_MODREQUESTS","Link Modificati in attesa di verifica");
define("_WLS_BROKENREPORTS","Segnalazioni Link non validi");

//define("_WLS_SUBMITTER","Submitter: ");
define("_WLS_SUBMITTER","Submitter");

define("_WLS_VISIT","Visita");

//define("_WLS_SHOTMUST","Screenshot image must be a valid image file under %s directory (ex. shot.gif). Leave it blank if no image file.");
define("_WLS_LINKIMAGEMUST"," Inserisci nome file immagine link sotto directory %s. (es. shot.gif) Lascia il campo vuoto se non c'è file immagine. ");

define("_WLS_APPROVE","Approva");
define("_WLS_DELETE","Cancella");
define("_WLS_NOSUBMITTED","Nessun Nuovo Link Inviato.");
define("_WLS_ADDMAIN","Aggiungi una categoria PRINCIPALE");
define("_WLS_TITLEC","Titolo: ");
define("_WLS_IMGURL","URL Immagine (OPZIONALEL Altezza immagine sarà ridim. a 50): ");
define("_WLS_ADD","Aggiungi");
define("_WLS_ADDSUB","Aggiungi una SOTTO-Categoria");
define("_WLS_IN","in");
define("_WLS_ADDNEWLINK","Aggiungi un Nuovo Link");
define("_WLS_MODCAT","Modifica Categoria");
define("_WLS_MODLINK","Modifica Link");
define("_WLS_TOTALVOTES","Voti Link (voti totali: %s)");
define("_WLS_USERTOTALVOTES","Voti Utenti Registrati (voti totali: %s)");
define("_WLS_ANONTOTALVOTES","Voti Utenti Anonimi (voti totali: %s)");
define("_WLS_USER","Utente");
define("_WLS_IP","IP Address");
define("_WLS_USERAVG","Voto MEDIO Utente");
define("_WLS_TOTALRATE","Totale Voti");
define("_WLS_NOREGVOTES","Nessun voto Utenti Registrati");
define("_WLS_NOUNREGVOTES","Nessun voto Utenti Non Registrati");
define("_WLS_VOTEDELETED","Dati dei voti cancellati.");
define("_WLS_NOBROKEN","Nessun link non valido.");
define("_WLS_IGNOREDESC","Ignora (Ignora <b>la segnalazione</b> e la cancella)");
define("_WLS_DELETEDESC","Cancella (Cancella <b>i dati del sito segnalato</b> e <b>la segnalazione</b> per il link.)");
define("_WLS_REPORTER","Mittente Segnalazione");

//define("_WLS_IGNORE","Ignore");
define("_WLS_IGNORE","Ignora (Cancella)");

define("_WLS_LINKDELETED","Link cancellato.");
define("_WLS_BROKENDELETED","Segnalazione link non valido cancellata.");
//define("_WLS_USERMODREQ","User Link Modification Requests");
define("_WLS_ORIGINAL","Originale");
define("_WLS_PROPOSED","Proposto");

//define("_WLS_OWNER","Owner: ");
define("_WLS_OWNER","Proprietario");

define("_WLS_NOMODREQ","Nessuna Richiesta modifica link.");
define("_WLS_DBUPDATED","Database Aggiornato con Successo!");
define("_WLS_MODREQDELETED","Richiesta Modifica Cancellata.");
define("_WLS_IMGURLMAIN","URL Immagine (OPZIONALE e valida solo per categorie principali. Altezza immagine sarà ridim. a 50): ");
define("_WLS_PARENT","Categoria Padre:");
define("_WLS_SAVE","Salva Modifiche");
define("_WLS_CATDELETED","Categoria cancellata.");
define("_WLS_WARNING","ATTENZIONE: Sei sicuro di voler cancellare questa categoria e TUTTI i suoi link e commenti?");
define("_WLS_YES","Sì");
define("_WLS_NO","No");
define("_WLS_NEWCATADDED","Nuova Categoria aggiunta con successo!");
//define("_WLS_ERROREXIST","ERROR: The Link you provided is already in the database!");
//define("_WLS_ERRORTITLE","ERROR: You need to enter a TITLE!");
//define("_WLS_ERRORDESC","ERROR: You need to enter a DESCRIPTION!");
define("_WLS_NEWLINKADDED","Nuovo Link aggiunto al database.");
define("_WLS_YOURLINK","Il tuo link su %s");
define("_WLS_YOUCANBROWSE","Puoi visitare i nostri link web su %s");
define("_WLS_HELLO","Ciao %s");
define("_WLS_WEAPPROVED","Abbiamo approvato il tuo invio link nel nostro database.");
define("_WLS_THANKSSUBMIT","Grazie per la segnalazione!");
define("_WLS_ISAPPROVED","Abbiamo approvato il tuo invio");


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------

//======	index.php	======
// guidance bar
define("_WLS_SUBMIT_NEW_LINK","Invia Nuovo Link");
define("_WLS_SITE_POPULAR","Sito popolare");
define("_WLS_SITE_HIGHRATE","Sito più votato");
define("_WLS_SITE_NEW","Sito recente");
define("_WLS_SITE_UPDATE","Sito aggiornato");

// corrected typo
define("_WLS_SITE_RECOMMEND","Sito raccomandato");

// BUG 3032: "mutual site" is not suitable English
define("_WLS_SITE_MUTUAL","Sito reciproco");

define("_WLS_SITE_RANDOM","Sito Casuale");
define("_WLS_NEW_SITELIST","Sito più recente");
define("_WLS_NEW_ATOMFEED","RSS/ATOM Feed più recente");
define("_WLS_SITE_RSS","Sito RSS/ATOM");
define("_WLS_ATOMFEED","RSS/ATOM Feed");

define("_WLS_LASTUPDATE","Ultimo Aggiornamento");
define("_WLS_MORE","Più dettagli");

//======	 singlelink.php	======
define("_WLS_DESCRIPTION","Descrizione");
define("_WLS_PROMOTER","Promuovi");
define("_WLS_ZIP","Codice CAP");
define("_WLS_ADDR","Indirizzo");
define("_WLS_TEL","Numero Telefono");
define("_WLS_FAX","Numero Fax");

//======	 submit.php	======
define("_WLS_BANNERURL","URL Banner");
define("_WLS_NAME","Nome");
define("_WLS_EMAIL","Email");
define("_WLS_COMPANY","Company/Organization");
define("_WLS_STATE","Stato");
define("_WLS_CITY","Città");
define("_WLS_ADDR2","Indirizzo 2");
define("_WLS_PUBLIC","Pubblica");
define("_WLS_NOTPUBLIC","Non pubblicare");
define("_WLS_NOTSELECT","Non specificato");
define("_WLS_SUBMIT_INDISPENSABLE","Asterisco '<b>*</b>' indica elemento obbligatorio.");
define("_WLS_SUBMIT_USER_COMMENT",'"Commento ad Admin" indica una opinione, richiesta, ecc.<br />Questa colonna non è mostrata su WEB.<br />Per favore inserisci URL del tuo sito se linka a questo sito, se vuoi essere indicato come "Link Reciproco".');
define("_WLS_USER_COMMENT","Commento ad Admin");
define("_WLS_NOT_DISPLAY","Questa colonna non è mostrata sul WEB.");

//======	modlink.php	======
define("_WLS_MODIFYAPPROVED","La tua richiesta di modifica link è stata approvata. ");
define("_WLS_MODIFY_NOT_OWNER","Per favore assicurati di essere la persona che ha inviato il link originale.");
define("_WLS_MODIFY_PENDING","Modifica link registrata. Sarà pubblicata dopo la verifica.");
define("_WLS_LINKSUBMITTER","Link Submitter");

//======	user.php	======
define('_WLS_PLEASEPASSWORD','Inserisci password');
define('_WLS_REGSTERED','Utente Registrato');
define('_WLS_REGSTERED_DSC','Chiunque può modificare le informazioni dei link. <br />Il Webmaster controllerà la modifica prima di pubblicarla.');
define('_WLS_EMAILNOTFOUND',"L'indirizzo E-mail non corrisponde.");


// error message
define("_WLS_ERROR_FILL", "Errore: Inserisci %s");
define("_WLS_ERROR_ILLEGAL","Errore: Formato errato %s");
define("_WLS_ERROR_CID",  "Errore: Scegli categoria");
define("_WLS_ERROR_URL_EXIST","Errore: Il link è stato già registrato. ");
define("_WLS_WARNING_URL_EXIST","Attenzione: Un link simile è stato già registrato. ");
define("_WLS_ERRORNOLINK","Errore: Link non trovato");


define("_WLS_CATLIST","Lista Categorie");
define("_WLS_LINKIMAGE","Immagine Link: ");
//define("_WLS_USERID","User ID: ");
define("_WLS_CATEGORYID","ID Categoria: ");
//define("_WLS_CREATEC","Registration Date: ");
define("_WLS_TIMEUPDATE","Aggiorna");
define("_WLS_NOTTIMEUPDATE","Non aggiornare");
define("_WLS_LINKFLAG","Crea un link sotto questo ");
define("_WLS_NOTLINKFLAG","Do Not create a link under this");
define("_WLS_GOTOADMIN","Vai a Pagina Admin");

// category delete
define("_WLS_DELCAT","Cancella Categoria");
define("_WLS_SUBCATEGORY","Sottocategoria");
define("_WLS_SUBCATEGORY_NON","Nessuna sottocategoria");
define("_WLS_LINK_BELONG","Link Collegati");
define("_WLS_LINK_BELONG_NUMBER","Numero di link collegati");
define("_WLS_LINK_BELONG_NON","Nessun link collegato");
define("_WLS_LINK_MAYBE_DELETE","Link da cancellare");
define("_WLS_LINK_MAYBE_DELETE_DSC","I risultati dell'operazione possono essere diversi se ci sono sottocategorie. Altri link potrebbero essere cancellati. ");
define("_WLS_LINK_DELETE_NON","Nessun link da cancellare");
define("_WLS_CATEGORY_LINK_DELETE_EXCUTE","Cancella categoria e link collegati");
define("_WLS_CATEGORY_LINK_DELETED","Categoria e link collegati cancellati.");
define("_WLS_CATEGORY_DELETED","Categorie cancellate");
define("_WLS_LINK_DELETED","Link cancellati");

define("_WLS_ERROR_CATEGORY","Errore: Categoria non selezionata");
define("_WLS_ERROR_MAX_SUBCAT","Errore: Num. di categorie selezionate eccede il massimo possibile in una volta");
define("_WLS_ERROR_MAX_LINK_BELONG","Errore: Num. di link collegati selezionati eccede il massimo possibile in una volta. ");
define("_WLS_ERROR_MAX_LINK_DEL","Errore: Num. di link selezionati eccede il massimo possibile in una volta.");

// recommend site, mutual site
define("_WLS_MARK","ssegna");
define("_WLS_ADMINCOMMENT","commento admin");

// broken link check
define("_WLS_BROKEN_COUNTER","Contatore Link non validi");

// RSS/ATOM URL
define("_WLS_RSS_URL","URL di RSS/ATOM");
define("_WLS_RSS_URL_0","non usare");
define("_WLS_RSS_URL_1","RSS type");
define("_WLS_RSS_URL_2","ATOM type");
define("_WLS_RSS_URL_3","auto discovery");

define("_WLS_ATOMFEED_DISTRIBUTE","Distributing RSS/ATOM feeds displayed here.");
define("_WLS_ATOMFEED_FIREFOX","Se usi <a href='http://www.mozilla.org/products/firefox/' target='_blank'>Firefox</a>, bookmark questa pagina, per consultare il nostro RSS/ATOM feed. ");

// 2005-10-20
define("_WLS_EMAIL_APPROVE","Notificami se approvato");
define("_WLS_TOPTEN_TITLE","%s Top %u");
// %s is a link category title
// %u is number of links
define("_WLS_TOPTEN_ERROR", "There are too many top categories. stopped to show by %u");
// %u is munber of categories

// 2006-04-02
define('_WEBLINKS_MID', 'ID Modifica');
define('_WEBLINKS_USERID', 'ID Utente');
define('_WEBLINKS_CREATE', 'Creato');

// conflict with rssc
//define('_HOME',  'Home');
//define('_SAVE',  'Save');
//define('_SAVED', 'Saved');
//define('_CREATE', 'Create');
//define('_CREATED','Created');
define('_FINISH',   'Fine');
define('_FINISHED', 'Finito');
//define('_EXECUTE', 'Execute');
//define('_EXECUTED','Executed');
define('_PRINT','Stampa');
define('_SAMPLE','Esempio');
define('_NO_MATCH_RECORD','Non ci sono record corrispondenti');
define('_MANY_MATCH_RECORD','Ci sono due o più record corrispondenti');
define('_NO_CATEGORY', 'Nessuna Categoria');	
define('_NO_LINK', 'Nessun Link');
define('_NO_TITLE', 'Nessun Titolo');
define('_NO_URL', 'Nessun URL');
define('_NO_DESCRIPTION','Nessuna Descrizione');
define('_GOTO_MAIN',   'Vai a Principale');
define('_GOTO_MODULE', 'Vai al Modulo');

// config
define('_WEBLINKS_INIT_NOT', 'La tabella config non è inizializzata');
define('_WEBLINKS_INIT_EXEC', 'Tabella Config inizializzata');
define('_WEBLINKS_VERSION_NOT','Questo modulo non è alla versione %s. Aggiorna ora');
define('_WEBLINKS_UPGRADE_EXEC','Aggiorna la tabella config');

// html tag
define('_WEBLINKS_OPTIONS', 'Opzioni');
define('_WEBLINKS_DOHTML', ' Abilita tag HTML');
define('_WEBLINKS_DOIMAGE', ' Abilita immagini');
define('_WEBLINKS_DOBREAK', ' Abilita linebreak');
define('_WEBLINKS_DOSMILEY', ' Abilita faccine');
define('_WEBLINKS_DOXCODE', ' Abilita i tag XOOPS');

define('_WEBLINKS_PASSWORD_INCORRECT','Password Errata');
define('_WEBLINKS_ETC', 'etc');
define('_WEBLINKS_AUTH_UID',    'corrisponde ID Utente');
define('_WEBLINKS_AUTH_PASSWD', 'corrisponde Password');
define('_WEBLINKS_BANNER_SIZE', 'Dimensione Banner');

// === 2006-10-01 ===
// conflict with rssc
if( !defined('_HOME') ) 
{
	define('_HOME',  'Home');
	define('_SAVE',  'Salva');
	define('_SAVED', 'Salvato');
	define('_CREATE', 'Crea');
	define('_CREATED','Creato');
	define('_EXECUTE', 'Esegui');
	define('_EXECUTED','Eseguito');
}

define('_WEBLINKS_MAP_USE', 'Usa Icona Mappa');

// rssc
define('_WEBLINKS_RSSC_LID',  'RSSC Lid');
define('_WEBLINKS_RSS_MODE',  'RSS Mode');
define('_WEBLINKS_RSSC_NOT_INSTALLED', 'Modulo RSSC ( %s ) non installato');
define('_WEBLINKS_RSSC_INSTALLED',     'Modulo RSSC ( %s ) ver %s installato');
define('_WEBLINKS_RSSC_REQUIRE', 'Richiesto modulo module ver %s o successiva');
define('_WEBLINKS_GOTO_SINGLELINK', 'VAI A Info Link');

// warnig
define('_WEBLINKS_WARN_NOT_READ_URL', 'Attanzione: Impossibile leggere url');
define('_WEBLINKS_WARN_BANNER_NOT_GET_SIZE', 'Attenzione: Impossibile verificare dimensione banner');

// google map: hacked by wye <http://never-ever.info/>
define('_WEBLINKS_GM_LATITUDE',  'Latitudine');
define('_WEBLINKS_GM_LONGITUDE', 'Longitudine');
define('_WEBLINKS_GM_ZOOM',      'Livello Zoom');
define('_WEBLINKS_GM_GET_LOCATION', 'Le informazioni sulla località sono prese da GoogleMaps');
//define('_WEBLINKS_GM_GET_BUTTON', 'Get Latitude/Longitude/Zoom');
define('_WEBLINKS_GM_DEFAULT_LOCATION', 'Località Default');
define('_WEBLINKS_GM_CURRENT_LOCATION', 'Località attuale');

// === 2006-11-04 ===
// google map inline mode
define('_WEBLINKS_GOOGLE_MAPS', 'Google Maps');
define('_WEBLINKS_JAVASCRIPT_INVALID', 'Il tuo browser non utilizza JavaScript');
define('_WEBLINKS_GM_NOT_COMPATIBLE',  'Il tuo browser non può accedere a GoogleMaps');
define('_WEBLINKS_GM_NEW_WINDOW', 'Visual. in Nuova Finestra');
define('_WEBLINKS_GM_INLINE',   'Visual. Inline');
define('_WEBLINKS_GM_DISP_OFF', 'Disabilita visual.');

// google map: inverse Geocoder
define('_WEBLINKS_GM_GET_LATITUDE', 'Ricava Latitudine/Longitudine/Zoom');
define('_WEBLINKS_GM_GET_ADDR', 'Ricava Indirizzo');

// === 2006-12-11 ===
// google map: Geocode
define('_WEBLINKS_GM_SEARCH_MAP_FROM_ADDRESS', 'Ricerca Mappa da indirizzo');
define('_WEBLINKS_GM_NO_MATCH_PLACE', 'N on ci sono luoghi corrispondenti a indirizzo');
define('_WEBLINKS_GM_JP_SEARCH_MAP_FROM_ADDRESS', 'Ricarca Mappa da indirizzo in Giappone');
define('_WEBLINKS_GM_JP_TOKYO_AC_GEOCODE', 'Japan Tokyo University');
define('_WEBLINKS_GM_JP_MLIT_ISJ', 'Japan Ministry of Land Infrastructure and Transport');

// link item
define('_WEBLINKS_TIME_PUBLISH', 'Ora Pubblicazione');
define('_WEBLINKS_TIME_EXPIRE',  'Ora Scadenza');
define('_WEBLINKS_TEXTAREA',     'Textarea');

define('_WEBLINKS_WARN_TIME_PUBLISH', 'L\'ora pubblicazione non è ancora trascorsa');
define('_WEBLINKS_WARN_TIME_EXPIRE',  'L\'ora scadenza sta passando');
define('_WEBLINKS_WARN_BROKEN', 'Questo link potrebbe non essere valido');

// === 2007-02-20 ===
// forum
define('_WEBLINKS_LATEST_FORUM', 'Ultimo Forum');
define('_WEBLINKS_FORUM',  'Forum');
define('_WEBLINKS_THREAD', 'Discussione');
define('_WEBLINKS_POST',   'Messaggio');
define('_WEBLINKS_FORUM_ID',  'Forum ID');
define('_WEBLINKS_FORUM_SEL', 'Scegli Forum');
define('_WEBLINKS_COMMENT_USE',  'Usa commento XOOPS');

// aux
define('_WEBLINKS_CAT_AUX_TEXT_1', 'aux_text_1');
define('_WEBLINKS_CAT_AUX_TEXT_2', 'aux_text_2');
define('_WEBLINKS_CAT_AUX_INT_1',  'aux_int_1');
define('_WEBLINKS_CAT_AUX_INT_2',  'aux_int_2');

// captcha
define('_WEBLINKS_CAPTCHA', 'Captcha');
define('_WEBLINKS_CAPTCHA_DESC', 'Anti-Spam');
define('_WEBLINKS_ERROR_CAPTCHA','Errore: Captcha non corrispondente');
define('_WEBLINKS_ERROR', 'Errore');

// hack for multi site
define('_WEBLINKS_CAT_TITLE_JP', 'Titolo Giapponese');
define('_WEBLINKS_DISABLE_FEATURE', 'Disabilita questa funzione');
define('_WEBLINKS_REDIRECT_JP_SITE', 'Vai al sito giapponese');

// === 2007-03-25 ===
define('_WEBLINKS_ALBUM_ID',  'Album ID');
define('_WEBLINKS_ALBUM_SEL', 'Scegli Album');

// === 2007-04-08 ===
define('_WEBLINKS_GM_TYPE',  'Tipo mappa Google Map');
define('_WEBLINKS_GM_TYPE_MAP',       'Mappa');
define('_WEBLINKS_GM_TYPE_SATELLITE', 'Satellite');
define('_WEBLINKS_GM_TYPE_HYBRID',    'Hybrid');

// === 2007-08-01 ===
define('_WEBLINKS_GM_CURRENT_ADDRESS', 'Indirizzo corrente');
define('_WEBLINKS_GM_SEARCH_LIST', 'Lista risultati ricerca');


// === 2007-09-01 ===
// waiting list
define('_WEBLINKS_ADMIN_WAITING_LIST', "Lista attesa admin");
define('_WEBLINKS_USER_WAITING_LIST',  'La tua lista attesa');
define('_WEBLINKS_USER_OWNER_LIST',    'LA tua lista invii');

// submit form
define('_WEBLINKS_TIME_PUBLISH_SET', 'Imposta ora di pubblicazione');
define('_WEBLINKS_TIME_PUBLISH_DESC','Se non marcato, l\'ora di pubblicazione non sarà indicata');
define('_WEBLINKS_TIME_EXPIRE_SET',  'Imposta ora di scadenza');
define('_WEBLINKS_TIME_EXPIRE_DESC', 'Se non marcato, l\'ora di scadenza non sarà indicata');
define('_WEBLINKS_DEL_LINK_CONFIRM','Conferma per cancellare');
define('_WEBLINKS_DEL_LINK_REASON', 'Motivo della cancellazione');

}
// --- define language end ---

?>
