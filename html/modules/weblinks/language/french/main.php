<?php
// $Id: main.php,v 1.1 2011/12/29 14:32:48 ohwada Exp $

// 2005-10-20 K.OHWADA
// REQ 3028: send apoval email to anonymous user
// BUG 3111: timeout occurs in popular site if many top categories

// 2005-09-27 K.OHWADA
// BUG 3032: "mutual site" is not suitable English

// 2005-03-31 K.OHWADA
// corrected typo

// 2005-01-20 K.OHWADA
// add zip, state, city, addr2 ,fax

// 2004-11-28 K.OHWADA
// _WLS_SITE_RSS

// 2004-11-20 K.OHWADA
// atom feed

// 2004-10-24 K.OHWADA
// buidance bar
// recommend site, mutual site
// broken link check
// RSS/ATOM URL
// user comment

// 2004-10-19 cb750
// translation for V0.7



//=========================================================
// language 
//=========================================================

//---------------------------------------------------------
// same as mylinks
//---------------------------------------------------------

//======	 singlelink.php	======
define("_WLS_CATEGORY","Cat&eacute;gorie");
define("_WLS_HITS","Hits");
define("_WLS_RATING","Rang");
define("_WLS_VOTE","Vote");
define("_WLS_ONEVOTE","1 vote");
define("_WLS_NUMVOTES","%s votes");
define("_WLS_RATETHISSITE","Noter ce Site");
define("_WLS_REPORTBROKEN","Rapporter un lien bris&eacute;");
define("_WLS_TELLAFRIEND","Envoyer &agrave; un ami");
define("_WLS_EDITTHISLINK","Editer ce lien ");
define("_WLS_MODIFY","Modifier");

//======	submit.php	======
define("_WLS_SUBMITLINKHEAD","Soumettre un nouveau lien");
define("_WLS_SUBMITONCE","Ne soumettez votre lien qu'une seule fois.");
define("_WLS_DONTABUSE","Les noms d'utilisateurs et IP sont enregistr&eacute;s, merci de ne pas abuser de ce syst&egrave;me.");
define("_WLS_TAKESHOT","Nous allons prendre un aperçu d'&eacute;cran de votre site web, ceci peut prendre plusieurs jours pour que votre lien soit pris en compte dans notre base de donn&eacute;es.");
define("_WLS_ALLPENDING","La soumission du lien est enregistr&eacute;e <b>temporairement</b>, et sera publi&eacute; apr&egrave;s v&eacute;rification par nos &eacute;quipes. <br />il se peut qu'il s'&eacute;coule un peu de temps avant la publication des informations de ce lien.");
define("_WLS_WHENAPPROVED","Vous recevrez un email lorsque ce dernier sera approuv&eacute;.");
define("_WLS_RECEIVED","Nous avons bien reçu les informations de votre site web. Et nous vous en remercions!");

//======	modlink.php	======
define("_WLS_REQUESTMOD","Demande de modification de lien");
define("_WLS_THANKSFORINFO","Merci pour ces informations. Nous allons les consulter afin de r&eacute;pondre &agrave; votre attente dans les plus brefs d&eacute;lais.");


define("_WLS_THANKSFORHELP","Merci pour votre collaboration au maintien de l'int&eacute;grit&eacute; de ce r&eacute;pertoire de liens.");
define("_WLS_FORSECURITY","Pour des raisons de s&eacute;curit&eacute; votre adresse IP sera momentan&eacute;ment enregistr&eacute;e.");

define("_WLS_SEARCHFOR","Recherche pour"); //-no use
define("_WLS_ANY","TOUS");
define("_WLS_SEARCH","Recherche");

define("_WLS_MAIN","Menu");
define("_WLS_SUBMITLINK","Soumettre un lien");
define("_WLS_POPULAR","Populaire");
define("_WLS_TOPRATED","les mieux cot&eacute;s");

define("_WLS_NEWTHISWEEK","Nouveau cette semaine");
define("_WLS_UPTHISWEEK","Mis &agrave; jour cette semaine");

