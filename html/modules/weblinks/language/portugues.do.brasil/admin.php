<?php
// $Id: admin.php,v 1.1 2011/12/29 14:32:51 ohwada Exp $

// 2008-02-17 K.OHWADA
// htmlout

// 2007-12-09 K.OHWADA
// remove _WEBLINKS_ADMIN_CHECK
// add AM_WEBLINKS_D3FORUM_VIEW

// 2007-11-01 K.OHWADA
// _AM_WEBLINKS_GM_MARKER_WIDTH

// 2007-09-01 K.OHWADA
// nofitication
// change _WEBLINKS_LINK_APPROVED _AM_WEBLINKS_USE_HITS

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

define("_WEBLINKS_ADMIN_INDEX","Index Administração");

// BUG 2931: unmatch popup menu 'preference' and index menu 'module setting'
define("_WEBLINKS_ADMIN_MODULE_CONFIG_1","Configuração do módulo 1 (Preferências)");

define("_WEBLINKS_ADMIN_MODULE_CONFIG_2","Configuração do módulo 2");
//define("_WEBLINKS_ADMIN_ADDMODDEL_CATEGORY","Add, Modify, and Delete Categories");
define("_WEBLINKS_ADMIN_ADD_LINK","Adicionar novo Link");
define("_WEBLINKS_ADMIN_OTHERFUNC","Outras funções");
define("_WEBLINKS_ADMIN_GOTO_ADMIN_INDEX","Ir para o Index da Administração");

//======	config.php 	======
// Access Authority
define('_WEBLINKS_ADMIN_AUTH','Permissões');
define('_WEBLINKS_ADMIN_AUTH_TEXT', 'O administrador tem todas as permissões');
define('_WEBLINKS_AUTH_SUBMIT','Pode submeter um novo link');
define('_WEBLINKS_AUTH_SUBMIT_DSC','Especificar o grupo que pode enviar um novo link');
define('_WEBLINKS_AUTH_SUBMIT_AUTO','Pode aprovar automaticamente os mais novos links enviados');
define('_WEBLINKS_AUTH_SUBMIT_AUTO_DSC','Especificar os grupos cujos links enviados são automaticamente aprovados');
define('_WEBLINKS_AUTH_MODIFY','Pode modificar');
define('_WEBLINKS_AUTH_MODIFY_DSC','Especificar os grupos que podem enviar pedidos de modificação de links');
define('_WEBLINKS_AUTH_MODIFY_AUTO','Pode aprovar modificações de link');
define('_WEBLINKS_AUTH_MODIFY_AUTO_DSC','Especificar os grupos com permissão para aprovar pedidos de modificação de link');
define('_WEBLINKS_AUTH_RATELINK','Pode avaliar um link');
define('_WEBLINKS_AUTH_RATELINK_DSC',"Especificar os grupos com permissão para avaliar um link.<br />Esta característica trabalha unicamente quando é permitido aos  usuários avaliar links.");
define('_WEBLINKS_USE_PASSWD','Usar senha de autenticação quando da modificação de um link');
define('_WEBLINKS_USE_PASSWD_DSC','Mostrar um campo de senha de autenticação quando for selecionado SIM, <br />para grupos que não é permitido enviar ou aprovar pedidos de modificação. ');
define('_WEBLINKS_USE_RATELINK','Permitir avaliações');
define('_WEBLINKS_USE_RATELINK_DSC',"SIM permite os usuários avaliar links.");
define('_WEBLINKS_AUTH_UPDATED', 'Permissões atualizadas');


// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS','Configurações dos Feeds RSS/ATOM');
define('_WEBLINKS_RSS_MODE_AUTO','Auto atualização dos feeds RSS/ATOM');
define('_WEBLINKS_RSS_MODE_AUTO_DSC', "YES executa 'Auto descoberta da url do RSS/ATOM' e 'auto atualização' se os links RSS/ATOM estão incluídos no link submetido. ");
define('_WEBLINKS_RSS_MODE_DATA','Dados do RSS/ATOM para mostrar');
define('_WEBLINKS_RSS_MODE_DATA_DSC', "ATOM FEED, usa osw dados na tabela Atom feed  após da análise. <br />XML usa os dados da tabela de links antes da análise. <br />Alguns dados possivelmente não serão salvos na tabela atom feed depois da filtragem. ");
define('_WEBLINKS_RSS_CACHE','Tempo em cache dos feeds RSS/ATOM');
define('_WEBLINKS_RSS_CACHE_DSC', 'Medido em horas.');
define('_WEBLINKS_RSS_LIMIT','Número máximo de feeds RSS/ATOM');
define('_WEBLINKS_RSS_LIMIT_DSC', 'Informe o número máximo de feeds RSS/ATOM salvos na tabela atom feed<br />Os dados antigos serão varridos se este valor for excedido. <br />0 é sem limite. ');
define('_WEBLINKS_RSS_SITE','Buscar site RSS');
define('_WEBLINKS_RSS_SITE_DSC',"Informe a lista de url RSS buscadas no site. <br />Separe cada entrada com uma nova linha, quando especificar mais de uma. <br />Não informe a url ATOM. ");
define('_WEBLINKS_RSS_BLACK','Lista negra de url RSS/ATOM');
define('_WEBLINKS_RSS_BLACK_DSC','Informe a lista de urls recusadas quando da coleta de feeds RSS/ATOM. <br />Separe cada entrada com uma nova linha, quando especificar mais de uma. <br />Você pode usar expressões regulares PERL. ');
define('_WEBLINKS_RSS_WHITE','Lista branca de url RSS/ATOM');
define('_WEBLINKS_RSS_WHITE_DSC','Informe a lista de uls para coletar, quando combinadas com uma lista negra. <br />Separe cada entrada com uma nova linha, quando especificar mais de uma. <br />Você pode usar expressões regulares PERL. ');
define('_WEBLINKS_RSS_URL_CHECK', 'Existem alguma urls de links combinadas na lista negra. ');
define('_WEBLINKS_RSS_URL_CHECK_DSC', 'Por favor, copie e cole no formulário de registro a partir da mais baixa lista branca, se necessário. ');
define('_WEBLINKS_RSS_UPDATED', 'Configurações do RSS/ATOM atualizadas');


// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS_VIEW','Vizualizar configurações dos Feeds RSS/ATOM');
define('_WEBLINKS_RSS_MODE_TITLE','Usar tags HTML no título');
define('_WEBLINKS_RSS_MODE_TITLE_DSC', "YES mostra tags HTML no titulo do link, se o título tiver tags HTML. <br />NÃO tira tags HTML do título. ");
define('_WEBLINKS_RSS_MODE_CONTENT','Usar tags HTML no conteúdo');
define('_WEBLINKS_RSS_MODE_CONTENT_DSC', "YES mostra o link do conteúdo com tag HTML, se o conteúdo tiver tag HTML. <br />NÃO tira todas as tags HTML do conteúdo mostrado. ");
define('_WEBLINKS_RSS_NEW','Selecione o número máximo de "novos feeds RSS/ATOM" mostrados na página top');
define('_WEBLINKS_RSS_NEW_DSC', 'Informar o número máximo de novos feeds RSS/ATOM a serem mostrados ná pagina principal.');
define('_WEBLINKS_RSS_PERPAGE','Selecione o número máximo de feeds RSS/ATOM a serem mostrados na página de detalhe do link e página do RSS/ATOM');
define('_WEBLINKS_RSS_PERPAGE_DSC', 'Informe o número máximo de feeds RSS/ATOM a serem mostrados na página de RSS/ATOM. ');
define('_WEBLINKS_RSS_NUM_CONTENT','Número de feeds mostrando conteúdo');
define('_WEBLINKS_RSS_NUM_CONTENT_DSC', 'Informe o número de feeds mostrando o conteúdo de feeds RSS/ATOM na página de detalhes do link. <br />Um sumário é mostrado nos feeds remanescentes. ');
define('_WEBLINKS_RSS_MAX_CONTENT','Número máximo de caracteres usados para o conteúdo feed RSS/ATOM');
define('_WEBLINKS_RSS_MAX_CONTENT_DSC', 'Informe o número máximo de caracteres a serem usados para o conteúdo feed RSS/ATOM na página RSS/ATOM.  <br />é usado quando "Usar tags HTML nos conteúdos" é "sim." ');
define('_WEBLINKS_RSS_MAX_SUMMARY','Número máximo de caracteres usados para o sumário do feed RSS/ATOM');
define('_WEBLINKS_RSS_MAX_SUMMARY_DSC', 'Informe o número máximo de caracteres a serem usados para o sumario do feed RSS/ATOM na página principal. ');


