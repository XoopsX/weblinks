<?php
// $Id: modinfo.php,v 1.1 2011/12/29 14:32:48 ohwada Exp $

// 2005-10-20 K.OHWADA
// BUG 3111: timeout occurs in popular site if many top categories
// 2005-01-20 K.OHWADA
// add _MI_WEBLINKS_NEWDAYS
// delete _MI_WEBLINKS_RSS_NEW

// 2004-11-28 K.OHWADA
// add _MI_WEBLINKS_BNAME5
// delete _MI_WEBLINKS_POST

// 2004-11-20 K.OHWADA
// update of admin menu

// 2004-10-24 K.OHWADA
// broken link check
// URL-less mode
// category list block 
// admin can change the display number of subcategory
// description_type
// ratelink_use
// RSS/ATOM URL

// 2004-10-19 cb750
// translation for V0.7

// $Id: modinfo.php,v 1.1 2011/12/29 14:32:48 ohwada Exp $

//=========================================================
// language for Module Info
//=========================================================

//---------------------------------------------------------
// same as mylinks
//---------------------------------------------------------
// The name of this module
define("_MI_WEBLINKS_NAME","Liens Web");

// A brief description of this module
define("_MI_WEBLINKS_DESC","Cr&eacute;ation d'une section de liens web où les utilisateurs peuvent rechercher/soumettre/coter diff&eacute;rents sites web.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_WEBLINKS_BNAME1","Liens r&eacute;cents");
define("_MI_WEBLINKS_BNAME2","Top des liens");
define("_MI_WEBLINKS_BNAME3","Liens populaires");

// Sub menu titles
define("_MI_WEBLINKS_SMNAME1","Soumettre");
define("_MI_WEBLINKS_SMNAME2","Sites populaires");
define("_MI_WEBLINKS_SMNAME3","Top des sites les mieux not&eacute;s");

// Names of admin menu items
define("_MI_WEBLINKS_ADMENU1","Configuration du Module 2");
define("_MI_WEBLINKS_ADMENU2","Gestion des cat&eacute;gories");
define("_MI_WEBLINKS_ADMENU3","Gestion des liens");
define("_MI_WEBLINKS_ADMENU4","Ajout de nouveaux lienx");
define("_MI_WEBLINKS_ADMENU5","Nouveaux liens en attente de validation");
define("_MI_WEBLINKS_ADMENU6","Modifications de liens en attente de validation");
define("_MI_WEBLINKS_ADMENU7","Rapport de liens bris&eacute;s");
//define("_MI_WEBLINKS_ADMENU8","Contr&ocirc;le des liens");

//-------------------------------------
// Title of config items
// Description of each config items
//-------------------------------------
define('_MI_WEBLINKS_POPULAR', 'S&eacute;lectionnez le nombre de clics pour qu\'un lien soit marqu&eacute; comme populaire');
define('_MI_WEBLINKS_POPULARDSC', 'Entrez le nombre minimum de clics pour afficher l\'icone "POPULAIRE". <br /> Lorsque vous s&eacute;lectionnez 0, vous ne montrez pas cette icone. ');
define('_MI_WEBLINKS_NEWLINKS', 'S&eacute;lectionnez le nombre maximum de nouveaux liens &agrave; montrer sur la page d\'accueil');

//define('_MI_WEBLINKS_NEWLINKSDSC', 'Entrez le nombre maximum de nouveaux liens &agrave; monter dans le bloc "Nouveaux liens". ');
define('_MI_WEBLINKS_NEWLINKSDSC', 'Entrez le nombre maximum de liens &agrave; montrer sur la page principale. ');

define('_MI_WEBLINKS_PERPAGE', 'S&eacute;lectionnez le nombre maximum de liens affich&eacute;s sur chaque page');
define('_MI_WEBLINKS_PERPAGEDSC', 'Entrez le nombre maximum de liens qui doivent &ecirc;tre montr&eacute;s en d&eacute;tail par page');

//define('_MI_WEBLINKS_USESHOTS', 'S&eacute;lectionnez oui pour montrer une image de copie d\&eacute;cran pour chaque lien');
//define('_MI_WEBLINKS_USESHOTSDSC', '');
//define('_MI_WEBLINKS_SHOTWIDTH', 'Largeur maximum pour chaque copie d\&eacute;cran');
//define('_MI_WEBLINKS_SHOTWIDTHDSC', '');

//define('_MI_WEBLINKS_ANONPOST','Autoriser les utilisateurs anonymes &agrave; proposer des liens ?');
//define('_MI_WEBLINKS_AUTOAPPROVE','Auto aprouver les nouveaux liens sans intervention des administrateurs ?');
//define('_MI_WEBLINKS_AUTOAPPROVEDSC','');

//-------------------------------------
// Text for notifications
//-------------------------------------
define('_MI_WEBLINKS_GLOBAL_NOTIFY', 'Globales');
define('_MI_WEBLINKS_GLOBAL_NOTIFYDSC', 'Options de notification globales des liens.');