define("_WLS_POPULARITYLTOM","Popularit&eacute; (du plus petit au plus grand nombre de hits)");
define("_WLS_POPULARITYMTOL","Popularit&eacute; (du plus grand au plus petit nombre de hits)");
define("_WLS_TITLEATOZ","Titre (A &agrave; Z)");
define("_WLS_TITLEZTOA","Titre (Z &agrave; A)");
define("_WLS_DATEOLD","Date (Les plus anciens liens en premier)");
define("_WLS_DATENEW","Date (Les nouveaux liens en premier)");
define("_WLS_RATINGLTOH","Notation (Du plus petit au plus grand score)");
define("_WLS_RATINGHTOL","Notation (du plus grand au plus petit Score)");

//define("_WLS_NOSHOTS","aucun aperçu d'&eacute;cran disponible");
//define("_WLS_DESCRIPTIONC","Description: ");
//define("_WLS_EMAILC","Email: ");
//define("_WLS_CATEGORYC","Cat&eacute;gorie: ");
//define("_WLS_LASTUPDATEC","Derni&egrave;re mise &agrave; jour: ");
//define("_WLS_HITSC","Hits: ");
//define("_WLS_RATINGC","Note: ");

define("_WLS_THEREARE","Il y a <b>%s</b> Liens dans notre base de donn&eacute;es");
define("_WLS_LATESTLIST","les derniers r&eacute;f&eacute;rencements");

//define("_WLS_LINKID","N° de lien : ");
//define("_WLS_SITETITLE","Titre du Site Web : ");
//define("_WLS_SITEURL","URL du Site Web : ");
//define("_WLS_OPTIONS","Options : ");
define("_WLS_LINKID","N° de lien");
define("_WLS_SITETITLE","Titre de Site Web");
define("_WLS_SITEURL","URL de Site Web");
define("_WLS_OPTIONS","Options");

define("_WLS_NOTIFYAPPROVE", "Notifiez-moi lorsque le lien est approuv&eacute;");
//define("_WLS_SHOTIMAGE","Img de capture d'&eacute;cran : ");
define("_WLS_SENDREQUEST","Envoyer la demande");

define("_WLS_VOTEAPPRE","Votre vote est appr&eacute;ci&eacute;.");
define("_WLS_THANKURATE","Merci d'avoir pris le temps de noter un site ici sur %s.");
define("_WLS_VOTEFROMYOU","Votre retour, ainsi que ceux des autres utilisateurs aideront les visiteurs &agrave; d&eacute;cider quel lien choisir.");
define("_WLS_VOTEONCE","Veuillez vous abstenir de votre pour la m&ecirc;me ressource plus d'une fois.");
define("_WLS_RATINGSCALE","L'&eacute;chelle est de 1 - 10, consid&eacute;rant que 1 est pauvre et 10 excellent.");
define("_WLS_BEOBJECTIVE","Veuillez rester objectif, si tout le monde vote 1 ou 10, les rangs n'auraient pas beaucoup d'int&eacute;r&ecirc;t.");
define("_WLS_DONOTVOTE","Ne votez pas pour votre propre ressource.");
define("_WLS_RATEIT","Notez le!");

define("_WLS_INTRESTLINK","Un lien de site web interressant sur %s");  // %s is your site name
define("_WLS_INTLINKFOUND","J'ai trouv&eacute; un lien de site web interressant ici sur %s");  // %s is your site name

define("_WLS_RANK","Rang");
define("_WLS_TOP10","%s Top 10"); // %s is a link category title

define("_WLS_SEARCHRESULTS","Rechercher les r&eacute;sultats pour <b>%s</b>:"); // %s is search keywords
define("_WLS_SORTBY","Tri par :");
define("_WLS_TITLE","Titre");
define("_WLS_DATE","Date");
define("_WLS_POPULARITY","Popularit&eacute;");
define("_WLS_CURSORTEDBY","Les sites sont actuellement tri&eacute;s par : %s");
define("_WLS_PREVIOUS","Pr&eacute;c&eacute;dent");
define("_WLS_NEXT","Suivant");
define("_WLS_NOMATCH","Aucune correspondance &agrave; votre requ&ecirc;te");

define("_WLS_SUBMIT","Soumettre");
define("_WLS_CANCEL","Abandon");