// use link field
define('_WEBLINKS_ADMIN_POST','Configuração dos campos do Link');
define('_WEBLINKS_ADMIN_POST_TEXT_1', "Não usando significa que o campo não será mostrado no formulário de registro. ");
define('_WEBLINKS_ADMIN_POST_TEXT_2', "O uso significa que o campo será mostrado no formulário de registro permitindo ao usuário informar ou não dados no campo ");
define('_WEBLINKS_ADMIN_POST_TEXT_3', "Indispensável significa que o campo DEVE ser preenchido. ");
define('_WEBLINKS_NO_USE',"Não usar");
define('_WEBLINKS_USE','Usar');
define('_WEBLINKS_INDISPENSABLE','Indispensável');
define('_WEBLINKS_TYPE_DESC','Usar a caixa de texto XOOPS DHTML para as submissões');
define('_WEBLINKS_TYPE_DESC_DSC', 'NÃO usa uma caixa de texto normal.<br />SIM usa caixa de texto tipo XOOPS DHTML no formulário de registro. ');
define('_WEBLINKS_CHECK_DOUBLE','Aceitar o envio de links existentes');
define('_WEBLINKS_CHECK_DOUBLE_DSC', 'NÃO permite o registro de links existentes. <br /> SIM verifica se o mesmo link já existe no banco de dados. ');
define('_WEBLINKS_POST_UPDATED', 'Configuraçções dos campos do Link atualizado');

// cateogry
define('_WEBLINKS_ADMIN_CAT_SET','Configurações das Categorias');
define('_WEBLINKS_CAT_SEL', 'Número máximo de categorias que um usuário pode selecionar para enviar links');
define('_WEBLINKS_CAT_SEL_DSC', 'Informe o número de categorias que um usuário pode selecionar para classificar os links enviados');
define('_WEBLINKS_CAT_SUB','Número de subcategorias para mostradar');
define('_WEBLINKS_CAT_SUB_DSC','Configurar o número de subcategorias mostradas na lista de categorias mostradas na página top');
define('_WEBLINKS_CAT_IMG_MODE','Selecionar a imagem da categoria');
define('_WEBLINKS_CAT_IMG_MODE_DSC', 'NENHUMA sem imagem. <br />Folder.gif mostra folder.gif. <br />Configure a imagem mostrada configurando a imagem de cada categoria. ');
//define("_WEBLINKS_CAT_IMG_MODE_0","NONE");
define("_WEBLINKS_CAT_IMG_MODE_1","folder.gif");
define("_WEBLINKS_CAT_IMG_MODE_2","Configuração da Imagem");
define('_WEBLINKS_CAT_IMG_WIDTH','Largura máxima da imagem da categoria');
define('_WEBLINKS_CAT_IMG_HEIGHT','Altura máxima da imagem da categoria');
define('_WEBLINKS_CAT_IMG_SIZE_DSC','Usar quando selecionado "Configuração da Imagem". ');
define('_WEBLINKS_CAT_UPDATED', 'Configuração das Categorias atualizada');


//======	cateogry_list.php 	======
define("_WEBLINKS_ADMIN_CATEGORY_MANAGE","Administração das Categorias");
define("_WEBLINKS_ADMIN_CATEGORY_LIST","Lista das Categorias");
//define("_WEBLINKS_ORDER_ID"," Listed by ID");
define("_WEBLINKS_ORDER_TREE"," Listados por árvore");
define("_WEBLINKS_CAT_ORDER","Ordem da Categoria");
define("_WEBLINKS_THERE_ARE_CATEGORY","Existem <b>%s</b> categorias no banco de dados");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_1","Clique <b>ID da categoria</b> para editar uma categoria específica. ");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_2","Clique <b>Categoria pai</b> ou <b>Título</b>, para mostrar a ordenação da lista de categorias. ");
define("_WEBLINKS_NO_CATEGORY","Não há categoria corresponente. ");
define("_WEBLINKS_NUM_SUBCAT","Número da subcategoria");
define('_WEBLINKS_ORDERS_UPDATED', 'Ordenação da catagoria atualizada');

//======	cateogry_manage.php 	======
define("_WEBLINKS_IMGURL_MAIN","URL da imagem da categoria");
define("_WEBLINKS_IMGURL_MAIN_DSC1","Opcional. <br />O tamanho das imagens são ajustadas automaticamente");
//define("_WEBLINKS_IMGURL_MAIN_DSC2","Images are for the main category only. ");

//======	link_list.php 	======
define("_WEBLINKS_ADMIN_LINK_MANAGE","Aministração dos Link");
define("_WEBLINKS_ADMIN_LINK_LIST","Lista do Link");
define("_WEBLINKS_ADMIN_LINK_BROKEN","Lista de link Quebrado");
define("_WEBLINKS_ADMIN_LINK_ALL_ASC","Lista de todos os links (Listados pelo antigo ID) ");
define("_WEBLINKS_ADMIN_LINK_ALL_DESC","Lista de todos os links (Listados pelo novo ID) ");
define("_WEBLINKS_ADMIN_LINK_NOURL","Lista dos link que a URL não esta configurada");
define("_WEBLINKS_COUNT_BROKEN","Contar links quebrados");
define("_WEBLINKS_NO_LINK","Não há link correspondente. ");
define("_WEBLINKS_ADMIN_PRESENT_SAVE","dado salvo no banco de dados mostrado aqui. ");

//======	link_manage.php 	======
//define("_WEBLINKS_USERID","User ID");
//define("_WEBLINKS_CREATE","Created");

//======	link_broken_check.php 	======
define("_WEBLINKS_ADMIN_LINK_CHECK_UPDATE","Checagem e atualização de link");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK","Checar link quebrado");
define("_WEBLINKS_ADMIN_BROKEN_CHECK","Checar");
define("_WEBLINKS_ADMIN_BROKEN_RESULT","Checar Resultados");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_CAUTION","Um esgotamento do tempo possivelmente ocorra, se existirem muitos links quebrados. <br />Se isso ocorrer, por favor mude o valor numérico do limite e saia da configuração. <br />limite= 0, ou Sem restrições.");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_NOTICE","Clicando o <b>ID do link</b> abre uma página de modificação do link. <br /><b>URL do Website</b> conduzirá você a um link de um website, quando clicado. <br />");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_GOOGLE","A busca Google abrirá quando clicado <b>título website</b>. <br />");
define("_WEBLINKS_ADMIN_LIMIT","Máximo de links para checar (limite)");
define("_WEBLINKS_ADMIN_OFFSET","Offset (offset)");
//define("_WEBLINKS_ADMIN_CHECK","CHECK");
define("_WEBLINKS_ADMIN_TIME_START","Tempo incial");
define("_WEBLINKS_ADMIN_TIME_END","Tempo final");
define("_WEBLINKS_ADMIN_TIME_ELAPSE","Tempo decorrido");
define("_WEBLINKS_ADMIN_LINK_NUM_ALL","Todos os links");
define("_WEBLINKS_ADMIN_LINK_NUM_CHECK","Links checados");
define("_WEBLINKS_ADMIN_LINK_NUM_BROKEN","Links verificados");
define("_WEBLINKS_ADMIN_NUM","links");
define("_WEBLINKS_ADMIN_MIN_SEC","%s min %s seg");
define("_WEBLINKS_ADMIN_CHECK_NEXT","Checar próximos %s links");
//define("_WEBLINKS_ADMIN_RSS_REFRESH_NOTE","Simultaneously execute an Auto Discovery of RSS/ATOM urls ");


