<?php
// $Id: modinfo.php,v 1.1 2011/12/29 14:32:50 ohwada Exp $

// 2008-02-17
// remove _MI_WEBLINKS_SMNAME1

// 2007-12-09
// remove _MI_WEBLINKS_LINK_APPROVE_NOTIFYSBJ

// 2007-09-01
// notification: new_link_admin

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
define("_MI_WEBLINKS_NAME","Links");

// A brief description of this module
define("_MI_WEBLINKS_DESC","Cria uma seção de links onde usuários podem buscar/enviar/avaliar varios web sites.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_WEBLINKS_BNAME1","Links recentes");
define("_MI_WEBLINKS_BNAME2","Top Links");
define("_MI_WEBLINKS_BNAME3","Links populares");

// Sub menu titles
define("_MI_WEBLINKS_SMNAME1","Enviar");
define("_MI_WEBLINKS_SMNAME2","Site Popular ");
define("_MI_WEBLINKS_SMNAME3","Site melhor avaliado");

// Names of admin menu items
define("_MI_WEBLINKS_ADMENU1","Configuração do Modulo 2");
define("_MI_WEBLINKS_ADMENU2","Gerenciamento de Categoria");
define("_MI_WEBLINKS_ADMENU3","Gerenciamento de Link");
define("_MI_WEBLINKS_ADMENU4","Incluir novo Link");
define("_MI_WEBLINKS_ADMENU5","Novos Links esperando validação");
define("_MI_WEBLINKS_ADMENU6","Links modificados esperando por validação");
define("_MI_WEBLINKS_ADMENU7","Relatório de Links quebrados");
//define("_MI_WEBLINKS_ADMENU8","Verificador de Link");

//-------------------------------------
// Título of config items
// Description of each config items
//-------------------------------------
define('_MI_WEBLINKS_POPULAR', 'Selecione o numero de hits para um link ser marcado como popular');
define('_MI_WEBLINKS_POPULARDSC', 'Informe o numero minimo de hits para exibir o icone "POPULAR". <br /> Quando selecionado 0, não exibe o ícone. ');
define('_MI_WEBLINKS_NEWLINKS', 'Selecione o numero maximo de novos links exibidos na top page');

//define('_MI_WEBLINKS_NEWLINKSDSC', 'Informe o numero maximo de links a ser exibidos no bloco "Novos Links". ');
define('_MI_WEBLINKS_NEWLINKSDSC', 'Informe o numero maximo de links a ser exibidos na página principal. ');

define('_MI_WEBLINKS_PERPAGE', 'Informe o numero maximo de links a ser exibido em cada página');
define('_MI_WEBLINKS_PERPAGEDSC', 'Informe o numero maximo de links para exibir detalhes por página');

//define('_MI_WEBLINKS_USESHOTS', 'Selecione sim para exibir screenshot para cada link');
//define('_MI_WEBLINKS_USESHOTSDSC', '');
//define('_MI_WEBLINKS_SHOTWIDTH', 'Largura maxima permitida para cada imagem de screenshot');
//define('_MI_WEBLINKS_SHOTWIDTHDSC', '');

//define('_MI_WEBLINKS_ANONPOST','Permitir visitantes enviarem links?');
//define('_MI_WEBLINKS_AUTOAPPROVE','Auto aprovação de novos links sem intervenção do administrdor?');
//define('_MI_WEBLINKS_AUTOAPPROVEDSC','');

//-------------------------------------
// Text for notifications
//-------------------------------------
define('_MI_WEBLINKS_GLOBAL_NOTIFY', 'Global');
define('_MI_WEBLINKS_GLOBAL_NOTIFYDSC', 'Opção de notificação de links globais.');

define('_MI_WEBLINKS_CATEGORY_NOTIFY', 'Categoria');
define('_MI_WEBLINKS_CATEGORY_NOTIFYDSC', 'Opções de notificação que se aplica a categoria do link corrente.');

define('_MI_WEBLINKS_LINK_NOTIFY', 'Link');
define('_MI_WEBLINKS_LINK_NOTIFYDSC', 'Opções de notificação que se aplicam ao link currente.');

define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFY', 'Nova categoria');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Notificar-me quando uma nova categoria for criada.');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Receber uma notificação quando uma nova categoria for criada.');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação : Nova categoria');

