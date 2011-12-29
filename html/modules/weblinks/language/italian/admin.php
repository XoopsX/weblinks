<?php
// $Id: admin.php,v 1.1 2011/12/29 14:32:41 ohwada Exp $

// 2007-09-24 Luigi Trovato - Italian translation

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

// --- define language begin ---
if( !defined('WEBLINKS_LANG_AM_LOADED') ) 
{

define('WEBLINKS_LANG_AM_LOADED', 1);

define("_WEBLINKS_ADMIN_INDEX","Indice Admin");

// BUG 2931: unmatch popup menu 'preference' and index menu 'module setting'
define("_WEBLINKS_ADMIN_MODULE_CONFIG_1","Configurazione Modulo 1 (Preferenze)");

define("_WEBLINKS_ADMIN_MODULE_CONFIG_2","Configurazione Modulo 2");
//define("_WEBLINKS_ADMIN_ADDMODDEL_CATEGORY","Add, Modify, and Delete Categories");
define("_WEBLINKS_ADMIN_ADD_LINK","Aggiungi Nuovo Link");
define("_WEBLINKS_ADMIN_OTHERFUNC","Altre Funzioni");
define("_WEBLINKS_ADMIN_GOTO_ADMIN_INDEX","Vai a Indice Admin");

//======	config.php 	======
// Access Authority
define('_WEBLINKS_ADMIN_AUTH','Permessi');
define('_WEBLINKS_ADMIN_AUTH_TEXT', 'L\'amministratore ha il pieno controllo di gestione');
define('_WEBLINKS_AUTH_SUBMIT','PuÚ inviare un nuovo link');
define('_WEBLINKS_AUTH_SUBMIT_DSC','Specifica i gruppi autorizzati a inviare un nuovo link');
define('_WEBLINKS_AUTH_SUBMIT_AUTO','PuÚ approvare automaticamente i nuovi link inviati');
define('_WEBLINKS_AUTH_SUBMIT_AUTO_DSC','Specifica i gruppi il cui invio di link Ë automaticamente approvato');
define('_WEBLINKS_AUTH_MODIFY','PuÚ modificare');
define('_WEBLINKS_AUTH_MODIFY_DSC','Specifica i gruppi autorizzati a inviare richieste di modifica link');
define('_WEBLINKS_AUTH_MODIFY_AUTO','PuÚ approvare modifiche link');
define('_WEBLINKS_AUTH_MODIFY_AUTO_DSC','Specifica i gruppi autorizzati ad approvare richieste di modifica link');
define('_WEBLINKS_AUTH_RATELINK','PuÚ votare un link');
define('_WEBLINKS_AUTH_RATELINK_DSC',"Specifica i gruppi autorizzati a votare un link.<br />Questa opzione funziona solo quando Ë attiva la funzione di voto.");
define('_WEBLINKS_USE_PASSWD','Usa Autenticazione Password quando si modifica un link');
define('_WEBLINKS_USE_PASSWD_DSC','Se Ë selezionato SI, visualizza un campo Autenticazione Password, <br />per i gruppi che non sono autorizzati a inviare/approvare richieste di modifica. ');
define('_WEBLINKS_USE_RATELINK','Consenti votazioni');
define('_WEBLINKS_USE_RATELINK_DSC',"Attiva il sistema di votazione dei link.");
define('_WEBLINKS_AUTH_UPDATED', 'Permessi Aggiornati');


// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS','Impostazioni RSS/ATOM Feeds');
define('_WEBLINKS_RSS_MODE_AUTO','Auto aggiorna RSS/ATOM feeds');
define('_WEBLINKS_RSS_MODE_AUTO_DSC', "Se attivo esegue 'Auto Discovery degli url RSS/ATOM' e 'auto aggiorna' se i link inviati includono dei link RSS/ATOM. ");
define('_WEBLINKS_RSS_MODE_DATA','Dati di RSS/ATOM da mostrare');
define('_WEBLINKS_RSS_MODE_DATA_DSC', "ATOM FEED, usa i dati nella tabella Atom feed dopo il parsing. <br />XML usa i dati dalla tabella del link prima del parsing. <br />Alcuni dati possono non essere salvati nella tabella atomfeed dopo il filtraggio. ");
define('_WEBLINKS_RSS_CACHE','Tempo di cache dei RSS/ATOM feeds');
define('_WEBLINKS_RSS_CACHE_DSC', 'Misurato in ore.');
define('_WEBLINKS_RSS_LIMIT','Numero massimo di RSS/ATOM feeds');
define('_WEBLINKS_RSS_LIMIT_DSC', 'Indica il numero massimo di RSS/ATOM feeds salvati nella tabella atomfeed<br />I dati vecchi saranno cancellati se questo valore viene superato. <br />0 per illimitato. ');
define('_WEBLINKS_RSS_SITE','Sito ricerca RSS');
define('_WEBLINKS_RSS_SITE_DSC',"Indica una lista di url RSS di siti ricerca RSS. <br />Separare ciascun elemento con un a capo se se ne indica pi˘ di uno. <br />Non inserire ATOM url. ");
define('_WEBLINKS_RSS_BLACK','Black list di RSS/ATOM url');
define('_WEBLINKS_RSS_BLACK_DSC','Indica una lista di url da rifiutare nella raccolta di RSS/ATOM feeds. <br />Separare ciascun elemento con un a capo se se ne indica pi˘ di uno. <br />E\' possibile usare regular PERL expressions. ');
define('_WEBLINKS_RSS_WHITE','White list di RSS/ATOM url');
define('_WEBLINKS_RSS_WHITE_DSC','Indica una lista di url da accettare anche se corrispondenti ad una blacklist. <br />Separare ciascun elemento con un a capo se se ne indica pi˘ di uno. <br />E\' possibile usare regular PERL expression. ');
define('_WEBLINKS_RSS_URL_CHECK', 'Ci sono alcuni url link che rientrano nella blacklist. ');
define('_WEBLINKS_RSS_URL_CHECK_DSC', 'Per favore copia e incolla dalla whitelist in basso ad un form di registrazione, se necessario. ');
define('_WEBLINKS_RSS_UPDATED', 'Impostazioni RSS/ATOM aggiornate');


// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS_VIEW','Impostazioni visualizzazione RSS/ATOM Feeds');
define('_WEBLINKS_RSS_MODE_TITLE','Usa tag HTML nel titolo');
define('_WEBLINKS_RSS_MODE_TITLE_DSC', "SI visualizza i tag HTML nel titolo del link, se ce ne sono. <br />NO toglie i tag HTML dal titolo. ");
define('_WEBLINKS_RSS_MODE_CONTENT','Usa i tag HTML nel contenuto');
define('_WEBLINKS_RSS_MODE_CONTENT_DSC', "SI visualizza il contenuto dei link con i tag HTML, se ce ne sono. <br />NO toglie tutti i tag HTML dal contenuto visualizzato. ");
define('_WEBLINKS_RSS_NEW','Seleziona il numero massimo di "nuovi RSS/ATOM feeds" visualizzati nella top page');
define('_WEBLINKS_RSS_NEW_DSC', 'Inserire il numero massimo di nuovi RSS/ATOM feeds da visualizzare nella pagina principale.');
define('_WEBLINKS_RSS_PERPAGE','Seleziona il numero massimo di RSS/ATOM feeds da visualizzare nella pagina Dettagli Link e nella pagina RSS/ATOM');
define('_WEBLINKS_RSS_PERPAGE_DSC', 'Inserire il numero massimo di RSS/ATOM feeds che devono essere mostrati nella pagina RSS/ATOM. ');
define('_WEBLINKS_RSS_NUM_CONTENT','Numero di feeds con contenuto visualizzato');
define('_WEBLINKS_RSS_NUM_CONTENT_DSC', 'Inserire il numero di feed di cui visualizzare il contenuto nella pagina Dettagli Link. <br />Dei rimanenti viene visualizzato un sommario. ');
define('_WEBLINKS_RSS_MAX_CONTENT','Numero massimo di caratteri usati per il contenuto di un RSS/ATOM feed');
define('_WEBLINKS_RSS_MAX_CONTENT_DSC', 'Inserire il numero massimo di caratteri da usare per il contenuto nella pagina RSS/ATOM.  <br />Utilizzato quando "Usa i tag HTML nel contenuto" Ë "SÏ"." ');
define('_WEBLINKS_RSS_MAX_SUMMARY','Numero massimo di caratteri usati per il sommario RSS/ATOM feed');
define('_WEBLINKS_RSS_MAX_SUMMARY_DSC', 'Indicare il numero massimo di caratteri da usare per il sommario RSS/ATOM feed nella pagina principale. ');


// use link field
define('_WEBLINKS_ADMIN_POST','Impostazioni campi Link');
define('_WEBLINKS_ADMIN_POST_TEXT_1', "Non Usare significa che il campo non sar‡ visualizzato nel form di inserimento. ");
define('_WEBLINKS_ADMIN_POST_TEXT_2', "Usa significa che il campo sar‡ mostrato nell'inserimento per consentire di inserire dati nel campo ");
define('_WEBLINKS_ADMIN_POST_TEXT_3', "Obbligatorio significa che il campo DEVE essere riempito. ");
define('_WEBLINKS_NO_USE',"Non Usare");
define('_WEBLINKS_USE','Usa');
define('_WEBLINKS_INDISPENSABLE','Obbligatorio');
define('_WEBLINKS_TYPE_DESC','Usa box testo XOOPS DHTML per gli inserimenti');
define('_WEBLINKS_TYPE_DESC_DSC', 'NO usa un normale text box.<br />SI usa box testo XOOPS DHTML per il form di inserimento. ');
define('_WEBLINKS_CHECK_DOUBLE','Respingi invio di link esistenti');
define('_WEBLINKS_CHECK_DOUBLE_DSC', 'NO consente di registrare link gi‡ esistenti. <br /> SI controlla se lo stesso link esiste gi‡ nel database. ');
define('_WEBLINKS_POST_UPDATED', 'Impostazioni campi Link Field aggiornate');

// cateogry
define('_WEBLINKS_ADMIN_CAT_SET','Impostazioni Categorie');
define('_WEBLINKS_CAT_SEL', 'Numero massimo di categorie selezionabili per i link inviati');
define('_WEBLINKS_CAT_SEL_DSC', 'Indicare il numero massimo di categorie che un utente puÚ scegliere per categorizzare i link inviati');
define('_WEBLINKS_CAT_SUB','Numero di sotto categorie da visualizzare');
define('_WEBLINKS_CAT_SUB_DSC','Impostare il numero di sotto categorie visualizzate nella lista categoria sulla top page');
define('_WEBLINKS_CAT_IMG_MODE','Scegliere immagine categoria');
define('_WEBLINKS_CAT_IMG_MODE_DSC', 'NESSUNA niente immagine. <br />Folder.gif mostra folder.gif. <br />Immagine da Impostazioni mostra l\'immagine preimpostata di ciascuna categoria. ');
define("_WEBLINKS_CAT_IMG_MODE_0","NESSUNA");
define("_WEBLINKS_CAT_IMG_MODE_1","folder.gif");
define("_WEBLINKS_CAT_IMG_MODE_2","Immagine da Impostazioni");
define('_WEBLINKS_CAT_IMG_WIDTH','Larghezza max. immagine categoria');
define('_WEBLINKS_CAT_IMG_HEIGHT','Altezza max. immagine categoria');
define('_WEBLINKS_CAT_IMG_SIZE_DSC','Usate se "Immagine da Impostazioni" Ë attivo. ');
define('_WEBLINKS_CAT_UPDATED', 'Impostazioni Categorie aggiornate');


//======	cateogry_list.php 	======
define("_WEBLINKS_ADMIN_CATEGORY_MANAGE","Gestione Categorie");
define("_WEBLINKS_ADMIN_CATEGORY_LIST","Lista Categorie");
//define("_WEBLINKS_ORDER_ID"," Listed by ID");
define("_WEBLINKS_ORDER_TREE"," Elencate ad albero");
define("_WEBLINKS_CAT_ORDER","Ordine Categorie");
define("_WEBLINKS_THERE_ARE_CATEGORY","Ci sono <b>%s</b> categorie nel database");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_1","Clicca <b>ID categoria</b> per editare una categoria specifica. ");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_2","Clicca <b>Categoria padre</b> o <b>Titolo</b>, per ordinare l'elenco. ");
define("_WEBLINKS_NO_CATEGORY","Non ci sono categorie corrispondenti. ");
define("_WEBLINKS_NUM_SUBCAT","Numero di sotto categorie");
define('_WEBLINKS_ORDERS_UPDATED', 'Ordinamento categorie aggiornato');

