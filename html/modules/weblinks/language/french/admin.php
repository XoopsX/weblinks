<?php
// $Id: admin.php,v 1.1 2011/12/29 14:32:48 ohwada Exp $

// 2005-10-20 K.OHWADA
// REQ 3028: send apoval email to anonymous user

// 2005-09-01 K.OHWADA
// BUG 2931: unmatch popup menu 'prefrence' and index menu 'module setting'

// 2005-08-09
// BUG 2827: RSS refresh: Invalid argument supplied for foreach()
// _WEBLINKS_ADMIN_NO_LINK_BROKEN_CHECK, others

// 2005-01-20 K.OHWADA
// add link field, RSS/ATOM view, user_list, mail_user

// 2004-11-28 K.OHWADA
// config.php, etc

//=========================================================
// language for admin
// 2004-10-20 K.OHWADA
//=========================================================

define("_WEBLINKS_ADMIN_INDEX","Retour Page d'Accueil Administration");

// BUG 2931: unmatch popup menu 'prefrence' and index menu 'module setting'
define("_WEBLINKS_ADMIN_MODULE_CONFIG_1","Configuration du Module I");

define("_WEBLINKS_ADMIN_MODULE_CONFIG_2","Configuration du Module II");
define("_WEBLINKS_ADMIN_ADDMODDEL_CATEGORY","Ajout, Modification, et Suppression de Cat&eacute;gories");
define("_WEBLINKS_ADMIN_ADD_LINK","Ajout d'un nouveau lien");
define("_WEBLINKS_ADMIN_OTHERFUNC","Autres fonctions");
define("_WEBLINKS_ADMIN_GOTO_ADMIN_INDEX","Aller &agrave; l'index de l'Admin");

//======	config.php 	======
// Access Authority
define('_WEBLINKS_ADMIN_AUTH',"Param&eacute;trage des autorisations d'acc&egrave;s");
define('_WEBLINKS_ADMIN_AUTH_TEXT', "L'administrateur a toutes les autorisations");
define('_WEBLINKS_AUTH_SUBMIT','Autorisation de proposer un nouveau lien');
define('_WEBLINKS_AUTH_SUBMIT_DSC',"Sp&eacute;cifier le groupe qui est autoris&eacute; &agrave; proposer un lien.");
define('_WEBLINKS_AUTH_SUBMIT_AUTO',"Autorisation d'approbation automatique de nouveau lien");
define('_WEBLINKS_AUTH_SUBMIT_AUTO_DSC',"Sp&eacute;cifier le groupe dont les soumissions de nouveaux liens seront automatiquement approuv&eacute;es.");
define('_WEBLINKS_AUTH_MODIFY','Autorisation de modifier un lien');
define('_WEBLINKS_AUTH_MODIFY_DSC',"Sp&eacute;cifier le groupe qui est autoris&eacute; &agrave; modifier un lien.");
define('_WEBLINKS_AUTH_MODIFY_AUTO',"Autorisation d'approuver un lien modifi&eacute;");
define('_WEBLINKS_AUTH_MODIFY_AUTO_DSC',"Sp&eacute;cifier le groupe dont les modifications de liens seront automatiquement approuv&eacute;es.");
define('_WEBLINKS_AUTH_RATELINK','Autoriser le vote de lien');
define('_WEBLINKS_AUTH_RATELINK_DSC',"Sp&eacute;cifier le groupe qui est autoris&eacute; &agrave; noter un lien.<br />Actif si 'Autoriser le vote de lien' est &agrave; la valeur OUI.");
define('_WEBLINKS_USE_PASSWD','Demande de mot de passe lors de la modification de lien');
define('_WEBLINKS_USE_PASSWD_DSC','Si OUI est s&eacute;lectionn&eacute;,une demande de mot de passe sera &eacute;mise lors de la modification de lien. <br />Si NON, les liens modifi&eacute;s seront approuv&eacute;s automatiquement. ');
define('_WEBLINKS_USE_RATELINK','Utiliser le vote  lien');
define('_WEBLINKS_USE_RATELINK_DSC',"Si OUI est s&eacute;lectionn&eacute;, 'Utiliser la notation de lien' et 'R&eacute;sultat de la notation' sont affich&eacute;s.");
define('_WEBLINKS_AUTH_UPDATED', "Param&egrave;tres des autorisations d'acc&egrave;s mis &agrave; jour");

// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS','Param&eacute;trage des fils RSS/ATOM');
define('_WEBLINKS_RSS_MODE_AUTO','Mise &agrave; jour automatique des fils RSS/ATOM');
define('_WEBLINKS_RSS_MODE_AUTO_DSC', "Si OUI est s&eacute;lectionn&eacute;, la 'mise &agrave; jour automatique' et 'l'auto-d&eacute;tection des URL des fils RSS/ATOM', s'effectuent lors de l'affichage du d&eacute;tail des informations d'un lien. ");
define('_WEBLINKS_RSS_MODE_DATA','Donn&eacute;es des fils RSS/ATOM &agrave; afficher');
define('_WEBLINKS_RSS_MODE_DATA_DSC', "Lorsque 'FIL ATOM' est s&eacute;lectionn&eacute;, utilise les donn&eacute;es dans la table fil atom apr&egrave;s l'analyse. <br />Lorsque 'XML' est s&eacute;lectionn&eacute;, utilise les donn&eacute;es dans la table de liens avant l'analyse. <br />Quelques donn&eacute;es peuvent ne pas &ecirc;tre sauv&eacute;es dans la table fil atom depuis le filtrage. ");
define('_WEBLINKS_RSS_CACHE','Temps de cache pour les fils RSS/ATOM');
define('_WEBLINKS_RSS_CACHE_DSC', "L'unit&eacute; de param&eacute;trage est l'heure.");
define('_WEBLINKS_RSS_LIMIT','Nombre maximum de fils RSS/ATOM');
define('_WEBLINKS_RSS_LIMIT_DSC', 'Saisir le nombre maximum de fils RSS/ATOM sauvegard&eacute;s dans la table fil atom<br />La table sera purg&eacute;e, en partant des dates les plus anciennes, si cette valeur est d&eacute;pass&eacute;e. <br />0=illimit&eacute;. ');
define('_WEBLINKS_RSS_SITE','Adresse des sites RSS');
define('_WEBLINKS_RSS_SITE_DSC',"Saisir une liste d'url RSS de sites de recherche RSS. <br />S&eacute;parer par un saut de ligne si vous en fournissez plusieurs. <br />NE PAS saisir d'url de fil ATOM. ");
define('_WEBLINKS_RSS_BLACK',"Liste noire d'url RSS/ATOM");
define('_WEBLINKS_RSS_BLACK_DSC',"Saisir une liste d'url RSS/ATOM refus&eacute;es lors de la collecte de fils RSS/ATOM. <br />S&eacute;parer par un saut de ligne si vous en fournissez plusieurs.  <br />Vous pouvez utiliser les expressions r&eacute;guli&egrave;res de perl.");
define('_WEBLINKS_RSS_WHITE',"Liste blanche d'url RSS/ATOM");
define('_WEBLINKS_RSS_WHITE_DSC',"Saisir une liste d'url RSS/ATOM &agrave; collecter. <br />S&eacute;parer par un saut de ligne si vous en fournissez plusieurs. <br />Vous pouvez utiliser les expressions r&eacute;guli&egrave;res de perl.");
define('_WEBLINKS_RSS_URL_CHECK', "Il y a quelques liens qui appartiennent &agrave; la liste noire d'url.");
define('_WEBLINKS_RSS_URL_CHECK_DSC', "Merci de faire un copier/coller de la liste blanche ci-dessous dans un formulaire d'enregistrement si vous en avez besoin.");
define('_WEBLINKS_RSS_UPDATED', 'Param&egrave;tres des fils RSS/ATOM mis &agrave; jour');

// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS_VIEW','Param&eacute;trage des vues des fils RSS/ATOM');
define('_WEBLINKS_RSS_MODE_TITLE','Utiliser les marqueurs HTLM du titre');
define('_WEBLINKS_RSS_MODE_TITLE_DSC', 'Si OUI est s&eacute;lectionn&eacute;, affiche le titre avec les marqueurs HTML (si le titre contient des marqueurs HTML). <br />Si NON, affiche le titre en enlevant les marqueurs HTML. ');
define('_WEBLINKS_RSS_MODE_CONTENT','Utilisation des marqueurs HTML dans le contenu');
define('_WEBLINKS_RSS_MODE_CONTENT_DSC', 'Si OUI est s&eacute;lectionn&eacute;, affiche le contenu avec les marqueurs HTML (si le contenu &agrave; des marqueurs HTML). <br />Si NON, affiche le contenu en enlevant les marqueurs HTML. ');
define('_WEBLINKS_RSS_NEW','S&eacute;lectionner le nombre maximum de nouveaux fils RSS/ATOM affich&eacute;s sur la page principale');
define('_WEBLINKS_RSS_NEW_DSC', 'Saisir le nombre maximum de nouveaux fils RSS/ATOM &agrave; afficher sur la page principale.');
define('_WEBLINKS_RSS_PERPAGE','S&eacute;lectionner le nombre maximum de fils RSS/ATOM affich&eacute;s dans la page de d&eacute;tail des liens ET la page RSS/ATOM');
define('_WEBLINKS_RSS_PERPAGE_DSC', 'Saisir le nombre maximum de fils RSS/ATOM &agrave; afficher dans la page RSS/ATOM. ');
define('_WEBLINKS_RSS_NUM_CONTENT','Nombre de fils qui affichent leur contenu');
define('_WEBLINKS_RSS_NUM_CONTENT_DSC', 'Saisir le nombre de fils qui affichent leur contenu RSS/ATOM dans la page d&eacute;tail des liens. <br />Un sommaire est affich&eacute; pour les fils qui sont au-del&agrave; de cette valeur. ');
define('_WEBLINKS_RSS_MAX_CONTENT','Nombre maximum de caract&egrave;res utilis&eacute;s dans un contenu RSS/ATOM');
define('_WEBLINKS_RSS_MAX_CONTENT_DSC', 'Saisir le nombre maximum de caract&egrave;res qui seront utilis&eacute;s dans les contenus RSS/ATOM de la page RSS/ATOM.  <br />Activ&eacute; si "utilisation des marqueurs HTML dans le contenu" &agrave; la valeur NON. ');
define('_WEBLINKS_RSS_MAX_SUMMARY','Nombre maximum de caract&egrave;res utilis&eacute;s dans le r&eacute;sum&eacute; des fils RSS/ATOM');
define('_WEBLINKS_RSS_MAX_SUMMARY_DSC', 'Saisir le nombre maximum de caract&egrave;res utilis&eacute;s dans le r&eacute;sum&eacute; des fils RSS/ATOM de la page principale. ');

// use link field
define('_WEBLINKS_ADMIN_POST','Param&eacute;trage des champs de lien');
define('_WEBLINKS_ADMIN_POST_TEXT_1', "Quand vous s&eacute;lectionez 'Ne pas utiliser', le champs n'est pas montr&eacute; dans le formulaire de soumission. ");
define('_WEBLINKS_ADMIN_POST_TEXT_2', "Quand vous s&eacute;lectionnez 'Utiliser', ceci le montre dans le formulaire. ");
define('_WEBLINKS_ADMIN_POST_TEXT_3', "Quand vous s&eacute;lectionnez 'Indispensable', ceci le montre et un contr&ocirc;le s'effectue sur son remplissage. ");
define('_WEBLINKS_NO_USE','Ne pas utiliser');
define('_WEBLINKS_USE','Utiliser');
define('_WEBLINKS_INDISPENSABLE','Indispensable');
define('_WEBLINKS_TYPE_DESC','Type pour la description du formulaire de soumission');
define('_WEBLINKS_TYPE_DESC_DSC', 'Quand vous s&eacute;lectionnez "NON", une boite de texte normal est utilis&eacute;.<br />Quand vous s&eacute;lectionnez "OUI",le type DHTML XOOPS pour la description du formulaire de souscription est utilis&eacute;. ');
define('_WEBLINKS_CHECK_DOUBLE','Accepter l\'enregistrement de liens existants');
define('_WEBLINKS_CHECK_DOUBLE_DSC', 'Quand vous s&eacute;lectionnez "NON", l\'enregistrement de liens existants est accept&eacute;. <br> Quand vous s&eacute;lectionnez "OUI", le syst&egrave;me v&eacute;rifie si les liens existent d&eacute;j&agrave;. ');
define('_WEBLINKS_POST_UPDATED', 'Param&egrave;tres de champs de liens mis &agrave; jour');