//======	rss_manage.php 	======
define("_WEBLINKS_ADMIN_RSS_MANAGE","Administração feed RSS/ATOM");
define("_WEBLINKS_ADMIN_RSS_REFRESH","Atualizar RSS/ATOM");
define("_WEBLINKS_ADMIN_RSS_REFRESH_LINK","Atualizar cache dos dados do link");
define("_WEBLINKS_ADMIN_RSS_REFRESH_SITE","Atualizar cache da busca do site RSS");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_URL","Número de urls RSS/ATOM atualizadas");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_SITE","Número de sites RSS/ATOM atualizados url");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOM_SITE","Número de sites RSS/ATOM atualizados");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOMFEED","Número de feeds RSS/ATOM atualizados");
define("_WEBLINKS_ADMIN_RSS_CACHE_CLEAR","Limpar cache dos feed RSS/ATOM");
define("_WEBLINKS_RSS_CLEAR_NUM","Limpar cache do feed RSS/ATOM por ordem de data, se maior que o número de feeds especificado na Configuração do Módulo 1.");
define("_WEBLINKS_RSS_NUMBER","Número de feeds");
define("_WEBLINKS_RSS_CLEAR_LID","Limpar cache dos IDS dos links especificados");
define("_WEBLINKS_RSS_CLEAR_ALL","Limpar todo o cache");
define("_WEBLINKS_NUM_RSS_CLEAR_LINK","Número de cache RSS/ATOM apagados");
define("_WEBLINKS_NUM_RSS_CLEAR_ATOMFEED","Número de feed ATOM/RSS feed apagados");

//======	user_list.php 	======
define("_WEBLINKS_ADMIN_USER_MANAGE", "Administração do Usuário");
define("_WEBLINKS_ADMIN_USER_EMAIL", "Lista de usuários com endereço de e-mail");
define("_WEBLINKS_ADMIN_USER_LINK", "Lista de usuários registrados com informação de link");
define("_WEBLINKS_ADMIN_USER_NOLINK", "Lista de usuários registrados sem informação de link");
define("_WEBLINKS_ADMIN_USER_EMAIL_DSC", "Mostrar apenas um endereço de e-mail, se duplicado");
//define("_WEBLINKS_ADMIN_USER_LINK_DSC", 'Use "Send Message to Users" of XOOPS core');
//define("_WEBLINKS_USER_ALL", " (all) ");
//define("_WEBLINKS_USER_MAX", " (each %s persons) ");
define("_WEBLINKS_THERE_ARE_USER", "<b>%s</b> usuários encontrados");
define("_WEBLINKS_USER_NUM", "Mostrar de %s th pessoas para %s th pessoa.");
define("_WEBLINKS_USER_NOFOUND", "Não foram encontrados usuários");
define("_WEBLINKS_UID_EMAIL", "Endereço de e-mail de quem enviou");

//======	mail_users.php 	======
define("_WEBLINKS_ADMIN_SENDMAIL", "Enviar e-mail");
define("_WEBLINKS_THERE_ARE_EMAIL","Existem <b>%s</b> e-mails");
define("_WEBLINKS_SEND_NUM", "Enviado e-mail de %s th pessoa para %s th pessoa");
//define("_WEBLINKS_SEND_NEXT","Send next %s emails");
//define("_WEBLINKS_SUBJECT_FROM", "Information from %s");
//define("_WEBLINKS_HELLO", "Hello %s");
define("_WEBLINKS_MAIL_TAGS1","{W_NAME} imprimirá o nome do usuário");
define("_WEBLINKS_MAIL_TAGS2","{W_EMAIL} imprimirá o e-mail do usuário");
define("_WEBLINKS_MAIL_TAGS3","{W_LID} imprimirá o id do link do usuário");

// general
//define('_WEBLINKS_WEBMASTER', 'Webmaster');
define('_WEBLINKS_SUBMITTER', 'Quem envia');
//define("_WEBLINKS_MID","Modify ID");
define("_WEBLINKS_UPDATE","ATUALIZAÇÃO");
define("_WEBLINKS_SET_DEFAULT","Configuração padrão");
define("_WEBLINKS_CLEAR","APAGAR");
define("_WEBLINKS_CHECK","CHECAR");
define("_WEBLINKS_NON","Nada a fazer");
//define("_WEBLINKS_SENDMAIL", "SEND Email");

// 2005-08-09
// BUG 2827: RSS refresh: Invalid argument supplied for foreach()
define("_WEBLINKS_ADMIN_NO_LINK_BROKEN_CHECK","Não há link para checar");
define("_WEBLINKS_ADMIN_NO_RSS_REFRESH","Não há link para atualizar RSS");

// 2005-10-20
define("_WEBLINKS_LINK_APPROVED", "[{X_SITENAME}] {X_MODULE}: O link enviado foi aprovado");
define("_WEBLINKS_LINK_REFUSED",  "[{X_SITENAME}] {X_MODULE}: O link enviado foi reprovado");

// 2006-05-15
define('_AM_WEBLINKS_INDEX_DESC','Texto introdutório da Página Principal');
define('_AM_WEBLINKS_INDEX_DESC_DSC', 'Você pode usar esta seção para mostrar algum texto descritivo ou introdutório. HTML e permitido.');

define('_AM_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Aqui é onde sua página introdutória vai.<br />Você pode editá-la em "Configuração do Módulo 2".<br /></div>');


define('_AM_WEBLINKS_ADD_CATEGORY', 'Adicionar nova categoria');
define('_AM_WEBLINKS_ERROR_SOME', 'Existem algumas mensagens de erro');
define('_AM_WEBLINKS_LIST_ID_ASC',  'Listado pelo ID antigo');
define('_AM_WEBLINKS_LIST_ID_DESC', 'Listado pelo ID novo');

// config
//define('_AM_WEBLINKS_WARNING_NOT_WRITABLE','The directory is not writeable');

define('_AM_WEBLINKS_CONF_LINK','Configuração do link');
define('_AM_WEBLINKS_CONF_LINK_IMAGE','Configuração da imagem do link');
define('_AM_WEBLINKS_CONF_VIEW','Vizualizar configuração');
define('_AM_WEBLINKS_CONF_TOPTEN','Configuração Top 10');
define('_AM_WEBLINKS_CONF_SEARCH','Configuração da Busca');