//======	cateogry_manage.php 	======
define("_WEBLINKS_IMGURL_MAIN","URL Immagine categoria");
define("_WEBLINKS_IMGURL_MAIN_DSC1","Opzionale. <br />Le dimensioni immagine sono regolate automaticamente");
//define("_WEBLINKS_IMGURL_MAIN_DSC2","Images are for the main category only. ");

//======	link_list.php 	======
define("_WEBLINKS_ADMIN_LINK_MANAGE","Gestione Link");
define("_WEBLINKS_ADMIN_LINK_LIST","Lista link");
define("_WEBLINKS_ADMIN_LINK_BROKEN","Lista link non validi");
define("_WEBLINKS_ADMIN_LINK_ALL_ASC","Lista di tutti i link (Elencati per vecchio ID) ");
define("_WEBLINKS_ADMIN_LINK_ALL_DESC","Lista di tutti i link (Elencati per nuovo ID) ");
define("_WEBLINKS_ADMIN_LINK_NOURL","Lista dei link senza relativo URL");
define("_WEBLINKS_COUNT_BROKEN","Conta link non validi");
define("_WEBLINKS_NO_LINK","Non c'e' alcun link corrispondente. ");
define("_WEBLINKS_ADMIN_PRESENT_SAVE","Dati salvati nel database mostrati qui. ");

//======	link_manage.php 	======
//define("_WEBLINKS_USERID","User ID");
//define("_WEBLINKS_CREATE","Created");

