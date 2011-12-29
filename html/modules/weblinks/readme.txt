$Id: readme.txt,v 1.2 2011/12/29 19:54:56 ohwada Exp $

=================================================
Version: 2.00
Date:   2011-12-29
Author: Kenichi OHWADA
URL:    http://linux2.ohwada.net/
Email:  webmaster@ohwada.net
=================================================

* Changes *
1. Migrating to PHP 5.3
Deprecated features in PHP 5.3.x
http://www.php.net/manual/en/migration53.deprecated.php
(1) ereg
(2) Assigning the return value of new by reference is now deprecated.

2. Migrating to MySQL 5.5
(1) TYPE=MyISAM -> ENGINE=MyISAM


=================================================
Version: 1.95
Date:   2009-04-02
=================================================

* Changes *
(1) Portuguesebr 1.94
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=451&forum=2

(2) Bugfix
Smarty error: unable to read resource: d3forum_comment.html
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=448&forum=2


=================================================
Version: 1.94
Date:   2009-02-01
=================================================

* Changes *
(1) added Webphoto in album select
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=911&forum=5

(2) corrected confliction with webphoto
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=913&forum=13


=================================================
Version: 1.93
Date:   2009-01-04
=================================================

* Changes *
(1) "not version xxx"
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=861&forum=5

(2) update german mail_template


=================================================
Version: 1.92
Date:   2008-10-18
=================================================

* Changes *
1. added plugin of Newbbex
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=423&forum=2

2. updated Persian
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=424&forum=2

3. bug fix
(1) cannot use &amp; for location
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=831&forum=5

(2) Notice in weblinks_link_view_handler.php
http://xoopscube.jp/modules/xhnewbb/viewtopic.php?topic_id=5862


=================================================
Version: 1.91
Date:   2008-04-12
Author: Kenichi OHWADA
URL:    http://linux2.ohwada.net/
Email:  webmaster@ohwada.net
=================================================

* Changes *
1. the admin can use $xoops_isuser in the template files
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=792

2. not show PageRank without URL
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=794&forum=5

3. bug fix
(1) the guest cannot change the password after request the lost password
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=791


=================================================
Version: 1.90
Date:   2008-03-05
Author: Kenichi OHWADA
URL:    http://linux2.ohwada.net/
Email:  webmaster@ohwada.net
=================================================

* Changes *
1. added output plugin feature
1.1 specificatio
1.1.1 place of hook
After reading from the DB and doing common processing.

1.1.2 added feature plugin combination 
specify like as UNIX pipe
-----
plugin_a | plugin_b | plugin_c
-----

1.1.3 added feature parameter into plugin
specify like as PHP function
-----
plugin_a ( param_a, param_b, param_c )
-----

1.2 implement
1.2.1 prepared 4 plugins
(1) pagerank
(2) gamp_sample
(3) rss_sample
(4) kml_sample

1.2.2 added menu in admin page
(1) Output Plugin Managemant
- HTML Output Plugin Setting
- RSS  Output Plugin Setting
- KML  Output Plugin Setting
- Plugin List
- Test of Plugin


2. supported Google PageRank
http://linux2.ohwada.net/modules/newbb/viewtopic.php?forum=2&topic_id=383

(1) added "High PageRank Site"
(2) show the green bar in link list and link single
(3) get the PageRank automaticaly, when show it
(4) cache the getting PageRank in DB, for reduceing the server load
re-get the PageRank, when submit or modify link
(5) added "PageRank Update" at "Link Check Management" in admin page

(6) Notice
It is not the official service of Google.
In the future, it doesn't sometimes work, too.

PageRank without the Toolbar 
http://www.google.com/support/toolbar/bin/answer.py?answer=9156&topic=11773
We currently only offer the PageRank feature through the Google Toolbar.  

3. supported Google KML
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=770

(1) added "GoogleMaps Site", and show "KML List"
(2) the admin can customize using the plugins
sample of plugin: kml_sample
(3) added kml directory, described the following in .htaccess
-----
addType application/vnd.google-earth.kml+xml .kml
-----

4. added "Module Setting 7 (Menu)" in admin page
http://linux2.ohwada.net/modules/newbb/viewtopic.php?forum=2&topic_id=362

(1) concentrated the setting items which relates to show the menu.
(2) the admin can change the title of menu

5. changes 50 chars to 255 chars in the category title
http://linux2.ohwada.net/modules/newbb/viewtopic.php?forum=2&topic_id=364

6. changed the setting of the char length of the input field in the submit form
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=382&forum=2

7. added the option which not show "Map Type Control" in block
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=730

8. changed the admin can set "publish time" in bulk management
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=790&forum=5

9. lang pack
(1) updated Arabic
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=351&forum=2

(2) updated Persian
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=387&forum=2

10. bug fix
(1) fatal error in "Deletion Links Waiting for Validation"


* DB table structure *
(1) added fields in link, modify table
pagerank : Google PageRank
pagerank_update : PageRank update time

(2) modify attribute in cateogry table
title : varchar(50) -> varchar(255)

* Templates *
added the following
- weblinks_build_kml


* Requirement *
(1) happy_linux module v1.40 is required.
(2) rssc module v0.80 is required when use rss feeds.
(3) memory_limit more than 16 MB


* Update *
(1) Overwrite the files below weblinks directory. 

(2) Update weblinks module in XOOPS management. 
the weblinks's update script is executed at the same time,
because weblinks supported onUpdate since this version 1.80. 

(3) PageRank
added PageRank in this version 1.90.
the value of PageRank are not stored in DB, when module update 
Execute "Update PageRank" in "Link Check Management"

(4) Execute "DB table manage"
confirms that there is no error


=================================================
Version: 1.85
Date:   2008-02-16
=================================================

* Changes *
1. added the following feature with the version up of Google Maps API
(1) added "physical" in map type control
(2) remove "[Search] Map Type"

2. changed install script
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=767&forum=8

3. changed template variable xoops_module_header
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=772&forum=9

4. show timeout time in "Broken Link Check"
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=381&forum=2

5. bug fix
(1) not show google map when set "satellite" in map type
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=634&forum=5

(2) wrong link at google logo


=================================================
Version: 1.84
Date:   2008-01-18
=================================================

* Changes *
1. language
updated German. thanks sato-san

2. bug fix
(1) Only variables should be assigned by reference
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=758&forum=5

(2) in album, not show same category name
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=763&forum=5

(3) Fatal error: Call to a member function on a non-object in weblinks_rssc_view_handler.php
(4) fopen(): failed to open stream: No such file or directory in weblinks_banner_handler.php


=================================================
Version: 1.83
Date:   2007-12-29
Author: Kenichi OHWADA
URL:    http://linux2.ohwada.net/
Email:  webmaster@ohwada.net
=================================================

* Changes *
1. bug fix
(1) not show smiley icon in summary
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=746&forum=5

(2) not set company, address, etc into "search" field
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=754&forum=5

added the tool which corrects the already registered "search" field.
please execute "Rebuild search field" at "DB table management" in admin page.
it rebuild only "search" field.


=================================================
Version: 1.82
Date:   2007-12-16
=================================================