define('_AM_WEBLINKS_USE_BROKENLINK','Relatórios dos Links Quebrados');
define('_AM_WEBLINKS_USE_BROKENLINK_DSC','SIM permite os usuários comunicarem link quebrado');
define('_AM_WEBLINKS_USE_HITS','Contar acessos quando pular para o site');
define('_AM_WEBLINKS_USE_HITS_DSC','SIM habilita o contador de acesso do link quando pular para o site');
define('_AM_WEBLINKS_USE_PASSWD','Autenticação da senha');
define('_AM_WEBLINKS_USE_PASSWD_DSC','SIM, <b>usuário anônimo</b> pode modificar um link com autenticação de senha.<br />NO, <br />campo da senha não é mostrado.');
define('_AM_WEBLINKS_PASSWD_MIN','Comprimento mínimo requerido para a senha');
define('_AM_WEBLINKS_POST_TEXT', 'O administrador tem toda a autoridade para administrar');
define('_AM_WEBLINKS_AUTH_DOHTML', 'Permissão para usar tags HTML');
define('_AM_WEBLINKS_AUTH_DOHTML_DSC', 'Especificar os grupos com permissão de uso de tags HTML');
define('_AM_WEBLINKS_AUTH_DOSMILEY', 'Permissão para usar ícones smiley');
define('_AM_WEBLINKS_AUTH_DOSMILEY_DSC', 'Especificar os grupos com permissão de uso de ícones smiley');
define('_AM_WEBLINKS_AUTH_DOXCODE', 'Permissão para usar códigos XOOPS');
define('_AM_WEBLINKS_AUTH_DOXCODE_DSC', 'Especificar os grupos com permissão de uso de códigos XOOPS');
define('_AM_WEBLINKS_AUTH_DOIMAGE', 'Permissões para uso de imagens');
define('_AM_WEBLINKS_AUTH_DOIMAGE_DSC', 'Especificar os grupos com permissão de uso de imagens');
define('_AM_WEBLINKS_AUTH_DOBR', 'Permissão de uso de quebras de linhas');
define('_AM_WEBLINKS_AUTH_DOBR_DSC', 'Especificar os grupos com permissão de uso de quebras de linhas');
define('_AM_WEBLINKS_SHOW_CATLIST','Mostrar a lista de categorias no submenu');
define('_AM_WEBLINKS_SHOW_CATLIST_DSC','SIM mostra a lista da categoria tops no submenu');
define('_AM_WEBLINKS_VIEW_URL','Ver estilo da URL');
define('_AM_WEBLINKS_VIEW_URL_DSC','NENHUM <br />sem url ou &lt;a&gt; tag é mostrada.<br />Indireto<br /> mostra visit.php em href campo ao invés da URL. <br />Direto <br />Mostra url em href campo, JavaScript no campo onmousedown e os acessos são contados através do JavaScript.');
define('_AM_WEBLINKS_VIEW_URL_0','NENHUM');
define('_AM_WEBLINKS_VIEW_URL_1','URL indireta');
define('_AM_WEBLINKS_VIEW_URL_2','URL direta');
define('_AM_WEBLINKS_RECOMMEND_PRI','Prioridade de recomendação de sites');
define('_AM_WEBLINKS_RECOMMEND_PRI_DSC','NENHUM <br />Não mostra.<br />Normal <br />Sites recomendados são mostrados no cabeçalho.<br />Mais alto <br />Mostra os sites recomendados no topo da respectiva categoria.');
define('_AM_WEBLINKS_MUTUAL_PRI','Prioridade de Reciprocidade de Sites');
define('_AM_WEBLINKS_MUTUAL_PRI_DSC','NENHUM <br />Não mostra.<br />Normal <br />Sites recíprocos são mostrados no cabeçalho.<br />Mais alto <br />Mostra os sites recíprocos no topo da respectiva categoria');
define('_AM_WEBLINKS_PRI_0','NENHUM');
define('_AM_WEBLINKS_PRI_1','Normal');
define('_AM_WEBLINKS_PRI_2','Mais alto');
define('_AM_WEBLINKS_LINK_IMAGE_AUTO','Auto atualização do tamanho da imagem do banner');
define('_AM_WEBLINKS_LINK_IMAGE_AUTO_DSC', "SIM <br />atualiza otamanho da imagem do banner automaticamente.");
define('_AM_WEBLINKS_RSS_USE','Usar feed RSS');
define('_AM_WEBLINKS_RSS_USE_DSC','SIM <br />Obter e mostrar feed RSS/ATOM.');

// bulk import
define('_AM_WEBLINKS_BULK_IMPORT','Volume importado');
define('_AM_WEBLINKS_BULK_IMPORT_FILE','Volume importado por arquivo');
define('_AM_WEBLINKS_BULK_CAT','Volume importado de categorias');
define('_AM_WEBLINKS_BULK_CAT_DSC1','Descreve as categorias');
define('_AM_WEBLINKS_BULK_CAT_DSC2','Usar seta a esquerda dos parênteses (>) no começo da categoria para definir a categoria como uma subcategoria.');
define('_AM_WEBLINKS_BULK_LINK','Volume importado de links');
define('_AM_WEBLINKS_BULK_LINK_DSC1', 'Informe a categoria na primeira linha.');
define('_AM_WEBLINKS_BULK_LINK_DSC2', 'Descreve o título do link, URL, e explanação dividada por uma vírgula(,) na segunda linha.');
define('_AM_WEBLINKS_BULK_LINK_DSC3', 'Usar traços para separar a barra horizontal de links(---) .');
define('_AM_WEBLINKS_BULK_ERROR_LAYER','Especificar duas ou mais camadas sob a estrutura da árvore da categoria. Isto precisa esclarecimento G.S.');
define('_AM_WEBLINKS_BULK_ERROR_CID','ID da categoria errada');
define('_AM_WEBLINKS_BULK_ERROR_PID','ID da categoria mãe errada');
define('_AM_WEBLINKS_BULK_ERROR_FINISH','Um erro interrompeu a operação');

// command
//define('_AM_WEBLINKS_CREATE_CONFIG', 'Create Config File');
//define('_AM_WEBLINKS_TEST_EXEC', 'Test execute for %s');

// === 2006-10-05 ===
// menu
define('_AM_WEBLINKS_MODULE_CONFIG_3','Configuração do Módulo 3');
define('_AM_WEBLINKS_MODULE_CONFIG_4','Configuração do Módulo 4');
define('_AM_WEBLINKS_VOTE_LIST', 'Lista de votação');
define('_AM_WEBLINKS_CATLINK_LIST', 'Categorizar a lista de Link');
//define('_AM_WEBLINKS_COMMAND_MANAGE', 'Command Management');
define('_AM_WEBLINKS_TABLE_MANAGE',  'Administração da tabela do Banco de dados');
define('_AM_WEBLINKS_IMPORT_MANAGE', 'Administrar Importação');
define('_AM_WEBLINKS_EXPORT_MANAGE', 'Administrar Exportação');

// config
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_2','Auth, Cat, etc');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_3','Link');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_4','RSS, Fórum, Mapa');
define('_AM_WEBLINKS_LINK_REGISTER','Configurações do Link: Descrição');

// bin configuration
//define('_AM_WEBLINKS_FORM_BIN', 'Command Config');
//define('_AM_WEBLINKS_FORM_BIN_DESC', 'It is used on bin command');
//define('_AM_WEBLINKS_CONF_BIN_PASS','Password');
//define('_AM_WEBLINKS_CONF_BIN_PASS_DESC','');
//define('_AM_WEBLINKS_CONF_BIN_SEND','Send Mail');
//define('_AM_WEBLINKS_CONF_BIN_SEND_DESC','');
//define('_AM_WEBLINKS_CONF_BIN_MAILTO','Email to send');
//define('_AM_WEBLINKS_CONF_BIN_MAILTO_DESC','');