define("_WLS_ALREADYREPORTED","Vous nous avez d&eacute;j&agrave; soumis le rapport de lien bris&eacute; pour cette ressource.");
define("_WLS_MUSTREGFIRST","D&eacute;sol&eacute;, vous ne disposez pas des permissions ad&eacute;quates pour mener &agrave; bien cette action.<br />Veuillez vous enregistrer ou vous identifier en premier lieu!");
define("_WLS_NORATING","Aucun rang s&eacute;lectionn&eacute;.");
define("_WLS_CANTVOTEOWN","Vous ne pouvez voter pour une ressource que vous avez soumise.<br />Tous les votes sont journalis&eacute;s et revus.");
define("_WLS_VOTEONCE2","Vous ne pouvez voter pour la ressource s&eacute;lectionn&eacute; qu'une seule fois.<br />Tous les votes sont journalis&eacute;s et revus.");

//%%%%%%	Admin	  %%%%%

define("_WLS_WEBLINKSCONF","Pages de Configuration du module Web Links");
define("_WLS_GENERALSET","Param&egrave;tres g&eacute;n&eacute;raux de Web Links");
//define("_WLS_ADDMODDELETE","Ajout, Modifification, et Suppression de Cat&eacute;gories/Liens");
define("_WLS_LINKSWAITING","Nouveaux liens en attente de validation");
define("_WLS_MODREQUESTS","Modifications de liens en attente de validation");
define("_WLS_BROKENREPORTS","Rapports de liens bris&eacute;s");

//define("_WLS_SUBMITTER","D&eacute;positaire : ");
define("_WLS_SUBMITTER","D&eacute;positaire");

define("_WLS_VISIT","Visiter");

//define("_WLS_SHOTMUST","L'image de copie d'&eacute;cran doit &ecirc;tre un fichier d'image valide dans le r&eacute;pertoire %s  (ex. shot.gif). Laissez vierge s'il n'y a pas de fichier d'image.");
define("_WLS_LINKIMAGEMUST"," Entrez le nom du fichier d'image du lien dans le r&eacute;pertoire %s. (e.g. shot.gif) Laissez vierge s'il n'y a pas de fichier d'image dedans. ");

define("_WLS_APPROVE","Aprouver");
define("_WLS_DELETE","Effacer");
define("_WLS_NOSUBMITTED","Aucun nouveau lien n'a &eacute;t&eacute; soumis.");
define("_WLS_ADDMAIN","Ajouter une cat&eacute;gorie PRINCIPALE");
define("_WLS_TITLEC","Titre: ");
define("_WLS_IMGURL","URL de l'image (OPTIONNEL la hauteur d'image sera retaill&eacute;e &agrave; 50): ");
define("_WLS_ADD","Ajouter");
define("_WLS_ADDSUB","Ajouter une SOUS-cat&eacute;gorie");
define("_WLS_IN","dans");
define("_WLS_ADDNEWLINK","Ajouter un nouveau lien");
define("_WLS_MODCAT","Modifier la cat&eacute;gorie");
define("_WLS_MODLINK","Modifier le lien");
define("_WLS_TOTALVOTES","Votes des liens (total des votes: %s)");
define("_WLS_USERTOTALVOTES","Votes des utilisateurs enregistr&eacute;s (total des votes: %s)");
define("_WLS_ANONTOTALVOTES","Votes des utilisateurs anonymes (total des votes: %s)");
define("_WLS_USER","Utilisateur");
define("_WLS_IP","Adresse IP ");
define("_WLS_USERAVG","Classement avanc&eacute; des utilisateurs");
define("_WLS_TOTALRATE","Total des classements");
define("_WLS_NOREGVOTES","Aucun vote d'utilisateur enregistr&eacute;s");
define("_WLS_NOUNREGVOTES","Aucun vote d'utilisateur anonyme");
define("_WLS_VOTEDELETED","Donn&eacute;es de vote effac&eacute;e.");
define("_WLS_NOBROKEN","Aucun rapport de lien bris&eacute;.");
define("_WLS_IGNOREDESC","Ignorer (Ignore les rapports et efface seulement <b>les rapports de liens bris&eacute;s</b>)");
define("_WLS_DELETEDESC","Effacer (Efface <b>Les donn&eacute;es de sites web rapport&eacute;s</b> et <b>les rapports de liens bris&eacute;s</b> pour le lien.)");
define("_WLS_REPORTER","Emeteur du rapport");

