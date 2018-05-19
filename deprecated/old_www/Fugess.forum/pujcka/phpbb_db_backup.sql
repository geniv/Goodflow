#
# phpBB Backup Script
# Dump of tables for fugess-trainz-forum1328
#
# DATE : 20-03-2007 12:54:07 GMT
#
#
# TABLE: ftfbb_auth_access
#
DROP TABLE IF EXISTS ftfbb_auth_access;
CREATE TABLE ftfbb_auth_access(
	group_id mediumint(8) NOT NULL,
	forum_id smallint(5) unsigned NOT NULL,
	auth_view tinyint(1) NOT NULL,
	auth_read tinyint(1) NOT NULL,
	auth_post tinyint(1) NOT NULL,
	auth_reply tinyint(1) NOT NULL,
	auth_edit tinyint(1) NOT NULL,
	auth_delete tinyint(1) NOT NULL,
	auth_sticky tinyint(1) NOT NULL,
	auth_announce tinyint(1) NOT NULL,
	auth_vote tinyint(1) NOT NULL,
	auth_pollcreate tinyint(1) NOT NULL,
	auth_attachments tinyint(1) NOT NULL,
	auth_mod tinyint(1) NOT NULL, 
	KEY group_id (group_id), 
	KEY forum_id (forum_id)
);

#
# Table Data for ftfbb_auth_access
#