* Changes *
1. changed the method of the redirect to header().
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=742&forum=5

2. bug fix
(1) not close the a tag in viewcat template
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=737&forum=5

(2) cannot register the link in bulk management
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=740&forum=5

(3) fatal error in export to RSSC
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=741&forum=5

(4) cannot update from v1.31
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=366&forum=2


=================================================
Version: 1.81
Date:   2007-11-26
=================================================

* Changes *
1. DB Table Management
added to check config table, other tables

2. bug fix
(1) user cannot preview
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=721

(2) admin cannot delete link
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=729

(3) user can vote minus rating
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=359&forum=2

(4) TEXT columns cannot have DEFAULT values
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=732&forum=5

(5) fatal error in randum photo block
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=734&forum=5

(6) not convert BB code in print


=================================================
Version: 1.80
Date:   2007-11-11
=================================================

* Changes *
1. RSS cache
(1) has the RSS cache in anoymous user mode, to reduce the server load.
(2) clear the cache in the admin page.

2. supported onInstall onUpdate

3. memory usage
(1) reduced memory usage under 16MB
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=716&forum=5

(2) show memory usage

4. added http://www.websitethumbnails.net/ in thumnail service
http://linux2.ohwada.net/modules/newbb/viewtopic.php?forum=2&topic_id=339

5. added options
(1) the admin can specify width of Google map marker info
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=705&forum=5

(2) description char length
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=347&forum=2

(3) force to show username
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=349&forum=2

6. keyword
(1) highlights keyword when come from Google search and Yahoo search
(2) highlights keyword in feed articles
(3) not show keyword query in URL when there is no keyword

7. added space after Japanese punctuation mark when build summary
8. added Module management
9. added to check xoops block table

10. lang pack
(1) added Italian
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=337&forum=2

(2) added Arabic 
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=351&forum=2

(3) updated Spanish
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=344&forum=2

(4) updated Persian
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=343&forum=2

11. bug fix
(1) anonymous users can not modify links
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=342&forum=2

(2) fatal error in blocks/weblinks_plugin.php
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=718&forum=2

(3) dont show link count in Japanese map
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=722&forum=5

(4) anonymous users can not register password
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=725&forum=5

(5) in search, not succeed cid at next page
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=727&forum=5

(6) cannot export to rssc module


* Requirement *
(1) happy_linux module v1.20 is required.
(2) rssc module v0.70 is required when use rss feeds.
(3) memory_limit more than 16 MB

* Update *
(1) Overwrite the files below weblinks directory. 

(2) Update weblinks module in XOOPS management. 
the weblinks's update script is executed at the same time,
because weblinks supported onUpdate since this version 1.80. 

(3) Execute "DB table manage"
confirms that there is no error
in XOOPS Cube 2.1 and XOOPS 2.2, 
module update does not change block's option


=================================================
Version: 1.71
Date:   2007-09-23
=================================================

* Changes *
1. tempolary directory for banner image
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=694&forum=5

(1) check include /tmp in open_basedir
(2) admin can specify optional directory using preload
(3) in admin page, check and show directory is writable

2. support PHP 5.2
(1) defeat errors in E_STRICT level
(2) change handling DB in command line mode

3. bug fix
(1) [4705] fatal error in bulk manage
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4705&group_id=1199&atid=971

(2) [4707] weblinks_config2_basic_handler.php: Only variables should be assigned by reference
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4707&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=691&forum=5

(3) not show print
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=696

(4) fatal error in link broken manage
(5) not approve link detetion request
(6) geust cannot delete his link


=================================================
Version: 1.70
Date:   2007-09-16
=================================================

* Changes *
1. revised substantially link submit, modifty and delete.
1.1 add permition to user which delete link
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=638&forum=5

1.2 [4514] add permition to user which set publish and expire date
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=290&forum=2

user cannot view the link if before the publish date.
user can view his submitted link if before the publish date.

1.3 notify "comment for the admin" when link submit
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=459&forum=5

(1) add the event notification for the admin, in addition to for the user.

- Notify me when any new link is posted.
- [Admin] Notify me when any new link is posted (with the comment the admin)
- [Admin] Notify me when any new link is posted (if entered the comment the admin)

(2) show link list with the comment for the admin in admin's page.

(3) in admin's page, when add new link,
not notify the event notification, if before publish time.

1.4 [4068] admin can choice notify me or not, when link submit
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=171&forum=2

weblinks used the event notification of XOOPS core for the regitered user,
implemented the email notice uniquely for the guest.
abolish the email notice and integrate to the event notification.

- [Admin] Notify me when any new link is submitted (awaiting approval).
- [Admin] Notify me of any link modification request.

1.5 [3418] admin can enter the reason in the email of link approval or refusal
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=121&forum=2

(1) weblinks used the event notification of XOOPS core for the regitered user,
implemented the email notice uniquely for the guest.
abolish to use the event notification and integrate to the email notice uniquely.

(2) show the email form specifically. 

(3) add the email sentence for the link modificaton and deletion, in addition to the link submit.
- link_mod_approve_notify.tpl
- link_mod_refuse_notify.tpl
- link_del_approve_notify.tpl
- link_del_refuse_notify.tpl

1.6 clone link
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=684&forum=5

(1) add "clone link"
(2) add "clone link to other module"

1.7 Link modification request

(1) user must enter "Comment to the admin" when request 
(2) highlight the modified items in approval form 
(3) admin must confirm if change uid mail name

1.8 The waiting list
(1) for the submitted user, show the submitted link list in the modules's top page.
(2) for the submitted user, show the waiting link list in the modules's top page.
(3) for the admin, show the number of the waiting in the modules's top page.
(4) the admin can choice to show list or not
(5) add the API to add weblinks to "Waiting Contents block" of the XOOPS core.
(6) add the plugin for the waiting module.

1.9 add "notification manage" in the admin's menu.

1.10 add the test scenario for the developer.

2. thumbnail web service
(1) support two thumbnail web service
- http://mozshot.nemui.org/
- http://img.simpleapi.net/

(2) show the WEB site thumbnail instead of the link image.
using the thumbnail web service, if not set the link image.

3. add options
(1) [3030] choice the URL or singlelink.php for the random link
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=101&forum=2
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=680&forum=5

(2) [4359] countup hits in singlelink.php
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=249&forum=2

4. bug fix
(1) in global search, show link which before publish time
(2) when user submit new link, if there are the same RSS URL, 
the new record is added to the RSSC module.


* Requirement *
(1) happy_linux module v1.10 is required.
(2) rssc module v0.61 is required when use rss feeds.


* Update *
(1) Overwrite the files below weblinks directory. 

(2) Update weblinks module in XOOPS management. 
You MUST do it, since the template files and the event notification are changed. 

(3) Upgrade config table in weblinks's admin page.
the message is showing, if not newest version. 

(4) In "Module Configuration 1 (Preferences)" in weblinks's admin page,
you enable 2 new events at "Enable Specific Events"

- [Admin] Notify me when any new link is posted (with the comment the admin)
- [Admin] Notify me when any new link is posted (if entered the comment the admin)