// cateogry
define('_WEBLINKS_ADMIN_CAT_SET','Param&egrave;tres de cat&eacute;gories');
define('_WEBLINKS_CAT_SEL', 'Nombre maximum de cat&eacute;gories s&eacute;lectionnables');
define('_WEBLINKS_CAT_SEL_DSC', 'Entrer le nombre maximum de cat&eacute;gories s&eacute;lectionnables pour un lien');
define('_WEBLINKS_CAT_SUB','Nombre de sous cat&eacute;gorie affich&eacute;es');
define('_WEBLINKS_CAT_SUB_DSC','Param&egrave;tres de nombre de cat&eacute;gories affich&eacute;es dans la liste des cat&eacute;gories de la page d\'accueil');
define('_WEBLINKS_CAT_IMG_MODE','S&eacute;lection de l\'image de cat&eacute;gorie');
define('_WEBLINKS_CAT_IMG_MODE_DSC', 'Quand vous s&eacute;lectionnez "aucune", aucune image n\'est affich&eacute;e. <br />Quand vous s&eacute;lectionnez "folder.gif", l\'image folder.gif est affich&eacute;e. <br />Quand vous s&eacute;lectionnez "Param&egrave;tres Image", les images param&eacute;tr&eacute;es pour chaque cat&eacute;gorie sont affich&eacute;es. ');
define("_WEBLINKS_CAT_IMG_MODE_0","Aucune");
define("_WEBLINKS_CAT_IMG_MODE_1","Folder.gif");
define("_WEBLINKS_CAT_IMG_MODE_2","Param&egrave;tres Image");
define('_WEBLINKS_CAT_IMG_WIDTH','Largeur maximale de l\'image de cat&eacute;gorie');
define('_WEBLINKS_CAT_IMG_HEIGHT','Hauteur maximale de l\'image de la cat&eacute;gorie');
define('_WEBLINKS_CAT_IMG_SIZE_DSC','Effectif lorsque vous s&eacute;lectionnez "Param&egrave;tres Image". ');
define('_WEBLINKS_CAT_UPDATED', 'Param&egrave;tres de cat&eacute;gorie mis &agrave; jour');


//======	cateogry_list.php 	======
define("_WEBLINKS_ADMIN_CATEGORY_MANAGE","Gestion des cat&eacute;gories");
define("_WEBLINKS_ADMIN_CATEGORY_LIST","Listes des cat&eacute;gories");
define("_WEBLINKS_ORDER_ID"," Liste par n°");
define("_WEBLINKS_ORDER_TREE"," Liste par ramification");
define("_WEBLINKS_CAT_ORDER","Ordre des cat&eacute;gories");
define("_WEBLINKS_THERE_ARE_CATEGORY","Il y a <b>%s</b> cat&eacute;gories dans la base de donn&eacute;es");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_1","Lorsque vous cliquez sur <b>N° de cat&eacute;gorie</b>, vous visualisez la page d'&eacute;dition de la cat&eacute;gorie. ");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_2","Cliquez sur <b>Cat&eacute;gorie parente</b> ou sur <b>Titre</b>, et le syst&egrave;me vous montrera l'ordre des listes de cat&eacute;gorie. ");
define("_WEBLINKS_NO_CATEGORY","Il n'a aucune cat&eacute;gorie correspondante. ");
define("_WEBLINKS_NUM_SUBCAT","Nombre de sous cat&eacute;gorie");
define('_WEBLINKS_ORDERS_UPDATED', 'Ordre des cat&eacute;gories mis &agrave; jour');

//======	cateogry_manage.php 	======
define("_WEBLINKS_IMGURL_MAIN","ULR de l'image de cat&eacute;gorie");
define("_WEBLINKS_IMGURL_MAIN_DSC1","Ceci est une option. <br />Ajustement automatique ‚”retaille l'image. ");
define("_WEBLINKS_IMGURL_MAIN_DSC2","Ceci est effectif dans la principale cat&eacute;gorie. ");

//======	link_list.php 	======
define("_WEBLINKS_ADMIN_LINK_MANAGE","Gestion des liens");
define("_WEBLINKS_ADMIN_LINK_LIST","Liste des liens");
define("_WEBLINKS_ADMIN_LINK_BROKEN","Liste des liens bris&eacute;s");
define("_WEBLINKS_ADMIN_LINK_ALL_ASC","Liste de tous les liens (tri&eacute;s par leur N° croissant, i.e &agrave; compter du plus ancien) ");
define("_WEBLINKS_ADMIN_LINK_ALL_DESC","Liste de tous les liens (List&eacute;s par leur N° d&eacute;croissant, i.e &agrave; compter du plus r&eacute;cent) ");
define("_WEBLINKS_ADMIN_LINK_NOURL","Liste de liens dont l'URL n'est pas param&eacute;tr&eacute;e");
define("_WEBLINKS_COUNT_BROKEN","Compteur de liens bris&eacute;s");
define("_WEBLINKS_NO_LINK","Il n'y a pas de lien correspondant. ");
define("_WEBLINKS_ADMIN_PRESENT_SAVE","Les donn&eacute;es sauvegard&eacute;es dans la base de donn&eacute;es peuvent &ecirc;tre visualis&eacute;es ici. ");