//define("_WLS_IGNORE","Ignorer");
define("_WLS_IGNORE","Ignorer (Effacer)");

define("_WLS_LINKDELETED","Lien effac&eacute;.");
define("_WLS_BROKENDELETED","Rapport de lien bris&eacute; effac&eacute;.");
define("_WLS_USERMODREQ","Demande utilisateur de modification de lien");
define("_WLS_ORIGINAL","Original");
define("_WLS_PROPOSED","Propos&eacute;");

//define("_WLS_OWNER","Propri&eacute;taire : ");
define("_WLS_OWNER","Propri&eacute;taire");

define("_WLS_NOMODREQ","Aucune demande de mofication de lien.");
define("_WLS_DBUPDATED","Base de donn&eacute;es mise &agrave; jour avec succ&egrave;s!");
define("_WLS_MODREQDELETED","Demande de modification effac&eacute;e.");
define("_WLS_IMGURLMAIN","URL de l'image (OPTIONNEL et valide seulement pour les cat&eacute;gories principales. La hauteur de l'image sera retaill&eacute;e &agrave; 50): ");
define("_WLS_PARENT","Cat&eacute;gorie parente :");
define("_WLS_SAVE","Modifications sauvegard&eacute;es");
define("_WLS_CATDELETED","Cat&eacute;gorie effac&eacute;e.");
define("_WLS_WARNING","ATTENTION : Etes vous certain de vouloir effacer cette cat&eacute;gorie, et avec, tous ses liens et commentaires ?");
define("_WLS_YES","Oui");
define("_WLS_NO","Non");
define("_WLS_NEWCATADDED","Nouvelle cat&eacute;gorie ajout&eacute;e avec succ&egrave;s !");
define("_WLS_ERROREXIST","ERREUR: Le lien que vous avez soumis est d&eacute;j&agrave; dans notre base de donn&eacute;es !");
define("_WLS_ERRORTITLE","ERREUR: Vous devez saisir un Titre !");
define("_WLS_ERRORDESC","ERREUR: Vous devez saisir une DESCRIPTION!");
define("_WLS_NEWLINKADDED","Nouveau lien ajout&eacute; dans notre base de donn&eacute;es.");
define("_WLS_YOURLINK","Votre lien de site web sur %s");
define("_WLS_YOUCANBROWSE","Vous pouvez consulter nos liens de sites web sur %s");
define("_WLS_HELLO","Bonjour %s");
define("_WLS_WEAPPROVED","Nous avons aprouv&eacute; votre soumission de lien dans notre base de donn&eacute;es web de lien.");
define("_WLS_THANKSSUBMIT","Merci pour votre soumission !");
define("_WLS_ISAPPROVED","Nous avons aprouv&eacute; la soumission de votre lien");


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------

//======	index.php	======
// guidance bar
define("_WLS_SUBMIT_NEW_LINK","Soumettre un nouveau lien");
define("_WLS_SITE_POPULAR","Sites populaires");
define("_WLS_SITE_HIGHRATE","Sites les mieux cot&eacute;s");
define("_WLS_SITE_NEW","Derniers sites");
define("_WLS_SITE_UPDATE","Sites mis &agrave; jour");


define("_WLS_SITE_RECOMMEND","Sites recommand&eacute;s");

// BUG 3032: "mutual site" is not suitable English
define("_WLS_SITE_MUTUAL","Sites Partenaires");

define("_WLS_SITE_RANDOM","Un lien au hasard");
define("_WLS_NEW_SITELIST","Derniers sites");
define("_WLS_NEW_ATOMFEED","Derniers fils RSS/ATOM");
define("_WLS_SITE_RSS","Site RSS/ATOM");
define("_WLS_ATOMFEED","Fil RSS/ATOM");

define("_WLS_LASTUPDATE","Derni&egrave;res mises &agrave; jour");
define("_WLS_MORE","Plus de d&eacute;tails");