//======	link_broken_check.php 	======
define("_WEBLINKS_ADMIN_LINK_CHECK_UPDATE","Controlla e aggiorna link");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK","Controlla link non validi");
define("_WEBLINKS_ADMIN_BROKEN_CHECK","Controlla");
define("_WEBLINKS_ADMIN_BROKEN_RESULT","Risultati Controllo");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_CAUTION","PuÚ verificarsi un timeout, se ci sono molti link non validi. <br />Nel caso, per favore cambiare il valore numerico di limite e offset. <br />limite= 0, oppure Nessuna Restrizione.");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_NOTICE","Cliccando il <b>link ID</b> si apre la pagina di modifica link. <br /><b>Website URL</b> porter‡ al sito web del link se cliccato. <br />");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_GOOGLE","Cliccando su <b>titolo website</b> si aprir‡ Google Search. <br />");
define("_WEBLINKS_ADMIN_LIMIT","Massimo di link da controllare (limite)");
define("_WEBLINKS_ADMIN_OFFSET","Offset (offset)");
define("_WEBLINKS_ADMIN_CHECK","CONTROLLA");
define("_WEBLINKS_ADMIN_TIME_START","Ora inizio");
define("_WEBLINKS_ADMIN_TIME_END","Ora fine");
define("_WEBLINKS_ADMIN_TIME_ELAPSE","Tempo impiegato");
define("_WEBLINKS_ADMIN_LINK_NUM_ALL","Tutti i link");
define("_WEBLINKS_ADMIN_LINK_NUM_CHECK","Link controllati");
define("_WEBLINKS_ADMIN_LINK_NUM_BROKEN","Link non validi");
define("_WEBLINKS_ADMIN_NUM","links");
define("_WEBLINKS_ADMIN_MIN_SEC","%s min %s sec");
define("_WEBLINKS_ADMIN_CHECK_NEXT","Controlla i prossimi %s link");
//define("_WEBLINKS_ADMIN_RSS_REFRESH_NOTE","Simultaneously execute an Auto Discovery of RSS/ATOM urls ");

//======	rss_manage.php 	======
define("_WEBLINKS_ADMIN_RSS_MANAGE","Gestione RSS/ATOM feed");
define("_WEBLINKS_ADMIN_RSS_REFRESH","Refresh RSS/ATOM");
define("_WEBLINKS_ADMIN_RSS_REFRESH_LINK","Refresh cache dati link");
define("_WEBLINKS_ADMIN_RSS_REFRESH_SITE","Refresh cache sito ricerca RSS");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_URL","Numero di RSS/ATOM urls refreshed");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_SITE","Numero di RSS/ATOM sites refreshed url");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOM_SITE","Numero di RSS/ATOM site refreshed");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOMFEED","Numero di RSS/ATOM feeds refreshed");
define("_WEBLINKS_ADMIN_RSS_CACHE_CLEAR","Azzera cache RSS/ATOM feed");
define("_WEBLINKS_RSS_CLEAR_NUM","Azzera cache degli RSS/ATOM feed in ordine di data, se vi sono pi˘ feed di quelli specificati in Configurazione Modulo 1.");
define("_WEBLINKS_RSS_NUMBER","Numero di feed");
define("_WEBLINKS_RSS_CLEAR_LID","Azzera cache dei link ID specificati");
define("_WEBLINKS_RSS_CLEAR_ALL","Azzera tutta la cache");
define("_WEBLINKS_NUM_RSS_CLEAR_LINK","Numero di cache RSS/ATOM azzerate");
define("_WEBLINKS_NUM_RSS_CLEAR_ATOMFEED","Numero di ATOM/RSS feed azzerati");

//======	user_list.php 	======
define("_WEBLINKS_ADMIN_USER_MANAGE", "Gestione Utenti");
define("_WEBLINKS_ADMIN_USER_EMAIL", "Lista degli utenti con indirizzi Email");
define("_WEBLINKS_ADMIN_USER_LINK", "Lista degli utenti registrati che hanno informazioni link");
define("_WEBLINKS_ADMIN_USER_NOLINK", "Lista degli utenti registrati privi di informazioni link");
define("_WEBLINKS_ADMIN_USER_EMAIL_DSC", "Mostra un solo indirizzo Email se duplicato");
//define("_WEBLINKS_ADMIN_USER_LINK_DSC", 'Use "Send Message to Users" of XOOPS core');
//define("_WEBLINKS_USER_ALL", " (all) ");
//define("_WEBLINKS_USER_MAX", " (each %s persons) ");
define("_WEBLINKS_THERE_ARE_USER", "<b>%s</b> utenti trovati");
define("_WEBLINKS_USER_NUM", "Mostra da %s \^ persona a %s \^ persona.");
define("_WEBLINKS_USER_NOFOUND", "Nessun Utente Trovato");
define("_WEBLINKS_UID_EMAIL", "Indirizzo Email del submitter");

//======	mail_users.php 	======
define("_WEBLINKS_ADMIN_SENDMAIL", "Invia Email");
define("_WEBLINKS_THERE_ARE_EMAIL","Ci sono <b>%s</b> e-mails");
define("_WEBLINKS_SEND_NUM", "Invia email dalla %s \^ persona alla %s \^ persona");
define("_WEBLINKS_SEND_NEXT","Invia le prossime %s email");
define("_WEBLINKS_SUBJECT_FROM", "Informazioni da %s");
define("_WEBLINKS_HELLO", "Salve %s");
define("_WEBLINKS_MAIL_TAGS1","{W_NAME} rappresenta il nome utente");
define("_WEBLINKS_MAIL_TAGS2","{W_EMAIL} rappresenta l'email dell'utente");
define("_WEBLINKS_MAIL_TAGS3","{W_LID} rappresenta il link-id dell'utente");

// general
define('_WEBLINKS_WEBMASTER', 'Webmaster');
define('_WEBLINKS_SUBMITTER', 'Submitter');
//define("_WEBLINKS_MID","Modify ID");
define("_WEBLINKS_UPDATE","APPLICA");
define("_WEBLINKS_SET_DEFAULT","Setta default");
define("_WEBLINKS_CLEAR","AZZERA");
define("_WEBLINKS_CHECK","CONTROLLA");
define("_WEBLINKS_NON","Nessuna operazione");
define("_WEBLINKS_SENDMAIL", "INVIA Email");

// 2005-08-09
// BUG 2827: RSS refresh: Invalid argument supplied for foreach()
define("_WEBLINKS_ADMIN_NO_LINK_BROKEN_CHECK","Non ci sono link da controllare");
define("_WEBLINKS_ADMIN_NO_RSS_REFRESH","Non ci sono link RSS da aggiornare");

// 2005-10-20
define("_WEBLINKS_LINK_APPROVED", "Il tuo link Ë stato approvato");
define("_WEBLINKS_LINK_REFUSED", "Il tuo link Ë stato respinto");

// 2006-05-15
define('_AM_WEBLINKS_INDEX_DESC','Testo Introduttivo Pagina Principale');
define('_AM_WEBLINKS_INDEX_DESC_DSC', 'Puoi usare questa sezione per visualizzare un testo descrittivo o introduttivo. E\' consentito l\'uso di HTML.');
define('_AM_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Qui va la tua introduzione pagine.<br />Puoi editarlo in "Configurazione Modulo 2".<br /></div>');