define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFY', 'Requisitada modificação de Link');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYCAP', 'Notificar qualquer requisição de modificação de link.');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYDSC', 'Receber uma notificação quando qualquer requisição de modificação for enviada.');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação : Requisitado modifcação de link');

define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFY', 'Link quebrado enviado');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYCAP', 'Notificar qualquer relatório de broken link.');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYDSC', 'Receber uma notificação quando qualquer relatório de broken link report for enviado.');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação : Relatório de Broken Link');

define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFY', 'Novo link enviado');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYCAP', 'Notificar quando qualquer novo link for enviado (aguardando aprovação).');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYDSC', 'Receber notificação quando qualquer novo link for enviado (aguardando aprovação).');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação : Novo link enviado');

define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFY', 'Novo link');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYCAP', 'Notificar quando qualquer novo link for afixado.');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYDSC', 'Receber notificação quando qualquer novo link for afixado.');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação : Novo link');

define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFY', 'Novo link enviado');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYCAP', 'Notificar quando um novo link for enviado (aguardando aprovação) para a categoria corrente.');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYDSC', 'Receber notificação quando um novo link for enviado (aguardando aprovação) para a categoria corrente.');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação : Novo link enviado na categoria');

define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFY', 'Novo link');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYCAP', 'Notificar quando um novo link for afixado para a categoria corrente.');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYDSC', 'Receber notificação quando um novo link for afixado para a categoria corrente.');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação : Novo link na categoria');

define('_MI_WEBLINKS_LINK_APPROVE_NOTIFY', 'Link aprovado');
define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYCAP', 'Notificar quando este link for aprovado.');
define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYDSC', 'Receber notificação quando este link for aprovado.');
define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação : Link aprovado');


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
// === Names of blocks for this module ===
define("_MI_WEBLINKS_BNAME4","Categorias de Web links");
define("_MI_WEBLINKS_BNAME5","Ultimos RSS/ATOM feeds de Web links");
define("_MI_WEBLINKS_BNAME6","Exibe blog de Web links");

//-------------------------------------
// Título of config items
//-------------------------------------
define('_MI_WEBLINKS_LOGOSHOW','Exibir o mmódulo de logo imagem');
define('_MI_WEBLINKS_LOGOSHOWDSC', 'Selecione "SIM" para exibir o modulo logo imagem.');

define('_MI_WEBLINKS_TITLESHOW','Exibe o modulo de título');
define('_MI_WEBLINKS_TITLESHOWDSC', 'Selecione "SIM" para exibir o modulo título');

define('_MI_WEBLINKS_NEWDAYS', 'Selecione o numero de dias para links serem marcados como novo');
define('_MI_WEBLINKS_NEWDAYS_DSC', 'Informe o numero de hits para exibir o ícone "NOVO". <br /> Quando selecionado 0, não exibe ícone. ');

define('_MI_WEBLINKS_DESCSHORT', 'Numero maximo de caracteres usados para a lista de explanação do link ');
define('_MI_WEBLINKS_DESCSHORTDSC', 'Informe o numero maximo de caracteres para ser usado para lista de explanaação de um link. ');

define('_MI_WEBLINKS_ORDERBY', 'Valor padrão para ordem na exibição de detalhes do link');
define('_MI_WEBLINKS_ODERBYTDSC', 'Informe valor padrão na exibição de detalhes do link.');
define("_MI_WEBLINKS_ORDERBY0","Título (A a Z)");
define("_MI_WEBLINKS_ORDERBY1","Título (Z a A)");
define("_MI_WEBLINKS_ORDERBY2","Data (Registro em ordem ascendente)");
define("_MI_WEBLINKS_ORDERBY3","Data (Registro em ordem descendente)");
define("_MI_WEBLINKS_ORDERBY4","Avaliação (ordem ascendente)");
define("_MI_WEBLINKS_ORDERBY5","Avaliação (ordem descendente)");
define("_MI_WEBLINKS_ORDERBY6","Popularidade (ordem ascendente)");
define("_MI_WEBLINKS_ORDERBY7","Popularidade (ordem descendente)");

define('_MI_WEBLINKS_SEARCH_LINKS','Numero de links exibidos em resultado de busca');
define('_MI_WEBLINKS_SEARCH_LINKSDSC', 'Informe o numero maximo de links para exibir em resultado de busca');

define('_MI_WEBLINKS_SEARCH_MIN', 'Minimo de letras para uma chave de busca');
define('_MI_WEBLINKS_SEARCH_MINDSC', 'Informe o numero minimo de caracteres para uma chave de busca ');