=================================================
Version: 1.62
Date:   2007-09-15
Author: Kenichi OHWADA
URL:    http://linux2.ohwada.net/
Email:  webmaster@ohwada.net
=================================================

* Changes *
bug fix
(1) 4698: fatal error occure when admin add new link
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4698&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=687&forum=5

(2) 4702: fatal error occure when user submit new link
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4702&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=689&forum=5


=================================================
Version: 1.61
Date:   2007-09-01
=================================================

* Changes *
1. URL of RSS/ATOM
(1) In the admin sets to "indispensabe",
when the user select "Non", weblinks doesn't check to fill or not

(2) In the mode which the admin approve submitted links,
when the user select "Auto Detect" as default, 
weblinks executes "RSS Auto Discovry" and sets rss_url and rss_flag field.
And in the mode which weblinks automatically approve,
weblinks executes "RSS Auto Discovry" in the old version.

2. bug fix
(1) 4680: dont work radio button in block
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4680&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=663&forum=5

(2) 4688: javascript error with IE6
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4688&group_id=1409&atid=1786
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=667&forum=12

(3) 4689: number of feeds is unlimited in singlelink
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4689&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=669&forum=5

(4) 4690: not set rss_url in modify table
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4690&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=670&forum=5

(5) 4693: not notify "New Link Submitted"
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4693&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=674&forum=5

(6) wrong link in notification of "link modification request".
(7) not show Name (category title) in category bookmark
(8) not notify the notifications in category to all categories.


=================================================
Version: 1.60
Date:   2007-08-05
Author: Kenichi OHWADA
URL:    http://linux2.ohwada.net/
Email:  webmaster@ohwada.net
=================================================

* Changes *
1. Supported MySQL 4.1/5.x
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=9&topic_id=631
For exsample in Japanese, program fixed ujis (EUC-JP) in character code of MySQL.
Administrator can change character code, setting happy_linux/preload/charset.php.

2. Google Map
(1) separated javascript from the template file, and created js file
- weblinks_gmap.js
- weblinks_gmap_block.js
- weblinks_gmap_location.js
(2) added option, map control and others
(3) show link description in map marker
(4) show the result of geocode with the map marker.

3. Larest Links
added option to choice updated date or created date

4. HTML style
(1) base on W3C
checked mainly pages on W3C Markup Validator
http://validator.w3.org/

(2) xoops moduel header
added option to show style sheet and javascript in header tag
using xoops moduel header

5. Block
(1) added option to show category title
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4651&group_id=1199&atid=974

(2) added option to show link description
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=315&forum=5

(3) added option to show Google Map
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=507&forum=5

6. Bulk Import
(1) added feature which admin can specify register items

7. Added Japan Map
Valid in Japan

8. Multi Langage
(1) changed German files
(2) added Germany (de) in locate
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=323&forum=2

9. Extention of etc columns
For developer.
prepared the mechanism to add etc columns in link table and modify table

10. Admin contorl
(1) added "Module Cinfigration" to show detail menu.
(2) added "Module Cinfigration 5" to set "Link Item".
(3) added "Module Cinfigration 6" to set "Google Map"
(4) added "Japan Map Cinfigration"
(5) added "Column Management"

11. Bug Fix
(1) 4672: cannot delete link in "New Links Waiting for Validation"
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=658&forum=5

(2) there is no URL in link broken report


* Templates *
added tempaltes
- weblinks_gm_location
- weblinks_gm_block
- weblinks_map_jp


* Requirement *
(1) happy_linux module v1.00 is required.
(2) rssc module v0.60 is required when use rss feeds.


* Update *
(1) Overwrite the files below weblinks directory. 

(2) Update weblinks module in XOOPS management. 
You MUST do it, since the template files are changed. 

(3) Upgrade config table in admin page.
the message is showing, if not newest version. 

(4) Execute "Module Configuration" -> "Clear cache of Templates"
You MUST do it, since the template files are changed. 

(5) Corect Block parameters by the block management, in Weblinks management or XOOPS management.
in same vervion of XOOPS, donot change the block parameters by update module, 


=================================================
Version: 1.51
Date:   2007-07-20
=================================================

* changes *
1. support XC 2.1
(1) change to not depend system module, when sending email
(2) add to check email format
(3) add language file mailusers.php

2. support GeoRss

3. bug fix
(1) 4637: dont work OR search
(2) 4640: undefined function: get_selecter_by_id()
(3) 4644: keyword highlight causes same trouble
(4) 4647: keyword "abc" match "abccc"
(5) undefined method get_error_msg_modlink()
(6) not highlight singlelink from the search when using IE


=================================================
Version: 1.50
Date:   2007-07-01
=================================================

* changes *
1. changed with the update of RSSC module (v0.60)

2. Performance improvement
(1) NOT use object handler when viewing
(2) add 2 classes
- weblinks_link_catlink_basic_handler
- weblinks_rssc_view_handler

3. add command line option
usage is following
-----
php -q -f XOOPS/modules/weblinks/bin/link_check.php  pass
php -q -f XOOPS/modules/weblinks/bin/link_check.php -pass=pass [ -limit=0 -offset=0  -echo ]
-----

4. add block manage in admin page
(1) absorption of the difference by Major version of XOOPS
show menu to support 2.0 / 2.1 / 2.2.
judge version automatically, and reload page 10 seconds later automatically .

(2) adopt GIJOE's myblocksadmin
valid in xoops 2.0

5. Co-opreation with d3forum
5.1 add plugin for d3forum
show post context of forum module in each category page and each link page, 
same as other forum modules

5.2 support comment-integration with d3forum module
usage
1) in d3forum module, create forum for comment-integration.
2) in "Modify the forum"
fill "weblinks::weblinksD3commentContent::" at "Format for comment-integration" 
and click "Save"
3) in weblinks module, at "Comment-integration with d3forum module" in "Module Configuration 4",
select "Plugin Select" and "Module Select", and click "UPDATE".
4) select "Forum Select", and click "UPDATE".

6. view style of category
6.1 view style of category path
add option in admin page
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=284&forum=2

6.2 range of sub category
add option in admin page

7. multi language
(1) add Japanese UTF-8 files
(2) add ja_utf8 which identify Japanse laguage file name

8. bug fix
(1) pakaging of SQL statament
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=635
(2) forget header in "New Links Waiting for Validation"
(3) Notice : Undefined offset: 8 in file blocks/weblinks_top.php


* Template *
added templates
- weblinks_d3forum_comment


* requirement *
(1) happy_linux module v0.90 is required.
(2) rssc module v0.60 is required when use rss feeds.


* Update *
(1) Overwrite the files below weblinks directory. 

(2) Update weblinks module in XOOPS management. 
You MUST do it, since the template files are changed. 

(3) Upgrade config table in admin page.
the message is showing, if not newest version. 

(4) Execute "Module Configuration 2" -> "Clear cache of Templates"
You MUST do it, since the template files are changed. 


=================================================
Version: 1.44
Date:   2007-05-19
=================================================

* changes *
1. supported XOOPS Cube 2.1
system module is required when send email in user manage in admin page.
It works well without system module in other features.