//======	 singlelink.php	======
define("_WLS_DESCRIPTION","Description");
define("_WLS_PROMOTER","Promouvoir");
define("_WLS_ZIP","Code postal");
define("_WLS_ADDR","Adresse");
define("_WLS_TEL","Num&eacute;ro de T&eacute;l&eacute;phone");
define("_WLS_FAX","Num&eacute;ro de fax");

//======	 submit.php	======
define("_WLS_BANNERURL","URL de banni&egrave;re");
define("_WLS_NAME","Nom");
define("_WLS_EMAIL","Email");
define("_WLS_COMPANY","Compagnie/Organisation");
define("_WLS_STATE","Etat/Pays");
define("_WLS_CITY","Ville");
define("_WLS_ADDR2","Addresse 2");
define("_WLS_PUBLIC","Publi&eacute;");
define("_WLS_NOTPUBLIC","Non publi&eacute;");
define("_WLS_NOTSELECT","Non sp&eacute;cifi&eacute;");
define("_WLS_SUBMIT_INDISPENSABLE","Marquer d'une &eacute;toile '<b>*</b>' signifit que cet &eacute;l&eacute;ment est indispensable.");
define("_WLS_SUBMIT_USER_COMMENT",'"Commentaire pour les admin" doit repr&eacute;senter une opinion, une demande, etc.<br />Cette colonne ne sera pas montr&eacute;e sur le WEB.<br />Veuillez compl&eacute;ter l\'URL de votre site quand celui ci est li&eacute; &agrave; ce site, lorsque vous d&eacute;sirer le mentionner en "lien partenaire".');
define("_WLS_USER_COMMENT","Commentaire &agrave; destination de l'utilisateur");
define("_WLS_NOT_DISPLAY","Cette colonne ne sera pas montr&eacute;e sur le WEB.");