// rssc
//define('_AM_WEBLINKS_RSS_DIRNAME','RSSC Module Dirname');
//define('_AM_WEBLINKS_RSS_DIRNAME_DESC','');

// link manage
define('_AM_WEBLINKS_DEL_LINK', 'Deletar link');
define('_AM_WEBLINKS_ADD_RSSC', 'Adicionar link no módulo RSSC');
define('_AM_WEBLINKS_MOD_RSSC', 'Modificar link no módulo RSSC');
define('_AM_WEBLINKS_REFRESH_RSSC', 'Atualizar o link no módulo RSSC');
define('_AM_WEBLINKS_APPROVE',     'Approvar novo Link');
define('_AM_WEBLINKS_APPROVE_MOD', 'Aprovar solicitação de modificação de Link');
define('_AM_WEBLINKS_RSSC_LID_SAVED', 'Salva lid rssc');
define('_AM_WEBLINKS_GOTO_LINK_LIST', 'IR PARA lista de link');
define('_AM_WEBLINKS_GOTO_LINK_EDIT', 'IR PARA editar link');
define('_AM_WEBLINKS_ADD_BANNER', 'Adicionar tamanho da imagem do banner');
define('_AM_WEBLINKS_MOD_BANNER', 'Modificar tamanho da imagem do banner');

// vote list
define('_AM_WEBLINKS_VOTE_USER', 'Votos de usuários registrados');
define('_AM_WEBLINKS_VOTE_ANON', 'Votos de usuários anônimos');

// locate
define('_AM_WEBLINKS_CONF_LOCATE','Configuração do local');
define('_AM_WEBLINKS_CONF_COUNTRY_CODE','Código do país');
define('_AM_WEBLINKS_CONF_COUNTRY_CODE_DESC', 'Informe o código ccTLDs <br/> <a href="http://www.iana.org/cctld/cctld-whois.htm" target="_blank">IANA: Country-Code Top-Level Domains</a>');
define('_AM_WEBLINKS_CONF_RENEW_COUNTRY_CODE_DESC', 'Atualizar os ítens relacionados ao código do país. <br/> O ítem com o <span style="color:#0000ff;">#</span> mark');
define('_AM_WEBLINKS_RENEW', 'Renovar');

// map
define('_AM_WEBLINKS_CONF_MAP','Configuração do Mapa do Site');
define('_AM_WEBLINKS_CONF_MAP_USE','Usar Mapa do Site');
define('_AM_WEBLINKS_CONF_MAP_TEMPLATE','Modelo do Mapa do Site');
define('_AM_WEBLINKS_CONF_MAP_TEMPLATE_DESC','Informar o nome do modelo de arquivo do diretório template/map/ ');

// google map: hacked by wye <http://never-ever.info/>
define('_AM_WEBLINKS_CONF_GOOGLE_MAP','Configuração do Google Maps');
define('_AM_WEBLINKS_CONF_GM_USE','Usar Google Maps');
define('_AM_WEBLINKS_CONF_GM_APIKEY','Chave API do Google Maps');
define('_AM_WEBLINKS_CONF_GM_APIKEY_DESC', 'Obter a chave API em <br/> <a href="http://www.google.com/apis/maps/signup.html" target="_blank">http://www.google.com/apis/maps/signup.html</a> <br/> Quando você usar o GoogleMaps.' );
define('_AM_WEBLINKS_CONF_GM_SERVER','Nome do Servidor');
define('_AM_WEBLINKS_CONF_GM_LANG',  'Código da Linguagem');
define('_AM_WEBLINKS_CONF_GM_LOCATION', 'Local padrão');
define('_AM_WEBLINKS_CONF_GM_LATITUDE', 'Latitude padrão');
define('_AM_WEBLINKS_CONF_GM_LONGITUDE','Longitude padrão');
define('_AM_WEBLINKS_CONF_GM_ZOOM',     'Nível de zoom padrão');

// google search
define('_AM_WEBLINKS_CONF_GOOGLE_SEARCH','Confirmação Busca Google');
define('_AM_WEBLINKS_CONF_GOOGLE_SERVER','Nome do Servidor');
define('_AM_WEBLINKS_CONF_GOOGLE_LANG',  'Código da Linguagem');

// template
//define('_AM_WEBLINKS_CONF_TEMPLATE','Clear cache of Templates');
define('_AM_WEBLINKS_CONF_TEMPLATE_DESC','DEVE executar, quando da modificação dos arquivos de modelo nos diretórios template/parts/ template/xml/ e template/map/ ');

// === 2006-12-11 ===
// link item
//define('_AM_WEBLINKS_TIME_PUBLISH','Set the publication time');
//define('_AM_WEBLINKS_TIME_PUBLISH_DESC','If you do not check it, published time will become undated');
//define('_AM_WEBLINKS_TIME_EXPIRE','Set expiration time');
//define('_AM_WEBLINKS_TIME_EXPIRE_DESC','If you do not check it, expired setting will become undated');
define('_AM_WEBLINKS_LINK_TIME_PUBLISH_BEFORE','Listar link antes do tempo da publicação');
define('_AM_WEBLINKS_LINK_TIME_EXPIRE_AFTER',  'Listar link depois do tempo de vencimento da publicação');

define('_AM_WEBLINKS_SERVER_ENV','Ambiente do servidor ');
define('_AM_WEBLINKS_DEBUG_CONF','Variáveis depuradas');
define('_AM_WEBLINKS_ALL_GREEN','Tudo Verde');

// === 2007-02-20 ===
// performance
define('_AM_WEBLINKS_UPDATE_CAT_PATH','Atualizar percurso da árvore da categoria');
define('_AM_WEBLINKS_UPDATE_CAT_COUNT','Atualizar contagem da categoria do link');
define('_AM_WEBLINKS_CAT_COUNT_UPDATED','percurso da árvore da categoria atualizada');

// config
define('_AM_WEBLINKS_SYSTEM_POST_LINK','Postar contagem quando enviar link');
define('_AM_WEBLINKS_SYSTEM_POST_LINK_DSC','SIM conta o post do usuário XOOPS quando ele enviar um novo link. ');
define('_AM_WEBLINKS_SYSTEM_POST_RATE','Postar contagem quando avaliar link');
define('_AM_WEBLINKS_SYSTEM_POST_RATE_DSC','SIM conta o post do usuário XOOPS quando ele avaliar o link. ');

define('_AM_WEBLINKS_VIEW_STYLE_CAT','Vizualizar o estilo de cada categoria');
define('_AM_WEBLINKS_VIEW_STYLE_MARK','Ver o estilo no Site Recomendado');
define('_AM_WEBLINKS_VIEW_STYLE_MARK_DSC','Isso aplica em Site Recomendado, Site Recíproco e Site RSS/ATOM');
define('_AM_WEBLINKS_VIEW_STYLE_0','Sumário');
define('_AM_WEBLINKS_VIEW_STYLE_1','Todos os detalhes');

define('_AM_WEBLINKS_CONF_PERFORMANCE','Melhoria da performance');
define('_AM_WEBLINKS_CONF_PERFORMANCE_DSC','Por causa da melhoria na performance, isso processa os dados necessários antes, quando mostrado, e os armazena no banco de dados.<br />Quando usado pela primeira vez, execute "lista de categoria" -> "Atualização do percurso da árvore da categoria"');
define('_AM_WEBLINKS_CAT_PATH','Percurso da árvore da categoria');
define('_AM_WEBLINKS_CAT_PATH_DSC','SIM processa o percurso da árvore da categoria e o armazena na tabela da categoria.<br />NÃO processa quando mostrado.');
define('_AM_WEBLINKS_CAT_COUNT','Category link count');
define('_AM_WEBLINKS_CAT_COUNT_DSC','SIM processa a contagem da categoria do link e a armazena na tabela da categoria.<br />NÃO processa quando mostrado.');