2. bug fix
(1) unset 'use xoops comment' in bulk manage.
(2) show escaped HTML tag in error message when submiting new link

* requirement *
happy_linux module v0.80 is required.


=================================================
Version: 1.43
Date:   2007-05-12
Author: Kenichi OHWADA
URL:    http://linux.ohwada.jp/
Email:  webmaster@ohwada.jp
=================================================

* changes *
1. bug fix
(1) 4562: Fatal error in import manage
(2) 4563: forum_id is array in singlelink
(3) 4564: Fatal error, when set rssc_use if not exist RSSC module
(4) 4565: cannot show user manage, when too many links or users
(5) banner image overflow the display frame
(6) cannot show next page in broken links
(7) Notice [PHP]: Use of undefined constant album_id - assumed 'album_id' in file class/weblinks_category_handler.php
(8) Notice [PHP]: Use of undefined constant WLS_ERROR_ILLEGAL in file class/weblinks_link_form_check_handler.php
(9) Notice [PHP]: Use of undefined constant imgurl in file admin/category_manage.php
(10) Notice [PHP]: Undefined variable: dirname in myheader.php


=================================================
Version: 1.42
Date:   2007-04-09
Author: Kenichi OHWADA
URL:    http://linux.ohwada.jp/
Email:  webmaster@ohwada.jp
=================================================

This is the beta version of "Performance improvement" and others. 
Stable version is v0.97 and v1.31 

* changes *
1. added feature
(1) added option to choice "Map" or "Satallite" in Google Map in initial
(2) added description in each categories
(3) with sub category in album
(4) added album block

2. bug fix
(1) 4533: dont show album selceter in admin form
(2) Fatal error: print_warnig() in category_manage.php
(3) always all forums in newbb_200.php

* DB table structure *
(1) added fields in category table
  gm_type dohtml dosmiley doxcode doimage dobr
(2) added fields in link and modify table
  gm_type

* Template *
(1) added templates
  weblinks_block_photo

* Update *
same as v1.40


=================================================
Version: 1.41
Date:   2007-03-25
=================================================

This is the beta version of "Performance improvement" and others. 
Stable version is v0.97 and v1.31 


* changes *
1. Performance improvement
(1) Because of the performance improvement, 
it fetch category image size  beforehand when showing, and it stores in the database.

2. Enhanse Google Maps
(1) show map in index and each category page
(2) show marker in map for links in page
(3) specify center of map in each cateogroy page

3. Co-opreation of Album module
added config options
(1) show photo of album module in each category page and each link page.

4. Language
(1) Persian for v1.40

5. Bug fix
(1) 4506: expired links not listed in admin
(2) 4507: Fatal error: getallchildid() in category_manage.php
(3) 4508: Fatal error: weblinks_get_handler() in weblinks_top.php
(4) 4509: JavaScript error in gm_get_location.php
(5) 4519: Fatal error: get_cid_array_by_title() in bulk_manage.php
(6) 4520: dont work newline in textarea


* DB table structure *
(1) added fields in category table
  album_id, img_orig_width, img_orig_height, img_show_width, img_show_height
  gm_mode, gm_latitude, gm_longitude, gm_zoom
(2) added fields in link and modify table
  album_id

* Template *
(1) added templates
  album_list

* Update *
same as v1.40


=================================================
Version: 1.40
Date:   2007-03-04
=================================================

This is the beta version of "Performance improvement" and others. 
Stable version is v0.97 and v1.31 

* changes *
1. Performance improvement
added config options
(1) Because of the performance improvement, 
it computes necessary data beforehand when showing, and it stores in the database.
(2) the category information on the memory is changed from XoopsObject into the association arrangement. 

2. Co-opreation of Forum module
added config options
(1) show post context of forum module in each category page and each link page.
(2) With the plugin, you can extend the kind of the forum module.
supported moduels: Newbb 1.00ANewbb 2.02ABluesBB 1.00
(3) choice to use or not XOOPS comment in each link page.

3. Co-opreation of CAPTCHA module
added config options
(1) CAPTCHA is technique for anti-spam.
If choice this option, Anoymous user must use CAPTCHA when add or modify link.

4. Post count of XOOPS user
added config options
(1) count up XOOPS user posts when user submit new link.
(2) count up XOOPS user posts when user rate link.

5. View
added config options
(1) in category page, Recommend site, Reciprocal site, RSS/ATOM site,
choice summary or datail of link view style

6. User submit form
added config options
(1) user can use textarea1 and textarea2
(2) admin can edit description of each item
(3) admin can edit top description in form

7. Multi site
As the hack, support to choice English or Japanese


* DB table structure *
(1) added fields in category table
  forum_id, tree_order, cids_parent, cids_child, link_count, link_update,
  aux_int_1, aux_int_2, aux_text_1, aux_text_2

(2) added fields in link and modify table
  forum_id, comment_use

(3) added fields in linkitem table
  description


* Template *
(1) added templates
  category_navi, forum_list
(2) assign element value of sub-categories to template variables


* Requirement *
(1) happy_linux module is indispensabe necessary.
(2) rssc module is necessary when use rss feeds.
(3) forum module is necessary when use showing forum.
(4) captcha module is necessary when use CAPTCHA.


* Update *
(1) Overwrite the files below weblinks directory. 

(2) Update weblinks module in XOOPS management. 
You MUST do it, since the template files are changed. 

(3) Upgrade config table in admin page.
the message is showing, if not newest version. 

% Caution %
config2 and linkitem table are initialized and an original value is destroyed.
As occasion demands, enter a value agine.

(4) Execute "Module Configuration 2" -> "Clear cache of Templates"
You MUST do it, since the template files are changed. 

(5) since v1.30, using RSS feature
Execute "DB table management" -> "Clear xml in link table".
erase an unnecessary data, rss_xml in link table
It cuts down on the memory usage.

(6) using "Performance improvement"
Execute "Category list" -> "Update category path tree"
create a necessary data.


* Notice *
I change almost all files. 
I dont change the database structure.
Although there are no big problem, but I think that there are any small problem. 
Even if some problems come out, only those who can do somehow personally need to use. 
Welcome a bug report, a bug solution, and your hack, etc.


* TODO *
in this version, the change about the structure is finished.
in next version, I will plan to add the backlog features.


* For translator *
Please change language files with a sample about English files. 
I cannot change them, since I dont have non-English editors. 


=================================================
Version: 1.31
Date:   2007-02-20
=================================================

* changes *
1. bug fix
(1) 4476: reset hits rating votes commnets in modify link by admin
(2) 4477: topten is unlimited
(3) 4495: Fatal error: Call to undefined method weblinks_link_edit::build_mail_edit_for_others()


=================================================
Version: 1.30
Date:   2006-12-17
Author: Kenichi OHWADA
URL:    http://linux2.ohwada.net/
Email:  webmaster@ohwada.net
=================================================

This is the beta version of "module duplication" and others. 
There are same changes of functional addition, 
"Pubish time, Expire time, and textarea".

If you dont use new functions, please use v0.97 or v1.22 