define('_AM_WEBLINKS_ADD_CATEGORY', 'Aggiungi Nuova Categoria');
define('_AM_WEBLINKS_ERROR_SOME', 'Ci sono alcuni messaggi di errore');
define('_AM_WEBLINKS_LIST_ID_ASC',  'Elencati per Vecchio ID');
define('_AM_WEBLINKS_LIST_ID_DESC', 'Elencati per Nuovo ID');

// config
define('_AM_WEBLINKS_WARNING_NOT_WRITABLE','La directory non Ë scrivibile');
define('_AM_WEBLINKS_CONF_LINK','Configurazione Link');
define('_AM_WEBLINKS_CONF_LINK_IMAGE','Configurazione Immagini Link');
define('_AM_WEBLINKS_CONF_VIEW','Visualizza Configurazione');
define('_AM_WEBLINKS_CONF_TOPTEN','Configurazione TopTen');
define('_AM_WEBLINKS_CONF_SEARCH','Configurazione Ricerca');

define('_AM_WEBLINKS_USE_BROKENLINK','Segnalazione Link Non Validi');
define('_AM_WEBLINKS_USE_BROKENLINK_DSC','SI autorizza gli utenti a segnalare i link non validi');
define('_AM_WEBLINKS_USE_HITS','Conta reports');
define('_AM_WEBLINKS_USE_HITS_DSC','SI attiva un contatore link non validi');
define('_AM_WEBLINKS_USE_PASSWD','Autenticazione con password');
define('_AM_WEBLINKS_USE_PASSWD_DSC','SI, gli <b>utenti anonimi</b> possono modificare un link autenticandosi con password.<br />NO, <br />il campo password non viene visualizzato.');
define('_AM_WEBLINKS_PASSWD_MIN','Lunghezza minima password richiesta');
define('_AM_WEBLINKS_POST_TEXT', 'L\'amministratore ha la piena autorit‡ di gestione');
define('_AM_WEBLINKS_AUTH_DOHTML', 'Permesso di usare tag HTML');
define('_AM_WEBLINKS_AUTH_DOHTML_DSC', 'Specifica i gruppo autorizzati a usare tag HTML');
define('_AM_WEBLINKS_AUTH_DOSMILEY', 'Permesso di usare faccine');
define('_AM_WEBLINKS_AUTH_DOSMILEY_DSC', 'Specifica i gruppi autorizzati a usare faccine');
define('_AM_WEBLINKS_AUTH_DOXCODE', 'Permesso di usare codici XOOPS');
define('_AM_WEBLINKS_AUTH_DOXCODE_DSC', 'Specifica i gruppi autorizzati a usare codici XOOPS');
define('_AM_WEBLINKS_AUTH_DOIMAGE', 'Permesso di usare immagini');
define('_AM_WEBLINKS_AUTH_DOIMAGE_DSC', 'Specifica i gruppi autorizzati a usare immagini');
define('_AM_WEBLINKS_AUTH_DOBR', 'Permesso di usare linebreaks');
define('_AM_WEBLINKS_AUTH_DOBR_DSC', 'Specifica i gruppi autorizzati a usare linebreak');
define('_AM_WEBLINKS_SHOW_CATLIST','Mostra lista categorie in submenu');
define('_AM_WEBLINKS_SHOW_CATLIST_DSC','SI mostra la lista categorie principali nei submenu');
define('_AM_WEBLINKS_VIEW_URL','Stile visualizzazione URL');
define('_AM_WEBLINKS_VIEW_URL_DSC','NESSUNO <br />nessun url o tag &lt;a&gt; viene visualizzato.<br />Indiretto<br /> visualizza visit.php nel campo href invece di URL. <br />Diretto <br />visualizza URL in campo HREF, JavaScript nel campo onmousedown e numero visite conteggiato tramite JavaScript.');
define('_AM_WEBLINKS_VIEW_URL_0','NESSUNO');
define('_AM_WEBLINKS_VIEW_URL_1','URL Indiretto');
define('_AM_WEBLINKS_VIEW_URL_2','URL Diretto');
define('_AM_WEBLINKS_RECOMMEND_PRI','Priorit‡ dei Siti Raccomandati');
define('_AM_WEBLINKS_RECOMMEND_PRI_DSC','NESSUNA <br />Non visualizzare.<br />Normale <br />Siti Raccomandati visualizzati nell\'header.<br />Alta <br />Visualizza Siti Raccomandati all\'inizio della rispettiva categoria.');
define('_AM_WEBLINKS_MUTUAL_PRI','Priorit‡ dei Siti Reciprochi');
define('_AM_WEBLINKS_MUTUAL_PRI_DSC','NESSUNA <br />Non visualizzare.<br />Normale <br />Siti Reciprochi visualizzati nell\'header.<br />Alta <br />Visualizza Siti Reciprochi all\'inizio delle rispettive categorie.');
define('_AM_WEBLINKS_PRI_0','NESSUNA');
define('_AM_WEBLINKS_PRI_1','Normale');
define('_AM_WEBLINKS_PRI_2','Alta');
define('_AM_WEBLINKS_LINK_IMAGE_AUTO','Auto aggiorna dimensione immagine Banner');
define('_AM_WEBLINKS_LINK_IMAGE_AUTO_DSC', "SI <br />aggiorna dimensione immagine Banner automaticamente.");
define('_AM_WEBLINKS_RSS_USE','Usa RSS feed');
define('_AM_WEBLINKS_RSS_USE_DSC','SI <br />Scarica e visualizza RSS/ATOM feed.');

// bulk import
define('_AM_WEBLINKS_BULK_IMPORT','Bulk Import');
define('_AM_WEBLINKS_BULK_IMPORT_FILE','Bulk Import da File');
define('_AM_WEBLINKS_BULK_CAT','Bulk Import delle Categorie');
define('_AM_WEBLINKS_BULK_CAT_DSC1','Descrivi categorie');
define('_AM_WEBLINKS_BULK_CAT_DSC2','Usa parentesi acuta chiusa (>) all\'inizio della categoria per definirla come sotto categoria.');
define('_AM_WEBLINKS_BULK_LINK','Bulk Import dei Link');
define('_AM_WEBLINKS_BULK_LINK_DSC1', 'Inserisci una categoria sulla prima riga.');
define('_AM_WEBLINKS_BULK_LINK_DSC2', 'Descrivi titolo link, URL, e spiegazione separati da virgole(,) sulla seconda riga.');
define('_AM_WEBLINKS_BULK_LINK_DSC3', 'Usa trattini per separare i link con una barra orizzontale (---) .');
define('_AM_WEBLINKS_BULK_ERROR_LAYER','Specified two or more under layers at the category tree structure. This need clarification G.S.');
define('_AM_WEBLINKS_BULK_ERROR_CID','ID categoria errato');
define('_AM_WEBLINKS_BULK_ERROR_PID','ID categoria padre errato');
define('_AM_WEBLINKS_BULK_ERROR_FINISH','Un errore ha bloccato l\'operazione');

// command
define('_AM_WEBLINKS_CREATE_CONFIG', 'Crea Config File');
define('_AM_WEBLINKS_TEST_EXEC', 'Esecuzione di prova per %s');