define('_AM_WEBLINKS_POST_TEXT_4', 'Tods os itens são mostrados na página administrativa');
define('_AM_WEBLINKS_LINK_REGISTER_1','Configurações do Link: Textarea1');

define('_AM_WEBLINKS_CONF_LINK_GUEST','Configuração do registro do link de convidado');
define('_AM_WEBLINKS_USE_CAPTCHA','Usar CAPTCHA');
define('_AM_WEBLINKS_USE_CAPTCHA_DSC','CAPTCHA é uma tecnica para anti-spam.<br />Esta característica precisa do módulo Captcha.<br />YES, <b>usuário anônimo</b> deve usar CAPTCHA quando adicionar ou modificar um link.<br />NÃO não mostra o campo CAPTCHA.');
define('_AM_WEBLINKS_CAPTCHA_FINDED',     'Módulo Captcha ver %s é encontrado');
define('_AM_WEBLINKS_CAPTCHA_NOT_FINDED', 'Módulo Captcha não encontrado');

define('_AM_WEBLINKS_CONF_SUBMIT', 'Descrição do link no formulario de registro');
define('_AM_WEBLINKS_SUBMIT_MAIN',    'Descrição de adicionar novo link: 1');
define('_AM_WEBLINKS_SUBMIT_PENDING', 'Descrição de adicionar novo link: 2');
define('_AM_WEBLINKS_SUBMIT_DOUBLE',  'Descrição de adicionar novo link: 3');
define('_AM_WEBLINKS_SUBMIT_MAIN_DSC',   'Mostrar sempre');
define('_AM_WEBLINKS_SUBMIT_PENDING_DSC','Mostrar quando no modo "Administrador necessita aprovar"');
define('_AM_WEBLINKS_SUBMIT_DOUBLE_DSC', 'Mostrar quando no modo "Existe alguma checagem de link"');

define('_AM_WEBLINKS_MODLINK_MAIN',     'Descrição da modificação de link: 1');
define('_AM_WEBLINKS_MODLINK_PENDING',  'Descrição da modificação de link: 2');
define('_AM_WEBLINKS_MODLINK_NOT_OWNER','Descrição da modificação de link: 3');
define('_AM_WEBLINKS_MODLINK_NOT_OWNER_DSC','Mostrar quando no modo "Administrador necessita aprovar" e não o proprietário');

define('_AM_WEBLINKS_CONF_CAT_FORUM', 'Vizualizar o Fórum na categoria');
define('_AM_WEBLINKS_CONF_LINK_FORUM', 'Vizualizar o Fórum no link');
//define('_AM_WEBLINKS_FORUM_SEL', 'Select Forum module');
define('_AM_WEBLINKS_FORUM_THREAD_LIMIT', 'Número de Thread mostrado');
define('_AM_WEBLINKS_FORUM_POST_LIMIT', 'Número de posts mostrados em cada Thread');
define('_AM_WEBLINKS_FORUM_POST_ORDER', 'Ordenação do Post');
define('_AM_WEBLINKS_FORUM_POST_ORDER_0', 'Data do post mais antigo');
define('_AM_WEBLINKS_FORUM_POST_ORDER_1', 'Data do último post');
//define('_AM_WEBLINKS_FORUM_INSTALLED',     'Forum module ( %s ) ver %s is installed');
//define('_AM_WEBLINKS_FORUM_NOT_INSTALLED', 'Forum module ( %s ) is not installed');

// === 2007-03-25 ===
define('_AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE','Atualização do tamanho da imagem da categoria');

define('_AM_WEBLINKS_CONF_INDEX', 'Configuração da Página Index');
define('_AM_WEBLINKS_CONF_INDEX_GM_MODE', 'Modo Google Map');

define('_AM_WEBLINKS_CAT_SHOW_GM',   'Mostrar Google map');
define('_AM_WEBLINKS_MODE_NON',       'Não mostrar');
define('_AM_WEBLINKS_MODE_DEFAULT',   'Valor Padrão');
define('_AM_WEBLINKS_MODE_PARENT',    'Como categoria mãe');
define('_AM_WEBLINKS_MODE_FOLLOWING', 'valor seguinte');

define('_AM_WEBLINKS_CONF_CAT_ALBUM',  'Vizualizar Álbum na categoria');
define('_AM_WEBLINKS_CONF_LINK_ALBUM', 'Vizualizar Álbum no link');
//define('_AM_WEBLINKS_ALBUM_SEL', 'Select Album module');
define('_AM_WEBLINKS_ALBUM_LIMIT', 'Número de fotos mostradas');
define('_AM_WEBLINKS_WHEN_OMIT', 'Processar quando omitida');

define('_AM_WEBLINKS_MODULE_INSTALLED',     '%s módulo ( %s ) ver %s está instalado');
define('_AM_WEBLINKS_MODULE_NOT_INSTALLED', '%s módulo ( %s ) não está instalado');

// === 2007-04-08 ===
define('_AM_WEBLINKS_CAT_DESC_MODE',  'Mostrar descrição');
define('_AM_WEBLINKS_CAT_SHOW_FORUM', 'Mostrar Fórum');
define('_AM_WEBLINKS_CAT_SHOW_ALBUM', 'Mostrar Álbum');
define('_AM_WEBLINKS_MODE_SETTING',   'Configuração de valor');
define('_AM_WEBLINKS_MODE_OMIT_PARENT', 'Igual a categoria mãe quando omitido');

// === 2007-06-10 ===
// d3forum
define('_AM_WEBLINKS_CONF_D3FORUM', 'Integração de comentários com o módulo d3forum');
define('_AM_WEBLINKS_PLUGIN_SEL',   'Selecionar Plugin');
define('_AM_WEBLINKS_DIRNAME_SEL',  'Selecionar Módulo');

// category
define('_AM_WEBLINKS_CAT_PATH_STYLE', 'Vizualizar o estilo do percurso da categoria');

// category page
define('_AM_WEBLINKS_CONF_CAT_PAGE', 'Configuração da página da Categoria');
define('_AM_WEBLINKS_CAT_COLS', 'Número de colunas nas categorias');
define('_AM_WEBLINKS_CAT_COLS_DESC', 'Na página da categoria especifique o número de colunas, quando mostrar as categorias sob uma hierarquia');
define('_AM_WEBLINKS_CAT_SUB_MODE', 'Vizualizar a faixa da subcategoria');
define('_AM_WEBLINKS_CAT_SUB_MODE_1', 'Apenas categorias sob uma hierarquia');
define('_AM_WEBLINKS_CAT_SUB_MODE_2', 'Todas as categorias sob uma ou mais hierarquias');

// === 2007-07-14 ===
// highlight
define('_AM_WEBLINKS_USE_HIGHLIGHT', 'Usar palavra-chave sublinhada');
define('_AM_WEBLINKS_CHECK_MAIL', 'Checar formato do e-mail');
define('_AM_WEBLINKS_CHECK_MAIL_DSC', 'NÃOO permite qualquer formato. <br /> SIM checa se o formato do e-mail é como abc@efg.com quando do registro do link. ');
//define('_AM_WEBLINKS_NO_EMAIL', 'Not Set Email Address');