* changes *
1. Google Maps
(1) added geocoding in link registeration
htttp://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=559&forum=5

2. Link items
(1) added "Pubish time" and "Expire time"
admin only can register this
http://xoopscube.jp/modules/newbb/viewtopic.php?topic_id=8647&forum=17

(2) added two textarea
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=529&forum=5
admin only can register this
textarea1 : admin can use HTML and specify options
textarea2 : admin cannot use HTML

3. admin page
(1) added "Link list before Publish time" and "Link list after Expired time" in link list

4. language
(1) update german files
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=232&forum=2

5. locate
(1) added Iran (ir)

6. structure
(1) changed method to save into DB.
added link_save and modify_save class whitch validate object for saving DB
(2) maked test case of classes for developer

7. bug fix
(1) 4417: language singleton done not work correctly
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4417&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=256&forum=2


* DB table structure *
(1) link and modify table
time_publish : Publish time
time_expire  : Expir time
textarea1    : Text Box
textarea2    : Text Box
dohtml1      : option of textarea1
dosmiley1    : option of textarea1
doxcode1     : option of textarea1
doimage1     : option of textarea1
dobr1        : option of textarea1

* requirement *
(1) happy_linux module is indispensabe necessary.
(2) rssc module is necessary when use rss feeds.

* update *
MUST execute following, because change templates
(1) Update weblinks module in XOOPS management. 
(2) Do "Clear cache of Templates" in "Module Configuration 2" of weblinks admin page

* Notice *
Although there are no big problem, but I think that there are any small problem. 
Even if some problems come out, only those who can do somehow personally need to use. 
Welcome a bug report, a bug solution, and your hack, etc.

* TODO *
I will plan the improvement of the scalability

* For translator *
Please change language files with a sample about English files. 
I cannot change them, since I dont have non-English editors. 


=================================================
Version: 1.22
Date:   2006-11-08
Author: Kenichi OHWADA
URL:    http://linux2.ohwada.net/
Email:  webmaster@ohwada.net
=================================================

This is the beta version of "module duplication" and others. 
There are same changes of functional addition, 
"the cooperation feature with RSS Center module" and etc.

If you dont use new functions, please use v0.97 or v1.13 

* changes *
1. Google Maps
(1) added inline mode in link register form
(2) in Japanese mode, added invert geocoder
(3) Added to check web browser
can use JavaScript and GoogleMaps

2. block
(1) added generic block
(2) added random block

3. corrected Enlish language files
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=241&forum=2

4. bug fix
(1) 4342: crash if more than 100 characters in description
chenged happy_linux module
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4342&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=245&forum=2

(2) 4344: Table 'weblinks_config2' doesn't exist
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4344&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=232&forum=2

(3) 4349: IE cannot show google map in print.php
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4349&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=542&forum=5


* update *
(1) MUST execute following, because change templates
Update weblinks module in XOOPS management. 
(2) happy_linux module 0.32 is indispensabe necessary.


=================================================
Version: 1.21
Date:   2006-10-14
=================================================

This is the beta version of "module duplication" and others. 
There are same changes of functional addition, 
"the cooperation feature with RSS Center module" and etc.

If you dont use new functions, please use v0.97 or v1.13 

* changes *
1. Google Maps
(1) open Google site when click maker
(2) added map in print page

2. enhanced search feature
(1) added the narrow search with cateogry, recommend site, and reciprocal site
(2) added search in RSS feeds
(3) added linkage goto Google site
(4) added execution time

3. bug fix
(1) 4312: Fatal error in visit.php
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4312&group_id=1199&atid=971

(2) 4313: same browser cannot show gm_get_location.php
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4313&group_id=1199&atid=971

(3) 4318: cannot register bulk links
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4318&group_id=1199&atid=971

(4) dont work "Accept registration of existing links"
(5) highlight double

* update *
MUST execute following, because change templates
(1) Update weblinks module in XOOPS management. 
(2) Do "Clear cache of Templates" in "Module Configuration 2" of weblinks admin page


=================================================
Version: 1.20
Date:   2006-10-07
=================================================

This is the beta version of "module duplication" and others. 
There are same changes of functional addition, 
"the cooperation feature with RSS Center module" and etc.

If you dont use new functions, please use v0.97 or v1.13. 

* big changes *
1. happy linux module
The common functions in both weblinks module and rssc module, are concentrated happy_linux module.
To use this "weblinks" module, happy_linux module is necessary.

2. rssc module
The cooperation feature with RSS Center module is added.
The features are to collect RSS feeds, store in database, and show.

2.1 operation
When using RSS feature, set "yes" at "Use RSS feed" in admin page.
All operationa are madiateing with weblinks.
The user dont feel conscious to use rssc module.

2.2 improvemnet
the following are improved, by using rssc module, 
(1) use "magpie" for the rss parser.
(2) can parse to distinguish <title> and <dc:title>
(3) can parse <enclosure>, and podcasting are supported.

2.3 continued features
following features are continued, because of downward compatibility (v1.13).
recommend to use rssc module, because it has a similar feature. 
(1) "Latest RSS/ATOM feeds" block.
(2) "Show blog" block
(3) show blog at the custom block (include/atomfeed.inc.php).

2.4 abolished features
following features are abolished
plaese use rssc module, because it has a similar feature. 
(1) bin/refresh_link.php
(2) bin/refresh_site.php

2.5 some problems
The discordance with two modules is ocuured, 
becuase of cooperation feature with two modules.

(1) when deleted a link record in RSSC module.
Even if admin delete a link record in RSSC module,
program does not delete link record in weblinks module.
And then, program can not show RSS feed for link record in weblinks module.

Admin can correct this problem.
Admin add same link whitch was deleted in RSSC module.
And modify link ID of added link in weblinks module.

(2) there are two or more link records with same "RSS URL" in RSSC module.
When admin add link with mistaked "RSS URL" in weblinks module,
and then program add same mistaked link in RSSC module.
Admin modify "RSS URL",
and then program modify link record.
Therefore there are two or more link records with same "RSS URL" in RSSC module.

When link A cache is updated, RSSC module add RSS feed which belongs to link A.
And when link B cache is updated, RSSC module add RSS feed which belongs to link B.
RSSC module has the mechanism that not add same RSS feed.
Therefore, some RSS feeds 1,3,5 belongs to link A,
and other RSS feeds 2,4,6 belong to the link B.

For desirable feature,
when admin select link A or the link B.
program will show all RSS feeds 1,2,3,4,5,6
In present,
when admin select link A,
program can show RSS feeds 1,3,5 which belongs to link A.

Admin can correct this problem.
Admin delete link record with same "RSS URL" in weblinks module and RSSC module.


* new features * 
1. search
(1) show context in search result, 
corresponding to search module to be distributing in Amethyst Blue
http://www.suin.jp/

(2) highlight keywords in search result
(3) added fuzzy search (Japanese only)

2. added Google Maps
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=413&forum=5
showing Google Maps in datail page (singlelink.php) 

step 1: The initial setting
(1) you MUST get "Google Maps API Key".
(2) enter this key in the admin page.