// === 2006-10-05 ===
// menu
define('_AM_WEBLINKS_MODULE_CONFIG_3','Configurazione Modulo 3');
define('_AM_WEBLINKS_MODULE_CONFIG_4','Configurazione Modulo 4');
define('_AM_WEBLINKS_VOTE_LIST', 'Lista Voti');
define('_AM_WEBLINKS_CATLINK_LIST', 'Lista Link Categorizzati');
define('_AM_WEBLINKS_COMMAND_MANAGE', 'Gestione Comandi');
define('_AM_WEBLINKS_TABLE_MANAGE',  'Gestione Tabella DB');
define('_AM_WEBLINKS_IMPORT_MANAGE', 'Gestione Import');
define('_AM_WEBLINKS_EXPORT_MANAGE', 'Gestione Export');

// config
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_2','Aut., Cat, etc');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_3','Link');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_4','RSS, Forum, Mappe');
define('_AM_WEBLINKS_LINK_REGISTER','Impostazioni Link: Descrizione');

// bin configuration
define('_AM_WEBLINKS_FORM_BIN', 'Config Comandi');
define('_AM_WEBLINKS_FORM_BIN_DESC', 'E\' usato su bin command');
define('_AM_WEBLINKS_CONF_BIN_PASS','Password');
//define('_AM_WEBLINKS_CONF_BIN_PASS_DESC','');
define('_AM_WEBLINKS_CONF_BIN_SEND','Invia Mail');
//define('_AM_WEBLINKS_CONF_BIN_SEND_DESC','');
define('_AM_WEBLINKS_CONF_BIN_MAILTO','Email a cui inviare');
//define('_AM_WEBLINKS_CONF_BIN_MAILTO_DESC','');

// rssc
//define('_AM_WEBLINKS_RSS_DIRNAME','RSSC Module Dirname');
//define('_AM_WEBLINKS_RSS_DIRNAME_DESC','');

// link manage
define('_AM_WEBLINKS_DEL_LINK', 'Cancella link');
define('_AM_WEBLINKS_ADD_RSSC', 'Aggiungi link Add link nel modulo RSSC');
define('_AM_WEBLINKS_MOD_RSSC', 'Modifica link nel modulo RSSC');
define('_AM_WEBLINKS_REFRESH_RSSC', 'Refresh link nel modulo RSSC');
define('_AM_WEBLINKS_APPROVE',     'Approva Nuovo Link');
define('_AM_WEBLINKS_APPROVE_MOD', 'Approva Richiesta Modifica Link');
define('_AM_WEBLINKS_RSSC_LID_SAVED', 'Rssc lid salvato');
define('_AM_WEBLINKS_GOTO_LINK_LIST', 'Vai a lista link');
define('_AM_WEBLINKS_GOTO_LINK_EDIT', 'Vai a edita link');
define('_AM_WEBLINKS_ADD_BANNER', 'Aggiungi dim. immagine banner');
define('_AM_WEBLINKS_MOD_BANNER', 'Mod dim. immagine banner');

// vote list
define('_AM_WEBLINKS_VOTE_USER', 'Voti Utenti Registrati');
define('_AM_WEBLINKS_VOTE_ANON', 'Voti Utenti Anonimi');

// locate
define('_AM_WEBLINKS_CONF_LOCATE','Localizza Configurazione');
define('_AM_WEBLINKS_CONF_COUNTRY_CODE','Codice Nazione');
define('_AM_WEBLINKS_CONF_COUNTRY_CODE_DESC', 'Inserire codice ccTLD <br/> <a href="http://www.iana.org/cctld/cctld-whois.htm" target="_blank">IANA: Country-Code Top-Level Domains</a>');
define('_AM_WEBLINKS_CONF_RENEW_COUNTRY_CODE_DESC', 'Refresh elemento legato al country code. <br/> L\'elemento con il segno <span style="color:#0000ff;">#</span>');
define('_AM_WEBLINKS_RENEW', 'Rinnova');

// map
define('_AM_WEBLINKS_CONF_MAP','Configurazione Sito Mappe');
define('_AM_WEBLINKS_CONF_MAP_USE','Usa Sito Mappe');
define('_AM_WEBLINKS_CONF_MAP_TEMPLATE','Template del Sito Mappe');
define('_AM_WEBLINKS_CONF_MAP_TEMPLATE_DESC','Inserire nome file template nella directory template/map/');

// google map: hacked by wye <http://never-ever.info/>
define('_AM_WEBLINKS_CONF_GOOGLE_MAP','Configurazione Google Maps');
define('_AM_WEBLINKS_CONF_GM_USE','Usa Google Maps');
define('_AM_WEBLINKS_CONF_GM_APIKEY','Google Maps API key');
define('_AM_WEBLINKS_CONF_GM_APIKEY_DESC', 'Ottieni API key da <br/> <a href="http://www.google.com/apis/maps/signup.html" target="_blank">http://www.google.com/apis/maps/signup.html</a> <br/> Se si usa GoogleMaps.' );
define('_AM_WEBLINKS_CONF_GM_SERVER','Nome Server');
define('_AM_WEBLINKS_CONF_GM_LANG',  'Language Code');
define('_AM_WEBLINKS_CONF_GM_LOCATION', 'Localit‡ default');
define('_AM_WEBLINKS_CONF_GM_LATITUDE', 'Latitudine default');
define('_AM_WEBLINKS_CONF_GM_LONGITUDE','Longitudine default');
define('_AM_WEBLINKS_CONF_GM_ZOOM',     'Livello Zoom default');

// google search
define('_AM_WEBLINKS_CONF_GOOGLE_SEARCH','Configurazione Google Search');
define('_AM_WEBLINKS_CONF_GOOGLE_SERVER','Nome Server');
define('_AM_WEBLINKS_CONF_GOOGLE_LANG',  'Language Code');

// template
define('_AM_WEBLINKS_CONF_TEMPLATE','Azzera cache dei Template');
define('_AM_WEBLINKS_CONF_TEMPLATE_DESC','NECESSARIO eseguire, quando si cambia file di template nelle directory template/parts/ template/xml/ e template/map/');

// === 2006-12-11 ===
// link item
define('_AM_WEBLINKS_TIME_PUBLISH','Imposta ora di pubblicazione');
define('_AM_WEBLINKS_TIME_PUBLISH_DESC','Se non impostato, l\'ora di pubblicazione non viene specificata');
define('_AM_WEBLINKS_TIME_EXPIRE','Imposta ora di scadenza');
define('_AM_WEBLINKS_TIME_EXPIRE_DESC','Se non impostato, l\'ora di scadenza non viene specificata');
define('_AM_WEBLINKS_LINK_TIME_PUBLISH_BEFORE','Lista link prima dell\'ora di pubblicazione');
define('_AM_WEBLINKS_LINK_TIME_EXPIRE_AFTER',  'Lista link dopo dell\'ora di scadenza');

define('_AM_WEBLINKS_SERVER_ENV','Ambiente Server ');
define('_AM_WEBLINKS_DEBUG_CONF','Variabili Debug');
define('_AM_WEBLINKS_ALL_GREEN','Tutto Verde');

// === 2007-02-20 ===
// performance
define('_AM_WEBLINKS_UPDATE_CAT_PATH','Aggiorna albero percorso categorie');
define('_AM_WEBLINKS_UPDATE_CAT_COUNT','Aggiorna conteggio categorie link');
define('_AM_WEBLINKS_CAT_COUNT_UPDATED','Albero percorsi categorie aggiornato');