//======	link_manage.php 	======
define("_WEBLINKS_USERID","N] d'utilisateur");
define("_WEBLINKS_CREATE","Cr&eacute;&eacute;");

//======	link_broken_check.php 	======
define("_WEBLINKS_ADMIN_LINK_CHECK_UPDATE","Lien contr&ocirc;l&eacute; et mis &agrave; jour");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK","Contr&ocirc;le de lien bris&eacute;");
define("_WEBLINKS_ADMIN_BROKEN_CHECK","Contr&ocirc;ler");
define("_WEBLINKS_ADMIN_BROKEN_RESULT","R&eacute;sultat de contr&ocirc;le");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_CAUTION","Un d&eacute;passement de delai imparti peut survenir, s'il n'y a trop de liens bris&eacute;s. <br />Veuillez alors changer la valeur num&eacute;rique de la limite et l'offset. <br />limite=0 correspond &agrave; aucune restriction. <br />");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_NOTICE","Une page de modification de lien appara&icirc;tra, quand vous cliquerez sur le <b>N° de lien</b>. <br />L'URL correspondante sera ouverte quand vous cliquerez sur <b>URL du site Web</b>. <br />");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_GOOGLE","La recherche google sera ouverte, quand vous cliquerez sur <b>titre du site Web</b>. <br />");
define("_WEBLINKS_ADMIN_LIMIT","Maximum de liens contr&ocirc;l&eacute;s (limite)");
define("_WEBLINKS_ADMIN_OFFSET","Offset (offset)");
define("_WEBLINKS_ADMIN_CHECK","CONTROLE");
define("_WEBLINKS_ADMIN_TIME_START","Heure de d&eacute;part");
define("_WEBLINKS_ADMIN_TIME_END","Heure de cloture");
define("_WEBLINKS_ADMIN_TIME_ELAPSE","Temps &eacute;coul&eacute;");
define("_WEBLINKS_ADMIN_LINK_NUM_ALL","Tous les liens");
define("_WEBLINKS_ADMIN_LINK_NUM_CHECK","Liens contr&ocirc;l&eacute;s");
define("_WEBLINKS_ADMIN_LINK_NUM_BROKEN","Liens bris&eacute;s");
define("_WEBLINKS_ADMIN_NUM","liens");
define("_WEBLINKS_ADMIN_MIN_SEC","%s min %s sec");
define("_WEBLINKS_ADMIN_CHECK_NEXT","Contr&ocirc;le des %s liens suivants");
define("_WEBLINKS_ADMIN_RSS_REFRESH_NOTE","R&eacute;aliser simultanement de l'Auto-D&eacute;tection des URL des fils RSS/ATOM ");

//======	rss_manage.php 	======
define("_WEBLINKS_ADMIN_RSS_MANAGE","Gestion des fils RSS/ATOM");
define("_WEBLINKS_ADMIN_RSS_REFRESH","Rafra&icirc;chissement des fils RSS/ATOM");
define("_WEBLINKS_ADMIN_RSS_REFRESH_LINK","Rafra&icirc;chissement du cache des donn&eacute;es de liens");
define("_WEBLINKS_ADMIN_RSS_REFRESH_SITE","Rafra&icirc;chissement du cache des recherche de sites RSS");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_URL","Nombre d'URL RSS/ATOM rafraichies");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_SITE","Nombre de site dont les URL RSS/ATOM ont &eacute;t&eacute; rafraichies");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOM_SITE","Nombre de site RSS/ATOM aux fils rafra&icirc;chis");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOMFEED","Nombre de fils RSS/ATOM rafra&icirc;chis");
define("_WEBLINKS_ADMIN_RSS_CACHE_CLEAR","Effacement du cache de fils RSS/ATOM");
define("_WEBLINKS_RSS_CLEAR_NUM","Effacement du cache de fils RSS/ATOM dans ordre recursif (de la plus ancienne &agrave; la plus r&eacute;cente date), si celui ci est plus grand que le nombre de fils s&eacute;lectionn&eacute;s.");
define("_WEBLINKS_RSS_NUMBER","nombres de fils");
define("_WEBLINKS_RSS_CLEAR_LID","Effacement du cache pour un N° de lien sp&eacute;cifi&eacute;");
define("_WEBLINKS_RSS_CLEAR_ALL","Effacement du cache pour tous les liens");
define("_WEBLINKS_NUM_RSS_CLEAR_LINK","Nombre de cache RSS/ATOM nettoy&eacute;s");
define("_WEBLINKS_NUM_RSS_CLEAR_ATOMFEED","Nombre de fils ATOM/RSS nettoy&eacute;s");