step 2: each Link
(1) when add newr link, you enter information about the latitude and longitude.
The place information about the latitude and longitude is automatically extracted,
when you select the place to want to show from the world map.

3. Link button goto the map site
this is some feature from the past.
3.1 you can choice the map site
when you want other site, you MUST create template.
- US Yahoo
- US Google
- UK Yahoo
- UK Google
3.2 separete the part of the map icon in link template, and made new map template.
3.3 added the option to show or not a map icon in each link.
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3819&group_id=1199&atid=974

4. show image in sub category.
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=194&forum=2

5. added 75 and 100 in showing links in one page.
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=139&forum=2

6. distribute leatest links in RDF/RSS/ATOM format.

7. admin page
7.1 added menu 
(1) Module Configuration 3 (Link)
(2) Module Configuration 4 (RSS)
(3) Vote List
(4) CatLink List
(5) Command Manage (bin/link_check.php)
(6) DB Table Manage (zombie check, adjustment check with rssc module)
(7) Import Manage (mylinks)
(8) Export Manage (rssc)

7.2 link registration and edit
divided into three following steps and strengthen to check.
(1) registration of the link information
- check to connect the URL, not broken link ( in preview ).
(2) registration of the banner image
- when get the size of the banner image, show message if failed.
(3) registration the RSS information
- when auto disscovery of RSS URL, show message if failed.
- check to exist the same "RDF/RSS/ATOM URL" in the DB,  show message if exist.
- when parsr the contents of RSS URL, show message if failed.

7.3 show bread crumb in admin page.

8. added password in command (bin/link_check.php)
command becomes the following form.
----
php4 -q -f /home/***/html/modules/weblinks/bin/link_check.php PASSWORD
-----

9. used session ticket class (XoopsGTicket)
reffer Perk's Tinyd module

10. added the mechanism experimentally to select country (Locate).
you can select language and country independently.
In the past, program decided country, for exsample decided USA in English mode.
In present, you can select United Kingdom and others in English mode.
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=77&forum=2

10.1 use IANA's ccTLDs for the country code.
In this time, it got ready three country, Japan (jp), USA (us), United Kingdom (uk).

10.2 setting
USA is a default, in English mode, 
When you change into United Kingdom,
enter "uk" into "country code" and click "update" button.
and next, click the "renew" button.

11. some features for the developer.
(1) generate TEST date at the DB table.
(2) TEST add link form and modify link form via http protocol.


* DB table structure *
(1) atomfeed table
abolished to use atomfeed table.
table itself is left for downward compatibility.

(2) link and modify table
added following fields.
- map_use  :  show map icon
- rssc_lid : link id of RSSC module
- gm_xxx   : about Google Maps
- aux_xx   : reserved in future

* Templates *
(1) templates directory
moved the parts of template in parts and xml sub directory.

(2) added parts sub directory
this is for parts of main template used in template_main
separete header and search form in weblinks_header.html
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=529&forum=5

(3) added map sub directory
this is for link button goto map site.

(4) added xml sub directory
this is for distributing RSS feeds


* requirement *
(1) happy_linux module is indispensabe necessary.
(2) rssc module is necessary when use rss feeds.


* Update *
(1) Overwrite the files below weblinks directory. 
some files are changed file name. 

Although remained in overwrite, without deleting an old file,  
there is no trouble in operetion. 
If you worry it, 
please delete old files and copy new files. 
since you take backup of old files. 

(2) Update weblinks module in XOOPS management. 
You MUST do it, since I change the template files. 

(3) upgrade config table in admin page.
the message is showing, if not newest version. 

Caution:
linkitem table is initialized and an original value is destroyed.
As occasion demands, enter a value agine.

(4) when use RSS
(4-1) excute "module configuration 4" in admin page.
enter "RSSC Module Dirname and "Use RSS feed".

(4-2) execute "export manage" in admin page.
copying DB data in weblinks to rssc module. 

(4-3) execute "DB table manage" in admin page.
confirms that there is not a discordance.


* Notice *
I change almost all files. 
I dont change the database structure.
Although there are no big problem, but I think that there are any small problem. 
Even if some problems come out, only those who can do somehow personally need to use. 
Welcome a bug report, a bug solution, and your hack, etc.


* TODO *
in this version, the big change about the basic structure is finished.
in next version, I will plan to add the backlog features.


* For translator *
Please change language files with a sample about English files. 
I cannot change them, since I dont have non-English editors. 


* special thanks *
I appreciates the following persons.
- Mr. suin who develop Search module
- Mr. GIJOE who develop Tinyd module
- Staff of SmartFactory who develop SmartSection module
- Mr. wye who contibute hack of Google Maps


=================================================
Version: 1.13
Date:   2006-09-24
=================================================

* Main changes *
This is the beta version of "module duplication". 
There are same changes of functional addition, "enable to use of HTML tags" and etc.
And more changes of implementation about handling database. 

If you dont use "enable to use of HTML tags", please use v0.97. 

* bug fix *
(1) 4261: cannot add category with xoops protector
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4261&group_id=1199&atid=971

(2) 4278: cannot set no link list on the top page
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4278&group_id=1199&atid=971

(3) 4279: Undefined index: rss_num in file singlelink.php
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4279&group_id=1199&atid=971


=================================================
Version: 1.12
Date:   2006-09-16
=================================================

* Main changes *
This is the beta version of "module duplication". 
There are same changes of functional addition, "enable to use of HTML tags" and etc.
And more changes of implementation about handling database. 

If you dont use "enable to use of HTML tags", please use v0.97. 

* bug fix *
(1) 4164: number of comments is wrong
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4164&group_id=1199&atid=971

(2) 4168: not show catpath in viewmark
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4168&group_id=1199&atid=971

(3) 4169: not show total in index
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4169&group_id=1199&atid=971

(5) not clean old feeds in singlelink
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=509&forum=5

(6) category is html sanitized twice in edit form

=================================================
Version: 1.11
Date:   2006-07-23
=================================================

* Main changes *
This is the beta version of "module duplication". 
There are same changes of functional addition, "enable to use of HTML tags" and etc.
And more changes of implementation about handling database. 

If you dont use "enable to use of HTML tags", please use v0.97. 

* bug fix *
(1) 4029: mistake table name 
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4029&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=464&forum=5

(2) 4030: cannot change recommend, mutual
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4030&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=471&forum=5

(3) 4032 : cannot create table in MySQL 3.23
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4032&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=464&forum=5

(4) 4060: The command line of refreshed sites are limited to 10 sites.
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4060&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=474&forum=5

(5) 4085: Fatal error: Call to undefined function: weblinks_page_frame_basic()
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4085&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=482&forum=5

(6) 4130: cannot show recommend mark
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4130&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=492&forum=5

(7) 4152 : not show catpath in link list
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4152&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=488&forum=5

(8) 4153: not show catpath in search
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4153&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=497&forum=5

(9) 4154: always update time_update in admin mode
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4154&group_id=1199&atid=971


=================================================
Version: 1.10
Date:   2006-05-24
=================================================