// config
define('_AM_WEBLINKS_SYSTEM_POST_LINK','Conta Post su invio link');
define('_AM_WEBLINKS_SYSTEM_POST_LINK_DSC','SI incrementa il contatore dei post dell\'utente XOOPS quando viene inviato un nuovo link. ');
define('_AM_WEBLINKS_SYSTEM_POST_RATE','Conta Post su voto link');
define('_AM_WEBLINKS_SYSTEM_POST_RATE_DSC','SI incrementa il contatore dei post dell\'utente XOOPS quanto viene votato un link. ');

define('_AM_WEBLINKS_VIEW_STYLE_CAT','Stile visualizzazione in ogni categoria');
define('_AM_WEBLINKS_VIEW_STYLE_MARK','Stile visualizzazione nei siti raccomandati');
define('_AM_WEBLINKS_VIEW_STYLE_MARK_DSC','Si applica ai Siti Raccomandati, Siti Reciproci, Siti RSS/ATOM');
define('_AM_WEBLINKS_VIEW_STYLE_0','Sommario');
define('_AM_WEBLINKS_VIEW_STYLE_1','Dettaglio Completo');

define('_AM_WEBLINKS_CONF_PERFORMANCE','Incremento prestazioni');
define('_AM_WEBLINKS_CONF_PERFORMANCE_DSC','Per migliorare le prestazioni, i dati necessari vengono calcolati prima della visualizzazione, e salvati nel database.<br />Alla prima attivazione, eseguire "Lista categorie" -> "Aggiorna albero percorsi categorie"');
define('_AM_WEBLINKS_CAT_PATH','Albero percorsi categorie');
define('_AM_WEBLINKS_CAT_PATH_DSC','SI memorizza nella tabella categorie l\'albero percorsi calcolato in anticipo.<br />NO calcola albero durante visualizzazione.');
define('_AM_WEBLINKS_CAT_COUNT','Conta link per categoria');
define('_AM_WEBLINKS_CAT_COUNT_DSC','SI memorizza nella tabella categorie il conteggio dei link.<br />NO calcola durante la visualizzazione.');

define('_AM_WEBLINKS_POST_TEXT_4', 'Tutti gli elementi sono visualizzati in pagina admin');
define('_AM_WEBLINKS_LINK_REGISTER_1','Impostazioni link: Textarea1');

define('_AM_WEBLINKS_CONF_LINK_GUEST','Configurazione Elem. Link Register');
define('_AM_WEBLINKS_USE_CAPTCHA','Usa CAPTCHA');
define('_AM_WEBLINKS_USE_CAPTCHA_DSC','CAPTCHA Ë una tecnica di anti-spam.<br />Questa opzione richiede il modulo Captcha.<br />SI, <b>utenti anonimi</b> devono usare CAPTCHA quando aggiungono o modificano link.<br />NO non mostrare campi CAPTCHA.');
define('_AM_WEBLINKS_CAPTCHA_FINDED',     'Trovato modulo Captcha ver %s');
define('_AM_WEBLINKS_CAPTCHA_NOT_FINDED', 'Modulo Captcha non trovato');

define('_AM_WEBLINKS_CONF_SUBMIT', 'Descrizione Form Link Register');
define('_AM_WEBLINKS_SUBMIT_MAIN',    'Descrizione di aggiungi nuovo link: 1');
define('_AM_WEBLINKS_SUBMIT_PENDING', 'Descrizione di aggiungi nuovo link: 2');
define('_AM_WEBLINKS_SUBMIT_DOUBLE',  'Descrizione di aggiungi nuovo link: 3');
define('_AM_WEBLINKS_SUBMIT_MAIN_DSC',   'Mostra sempre');
define('_AM_WEBLINKS_SUBMIT_PENDING_DSC','Mostra in modalit‡ "approvazione admin richiesta"');
define('_AM_WEBLINKS_SUBMIT_DOUBLE_DSC', 'Mostra in modalit‡ "controlla link gi‡ esistente"');

define('_AM_WEBLINKS_MODLINK_MAIN',     'Descrizione di modifica link: 1');
define('_AM_WEBLINKS_MODLINK_PENDING',  'Descrizione di modifica link: 2');
define('_AM_WEBLINKS_MODLINK_NOT_OWNER','Descrizione di modifica link: 3');
define('_AM_WEBLINKS_MODLINK_NOT_OWNER_DSC','Mostra se in modalit‡ "approvazione admin richiesta" e non Ë il proprietario');

define('_AM_WEBLINKS_CONF_CAT_FORUM', 'Mostra Forum in Categoria');
define('_AM_WEBLINKS_CONF_LINK_FORUM', 'Mostra Forum in Link');
//define('_AM_WEBLINKS_FORUM_SEL', 'Select Forum module');
define('_AM_WEBLINKS_FORUM_THREAD_LIMIT', 'Numero di Thread mostrati');
define('_AM_WEBLINKS_FORUM_POST_LIMIT', 'Numero di Post mostrati in ciascun Thread');
define('_AM_WEBLINKS_FORUM_POST_ORDER', 'Ordine dei Post');
define('_AM_WEBLINKS_FORUM_POST_ORDER_0', 'Data post pi˘ vecchio');
define('_AM_WEBLINKS_FORUM_POST_ORDER_1', 'Data post pi˘ recente');
//define('_AM_WEBLINKS_FORUM_INSTALLED',     'Forum module ( %s ) ver %s is installed');
//define('_AM_WEBLINKS_FORUM_NOT_INSTALLED', 'Forum module ( %s ) is not installed');

// === 2007-03-25 ===
define('_AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE','Aggiorna dim. immagine categoria');

define('_AM_WEBLINKS_CONF_INDEX', 'Configurazione Pagina Indice');
define('_AM_WEBLINKS_CONF_INDEX_GM_MODE', 'Modalit‡ Google Map');

define('_AM_WEBLINKS_CAT_SHOW_GM',   'Mostra Google map');
define('_AM_WEBLINKS_MODE_NON',       'Non mostrare');
define('_AM_WEBLINKS_MODE_DEFAULT',   'Valore di default');
define('_AM_WEBLINKS_MODE_PARENT',    'Come categoria padre');
define('_AM_WEBLINKS_MODE_FOLLOWING', 'valore seguente');

define('_AM_WEBLINKS_CONF_CAT_ALBUM',  'Mostra Album in Categoria');
define('_AM_WEBLINKS_CONF_LINK_ALBUM', 'Mostra Album in Link');
//define('_AM_WEBLINKS_ALBUM_SEL', 'Select Album module');
define('_AM_WEBLINKS_ALBUM_LIMIT', 'Numero di foto mostrate');
define('_AM_WEBLINKS_WHEN_OMIT', 'Process when omit');

define('_AM_WEBLINKS_MODULE_INSTALLED', 'Modulo %s ( %s ) ver %s installato');
define('_AM_WEBLINKS_MODULE_NOT_INSTALLED', 'Modulo %s ( %s ) non installato');