// === 2007-08-01 ===
// config
define('_AM_WEBLINKS_MODULE_CONFIG_0','Configuração do Módulo');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_0','Index');
define('_AM_WEBLINKS_MODULE_CONFIG_5','Configuração do Módulo 5');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_5','Item do registro do Link');
define('_AM_WEBLINKS_MODULE_CONFIG_6','Configuração do Módulo 6');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_6','Google Map');

// google map
define('_AM_WEBLINKS_GM_MAP_CONT',  'Controle do Map');
define('_AM_WEBLINKS_GM_MAP_CONT_DESC',  'GLargeMapControl, GSmallMapControl, GSmallZoomControl');
define('_AM_WEBLINKS_GM_MAP_CONT_NON',   'Não mostrar');
define('_AM_WEBLINKS_GM_MAP_CONT_LARGE', 'Controle amplo');
define('_AM_WEBLINKS_GM_MAP_CONT_SMALL', 'Controle pequeno');
define('_AM_WEBLINKS_GM_MAP_CONT_ZOOM',  'Zoom do Controle');
define('_AM_WEBLINKS_GM_USE_TYPE_CONT',  'Usar controle do tipo de Mapa');
define('_AM_WEBLINKS_GM_USE_TYPE_CONT_DESC',  'GMapTypeControl');
define('_AM_WEBLINKS_GM_USE_SCALE_CONT',  'Usar controle da escala');
define('_AM_WEBLINKS_GM_USE_SCALE_CONT_DESC',  'GScaleControl');
define('_AM_WEBLINKS_GM_USE_OVERVIEW_CONT',  'Usar controle sobrescrito do Mapa');
define('_AM_WEBLINKS_GM_USE_OVERVIEW_CONT_DESC',  'GOverviewMapControl');
define('_AM_WEBLINKS_GM_MAP_TYPE', '[Busca] Tipo de Mapa');
define('_AM_WEBLINKS_GM_MAP_TYPE_DESC', 'GMapType');
define('_AM_WEBLINKS_GM_GEOCODE_KIND',  '[Busca] Tipo de Geocode');
define('_AM_WEBLINKS_GM_GEOCODE_KIND_DESC',  'Buscar latitude e longitude para o endereço<br /><b>Resultado único</b><br />GClientGeocoder - getLatLng<br /><b>Mais resultados</b><br />GClientGeocoder - getLocations');
define('_AM_WEBLINKS_GM_GEOCODE_KIND_LATLNG', 'Resultado único: getLatLng');
define('_AM_WEBLINKS_GM_GEOCODE_KIND_LOCATIONS',   'Mais resultados: getLocations');
define('_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO',  '[Busca][Japan] Usar CSIS');
define('_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO_DESC',  'Válido no Japão<br />Buscar latitude e longitude para o endereço');
define('_AM_WEBLINKS_GM_USE_NISHIOKA',  '[Busca][Japão] Use Inverse Geocode');
define('_AM_WEBLINKS_GM_USE_NISHIOKA_DESC',  'Válido no Japão<br />Buscar endereço para a latitude e longitude<br /><a href="http://nishioka.sakura.ne.jp/google/" target="_blank">http://nishioka.sakura.ne.jp/google/</a>');
define('_AM_WEBLINKS_GM_TITLE_LENGTH',  '[Marcador] Máximo de caracteres para o título');
define('_AM_WEBLINKS_GM_TITLE_LENGTH_DESC',  'Número máximo de caracteres usados no título no marcador<br /><b>-1</b> é ilimitado');
define('_AM_WEBLINKS_GM_DESC_LENGTH',  '[Marcador] Máximo de caracteres para o conteúdo');
define('_AM_WEBLINKS_GM_DESC_LENGTH_DESC',  'Número máximo de caracteres usados para o conteúdo no marcador<br /><b>-1</b> é ilimitado');
define('_AM_WEBLINKS_GM_WORDWRAP',  '[Marcador] Máximo de caracteres no procesamento das palavras');
define('_AM_WEBLINKS_GM_WORDWRAP_DESC',  'Número máximo de caracteres usados por linha wordwrap) mo marcador<br /><b>-1</b> é ilimitado');
define('_AM_WEBLINKS_GM_USE_CENTER_MARKER',  '[Marcador] Mostrar o centro do marcador');
define('_AM_WEBLINKS_GM_USE_CENTER_MARKER_DESC',  'Mostrar o centro do marcador na página principal e página da categoria');

// map jp
define('_AM_WEBLINKS_MAP_JP_MANAGE', 'Configuração do mapa do Japão');

// column
define('_AM_WEBLINKS_COLUMN_MANAGE', 'Administrar coluna');
define('_AM_WEBLINKS_COLUMN_MANAGE_DESC', 'Adicionar colunas na tabela dos links e modificar tabela');
define('_AM_WEBLINKS_COLUMN_MANAGE_NOT_USE', 'Não usar');
define('_AM_WEBLINKS_THERE_ARE_COLUMN', 'Existem <b>%s</b> colunas na tabela do link');
define('_AM_WEBLINKS_COLUMN_NUM', 'Número de colunas adicionadas');
define('_AM_WEBLINKS_COLUMN_BIGGER_USE', 'O número de colunas é maior do que o número na tabela de links');
define('_AM_WEBLINKS_COLUMN_UNMATCH',  'As colunas não combinam na tabela do link e tabela modificada');
define('_AM_WEBLINKS_PHPMYADMIN',  'Corriga nas ferramentas administrativa como o phpMyAdmin');
define('_AM_WEBLINKS_LINK_NUM_ETC', 'O número de colunas');

// latest
define('_AM_WEBLINKS_INDEX_MODE_LATEST', 'Ordenação dos últimos links');
define('_AM_WEBLINKS_INDEX_MODE_LATEST_UPDATE', 'Dado Atualizado');
define('_AM_WEBLINKS_INDEX_MODE_LATEST_CREATE', 'Dado criado');

// header
define('_AM_WEBLINKS_CONF_HTML_STYLE', 'Configuração do estilo do HTML');
define('_AM_WEBLINKS_HEADER_MODE', 'Usar módulo xoops cabeçalho');
define('_AM_WEBLINKS_HEADER_MODE_DESC', 'Quando "Não", mostra a folha de estilo e tag Javascript no corpo<br />Quando "Sim", mostra as tags no cabeçalho, usando o cabeçalho do módulor xoops<br />existem alguns temas que não podem ser usados');

// bulk
define('_AM_WEBLINKS_BULK_SAMPLE','Você pode ver um exemplo clicando no botão');
define('_AM_WEBLINKS_BULK_LINK_DSC10','Registro dos itens estão solucionados');
define('_AM_WEBLINKS_BULK_LINK_DSC20','Administração dos itens de registros específicos');
define('_AM_WEBLINKS_BULK_LINK_DSC21','Primeiro parágrafo');
define('_AM_WEBLINKS_BULK_LINK_DSC22','Segundo parágrafo e seguintes');
define('_AM_WEBLINKS_BULK_LINK_DSC23','Informe os nomes do item registrado na primeira linha.<br />Informe a barra horizontal (---)');
define('_AM_WEBLINKS_BULK_LINK_DSC24','Descreve os itens registrados para a ordenação do primeiro parágrafo, divido por uma vírgula(,) na segunda linha.');
define('_AM_WEBLINKS_BULK_CHECK_URL','Checar a configuração da URL');
define('_AM_WEBLINKS_BULK_CHECK_DESCRIPTION','Checar a configuração da descrição');

// === 2007-09-01 ===
// auth
define('_AM_WEBLINKS_AUTH_DELETE','Pode deletar');
define('_AM_WEBLINKS_AUTH_DELETE_DSC','Especificar os grupos com permissão para enviar solicitações para apagar links');
define('_AM_WEBLINKS_AUTH_DELETE_AUTO','Pode aprovar apagamento de link');
define('_AM_WEBLINKS_AUTH_DELETE_AUTO_DSC','Especificar os grupos com permissão para aprovar solicitações para apagar links');

