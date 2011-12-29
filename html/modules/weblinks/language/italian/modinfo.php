<?php
// $Id: modinfo.php,v 1.1 2011/12/29 14:32:41 ohwada Exp $

// 2007-09-24 Luigi Trovato - Italian translation

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

// --- define language begin ---
if( !defined('WEBLINKS_LANG_MI_LOADED') ) 
{

define('WEBLINKS_LANG_MI_LOADED', 1);

//---------------------------------------------------------
// same as mylinks
//---------------------------------------------------------
// The name of this module
define("_MI_WEBLINKS_NAME","Web Links");

// A brief description of this module
define("_MI_WEBLINKS_DESC","Crea una directory di link web dove gli utenti possono ricercare/inserire/votare i vari siti listati.");

// Names of blocks for this module (Not all module have blocks)
define("_MI_WEBLINKS_BNAME1","Link Recenti");
define("_MI_WEBLINKS_BNAME2","Top Link");
define("_MI_WEBLINKS_BNAME3","Link Popolari");

// Sub menu titles
define("_MI_WEBLINKS_SMNAME1","Invia");
define("_MI_WEBLINKS_SMNAME2","Sito Popolare");
define("_MI_WEBLINKS_SMNAME3","Sito più votato");

// Names of admin menu items
define("_MI_WEBLINKS_ADMENU1","Configurazione Modulo 2");
define("_MI_WEBLINKS_ADMENU2","Gestione Categorie");
define("_MI_WEBLINKS_ADMENU3","Gestione Link");
define("_MI_WEBLINKS_ADMENU4","Aggiungi Nuovo Link");
define("_MI_WEBLINKS_ADMENU5","Nuovi Link in attesa di verifica");
define("_MI_WEBLINKS_ADMENU6","Link Modificati in attesa di verifica");
define("_MI_WEBLINKS_ADMENU7","Report Link non validi");
//define("_MI_WEBLINKS_ADMENU8","Link Checker");

//-------------------------------------
// Title of config items
// Description of each config items
//-------------------------------------
define('_MI_WEBLINKS_POPULAR', 'Num. di hits necessari perchè un link sia marcato come Popolare');
define('_MI_WEBLINKS_POPULARDSC', 'Inserire il num. minimo di hit richiesti per mostrare l\'icona "POPULAR". <br />  Se 0, non mostra alcuna icona. ');
define('_MI_WEBLINKS_NEWLINKS', 'Num. max di nuovi link mostrati sulla pagina principale');

//define('_MI_WEBLINKS_NEWLINKSDSC', 'Enter the maximum number of links to be displayed in the "New Links" block. ');
define('_MI_WEBLINKS_NEWLINKSDSC', 'Inserire il num massimo di link da visualizzare nella pagina principale. ');

define('_MI_WEBLINKS_PERPAGE', 'Num. max di link mostrati in ogni pagina');
define('_MI_WEBLINKS_PERPAGEDSC', 'Inserire il num. massimo di link da mostrare con i dettagli per ciascuna pagina.');

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
define('_MI_WEBLINKS_GLOBAL_NOTIFY', 'Globale');
define('_MI_WEBLINKS_GLOBAL_NOTIFYDSC', 'Opzioni globali notifica link.');

define('_MI_WEBLINKS_CATEGORY_NOTIFY', 'Categoria');
define('_MI_WEBLINKS_CATEGORY_NOTIFYDSC', 'Opzioni notifica da applicare alla categoria link corrente.');

define('_MI_WEBLINKS_LINK_NOTIFY', 'Link');
define('_MI_WEBLINKS_LINK_NOTIFYDSC', 'Opzioni notifica da applicare al link corrente.');

define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFY', 'Nuova Categoria');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Notificami quando una nuova categoria link viene creata.');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Ricevi una notifica quando una nuova categoria link viene creata.');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Nuova categoria link');

define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFY', '[Admin] Richiesta modifica link');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYCAP', '[Admin] Notificami ogni richiesta modifica link.');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYDSC', 'Ricevi notifica quando una richiesta modifica link viene inviata.');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Richiesta modifica link');

define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFY', '[Admin] Inviato Link non valido');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYCAP', '[Admin] Notificami ogni report link non valido.');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYDSC', 'Ricevi notifica quando viene inviato un link non valido.');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Link non valido');