// === 2007-04-08 ===
define('_AM_WEBLINKS_CAT_DESC_MODE',  'Mostra Descrizione');
define('_AM_WEBLINKS_CAT_SHOW_FORUM', 'Mostra Forum');
define('_AM_WEBLINKS_CAT_SHOW_ALBUM', 'Mostra Album');
define('_AM_WEBLINKS_MODE_SETTING',   'Valore settaggio');
define('_AM_WEBLINKS_MODE_OMIT_PARENT', 'Come categoria padre se omesso');

// === 2007-06-10 ===
// d3forum
define('_AM_WEBLINKS_CONF_D3FORUM', 'Integrazione commenti con modulo d3forum');
define('_AM_WEBLINKS_PLUGIN_SEL',   'Scelta Plugin');
define('_AM_WEBLINKS_DIRNAME_SEL',  'Scelta Modulo');

// category
define('_AM_WEBLINKS_CAT_PATH_STYLE', 'Stile visualizzazione del percorso Categoria');

// category page
define('_AM_WEBLINKS_CONF_CAT_PAGE', 'Impostazioni Pagina Categorie');
define('_AM_WEBLINKS_CAT_COLS', 'Numero di Colonne in Categorie');
define('_AM_WEBLINKS_CAT_COLS_DESC', 'Nella pagina categorie, specifica il numero di colonne, nel mostrare le categorie al di sotto di una gerarchia');
define('_AM_WEBLINKS_CAT_SUB_MODE', 'Range di visual. delle Sotto Categorie');
define('_AM_WEBLINKS_CAT_SUB_MODE_1', 'Solo le categorie inferiori di un livello');
define('_AM_WEBLINKS_CAT_SUB_MODE_2', 'Tutte le categorie inferiori di uno e pi˘ livelli');

// === 2007-07-14 ===
// highlight
define('_AM_WEBLINKS_USE_HIGHLIGHT', 'Usa Evidenziazione keyword');
define('_AM_WEBLINKS_CHECK_MAIL', 'Controlla Formato Email');
define('_AM_WEBLINKS_CHECK_MAIL_DSC', 'NO consente qualsiasi formato. <br /> SI controlla che formato email sia del tipo abc@efg.com quanso si registra un link. ');
define('_AM_WEBLINKS_NO_EMAIL', 'Non settare indirizzo Email');

// === 2007-08-01 ===
// config
define('_AM_WEBLINKS_MODULE_CONFIG_0','Configurazione Modulo');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_0','Indice');
define('_AM_WEBLINKS_MODULE_CONFIG_5','Configurazione Modulo 5');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_5','Link Register Item');
define('_AM_WEBLINKS_MODULE_CONFIG_6','Configurazione Modulo 6');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_6','Google Map');

// google map
define('_AM_WEBLINKS_GM_MAP_CONT',  'Controlli Mappa');
define('_AM_WEBLINKS_GM_MAP_CONT_DESC',  'GLargeMapControl, GSmallMapControl, GSmallZoomControl');
define('_AM_WEBLINKS_GM_MAP_CONT_NON',   'Non mostrare');
define('_AM_WEBLINKS_GM_MAP_CONT_LARGE', 'Large Control');
define('_AM_WEBLINKS_GM_MAP_CONT_SMALL', 'Small Control');
define('_AM_WEBLINKS_GM_MAP_CONT_ZOOM',  'Zoom Control');
define('_AM_WEBLINKS_GM_USE_TYPE_CONT',  'Usa Controlli Tipo Mappa');
define('_AM_WEBLINKS_GM_USE_TYPE_CONT_DESC',  'GMapTypeControl');
define('_AM_WEBLINKS_GM_USE_SCALE_CONT',  'Usa Controlli Scala');
define('_AM_WEBLINKS_GM_USE_SCALE_CONT_DESC',  'GScaleControl');
define('_AM_WEBLINKS_GM_USE_OVERVIEW_CONT',  'Usa Controlli Overview Map');
define('_AM_WEBLINKS_GM_USE_OVERVIEW_CONT_DESC',  'GOverviewMapControl');
define('_AM_WEBLINKS_GM_MAP_TYPE', '[Ricerca] Tipo Mappa');
define('_AM_WEBLINKS_GM_MAP_TYPE_DESC', 'GMapType');
define('_AM_WEBLINKS_GM_GEOCODE_KIND',  '[åüçı] Tipo di Geocode');
define('_AM_WEBLINKS_GM_GEOCODE_KIND_DESC',  'Cerca latitudine e longitudine da indirizzo<br /><b>Risultato singolo</b><br />GClientGeocoder - getLatLng<br /><b>Pi˘ risultati</b><br />GClientGeocoder - getLocations');
define('_AM_WEBLINKS_GM_GEOCODE_KIND_LATLNG', 'Risultato singolo: getLatLng');
define('_AM_WEBLINKS_GM_GEOCODE_KIND_LOCATIONS',   'Pi˘ risultati: getLocations');
define('_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO',  '[Ricerca][Giappone] Usa CSIS');
define('_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO_DESC',  'Valido in Giappone<br />Cerca latitudine e longitudine da indirizzo');
define('_AM_WEBLINKS_GM_USE_NISHIOKA',  '[Ricerca][giappone] Usa Geocode Inverso');
define('_AM_WEBLINKS_GM_USE_NISHIOKA_DESC',  'Valido in Giappone<br />Cerca indirizzo da longitudine e latitudine<br /><a href="http://nishioka.sakura.ne.jp/google/" target="_blank">http://nishioka.sakura.ne.jp/google/</a>');
define('_AM_WEBLINKS_GM_TITLE_LENGTH',  '[Marker] Max caratteri per titolo');
define('_AM_WEBLINKS_GM_TITLE_LENGTH_DESC',  'Num. max di caratteri per Titolo nel marker<br /><b>-1</b> Ë illimitato');
define('_AM_WEBLINKS_GM_DESC_LENGTH',  '[Marker] Max caratteri per contenuto');
define('_AM_WEBLINKS_GM_DESC_LENGTH_DESC',  'Num. max caratteri usati per contenuto nel marker<br /><b>-1</b> Ë illimitato');
define('_AM_WEBLINKS_GM_WORDWRAP',  '[Marker] Max caratteri per a capo');
define('_AM_WEBLINKS_GM_WORDWRAP_DESC',  'Num. max caratteri usati in ogni riga (a capo automatico) nel marker<br /><b>-1</b> Ë illimitato');
define('_AM_WEBLINKS_GM_USE_CENTER_MARKER',  '[Marker] Mostra il marker centrale');
define('_AM_WEBLINKS_GM_USE_CENTER_MARKER_DESC',  'Mostra il marker centrale in Pagina Principale e Pagina Categorie');

// map jp
define('_AM_WEBLINKS_MAP_JP_MANAGE', 'Configurazione Mappa Giappone');