* Main changes *
This is the beta version of "module duplication". 
There are same changes of functional addition, "enable to use of HTML tags" and etc.
And more changes of implementation about handling database. 

If you dont use "enable to use of HTML tags", please use v0.97. 

1. Added the following options.
(1) 3023 can use HTML tags in link content
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3023&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=74&forum=2

(2) choice to use or not XOOPS code in link content
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=454&forum=5

(3) 3037 choice to show or not RSS/ATOM feeds 
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3027&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?post_id=274&topic_id=90&forum=2
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=178&forum=5

(4) 3515 choice to show or not category list in sub menu. 
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3515&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=132&forum=2

(5) 3802 choice to show or not link list in main page
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3802&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=142&forum=2

(6) choice to show or not "recommend site" and "reciprocal site" on a higher rank
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=336&forum=5

(7) choice to use or not "Report Broken Link"

(8) choice to use or not "Link Hits"

(9) Selection of "indirect" and "direct" of URL display form
In "indirect", not show URL but visit.php
In "direct", show URL and count links hits via JavaScript. 

(10) choice to get or not banner image size automatically

2. Registration and edit of link information 
(11) guest can to register and change a password. 

(12) decide anonymous user's edit authority with a password. 
Anonymous user with authority can edit link information. 
Anonymous user without authority cannot see an edit form. 
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3419&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=121&forum=2

(13) when user have no authority, not show "submit" and "modify" button.
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=388&forum=5

(14) enable to change the item name at registration and edit
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=261&forum=5

3. Admin Management 
(15) renewal menue in admin page.

(16) Added bulk registration of categories and links 
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=68&forum=5

4. Template 
(16) adopted style sheet 
(17) changeed table tag to div tag. 
(18) added bread crumbs

5. Others 
(19) added PRINT page
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=307&forum=5

(20) 3026 TITLE and URL was extended to 255 characters. 
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3026&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=87&forum=2

6. language pack
(21) Added german (correspond v0.90)
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=168&forum=2


* Change of implemantation about handling database * 
Logic structure had changed into the complicated spaghetti state. 
since the conventional code repeated the functional addition, 
The code was rewritten extensively. 

(1) It separated into the object class and the handler class about handling database. 
(2) It separated into the class of direct handling database for link information 
and the class of showing and processing in registration and edit. 

(3) It arranged the complicated relation, 
which class A calls class B, and class B calls class B.


* Update *
(1) Overwrite the files below weblinks directory. 
I change the file name of many files. 

Although remained in overwrite, without deleting an old file,  
there is no trouble in operetion. 
If you worry it, 
please delete old files and copy new files. 
since you take backup of old files. 

(2) Update weblinks module in XOOPS management. 
You MUST do it, since I change the template files. 

(3) upgrade config table in admin page.
the message is showing, if not newest version. 

(4) Change a template if needed. 
I change the structure of a template. 
When you customized the template files, 
you need to re-customizedA template files. 


* Notice *
I change almost all files. 
I change table structure of a database a little.
Although there are no big problem, but I think that there are any small problem. 
Even if some problems come out, only those who can do somehow personally need to use. 
Welcome a bug report, a bug solution, and your hack, etc.


* TODO *
Next version, I will plan to add the linkage with "RSS Center module."


* For translator *
Please change language files with a sample about English files. 
I cannot change them, since I dont have non-English editors. 


=================================================
Version: 1.02
Date:   2006-05-14
=================================================

* Main changes *
This is the beta version of "module duplication". 
If you dont use "module duplication", please use v0.97. 

BugFix
(1) 3858 Fatal error when allow_url_fopen = off 
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3858&group_id=1199&atid=971

(2) 3859 Parse error in atomfeed.inc.php 
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3859&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=441&forum=5

(3) 3860 mysql error when guest report broken link
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3860&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=154&forum=2

(4) 3922 Fatal error when use category image 
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3922&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=161&forum=2


=================================================
Version: 1.01
Date:   2006-03-26
=================================================

* Main changes *
This is the beta version of "module duplication". 
If you dont use "module duplication", please use v0.97. 

Request
(1) 3807: Description in main page
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3807&group_id=1199&atid=974

BugFix
(1) 3743: fatal error ocucred when six or more links waiting to apoval
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3743&group_id=1199&atid=971

(2) 3746: show submenu incorrectly
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3746&group_id=1199&atid=971

(3) 3799: cannot display brokenlink 
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3799&group_id=1199&atid=971

=================================================
Version: 1.00
Date:   2006-01-15
=================================================

* Main changes *
This is the beta version. 
This change is only a functional addition of a "module duplication". 
This function is the same as TinyD module, etc. 
Currently prepared module name are "weblinks", "weblinks0", "weblinks1" and "weblinks2". 

If you dont use "module duplication", please use v0.97. 

* Update *
(1) Overwrite the files below weblinks directory. 
I change the file name of many files. 

Although remained in overwrite, without deleting an old file,  
there is no trouble in operetion. 
If you worry it, 
please delete old files and copy new files. 
since you take backup of old files. 

(2) Update weblinks module in XOOPS management. 
You MUST do it, since I change the template files. 

(3) Change a template if needed. 
I change the structure of a template. 
When you customized the template files, 
you need to re-customizedA template files. 

* Notice *
I change almost all files. 
I dont change the database structure.
Although there are no big problem, but I think that there are any small problem. 
Even if some problems come out, only those who can do somehow personally need to use. 
Welcome a bug report, a bug solution, and your hack, etc.

* TODO *
Next version, I will plan to add the linkage with "RSS Center module."

* For translator *
Please change language files with a sample about English files. 
I cannot change them, since I dont have non-English editors. 


=================================================
Version: 0.97
Date:   2006-01-14
Author: Kenichi OHWADA
URL:    http://linux.ohwada.jp/
Email:  webmaster@ohwada.jp
=================================================

Request
(1) 3226: ATOM 1.0 parse
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3226&group_id=1199&atid=974


Bug fix
(1) 3429: wrong link in admin/link_broken_check.php
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3429&group_id=1199&atid=971

(2) 3430: sorting dont work in admin/link_list.php
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3430&group_id=1199&atid=971

Language Pack
(1) add spanish v0.96
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=126&forum=2

(2) update french v0.96
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=127&forum=2


=================================================
Version: 0.96
Date:   2005-11-20
=================================================

Request
(1) 3196: direct link
hack by snakes
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3196&group_id=1199&atid=974
http://www.xoops.org/modules/newbb/viewtopic.php?viewmode=flat&topic_id=42078&forum=15

Bug fix
(1) 3209: typo X-Mailer
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3209&group_id=1199&atid=971


=================================================
Version: 0.95
Date:   2005-10-28
=================================================

Request
(1) 3028: send apoval email to anonymous user
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3028&group_id=1199&atid=974

(2) 3110: Add in this category
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3110&group_id=1199&atid=974


Bug fix
(1) 3031: timeout occurs if many waiting links
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3031&group_id=1199&atid=971

(2) 3032: "mutual site" is not suitable English
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3032&group_id=1199&atid=971

(3) 3095: the number of links does not change, if delete link
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3095&group_id=1199&atid=971