//======	modlink.php	======
define("_WLS_MODIFYAPPROVED","La modification de votre lien en r&eacute;f&eacute;rence a &eacute;t&eacute; approuv&eacute;e. ");
define("_WLS_MODIFY_NOT_OWNER","Ne consid&eacute;rez pas automatiquement que vous &ecirc;tes le d&eacute;positaire des informations du lien.");
define("_WLS_MODIFY_PENDING","La modification du lien est enregistr&eacute;e <b>temporairement</b>, et sera publi&eacute;e apr&egrave;s v&eacute;rification par nos &eacute;quipes. <br />
Un certain temps est n&eacute;c&eacute;ssaire afin d'aprouver le cas et consid&eacute;rer ces informations.");
define("_WLS_LINKSUBMITTER","Emeteur du lien");

//======	user.php	======
define('_WLS_PLEASEPASSWORD','Saisissez votre mot de passe');
define('_WLS_REGSTERED','Utilisateur enregistr&eacute;');
define('_WLS_REGSTERED_DSC','Tout le monde peut modifier les informations du lien. <br>Le Webmestre contr&ocirc;lera ces modifications avant de les publier.');
define('_WLS_EMAILNOTFOUND',"L'adresse email ne correspond pas.");


// error message
define("_WLS_ERROR_FILL", "Erreur: Entrez %s");
define("_WLS_ERROR_ILLEGAL","Erreur: format erron&eacute; %s");
define("_WLS_ERROR_CID",  "Erreur: S&eacute;lectionnez une cat&eacute;gorie");
define("_WLS_ERROR_URL_EXIST","Erreur: Le lien a d&eacute;j&agrave; &eacute;t&eacute; enregistr&eacute;. ");
define("_WLS_WARNING_URL_EXIST","Attention : Un lien similaire a d&eacute;j&agrave; &eacute;t&eacute; enregistr&eacute;. ");
define("_WLS_ERRORNOLINK","Erreur: Aucun lien trouv&eacute;");


define("_WLS_CATLIST","Liste des cat&eacute;gories");
define("_WLS_LINKIMAGE","Image du lien: ");
define("_WLS_USERID","N° d'utilisateur: ");
define("_WLS_CATEGORYID","N° de cat&eacute;gorie: ");
define("_WLS_CREATEC","Date d'enregistrement: ");
define("_WLS_TIMEUPDATE","Mis &agrave; jour");
define("_WLS_NOTTIMEUPDATE","Non mis &agrave; jour");
define("_WLS_LINKFLAG","Cr&eacute;er un lien sous celui-ci");
define("_WLS_NOTLINKFLAG","Ne pas cr&eacute;er un lien sous celui-ci");
define("_WLS_GOTOADMIN","Aller &agrave; la page d'administration");

// category delete
define("_WLS_DELCAT","Effacer une cat&eacute;gorie");
define("_WLS_SUBCATEGORY","Sous cat&eacute;gorie");
define("_WLS_SUBCATEGORY_NON","Aucune sous cat&eacute;gorie");
define("_WLS_LINK_BELONG","Liens associ&eacute;s");
define("_WLS_LINK_BELONG_NUMBER","Nombre de liens associ&eacute;s");
define("_WLS_LINK_BELONG_NON","Aucun lien associ&eacute;");
define("_WLS_LINK_MAYBE_DELETE","Liens a effacer");
define("_WLS_LINK_MAYBE_DELETE_DSC","Les r&eacute;sultats de l'op&eacute;ration peuvent diff&eacute;rer s'il existe des sous cat&eacute;gories. D'autres liens peuvent &ecirc;tre effac&eacute;s. ");
define("_WLS_LINK_DELETE_NON","Aucun lien &agrave; effacer");
define("_WLS_CATEGORY_LINK_DELETE_EXCUTE","Effacer la cat&eacute;gorie et les liens associ&eacute;s");
define("_WLS_CATEGORY_LINK_DELETED","La cat&eacute;gorie et les liens associ&eacute;s ont &eacute;t&eacute; effac&eacute;s.");
define("_WLS_CATEGORY_DELETED","Cat&eacute;gories effac&eacute;es");
define("_WLS_LINK_DELETED","Liens effac&eacute;s");

define("_WLS_ERROR_CATEGORY","Erreur: Aucune cat&eacute;gorie n'est s&eacute;lectionn&eacute;e");
define("_WLS_ERROR_MAX_SUBCAT","Erreur: Le nombre de cat&eacute;gories s&eacute;lectionn&eacute;es d&eacute;passe le maximum pouvant &ecirc;tre effac&eacute; en une seule fois");
define("_WLS_ERROR_MAX_LINK_BELONG","Erreur: le nombre de liens associ&eacute;s s&eacute;lectionn&eacute;s d&eacute;passe le maximum pouvant &ecirc;tre effac&eacute; en une seule fois. ");
define("_WLS_ERROR_MAX_LINK_DEL","Erreur: Le nombre de liens s&eacute;lectionn&eacute;s d&eacute;passe le maximum pouvant &ecirc;tre effac&eacute; en une seule fois.");

// recommend site, mutual site
define("_WLS_MARK","Marquer comme");
define("_WLS_ADMINCOMMENT","Commentaire pour l'admin");

// broken link check
define("_WLS_BROKEN_COUNTER","Compteur de liens bris&eacute;s");

// RSS/ATOM URL
define("_WLS_RSS_URL","URL du lien RSS/ATOM");
define("_WLS_RSS_URL_0","Ne pas utiliser");
define("_WLS_RSS_URL_1","Type RSS");
define("_WLS_RSS_URL_2","Type ATOM");
define("_WLS_RSS_URL_3","Auto-d&eacute;tection");

define("_WLS_ATOMFEED_DISTRIBUTE","Fils RSS/ATOM distribu&eacute;s devant &ecirc;tre montr&eacute;s ici.");
define("_WLS_ATOMFEED_FIREFOX","Si vous utilisez <a href='http://www.mozilla.org/products/firefox/' target='_blank'>Firefox</a>, faites un bookmark de cette page, vous pouvez consulter le filet RSS/ATOM. ");

// 2005-10-20
define("_WLS_EMAIL_APPROVE","notifier si approuv&eacute;");
define("_WLS_TOPTEN_TITLE","%s Top %u");
// %s is a link category title
// %u is number of links
define("_WLS_TOPTEN_ERROR", "Il y a trop de cat&eacute;gorie principales. Affichage arr&eacute;t&eacute; &agrave; %u");
// %u is munber of categories

?>