// column
define('_AM_WEBLINKS_COLUMN_MANAGE', 'Gestione Colonne');
define('_AM_WEBLINKS_COLUMN_MANAGE_DESC', 'Aggiungi colonne etc in tabella link e tabella modifica');
define('_AM_WEBLINKS_COLUMN_MANAGE_NOT_USE', 'Non Usare');
define('_AM_WEBLINKS_THERE_ARE_COLUMN', 'Ci sono <b>%s</b> colonne etc nella tabella link');
define('_AM_WEBLINKS_COLUMN_NUM', 'Numero di colonne etc aggiunte');
define('_AM_WEBLINKS_COLUMN_BIGGER_USE', 'Il numero di colonne etc Ë maggiore del numero in tabella link');
define('_AM_WEBLINKS_COLUMN_UNMATCH',  'Le colonne non corrispondono in tabella link e tabella modifica');
define('_AM_WEBLINKS_PHPMYADMIN',  'Correggere tramite uno strumento di gestione, ad es. phpMyAdmin');
define('_AM_WEBLINKS_LINK_NUM_ETC', 'Il numero di colonne etc');

// latest
define('_AM_WEBLINKS_INDEX_MODE_LATEST', 'Ordine di Link Recenti');
define('_AM_WEBLINKS_INDEX_MODE_LATEST_UPDATE', 'Data Aggiornamento');
define('_AM_WEBLINKS_INDEX_MODE_LATEST_CREATE', 'Data Creazione');

// header
define('_AM_WEBLINKS_CONF_HTML_STYLE', 'Configurazione Stile HTML');
define('_AM_WEBLINKS_HEADER_MODE', 'Usa xoops module header');
define('_AM_WEBLINKS_HEADER_MODE_DESC', 'Se "No", mostra style sheet e Javascript in body tag<br />Se "Si", li mostra nell\'header tag, usando xoops module header<br />PuÚ non funzionare con alcuni temi');

// bulk
define('_AM_WEBLINKS_BULK_SAMPLE','Per vedere un esempio cliccare il bottone esempio');
define('_AM_WEBLINKS_BULK_LINK_DSC10','Register items corretti');
define('_AM_WEBLINKS_BULK_LINK_DSC20','Admin specifica register items');
define('_AM_WEBLINKS_BULK_LINK_DSC21','Primo paragrafo');
define('_AM_WEBLINKS_BULK_LINK_DSC22','Secondo paragrafo, e seguenti');
define('_AM_WEBLINKS_BULK_LINK_DSC23','Inserire nomi register item sulla prima linea.<br />Inserire horizontal bar (---)');
define('_AM_WEBLINKS_BULK_LINK_DSC24','Descrivere register items, secondo ordine del primo paragrafo, separati da virgole(,) sulla seconda linea.');
define('_AM_WEBLINKS_BULK_CHECK_URL','Attiva per settare URL');
define('_AM_WEBLINKS_BULK_CHECK_DESCRIPTION','Attiva per settare descrizione');


// === 2007-09-01 ===
// auth
define('_AM_WEBLINKS_AUTH_DELETE','PuÚ cancellare');
define('_AM_WEBLINKS_AUTH_DELETE_DSC','Specificare gruppi autorizzati a inviare richieste cancellazione link');
define('_AM_WEBLINKS_AUTH_DELETE_AUTO','PuÚ approvare cancellazione link');
define('_AM_WEBLINKS_AUTH_DELETE_AUTO_DSC','Specifica gruppi autorizzati ad approvare richieste cancellazione link');

// nofitication
define('_AM_WEBLINKS_NOTIFICATION_MANAGE', 'Gestione Notifiche');
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_DESC', 'Impostazione per ciascun amministratore modulo<br />E\' lo stesso della pagina top del modulo');
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_NOT_USE', "Non utilizzabile in alcune versioni di XOOPS");
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_PLEASE', 'Nel caso, per favore usare le impostazioni nella top page del modulo');
define('_AM_WEBLINKS_SUBJ_LINK_MOD_APPROVED', '[{X_SITENAME}] {X_MODULE}: La tua richiesta modifica link Ë stata approvata');
define('_AM_WEBLINKS_SUBJ_LINK_MOD_REFUSED',  '[{X_SITENAME}] {X_MODULE}: La tua richiesta modifica link Ë stata respinta');
define('_AM_WEBLINKS_SUBJ_LINK_DEL_APPROVED', '[{X_SITENAME}] {X_MODULE}: La tua richiesta cancellazione link Ë stata approvata');
define('_AM_WEBLINKS_SUBJ_LINK_DEL_REFUSED',  '[{X_SITENAME}] {X_MODULE}: La tua richiesta cancellazione link Ë stata rifiutata');

// config
define('_AM_WEBLINKS_ADMIN_WAITING_SHOW', 'Mostra lista attesa admin');
define('_AM_WEBLINKS_USER_WAITING_NUM',   'Num. di link in lista attesa utente');
define('_AM_WEBLINKS_USER_OWNER_NUM',     'Num. di link in lista invii utente');
define('_AM_WEBLINKS_USE_HITS_SINGLELINK','Conteggia hits quando mostra singolo link');
define('_AM_WEBLINKS_USE_HITS_SINGLELINK_DSC','SI abilita conteggio hit del link quando viene eseguito mostra singolo link');
define('_AM_WEBLINKS_MODE_RANDOM', 'Redirect of random jump');
define('_AM_WEBLINKS_MODE_RANDOM_URL', 'url sito registrato');
define('_AM_WEBLINKS_MODE_RANDOM_SINGLE', 'singolo link in questo modulo');

// request list
define('_AM_WEBLINKS_DEL_REQS', 'Cancellazioni Link in attesa di verifica');
define('_AM_WEBLINKS_NO_DEL_REQ','Nessuna richiesta cancellazione link');
define('_AM_WEBLINKS_DEL_REQ_DELETED','Richiesta cancellazione eliminata');

// link list
define('_AM_WEBLINKS_LINK_USERCOMMENT_DESC','Lista link con commento per admin (Elencati per nuovo ID)');

// clone
define('_AM_WEBLINKS_CLONE_LINK', 'Clona');
define('_AM_WEBLINKS_CLONE_MODULE', 'Clona ad altro modulo');
define('_AM_WEBLINKS_CLONE_CONFIRM', 'Conferma clonazione');
define('_AM_WEBLINKS_NO_MODULE', 'Non esiste il modulo corrispondente');

// link form
define('_AM_WEBLINKS_MODIFIED', 'Modificato');
define('_AM_WEBLINKS_CHECK_CONFIRM', 'Confermato');
define('_AM_WEBLINKS_WARN_CONFIRM', 'Attenzione: Marca per "Confermato" di %s');
define('_AM_WEBLINKS_RSSC_LID_EXIST_MORE', 'Ci sono due o pi˘ link che hanno lo stesso "RSSC ID"');

// web shot
define('_AM_WEBLINKS_LINK_IMG_THUMB', 'Sostituto dell\'immagine link');
define('_AM_WEBLINKS_LINK_IMG_THUMB_DSC', 'mostra miniatura sito WEB invece di immagine link, <br />usando thumbnail web service, <br />se immagine link non impostata.');
define('_AM_WEBLINKS_LINK_IMG_NON', 'nessuno');
define('_AM_WEBLINKS_LINK_IMG_MOZSHOT', 'Usa <a href="http://mozshot.nemui.org/" target="_blank">MozShot</a>');
define('_AM_WEBLINKS_LINK_IMG_SIMPLEAPI', 'Usa <a href="http://img.simpleapi.net/" target="_blank">SimpleAPI</a>');

}
// --- define language begin ---

?>