(4) 3106: cannot find a relative RSS url correctly
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3106&group_id=1199&atid=971

(5) 3108: errors occur when allow_url_fopen = off
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3108&group_id=1199&atid=971

(6) 3111: timeout occurs in popular site if many top categories
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3111&group_id=1199&atid=971


* added or changed files
xoops_version.php
submit.php
topten.php
admin/admin_functions.php
admin/admin_header.php
admin/broken.php
admin/category_manage.php
admin/link_manage.php
admin/modify.php
admin/table_check.php
class/class.rss_atom_parser_base.php
class/table_modify.php
class/remote_file.php
class/rss_atom_collect.php
include/function.php
include/submit_form.php
templates/weblinks_topten.html
templates/weblinks_topten_mixed.html
templates/weblinks_header.html

language/english/admin.php
language/english/main.php
language/english/modinfo.php
language/english/mail_template/link_approve_notify_anon.tpl
language/english/mail_template/link_refusued_notify.tpl
language/english/mail_template/link_wating_notify.tpl

language/japanese/admin.php
language/japanese/main.php
language/japanese/modinfo.php
language/japanese/mail_template/link_approve_notify_anon.tpl
language/japanese/mail_template/link_refusued_notify.tpl
language/japanese/mail_template/link_wating_notify.tpl


=================================================
Version: 0.94
Date:   2005-09-06
=================================================

Request
(1) 2933 in search, easy to understand error message 

Bug fix
(1) 2863 Fatal error: Call to undefined method xoops_form_extend::start_tray()
(2) 2929 random jump becomes an infinite loop None
(3) 2931 unmatch popup menu 'prefrence' and index menu 'module setting'
(4) 2932 dont work correctly when register_long_arrays = off 
(5) 2946 dont work correctly when allow_url_fopen = off


=================================================
Version: 0.93
Date:   2005-08-09
=================================================

Bug fix
(1) 2790 not show rss site
(2) 2793 Fatal error: Call to undefined function: _print_sql_error()
(3) 2827 RSS refresh: Invalid argument supplied for foreach()
(4) 2828 submit form is not displayed correctly in PHP 5.0.4 


=================================================
Version: 0.92
Date:   2005-07-18
=================================================

Bug fix
(1) 2150 cannot modify link
(2) 2158,2299 "Number of link broken count to stop a display" dont work
(3) 2300 show all sub categories when paramter = 0
(4) 2402,2410 pagenavi dont work correctly in Admin link list
(5) 2409 when anonymous users rate a link, sql error is displayed
(6) 2670,2698 Cannot redeclare table_config::$post_rss_url
(7) 2707 display BB code in short description
(8) 2772 dont show notify when preview to submit
(9) 2773 dont show _WLS_MODIFY to modify None 

added language pack
(1) french
(2) persian
(3) portugues.do.brasil


=================================================
Version: 0.9
Date:   2005-01-20
Author: Kenichi OHWADA
URL:    http://linux2.ohwada.net/
Email:  webmaster@ohwada.net
=================================================

This module is web links directory.
This is more powerful than mylinks, 
and upper compatible for mylinks.

* The main functions

1. The number of categories
One link can belong to two or more categories.
It is possible to set up arbitrary numbers. 
A default number is 4.  


2. Item of link infomation
This module have same items of link infomation,
name, email, address, telephone number, etc.
You can use as an address book.

2.1 URL
It is possible to register same URL. 
It is possible to register no URL. 
It will discover RSS URL and collect feeds automatically, if correspond to RSS Auto Discovery.

2.2 Link image
User can register a link image. 

2.3 Map site
Show the link to a map site "http://maps.yahoo.com/", when link infomation have the address.


3. Preview
It is possible to preview link infomation when submit or modify link.


4. Menu
This module have same menus. 

(1) Main
(2) Submit New Link
(3) Popular site
(4) Top rated site
(5) Recommned site
(6) Mutual site
(7) Category List
(8) RSS/ATOM Site
(9) RSS/ATOM Feed
(10) Randum jump


5. Blocks
This module have 6 Blocks.

(1) Recent Links
(2) Top Links
(3) Popular Links
(4) Category list of Web links
(5) Latest RSS/ATOM feeds of Web links
(6) Show blog of Web links


6. Dispaly and templates
This module have 19 templates. 

All templates passed W3C Validator.
http://validator.w3.org/


7. Admin Nenu
This module have same admin menus. 

(1) Module Configuration

(2) Management of Category
Category list which is listed by older id or tree style.
It is possible to change the order of category. 

(3) Management of Link
Link list which is listed by older or newer id.

(4) Managemnt of RSS/ATOM feed
RSS/ATOM feed clear and refrsh

(5) Managemnet of user
Admin can send email to user.


8. Access authority
This module have 5 Access authorities.
(1) submit a new link
(2) approve automatically when submit a new link
(3) modify a link
(4) approve automatically when modify a link
(5) rate a link

The setting method is that select the groups which have access authority, 
webmaster, registered users, anoymous users, etc.


9. Command line mode
This module have 3 batch programs.
It assumes that it performs them by cron.

(1) link broken check
(2) RSS/ATOM feed refresh
(3) RSS/ATOM search site feed refresh

10. Security
10.1 Correspond to register_globals off. 

10.2 Correspond to allow_url_fopen off. 
Please enable to write "cache" directory. 
Image data is stored temporarily, when image size is getting.


* Installation
(1) The "weblinks" directory will be made when unzip this download file.
(2) Install a module in XOOPS Modules Administration. 

* Command line mode
It assumes that it performs them by cron.
Please delete "bin" directory, if unnecessary. 

When you use command line mode.

(1) Enable to write the "cache" directory,

(2) Exucute in admin menu.
"other functions" -> "create config file for bin".

(3) Change $XOOPS_ROOT_PATH in the following program files to meet your XOOPS environment .
- bin/link_check.php
- bin/rss_refresh_link.php
- bin/rss_refresh_site.php

(4) Caution
Everyone can excute this program. 
Please change a program name and permit the cron user to excute, 
if you do not get into mischief, 


*  Necessary to change XOOPS core.
(1) Correspond to RSS Auto Discovery.
Please use my hack version of the XOOPS header.php.

Uncomment the following line in 40th line of viewfeed.php. 
-----
//$xoopsTpl->assign('lang_atomfeed_firefox', _WLS_ATOMFEED_FIREFOX);
-----


* Transfer from mylinks 
(1) Clean up the table of mylinks. 

(2) Enable to write the "weblinks/cache" directory.

(3) Exucute in admin menu.
"other functions" -> "transfer DB mylinks v1.1 to weblinks v0.9"

The following are copied. 
- Snapshot images 
- category table 
- links table 
- votedata table 
- XOOPS comments table which mylinks use.

The following are not copied. 
- modify table 
- broken table 

(4) Incompatible for mylinks
In mylinks, the registration method of Snapshot images is that choice from the image in the "shots" directory.
In weblinks, it changed into the method which specifies full URL.
The specification full URL of weblinks style is like
"http://***/modules/weblinks/images/shots/xxx" .
In a transfer program, it changes automatically.