define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFY', '[Admin] Invio nuovo link');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYCAP', '[Admin] Notificami quando un nuovo link viene inviato (in attesa di approvazione).');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYDSC', 'Ricevi notifica quando un nuovo link viene inviato (in attesa di approvazione).');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Nuovo link inviato');

define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFY', 'Nuovo Link');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYCAP', 'Notificami quando un nuovo link viene pubblicato.');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYDSC', 'Ricevi notifica quando un nuovo link viene pubblicato (dopo approvazione).');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Nuovo link');

define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFY', '[Admin] Nuovo link inviato');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYCAP', '[Admin] Notificami quando un nuovo link viene inviato (in attesa di approvazione) nella categoria corrente.');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYDSC', 'Ricevi notifica quando un nuovo link viene inviato (in attesa di approvazione) nella categoria corrente.');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Nuovo link inviato in categoria');

define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFY', 'Nuovo Link');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYCAP', 'Notificami quando un nuovo link viene pubblicato nella categoria corrente.');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYDSC', 'Ricevi notifica quando un nuovo link viene pubblicato nella categoria corrente.');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Nuovo link in categoria');

define('_MI_WEBLINKS_LINK_APPROVE_NOTIFY', 'Link Approvato');
define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYCAP', 'Notificami quando questo link viene approvato.');
define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYDSC', 'Ricevi notifica quando questo link viene approvato.');
define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Link approvato');


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
// === Names of blocks for this module ===
define("_MI_WEBLINKS_BNAME4","Lista categorie Web links");
define("_MI_WEBLINKS_BNAME5","Ultimi RSS/ATOM feeds di Web links");
define("_MI_WEBLINKS_BNAME6","Mostra blog di Web links");

//-------------------------------------
// Title of config items
//-------------------------------------
define('_MI_WEBLINKS_LOGOSHOW','Visualizza immagine logo modulo');
define('_MI_WEBLINKS_LOGOSHOWDSC', 'Scegli "SI" per visualizzare immagine logo modulo.');

define('_MI_WEBLINKS_TITLESHOW','Visualizza titolo modulo');
define('_MI_WEBLINKS_TITLESHOWDSC', 'Scegli "SI" per visualizzare titolo modulo');

define('_MI_WEBLINKS_NEWDAYS', 'Scegli per quanti giorni i link sono marcati come nuovi');
define('_MI_WEBLINKS_NEWDAYS_DSC', 'Inserire num. di giorni per cui mostrare icona "NEW". <br /> Se 0, nessuna icona mostrata. ');

define('_MI_WEBLINKS_DESCSHORT', 'Num. max di caratteri usati per spiegazione lista link ');
define('_MI_WEBLINKS_DESCSHORTDSC', 'Inserire il num. max di caratteri da usare per spiegazione lista link. ');

define('_MI_WEBLINKS_ORDERBY', 'Ordinamento per Visual. dettaglio link');
define('_MI_WEBLINKS_ORDERBYDSC', 'Indica l\'ordinamento di default per Visual. dettaglio link.');
define("_MI_WEBLINKS_ORDERBY0","Titolo (A > Z)");
define("_MI_WEBLINKS_ORDERBY1","Titolo (Z > A)");
define("_MI_WEBLINKS_ORDERBY2","Data (Registrazione in ordine ascendente)");
define("_MI_WEBLINKS_ORDERBY3","Date (Registrazione in ordine discendente)");
define("_MI_WEBLINKS_ORDERBY4","Voti (ordine ascendente)");
define("_MI_WEBLINKS_ORDERBY5","Voti (ordine discendente)");
define("_MI_WEBLINKS_ORDERBY6","Popolarità (ordine ascendente)");
define("_MI_WEBLINKS_ORDERBY7","Popolarità (ordine discendente)");

define('_MI_WEBLINKS_SEARCH_LINKS','Num. di link visualizzati su pagina risultati ricerca');
define('_MI_WEBLINKS_SEARCH_LINKSDSC', 'Inserire il num. max di link da visualizzare nella pagina risultati ricerca');

define('_MI_WEBLINKS_SEARCH_MIN', 'Num. minimo di lettere per keyword ricerca');
define('_MI_WEBLINKS_SEARCH_MINDSC', 'Inserire il num. minimo di caratteri per ule keyword di ricerca ');