// nofitication
define('_AM_WEBLINKS_NOTIFICATION_MANAGE', 'Administração de Notificações');
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_DESC', 'Configuração para cada administrador do módulo<br />É a mesma da página top do módulo');
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_NOT_USE', "Você não pode usar em algumas versões do XOOPS");
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_PLEASE', 'Neste cado, por favor use na página top deste módulo');
define('_AM_WEBLINKS_SUBJ_LINK_MOD_APPROVED', '[{X_SITENAME}] {X_MODULE}: Sua solicitação de modificação de link foi aprovada');
define('_AM_WEBLINKS_SUBJ_LINK_MOD_REFUSED',  '[{X_SITENAME}] {X_MODULE}: Sua solicitação de modificação de link foi rejeitada');
define('_AM_WEBLINKS_SUBJ_LINK_DEL_APPROVED', '[{X_SITENAME}] {X_MODULE}: Sua solicitação de apagar o link foi aprovada');
define('_AM_WEBLINKS_SUBJ_LINK_DEL_REFUSED',  '[{X_SITENAME}] {X_MODULE}: Sua solicitação de apagar o link foi rejeitada');

// config
define('_AM_WEBLINKS_ADMIN_WAITING_SHOW', 'Mostrar administração da lista de pendências');
define('_AM_WEBLINKS_USER_WAITING_NUM',   'Número de links usados na lista de pendências');
define('_AM_WEBLINKS_USER_OWNER_NUM',     'Número de usuários listados que submeteram lista');
define('_AM_WEBLINKS_USE_HITS_SINGLELINK','Contagem de acessos quando mostra link único');
define('_AM_WEBLINKS_USE_HITS_SINGLELINK_DSC','SIM habilita a contagem do contador de acessos, quando mostra o link único');
define('_AM_WEBLINKS_MODE_RANDOM', 'Redirecionar para salto aleatório');
define('_AM_WEBLINKS_MODE_RANDOM_URL', 'url do site registrado');
define('_AM_WEBLINKS_MODE_RANDOM_SINGLE', 'link único neste módulo');

// request list
define('_AM_WEBLINKS_DEL_REQS', 'Apagamento de Links aguardadando por validação');
define('_AM_WEBLINKS_NO_DEL_REQ','Sem pedidos de apagamento de links');
define('_AM_WEBLINKS_DEL_REQ_DELETED','Pedido de apagamento deletado');

// link list
define('_AM_WEBLINKS_LINK_USERCOMMENT_DESC','Lista de link com comentários para administrar (Listados por novo ID)');

// clone
define('_AM_WEBLINKS_CLONE_LINK', 'Clonar');
define('_AM_WEBLINKS_CLONE_MODULE', 'Clomnar para outro módulo');
define('_AM_WEBLINKS_CLONE_CONFIRM', 'Confirmar para clonar');
define('_AM_WEBLINKS_NO_MODULE', 'Não há módulo correspondente');

// link form
define('_AM_WEBLINKS_MODIFIED', 'Modificado');
define('_AM_WEBLINKS_CHECK_CONFIRM', 'Confirmado');
define('_AM_WEBLINKS_WARN_CONFIRM', 'Aviso: Checar para "Confirmar" de %s');
define('_AM_WEBLINKS_RSSC_LID_EXIST_MORE', 'Existem dois ou mais links que tem o mesmo "ID RSSC"');

// web shot
define('_AM_WEBLINKS_LINK_IMG_THUMB', 'A substituição da imagem do link');
define('_AM_WEBLINKS_LINK_IMG_THUMB_DSC', 'mostrar a miniatura do WEB site ao invés do link da imagem, <br />usando a miniatura do serviço web, <br />se não configurado o link da imagem.');
define('_AM_WEBLINKS_LINK_IMG_NON', 'nenhum');
//define('_AM_WEBLINKS_LINK_IMG_MOZSHOT', 'Use <a href="http://mozshot.nemui.org/" target="_blank">MozShot</a>');
//define('_AM_WEBLINKS_LINK_IMG_SIMPLEAPI', 'Use <a href="http://img.simpleapi.net/" target="_blank">SimpleAPI</a>');

// === 2007-11-01 ===
// google map
define('_AM_WEBLINKS_GM_MARKER_WIDTH',  '[Marcador] Largura(pixel)');
define('_AM_WEBLINKS_GM_MARKER_WIDTH_DESC',  'Largura do marcador do mapa info<br /><b>-1</b> está não especificado');
define('_AM_WEBLINKS_LINK_IMG_USE', 'Usar %s');

define('_AM_WEBLINKS_RSS_SITE', 'Este site');
define('_AM_WEBLINKS_RSS_FEED', 'Feeds RSS');

// nameflag mainflag
define('_AM_WEBLINKS_CONF_LINK_USER','Configuração do usuário que regstrou o link');
define('_AM_WEBLINKS_USER_NAMEFLAG','Selecionar a vizualização do nome da bandeira');
define('_AM_WEBLINKS_USER_MAILFLAG','Selecionar a vizualização da bandeira do e-mail');
define('_AM_WEBLINKS_USER_NAME_MAIL_FLAG_DESC','O valor padrão quando o usuário registrado<br />O administrador pode mudar o valor');
define('_AM_WEBLINKS_USER_NAME_MAIL_FLAG_SEL','A escolha do usuário');

// description length
define('_AM_WEBLINKS_DESC_LENGTH', 'Comprimento máximo dos caracteres');
define('_AM_WEBLINKS_DESC_LENGTH_DSC', '<b>-1</b> ou o administrador: limite 64KB<br />');

// === 2007-12-09 ===
define("_AM_WEBLINKS_D3FORUM_VIEW", "Tipo de vizualização do comentário");

// === 2008-02-17 ===
// config
define('_AM_WEBLINKS_MODULE_CONFIG_7','Configuração do Módulo 7');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_7','Menu');
define('_AM_WEBLINKS_CONF_MENU', 'Vizualização do Menu');
define('_AM_WEBLINKS_CONF_MENU_DESC', 'A configuração que remete à vista do menu');
define('_AM_WEBLINKS_CONF_TITLE','Título do Menu');

// htmlout
define('_AM_WEBLINKS_OUTPUT_PLUGIN_MANAGE', 'Administração do pluglin do HTML de saída');
define('_AM_WEBLINKS_HTMLOUT', 'Plugin de saida do HTML');
define('_AM_WEBLINKS_RSSOUT',  'Plugin de saida do RSS');
define('_AM_WEBLINKS_KMLOUT',  'Plugin de saida do KML');

// pagerank
define('_AM_WEBLINKS_LINK_CHECK_MANAGE', 'Administrar checagem de Link');
define('_AM_WEBLINKS_USE_PAGERANK', 'Mostrar PageRank');
define('_AM_WEBLINKS_USE_PAGERANK_DESC', '"Mostrar" : mostra o pagerank na barra do menu, lista o link e o link único');
define('_AM_WEBLINKS_USE_PAGERANK_NON',   'Não mostrar');
define('_AM_WEBLINKS_USE_PAGERANK_SHOW',  'Mostrar');
define('_AM_WEBLINKS_USE_PAGERANK_CACHE', 'Mostrar usando cache da obternção do PageRank');

// kml
define('_AM_WEBLINKS_KML_USE', 'Mostrar KML');

}
// --- define language begin ---

?>