define('_MI_WEBLINKS_CATEGORY_NOTIFY', 'Cat&eacute;gorie');
define('_MI_WEBLINKS_CATEGORY_NOTIFYDSC', 'Options de notification &agrave; appliquer &agrave; la cat&eacute;gorie de liens courante.');

define('_MI_WEBLINKS_LINK_NOTIFY', 'Lien');
define('_MI_WEBLINKS_LINK_NOTIFYDSC', 'Options de notification &agrave; appliquer au lien courant.');

define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFY', 'Nouvelle cat&eacute;gorie');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Notifiez-moi lorsqu\'une nouvelle cat&eacute;gorie de liens est cr&eacute;&eacute;e.');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Recevoir une notification quand un nouvelle cat&eacute;gorie de liens est cr&eacute;&eacute;e.');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notification : Nouvelle cat&eacute;gorie de lien');

define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFY', 'Demande de modification de lien');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYCAP', 'Notifiez-moi toute demande de modification de lien.');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYDSC', 'Recevoir une notification &agrave; toute demande de modification de lien.');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notification : Demande de modification de lien');

define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFY', 'Soumission de lien bris&eacute;');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYCAP', 'Notifiez-moi tout rapport de lien bris&eacute;.');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYDSC', 'Recevoir une notification quand un rapport de lien bris&eacute; est soumis.');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notification : Rapport de lien bris&eacute;');

define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFY', 'Nouveau lien soumis');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYCAP', 'Notifiez-moi toute soumission de nouveau lien (en attente d\'approbation).');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYDSC', 'Recevoir une notification quand un nouveau lien est soumis (an attente d\'approbation).');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notification : Soumission de lien nouveau');

define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFY', 'Nouveau lien');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYCAP', 'Notifiez-moi la publication de tout nouveau lien.');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYDSC', 'Recevoir une notification lors de toute publication de nouveau lien.');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notification : Nouveau lien');

define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFY', 'Nouveau lien soumis');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYCAP', 'Notifiez-moi lorsqu\'un nouveau lien est soumis (en attente d\'appprobation) dans la cat&eacute;gorie courante.');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYDSC', 'Recevoir une notification quand un nouveau lien est soumis (en attente d\'appprobation) dans la cat&eacute;gorie courante.');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notification : Soumission d\'un nouveau lien dans la cat&eacute;gorie');

define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFY', 'Nouveau lien');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYCAP', 'Notifiez-moi lorqu\'un nouveau lien est publi&eacute; dans la cat&eacute;gorie courante.');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYDSC', 'Recevoir une notification quand un nouveau lien est publi&eacute; dans la cat&eacute;gorie courante.');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notification : Nouveau lien publi&eacute; dans la cat&eacute;gorie');

define('_MI_WEBLINKS_LINK_APPROVE_NOTIFY', 'Approbation de lien');
define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYCAP', 'Notifiez moi-lorsque ce lien est approuv&eacute;.');
define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYDSC', 'Recevoir une notification quand ce lien sera approuv&eacute;.');
define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notification : Approbation de lien');


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
// === Names of blocks for this module ===
define("_MI_WEBLINKS_BNAME4","Cat&eacute;gorie de liste de liens Web");
define("_MI_WEBLINKS_BNAME5","Derniers fils RSS/ATOM de liens Web");
define("_MI_WEBLINKS_BNAME6","Montrer le blog des liens Web");

//-------------------------------------
// Title of config items
//-------------------------------------
define('_MI_WEBLINKS_LOGOSHOW','Montrer l\'image du logo du module');
define('_MI_WEBLINKS_LOGOSHOWDSC', 'S&eacute;lectionnez "Oui" pour montrer l\'image du logo du module.');

define('_MI_WEBLINKS_TITLESHOW','Montrer le titre du module');
define('_MI_WEBLINKS_TITLESHOWDSC', 'S&eacute;lectionnez "OUI" pour montrer le titre du module');

define('_MI_WEBLINKS_NEWDAYS', 'S&eacute;lectionnez le nombre de jours pendant lesquels les liens seront consid&eacute;r&eacute;s comme nouveaux');
define('_MI_WEBLINKS_NEWDAYS_DSC', 'Entrez le nombre de clics n&eacute;cessaires pour afficher l\'icone "Nouveau". <br /> Si vous s&eacute;lectionnez 0, l\'icone ne sera pas montr&eacute;e. ');

define('_MI_WEBLINKS_DESCSHORT', 'Nombre maximum de caract&egrave;res &agrave; utiliser dans la fiche de description des liens');
define('_MI_WEBLINKS_DESCSHORTDSC', 'Entrez le nombre maximum de caract&egrave;res &agrave; utiliser dans la fiche de description des liens. ');