define('_MI_WEBLINKS_USEFRAMES', 'Vuoi visualizzare la pagina linkata in un frame?');
define('_MI_WEBLINKS_USEFRAMEDSC', 'Scegli se visualizzare la pagina di destinazione del link dentro un frame');

define('_MI_WEBLINKS_BROKEN','Numero rapporti Link non valido prima di bloccare visualizzazione');
define('_MI_WEBLINKS_BROKENDSC', 'Inserire quante volte il link deve essere riportato come non valido prima di bloccarne la visual. <br /> Sotto questo valore, sarà considerato errore temporaneo, e nulla verrà fatto. <br />Oltre questo valore il link non sarà più visualizzato.');

define('_MI_WEBLINKS_LISTIMAGE_USE','Usa immagini link per lista link');
define('_MI_WEBLINKS_LISTIMAGE_WIDTH','Max larghezza immagine link');
define('_MI_WEBLINKS_LISTIMAGE_HEIGHT','Max lunghezza immagine link');
define('_MI_WEBLINKS_LISTIMAGE_USEDSC', 'Scegli "SI" per mostrare immagini link in visual. lista link');

define('_MI_WEBLINKS_LINKIMAGE_USE','Usa immagini link in visual. dettagli link');
define('_MI_WEBLINKS_LINKIMAGE_WIDTH','Max larghezza immagine in visual. dettagli link');
define('_MI_WEBLINKS_LINKIMAGE_HEIGHT','Max lunghezza immagine in visual. dettagli link');
define('_MI_WEBLINKS_LINKIMAGE_USEDSC', 'Scegli "SI" per mostrare immagini link nelle visual. dettagli link.');

// 2005-10-20 K.OHWADA
define('_MI_WEBLINKS_TOPTEN_STYLE','Stile della topten');
define('_MI_WEBLINKS_TOPTEN_STYLE_DSC', 'Scegli stile in "Siti Popolari" e "Siti più votati". ');
define('_MI_WEBLINKS_TOPTEN_STYLE_0','Top di ogni categoria');
define('_MI_WEBLINKS_TOPTEN_STYLE_1','Misto: Tutte le categorie');

define('_MI_WEBLINKS_TOPTEN_LINKS', 'Num. max link in topten');
define('_MI_WEBLINKS_TOPTEN_LINKS_DSC', 'Inserire il num. max di link da visual. in "Siti Popolari" e "Siti più votati". ');

define('_MI_WEBLINKS_TOPTEN_CATS','Num. max categorie in topten');
define('_MI_WEBLINKS_TOPTEN_CATS_DSC', 'Inserire il num. max di categorie da visual. in "Siti Popolari" e "Siti più votati". <br />Può esserci un timeout se si selezionano troppe categorie');

// 2006-03-26
// REQ 3807: Main Page Introductory Text
//define('_MI_WEBLINKS_INDEX_DESC','Main Page Introductory Text');
//define('_MI_WEBLINKS_INDEX_DESC_DSC', 'You can use this section to display some descriptive or introductory text. HTML is allowed.');
define('_MI_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center"><font color="blue">Qui va la tua presentazione pagina.<br />Puoi editarla in "Configurazione Modulo 2".</font><br /></div>');

// 2006-05-15
define('_MI_WEBLINKS_ADMENU0', 'Indice');

// 2006-11-03
// random block
define('_MI_WEBLINKS_BNAME_RANDOM',  'Link casuale');
define('_MI_WEBLINKS_BNAME_GENERIC', 'Blocco Link Generico');

// 2007-04-08
define('_MI_WEBLINKS_BNAME_RANDOM_PHOTO', 'Foto casuale');


// 2007-09-01
// notification: new_link_admin
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN', '[Admin] Nuovo link (con commento per admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_CAP', '[Admin] Notificami quando un nuovo link viene postato (con commento per admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_DSC', 'Ricevi notifica quando un nuovo link viene postato (con commento per admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_SBJ', '[{X_SITENAME}] {X_MODULE} auto-notifica : Nuovo link');

// notification: new_link_comment
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT', '[Admin] Nuovo link (se contiene commento per admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_CAP', '[Admin] Notificami quando un nuovo link viene postato (se contiene commento per admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_DSC', 'Ricevi notifica quando un nuovo link viene postato (se contiene commento per admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_SBJ', '[{X_SITENAME}] {X_MODULE} auto-notifica : Nuovo link)');

}
// --- define language begin ---

?>