define('_MI_WEBLINKS_USEFRAMES', 'Você gostaria de exibir a página de links em um frame?');
define('_MI_WEBLINKS_USEFRAMEDSC', 'Se exibe uma página de link dentro de um frame');

define('_MI_WEBLINKS_BROKEN','Quantidde de link broken para parar exibição');
define('_MI_WEBLINKS_BROKENDSC', 'Informe quantidade de link broken para parar exibição. <br /> Quando abaixo deste valor, será considerado como um erro temporário, e não executa nada. <br />Quando ultrapassar este valor, será considerado um erro para correção, e para a exibição.');

define('_MI_WEBLINKS_LISTIMAGE_USE','Use imagens de link para uma lista de link');
define('_MI_WEBLINKS_LISTIMAGE_WIDTH','Largura maxima de uma imagem do link');
define('_MI_WEBLINKS_LISTIMAGE_HEIGHT','Tamanho maximo de uma imagem de link');
define('_MI_WEBLINKS_LISTIMAGE_USEDSC', 'Selecione "SIM" para exibir imagens de links quando exibindo uma lista de links');

define('_MI_WEBLINKS_LINKIMAGE_USE','Use imagens de link para exibir detalhes do link');
define('_MI_WEBLINKS_LINKIMAGE_WIDTH','Largura maxima de uma imagem para detalhes de um link');
define('_MI_WEBLINKS_LINKIMAGE_HEIGHT','Tamanho maximo de uma imagem para exibir detalhes de um link');
define('_MI_WEBLINKS_LINKIMAGE_USEDSC', 'Selecione "SIM" para exibir imagens de link quando exibindo detalhes de um link.');





// 2005-10-20 K.OHWADA
define('_MI_WEBLINKS_TOPTEN_STYLE','Estilo do top dez');
define('_MI_WEBLINKS_TOPTEN_STYLE_DSC', 'Selecionar estilo no "Site popular" e "Site melhor avaliado". ');
define('_MI_WEBLINKS_TOPTEN_STYLE_0','Cada categoria top');
define('_MI_WEBLINKS_TOPTEN_STYLE_1','Mixado: Todas as categorias');

define('_MI_WEBLINKS_TOPTEN_LINKS', 'O número máximo de links top dez');
define('_MI_WEBLINKS_TOPTEN_LINKS_DSC', 'Informe o número máximo de links a serem mostrados em "Site Popular" e "Site melhor avaliado". ');

define('_MI_WEBLINKS_TOPTEN_CATS','O número máximo de categorias no top dez topten');
define('_MI_WEBLINKS_TOPTEN_CATS_DSC', 'Informe o número máximo de categorias a serem mostradas em "Site Popular" e "Site melhor avaliado". <br />Tempo esgotado pode ocorrer se muitas categorias top forem selecionadas');

// 2006-03-26
// REQ 3807: Main Page Introductory Text
//define('_MI_WEBLINKS_INDEX_DESC','Main Page Introductory Text');
//define('_MI_WEBLINKS_INDEX_DESC_DSC', 'You can use this section to display some descriptive or introductory text. HTML is allowed.');
//define('_MI_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center"><font color="blue">Here is where your page introduction goes.<br />You can edit it at "Module Configuration 2".</font><br /></div>');

// 2006-05-15
define('_MI_WEBLINKS_ADMENU0', 'Index');

// 2006-11-03
// random block
define('_MI_WEBLINKS_BNAME_RANDOM',  'Link aleatório');
define('_MI_WEBLINKS_BNAME_GENERIC', 'Bloco de link genérico');

// 2007-04-08
define('_MI_WEBLINKS_BNAME_RANDOM_PHOTO', 'Foto aleatória');

// 2007-09-01
// notification: new_link_admin
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN', '[Admin] Novo link (com o comentário para o admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_CAP', '[Admin] Notifique-me quando algum novo link for postado (com o comentário do admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_DSC', 'Receber notificação quando algum novo link for postado (com o comentário para o admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_SBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação: Novo link');

// notification: new_link_comment
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT', '[Admin] Novo link (se informado o comentário para o admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_CAP', '[Admin] Notifique-me quando um novo link for postado (se informado o comentário ao admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_DSC', 'Receber notificação quando um novo link for postado (se informado o comentário para o admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_SBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação : Novo link)');

}
// --- define language begin ---

?>