define('_MI_WEBLINKS_ORDERBY', 'Valeur de tri par d&eacute;faut pour le d&eacute;tail des liens montr&eacute;s');
define('_MI_WEBLINKS_ODERBYTDSC', 'Entrez la valeur de tri par d&eacute;faut dans les d&eacute;tails des liens affich&eacute;s.');
define("_MI_WEBLINKS_ORDERBY0","Titre (A &agrave; Z)");
define("_MI_WEBLINKS_ORDERBY1","Titre (Z &agrave; A)");
define("_MI_WEBLINKS_ORDERBY2","Date (Ordre d'enregistrement chronologique)");
define("_MI_WEBLINKS_ORDERBY3","Date (Ordre d'enregistrement r&eacute;cursif)");
define("_MI_WEBLINKS_ORDERBY4","Notation (Ordre croisant)");
define("_MI_WEBLINKS_ORDERBY5","Notation (Ordre d&eacute;croissant)");
define("_MI_WEBLINKS_ORDERBY6","Popularit&eacute; (ordre croissant)");
define("_MI_WEBLINKS_ORDERBY7","Popularit&eacute; (ordre d&eacute;croissant)");

define('_MI_WEBLINKS_SEARCH_LINKS','Nombre de liens montr&eacute;s dans la page de r&eacute;sultat des recherches');
define('_MI_WEBLINKS_SEARCH_LINKSDSC', 'Entrez le nombre maximum de liens &agrave; montrer dans la page de r&eacute;sultat des recherches');

define('_MI_WEBLINKS_SEARCH_MIN', 'Nombre de lettres minimum pour la recherche par mot');
define('_MI_WEBLINKS_SEARCH_MINDSC', 'Entrez le nombre minimum de lettres pour la recherche par mot ');

define('_MI_WEBLINKS_USEFRAMES', 'D&eacute;sirez vous montrer la page li&eacute;e dans une frame ?');
define('_MI_WEBLINKS_USEFRAMEDSC', 'Montre la page du lien dans une frame');

define('_MI_WEBLINKS_BROKEN','Nombre de comptabilisation de liens bris&eacute;s n&eacute;cessaire pour en arr&ecirc;ter l\'affichage');
define('_MI_WEBLINKS_BROKENDSC', 'Entrez le nombre de comptabilisations de liens bris&eacute;s n&eacute;cessaires pour en arr&ecirc;ter l\'affichage. <br /> En dessous de cette valeur cet &eacute;tat sera consid&eacute;r&eacute; comme une erreur temporaire, et il n\'y aura pas de cons&eacute;quences. <br />Au dessus de cette valeur num&eacute;rique, cet &eacute;tat sera consid&eacute;r&eacute; comme une erreur fixe, et l\'affichage sera interrompu.');

define('_MI_WEBLINKS_LISTIMAGE_USE','Utiliser des images de liens pour une liste de liens');
define('_MI_WEBLINKS_LISTIMAGE_WIDTH','Largeur maximale de l\'image de lien');
define('_MI_WEBLINKS_LISTIMAGE_HEIGHT','Hauteur maximale de l\'image de lien');
define('_MI_WEBLINKS_LISTIMAGE_USEDSC', 'S&eacute;lectionnez "OUI" pour montrer des images de liens quand une liste de liens est visualis&eacute;e');

define('_MI_WEBLINKS_LINKIMAGE_USE','Utiliser une image de lien dans la visualisation des d&eacute;tails des liens');
define('_MI_WEBLINKS_LINKIMAGE_WIDTH','Largeur maximale de l\'image &agrave; montrer dans les d&eacute;tails du lien');
define('_MI_WEBLINKS_LINKIMAGE_HEIGHT','Hauteur maximale de l\'image &agrave; montrer dans les d&eacute;tails du lien');
define('_MI_WEBLINKS_LINKIMAGE_USEDSC', 'S&eacute;lectionnez "OUI" pour montrer les images de liens quand les d&eacute;tails des liens sont visualis&eacute;s.');

// 2005-10-20 K.OHWADA
define('_MI_WEBLINKS_TOPTEN_STYLE','Style du top 10');
define('_MI_WEBLINKS_TOPTEN_STYLE_DSC', 'S&eacute;lectionnez le style dans "Sites Populaires" et "Sites les Mieux Not&eacute;s". ');
define('_MI_WEBLINKS_TOPTEN_STYLE_0','chaque top cat&eacute;gorie');
define('_MI_WEBLINKS_TOPTEN_STYLE_1','m&eacute;langer toutes les cat&eacute;gories');

define('_MI_WEBLINKS_TOPTEN_LINKS', 'Nombre maximum de liens Top10');
define('_MI_WEBLINKS_TOPTEN_LINKS_DSC', 'Entrer le nombre maximum de liens &agrave; afficher dans "Sites Populaires" et "Sites les Mieux Not&eacute;s". ');

define('_MI_WEBLINKS_TOPTEN_CATS','Nombre maximum de cat&eacute;gories dans le Top10');
define('_MI_WEBLINKS_TOPTEN_CATS_DSC', 'Entrer le nombre maximum de cat&eacute;gories &agrave; afficher dans "Sites Populaires" et "Sites les Mieux Not&eacute;s". <br />un timeout apparait lorsqu\'il y a trop de cat&eacute;gories principales');

?>