INSERT INTO ftfbb_auth_access (group_id, forum_id, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments, auth_mod) VALUES('3', '9', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO ftfbb_auth_access (group_id, forum_id, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments, auth_mod) VALUES('3', '2', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO ftfbb_auth_access (group_id, forum_id, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments, auth_mod) VALUES('3', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO ftfbb_auth_access (group_id, forum_id, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments, auth_mod) VALUES('2', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO ftfbb_auth_access (group_id, forum_id, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments, auth_mod) VALUES('3', '10', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO ftfbb_auth_access (group_id, forum_id, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments, auth_mod) VALUES('2', '9', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO ftfbb_auth_access (group_id, forum_id, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments, auth_mod) VALUES('2', '2', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1');
#
# TABLE: ftfbb_banlist
#
DROP TABLE IF EXISTS ftfbb_banlist;
CREATE TABLE ftfbb_banlist(
	ban_id mediumint(8) unsigned NOT NULL auto_increment,
	ban_userid mediumint(8) NOT NULL,
	ban_ip char(8) NOT NULL,
	ban_email varchar(255), 
	PRIMARY KEY (ban_id), 
	KEY ban_ip_user_id (ban_ip, ban_userid)
);
#
# TABLE: ftfbb_categories
#
DROP TABLE IF EXISTS ftfbb_categories;
CREATE TABLE ftfbb_categories(
	cat_id mediumint(8) unsigned NOT NULL auto_increment,
	cat_title varchar(100),
	cat_order mediumint(8) unsigned NOT NULL, 
	PRIMARY KEY (cat_id), 
	KEY cat_order (cat_order)
);

#
# Table Data for ftfbb_categories
#

INSERT INTO ftfbb_categories (cat_id, cat_title, cat_order) VALUES('9', 'Elektro', '50');
INSERT INTO ftfbb_categories (cat_id, cat_title, cat_order) VALUES('8', 'Grafika', '40');
INSERT INTO ftfbb_categories (cat_id, cat_title, cat_order) VALUES('6', 'TRS 2004 / 2006', '20');
INSERT INTO ftfbb_categories (cat_id, cat_title, cat_order) VALUES('10', 'VöeobecnÈ informace o fÛru', '10');
INSERT INTO ftfbb_categories (cat_id, cat_title, cat_order) VALUES('11', 'OstatnÌ', '60');
#
# TABLE: ftfbb_config
#
DROP TABLE IF EXISTS ftfbb_config;
CREATE TABLE ftfbb_config(
	config_name varchar(255) NOT NULL,
	config_value varchar(255) NOT NULL, 
	PRIMARY KEY (config_name)
);

#
# Table Data for ftfbb_config
#

INSERT INTO ftfbb_config (config_name, config_value) VALUES('config_id', '1');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('board_disable', '0');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('sitename', 'Fugessovo fÛrum');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('site_desc', 'Trainz Railroad Simulator 2004 / 2006, Grafika, Elektro');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('cookie_name', 'phpbb2mysql');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('cookie_path', '/');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('cookie_domain', '');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('cookie_secure', '0');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('session_length', '3600');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('allow_html', '0');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('allow_html_tags', 'b,i,u,pre');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('allow_bbcode', '1');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('allow_smilies', '1');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('allow_sig', '1');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('allow_namechange', '0');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('allow_theme_create', '0');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('allow_avatar_local', '0');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('allow_avatar_remote', '0');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('allow_avatar_upload', '1');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('enable_confirm', '1');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('allow_autologin', '1');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('max_autologin_time', '0');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('override_user_style', '0');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('posts_per_page', '15');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('topics_per_page', '50');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('hot_threshold', '25');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('max_poll_options', '10');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('max_sig_chars', '255');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('max_inbox_privmsgs', '50');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('max_sentbox_privmsgs', '25');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('max_savebox_privmsgs', '50');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('board_email_sig', 'Fugess');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('board_email', 'fugess-trainz-forum@netuje.cz');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('smtp_delivery', '0');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('smtp_host', '');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('smtp_username', '');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('smtp_password', '');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('sendmail_fix', '0');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('require_activation', '1');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('flood_interval', '15');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('search_flood_interval', '10');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('search_min_chars', '3');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('max_login_attempts', '5');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('login_reset_time', '30');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('board_email_form', '1');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('avatar_filesize', '92000');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('avatar_max_width', '90');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('avatar_max_height', '90');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('avatar_path', 'images/avatars');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('avatar_gallery_path', 'images/avatars/gallery');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('smilies_path', 'images/smiles');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('default_style', '21');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('default_dateformat', 'l, d M, Y G:i');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('board_timezone', '1');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('prune_enable', '1');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('privmsg_disable', '0');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('gzip_compress', '0');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('coppa_fax', '');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('coppa_mail', '');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('record_online_users', '4');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('record_online_date', '1174222601');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('server_name', 'fugess-trainz-forum.netuje.cz');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('server_port', '80');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('script_path', '/Fugess-Trainz/');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('version', '.0.22');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('rand_seed', 'fe8de5578afdf3804738cb23cc48931a');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('board_startdate', '1173462467');
INSERT INTO ftfbb_config (config_name, config_value) VALUES('default_lang', 'czech');
#
# TABLE: ftfbb_disallow
#
DROP TABLE IF EXISTS ftfbb_disallow;
CREATE TABLE ftfbb_disallow(
	disallow_id mediumint(8) unsigned NOT NULL auto_increment,
	disallow_username varchar(25) NOT NULL, 
	PRIMARY KEY (disallow_id)
);
#
# TABLE: ftfbb_forums
#
DROP TABLE IF EXISTS ftfbb_forums;
CREATE TABLE ftfbb_forums(
	forum_id smallint(5) unsigned NOT NULL,
	cat_id mediumint(8) unsigned NOT NULL,
	forum_name varchar(150),
	forum_desc text,
	forum_status tinyint(4) NOT NULL,
	forum_order mediumint(8) unsigned DEFAULT '1' NOT NULL,
	forum_posts mediumint(8) unsigned NOT NULL,
	forum_topics mediumint(8) unsigned NOT NULL,
	forum_last_post_id mediumint(8) unsigned NOT NULL,
	prune_next int(11),
	prune_enable tinyint(1) NOT NULL,
	auth_view tinyint(2) NOT NULL,
	auth_read tinyint(2) NOT NULL,
	auth_post tinyint(2) NOT NULL,
	auth_reply tinyint(2) NOT NULL,
	auth_edit tinyint(2) NOT NULL,
	auth_delete tinyint(2) NOT NULL,
	auth_sticky tinyint(2) NOT NULL,
	auth_announce tinyint(2) NOT NULL,
	auth_vote tinyint(2) NOT NULL,
	auth_pollcreate tinyint(2) NOT NULL,
	auth_attachments tinyint(2) NOT NULL, 
	PRIMARY KEY (forum_id), 
	KEY forums_order (forum_order), 
	KEY cat_id (cat_id), 
	KEY forum_last_post_id (forum_last_post_id)
);

#
# Table Data for ftfbb_forums
#

INSERT INTO ftfbb_forums (forum_id, cat_id, forum_name, forum_desc, forum_status, forum_order, forum_posts, forum_topics, forum_last_post_id, prune_next, prune_enable, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments) VALUES('4', '10', 'N·vrhy a ¯eöenÌ', 'N·vrhy na vylepöenÌ fÛra a jejich ¯eöenÌ', '0', '20', '3', '1', '42', NULL, '0', '0', '1', '1', '1', '1', '1', '3', '3', '1', '1', '0');
INSERT INTO ftfbb_forums (forum_id, cat_id, forum_name, forum_desc, forum_status, forum_order, forum_posts, forum_topics, forum_last_post_id, prune_next, prune_enable, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments) VALUES('3', '10', 'StruËn˝ popis fÛra', 'Sezn·menÌ s moûnostmi tohohle fÛra', '1', '10', '1', '1', '24', NULL, '0', '0', '1', '1', '1', '1', '1', '3', '3', '1', '1', '0');
INSERT INTO ftfbb_forums (forum_id, cat_id, forum_name, forum_desc, forum_status, forum_order, forum_posts, forum_topics, forum_last_post_id, prune_next, prune_enable, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments) VALUES('2', '9', 'SchÈmata', 'SchÈmata ovÏ¯en˝ch i neovÏ¯en˝ch v˝robk˘ a diskuze k nim', '0', '20', '0', '0', '0', NULL, '0', '0', '1', '1', '1', '1', '1', '3', '3', '1', '1', '0');
INSERT INTO ftfbb_forums (forum_id, cat_id, forum_name, forum_desc, forum_status, forum_order, forum_posts, forum_topics, forum_last_post_id, prune_next, prune_enable, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments) VALUES('1', '9', 'Elektro v˝robky', 'Fotky funkËnÌch i nefunkËnÌch v˝robk˘ a diskuze k nim', '0', '10', '4', '2', '41', NULL, '0', '0', '1', '1', '1', '1', '1', '3', '3', '1', '1', '0');
INSERT INTO ftfbb_forums (forum_id, cat_id, forum_name, forum_desc, forum_status, forum_order, forum_posts, forum_topics, forum_last_post_id, prune_next, prune_enable, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments) VALUES('5', '6', 'Stavba objekt˘', 'Novinky, informace a vöe kolem stavby objekt˘', '0', '10', '0', '0', '0', NULL, '0', '0', '1', '1', '1', '1', '1', '3', '3', '1', '1', '0');
INSERT INTO ftfbb_forums (forum_id, cat_id, forum_name, forum_desc, forum_status, forum_order, forum_posts, forum_topics, forum_last_post_id, prune_next, prune_enable, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments) VALUES('6', '8', '3D Grafika', 'Obr·zky re·ln˝ch i nere·ln˝ch scÈn', '0', '10', '0', '0', '0', NULL, '0', '0', '1', '1', '1', '1', '1', '3', '3', '1', '1', '0');
INSERT INTO ftfbb_forums (forum_id, cat_id, forum_name, forum_desc, forum_status, forum_order, forum_posts, forum_topics, forum_last_post_id, prune_next, prune_enable, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments) VALUES('7', '6', 'Projekty', 'ChystanÈ a st·vajÌcÌ projekty', '0', '20', '2', '2', '27', NULL, '0', '0', '1', '1', '1', '1', '1', '3', '3', '1', '1', '0');
INSERT INTO ftfbb_forums (forum_id, cat_id, forum_name, forum_desc, forum_status, forum_order, forum_posts, forum_topics, forum_last_post_id, prune_next, prune_enable, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments) VALUES('8', '6', 'Tutori·ly', 'N·vody na gmax / 3Dsmax', '0', '30', '3', '1', '31', NULL, '0', '0', '1', '1', '1', '1', '1', '3', '3', '1', '1', '0');
INSERT INTO ftfbb_forums (forum_id, cat_id, forum_name, forum_desc, forum_status, forum_order, forum_posts, forum_topics, forum_last_post_id, prune_next, prune_enable, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments) VALUES('9', '9', 'Unik·tnÌ fotky a videa', 'JedineËnÈ fotky a videa - co dok·ûe elektronika', '0', '30', '1', '1', '36', NULL, '0', '0', '1', '1', '1', '1', '1', '3', '3', '1', '1', '0');
INSERT INTO ftfbb_forums (forum_id, cat_id, forum_name, forum_desc, forum_status, forum_order, forum_posts, forum_topics, forum_last_post_id, prune_next, prune_enable, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments) VALUES('10', '6', 'Programy', 'Programy jako pom˘cky p¯i tvorbÏ v TRS', '0', '40', '6', '1', '43', NULL, '0', '0', '1', '1', '1', '1', '1', '3', '3', '1', '1', '0');
INSERT INTO ftfbb_forums (forum_id, cat_id, forum_name, forum_desc, forum_status, forum_order, forum_posts, forum_topics, forum_last_post_id, prune_next, prune_enable, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments) VALUES('11', '11', 'Re·ln· ûeleznice', 'Fotky a videa z re·lu', '0', '10', '0', '0', '0', NULL, '0', '0', '1', '1', '1', '1', '1', '3', '3', '1', '1', '0');
INSERT INTO ftfbb_forums (forum_id, cat_id, forum_name, forum_desc, forum_status, forum_order, forum_posts, forum_topics, forum_last_post_id, prune_next, prune_enable, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky, auth_announce, auth_vote, auth_pollcreate, auth_attachments) VALUES('12', '11', 'Modelov· ûeleznice', 'Fotky a videa z modelovÈ ûeleznice', '0', '20', '0', '0', '0', NULL, '0', '0', '1', '1', '1', '1', '1', '3', '3', '1', '1', '0');
#
# TABLE: ftfbb_forum_prune
#
DROP TABLE IF EXISTS ftfbb_forum_prune;
CREATE TABLE ftfbb_forum_prune(
	prune_id mediumint(8) unsigned NOT NULL auto_increment,
	forum_id smallint(5) unsigned NOT NULL,
	prune_days smallint(5) unsigned NOT NULL,
	prune_freq smallint(5) unsigned NOT NULL, 
	PRIMARY KEY (prune_id), 
	KEY forum_id (forum_id)
);
#
# TABLE: ftfbb_groups
#
DROP TABLE IF EXISTS ftfbb_groups;
CREATE TABLE ftfbb_groups(
	group_id mediumint(8) NOT NULL auto_increment,
	group_type tinyint(4) DEFAULT '1' NOT NULL,
	group_name varchar(40) NOT NULL,
	group_description varchar(255) NOT NULL,
	group_moderator mediumint(8) NOT NULL,
	group_single_user tinyint(1) DEFAULT '1' NOT NULL, 
	PRIMARY KEY (group_id), 
	KEY group_single_user (group_single_user)
);

#
# Table Data for ftfbb_groups
#

INSERT INTO ftfbb_groups (group_id, group_type, group_name, group_description, group_moderator, group_single_user) VALUES('1', '1', 'Anonymous', 'Personal User', '0', '1');
INSERT INTO ftfbb_groups (group_id, group_type, group_name, group_description, group_moderator, group_single_user) VALUES('2', '1', 'Admin', 'Personal User', '0', '1');
INSERT INTO ftfbb_groups (group_id, group_type, group_name, group_description, group_moderator, group_single_user) VALUES('3', '1', '', 'Personal User', '0', '1');
INSERT INTO ftfbb_groups (group_id, group_type, group_name, group_description, group_moderator, group_single_user) VALUES('10', '1', '', 'Personal User', '0', '1');
INSERT INTO ftfbb_groups (group_id, group_type, group_name, group_description, group_moderator, group_single_user) VALUES('12', '0', 'Elektrotechnici', 'Lidi, kte¯Ì se zab˝vajÌ elektrotechnikou', '2', '0');
INSERT INTO ftfbb_groups (group_id, group_type, group_name, group_description, group_moderator, group_single_user) VALUES('9', '1', '', 'Personal User', '0', '1');
INSERT INTO ftfbb_groups (group_id, group_type, group_name, group_description, group_moderator, group_single_user) VALUES('11', '1', '', 'Personal User', '0', '1');
#
# TABLE: ftfbb_posts
#
DROP TABLE IF EXISTS ftfbb_posts;
CREATE TABLE ftfbb_posts(
	post_id mediumint(8) unsigned NOT NULL auto_increment,
	topic_id mediumint(8) unsigned NOT NULL,
	forum_id smallint(5) unsigned NOT NULL,
	poster_id mediumint(8) NOT NULL,
	post_time int(11) NOT NULL,
	poster_ip char(8) NOT NULL,
	post_username varchar(25),
	enable_bbcode tinyint(1) DEFAULT '1' NOT NULL,
	enable_html tinyint(1) NOT NULL,
	enable_smilies tinyint(1) DEFAULT '1' NOT NULL,
	enable_sig tinyint(1) DEFAULT '1' NOT NULL,
	post_edit_time int(11),
	post_edit_count smallint(5) unsigned NOT NULL, 
	PRIMARY KEY (post_id), 
	KEY forum_id (forum_id), 
	KEY topic_id (topic_id), 
	KEY poster_id (poster_id), 
	KEY post_time (post_time)
);

#
# Table Data for ftfbb_posts
#

INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('38', '14', '10', '5', '1174339706', '53f001fd', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('37', '15', '1', '5', '1174336026', '53f001fd', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('36', '16', '9', '2', '1174325210', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('35', '15', '1', '2', '1174318971', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('34', '14', '10', '2', '1174244179', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('24', '9', '3', '2', '1174136866', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('25', '10', '4', '2', '1174137555', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('26', '11', '7', '2', '1174215726', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('27', '12', '7', '2', '1174216367', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('33', '14', '10', '2', '1174243555', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('32', '14', '10', '5', '1174243338', '53f001fd', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('31', '13', '8', '2', '1174243025', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('30', '13', '8', '5', '1174242874', '53f001fd', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('29', '14', '10', '2', '1174221296', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('28', '13', '8', '2', '1174217983', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('39', '17', '1', '3', '1174339724', 'c2d5e7c3', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('40', '10', '4', '5', '1174340171', '53f001fd', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('41', '15', '1', '2', '1174391980', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('42', '10', '4', '2', '1174392236', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
INSERT INTO ftfbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('43', '14', '10', '2', '1174393858', '504e92f5', '', '1', '0', '1', '1', NULL, '0');
#
# TABLE: ftfbb_posts_text
#
DROP TABLE IF EXISTS ftfbb_posts_text;
CREATE TABLE ftfbb_posts_text(
	post_id mediumint(8) unsigned NOT NULL,
	bbcode_uid char(10) NOT NULL,
	post_subject char(60),
	post_text text, 
	PRIMARY KEY (post_id)
);

#
# Table Data for ftfbb_posts_text
#

INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('28', 'c5e70962f2', 'Jak si ozkouöet p¯episovateln˝ text v Gmaxu', 'Jednoduch˝ postup:

Vytvo¯Ìme libovolnÏ velk˝ box v pohledu [b:c5e70962f2]Front[/b:c5e70962f2]
[img:c5e70962f2]http://img403.imageshack.us/img403/1382/1822007161941kk0.jpg[/img:c5e70962f2]

NynÌ v sekci Helpers vybereme [b:c5e70962f2]Point[/b:c5e70962f2] a umÌstnÌme jej v pohledu [b:c5e70962f2]Front[/b:c5e70962f2]
[img:c5e70962f2]http://img165.imageshack.us/img165/9760/1822007161957yp4.jpg[/img:c5e70962f2]

TeÔ point zarovn·me pomocÌ n·stroje [b:c5e70962f2]Align[/b:c5e70962f2]
[img:c5e70962f2]http://img120.imageshack.us/img120/9537/1822007162005ur5.jpg[/img:c5e70962f2]

V oknÏ [b:c5e70962f2]Align Selection[/b:c5e70962f2] vybereme zarovn·nÌ do [b:c5e70962f2]centru[/b:c5e70962f2] a ve [b:c5e70962f2]vöech os·ch[/b:c5e70962f2] (viz. obr·zek)
[img:c5e70962f2]http://img68.imageshack.us/img68/2430/1822007162013qv9.jpg[/img:c5e70962f2]

V pohledu [b:c5e70962f2]Top[/b:c5e70962f2] p¯edsuneme point kousek p¯ed box, aby nebyl uprost¯ed boxu, proto, aby byl text v trainzovi vidÏt (viz. obr·zek)
[img:c5e70962f2]http://img373.imageshack.us/img373/9683/1822007162036gv4.jpg[/img:c5e70962f2]

Nakonec point p¯ejmenujeme na [b:c5e70962f2]a.name0[/b:c5e70962f2] (viz. obr·zek)
[img:c5e70962f2]http://img245.imageshack.us/img245/3234/1822007162048tg9.jpg[/img:c5e70962f2]

TeÔ uû jen staËÌ box otexturovat a vyexportovat standartnÏ do souboru s koncovkou .IM, a do configu uû se jenom p¯ÌpÌöou n·sledujÌcÌ hodnoty:
[img:c5e70962f2]http://img70.imageshack.us/img70/8426/1822007162113ap1.jpg[/img:c5e70962f2]

name - libovoln˝ n·zev (staËÌ n·zev objektu)

fontsize - velikost pÌsma - urËuje se v ËÌsle na jedno desetinnÈ mÌsto nebo cel· ËÌsla.

fontcolor - barva pÌsma - RGB barba se d· zjistit nap¯Ìklad v malov·nÌ, nebo ve photoshopu apod.');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('24', '5750a1cecf', 'StruËn˝ popis fÛra', 'VÌtejte v tomhle fÛru,

Tohle fÛrum jsem zaloûil na z·kladech prezentace stavby 3D objekt˘ do Trainze, a pak jsem se rozhodl zde zavÈst i kategorie Grafika a Elektro, jelikoû jsem velk˝ fanda zvl·öù do grafiky a elektra.

Jako prvnÌ bych V·s chtÏl sezn·mit, s tÌm ûe se zde vedou [b:5750a1cecf]UûivatelskÈ skupiny[/b:5750a1cecf], a proto m·te vöichni moûnost se za¯adit do nÏkterÈ z nich a tÌm mÌt i zvl·ötnÌ ohodnocenÌ. Podot˝k·m, ûe vyhovuji û·dostem o z¯ÌzenÌ nov˝ch uûivatelsk˝ch skupin, kterÈ zde nejsou.

D·le je zde veden· velk· z·soba smajlÌk˘.

A nakonec musÌm ozn·mit, ûe na û·dost o z¯ÌzenÌ nov˝ch podkategoriÌ takÈ vyhovuji.

Fugess - Administr·tor');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('27', 'a572ae5b21', 'StavÏdlo - Moravsk˝ Krumlov', 'Toto stavÏdlo je jiû v rozpracovanÈm st·diu, p·r fotek je jiû k dispozici.

[img:a572ae5b21]http://img184.imageshack.us/img184/1432/stavbastavedlomoravskykyq9.jpg[/img:a572ae5b21]

[img:a572ae5b21]http://img88.imageshack.us/img88/446/stavedloaahi4.jpg[/img:a572ae5b21]');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('25', '84a6de28c9', '⁄vod pro ¯eöenÌ', 'Zde uv·dÏjte n·vrhy na vylepöenÌ, pokud nÏjakÈ jsou, a ty se budou hned ¯eöit.');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('26', 'b3f4d5fa24', 'T 698.002', 'T 698.002 - PrvnÌ verze pomeranËe, p¯·nÌ a dotazy piöte zde.

Pr˘bÏûnÏ zde budu p¯id·vat fotky ze stavby.');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('29', 'f4904b2b27', 'Nov˝ Geniv Config Creator (GCC)', 'Nov· verze Geniv Config creatoru je ve v˝voji.

V tÈto verzi bude jiû zahrnuto:

- config pro TRS 2006
- konverze configu z TRS 2004 na TRS 2006
- konverze configu z TRS 2006 na TRS 2004
- nov˝ vzhled
- upravenÈ funkce
- otvÌr·nÌ config˘

obr·zky na uk·zku z v˝voje GCC

[img:f4904b2b27]http://img264.imageshack.us/img264/6279/1832007132408cu9.jpg[/img:f4904b2b27]

[img:f4904b2b27]http://img88.imageshack.us/img88/3316/1832007132441pb7.jpg[/img:f4904b2b27]');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('30', '139b21e049', '', 'äikovn˝ n·vod, hned si to jdu ozkouöet. DÌky.  :kresleni:');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('31', 'def4de87b7', '', ':arrow: liberk
Nem·ö zaË, v nejbliûöÌ dobÏ zde budou p¯ib˝vat dalöÌ   :wink:');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('32', '00b4408d43', '', 'Na druhÈm obr·zku m·ö optickou chybu - oprav si ji p¯ed vyd·nÌm novÈ verze - mÌsto &quot;Pozn·Mky&quot; tam m·ö &quot;Pozn·Nky&quot;.  :XXcomputer:');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('33', '9024910723', '', '[quote:9024910723=\"liberk\"]Na druhÈm obr·zku m·ö optickou chybu - oprav si ji p¯ed vyd·nÌm novÈ verze - mÌsto &quot;Pozn·Mky&quot; tam m·ö &quot;Pozn·Nky&quot;.  :XXcomputer:[/quote:9024910723]

dÌky za najitÌ chyby, z¯ejmÏ to bylo v rychlosti psanÈ :5obsessed: 
uû jsem ¯ekl bratrovi, aby to opravil. :)');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('34', '1d22ab93da', '', 'Je k dispozici alfa verze ke st·hnutÌ:

buÔ na webu br·chy: [url]http://geniv.wu.cz/[/url]
a nebo p¯Ìm˝ link: [url]http://geniv.ic.cz/alfa_verze.rar[/url]');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('35', '1aa4b6982a', 'SMD BlikaË - p·jenÌ hork˝m vzduchem', 'Tento blikaË je jednoduchÈ zapojenÌ dvou tranzistor˘, dvou kondenz·tor˘, Ëty¯ rezistor˘ a dvou LED diod. SchÈma bylo jednoduchÈ (teda aspoÚ pro mÏ), navrhnout to nebyl problÈm, ale to kreslenÌ uû dalo docela zabrat, kdyû porovn·m, ûe jsem ty cesty kreslil 0,3 mm fixou (modrou - zakoupenou ze skladu na praxi) v pomÏru, ûe ten ploöiÚ·k m· 2x2 cm. P·jenÌ se prov·dÏlo nejprve pocÌnov·nÌm ploch na DPS p·jkou, kter· je souË·stÌ horkovzduönÈ stanice, potom se ods·l cÌn pomocÌ ods·vaËky, kter· je souË·stÌ p·jecÌ stanice, aby byly ploöky jemnÏ pocÌnovanÈ. NynÌ jsem pokaûdÈ nanesl p·jecÌ pastu (kter· obsahuje 80% cÌnu), na ploöky, kterÈ jsem se chystal p·jet a pak uû jsem jen pinzetou p¯iloûil souË·stku a hlavnÏ p¯idrûel, protoûe vzduch z horkovzduönÈ p·jky byl intenzivnÌ. P¯i ozkouöenÌ intenzity vzduchu nap¯Ìklad rukou se intenzita nezd·, ale musÌ se br·t v ˙vahu, ûe SMD souË·stka nev·ûÌ p˘l tuny, ale velmi malÈ mnoûstvÌ miligram˘, a hlavnÏ je velikostnÏ odpornÏ mal·. Horkovzduön· p·jka m· sice regulovateln˝ proud vzduchu, ale aby tavila cÌn rychle, tak je zapot¯ebÌ mÌt dostateËnou intenzitu, dÌky kterÈ SMD souË·stka p¯i nep¯idrûenÌ nap¯Ìklad pinzetou neust·le odlÌt·vala. Do nanesenÈ p·jecÌ pasty se poloûÌ p¯Ìsluön· SMD souË·stka a pak uû se jen nech· oh¯·t horkovzduönou p·jkou.
Jednalo se o cviËnou soubornou pr·ci na z·vÏreËnÈ zkouöky, kterou naötÏstÌ s nejvÏtöÌ pravdÏpodobnostÌ my nedostaneme.
PouûitÈ SMD souË·stky:
2x rezistory 470R
2x rezistory 100k?
2x tranzistory NPN
2x kondenz·tory 10µF/35V
Dvojit· ledka Ëerven· a zelen· (stejnÏ vyvedenÈ jak K, tak A)

SchÈma SMD BlikaËe p¯i ËervenÈ diodÏ:
[img:1aa4b6982a]http://img73.imageshack.us/img73/4100/1932007170544yl6.jpg[/img:1aa4b6982a]

SchÈma SMD BlikaËe p¯i zelenÈ diodÏ:
[img:1aa4b6982a]http://img386.imageshack.us/img386/271/1932007170542mc6.jpg[/img:1aa4b6982a]

Obr·zek mÈho osazenÈho DPS
[img:1aa4b6982a]http://img19.imageshack.us/img19/5718/p2274319qs6.jpg[/img:1aa4b6982a]

A jeötÏ obr·zek k·moöovÈho DPSka Johnyho (Jirka B.)
[img:1aa4b6982a]http://img456.imageshack.us/img456/413/p2274321vj0.jpg[/img:1aa4b6982a]');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('36', '34fe7b36a6', 'Destrukce elektrolitickÈho kondenz·toru - foto a video', 'Na uk·zku sem zahrnu p·r fotek a jedno &quot;lajv&quot; video v˝buchu elektrolitickÈho kondenz·toru.

Destrukce kondenz·toru aneb nuda na prax·ch.

VÏtöina lidÌ nevidÏla jak v˘bec takov˝ kondenz·tor exploduje, tak m·te moûnost to zjistit a zasm·t se  :lol: 

nejprve p·r fotek:

dva kondenz·tory (vlevo jiû po destrukci a v pravo teprve p¯ed  :tocici: )
[img:34fe7b36a6]http://img47.imageshack.us/img47/8793/p1163818ks6.jpg[/img:34fe7b36a6]

to samÈ, akor·t jsou op¯enÈ o d˘lËÌk
[img:34fe7b36a6]http://img47.imageshack.us/img47/4498/p1163823tx1.jpg[/img:34fe7b36a6]

a tady uû oba dva po destrukci
[img:34fe7b36a6]http://img128.imageshack.us/img128/8817/p1163835nk9.jpg[/img:34fe7b36a6]

NynÌ obr·zky z videa a nakonec samotnÈ video

zapojen˝ kondenz·tor s opaËnou polaritou na maxim·lnÌ napÏtÌ co ten zdroj dok·ûe p¯ed destrukcÌ
[img:34fe7b36a6]http://img128.imageshack.us/img128/4613/1932007175338np5.jpg[/img:34fe7b36a6]

a jeötÏ fotka kondenz·toru p¯i destrukci
[img:34fe7b36a6]http://img128.imageshack.us/img128/8964/1932007175409sg4.jpg[/img:34fe7b36a6]

a zde samotnÈ video: [url]http://www.sendspace.com/file/bk0lji[/url]

informace o videu:
form·t: MOV
rozliöenÌ: 640 x 480
zvuk: ANO

a malÈ upozorÏnÌ: [size=18:34fe7b36a6]!!! NEZKOUäEJTE TO DOMA !!![/size:34fe7b36a6]
(po v˝buchu ten kondenz·tor znaËnÏ smrdÌ, dielektrikum se rozletÌ do cca p˘l metru, a hlavnÏ nem˘ûete vÏdÏt jak ten kondenz·tor vybuchne a kam poletÌ, u kaûdÈho typu je ten v˝buch odliön˝)
Elektrolitick˝ m· vÏtöinou p¯Ìmou dr·hu v˝buchu a nap¯Ìklad u fÛliovÈho m˘ûe buÔ velmi zaËmoudit, nebo se cel˝ rozst¯elit na vöechny strany, Ëehoû jsem byl svÏdkem.');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('37', '8cb4328549', '', 'Taky jsem byl obËas donucen nÏco sp·chat (dnes uû moc ne, prakticky vöechno se d· koupit levnÏji neû si to ËlovÏk udÏl· - snad jedinou v˝jimkou jsou zapojenÌ pro vl·Ëky = cena !), ale SMD jsem se vyh˝bal jak Ëert k¯Ìûi, protoûe s mou pistolovou p·jkou to jaksi &quot;nebylo ono&quot;. NavÌc dnes uû se stavÌ vöechno na programovateln˝ch procesorech a j· skonËil jeötÏ na stavÏnÌ s klasick˝mi souË·stkami. Bylo to vÏtöÌ, ale jaksi p¯ehlednÏjöÌ a sn·ze opravitelnÈ.....  :-k');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('38', '2cf9583253', '', 'Tak jsem si ¯ekl, ûe v·m s bratrem trochu otestuji tu novou verzi GCC. Vyzkouöel jsem zaloûit nov˝ config v TRS04. Tv·¯Ì se to dob¯e, jenom poloûku &quot;region&quot; to nevytv·¯Ì. Pod regionem se vytvo¯Ì &quot;category-region-0&quot; - asi to tak m· b˝t ?!
P¯i naËtenÌ a editaci existujÌcÌho je to horöÌ. Nep¯eËte to kuid, kter˝ m· n·zev &quot;kuid&quot; napsan˝ velk˝mi pÌsmeny (mal˝m p¯eËte) a pak to vezme prvnÌ dalöÌ kuid (t¯eba bogey). NÏkdy naËte do &quot;Regionu&quot; obsah &quot;category-region-0&quot; a nÏkdy obsah &quot;regionu&quot; (nevypozoroval jsem z·vislost). Bylo by dobr˝, kdyby p¯i editaci existujÌcÌho configu se mÏnily hodnoty jako u novÈho a nemusela se zmÏna ¯eöit nov˝m nastavenÌm podle existujÌcÌho a p¯evodem do novÈho (jo a zruö dlouhÈ &quot;È&quot; v &quot;PrevÈÔ do novÈho&quot;).
A naco je pozn·mka, kdyû se v configu neobjevÌ ?
TlaËÌtko konverze 2004 --&gt; 2006 nefunguje, ale to asi jeötÏ nem· fungovat, ûe ?). 
Toù zatÌm ode mÏ vöe, musÌm taky nÏco pozitivnÌho - je to dobr˝ progr·mek, zvl·ötÏ pro zaË·teËnÌky. NejvÌc se mi lÌbÌ moûnost nastavov·nÌ parametr˘ (nap¯. smoke) a to ûe je v kaûdÈm polÌËku bublinov· n·povÏda, to je nÏco pro mÏ.  :D');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('39', '88c818acb0', 'SMD blikaË ¯Ìzen˝ procesorem ATtiny12', 'ZapojenÌ s mikroprocesory jsou velice jednoduch· protoûe odpad· mnoho desÌtek souË·stek, kterÈ v klasickÈm zapojenÌ byli zapot¯ebÌ. MluvÌm zde o ¯adÏ mikroprocesor˘ (d·le jiû MCU) ATMEL AVR ([url]http://www.atmel.com/products/[/url]), kterÈ se mi skvÏle osvedËily. Jen mal· odboËka, chctÏl jsem p˘vodnÏ zaËÌt s MCU typu PIC 16Fxx, jelikoû jsem v tÈ dobÏ nech·pal programovacÌ algoritmy a nedok·zal splaöit levn˝ a spolehliv˝ program·tor tak jsem se letoönÌ v·noce vrhl na MCU ¯ady AVR. Jedn· se o novou ¯adu, ktre· jiû [b:88c818acb0]nevych·zÌ[/b:88c818acb0] z ¯ady x51. Tato nov· ¯ada m· dost internÌch periferiÌ kterÈ se dajÌ s ˙spÏchem pouûÌvat. 
Tedy k tomu blikaËi. Je zde pouûit MCU typu ATtiny12 SMD, cena je asi 26KË, MCU m· jednu necelou br·nu tzn ûe m· jen 5 I/O pin˘. Je v pouzd¯e SOIC 8, m· tudÌû 8 noûiËek... Je zde zapojen˝ch 5 LED smd ve velikosti 1206 zemÌ do MCU. Tyto MCU dok·ûou tÌmto zp˘sobem spÌnat mnohem vÏtöÌ proudy, tzn spÌnajÌ na log0 oproti spÌn·nÌ na log1.
SchÈma jak vidÌte je velice jednoduchÈ...gunkce neomezen·!
[img:88c818acb0]http://geniv.ic.cz/blik_AT12.gif[/img:88c818acb0]
pozn.: ta propojka je tam z d˘vodu aby bylo moûnÈ MCU naprogramovat p¯Ìmo v aplikaci; diody mohou b·t libovolnÈ barvy a velikosti; kondÌk na nap·jenÌ je tam kv˘li ruöenÌ.
Ovöem samotnÈ zapojenÌ kdyû ho sloûÌte nebude dÏlat nic! ProË? Porroûe kaûd˝ MCU se musÌ naprogramovat k tomu tam jsou ty konektory bokem.
Aby v·m to &quot;nÏco dÏlalo&quot; taj je zapot¯ebÌ MCU naprogramovat...
program pro nejakou obsluhu 5 LED pro toto zapojenÌ je:
[code:1:88c818acb0]
.NOLIST
.include &quot;tn12def.inc&quot;
.LIST

.def ce1	=r16
.def ce2	=r17
.def ce3	=r19
.def temp	=r18
.def poc	=r20
.equ max	=2
.equ doin	=0
.equ pred	=5
.cseg
clr poc
ser temp
out osccal,temp
ldi temp,31
out ddrB,temp
out portB,temp
ldi ce3,max
ldi temp,1

hc&#58;
dec ce1
brne hc
dec ce2
brne hc
dec ce3
brne hc
ldi ce3,max
inc poc		;++
cpi poc,2
breq hc1
cpi poc,4
breq hc2
cpi poc,6
breq hc3
cpi poc,8
breq hc4
cpi poc,10
breq hc5
cpi poc,12
breq hc6
cpi poc,14
breq hc7
cpi poc,16
breq hc8
rjmp hc

hc1&#58;
ldi temp,27	;2
out portB,temp
rjmp hc

hc2&#58;
ldi temp,29	;1
out portB,temp
rjmp hc

hc3&#58;
ldi temp,30	;0
out portB,temp
rjmp hc

hc4&#58;
ldi temp,15	;4
out portB,temp
rjmp hc

hc5&#58;
ldi temp,23	;3
out portB,temp
rjmp hc

hc6&#58;
ldi temp,15	;4
out portB,temp
rjmp hc

hc7&#58;
ldi temp,30	;0
out portB,temp
rjmp hc

hc8&#58;
ldi temp,29	;1
out portB,temp
clr poc
rjmp hc
[/code:1:88c818acb0]
Program·tor je k dispozici na: [url]http://www.lancos.com/siprogsch.html[/url]
JeötÏ abych nezapomÏl tak tady je schÈma rozloûenÌ pin˘ na MCU typu ATtiny12:
[img:88c818acb0]http://geniv.ic.cz/ATtiny12_rozl.gif[/img:88c818acb0]');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('40', 'af11164cce', '', 'M·m dotaz. Nem·ö tu nÏco jako &quot;galerie&quot; = odkl·dacÌ prostor pro obr·zky, jako je t¯eba na str·nk·ch trainzu.cz . Kdybych chtÏl vloûit obr·zek, tak ho musÌm nÏkde na webu uloûit a odtud na nÏj hodit odkaz. Co ty na to ?  :bduh:');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('41', '1c2b88eed2', '', 'JÛ to vÏ¯Ìm  :)  j· jsem aû do druh·ku nemÏl s SMD souË·stka co doËinÏnÌ, aû od t¯eù·ku jsem se tÌm zaËal z·b˝vat, a toto byl m˘j prnÌ v˝tvor s SMD souË·stkama. P¯ed t˝dnem jsem postavil SMD blikaË s ATtinou (procesorem) a v˝sledek byl skÏl˝, funguje .. no spÌö fungoval, dokud ho br·cha v˝konovÏ neodva¯il. Takûe p¯ÌötÌ t˝den ten procesor musÌm vymÏnit. Fotky, pop¯ÌpadÏ videa z toho blikaËe d·m do novÈho tÈmatu, poËÌt·m, ûe jeötÏ dnes.  :wink:');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('42', '2fd5d1481d', '', ':arrow: liberk
Odkl·dacÌ prostor bych zde chtÏl, tak to skusÌm ¯eöit s bratrem, p¯ÌötÌ t˝den zde ta galerie moûn· bude. ZatÌm m˘ûeö vyuûÌvat prostor, kter˝ vyuûÌv·m i j· na str·nk·ch http://www.imageshack.us/ kde svoje obr·zky m˘ûeö uloûit, a nikdo ti je nesmaûe (pokud to ovöem nejsou pras·rny  :lol: ) a pak uû jen staËÌ si d·t vlastnosti toho obr·zku, zkopÌrovat si ten odkaz na nÏj a vloûit do fÛra.');
INSERT INTO ftfbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('43', '259e704a27', '', ':arrow: liberk
DÏkuji moc za otestov·nÌ, protoûe j· jsu na to testov·nÌ s·m a mnohdy nÏkterÈ chyby neobjevÌm.
TeÔ k parametr˘m:

Poloûka category-region-0 - je sv·z·na s p¯Ìkazem Region, Ëili kdyû klapneö v levÈm menu na poloûku region tak se objevÌ t¯i nabÌdky CZ, SK a CS, a p¯i zad·nÌ jednÈ z tÏchto t¯Ì moûnostÌ se automaticky vyplnÌ i Region. P¯i zad·nÌ jinÈ hodnoty to nevytvo¯Ì Region, coû je pravda, ûe jsem si toho teÔ taky vöiml, takûe prvnÌ oprava - k regionu se p¯id· datab·ze vöech hodnot category-region-0, aby to bylo automaticky sv·zanÈ s p¯Ìkazem Region a vyplÚovalo se to vz·jemnÏ.
Je to uû i ochrana k tomu, aby to TRS 2006 pobrala, protoûe 06 nebere category-region-0 &quot;Czech Republic&quot;, ale jenom &quot;CZ&quot;.

Kuid - to je druh· vÏc, kter· se opravÌ, aby to p¯eËetlo jak velkÈ, tak i malÈ pÌsmena bez problÈmu.

DlouhÈ &quot;È&quot;, v tuto chvÌly zrovna netuöÌm, kde to je napsanÈ, kouk·m na to, ale &quot;p¯eveÔ do novÈhu&quot; tu nem˘ûu najÌt, napiö prosÌm, podrobnÏji kde je ten text chybnÏ, aby se to mohlo opravit.

S pozn·mkou je to tak, ta by mÏla nejspÌö z˘stat v programu, jeötÏ se musÌm zeptat br·chy, jak to m· p¯esnÏ fungovat ta pozn·mka.

TlaËÌtko konverze zatÌm nem· fungovat, na tÈhle funkci se zatÌm pracuje.

Bublinov· n·povÏda je tam dÏlan· pro zjednoduöenÌ, coû opravdu p¯in·öÌ uûitek a hlavnÏ porozumÏnÌ, co by se mÏlo zhruba do configu napsat pro spr·vnou funkci obejktu.

Jin·Ë GCC je zatÌm hlavnÏ testovan˝ na scenery objektech, takûe nem˘ûeme zaruËit funkËnost na configu pro maöiny, vagÛny, a jinÈ objekty kromÏ statick˝ch s kou¯ov˝m efektem, nigh mÛdem, a Ëasem i s animacÌ.

Za nalezenÈ chyby a upozornÏnÌ na nÏ dÏkuji, chyby se opravÌ a jak se vyd· aktualizovan· verze, tak zde napÌöu.');
#
# TABLE: ftfbb_privmsgs
#
DROP TABLE IF EXISTS ftfbb_privmsgs;
CREATE TABLE ftfbb_privmsgs(
	privmsgs_id mediumint(8) unsigned NOT NULL auto_increment,
	privmsgs_type tinyint(4) NOT NULL,
	privmsgs_subject varchar(255) NOT NULL,
	privmsgs_from_userid mediumint(8) NOT NULL,
	privmsgs_to_userid mediumint(8) NOT NULL,
	privmsgs_date int(11) NOT NULL,
	privmsgs_ip char(8) NOT NULL,
	privmsgs_enable_bbcode tinyint(1) DEFAULT '1' NOT NULL,
	privmsgs_enable_html tinyint(1) NOT NULL,
	privmsgs_enable_smilies tinyint(1) DEFAULT '1' NOT NULL,
	privmsgs_attach_sig tinyint(1) DEFAULT '1' NOT NULL, 
	PRIMARY KEY (privmsgs_id), 
	KEY privmsgs_from_userid (privmsgs_from_userid), 
	KEY privmsgs_to_userid (privmsgs_to_userid)
);
#
# TABLE: ftfbb_privmsgs_text
#
DROP TABLE IF EXISTS ftfbb_privmsgs_text;
CREATE TABLE ftfbb_privmsgs_text(
	privmsgs_text_id mediumint(8) unsigned NOT NULL,
	privmsgs_bbcode_uid char(10) NOT NULL,
	privmsgs_text text, 
	PRIMARY KEY (privmsgs_text_id)
);
#
# TABLE: ftfbb_ranks
#
DROP TABLE IF EXISTS ftfbb_ranks;
CREATE TABLE ftfbb_ranks(
	rank_id smallint(5) unsigned NOT NULL auto_increment,
	rank_title varchar(50) NOT NULL,
	rank_min mediumint(8) NOT NULL,
	rank_special tinyint(1),
	rank_image varchar(255), 
	PRIMARY KEY (rank_id)
);

#
# Table Data for ftfbb_ranks
#

INSERT INTO ftfbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('1', 'Administr·tor', '-1', '1', 'images/ranks/ranks_administrator.gif');
INSERT INTO ftfbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('2', 'Moder·tor & Elektrotechnik', '-1', '1', 'images/ranks/ranks_moderator.gif');
INSERT INTO ftfbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('3', 'StupeÚ ukecanosti: 1', '0', '0', 'images/ranks/ranks_level_a.gif');
INSERT INTO ftfbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('4', 'StupeÚ ukecanosti: 2', '100', '0', 'images/ranks/ranks_level_b.gif');
INSERT INTO ftfbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('5', 'StupeÚ ukecanosti: 3', '300', '0', 'images/ranks/ranks_level_c.gif');
INSERT INTO ftfbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('6', 'StupeÚ ukecanosti: 4', '500', '0', 'images/ranks/ranks_level_d.gif');
INSERT INTO ftfbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('7', 'StupeÚ ukecanosti: 5', '1000', '0', 'images/ranks/ranks_level_e.gif');
INSERT INTO ftfbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('8', 'StupeÚ ukecanosti: 6', '2000', '0', 'images/ranks/ranks_level_f.gif');
INSERT INTO ftfbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('9', 'Elektrotechnik', '-1', '1', 'images/ranks/ranks_moderator.gif');
#
# TABLE: ftfbb_search_results
#
DROP TABLE IF EXISTS ftfbb_search_results;
CREATE TABLE ftfbb_search_results(
	search_id int(11) unsigned NOT NULL,
	session_id char(32) NOT NULL,
	search_time int(11) NOT NULL,
	search_array mediumtext NOT NULL, 
	PRIMARY KEY (search_id), 
	KEY session_id (session_id)
);

#
# Table Data for ftfbb_search_results
#

INSERT INTO ftfbb_search_results (search_id, session_id, search_time, search_array) VALUES('1418576072', '670edde8ef179812af9f5fc3c55062d4', '1174340316', 'a:7:{s:14:\"search_results\";s:18:\"10, 14, 15, 16, 17\";s:17:\"total_match_count\";i:5;s:12:\"split_search\";N;s:7:\"sort_by\";i:0;s:8:\"sort_dir\";s:4:\"DESC\";s:12:\"show_results\";s:6:\"topics\";s:12:\"return_chars\";i:200;}');
INSERT INTO ftfbb_search_results (search_id, session_id, search_time, search_array) VALUES('825514090', 'da50b2d4cef59042cd372d09df8bd4b7', '1174340225', 'a:7:{s:14:\"search_results\";s:18:\"38, 37, 32, 30, 40\";s:17:\"total_match_count\";i:5;s:12:\"split_search\";N;s:7:\"sort_by\";i:0;s:8:\"sort_dir\";s:4:\"DESC\";s:12:\"show_results\";s:5:\"posts\";s:12:\"return_chars\";i:200;}');
#
# TABLE: ftfbb_search_wordlist
#
DROP TABLE IF EXISTS ftfbb_search_wordlist;
CREATE TABLE ftfbb_search_wordlist(
	word_text varchar(50) NOT NULL,
	word_id mediumint(8) unsigned NOT NULL auto_increment,
	word_common tinyint(1) unsigned NOT NULL, 
	PRIMARY KEY (word_text), 
	KEY word_id (word_id)
);

#
# Table Data for ftfbb_search_wordlist
#

INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mailu', '40', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pottytrain2', '29', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('phpbb', '3', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pottytrain1', '28', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('newnewbie', '27', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zkouska', '18', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('û·dost', '541', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('text', '22', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dalsi', '21', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zima', '20', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('textu', '19', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('keci', '39', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ûe', '540', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('z¯ÌzenÌ', '539', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('z·soba', '538', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('z·kladech', '537', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zvl·öù', '536', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zvl·ötnÌ', '535', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zde', '534', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('bvknv', '47', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('j', '48', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jlh', '49', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('lhb', '50', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('lj', '51', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ljh', '52', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('za¯adit', '533', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zavÈst', '532', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zaloûil', '531', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vöichni', '530', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vÌtejte', '529', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('v·s', '528', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vyhovuji', '527', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('velk˝', '526', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vedou', '524', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('velk·', '525', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('veden·', '523', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('uûivatelsk˝ch', '522', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('uûivatelskÈ', '521', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tÌm', '520', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('trainze', '519', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tomhle', '518', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tohle', '517', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('takÈ', '516', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('struËn˝', '515', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('stavby', '514', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('smajlÌk˘', '513', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('skupiny', '512', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('skupin', '511', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('sezn·mit', '510', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('rozhodl', '509', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('proto', '507', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('prvnÌ', '508', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('prezentace', '506', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('popis', '505', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('podot˝k·m', '504', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('podkategoriÌ', '503', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pak', '502', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ozn·mit', '501', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ohodnocenÌ', '500', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('objekt˘', '499', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nÏkterÈ', '498', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nov˝ch', '497', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nich', '496', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nejsou', '495', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nakonec', '494', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mÌt', '493', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('m·te', '492', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('musÌm', '491', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('moûnost', '490', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kterÈ', '489', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kategorie', '488', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jsem', '487', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jelikoû', '486', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jako', '485', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('grafiky', '484', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('grafika', '483', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fÛrum', '482', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fÛru', '481', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fÛra', '480', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fugess', '479', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fanda', '478', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('elektro', '477', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('elektra', '476', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('d·le', '475', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('chtÏl', '474', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('bych', '473', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('administr·tor', '472', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('û·dostem', '542', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('budou', '543', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hned', '544', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jsou', '545', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('n·vrhy', '546', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nÏjakÈ', '547', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pokud', '548', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pro', '549', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ty', '550', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('uv·dÏjte', '551', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vylepöenÌ', '552', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('⁄vod', '553', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('¯eöenÌ', '554', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('¯eöit', '555', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('verze', '577', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯·nÌ', '576', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯id·vat', '575', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pr˘bÏûnÏ', '574', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pomeranËe', '573', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('piöte', '572', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fotky', '571', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dotazy', '570', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('budu', '569', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('698', '568', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('002', '567', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dispozici', '578', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fotek', '579', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jiû', '580', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('krumlov', '581', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('moravsk˝', '582', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p·r', '583', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('rozpracovanÈm', '584', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('stavÏdlo', '585', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('st·diu', '586', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('toto', '587', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ËÌsle', '932', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ËÌsla', '931', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zjistit', '930', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zarovn·nÌ', '929', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zarovn·me', '928', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vöech', '927', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vytvo¯Ìme', '926', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vyexportovat', '925', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vybereme', '924', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('viz', '923', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vidÏt', '922', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('velikost', '921', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ve', '920', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('v', '919', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('uû', '918', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('urËuje', '917', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('uprost¯ed', '916', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('umÌstnÌme', '915', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('trainzovi', '914', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('top', '913', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('teÔ', '912', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('staËÌ', '911', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('standartnÏ', '910', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('souboru', '909', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('selection', '908', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('sekci', '907', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('rgb', '906', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯ÌpÌöou', '905', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯episovateln˝', '904', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯ejmenujeme', '903', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯edsuneme', '902', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯ed', '901', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pÌsma', '900', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('postup', '899', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pomocÌ', '898', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('point', '897', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pohledu', '896', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('photoshopu', '895', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ozkouöet', '894', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('otexturovat', '893', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('os·ch', '892', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('oknÏ', '891', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('obr·zek', '890', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('objektu', '889', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('n·zev', '888', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('n·stroje', '887', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('n·sledujÌcÌ', '886', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nynÌ', '885', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nebyl', '884', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nebo', '883', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nap¯Ìklad', '882', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('name0', '881', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('name', '880', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mÌsto', '879', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('malov·nÌ', '878', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('libovolnÏ', '877', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('libovoln˝', '876', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kousek', '875', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('koncovkou', '874', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jenom', '873', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jen', '872', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jej', '871', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jednoduch˝', '870', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jedno', '869', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jak', '868', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hodnoty', '867', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('helpers', '866', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('gmaxu', '865', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('front', '864', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fontsize', '863', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fontcolor', '862', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('d·', '861', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('do', '860', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('desetinnÈ', '859', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('configu', '858', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('centru', '857', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('cel·', '856', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('byl', '855', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('boxu', '854', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('box', '853', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('barva', '852', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('barba', '851', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('apod', '850', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('align', '849', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('aby', '848', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('2004', '933', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('2006', '934', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('bude', '935', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('config', '936', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('config˘', '937', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('creator', '938', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('creatoru', '939', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('funkce', '940', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('gcc', '941', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('geniv', '942', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('konverze', '943', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nov·', '944', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nov˝', '945', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('obr·zky', '946', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('otvÌr·nÌ', '947', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('trs', '948', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tÈto', '949', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('uk·zku', '950', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('upravenÈ', '951', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('verzi', '952', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vzhled', '953', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('v˝voje', '954', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('v˝voji', '955', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zahrnuto', '956', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dÌky', '957', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jdu', '958', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kresleni', '959', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('n·vod', '960', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('to', '961', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('äikovn˝', '962', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('wink', '978', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯ib˝vat', '977', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nem·ö', '976', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nejbliûöÌ', '975', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('liberk', '974', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dobÏ', '973', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dalöÌ', '972', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('arrow', '971', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zaË', '979', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('chybu', '980', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('druhÈm', '981', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ji', '982', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('m·ö', '983', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('novÈ', '984', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('obr·zku', '985', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('oprav', '986', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('optickou', '987', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pozn·mky', '988', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pozn·nky', '989', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('quot', '990', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tam', '991', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vyd·nÌm', '992', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('xxcomputer', '993', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('5obsessed', '1014', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('bratrovi', '1015', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('bylo', '1016', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('chyby', '1017', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('najitÌ', '1018', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('opravil', '1019', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('psanÈ', '1020', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('rychlosti', '1021', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('z¯ejmÏ', '1022', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('¯ekl', '1023', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('alfa', '1024', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('br·chy', '1025', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('buÔ', '1026', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('k', '1027', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('link', '1028', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯Ìm˝', '1029', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('st·hnutÌ', '1030', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('webu', '1031', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vzduchem', '1475', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vzduch', '1474', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vyvedenÈ', '1473', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('velmi', '1472', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('velikostnÏ', '1471', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tuny', '1470', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tranzistor˘', '1469', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tranzistory', '1468', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('blikaË', '1040', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tento', '1467', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ten', '1466', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('teda', '1465', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tavila', '1464', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tak', '1463', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('stejnÏ', '1462', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('stanice', '1461', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('souË·stÌ', '1460', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('souË·stky', '1459', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('souË·stku', '1458', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('souË·stka', '1457', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('soubornou', '1456', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('skladu', '1455', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('sice', '1454', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('schÈma', '1453', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('rychle', '1452', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('rukou', '1451', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('rezistor˘', '1450', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('rezistory', '1449', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('regulovateln˝', '1448', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p˘l', '1447', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯Ìsluön·', '1446', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯iloûil', '1445', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯idrûel', '1444', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯i', '1443', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p·jky', '1442', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p·jkou', '1441', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p·jka', '1440', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p·jet', '1439', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p·jecÌ', '1438', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pr·ci', '1437', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('prov·dÏlo', '1436', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('proud', '1435', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('protoûe', '1434', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('problÈm', '1433', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('praxi', '1432', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pravdÏpodobnostÌ', '1431', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pouûitÈ', '1430', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('potom', '1429', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('porovn·m', '1428', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pomÏru', '1427', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('poloûÌ', '1426', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pokaûdÈ', '1425', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pocÌnov·nÌm', '1424', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pocÌnovanÈ', '1423', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ploöky', '1422', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ploöiÚ·k', '1421', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ploch', '1420', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pinzetou', '1419', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pasty', '1418', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pastu', '1417', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ozkouöenÌ', '1416', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('osazenÈho', '1415', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('oh¯·t', '1414', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ods·vaËky', '1413', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ods·l', '1412', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('odpornÏ', '1411', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('odlÌt·vala', '1410', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('obsahuje', '1409', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('o', '1408', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('npn', '1407', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nezd·', '1406', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nev·ûÌ', '1405', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('neust·le', '1404', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nep¯idrûenÌ', '1403', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nejvÏtöÌ', '1402', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nejprve', '1401', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nedostaneme', '1400', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nech·', '1399', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('naötÏstÌ', '1398', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('navrhnout', '1397', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nanesl', '1396', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nanesenÈ', '1395', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mÏ', '1394', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mÈho', '1393', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('m·', '1392', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('musÌ', '1391', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('modrou', '1390', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mnoûstvÌ', '1389', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('miligram˘', '1388', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('malÈ', '1387', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mal·', '1386', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ledka', '1385', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('led', '1384', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p·jenÌ', '1135', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('k·moöovÈho', '1383', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kter·', '1382', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kterou', '1381', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kreslil', '1380', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kreslenÌ', '1379', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kondenz·tor˘', '1378', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kondenz·tory', '1377', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kdyû', '1376', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('johnyho', '1375', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jirka', '1374', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jeötÏ', '1373', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jemnÏ', '1372', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jednoduchÈ', '1371', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('smd', '1153', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jednalo', '1370', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('intenzivnÌ', '1369', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('intenzity', '1368', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('intenzitu', '1367', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('intenzita', '1366', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hork˝m', '1365', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('horkovzduönÈ', '1364', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('horkovzduön·', '1363', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('horkovzduönou', '1362', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hlavnÏ', '1361', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fixou', '1360', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dvou', '1359', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dvojit·', '1358', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dpska', '1357', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dps', '1356', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dostateËnou', '1355', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('docela', '1354', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('diodÏ', '1353', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('diod', '1352', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dalo', '1351', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('cÌnu', '1350', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('cÌn', '1349', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('cviËnou', '1348', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('chystal', '1347', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('cesty', '1346', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('byly', '1345', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('br·t', '1344', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('blikaËe', '1343', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('aspoÚ', '1342', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ale', '1341', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('470r', '1340', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('35v', '1339', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('3', '1338', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('2x2', '1337', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('10µf', '1336', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('100k?', '1335', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vzduchu', '1476', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zabrat', '1477', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zakoupenou', '1478', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zapojenÌ', '1479', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zapot¯ebÌ', '1480', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zelen·', '1481', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zelenÈ', '1482', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zkouöky', '1483', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('z·vÏreËnÈ', '1484', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('˙vahu', '1485', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('Ëerven·', '1486', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ËervenÈ', '1487', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('Ëty¯', '1488', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('Ëehoû', '1734', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zvuk', '1733', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('znaËnÏ', '1732', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zdroj', '1731', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zaËmoudit', '1730', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zasm·t', '1729', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zapojen˝', '1728', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('destrukce', '1496', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zahrnu', '1727', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('v˘bec', '1726', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vöechny', '1725', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vÏtöinou', '1724', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vÏtöina', '1723', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vÏdÏt', '1722', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('v˝buchu', '1721', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('v˝buch', '1720', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vybuchne', '1719', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vlevo', '1718', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('videu', '1717', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('videa', '1716', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('upozorÏnÌ', '1715', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('typu', '1714', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tocici', '1713', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('teprve', '1712', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('takov˝', '1711', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tady', '1710', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('svÏdkem', '1709', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('strany', '1708', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('smrdÌ', '1707', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('sem', '1706', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('samÈ', '1705', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('samotnÈ', '1704', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('rozst¯elit', '1703', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('rozliöenÌ', '1702', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('rozletÌ', '1701', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯Ìmou', '1700', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('prax·ch', '1699', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pravo', '1698', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('poletÌ', '1697', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('polaritou', '1696', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('op¯enÈ', '1695', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('opaËnou', '1694', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('odliön˝', '1693', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('oba', '1692', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nuda', '1691', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nezkouäejte', '1690', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nevidÏla', '1689', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nem˘ûete', '1688', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('napÏtÌ', '1687', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('m˘ûe', '1686', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mov', '1685', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('metru', '1684', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('maxim·lnÌ', '1683', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kondenz·toru', '1599', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('lol', '1682', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('lidÌ', '1681', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('lajv', '1680', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kondenz·tor', '1679', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kaûdÈho', '1678', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kam', '1677', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('informace', '1676', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fÛliovÈho', '1675', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('foto', '1674', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('form·t', '1672', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('video', '1554', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fotka', '1673', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('elektrolitickÈho', '1588', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('exploduje', '1671', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('elektrolitick˝', '1670', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('d˘lËÌk', '1669', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dva', '1668', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dr·hu', '1667', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('doma', '1666', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dok·ûe', '1665', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dielektrikum', '1664', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('destrukcÌ', '1663', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('destrukci', '1662', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('cel˝', '1661', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('cca', '1660', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ano', '1659', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('aneb', '1658', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('akor·t', '1657', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('640', '1656', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('480', '1655', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('cena', '1735', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dnes', '1736', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('donucen', '1737', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jaksi', '1738', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jedinou', '1739', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('j·', '1740', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('klasick˝mi', '1741', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('koupit', '1742', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('k¯Ìûi', '1743', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('levnÏji', '1744', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('moc', '1745', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mou', '1746', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('navÌc', '1747', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nebylo', '1748', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('neû', '1749', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nÏco', '1750', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('obËas', '1751', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ono', '1752', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('opravitelnÈ', '1753', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pistolovou', '1754', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('prakticky', '1755', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('procesorech', '1756', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('programovateln˝ch', '1757', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯ehlednÏjöÌ', '1758', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('skonËil', '1759', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('snad', '1760', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('sn·ze', '1761', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('souË·stkami', '1762', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('sp·chat', '1763', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('stavÌ', '1764', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('stavÏnÌ', '1765', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('taky', '1766', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('udÏl·', '1767', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vl·Ëky', '1768', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vyh˝bal', '1769', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('v˝jimkou', '1770', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vÏtöÌ', '1771', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vöechno', '1772', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('Ëert', '1773', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ËlovÏk', '1774', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('a', '1775', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('asi', '1776', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('bogey', '1777', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('bratrem', '1778', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('bublinov·', '1779', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('b˝t', '1780', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('categoryregion0', '1781', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dlouhÈ', '1782', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dobr˝', '1783', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dob¯e', '1784', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('editaci', '1785', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('existujÌcÌho', '1786', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fungovat', '1787', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('horöÌ', '1788', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('je', '1789', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kaûdÈm', '1790', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kdyby', '1791', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kter˝', '1792', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kuid', '1793', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('lÌbÌ', '1794', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mal˝m', '1795', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mi', '1796', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mÏnily', '1797', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('naco', '1798', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('napsan˝', '1799', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nap¯', '1800', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nastavenÌm', '1801', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nastavov·nÌ', '1802', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('naËte', '1803', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('naËtenÌ', '1804', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nefunguje', '1805', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nejvÌc', '1806', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nemusela', '1807', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nem·', '1808', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('neobjevÌ', '1809', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nep¯eËte', '1810', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nevypozoroval', '1811', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nevytv·¯Ì', '1812', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('novou', '1813', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('novÈho', '1814', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nov˝m', '1815', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('n·povÏda', '1816', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nÏkdy', '1817', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('obsah', '1818', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ode', '1819', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('otestuji', '1820', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('parametr˘', '1821', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pod', '1822', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('podle', '1823', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('poloûku', '1824', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('polÌËku', '1825', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pozitivnÌho', '1826', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pozn·mka', '1827', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('prevÈÔ', '1828', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('progr·mek', '1829', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pÌsmeny', '1830', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯evodem', '1831', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯eËte', '1832', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('region', '1833', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('regionem', '1834', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('regionu', '1835', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('smoke', '1836', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tlaËÌtko', '1837', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('toù', '1838', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('trochu', '1839', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('trs04', '1840', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tv·¯Ì', '1841', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('t¯eba', '1842', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('velk˝mi', '1843', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vezme', '1844', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vytvo¯Ì', '1845', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vyzkouöel', '1846', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('v·m', '1847', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vöe', '1848', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zaloûit', '1849', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zatÌm', '1850', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zaË·teËnÌky', '1851', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zmÏna', '1852', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zruö', '1853', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zvl·ötÏ', '1854', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('z·vislost', '1855', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('¯adu', '2389', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('¯ada', '2388', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('˙spÏchem', '2387', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zp˘sobem', '2386', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zemÌ', '2385', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zaËÌt', '2384', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zapojen˝ch', '2383', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('x51', '2382', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('v·noce', '2381', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vrhl', '2380', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vidÌte', '2379', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('velikosti', '2378', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('velice', '2377', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tÌmto', '2376', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tÈ', '2375', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tzn', '2374', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tyto', '2373', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tudÌû', '2372', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tn12def', '2371', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('temp', '2370', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tedy', '2369', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tato', '2368', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('taj', '2367', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('spÌn·nÌ', '2366', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('spÌnat', '2365', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('spÌnajÌ', '2364', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('spolehliv˝', '2363', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('splaöit', '2362', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('souË·stek', '2361', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('soic', '2360', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('sloûÌte', '2359', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('skvÏle', '2358', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ser', '2357', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ruöenÌ', '2356', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('rozloûenÌ', '2355', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('rjmp', '2354', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('r20', '2353', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('r19', '2352', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('r18', '2351', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('r17', '2350', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('r16', '2349', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p˘vodnÏ', '2348', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯Ìmo', '2347', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('proË', '2346', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('proudy', '2345', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('propojka', '2344', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('program·tor', '2343', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('programovacÌ', '2342', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('program', '2341', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pred', '2340', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pozn', '2339', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pouûÌvat', '2338', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pouûit', '2337', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pouzd¯e', '2336', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('portb', '2335', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('porroûe', '2334', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('poc', '2333', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pin˘', '2332', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pic', '2331', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('periferiÌ', '2330', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('out', '2329', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('osvedËily', '2328', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('osccal', '2327', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('oproti', '2326', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('odpad·', '2325', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('odboËka', '2324', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('obsluhu', '2323', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('noûiËek', '2322', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nolist', '2321', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nic', '2320', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nezapomÏl', '2319', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nevych·zÌ', '2318', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('neomezen·', '2317', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nejakou', '2316', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nedok·zal', '2315', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nech·pal', '2314', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('necelou', '2313', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nebude', '2312', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nap·jenÌ', '2311', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('naprogramovat', '2310', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('moûnÈ', '2309', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mohou', '2308', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mnoho', '2307', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mnohem', '2306', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mluvÌm', '2305', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mikroprocesor˘', '2304', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mikroprocesory', '2303', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mcu', '2302', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('max', '2301', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('log1', '2300', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('log0', '2299', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('list', '2298', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('libovolnÈ', '2297', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('levn˝', '2296', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('letoönÌ', '2295', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ldi', '2294', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kv˘li', '2293', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ovöem', '1956', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ktre·', '2292', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('konektory', '2291', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kondÌk', '2290', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('klasickÈm', '2289', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kaûd˝', '2288', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jedn·', '2287', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jednu', '2286', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jednoduch·', '2285', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('internÌch', '2284', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('include', '2283', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('inc', '2282', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('procesorem', '1968', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('i', '2281', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hc8', '2280', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hc7', '2279', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hc6', '2278', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hc5', '2277', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hc4', '2276', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hc3', '2275', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hc2', '2274', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hc1', '2273', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('gunkce', '2272', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('equ', '2271', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('d˘vodu', '2270', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dÏlat', '2269', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dÏlalo', '2268', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dost', '2267', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dok·ûou', '2266', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('doin', '2265', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('diody', '2264', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('desÌtek', '2263', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('def', '2262', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dec', '2261', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ddrb', '2260', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dajÌ', '2259', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('cseg', '2258', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('cpi', '2257', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('clr', '2256', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('chctÏl', '2255', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ce3', '2254', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ce2', '2253', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ce1', '2252', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('b·t', '2251', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tomu', '2000', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('byli', '2250', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('br·nu', '2249', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('brne', '2248', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('breq', '2247', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('bokem', '2246', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('blikaËi', '2245', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('barvy', '2244', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('avr', '2243', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('attiny12', '2242', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('atmel', '2241', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('aplikaci', '2240', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('algoritmy', '2239', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('abych', '2238', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('30', '2237', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('29', '2236', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('27', '2235', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('26kË', '2234', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('16fxx', '2233', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('1206', '2232', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('23', '2231', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('15', '2230', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('bduh', '2022', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dotaz', '2023', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('galerie', '2024', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hodit', '2025', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kdybych', '2026', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('m·m', '2027', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nÏj', '2028', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nÏkde', '2029', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('odkaz', '2030', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('odkl·dacÌ', '2031', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('odtud', '2032', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('prostor', '2033', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('str·nk·ch', '2034', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('trainzu', '2035', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('uloûit', '2036', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vloûit', '2037', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zaËal', '2228', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vÏ¯Ìm', '2227', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('v˝tvor', '2226', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('v˝sledek', '2225', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('v˝konovÏ', '2224', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vymÏnit', '2223', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('t¯eù·ku', '2222', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('t˝dnem', '2221', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tÈmatu', '2220', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('spÌö', '2219', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('souË·stkama', '2218', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('skÏl˝', '2217', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('procesor', '2216', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('prnÌ', '2215', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('poËÌt·m', '2214', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('postavil', '2213', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pop¯ÌpadÏ', '2212', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯ÌötÌ', '2056', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('neodva¯il', '2211', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nemÏl', '2210', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('m˘j', '2209', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('takûe', '2060', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('toho', '2061', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jÛ', '2208', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('t˝den', '2063', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('funguje', '2207', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('fungoval', '2206', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('d·m', '2205', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('druh·ku', '2204', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('doËinÏnÌ', '2203', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dokud', '2202', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('br·cha', '2201', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('aû', '2200', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('attinou', '2199', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('d·t', '2073', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kde', '2074', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('moûn·', '2075', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('m˘ûeö', '2076', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nesmaûe', '2077', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nikdo', '2078', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pras·rny', '2079', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('skusÌm', '2080', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('svoje', '2081', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vlastnosti', '2082', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vyuûÌvat', '2083', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vyuûÌv·m', '2084', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zkopÌrovat', '2085', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('aktualizovan·', '2086', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('animacÌ', '2087', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('automaticky', '2088', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('bez', '2089', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('by', '2090', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('chvÌly', '2091', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('chybnÏ', '2092', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('coû', '2093', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('czech', '2094', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('datab·ze', '2095', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('druh·', '2096', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dÏkuji', '2097', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('dÏlan·', '2098', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('efektem', '2099', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('funkci', '2100', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('funkËnost', '2101', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('hodnot', '2102', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jednÈ', '2103', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jin·Ë', '2104', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jinÈ', '2105', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('jsu', '2106', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('klapneö', '2107', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kouk·m', '2108', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kou¯ov˝m', '2109', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('kromÏ', '2110', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('levÈm', '2111', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('maöiny', '2112', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('menu', '2113', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mnohdy', '2114', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mohlo', '2115', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('moûnostÌ', '2116', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mÛdem', '2117', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mÏla', '2118', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('mÏlo', '2119', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nabÌdky', '2120', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('najÌt', '2121', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nalezenÈ', '2122', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('napiö', '2123', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('napsanÈ', '2124', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('napsat', '2125', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('napÌöu', '2126', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nebere', '2127', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nejspÌö', '2128', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nem˘ûeme', '2129', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nem˘ûu', '2130', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('neobjevÌm', '2131', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('netuöÌm', '2132', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nevytvo¯Ì', '2133', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nigh', '2134', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('novÈhu', '2135', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('nÏ', '2136', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('obejktu', '2137', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('objektech', '2138', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('objekty', '2139', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('objevÌ', '2140', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('ochrana', '2141', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('oprava', '2142', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('opravdu', '2143', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('opravit', '2144', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('opravÌ', '2145', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('otestov·nÌ', '2146', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('parametr˘m', '2147', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pobrala', '2148', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('podrobnÏji', '2149', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('poloûka', '2150', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('porozumÏnÌ', '2151', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pozn·mkou', '2152', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pracuje', '2153', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pravda', '2154', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('problÈmu', '2155', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('programu', '2156', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('prosÌm', '2157', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('pÌsmena', '2158', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯esnÏ', '2159', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯eveÔ', '2160', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯eËetlo', '2161', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯id·', '2162', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯in·öÌ', '2163', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('p¯Ìkazem', '2164', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('republic', '2165', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('s', '2166', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('scenery', '2167', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('spr·vnou', '2168', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('statick˝ch', '2169', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('sv·zanÈ', '2170', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('sv·z·na', '2171', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('s·m', '2172', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('testovan˝', '2173', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('testov·nÌ', '2174', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tuto', '2175', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tÈhle', '2176', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('tÏchto', '2177', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('t¯i', '2178', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('t¯Ì', '2179', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('upozornÏnÌ', '2180', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('uûitek', '2181', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vagÛny', '2182', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('velkÈ', '2183', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vyd·', '2184', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vyplnÌ', '2185', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vyplÚovalo', '2186', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vz·jemnÏ', '2187', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vÏc', '2188', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('vöiml', '2189', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zad·nÌ', '2190', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zaruËit', '2191', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zeptat', '2192', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zhruba', '2193', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zjednoduöenÌ', '2194', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('zrovna', '2195', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('z˘stat', '2196', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('Ëasem', '2197', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('Ëili', '2198', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('z·b˝vat', '2229', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('¯ady', '2390', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('¯adÏ', '2391', '0');
INSERT INTO ftfbb_search_wordlist (word_text, word_id, word_common) VALUES('¯Ìzen˝', '2392', '0');
#
# TABLE: ftfbb_search_wordmatch
#
DROP TABLE IF EXISTS ftfbb_search_wordmatch;
CREATE TABLE ftfbb_search_wordmatch(
	post_id mediumint(8) unsigned NOT NULL,
	word_id mediumint(8) unsigned NOT NULL,
	title_match tinyint(1) NOT NULL, 
	KEY post_id (post_id), 
	KEY word_id (word_id)
);

#
# Table Data for ftfbb_search_wordmatch
#

INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '515', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '505', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '480', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '542', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '472', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '473', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '474', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '475', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '476', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '477', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '478', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '479', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '481', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '482', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '483', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '484', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '485', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '486', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '487', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '488', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '489', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '490', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '491', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '492', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '493', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '494', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '495', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '496', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '497', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '498', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '499', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '500', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '501', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '502', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '503', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '504', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '506', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '508', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '507', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '509', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '510', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '511', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '512', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '513', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '514', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '516', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '517', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '518', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '519', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '520', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '521', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '522', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '523', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '525', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '524', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '526', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '527', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '528', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '529', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '530', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '531', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '532', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '533', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '534', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '535', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '536', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '537', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '538', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '539', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '540', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('24', '541', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '543', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '544', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '545', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '546', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '547', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '548', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '550', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '551', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '552', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '534', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '555', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '549', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '553', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('25', '554', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '567', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '568', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '569', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '570', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '571', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '572', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '573', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '574', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '575', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '576', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '577', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '508', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '514', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '534', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '567', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('26', '568', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('27', '578', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('27', '579', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('27', '580', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('27', '583', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('27', '584', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('27', '585', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('27', '586', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('27', '587', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('27', '581', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('27', '582', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('27', '585', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '580', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '577', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '549', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '22', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '904', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '894', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '868', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '865', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '848', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '849', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '850', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '851', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '852', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '853', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '854', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '855', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '856', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '857', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '858', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '859', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '860', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '861', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '862', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '863', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '864', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '866', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '867', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '869', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '870', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '871', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '872', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '873', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '874', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '875', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '876', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '877', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '878', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '879', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '880', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '881', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '882', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '883', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '884', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '885', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '886', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '887', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '888', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '889', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '890', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '891', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '892', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '893', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '895', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '896', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '897', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '898', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '899', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '900', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '901', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '902', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '903', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '905', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '906', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '907', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '908', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '909', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '910', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '911', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '912', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '913', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '914', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '915', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '916', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '917', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '918', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '919', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '920', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '921', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '922', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '923', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '924', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '925', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '926', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '927', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '928', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '929', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '930', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '931', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '932', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '494', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '507', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '526', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('28', '22', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '920', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '858', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '933', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '934', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '935', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '936', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '937', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '939', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '940', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '941', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '942', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '943', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '944', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '945', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '946', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '947', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '948', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '949', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '950', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '951', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '952', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '953', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '954', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '955', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '956', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '936', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '938', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '941', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '942', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('29', '945', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('30', '957', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('30', '544', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('30', '958', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('30', '959', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('30', '960', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('30', '894', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('30', '961', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('30', '962', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('31', '979', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('31', '978', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('31', '977', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('31', '976', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('31', '975', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('31', '974', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('31', '973', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('31', '972', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('31', '543', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('31', '971', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('31', '534', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '980', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '981', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '982', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '983', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '879', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '984', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '985', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '986', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '987', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '988', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '989', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '901', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '990', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '991', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '577', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '992', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('32', '993', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '1022', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '1021', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '1020', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '1019', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '1018', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '1017', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '1016', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '1015', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '1014', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '993', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '992', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '991', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '990', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '989', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '988', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '987', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '986', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '985', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '984', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '983', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '982', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '981', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '980', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '957', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '848', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '879', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '901', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '918', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '577', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '487', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('33', '1023', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('34', '1024', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('34', '1025', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('34', '1026', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('34', '578', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('34', '1027', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('34', '1028', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('34', '883', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('34', '1029', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('34', '1030', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('34', '577', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('34', '1031', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1040', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1488', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1487', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1486', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1485', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1484', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1483', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1482', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1481', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1480', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1479', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1478', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1477', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1476', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1335', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1336', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1337', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1338', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1339', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1340', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1341', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1342', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1343', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1344', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1345', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1346', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1347', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1348', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1349', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1350', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1351', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1352', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1353', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1354', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1355', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1356', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1357', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1358', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1359', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1360', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1361', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1362', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1363', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1364', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1366', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1367', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1368', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1369', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1370', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1153', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1371', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1372', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1373', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1374', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1375', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1376', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1377', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1378', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1379', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1380', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1381', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1382', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1383', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1135', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1384', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1385', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1386', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1387', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1388', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1389', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1390', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1391', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1392', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1393', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1394', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1395', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1396', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1397', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1398', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1399', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1400', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1401', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1402', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1403', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1404', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1405', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1406', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1407', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1408', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1409', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1410', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1411', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1412', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1413', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1414', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1415', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1416', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1417', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1418', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1419', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1420', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1421', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1422', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1423', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1424', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1425', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1426', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1427', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1428', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1429', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1430', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1431', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1432', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1433', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1434', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1435', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1436', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1437', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1438', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1439', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1440', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1441', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1442', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1443', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1444', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1445', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1446', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1447', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1448', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1449', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1450', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1451', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1452', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1453', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1454', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1455', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1456', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1457', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1458', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1459', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1460', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1461', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1462', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1463', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1464', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1465', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1466', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1467', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1040', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1468', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1469', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1470', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1471', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1472', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1473', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1474', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1016', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '957', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '848', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '855', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '868', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '872', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '882', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '884', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '885', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '890', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '898', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '918', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '549', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '487', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '489', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '493', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '502', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '540', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1365', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1135', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1153', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('35', '1475', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1554', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1599', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1674', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1588', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1496', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1655', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1656', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1657', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1658', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1659', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1660', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1661', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1662', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1663', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1664', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1665', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1666', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1667', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1668', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1669', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1670', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1671', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1588', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1673', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1554', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1672', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1675', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1676', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1677', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1678', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1679', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1680', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1681', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1682', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1599', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1683', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1684', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1685', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1686', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1687', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1688', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1689', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1690', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1691', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1692', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1693', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1694', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1695', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1696', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1697', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1698', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1699', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1700', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1701', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1702', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1703', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1704', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1705', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1706', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1707', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1708', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1709', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1710', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1711', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1712', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1713', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1714', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1715', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1716', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1717', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1718', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1719', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1720', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1721', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1722', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1723', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1724', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1725', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1726', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1727', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1496', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1728', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1729', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1730', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1731', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1732', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1733', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1734', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1361', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1373', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1377', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1387', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1392', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1401', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1443', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1447', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1463', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1466', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1472', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '1026', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '990', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '950', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '946', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '855', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '868', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '869', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '882', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '883', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '885', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '901', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '918', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '919', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '930', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '583', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '580', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '579', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '545', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '487', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '490', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '492', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '494', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('36', '534', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '487', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '545', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '549', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '918', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '868', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '861', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '855', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '961', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '990', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1016', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1441', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1434', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1373', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1153', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1341', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1479', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1735', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1736', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1737', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1738', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1739', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1740', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1741', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1742', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1743', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1744', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1745', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1746', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1747', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1748', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1749', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1750', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1751', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1752', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1753', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1754', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1755', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1756', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1757', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1758', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1759', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1760', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1761', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1762', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1763', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1764', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1765', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1766', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1767', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1768', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1769', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1770', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1771', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1772', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1773', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('37', '1774', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '540', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '508', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '502', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '491', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '490', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '487', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '485', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '549', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '555', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '919', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '888', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '873', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '867', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '858', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '933', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '934', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '936', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '941', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '943', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '945', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '952', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '961', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '972', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '990', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1016', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1023', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1463', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1443', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1394', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1392', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1376', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1373', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1341', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1750', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1766', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1775', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1776', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1777', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1778', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1779', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1780', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1781', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1782', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1783', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1784', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1785', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1786', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1787', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1788', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1789', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1790', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1791', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1792', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1793', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1794', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1795', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1796', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1797', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1798', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1799', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1800', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1801', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1802', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1803', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1804', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1805', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1806', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1807', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1808', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1809', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1810', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1811', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1812', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1813', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1814', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1815', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1816', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1817', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1818', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1819', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1820', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1821', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1822', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1823', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1824', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1825', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1826', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1827', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1828', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1829', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1830', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1831', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1832', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1833', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1834', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1835', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1836', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1837', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1838', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1839', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1840', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1841', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1842', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1843', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1844', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1845', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1846', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1847', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1848', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1849', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1850', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1851', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1852', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1853', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1854', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('38', '1855', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1153', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1968', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1040', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2242', '1');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2391', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2390', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2230', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2231', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2232', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2233', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2234', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2235', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2236', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2237', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2238', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2239', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2240', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2241', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2242', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2243', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2244', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2245', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2246', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2247', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2248', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2249', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2250', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2000', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2251', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2252', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2253', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2254', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2255', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2256', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2257', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2258', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2259', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2260', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2261', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2262', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2263', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2264', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2265', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2266', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2267', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2268', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2269', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2270', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2271', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2272', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2273', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2274', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2275', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2276', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2277', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2278', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2279', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2280', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2281', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2282', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2283', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2284', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2285', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2286', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2287', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2288', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2289', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2290', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2291', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2292', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1956', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2293', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2294', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2295', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2296', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2297', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2298', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2299', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2300', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2301', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2302', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2303', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2304', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2305', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2306', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2307', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2308', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2309', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2310', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2311', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2312', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2313', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2314', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2315', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2316', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2317', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2318', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2319', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2320', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2321', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2322', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2323', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2324', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2325', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2326', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2327', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2328', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2329', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2330', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2331', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2332', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2333', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2334', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2335', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2336', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2337', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2338', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2339', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2340', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2341', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2342', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2343', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2344', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2345', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2346', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2347', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2348', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2349', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2350', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2351', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2352', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2353', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2354', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2355', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2356', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2357', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2358', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2359', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2360', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2361', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2362', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2363', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2364', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2365', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2366', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2367', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2368', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2369', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2370', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2371', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2372', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2373', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2374', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2375', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2376', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2377', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2378', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2379', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2380', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2381', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2382', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2383', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2384', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2385', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2386', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2387', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2388', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2389', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1847', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1813', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1796', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1776', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1771', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1750', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1735', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1704', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1710', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1714', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1480', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1479', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1153', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1371', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1373', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1376', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1384', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1386', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1391', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1392', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1408', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1434', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1453', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1463', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1027', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '1016', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '991', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '990', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '973', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '944', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '848', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '868', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '872', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '919', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '587', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '580', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '578', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '549', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '545', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '475', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '486', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '487', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '489', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '534', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '540', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2022', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '474', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2023', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2024', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2025', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '485', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2026', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '491', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2027', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '976', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '1750', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2028', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2029', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '890', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '946', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2030', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2031', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2032', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '549', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2033', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '990', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2034', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '1463', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '961', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2035', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '550', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '1842', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2036', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '2037', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('40', '1031', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '540', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2229', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2228', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '978', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2227', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2226', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2225', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2224', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2223', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '1716', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2222', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2221', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2063', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '520', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2220', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '587', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2061', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '1466', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2060', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2219', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2218', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '1457', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '1153', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2217', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2056', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '901', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '1968', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2216', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2215', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2214', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2213', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2212', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '1814', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2211', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2210', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2209', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '491', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2208', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '1740', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '487', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '1373', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2207', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2206', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '571', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2205', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2204', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2203', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2202', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '1736', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '855', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2201', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '1343', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '1040', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2200', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('41', '2199', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '971', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '1778', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '935', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '473', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '474', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2073', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '480', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2024', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '1789', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '872', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '1740', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2074', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '1792', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '974', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '1682', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2075', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2076', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '495', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2077', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2078', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2028', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '985', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '946', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2030', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2031', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '1956', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '502', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '548', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2079', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2033', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2056', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2080', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '911', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2034', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2081', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '1463', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '1466', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2061', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2063', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2036', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '918', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2082', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2037', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2083', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2084', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '1850', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '534', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '2085', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('42', '555', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '22', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '540', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '534', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '508', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '498', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '491', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '487', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '549', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '577', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '927', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '918', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '912', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '873', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '868', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '867', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '858', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '848', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '934', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '941', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '943', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '948', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '961', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '974', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '971', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '990', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '991', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1016', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1017', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1025', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1466', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1463', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1443', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1434', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1392', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1387', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1382', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1376', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1373', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1361', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1341', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1740', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1745', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1766', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1775', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1779', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1781', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1782', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1787', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1789', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1793', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1808', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1816', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1824', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1827', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1833', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1835', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1837', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '1850', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2000', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2060', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2061', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2074', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2086', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2087', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2088', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2089', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2090', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2091', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2092', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2093', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2094', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2095', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2096', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2097', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2098', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2099', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2100', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2101', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2102', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2103', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2104', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2105', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2106', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2107', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2108', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2109', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2110', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2111', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2112', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2113', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2114', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2115', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2116', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2117', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2118', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2119', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2120', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2121', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2122', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2123', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2124', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2125', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2126', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2127', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2128', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2129', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2130', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2131', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2132', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2133', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2134', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2135', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2136', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2137', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2138', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2139', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2140', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2141', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2142', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2143', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2144', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2145', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2146', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2147', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2148', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2149', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2150', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2151', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2152', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2153', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2154', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2155', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2156', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2157', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2158', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2159', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2160', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2161', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2162', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2163', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2164', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2165', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2166', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2167', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2168', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2169', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2170', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2171', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2172', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2173', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2174', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2175', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2176', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2177', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2178', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2179', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2180', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2181', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2182', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2183', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2184', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2185', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2186', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2187', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2188', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2189', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2190', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2191', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2192', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2193', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2194', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2195', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2196', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2197', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('43', '2198', '0');
INSERT INTO ftfbb_search_wordmatch (post_id, word_id, title_match) VALUES('39', '2392', '1');
#
# TABLE: ftfbb_sessions
#
DROP TABLE IF EXISTS ftfbb_sessions;
CREATE TABLE ftfbb_sessions(
	session_id char(32) NOT NULL,
	session_user_id mediumint(8) NOT NULL,
	session_start int(11) NOT NULL,
	session_time int(11) NOT NULL,
	session_ip char(8) NOT NULL,
	session_page int(11) NOT NULL,
	session_logged_in tinyint(1) NOT NULL,
	session_admin tinyint(2) NOT NULL, 
	PRIMARY KEY (session_id), 
	KEY session_user_id (session_user_id), 
	KEY session_id_ip_user_id (session_id, session_ip, session_user_id)
);

#
# Table Data for ftfbb_sessions
#

INSERT INTO ftfbb_sessions (session_id, session_user_id, session_start, session_time, session_ip, session_page, session_logged_in, session_admin) VALUES('0dba049421f8b9cf519a8eae6ae89179', '2', '1174394128', '1174395228', '504e92f5', '0', '1', '1');
#
# TABLE: ftfbb_smilies
#
DROP TABLE IF EXISTS ftfbb_smilies;
CREATE TABLE ftfbb_smilies(
	smilies_id smallint(5) unsigned NOT NULL auto_increment,
	code varchar(50),
	smile_url varchar(100),
	emoticon varchar(75), 
	PRIMARY KEY (smilies_id)
);

#
# Table Data for ftfbb_smilies
#

INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('1', ':D', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('2', ':-D', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('3', ':grin:', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('4', ':)', 'icon_smile.gif', 'Smile');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('5', ':-)', 'icon_smile.gif', 'Smile');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('6', ':smile:', 'icon_smile.gif', 'Smile');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('7', ':(', 'icon_sad.gif', 'Sad');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('8', ':-(', 'icon_sad.gif', 'Sad');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('9', ':sad:', 'icon_sad.gif', 'Sad');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('10', ':o', 'icon_surprised.gif', 'Surprised');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('11', ':-o', 'icon_surprised.gif', 'Surprised');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('12', ':eek:', 'icon_surprised.gif', 'Surprised');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('13', ':shock:', 'icon_eek.gif', 'Shocked');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('14', ':?', 'icon_confused.gif', 'Confused');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('15', ':-?', 'icon_confused.gif', 'Confused');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('16', ':???:', 'icon_confused.gif', 'Confused');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('17', '8)', 'icon_cool.gif', 'Cool');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('18', '8-)', 'icon_cool.gif', 'Cool');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('19', ':cool:', 'icon_cool.gif', 'Cool');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('20', ':lol:', 'icon_lol.gif', 'Laughing');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('21', ':x', 'icon_mad.gif', 'Mad');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('22', ':-x', 'icon_mad.gif', 'Mad');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('23', ':mad:', 'icon_mad.gif', 'Mad');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('24', ':P', 'icon_razz.gif', 'Razz');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('25', ':-P', 'icon_razz.gif', 'Razz');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('26', ':razz:', 'icon_razz.gif', 'Razz');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('27', ':oops:', 'icon_redface.gif', 'Embarassed');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('28', ':cry:', 'icon_cry.gif', 'Crying or Very sad');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('29', ':evil:', 'icon_evil.gif', 'Evil or Very Mad');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('30', ':twisted:', 'icon_twisted.gif', 'Twisted Evil');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('31', ':roll:', 'icon_rolleyes.gif', 'Rolling Eyes');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('32', ':wink:', 'icon_wink.gif', 'Wink');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('33', ';)', 'icon_wink.gif', 'Wink');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('34', ';-)', 'icon_wink.gif', 'Wink');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('35', ':!:', 'icon_exclaim.gif', 'Exclamation');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('36', ':?:', 'icon_question.gif', 'Question');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('37', ':idea:', 'icon_idea.gif', 'Idea');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('38', ':arrow:', 'icon_arrow.gif', 'Arrow');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('39', ':|', 'icon_neutral.gif', 'Neutral');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('40', ':-|', 'icon_neutral.gif', 'Neutral');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('41', ':neutral:', 'icon_neutral.gif', 'Neutral');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('84', ':mrgreen:', 'icon_mrgreen.gif', 'mrgreen');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('43', ':chcani:', 'icon_wc.gif', 'ChcanÌ');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('44', ':zima:', 'icon_zima012.gif', 'V zimÏ');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('45', ':znicenipc:', 'icon_pc007.gif', 'ZniËenÌ PC');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('46', ':znicenipc2:', 'icon_pc008.gif', 'ZniËenÌ PC 2');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('47', ':veskole:', 'icon_skola009.gif', 'Ve ökole');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('48', ':chcani2:', 'icon_wc001.gif', 'ChcanÌ 2');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('49', ':kyvajici:', 'icon_041.gif', 'K˝vajÌcÌ');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('50', ':tocici:', 'icon_020.gif', 'ToËÌcÌ');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('51', ':cumici:', 'icon_025.gif', '»umÌcÌ');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('52', ':otacejici:', 'icon_030.gif', 'Ot·ËejÌcÌ');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('53', ':sprostarna:', 'icon_kurba.gif', 'Sprosù·rna');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('54', ':nudicise:', 'icon_069.gif', 'NudÌcÌ se');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('55', ':vybuchujici:', 'icon_073.gif', 'VybuchujÌcÌ');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('56', ':kresleni:', 'icon_doprace006.gif', 'KreslenÌ');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('57', '=D&gt;', 'eusa_clap.gif', 'Applause');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('58', '#-o', 'eusa_doh.gif', 'd\'oh!');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('59', '=P~', 'eusa_drool.gif', 'Drool');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('60', ':^o', 'eusa_liar.gif', 'Liar');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('61', ':---)', 'eusa_liar.gif', 'Liar');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('62', '[-X', 'eusa_naughty.gif', 'Shame on you');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('63', '[-o&lt;', 'eusa_pray.gif', 'Pray');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('64', '8-[', 'eusa_shifty.gif', 'Anxious');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('65', '[-(', 'eusa_snooty.gif', 'Not talking');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('66', ':-k', 'eusa_think.gif', 'Think');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('67', '](*,)', 'eusa_wall.gif', 'Brick wall');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('68', ':-\"', 'eusa_whistle.gif', 'Whistle');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('69', 'O:)', 'eusa_angel.gif', 'Angel');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('70', '=;', 'eusa_hand.gif', 'Speak to the hand');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('71', ':-&', 'eusa_sick.gif', 'Sick');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('72', ':-({|=', 'eusa_boohoo.gif', 'Boo hoo!');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('73', ':-$', 'eusa_shhh.gif', 'Shhh');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('74', ':-s', 'eusa_eh.gif', 'Eh?');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('75', '\\:D/', 'eusa_dance.gif', 'Dancing');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('76', ':-#', 'eusa_silenced.gif', 'Silenced');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('77', ':XXarcade:', 'XXarcade.gif', 'XXarcade');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('78', ':XXcombustion:', 'XXcombustion.gif', 'XXcombustion');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('79', ':XXcomputer:', 'XXcomputer.gif', 'XXcomputer');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('80', ':XXsmoker:', 'XXsmoker.gif', 'XXsmoker');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('81', ':new_newbie:', 'new_newbie.gif', 'new_newbie');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('82', ':pottytrain1:', 'pottytrain1.gif', 'pottytrain1');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('83', ':pottytrain2:', 'pottytrain2.gif', 'pottytrain2');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('85', ':dark1:', 'dark1.gif', 'dark1');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('86', ':boxing:', 'boxing.gif', 'boxing');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('87', ':bootyshake:', 'bootyshake.gif', 'bootyshake');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('88', ':bduh:', 'bduh.gif', 'bduh');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('89', ':angry9:', 'angry9.gif', 'angry9');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('90', ':5obsessed:', '5obsessed.gif', '5obsessed');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('91', ':lame:', 'lame.gif', 'lame');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('92', ':bye:', 'bye.gif', 'bye');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('93', ':help:', 'help.gif', 'help');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('130', ':bs_help:', 'bs_help.gif', 'bs_help');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('131', ':bs_offtopic:', 'bs_offtopic.gif', 'bs_offtopic');
INSERT INTO ftfbb_smilies (smilies_id, code, smile_url, emoticon) VALUES('132', ':bs_quesexclaim:', 'bs_quesexclaim.gif', 'bs_quesexclaim');
#
# TABLE: ftfbb_themes
#
DROP TABLE IF EXISTS ftfbb_themes;
CREATE TABLE ftfbb_themes(
	themes_id mediumint(8) unsigned NOT NULL auto_increment,
	template_name varchar(30) NOT NULL,
	style_name varchar(30) NOT NULL,
	head_stylesheet varchar(100),
	body_background varchar(100),
	body_bgcolor varchar(6),
	body_text varchar(6),
	body_link varchar(6),
	body_vlink varchar(6),
	body_alink varchar(6),
	body_hlink varchar(6),
	tr_color1 varchar(6),
	tr_color2 varchar(6),
	tr_color3 varchar(6),
	tr_class1 varchar(25),
	tr_class2 varchar(25),
	tr_class3 varchar(25),
	th_color1 varchar(6),
	th_color2 varchar(6),
	th_color3 varchar(6),
	th_class1 varchar(25),
	th_class2 varchar(25),
	th_class3 varchar(25),
	td_color1 varchar(6),
	td_color2 varchar(6),
	td_color3 varchar(6),
	td_class1 varchar(25),
	td_class2 varchar(25),
	td_class3 varchar(25),
	fontface1 varchar(50),
	fontface2 varchar(50),
	fontface3 varchar(50),
	fontsize1 tinyint(4),
	fontsize2 tinyint(4),
	fontsize3 tinyint(4),
	fontcolor1 varchar(6),
	fontcolor2 varchar(6),
	fontcolor3 varchar(6),
	span_class1 varchar(25),
	span_class2 varchar(25),
	span_class3 varchar(25),
	img_size_poll smallint(5) unsigned,
	img_size_privmsg smallint(5) unsigned, 
	PRIMARY KEY (themes_id)
);

#
# Table Data for ftfbb_themes
#

INSERT INTO ftfbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('21', 'Cobalt', 'Fugess - original - styl', 'Cobalt.css', '', 'E5E5E5', '000000', 'A3C8FF', '579AFF', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', '', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Trebuchet MS, Verdana, Arial, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', 'FFFFFF', 'F9A917', '00BF00', '', '', '', '0', '0');
#
# TABLE: ftfbb_themes_name
#
DROP TABLE IF EXISTS ftfbb_themes_name;
CREATE TABLE ftfbb_themes_name(
	themes_id smallint(5) unsigned NOT NULL,
	tr_color1_name char(50),
	tr_color2_name char(50),
	tr_color3_name char(50),
	tr_class1_name char(50),
	tr_class2_name char(50),
	tr_class3_name char(50),
	th_color1_name char(50),
	th_color2_name char(50),
	th_color3_name char(50),
	th_class1_name char(50),
	th_class2_name char(50),
	th_class3_name char(50),
	td_color1_name char(50),
	td_color2_name char(50),
	td_color3_name char(50),
	td_class1_name char(50),
	td_class2_name char(50),
	td_class3_name char(50),
	fontface1_name char(50),
	fontface2_name char(50),
	fontface3_name char(50),
	fontsize1_name char(50),
	fontsize2_name char(50),
	fontsize3_name char(50),
	fontcolor1_name char(50),
	fontcolor2_name char(50),
	fontcolor3_name char(50),
	span_class1_name char(50),
	span_class2_name char(50),
	span_class3_name char(50), 
	PRIMARY KEY (themes_id)
);

#
# Table Data for ftfbb_themes_name
#

INSERT INTO ftfbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('21', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
#
# TABLE: ftfbb_topics
#
DROP TABLE IF EXISTS ftfbb_topics;
CREATE TABLE ftfbb_topics(
	topic_id mediumint(8) unsigned NOT NULL auto_increment,
	forum_id smallint(8) unsigned NOT NULL,
	topic_title char(60) NOT NULL,
	topic_poster mediumint(8) NOT NULL,
	topic_time int(11) NOT NULL,
	topic_views mediumint(8) unsigned NOT NULL,
	topic_replies mediumint(8) unsigned NOT NULL,
	topic_status tinyint(3) NOT NULL,
	topic_vote tinyint(1) NOT NULL,
	topic_type tinyint(3) NOT NULL,
	topic_first_post_id mediumint(8) unsigned NOT NULL,
	topic_last_post_id mediumint(8) unsigned NOT NULL,
	topic_moved_id mediumint(8) unsigned NOT NULL, 
	PRIMARY KEY (topic_id), 
	KEY forum_id (forum_id), 
	KEY topic_moved_id (topic_moved_id), 
	KEY topic_status (topic_status), 
	KEY topic_type (topic_type)
);

#
# Table Data for ftfbb_topics
#

INSERT INTO ftfbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_views, topic_replies, topic_status, topic_vote, topic_type, topic_first_post_id, topic_last_post_id, topic_moved_id) VALUES('13', '8', 'Jak si ozkouöet p¯episovateln˝ text v Gmaxu', '2', '1174217983', '21', '2', '0', '0', '0', '28', '31', '0');
INSERT INTO ftfbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_views, topic_replies, topic_status, topic_vote, topic_type, topic_first_post_id, topic_last_post_id, topic_moved_id) VALUES('9', '3', 'StruËn˝ popis fÛra', '2', '1174136866', '20', '0', '1', '0', '2', '24', '24', '0');
INSERT INTO ftfbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_views, topic_replies, topic_status, topic_vote, topic_type, topic_first_post_id, topic_last_post_id, topic_moved_id) VALUES('12', '7', 'StavÏdlo - Moravsk˝ Krumlov', '2', '1174216367', '5', '0', '0', '0', '0', '27', '27', '0');
INSERT INTO ftfbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_views, topic_replies, topic_status, topic_vote, topic_type, topic_first_post_id, topic_last_post_id, topic_moved_id) VALUES('11', '7', 'T 698.002', '2', '1174215726', '6', '0', '0', '0', '0', '26', '26', '0');
INSERT INTO ftfbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_views, topic_replies, topic_status, topic_vote, topic_type, topic_first_post_id, topic_last_post_id, topic_moved_id) VALUES('10', '4', '⁄vod pro ¯eöenÌ', '2', '1174137555', '11', '2', '0', '0', '0', '25', '42', '0');
INSERT INTO ftfbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_views, topic_replies, topic_status, topic_vote, topic_type, topic_first_post_id, topic_last_post_id, topic_moved_id) VALUES('14', '10', 'Nov˝ Geniv Config Creator (GCC)', '2', '1174221296', '21', '5', '0', '0', '0', '29', '43', '0');
INSERT INTO ftfbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_views, topic_replies, topic_status, topic_vote, topic_type, topic_first_post_id, topic_last_post_id, topic_moved_id) VALUES('15', '1', 'SMD BlikaË - p·jenÌ hork˝m vzduchem', '2', '1174318971', '18', '2', '0', '0', '0', '35', '41', '0');
INSERT INTO ftfbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_views, topic_replies, topic_status, topic_vote, topic_type, topic_first_post_id, topic_last_post_id, topic_moved_id) VALUES('16', '9', 'Destrukce elektrolitickÈho kondenz·toru - foto a video', '2', '1174325210', '6', '0', '0', '0', '0', '36', '36', '0');
INSERT INTO ftfbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_views, topic_replies, topic_status, topic_vote, topic_type, topic_first_post_id, topic_last_post_id, topic_moved_id) VALUES('17', '1', 'SMD blikaË ¯Ìzen˝ procesorem ATtiny12', '3', '1174339724', '12', '0', '0', '0', '0', '39', '39', '0');
#
# TABLE: ftfbb_topics_watch
#
DROP TABLE IF EXISTS ftfbb_topics_watch;
CREATE TABLE ftfbb_topics_watch(
	topic_id mediumint(8) unsigned NOT NULL,
	user_id mediumint(8) NOT NULL,
	notify_status tinyint(1) NOT NULL, 
	KEY topic_id (topic_id), 
	KEY user_id (user_id), 
	KEY notify_status (notify_status)
);

#
# Table Data for ftfbb_topics_watch
#

INSERT INTO ftfbb_topics_watch (topic_id, user_id, notify_status) VALUES('14', '2', '0');
INSERT INTO ftfbb_topics_watch (topic_id, user_id, notify_status) VALUES('9', '2', '0');
INSERT INTO ftfbb_topics_watch (topic_id, user_id, notify_status) VALUES('13', '2', '0');
INSERT INTO ftfbb_topics_watch (topic_id, user_id, notify_status) VALUES('12', '2', '0');
INSERT INTO ftfbb_topics_watch (topic_id, user_id, notify_status) VALUES('11', '2', '0');
INSERT INTO ftfbb_topics_watch (topic_id, user_id, notify_status) VALUES('10', '2', '0');
INSERT INTO ftfbb_topics_watch (topic_id, user_id, notify_status) VALUES('15', '2', '0');
INSERT INTO ftfbb_topics_watch (topic_id, user_id, notify_status) VALUES('16', '2', '0');
INSERT INTO ftfbb_topics_watch (topic_id, user_id, notify_status) VALUES('17', '2', '0');
#
# TABLE: ftfbb_user_group
#
DROP TABLE IF EXISTS ftfbb_user_group;
CREATE TABLE ftfbb_user_group(
	group_id mediumint(8) NOT NULL,
	user_id mediumint(8) NOT NULL,
	user_pending tinyint(1), 
	KEY group_id (group_id), 
	KEY user_id (user_id)
);

#
# Table Data for ftfbb_user_group
#

INSERT INTO ftfbb_user_group (group_id, user_id, user_pending) VALUES('1', '-1', '0');
INSERT INTO ftfbb_user_group (group_id, user_id, user_pending) VALUES('2', '2', '0');
INSERT INTO ftfbb_user_group (group_id, user_id, user_pending) VALUES('3', '3', '0');
INSERT INTO ftfbb_user_group (group_id, user_id, user_pending) VALUES('12', '3', '0');
INSERT INTO ftfbb_user_group (group_id, user_id, user_pending) VALUES('12', '2', '0');
INSERT INTO ftfbb_user_group (group_id, user_id, user_pending) VALUES('9', '4', '0');
INSERT INTO ftfbb_user_group (group_id, user_id, user_pending) VALUES('12', '6', '0');
INSERT INTO ftfbb_user_group (group_id, user_id, user_pending) VALUES('10', '5', '0');
INSERT INTO ftfbb_user_group (group_id, user_id, user_pending) VALUES('11', '6', '0');
#
# TABLE: ftfbb_users
#
DROP TABLE IF EXISTS ftfbb_users;
CREATE TABLE ftfbb_users(
	user_id mediumint(8) NOT NULL,
	user_active tinyint(1) DEFAULT '1',
	username varchar(25) NOT NULL,
	user_password varchar(32) NOT NULL,
	user_session_time int(11) NOT NULL,
	user_session_page smallint(5) NOT NULL,
	user_lastvisit int(11) NOT NULL,
	user_regdate int(11) NOT NULL,
	user_level tinyint(4),
	user_posts mediumint(8) unsigned NOT NULL,
	user_timezone decimal(5,2) DEFAULT '0.00' NOT NULL,
	user_style tinyint(4),
	user_lang varchar(255),
	user_dateformat varchar(14) DEFAULT 'd M Y H:i' NOT NULL,
	user_new_privmsg smallint(5) unsigned NOT NULL,
	user_unread_privmsg smallint(5) unsigned NOT NULL,
	user_last_privmsg int(11) NOT NULL,
	user_login_tries smallint(5) unsigned NOT NULL,
	user_last_login_try int(11) NOT NULL,
	user_emailtime int(11),
	user_viewemail tinyint(1),
	user_attachsig tinyint(1),
	user_allowhtml tinyint(1) DEFAULT '1',
	user_allowbbcode tinyint(1) DEFAULT '1',
	user_allowsmile tinyint(1) DEFAULT '1',
	user_allowavatar tinyint(1) DEFAULT '1' NOT NULL,
	user_allow_pm tinyint(1) DEFAULT '1' NOT NULL,
	user_allow_viewonline tinyint(1) DEFAULT '1' NOT NULL,
	user_notify tinyint(1) DEFAULT '1' NOT NULL,
	user_notify_pm tinyint(1) NOT NULL,
	user_popup_pm tinyint(1) NOT NULL,
	user_rank int(11),
	user_avatar varchar(100),
	user_avatar_type tinyint(4) NOT NULL,
	user_email varchar(255),
	user_icq varchar(15),
	user_website varchar(100),
	user_from varchar(100),
	user_sig text,
	user_sig_bbcode_uid char(10),
	user_aim varchar(255),
	user_yim varchar(255),
	user_msnm varchar(255),
	user_occ varchar(100),
	user_interests varchar(255),
	user_actkey varchar(32),
	user_newpasswd varchar(32), 
	PRIMARY KEY (user_id), 
	KEY user_session_time (user_session_time)
);

#
# Table Data for ftfbb_users
#

INSERT INTO ftfbb_users (user_id, user_active, username, user_password, user_session_time, user_session_page, user_lastvisit, user_regdate, user_level, user_posts, user_timezone, user_style, user_lang, user_dateformat, user_new_privmsg, user_unread_privmsg, user_last_privmsg, user_login_tries, user_last_login_try, user_emailtime, user_viewemail, user_attachsig, user_allowhtml, user_allowbbcode, user_allowsmile, user_allowavatar, user_allow_pm, user_allow_viewonline, user_notify, user_notify_pm, user_popup_pm, user_rank, user_avatar, user_avatar_type, user_email, user_icq, user_website, user_from, user_sig, user_sig_bbcode_uid, user_aim, user_yim, user_msnm, user_occ, user_interests, user_actkey, user_newpasswd) VALUES('-1', '0', 'Anonymous', '', '0', '0', '0', '1173462467', '0', '0', '0.00', NULL, '', '', '0', '0', '0', '0', '0', NULL, '0', '0', '1', '1', '1', '1', '0', '1', '0', '1', '0', NULL, '', '0', '', '', '', '', '', NULL, '', '', '', '', '', '', '');
INSERT INTO ftfbb_users (user_id, user_active, username, user_password, user_session_time, user_session_page, user_lastvisit, user_regdate, user_level, user_posts, user_timezone, user_style, user_lang, user_dateformat, user_new_privmsg, user_unread_privmsg, user_last_privmsg, user_login_tries, user_last_login_try, user_emailtime, user_viewemail, user_attachsig, user_allowhtml, user_allowbbcode, user_allowsmile, user_allowavatar, user_allow_pm, user_allow_viewonline, user_notify, user_notify_pm, user_popup_pm, user_rank, user_avatar, user_avatar_type, user_email, user_icq, user_website, user_from, user_sig, user_sig_bbcode_uid, user_aim, user_yim, user_msnm, user_occ, user_interests, user_actkey, user_newpasswd) VALUES('2', '1', 'Fugess', 'dce96c29a2fc05dc2d5f9d6dc068f620', '1174395228', '0', '1174394051', '1173462467', '1', '28', '1.00', '21', 'czech', 'l, d M, Y G:i', '0', '0', '1174313768', '0', '0', NULL, '0', '1', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '173993982645f1bac093201.gif', '1', 'Fugess.Martin@centrum.cz', '240720819', 'http://fugess.trainz.cz', 'B¯eclav', '»aj', '9339b0757a', '', '', '', 'student SOU Elektromechanik', 'Grafika a 3D Grafika, Elektro', '', '');
INSERT INTO ftfbb_users (user_id, user_active, username, user_password, user_session_time, user_session_page, user_lastvisit, user_regdate, user_level, user_posts, user_timezone, user_style, user_lang, user_dateformat, user_new_privmsg, user_unread_privmsg, user_last_privmsg, user_login_tries, user_last_login_try, user_emailtime, user_viewemail, user_attachsig, user_allowhtml, user_allowbbcode, user_allowsmile, user_allowavatar, user_allow_pm, user_allow_viewonline, user_notify, user_notify_pm, user_popup_pm, user_rank, user_avatar, user_avatar_type, user_email, user_icq, user_website, user_from, user_sig, user_sig_bbcode_uid, user_aim, user_yim, user_msnm, user_occ, user_interests, user_actkey, user_newpasswd) VALUES('3', '1', 'Geniv', 'ab104dd6dcdd335e6c5d88345591cdec', '1174340323', '0', '1174330359', '1173472571', '2', '2', '1.00', '21', 'czech', 'l, j M, Y H:i', '0', '0', '1174337749', '0', '0', NULL, '0', '1', '0', '1', '1', '1', '1', '1', '0', '1', '1', '2', '66767504745fd1b28c06ef.gif', '1', 'geniv@centrum.cz', '312007953', 'http://geniv.wu.cz', 'B¯eclav', 'VeökerÈ aktu·lnÌ programy najdete na m˝ch ofici·lnÌch str·nk·ch.', 'e032e2e761', '', '', '', '', 'Programming, roller blades, PC, railway, network aj...', '', NULL);
INSERT INTO ftfbb_users (user_id, user_active, username, user_password, user_session_time, user_session_page, user_lastvisit, user_regdate, user_level, user_posts, user_timezone, user_style, user_lang, user_dateformat, user_new_privmsg, user_unread_privmsg, user_last_privmsg, user_login_tries, user_last_login_try, user_emailtime, user_viewemail, user_attachsig, user_allowhtml, user_allowbbcode, user_allowsmile, user_allowavatar, user_allow_pm, user_allow_viewonline, user_notify, user_notify_pm, user_popup_pm, user_rank, user_avatar, user_avatar_type, user_email, user_icq, user_website, user_from, user_sig, user_sig_bbcode_uid, user_aim, user_yim, user_msnm, user_occ, user_interests, user_actkey, user_newpasswd) VALUES('5', '1', 'liberk', '786bf06e836205070a238e57f236efe6', '1174385815', '-1', '1174340371', '1174240827', '0', '5', '1.00', '21', 'czech', 'l, d M, Y G:i', '0', '0', '0', '0', '0', NULL, '0', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', '0', '18921821245fd84f8644c4.jpg', '1', 'liberk@volny.cz', '', '', 'Brno', 'TRS2004 ver. 2.4 (build 2367) + SP4 CZ', '8d4a6894e2', '', '', '', '', '', '', NULL);
INSERT INTO ftfbb_users (user_id, user_active, username, user_password, user_session_time, user_session_page, user_lastvisit, user_regdate, user_level, user_posts, user_timezone, user_style, user_lang, user_dateformat, user_new_privmsg, user_unread_privmsg, user_last_privmsg, user_login_tries, user_last_login_try, user_emailtime, user_viewemail, user_attachsig, user_allowhtml, user_allowbbcode, user_allowsmile, user_allowavatar, user_allow_pm, user_allow_viewonline, user_notify, user_notify_pm, user_popup_pm, user_rank, user_avatar, user_avatar_type, user_email, user_icq, user_website, user_from, user_sig, user_sig_bbcode_uid, user_aim, user_yim, user_msnm, user_occ, user_interests, user_actkey, user_newpasswd) VALUES('4', '1', 'jahome', '655faa8ba799a3a1ae309c2b40d142fc', '1174233458', '10', '1174233397', '1174233347', '0', '0', '1.00', '21', 'czech', 'l, d M, Y G:i', '0', '0', '0', '0', '0', NULL, '0', '1', '0', '1', '1', '1', '1', '1', '0', '1', '1', '0', '', '0', 'jahome@centrum.sk', '', '', '', '', '', '', '', '', '', '', '', NULL);
INSERT INTO ftfbb_users (user_id, user_active, username, user_password, user_session_time, user_session_page, user_lastvisit, user_regdate, user_level, user_posts, user_timezone, user_style, user_lang, user_dateformat, user_new_privmsg, user_unread_privmsg, user_last_privmsg, user_login_tries, user_last_login_try, user_emailtime, user_viewemail, user_attachsig, user_allowhtml, user_allowbbcode, user_allowsmile, user_allowavatar, user_allow_pm, user_allow_viewonline, user_notify, user_notify_pm, user_popup_pm, user_rank, user_avatar, user_avatar_type, user_email, user_icq, user_website, user_from, user_sig, user_sig_bbcode_uid, user_aim, user_yim, user_msnm, user_occ, user_interests, user_actkey, user_newpasswd) VALUES('6', '1', 'Johny.JB', '75c235ce06ab0fc88711c184be27ae99', '1174332124', '0', '1174332124', '1174330709', '0', '0', '1.00', '21', 'czech', 'l, d M, Y G:i', '0', '0', '0', '0', '0', NULL, '0', '1', '0', '1', '1', '1', '1', '1', '0', '1', '1', '9', '', '0', 'Geo.Bar@atlas.cz', '', '', '', '', '', '', '', '', '', '', '', NULL);
#
# TABLE: ftfbb_vote_desc
#
DROP TABLE IF EXISTS ftfbb_vote_desc;
CREATE TABLE ftfbb_vote_desc(
	vote_id mediumint(8) unsigned NOT NULL auto_increment,
	topic_id mediumint(8) unsigned NOT NULL,
	vote_text text NOT NULL,
	vote_start int(11) NOT NULL,
	vote_length int(11) NOT NULL, 
	PRIMARY KEY (vote_id), 
	KEY topic_id (topic_id)
);
#
# TABLE: ftfbb_vote_results
#
DROP TABLE IF EXISTS ftfbb_vote_results;
CREATE TABLE ftfbb_vote_results(
	vote_id mediumint(8) unsigned NOT NULL,
	vote_option_id tinyint(4) unsigned NOT NULL,
	vote_option_text varchar(255) NOT NULL,
	vote_result int(11) NOT NULL, 
	KEY vote_option_id (vote_option_id), 
	KEY vote_id (vote_id)
);
#
# TABLE: ftfbb_vote_voters
#
DROP TABLE IF EXISTS ftfbb_vote_voters;
CREATE TABLE ftfbb_vote_voters(
	vote_id mediumint(8) unsigned NOT NULL,
	vote_user_id mediumint(8) NOT NULL,
	vote_user_ip char(8) NOT NULL, 
	KEY vote_id (vote_id), 
	KEY vote_user_id (vote_user_id), 
	KEY vote_user_ip (vote_user_ip)
);
#
# TABLE: ftfbb_words
#
DROP TABLE IF EXISTS ftfbb_words;
CREATE TABLE ftfbb_words(
	word_id mediumint(8) unsigned NOT NULL auto_increment,
	word char(100) NOT NULL,
	replacement char(100) NOT NULL, 
	PRIMARY KEY (word_id)
);
#
# TABLE: ftfbb_confirm
#
DROP TABLE IF EXISTS ftfbb_confirm;
CREATE TABLE ftfbb_confirm(
	confirm_id char(32) NOT NULL,
	session_id char(32) NOT NULL,
	code char(6) NOT NULL, 
	PRIMARY KEY (session_id, confirm_id)
);
#
# TABLE: ftfbb_sessions_keys
#
DROP TABLE IF EXISTS ftfbb_sessions_keys;
CREATE TABLE ftfbb_sessions_keys(
	key_id varchar(32) NOT NULL,
	user_id mediumint(8) NOT NULL,
	last_ip varchar(8) NOT NULL,
	last_login int(11) NOT NULL, 
	PRIMARY KEY (key_id, user_id), 
	KEY last_login (last_login)
);

#
# Table Data for ftfbb_sessions_keys
#

INSERT INTO ftfbb_sessions_keys (key_id, user_id, last_ip, last_login) VALUES('f6088fe756c25f4cca51397c133bc255', '2', '504e92f5', '1174138785');
INSERT INTO ftfbb_sessions_keys (key_id, user_id, last_ip, last_login) VALUES('1e08c0a86edafcf5aac74f262d3fc15b', '3', 'c2d5e7c3', '1174337749');
INSERT INTO ftfbb_sessions_keys (key_id, user_id, last_ip, last_login) VALUES('0cf0a5ac8b1f5b4b483f07f1b38d40a6', '2', '504e92f5', '1174391542');
INSERT INTO ftfbb_sessions_keys (key_id, user_id, last_ip, last_login) VALUES('a62858e2899ce9ab853026fdfb01277b', '4', 'd597e4ea', '1174233397');
INSERT INTO ftfbb_sessions_keys (key_id, user_id, last_ip, last_login) VALUES('bfa9efde2351e66f332208354fda72a8', '2', '504e92f5', '1174394128');
