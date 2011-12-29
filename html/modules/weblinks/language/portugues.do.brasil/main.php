<?php
// $Id: main.php,v 1.1 2011/12/29 14:32:51 ohwada Exp $

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

// --- define language begin ---
if( !defined('WEBLINKS_LANG_MB_LOADED') ) 
{

define('WEBLINKS_LANG_MB_LOADED', 1);

//---------------------------------------------------------
// same as mylinks
//---------------------------------------------------------

//======	 singlelink.php	======
define("_WLS_CATEGORY","Categoria");
define("_WLS_HITS","Acessos");
define("_WLS_RATING","Avaliação");
define("_WLS_VOTE","Votos");
define("_WLS_ONEVOTE","1 voto");
define("_WLS_NUMVOTES","%s votos");
define("_WLS_RATETHISSITE","Avaliação deste site");
define("_WLS_REPORTBROKEN","Reportar link quebrado");
define("_WLS_TELLAFRIEND","Recomende a um amigo");
define("_WLS_EDITTHISLINK","Editar este Link");
define("_WLS_MODIFY","Modificar");

//======	submit.php	======
define("_WLS_SUBMITLINKHEAD","Enviar novo Link");
define("_WLS_SUBMITONCE","Enviar seu link apena uma vez.");
define("_WLS_DONTABUSE","O nome de usuário e IPU são gravados. Por favor, não abuse do sistema.");
define("_WLS_TAKESHOT","Nós iremos tomar tela de seu website e possivelmente leve alguns dias para o link ser adicionado em nosso banco de dados.");
define("_WLS_ALLPENDING","O link enviado for registrado e será publicado após a a sua verificação. ");
//define("_WLS_WHENAPPROVED","You'll receive an E-mail when it's approved.");
define("_WLS_RECEIVED","Nós recebemos a informação de seu Website. Obrigado!");

//======	modlink.php	======
define("_WLS_REQUESTMOD","Pedido de modificação de link");
define("_WLS_THANKSFORINFO","Obrigado pela informação. Nós olharemos seu pedido o mais breve possível.");


define("_WLS_THANKSFORHELP","Obrigado por ajudar a manter a integridade deste diretório.");
define("_WLS_FORSECURITY","Por razões de segurança seu nome de usuário e endereço de IP serão também temporariamente gravados.");

define("_WLS_SEARCHFOR","Busca por"); //-no use
define("_WLS_ANY","QUALQUER");
define("_WLS_SEARCH","Busca");

//define("_WLS_MAIN","Main");
define("_WLS_SUBMITLINK","Enviar Link");
define("_WLS_POPULAR","Popular");
define("_WLS_TOPRATED","Melhor Avaliado");

define("_WLS_NEWTHISWEEK","Novo nesta semana");
define("_WLS_UPTHISWEEK","Atualizado nesta semana");

define("_WLS_POPULARITYLTOM","Popularidade (Do menos para o mais acessado)");
define("_WLS_POPULARITYMTOL","Popularidade (Do mais para o menos acessado)");
define("_WLS_TITLEATOZ","Título (A para Z)");
define("_WLS_TITLEZTOA","Título (Z para A)");
define("_WLS_DATEOLD","Data (Links antigos listados primeiro)");
define("_WLS_DATENEW","Data (Links novos listados primeiro)");
define("_WLS_RATINGLTOH","Avaliação (Do mais baixo para o mais alto escore)");
define("_WLS_RATINGHTOL","Avaliação (Do mais alto para o mais baixo escore)");

//define("_WLS_NOSHOTS","No Screenshots Available");
//define("_WLS_DESCRIPTIONC","Description: ");
//define("_WLS_EMAILC","Email: ");
//define("_WLS_CATEGORYC","Category: ");
//define("_WLS_LASTUPDATEC","Last Update: ");
//define("_WLS_HITSC","Hits: ");
//define("_WLS_RATINGC","Rating: ");

define("_WLS_THEREARE","Existem <b>%s</b> Links em nosso banco de dados");
define("_WLS_LATESTLIST","Últimos cadastrados");

//define("_WLS_LINKID","Link ID: ");
//define("_WLS_SITETITLE","Website Title: ");
//define("_WLS_SITEURL","Website URL: ");
//define("_WLS_OPTIONS","Options: ");
define("_WLS_LINKID","ID do Link");
define("_WLS_SITETITLE","Título do Website");
define("_WLS_SITEURL","URL do Website");
define("_WLS_OPTIONS","Opções");

define("_WLS_NOTIFYAPPROVE", "Notifique-me quando este link for aprovado ou rejeitado");
//define("_WLS_SHOTIMAGE","Screenshot Img: ");
define("_WLS_SENDREQUEST","Pedido enviado");

define("_WLS_VOTEAPPRE","Seu voto foi apreciado.");
define("_WLS_THANKURATE","Obrigado por tomar seu tempo e avaliar um site aqui no %s.");
define("_WLS_VOTEFROMYOU","Informe os usuários que assim como você ajudarão outros visitantes a decidir melhor qual o link escolhido.");
define("_WLS_VOTEONCE","Por favor, não vote para o mesmo recurso mais de uma vez.");
define("_WLS_RATINGSCALE","A escala é de 1 a 10, com 1 sendo ruim e 10 excelente.");
define("_WLS_BEOBJECTIVE","Por davor seja objetivo. Se todos receberem um 1 ou um 10 as avaliações não serão úteis.");
define("_WLS_DONOTVOTE","Não vote no seu próprio recurso.");
define("_WLS_RATEIT","Avaliar!");

define("_WLS_INTRESTLINK","Interessante link de Website em %s");  // %s is your site name
define("_WLS_INTLINKFOUND","Aqui está um interessante link de website que eu encontrei em %s");  // %s is your site name

define("_WLS_RANK","Rank");
define("_WLS_TOP10","%s Top 10"); // %s is a link category title

define("_WLS_SEARCHRESULTS","Buscar resultados para <b>%s</b>:"); // %s is search keywords
define("_WLS_SORTBY","Classificar por:");
define("_WLS_TITLE","Título");
define("_WLS_DATE","Data");
define("_WLS_POPULARITY","Popularidade");
define("_WLS_CURSORTEDBY","Os sites atualmente estão classificados por: %s");
define("_WLS_PREVIOUS","Anterior");
define("_WLS_NEXT","Posterior");
define("_WLS_NOMATCH","Não foram encontrados registros correspondentes para a sua consulta");

define("_WLS_SUBMIT","Enviar");
define("_WLS_CANCEL","Cancelar");

define("_WLS_ALREADYREPORTED","Você já enviou um comunicado de link quebrado para este recurso.");
define("_WLS_MUSTREGFIRST","Lamentamos, mas você não tem permissão para realizar esta ação.<br />Por favor, providencie seu registro ou logue-se aio site primeiro!");
define("_WLS_NORATING","Nenhuma avaliação foi selecionada.");
define("_WLS_CANTVOTEOWN","Você não pode votar em um recurso enviado por você.<br />Todos os votos são computados e revisados.");
define("_WLS_VOTEONCE2","Vote no recurso selecionado apenas uma vez.<br />Todos os votos são computados e revisados.");

//%%%%%%	Admin	  %%%%%

define("_WLS_WEBLINKSCONF","Configuração dos Web Links");
define("_WLS_GENERALSET","Configurações gerais dos Web Links");
//define("_WLS_ADDMODDELETE","Add, Modify, and Delete Categories/Links");
define("_WLS_LINKSWAITING","Novos links aguardando validação");
define("_WLS_MODREQUESTS","Links modificados aguardando por validação");
define("_WLS_BROKENREPORTS","Links quebrados comunicados");

//define("_WLS_SUBMITTER","Submitter: ");
define("_WLS_SUBMITTER","Quem enviou");

define("_WLS_VISIT","Visitante");

//define("_WLS_SHOTMUST","Screenshot image must be a valid image file under %s directory (ex. shot.gif). Leave it blank if no image file.");
define("_WLS_LINKIMAGEMUST"," Informe o link do nome do arquivo da imagem sob %s diretório. (exemplo: shot.gif) Deixe o campo em branco se não houver arquivo de imagem. ");

define("_WLS_APPROVE","Approvar");
define("_WLS_DELETE","Deletar");
define("_WLS_NOSUBMITTED","Não existem novos link enviados.");
define("_WLS_ADDMAIN","Adicionar uma categoria principal");
define("_WLS_TITLEC","Título: ");
define("_WLS_IMGURL","URL da imagem (OPCIONAL a altura da imagem será redimensionada para 50): ");
define("_WLS_ADD","Adicionar");
define("_WLS_ADDSUB","Adicionar uma sub categoria");
define("_WLS_IN","em");
define("_WLS_ADDNEWLINK","Adicionar um novo Link");
define("_WLS_MODCAT","Modificar a categoria");
define("_WLS_MODLINK","Modificar o link");
define("_WLS_TOTALVOTES","Votos nos Links (total de votos: %s)");
define("_WLS_USERTOTALVOTES","Votos de usuários registrados (total de votos: %s)");
define("_WLS_ANONTOTALVOTES","Votos de usuários anônimos (tota de votos: %s)");
define("_WLS_USER","Usuário");
define("_WLS_IP","Endereço de IP");
define("_WLS_USERAVG","Média da avaliação dos usuários");
define("_WLS_TOTALRATE","Total das avaliações");
define("_WLS_NOREGVOTES","Sem votos de usuário registrado");
define("_WLS_NOUNREGVOTES","Sem votos de usuários não registrados");
define("_WLS_VOTEDELETED","Deletado dados dos votos.");
define("_WLS_NOBROKEN","Sem comunicado de links quebrados.");
define("_WLS_IGNOREDESC","Ignorar (Ignorar o relatório e apenas deletar o <b>comunicado de link quebrado</b>)");
define("_WLS_DELETEDESC","Deletar (Deletar <b>o dado do website comunicado</b> e <b>comunicados de link quebrado</b> para o link.)");
define("_WLS_REPORTER","Comunicado enviado");

define("_WLS_IGNORE","Rejeitado");
define("_WLS_LINKDELETED","Link Deletado.");
define("_WLS_BROKENDELETED","Comunicado de link quebrado deletado.");
//define("_WLS_USERMODREQ","User Link Modification Requests");
define("_WLS_ORIGINAL","Original");
define("_WLS_PROPOSED","Proposto");
define("_WLS_OWNER","Próprior");
define("_WLS_NOMODREQ","Sem comunicado de modificação de link.");
define("_WLS_DBUPDATED","Banco da dados atualizado com sucesso!");
define("_WLS_MODREQDELETED","Comunicado de modificação deletado.");
define("_WLS_IMGURLMAIN","URL Image (OPCIONAL e apenas válido para categorias principais. A altura de imagem será redimensionada para 50): ");
define("_WLS_PARENT","Categoria pai:");
define("_WLS_SAVE","Salvar mudanças");
define("_WLS_CATDELETED","Categoria deletada.");
define("_WLS_WARNING","AVISO: Você tem certeza que deseja deletar esta categoria e TODOS seus links e comentários?");
define("_WLS_YES","Sim");
define("_WLS_NO","Não");
define("_WLS_NEWCATADDED","Nova categoria adicionada com sucesso!");
//define("_WLS_ERROREXIST","ERROR: The Link you provided is already in the database!");
//define("_WLS_ERRORTITLE","ERROR: You need to enter a TITLE!");
//define("_WLS_ERRORDESC","ERROR: You need to enter a DESCRIPTION!");
define("_WLS_NEWLINKADDED","Novo link adicionado ao banco de dados.");
define("_WLS_YOURLINK","Link de seu Website em %s");
define("_WLS_YOUCANBROWSE","Você pode navegar por nossos web links em %s");
define("_WLS_HELLO","Olá %s");
define("_WLS_WEAPPROVED","Nos aprovamos o link enviado para nosso bando de dados de link.");
define("_WLS_THANKSSUBMIT","Obrigado pelo seu envio!");
define("_WLS_ISAPPROVED","Nós aprovamos o link enviado");


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------

//======	index.php	======
// guidance bar
define("_WLS_SUBMIT_NEW_LINK","Enviar novo link");
define("_WLS_SITE_POPULAR","Site Popular");
define("_WLS_SITE_HIGHRATE","Site melhor avaliado");
define("_WLS_SITE_NEW","último site");
define("_WLS_SITE_UPDATE","Site atualizado");

// corrected typo
define("_WLS_SITE_RECOMMEND","Site recomendado");

// BUG 3032: "mutual site" is not suitable English
define("_WLS_SITE_MUTUAL","Site recíproco");

define("_WLS_SITE_RANDOM","Site aleatório");
define("_WLS_NEW_SITELIST","Último site");
define("_WLS_NEW_ATOMFEED","Último Feed RSS/ATOM");
define("_WLS_SITE_RSS","Site RSS/ATOM");
define("_WLS_ATOMFEED","Feed RSS/ATOM");

define("_WLS_LASTUPDATE","Last Update");
define("_WLS_MORE","Mais detalhes");

//======	 singlelink.php	======
define("_WLS_DESCRIPTION","Descrição");
define("_WLS_PROMOTER","Promover");
define("_WLS_ZIP","Código Zip");
define("_WLS_ADDR","Endereço");
define("_WLS_TEL","Número do telefone");
define("_WLS_FAX","Número do fax");

//======	 submit.php	======
define("_WLS_BANNERURL","URL do Banner");
define("_WLS_NAME","Nome");
define("_WLS_EMAIL","E-mail");
define("_WLS_COMPANY","Empresa");
define("_WLS_STATE","Estado");
define("_WLS_CITY","Cidade");
define("_WLS_ADDR2","Endereço 2");
define("_WLS_PUBLIC","Publicar");
define("_WLS_NOTPUBLIC","Não publicar");
define("_WLS_NOTSELECT","Não especificar");
define("_WLS_SUBMIT_INDISPENSABLE","Marcar com estrela '<b>*</b>' significa um item indispensável.");
define("_WLS_SUBMIT_USER_COMMENT",'"Comentário do administrador" deve ser uma opinião, comunicado, etc.<br />Está coluna não é mostrada na WEB.<br />Por favor, coloque na URL de seu site onde está linkado para este site, quando você precisar assinalar ccomo "Link recíproco".');
define("_WLS_USER_COMMENT","Comentário para o administrador");
define("_WLS_NOT_DISPLAY","Está coluna não é mostrada na WEB.");

//======	modlink.php	======
define("_WLS_MODIFYAPPROVED","A aplicação da modificação de seu link está sendo aprovada. ");
define("_WLS_MODIFY_NOT_OWNER","Por favor, assegure-se que você é a pessoa quem enviou originalmente este link.");
define("_WLS_MODIFY_PENDING","Modificação do link gravada. Ela será publicada após a verificação.");
define("_WLS_LINKSUBMITTER","Quem enviou o link");

//======	user.php	======
define('_WLS_PLEASEPASSWORD','Informe sua senha');
define('_WLS_REGSTERED','Usuário registrado');
define('_WLS_REGSTERED_DSC','Qualquer um pode modificar as informações do link. <br />O Webmaster irá checar a modificação antes da postagem.');
define('_WLS_EMAILNOTFOUND',"O endereço de e-mmail não corresponde.");


// error message
define("_WLS_ERROR_FILL", "Erro: Informe %s");
define("_WLS_ERROR_ILLEGAL","Erro: Formato errado %s");
define("_WLS_ERROR_CID",  "Erro: Selecione a categoria");
define("_WLS_ERROR_URL_EXIST","Erro: Este link já foi registrado. ");
define("_WLS_WARNING_URL_EXIST","Aviso: Um link semelhante já foi registrado. ");
define("_WLS_ERRORNOLINK","Erro: O link não foi encontrado");


define("_WLS_CATLIST","Lista da Categoria");
define("_WLS_LINKIMAGE","Imagem do Link: ");
//define("_WLS_USERID","User ID: ");
define("_WLS_CATEGORYID","ID da Categoria: ");
//define("_WLS_CREATEC","Registration Date: ");
define("_WLS_TIMEUPDATE","Atualização");
define("_WLS_NOTTIMEUPDATE","Não atualizado");
define("_WLS_LINKFLAG","Criar um link sob este ");
define("_WLS_NOTLINKFLAG","Não criar um link sob este");
define("_WLS_GOTOADMIN","Ir para a página de administração");

// category delete
define("_WLS_DELCAT","Deletar a categoria");
define("_WLS_SUBCATEGORY","Subcategoria");
define("_WLS_SUBCATEGORY_NON","Não existe Subcategoria");
define("_WLS_LINK_BELONG","Links relacionados");
define("_WLS_LINK_BELONG_NUMBER","Número de links relacionados");
define("_WLS_LINK_BELONG_NON","Não existem links relacionados");
define("_WLS_LINK_MAYBE_DELETE","Os links estão deletados");
define("_WLS_LINK_MAYBE_DELETE_DSC","O resultado da operação possivelmente diferirá caso existam subcategorias. Alguns outros links posivelmente serão deletados. ");
define("_WLS_LINK_DELETE_NON","Não existe link para ser deletado");
define("_WLS_CATEGORY_LINK_DELETE_EXCUTE","Deletar a categoria e os links relacionados");
define("_WLS_CATEGORY_LINK_DELETED","A categoria e os links relacionados foi deletada.");
define("_WLS_CATEGORY_DELETED","Categorias deletada");
define("_WLS_LINK_DELETED","Links deletado");

define("_WLS_ERROR_CATEGORY","Erro: A categoria não está selecionada");
define("_WLS_ERROR_MAX_SUBCAT","Erro: O número de categorias selecionadas excede o máximo para ser deletadas de uma vez");
define("_WLS_ERROR_MAX_LINK_BELONG","Erro: O número de links relacionados excede o máximo para ser deletados de uma vez. ");
define("_WLS_ERROR_MAX_LINK_DEL","Erro: O número de links selecionados excede o máximo para ser deletado de uma vez.");

// recommend site, mutual site
define("_WLS_MARK","Assinalar");
define("_WLS_ADMINCOMMENT","Comentário do administrador");

// broken link check
define("_WLS_BROKEN_COUNTER","Contar links quebrados");

// RSS/ATOM URL
define("_WLS_RSS_URL","URL do RSS/ATOM");
define("_WLS_RSS_URL_0","Não usar");
define("_WLS_RSS_URL_1","Tipo de RSS");
define("_WLS_RSS_URL_2","Tipo de ATOM");
define("_WLS_RSS_URL_3","auto descoberta");

define("_WLS_ATOMFEED_DISTRIBUTE","Mostrar aqui a distribuição dos feeds RSS/ATOM.");
define("_WLS_ATOMFEED_FIREFOX","Se você usar <a href='http://www.mozilla.org/products/firefox/' target='_blank'>Firefox</a>, adicione esta página para navegar pelo nosso feed RSS/ATOM. ");

// 2005-10-20
define("_WLS_EMAIL_APPROVE","Notificar quando aprovado");
define("_WLS_TOPTEN_TITLE","%s Top %u");
// %s is a link category title
// %u is number of links
define("_WLS_TOPTEN_ERROR", "Exixtem muitas top categorias. para de mostrar por %u");
// %u is munber of categories

// 2006-04-02
define('_WEBLINKS_MID', 'ID da modificação');
define('_WEBLINKS_USERID', 'ID do usuário');
define('_WEBLINKS_CREATE', 'Criado');

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

define('_NO_MATCH_RECORD','Não existe gravação correspondente');
define('_MANY_MATCH_RECORD','Exixtem duas ou mais gravações correspondentes');
define('_NO_CATEGORY', 'Categoria não existente');
define('_NO_LINK', 'Link não existente');
define('_NO_TITLE', 'Título não existente');
define('_NO_URL', 'URL não existente');
define('_NO_DESCRIPTION','No Description');

//define('_GOTO_MAIN',   'Go to Main');
//define('_GOTO_MODULE', 'Go to Module');

// config
//define('_WEBLINKS_INIT_NOT', 'The config table is not initialized');
//define('_WEBLINKS_INIT_EXEC', 'Config Table Initialized');
//define('_WEBLINKS_VERSION_NOT','This module is not version  %s yet. Update now');
//define('_WEBLINKS_UPGRADE_EXEC','Upgrade the config table');

// html tag
define('_WEBLINKS_OPTIONS', 'Opções');
define('_WEBLINKS_DOHTML', ' Habilitar tags HTML');
define('_WEBLINKS_DOIMAGE', ' Habilitar imagens');
define('_WEBLINKS_DOBREAK', ' Habilitar quebra de linha');
define('_WEBLINKS_DOSMILEY', ' Habilitar icones de smiley');
define('_WEBLINKS_DOXCODE', ' Habilitar códigos XOOPS');

define('_WEBLINKS_PASSWORD_INCORRECT',' Senha incorreta');
define('_WEBLINKS_ETC', 'etc');
define('_WEBLINKS_AUTH_UID',    'O ID do usuário não corresponde');
define('_WEBLINKS_AUTH_PASSWD', 'A senha corresponde');
define('_WEBLINKS_BANNER_SIZE', 'Tamanho do Banner');

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

define('_WEBLINKS_MAP_USE', 'Uar ícone do Mapa');

// rssc
define('_WEBLINKS_RSSC_LID',  'Lid RSSC ');
define('_WEBLINKS_RSS_MODE',  'Modo RSS');
define('_WEBLINKS_RSSC_NOT_INSTALLED', 'Módulo RSSC ( %s ) não está instalado');
define('_WEBLINKS_RSSC_INSTALLED',     'Módulo RSSC ( %s ) versão %s está instalado');
define('_WEBLINKS_RSSC_REQUIRE', 'Requirido o módulo RSSC versão %s ou superior');
define('_WEBLINKS_GOTO_SINGLELINK', 'Ir às informações do Link');

// warnig
define('_WEBLINKS_WARN_NOT_READ_URL', 'Aviso: Url não pode ser lida');
define('_WEBLINKS_WARN_BANNER_NOT_GET_SIZE', 'Aviso: não pode ser obtido o tamanho do banner');

// google map: hacked by wye <http://never-ever.info/>
define('_WEBLINKS_GM_LATITUDE',  'Latitude');
define('_WEBLINKS_GM_LONGITUDE', 'Longitude');
define('_WEBLINKS_GM_ZOOM',      'Nível de Zoom');
define('_WEBLINKS_GM_GET_LOCATION', 'A informação do local é obtida com o Google Maps');
//define('_WEBLINKS_GM_GET_BUTTON', 'Get Latitude/Longitude/Zoom');
define('_WEBLINKS_GM_DEFAULT_LOCATION', 'Local Padrão');
define('_WEBLINKS_GM_CURRENT_LOCATION', 'Local atual');

// === 2006-11-04 ===
// google map inline mode
define('_WEBLINKS_GOOGLE_MAPS', 'Google Maps');
define('_WEBLINKS_JAVASCRIPT_INVALID', 'Seu navegador não pode usar JavaScript');
define('_WEBLINKS_GM_NOT_COMPATIBLE',  'Seu navegador não pode usar GoogleMaps');
define('_WEBLINKS_GM_NEW_WINDOW', 'Mostrar em nova janela');
define('_WEBLINKS_GM_INLINE',   'Mostrar Inline');
define('_WEBLINKS_GM_DISP_OFF', 'Desabilitar Vizualização');

// google map: inverse Geocoder
define('_WEBLINKS_GM_GET_LATITUDE', 'Obter Latitude Longitude e Zoom');
define('_WEBLINKS_GM_GET_ADDR', 'Obter endereço');

// === 2006-12-11 ===
// google map: Geocode
define('_WEBLINKS_GM_SEARCH_MAP_FROM_ADDRESS', 'Buscar mapa para o endereço');
define('_WEBLINKS_GM_NO_MATCH_PLACE', 'Não há lugar que corresponda ao endreço');
define('_WEBLINKS_GM_JP_SEARCH_MAP_FROM_ADDRESS', 'Buscar o mapa do endereço no Japão');
define('_WEBLINKS_GM_JP_TOKYO_AC_GEOCODE', 'Universsidade de Tokio do Japão');
define('_WEBLINKS_GM_JP_MLIT_ISJ', 'Ministério de Terras, Infraestrutura e Transportes do Japão');

// link item
define('_WEBLINKS_TIME_PUBLISH', 'Momento da Publicação');
define('_WEBLINKS_TIME_EXPIRE',  'Momento da expiração');
define('_WEBLINKS_TEXTAREA',     'Área do texto');

define('_WEBLINKS_WARN_TIME_PUBLISH', 'A hora da publicação não chegou ainda');
define('_WEBLINKS_WARN_TIME_EXPIRE',  'O tempo da expiração está passando');
define('_WEBLINKS_WARN_BROKEN', 'Este link possivelmente é quebrado');

// === 2007-02-20 ===
// forum
define('_WEBLINKS_LATEST_FORUM', 'Últimas do Fórum');
define('_WEBLINKS_FORUM',  'Fórum');
define('_WEBLINKS_THREAD', 'Thead');
define('_WEBLINKS_POST',   'Post');
define('_WEBLINKS_FORUM_ID',  'ID do Fórum');
define('_WEBLINKS_FORUM_SEL', 'Selecionar Fórum');
define('_WEBLINKS_COMMENT_USE',  'Usar comentários XOOPS');

// aux
define('_WEBLINKS_CAT_AUX_TEXT_1', 'aux_text_1');
define('_WEBLINKS_CAT_AUX_TEXT_2', 'aux_text_2');
define('_WEBLINKS_CAT_AUX_INT_1',  'aux_int_1');
define('_WEBLINKS_CAT_AUX_INT_2',  'aux_int_2');

// captcha
define('_WEBLINKS_CAPTCHA', 'Captcha');
define('_WEBLINKS_CAPTCHA_DESC', 'Anti-Spam');
define('_WEBLINKS_ERROR_CAPTCHA','Erro: Unmtach Captcha');
define('_WEBLINKS_ERROR', 'Erro');

// hack for multi site
define('_WEBLINKS_CAT_TITLE_JP', 'Título japonês');
define('_WEBLINKS_DISABLE_FEATURE', 'Desabilitar esta característica');
define('_WEBLINKS_REDIRECT_JP_SITE', 'Pular para o site japonês');

// === 2007-03-25 ===
define('_WEBLINKS_ALBUM_ID',  'ID do álbum');
define('_WEBLINKS_ALBUM_SEL', 'selecionar álbum');

// === 2007-04-08 ===
define('_WEBLINKS_GM_TYPE',  'Tipo de Google Map');
define('_WEBLINKS_GM_TYPE_MAP',       'Mapa');
define('_WEBLINKS_GM_TYPE_SATELLITE', 'Satélite');
define('_WEBLINKS_GM_TYPE_HYBRID',    'Hibrido');

// === 2007-08-01 ===
define('_WEBLINKS_GM_CURRENT_ADDRESS', 'Endereço atual');
define('_WEBLINKS_GM_SEARCH_LIST', 'Lista do resultado das buscas');

// === 2007-09-01 ===
// waiting list
define('_WEBLINKS_ADMIN_WAITING_LIST', "Aguardando lista do administrador");
define('_WEBLINKS_USER_WAITING_LIST',  'Sua lista de pendentes');
define('_WEBLINKS_USER_OWNER_LIST',    'Sua lista de enviados');

// submit form
define('_WEBLINKS_TIME_PUBLISH_SET', 'Configurar o tempo da publicação');
define('_WEBLINKS_TIME_PUBLISH_DESC','se você não checar isso, o tempo da publicação irá se tornar sem data');
define('_WEBLINKS_TIME_EXPIRE_SET',  'Configurar tempo da expiração');
define('_WEBLINKS_TIME_EXPIRE_DESC', 'se você não checar isso, a configuração da expiração irá se tornar sem data');
define('_WEBLINKS_DEL_LINK_CONFIRM','Confirmar para deletar');
define('_WEBLINKS_DEL_LINK_REASON', 'Razão para deletar');

// === 2007-11-01 ===
define('_WEBLINKS_ERROR_LENGTH', "Erro: %s deve ser menor que %s caracteres");

// === 2008-02-17 ===
// linkitem
define('_WEBLINKS_PAGERANK', 'PageRank');
define('_WEBLINKS_PAGERANK_UPDATE', 'Atualização do tempo do PageRank');
define('_WEBLINKS_GM_KML_DEBUG', 'Vizualizar depuração do KML');

// gmap
define('_WEBLINKS_SITE_GMAP', 'Site GoogleMaps');
define('_WEBLINKS_KML_LIST',  'Lista KML');
define('_WEBLINKS_KML_LIST_DESC', 'Baixar KML e mostrar no GoogleEarth');
define('_WEBLINKS_KML_PERPAGE', 'O número para dividir');

// pagerank
define('_WEBLINKS_SITE_PAGERANK', 'Altura do PageRank do site');

}
// --- define language end ---

?>
