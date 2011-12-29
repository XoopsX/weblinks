<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:content="http://purl.org/rss/1.0/modules/content/" >
<channel>
  <title>{host} channel title</title>
  <link>http://{host}.exsample.com/index.html</link>
  <description>channel_description</description>
  <pubDate>Sun, 22 Jan 2006 02:33:44 +0900</pubDate>
  <lastBuildDate>Sun, 22 Jan 2006 01:22:33 +0900</lastBuildDate>
  <language>en</language>
  <copyright>channel_copyright</copyright>
  <managingEditor>channel_managingEditor</managingEditor>
  <webMaster>channel_webMaster</webMaster>
  <category>channel_category</category>
  <generator>channel_generator</generator>
  <docs>http://backend.userland.com/rss/</docs>
  <image>
    <title>channel_image_title</title>
    <url>http://{host}.exsample.com/logo.gif</url>
    <link>http://{host}.exsample.com/logo.gif</link>
    <width>360</width>
    <height>240</height>
  </image>
  <item>
    <title>{host} item_1 title</title>
    <link>http://{host}.exsample.com/item1.html</link>
    <description>{host} item_1 description</description>
    <pubDate>Sun, 22 Jan 2006 03:44:55 +0900</pubDate>
    <guid>item_1_guid</guid>
    <author>item_1_author</author>
    <category>item_1_category</category>
  </item>
  <item>
    <title>{host} item_2 title</title>
    <link>http://{host}.exsample.com/item2.html</link>
    <description>{host} item_2 description</description>
    <author>item_2_author</author>
    <category>item_2_category</category>
    <guid>item_2_guid</guid>
    <pubDate>Sun, 22 Jan 2006 04:55:11 +0900</pubDate>
    <source url="item_2_source_url">item_2_source</source>
    <content:encoded><![CDATA[ <h3>{host}</h3> item_2 content_encoded ]]></content:encoded>
  </item>
</channel>
</rss>