//======	user_list.php 	======
define("_WEBLINKS_ADMIN_USER_MANAGE", "Gestion des utilisateurs");
define("_WEBLINKS_ADMIN_USER_EMAIL", "Liste des utilisateurs disposant d'une adresse email");
define("_WEBLINKS_ADMIN_USER_LINK", "Liste des utilisateurs enregistr&eacute;s disposant d'informations de liens");
define("_WEBLINKS_ADMIN_USER_NOLINK", "Liste des utilisateurs enregistr&eacute;s ne disposant pas d'informations de liens");
define("_WEBLINKS_ADMIN_USER_EMAIL_DSC", "Ne montrer qu'une adresse email si celle ci est dupliqu&eacute;e");
define("_WEBLINKS_ADMIN_USER_LINK_DSC", 'Utiliser "Envoyer un message aux utilisateurs" &agrave; partir du noyau Xoops');
define("_WEBLINKS_USER_ALL", " (tous) ");
define("_WEBLINKS_USER_MAX", " (par lot de %s personnes) ");
define("_WEBLINKS_THERE_ARE_USER", "<b>%s</b> utilisateurs trouv&eacute;s");
define("_WEBLINKS_USER_NUM", "Montrer de  la personnes %s &agrave; la  personnes %s.");
define("_WEBLINKS_USER_NOFOUND", "Aucun utilisateur trouv&eacute;");
define("_WEBLINKS_UID_EMAIL", "Adresse email de l'emetteur");

//======	mail_users.php 	======
define("_WEBLINKS_ADMIN_SENDMAIL", "Envoi d'Email");
define("_WEBLINKS_THERE_ARE_EMAIL","Il y a <b>%s</b> emails");
define("_WEBLINKS_SEND_NUM", "Envoi du formulaire d'email de la personne %s &agrave; la personne %s");
define("_WEBLINKS_SEND_NEXT","Envoi des %s emails suivants");
define("_WEBLINKS_SUBJECT_FROM", "Information de %s");
define("_WEBLINKS_HELLO", "Bonjour %s");
define("_WEBLINKS_MAIL_TAGS1","{W_NAME} imprimera le nom d'utilisation");
define("_WEBLINKS_MAIL_TAGS2","{W_EMAIL} imprimera l'email de l'utilisateur");
define("_WEBLINKS_MAIL_TAGS3","{W_LID} imprimera le N° de lien de l'utilisateur");

// general
define('_WEBLINKS_WEBMASTER', 'Le Webmestre');
define('_WEBLINKS_SUBMITTER', 'D&eacute;positaire');
define("_WEBLINKS_MID","Modification du N°");
define("_WEBLINKS_UPDATE","MISE A JOUR");
define("_WEBLINKS_SET_DEFAULT","Param&egrave;tre par d&eacute;faut");
define("_WEBLINKS_CLEAR","NETTOYAGE");
define("_WEBLINKS_CHECK","CONTROLE");
define("_WEBLINKS_NON","Rien &agrave; faire");
define("_WEBLINKS_SENDMAIL", "ENVOI d'Email");
//2005-08-09
// BUG 2827: RSS refresh: Invalid argument supplied for foreach()
define("_WEBLINKS_ADMIN_NO_LINK_BROKEN_CHECK","Il n'y a aucun lien &agrave; contr&ocirc;ler");
define("_WEBLINKS_ADMIN_NO_RSS_REFRESH","Il n'y a aucun lien dont le fil RSS doit &ecirc;tre mis &agrave; jour");

// 2005-10-20
define("_WEBLINKS_LINK_APPROVED", "Votre lien a &eacute;t&eacute; approuv&eacute;");
define("_WEBLINKS_LINK_REFUSED", "Votre lien a &eacute;t&eacute; refus&eacute;");

?>