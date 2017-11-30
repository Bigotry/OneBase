/*
Navicat MySQL Data Transfer

Source Server         : localhost_link
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : onebase

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-11-30 17:44:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ob_action_log`
-- ----------------------------
DROP TABLE IF EXISTS `ob_action_log`;
CREATE TABLE `ob_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行会员id',
  `username` char(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `ip` char(30) NOT NULL DEFAULT '' COMMENT '执行行为者ip',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '行为名称',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '执行的URL',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=225 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表';

-- ----------------------------
-- Records of ob_action_log
-- ----------------------------

-- ----------------------------
-- Table structure for `ob_addon`
-- ----------------------------
DROP TABLE IF EXISTS `ob_addon`;
CREATE TABLE `ob_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名称',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '插件描述',
  `config` text NOT NULL COMMENT '配置',
  `author` varchar(40) NOT NULL DEFAULT '' COMMENT '作者',
  `version` varchar(20) NOT NULL DEFAULT '' COMMENT '版本号',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='插件表';

-- ----------------------------
-- Records of ob_addon
-- ----------------------------
INSERT INTO `ob_addon` VALUES ('1', 'Editor', '文本编辑器', '富文本编辑器', '', 'Bigotry', '1.0', '1', '0', '0');
INSERT INTO `ob_addon` VALUES ('3', 'File', '文件上传', '文件上传插件', '', 'Jack', '1.0', '1', '0', '0');
INSERT INTO `ob_addon` VALUES ('4', 'Icon', '图标选择', '图标选择插件', '', 'Bigotry', '1.0', '1', '0', '0');
INSERT INTO `ob_addon` VALUES ('7', 'Region', '区域选择', '区域选择插件', '', 'Bigotry', '1.0', '1', '0', '0');

-- ----------------------------
-- Table structure for `ob_api`
-- ----------------------------
DROP TABLE IF EXISTS `ob_api`;
CREATE TABLE `ob_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(150) NOT NULL DEFAULT '' COMMENT '接口名称',
  `group_id` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '接口分组',
  `request_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '请求类型 0:POST  1:GET',
  `api_url` char(50) NOT NULL DEFAULT '' COMMENT '请求路径',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '接口描述',
  `describe_text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '接口富文本描述',
  `is_request_data` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否需要请求数据',
  `request_data` text NOT NULL COMMENT '请求数据',
  `response_data` text NOT NULL COMMENT '响应数据',
  `is_response_data` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否需要响应数据',
  `is_user_token` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否需要用户token',
  `is_response_sign` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否返回数据签名',
  `is_request_sign` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否验证请求数据签名',
  `response_examples` text NOT NULL COMMENT '响应栗子',
  `developer` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '研发者',
  `api_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '接口状态（0:待研发，1:研发中，2:测试中，3:已完成）',
  `is_page` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为分页接口 0：否  1：是',
  `sort` tinyint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=193 DEFAULT CHARSET=utf8 COMMENT='API表';

-- ----------------------------
-- Records of ob_api
-- ----------------------------
INSERT INTO `ob_api` VALUES ('186', '登录或注册', '34', '0', 'common/login', '系统登录注册接口，若用户名存在则验证密码正确性，若用户名不存在则注册新用户，返回 user_token 用于操作需验证身份的接口', '', '1', '[{\"field_name\":\"username\",\"data_type\":\"0\",\"is_require\":\"1\",\"field_describe\":\"\\u7528\\u6237\\u540d\"},{\"field_name\":\"password\",\"data_type\":\"0\",\"is_require\":\"1\",\"field_describe\":\"\\u5bc6\\u7801\"}]', '[{\"field_name\":\"data\",\"data_type\":\"2\",\"field_describe\":\"\\u4f1a\\u5458\\u6570\\u636e\\u53causer_token\"}]', '1', '0', '1', '0', '{\r\n    &quot;code&quot;: 0,\r\n    &quot;msg&quot;: &quot;操作成功&quot;,\r\n    &quot;data&quot;: {\r\n        &quot;member_id&quot;: 51,\r\n        &quot;nickname&quot;: &quot;sadasdas&quot;,\r\n        &quot;username&quot;: &quot;sadasdas&quot;,\r\n        &quot;create_time&quot;: &quot;2017-09-09 13:40:17&quot;,\r\n        &quot;user_token&quot;: &quot;eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJPbmVCYXNlIEpXVCIsImlhdCI6MTUwNDkzNTYxNywiZXhwIjoxNTA0OTM2NjE3LCJhdWQiOiJPbmVCYXNlIiwic3ViIjoiT25lQmFzZSIsImRhdGEiOnsibWVtYmVyX2lkIjo1MSwibmlja25hbWUiOiJzYWRhc2RhcyIsInVzZXJuYW1lIjoic2FkYXNkYXMiLCJjcmVhdGVfdGltZSI6IjIwMTctMDktMDkgMTM6NDA6MTcifX0.6PEShODuifNsa-x1TumLoEaR2TCXpUEYgjpD3Mz3GRM&quot;\r\n    }\r\n}', '0', '1', '0', '0', '1', '1504501410', '1504949075');
INSERT INTO `ob_api` VALUES ('187', '文章分类列表', '44', '0', 'article/categorylist', '文章分类列表接口', '', '0', '', '[{\"field_name\":\"id\",\"data_type\":\"0\",\"field_describe\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\"},{\"field_name\":\"name\",\"data_type\":\"0\",\"field_describe\":\"\\u6587\\u7ae0\\u5206\\u7c7b\\u540d\\u79f0\"}]', '1', '0', '0', '0', '{\r\n    &quot;code&quot;: 0,\r\n    &quot;msg&quot;: &quot;操作成功&quot;,\r\n    &quot;data&quot;: [\r\n        {\r\n            &quot;id&quot;: 2,\r\n            &quot;name&quot;: &quot;测试文章分类2&quot;\r\n        },\r\n        {\r\n            &quot;id&quot;: 1,\r\n            &quot;name&quot;: &quot;测试文章分类1&quot;\r\n        }\r\n    ]\r\n}', '0', '0', '0', '2', '1', '1504765581', '1507366297');
INSERT INTO `ob_api` VALUES ('188', '文章列表', '44', '0', 'article/articlelist', '文章列表接口', '', '1', '[{\"field_name\":\"category_id\",\"data_type\":\"0\",\"is_require\":\"0\",\"field_describe\":\"\\u82e5\\u4e0d\\u4f20\\u9012\\u6b64\\u53c2\\u6570\\u5219\\u4e3a\\u6240\\u6709\\u5206\\u7c7b\"}]', '', '0', '0', '0', '0', '{\r\n    &quot;code&quot;: 0,\r\n    &quot;msg&quot;: &quot;操作成功&quot;,\r\n    &quot;data&quot;: {\r\n        &quot;total&quot;: 9,\r\n        &quot;per_page&quot;: &quot;10&quot;,\r\n        &quot;current_page&quot;: 1,\r\n        &quot;last_page&quot;: 1,\r\n        &quot;data&quot;: [\r\n            {\r\n                &quot;id&quot;: 16,\r\n                &quot;name&quot;: &quot;11111111&quot;,\r\n                &quot;category_id&quot;: 2,\r\n                &quot;describe&quot;: &quot;22222222&quot;,\r\n                &quot;create_time&quot;: &quot;2017-08-07 13:58:37&quot;\r\n            },\r\n            {\r\n                &quot;id&quot;: 15,\r\n                &quot;name&quot;: &quot;tttttt&quot;,\r\n                &quot;category_id&quot;: 1,\r\n                &quot;describe&quot;: &quot;sddd&quot;,\r\n                &quot;create_time&quot;: &quot;2017-08-07 13:24:46&quot;\r\n            }\r\n        ]\r\n    }\r\n}', '0', '0', '1', '1', '1', '1504779780', '1507366268');
INSERT INTO `ob_api` VALUES ('189', '首页接口', '45', '0', 'combination/index', '首页聚合接口', '', '1', '[{\"field_name\":\"category_id\",\"data_type\":\"0\",\"is_require\":\"0\",\"field_describe\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\"}]', '[{\"field_name\":\"article_category_list\",\"data_type\":\"2\",\"field_describe\":\"\\u6587\\u7ae0\\u5206\\u7c7b\\u6570\\u636e\"},{\"field_name\":\"article_list\",\"data_type\":\"2\",\"field_describe\":\"\\u6587\\u7ae0\\u6570\\u636e\"}]', '1', '0', '1', '0', '{\r\n    &quot;code&quot;: 0,\r\n    &quot;msg&quot;: &quot;操作成功&quot;,\r\n    &quot;data&quot;: {\r\n        &quot;article_category_list&quot;: [\r\n            {\r\n                &quot;id&quot;: 2,\r\n                &quot;name&quot;: &quot;测试文章分类2&quot;\r\n            },\r\n            {\r\n                &quot;id&quot;: 1,\r\n                &quot;name&quot;: &quot;测试文章分类1&quot;\r\n            }\r\n        ],\r\n        &quot;article_list&quot;: {\r\n            &quot;total&quot;: 8,\r\n            &quot;per_page&quot;: &quot;2&quot;,\r\n            &quot;current_page&quot;: &quot;1&quot;,\r\n            &quot;last_page&quot;: 4,\r\n            &quot;data&quot;: [\r\n                {\r\n                    &quot;id&quot;: 15,\r\n                    &quot;name&quot;: &quot;tttttt&quot;,\r\n                    &quot;category_id&quot;: 1,\r\n                    &quot;describe&quot;: &quot;sddd&quot;,\r\n                    &quot;create_time&quot;: &quot;2017-08-07 13:24:46&quot;\r\n                },\r\n                {\r\n                    &quot;id&quot;: 14,\r\n                    &quot;name&quot;: &quot;1111111111111111111&quot;,\r\n                    &quot;category_id&quot;: 1,\r\n                    &quot;describe&quot;: &quot;123123&quot;,\r\n                    &quot;create_time&quot;: &quot;2017-08-04 15:37:20&quot;\r\n                }\r\n            ]\r\n        }\r\n    }\r\n}', '0', '0', '1', '0', '1', '1504785072', '1504948716');
INSERT INTO `ob_api` VALUES ('190', '详情页接口', '45', '0', 'combination/details', '详情页接口', '', '1', '[{\"field_name\":\"article_id\",\"data_type\":\"0\",\"is_require\":\"1\",\"field_describe\":\"\\u6587\\u7ae0ID\"}]', '[{\"field_name\":\"article_category_list\",\"data_type\":\"2\",\"field_describe\":\"\\u6587\\u7ae0\\u5206\\u7c7b\\u6570\\u636e\"},{\"field_name\":\"article_details\",\"data_type\":\"2\",\"field_describe\":\"\\u6587\\u7ae0\\u8be6\\u60c5\\u6570\\u636e\"}]', '1', '0', '0', '0', '{\r\n    &quot;code&quot;: 0,\r\n    &quot;msg&quot;: &quot;操作成功&quot;,\r\n    &quot;data&quot;: {\r\n        &quot;article_category_list&quot;: [\r\n            {\r\n                &quot;id&quot;: 2,\r\n                &quot;name&quot;: &quot;测试文章分类2&quot;\r\n            },\r\n            {\r\n                &quot;id&quot;: 1,\r\n                &quot;name&quot;: &quot;测试文章分类1&quot;\r\n            }\r\n        ],\r\n        &quot;article_details&quot;: {\r\n            &quot;id&quot;: 1,\r\n            &quot;name&quot;: &quot;213&quot;,\r\n            &quot;category_id&quot;: 1,\r\n            &quot;describe&quot;: &quot;test001&quot;,\r\n            &quot;content&quot;: &quot;第三方发送到&quot;&quot;&quot;,\r\n            &quot;create_time&quot;: &quot;2014-07-22 11:56:53&quot;\r\n        }\r\n    }\r\n}', '0', '0', '0', '0', '1', '1504922092', '1504923179');
INSERT INTO `ob_api` VALUES ('191', '修改密码', '34', '0', 'common/changepassword', '修改密码接口', '', '1', '[{\"field_name\":\"old_password\",\"data_type\":\"0\",\"is_require\":\"1\",\"field_describe\":\"\\u65e7\\u5bc6\\u7801\"},{\"field_name\":\"new_password\",\"data_type\":\"0\",\"is_require\":\"1\",\"field_describe\":\"\\u65b0\\u5bc6\\u7801\"}]', '', '0', '1', '0', '0', ' ', '0', '0', '0', '0', '1', '1504941496', '1504941496');
INSERT INTO `ob_api` VALUES ('192', '友情链接列表', '34', '0', 'Common/getBlogrollList', '友情链接接口', '', '0', '', '', '0', '0', '0', '0', '', '0', '2', '0', '0', '1', '1510986310', '1510986310');

-- ----------------------------
-- Table structure for `ob_api_group`
-- ----------------------------
DROP TABLE IF EXISTS `ob_api_group`;
CREATE TABLE `ob_api_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(120) NOT NULL DEFAULT '' COMMENT 'aip分组名称',
  `sort` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COMMENT='api分组表';

-- ----------------------------
-- Records of ob_api_group
-- ----------------------------
INSERT INTO `ob_api_group` VALUES ('34', '基础接口', '0', '1504501195', '0', '1');
INSERT INTO `ob_api_group` VALUES ('44', '文章接口', '1', '1504765319', '1504765319', '1');
INSERT INTO `ob_api_group` VALUES ('45', '聚合接口', '0', '1504784149', '1504784149', '1');

-- ----------------------------
-- Table structure for `ob_article`
-- ----------------------------
DROP TABLE IF EXISTS `ob_article`;
CREATE TABLE `ob_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `name` char(40) NOT NULL DEFAULT '' COMMENT '文章名称',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章分类',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `content` text NOT NULL COMMENT '文章内容',
  `cover_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '封面图片id',
  `file_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件id',
  `img_ids` varchar(200) NOT NULL DEFAULT '' COMMENT '多图字段',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='文章表';

-- ----------------------------
-- Records of ob_article
-- ----------------------------
INSERT INTO `ob_article` VALUES ('1', '1', '测试', '1', '测试', '萨达', '7', '0', '', '1510388633', '1512031447', '1');

-- ----------------------------
-- Table structure for `ob_article_category`
-- ----------------------------
DROP TABLE IF EXISTS `ob_article_category`;
CREATE TABLE `ob_article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '分类名称',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态',
  `icon` char(20) NOT NULL DEFAULT '' COMMENT '分类图标',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='分类表';

-- ----------------------------
-- Records of ob_article_category
-- ----------------------------
INSERT INTO `ob_article_category` VALUES ('1', 'test', 'ces', '1510388612', '1510388612', '1', 'fa-th-list');

-- ----------------------------
-- Table structure for `ob_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `ob_auth_group`;
CREATE TABLE `ob_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) NOT NULL DEFAULT '' COMMENT '用户组所属模块',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `describe` varchar(80) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态',
  `rules` varchar(1000) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='权限组表';

-- ----------------------------
-- Records of ob_auth_group
-- ----------------------------
INSERT INTO `ob_auth_group` VALUES ('1', 'admin', '默认用户组', '', '1', '1,68,75,124,70,126,135,136,140,141,142,143,16,17,108,109,27,144,145,146,185,186,187', '1', '1511150620', '0');

-- ----------------------------
-- Table structure for `ob_auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `ob_auth_group_access`;
CREATE TABLE `ob_auth_group_access` (
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户组id',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '数据状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组授权表';

-- ----------------------------
-- Records of ob_auth_group_access
-- ----------------------------
INSERT INTO `ob_auth_group_access` VALUES ('2', '1', '1511150698', '1511150698', '1');

-- ----------------------------
-- Table structure for `ob_blogroll`
-- ----------------------------
DROP TABLE IF EXISTS `ob_blogroll`;
CREATE TABLE `ob_blogroll` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL DEFAULT '' COMMENT '链接名称',
  `img_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '链接图片封面',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='友情链接表';

-- ----------------------------
-- Records of ob_blogroll
-- ----------------------------
INSERT INTO `ob_blogroll` VALUES ('1', 'test', '9', 'https://demo.onebase.org', '测试友情链接哦', '0', '1', '1510979859', '1510979859');

-- ----------------------------
-- Table structure for `ob_config`
-- ----------------------------
DROP TABLE IF EXISTS `ob_config`;
CREATE TABLE `ob_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置标题',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置选项',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '配置说明',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COMMENT='配置表';

-- ----------------------------
-- Records of ob_config
-- ----------------------------
INSERT INTO `ob_config` VALUES ('1', 'seo_title', '1', '网站标题', '1', '', '网站标题前台显示标题，优先级低于SEO模块', '1378898976', '1511863400', '1', 'OneBase免费开源架构', '3');
INSERT INTO `ob_config` VALUES ('2', 'seo_description', '2', '网站描述', '1', '', '网站搜索引擎描述，优先级低于SEO模块', '1378898976', '1511863400', '1', 'OneBase免费开源架构', '100');
INSERT INTO `ob_config` VALUES ('3', 'seo_keywords', '2', '网站关键字', '1', '', '网站搜索引擎关键字，优先级低于SEO模块', '1378898976', '1511863400', '1', 'OneBase免费开源架构', '99');
INSERT INTO `ob_config` VALUES ('9', 'config_type_list', '3', '配置类型列表', '3', '', '主要用于数据解析和页面表单的生成', '1378898976', '1512033787', '1', '0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举\r\n5:图片\r\n6:文件\r\n7:富文本\r\n8:单选\r\n9:多选\r\n10:日期\r\n11:时间\r\n12:颜色', '100');
INSERT INTO `ob_config` VALUES ('20', 'config_group_list', '3', '配置分组', '3', '', '配置分组', '1379228036', '1512033787', '1', '1:基础\r\n2:数据\r\n3:系统\r\n4:API', '100');
INSERT INTO `ob_config` VALUES ('25', 'list_rows', '0', '每页数据记录数', '2', '', '数据每页显示记录数', '1379503896', '1511608007', '1', '10', '10');
INSERT INTO `ob_config` VALUES ('29', 'data_backup_part_size', '0', '数据库备份卷大小', '2', '', '该值用于限制压缩后的分卷最大长度。单位：B', '1381482488', '1511608007', '1', '52428800', '7');
INSERT INTO `ob_config` VALUES ('30', 'data_backup_compress', '4', '数据库备份文件是否启用压缩', '2', '0:不压缩\r\n1:启用压缩', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', '1381713345', '1511608007', '1', '1', '9');
INSERT INTO `ob_config` VALUES ('31', 'data_backup_compress_level', '4', '数据库备份文件压缩级别', '2', '1:普通\r\n4:一般\r\n9:最高', '数据库备份文件的压缩级别，该配置在开启压缩时生效', '1381713408', '1511608007', '1', '9', '10');
INSERT INTO `ob_config` VALUES ('33', 'allow_url', '3', '不受权限验证的url', '3', '', '', '1386644047', '1512033787', '1', '0:file/pictureupload\r\n1:addon/execute', '100');
INSERT INTO `ob_config` VALUES ('43', 'empty_list_describe', '1', '数据列表为空时的描述信息', '2', '', '', '1492278127', '1511608007', '1', 'aOh! 暂时还没有数据~', '0');
INSERT INTO `ob_config` VALUES ('44', 'trash_config', '3', '回收站配置', '3', '', 'key为模型名称，值为显示列。', '1492312698', '1512033787', '1', 'Config:name\r\nAuthGroup:name\r\nMember:nickname\r\nMenu:name\r\nArticle:name\r\nArticleCategory:name\r\nAddon:name\r\nPicture:name\r\nFile:name\r\nActionLog:describe\r\nApiGroup:name\r\nApi:name\r\nBlogroll:name\r\nExeLog:exe_url\r\nSeo:name', '99');
INSERT INTO `ob_config` VALUES ('49', 'static_domain', '1', '静态资源域名', '1', '', '若静态资源为本地资源则此项为空，若为外部资源则为存放静态资源的域名', '1502430387', '1511863400', '1', '', '0');
INSERT INTO `ob_config` VALUES ('65', 'admin_allow_ip', '3', '超级管理员登录IP', '3', '', '后台超级管理员登录IP限制，其他角色不受限。', '1510995243', '1512033787', '1', '0:127.0.0.1', '0');
INSERT INTO `ob_config` VALUES ('52', 'team_developer', '3', '研发团队人员', '4', '', '', '1504236453', '1511607763', '1', '0:Bigotry\r\n1:扫地僧', '0');
INSERT INTO `ob_config` VALUES ('53', 'api_status_option', '3', 'API接口状态', '4', '', '', '1504242433', '1511607763', '1', '0:待研发\r\n1:研发中\r\n2:测试中\r\n3:已完成', '0');
INSERT INTO `ob_config` VALUES ('54', 'api_data_type_option', '3', 'API数据类型', '4', '', '', '1504328208', '1511607763', '1', '0:字符\r\n1:文本\r\n2:数组\r\n3:文件', '0');
INSERT INTO `ob_config` VALUES ('55', 'frontend_theme', '1', '前端主题', '1', '', '', '1504762360', '1511863400', '1', 'default', '0');
INSERT INTO `ob_config` VALUES ('56', 'api_domain', '1', 'API部署域名', '4', '', '', '1504779094', '1511607763', '1', 'https://demo.onebase.org', '0');
INSERT INTO `ob_config` VALUES ('57', 'api_key', '1', 'API加密KEY', '4', '', '泄露后API将存在安全隐患', '1505302112', '1511607763', '1', 'l2V|gfZp{8`;jzR~6Y1_', '0');
INSERT INTO `ob_config` VALUES ('58', 'loading_icon', '4', '页面Loading图标设置', '1', '1:图标1\r\n2:图标2\r\n3:图标3\r\n4:图标4\r\n5:图标5\r\n6:图标6\r\n7:图标7', '页面Loading图标支持7种图标切换', '1505377202', '1511863400', '1', '7', '4');
INSERT INTO `ob_config` VALUES ('59', 'sys_file_field', '3', '文件字段配置', '3', '', 'key为模型名，值为文件列名。', '1505799386', '1512033787', '1', '0_article:file_id', '99');
INSERT INTO `ob_config` VALUES ('60', 'sys_picture_field', '3', '图片字段配置', '3', '', 'key为模型名，值为图片列名。', '1506315422', '1512033787', '1', '0_article:cover_id\r\n1_article:img_ids', '99');
INSERT INTO `ob_config` VALUES ('61', 'jwt_key', '1', 'JWT加密KEY', '4', '', '', '1506748805', '1511607763', '1', 'l2V|DSFXXXgfZp{8`;FjzR~6Y1_', '0');
INSERT INTO `ob_config` VALUES ('64', 'is_write_exe_log', '4', '是否写入执行记录', '3', '0:否\r\n1:是', '', '1510543461', '1512033787', '1', '0', '101');

-- ----------------------------
-- Table structure for `ob_driver`
-- ----------------------------
DROP TABLE IF EXISTS `ob_driver`;
CREATE TABLE `ob_driver` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `service_name` varchar(40) NOT NULL DEFAULT '' COMMENT '服务标识',
  `driver_name` varchar(20) NOT NULL DEFAULT '' COMMENT '驱动标识',
  `config` text NOT NULL COMMENT '配置',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='插件表';

-- ----------------------------
-- Records of ob_driver
-- ----------------------------

-- ----------------------------
-- Table structure for `ob_exe_log`
-- ----------------------------
DROP TABLE IF EXISTS `ob_exe_log`;
CREATE TABLE `ob_exe_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增',
  `ip` char(50) NOT NULL DEFAULT '' COMMENT 'IP地址',
  `exe_url` varchar(2000) NOT NULL DEFAULT '' COMMENT '执行URL',
  `exe_time` char(20) NOT NULL DEFAULT '' COMMENT '执行时间 单位 秒',
  `exe_memory` char(20) NOT NULL DEFAULT '' COMMENT '内存占用',
  `exe_os` char(30) NOT NULL DEFAULT '' COMMENT '操作系统',
  `source_url` varchar(2000) NOT NULL DEFAULT '' COMMENT '来源URL',
  `session_id` char(32) NOT NULL DEFAULT '' COMMENT 'session_id',
  `browser` char(30) NOT NULL DEFAULT '' COMMENT '浏览器',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `login_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '执行者ID',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '类型  0 ： 应用范围 ， 1：API 范围 ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=369 DEFAULT CHARSET=utf8 COMMENT='执行记录表';

-- ----------------------------
-- Records of ob_exe_log
-- ----------------------------

-- ----------------------------
-- Table structure for `ob_file`
-- ----------------------------
DROP TABLE IF EXISTS `ob_file`;
CREATE TABLE `ob_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '保存名称',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '远程地址',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='文件表';

-- ----------------------------
-- Records of ob_file
-- ----------------------------

-- ----------------------------
-- Table structure for `ob_hook`
-- ----------------------------
DROP TABLE IF EXISTS `ob_hook`;
CREATE TABLE `ob_hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `describe` varchar(255) NOT NULL COMMENT '描述',
  `addon_list` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '数据状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COMMENT='钩子表';

-- ----------------------------
-- Records of ob_hook
-- ----------------------------
INSERT INTO `ob_hook` VALUES ('33', 'ArticleEditor', '富文本编辑器', 'Editor', '1', '0', '0');
INSERT INTO `ob_hook` VALUES ('36', 'File', '文件上传钩子', 'File', '1', '0', '0');
INSERT INTO `ob_hook` VALUES ('37', 'Icon', '图标选择钩子', 'Icon', '1', '0', '0');
INSERT INTO `ob_hook` VALUES ('40', 'RegionSelect', '区域选择', 'Region', '1', '0', '0');

-- ----------------------------
-- Table structure for `ob_member`
-- ----------------------------
DROP TABLE IF EXISTS `ob_member`;
CREATE TABLE `ob_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `nickname` char(50) NOT NULL DEFAULT '' COMMENT '昵称',
  `username` char(16) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `email` char(32) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL DEFAULT '' COMMENT '用户手机',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态',
  `leader_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '上级会员ID',
  `is_share_member` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否共享会员',
  `is_inside` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为后台使用者',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Table structure for `ob_menu`
-- ----------------------------
DROP TABLE IF EXISTS `ob_menu`;
CREATE TABLE `ob_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `module` char(20) NOT NULL DEFAULT '' COMMENT '模块',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `is_hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `icon` char(30) NOT NULL DEFAULT '' COMMENT '图标',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of ob_menu
-- ----------------------------
INSERT INTO `ob_menu` VALUES ('1', '系统首页', '0', '100', 'admin', 'index/index', '0', 'fa-home', '1', '1510983463', '0');
INSERT INTO `ob_menu` VALUES ('16', '会员管理', '0', '3', 'admin', 'member/index', '0', 'fa-users', '1', '1501928389', '0');
INSERT INTO `ob_menu` VALUES ('17', '会员列表', '16', '1', 'admin', 'member/memberlist', '0', 'fa-list', '1', '1495272875', '0');
INSERT INTO `ob_menu` VALUES ('18', '会员添加', '16', '0', 'admin', 'member/memberadd', '0', 'fa-user-plus', '1', '1491837324', '0');
INSERT INTO `ob_menu` VALUES ('27', '权限管理', '16', '0', 'admin', 'auth/grouplist', '0', 'fa-key', '1', '1492000451', '0');
INSERT INTO `ob_menu` VALUES ('32', '权限组编辑', '27', '0', 'admin', 'auth/groupedit', '1', '', '1', '1492002620', '0');
INSERT INTO `ob_menu` VALUES ('34', '授权', '27', '0', 'admin', 'auth_manager/group', '1', '', '1', '0', '0');
INSERT INTO `ob_menu` VALUES ('35', '菜单授权', '27', '0', 'admin', 'auth/menuauth', '1', '', '1', '1492095653', '0');
INSERT INTO `ob_menu` VALUES ('36', '会员授权', '27', '0', 'admin', 'auth_manager/memberaccess', '1', '', '1', '0', '0');
INSERT INTO `ob_menu` VALUES ('68', '系统管理', '0', '4', 'admin', 'config/group', '0', 'fa-wrench', '1', '1501928397', '0');
INSERT INTO `ob_menu` VALUES ('69', '系统设置', '68', '1', 'admin', 'config/setting', '0', 'fa-cogs', '1', '1491748512', '0');
INSERT INTO `ob_menu` VALUES ('70', '配置管理', '68', '4', 'admin', 'config/index', '0', 'fa-cog', '1', '1491668183', '0');
INSERT INTO `ob_menu` VALUES ('71', '配置编辑', '70', '0', 'admin', 'config/configedit', '1', '', '1', '1491674180', '0');
INSERT INTO `ob_menu` VALUES ('72', '配置删除', '70', '0', 'admin', 'config/configDel', '1', '', '1', '1491674201', '0');
INSERT INTO `ob_menu` VALUES ('73', '配置添加', '70', '0', 'admin', 'config/configadd', '0', 'fa-plus', '1', '1491666947', '0');
INSERT INTO `ob_menu` VALUES ('75', '菜单管理', '68', '5', 'admin', 'menu/index', '0', 'fa-th-large', '1', '1491318724', '0');
INSERT INTO `ob_menu` VALUES ('98', '菜单编辑', '75', '0', 'admin', 'menu/menuedit', '1', '', '1', '1491577922', '0');
INSERT INTO `ob_menu` VALUES ('108', '修改密码', '17', '0', 'admin', 'user/update_password', '1', '', '1', '0', '0');
INSERT INTO `ob_menu` VALUES ('109', '修改昵称', '17', '0', 'admin', 'user/update_nickname', '1', '', '1', '1491578211', '0');
INSERT INTO `ob_menu` VALUES ('124', '菜单列表', '75', '0', 'admin', 'menu/menulist', '0', 'fa-list', '1', '1491318271', '0');
INSERT INTO `ob_menu` VALUES ('125', '菜单添加', '75', '0', 'admin', 'menu/menuadd', '0', 'fa-plus', '1', '1491318307', '0');
INSERT INTO `ob_menu` VALUES ('126', '配置列表', '70', '0', 'admin', 'config/configlist', '0', 'fa-list', '1', '1491666890', '1491666890');
INSERT INTO `ob_menu` VALUES ('127', '菜单删除', '75', '0', 'admin', 'menu/menuDel', '1', '', '1', '1491674128', '1491674128');
INSERT INTO `ob_menu` VALUES ('128', '权限组添加', '27', '0', 'admin', 'auth/groupadd', '1', '', '1', '1492002635', '1492002635');
INSERT INTO `ob_menu` VALUES ('131', 'test003', '129', '0', 'admin', 'test/test003', '0', '', '1', '1492010323', '1492010323');
INSERT INTO `ob_menu` VALUES ('132', 'test004', '129', '0', 'admin', 'test/test004', '0', '', '1', '1492010337', '1492010337');
INSERT INTO `ob_menu` VALUES ('133', 'test005', '132', '0', 'admin', 'test/test005', '0', '', '1', '1492320818', '1492010376');
INSERT INTO `ob_menu` VALUES ('134', '授权', '17', '0', 'admin', 'member/memberauth', '1', '', '1', '1492238568', '1492101426');
INSERT INTO `ob_menu` VALUES ('135', '回收站', '68', '0', 'admin', 'trash/trashlist', '0', ' fa-recycle', '1', '1492320214', '1492311462');
INSERT INTO `ob_menu` VALUES ('136', '回收站数据', '135', '0', 'admin', 'trash/trashdatalist', '1', 'fa-database', '1', '1492319477', '1492319392');
INSERT INTO `ob_menu` VALUES ('137', '缓存管理', '68', '0', 'admin', 'cache/index', '0', '', '-1', '1492358787', '1492329681');
INSERT INTO `ob_menu` VALUES ('138', '缓存驱动', '137', '0', 'admin', 'cache/cachelist', '0', '', '-1', '1492358776', '1492329755');
INSERT INTO `ob_menu` VALUES ('139', '缓存数据', '137', '0', 'admin', 'cache/cachedata', '0', '', '-1', '1492341896', '1492329801');
INSERT INTO `ob_menu` VALUES ('140', '服务管理', '68', '0', 'admin', 'service/servicelist', '0', 'fa-server', '1', '1492359063', '1492352972');
INSERT INTO `ob_menu` VALUES ('141', '插件管理', '68', '0', 'admin', 'addon/index', '0', 'fa-puzzle-piece', '1', '1492428072', '1492427605');
INSERT INTO `ob_menu` VALUES ('142', '钩子列表', '141', '0', 'admin', 'addon/hooklist', '0', 'fa-anchor', '1', '1492427665', '1492427665');
INSERT INTO `ob_menu` VALUES ('143', '插件列表', '141', '0', 'admin', 'addon/addonlist', '0', 'fa-list', '1', '1492428116', '1492427838');
INSERT INTO `ob_menu` VALUES ('144', '文章管理', '0', '0', 'admin', 'article/index', '0', 'fa-edit', '1', '1501928404', '1492480187');
INSERT INTO `ob_menu` VALUES ('145', '文章列表', '144', '0', 'admin', 'article/articlelist', '0', 'fa-list', '1', '1492480245', '1492480245');
INSERT INTO `ob_menu` VALUES ('146', '文章分类', '144', '0', 'admin', 'article/articlecategorylist', '0', 'fa-list', '1', '1492480359', '1492480342');
INSERT INTO `ob_menu` VALUES ('147', '文章分类编辑', '146', '0', 'admin', 'article/articlecategoryedit', '1', '', '1', '1492485294', '1492485294');
INSERT INTO `ob_menu` VALUES ('148', '分类添加', '144', '0', 'admin', 'article/articlecategoryadd', '0', 'fa-plus', '1', '1492486590', '1492486576');
INSERT INTO `ob_menu` VALUES ('149', '文章添加', '144', '0', 'admin', 'article/articleadd', '0', 'fa-plus', '1', '1492518453', '1492518453');
INSERT INTO `ob_menu` VALUES ('150', '文章编辑', '145', '0', 'admin', 'article/articleedit', '1', '', '1', '1492879589', '1492879589');
INSERT INTO `ob_menu` VALUES ('151', '插件安装', '143', '0', 'admin', 'addon/addoninstall', '1', '', '1', '1492879763', '1492879763');
INSERT INTO `ob_menu` VALUES ('152', '插件卸载', '143', '0', 'admin', 'addon/addonuninstall', '1', '', '1', '1492879789', '1492879789');
INSERT INTO `ob_menu` VALUES ('153', '文章删除', '145', '0', 'admin', 'article/articledel', '1', '', '1', '1492879960', '1492879960');
INSERT INTO `ob_menu` VALUES ('154', '文章分类删除', '146', '0', 'admin', 'article/articlecategorydel', '1', '', '1', '1492879995', '1492879995');
INSERT INTO `ob_menu` VALUES ('156', '驱动安装', '140', '0', 'admin', 'service/driverinstall', '1', '', '1', '1502267009', '1502267009');
INSERT INTO `ob_menu` VALUES ('157', '接口管理', '0', '0', 'admin', 'api/index', '0', 'fa fa-book', '1', '1504000462', '1504000434');
INSERT INTO `ob_menu` VALUES ('158', '分组管理', '157', '0', 'admin', 'api/apigrouplist', '0', 'fa fa-fw fa-th-list', '1', '1504000977', '1504000723');
INSERT INTO `ob_menu` VALUES ('159', '分组添加', '157', '0', 'admin', 'api/apigroupadd', '0', 'fa fa-fw fa-plus', '1', '1504004646', '1504004646');
INSERT INTO `ob_menu` VALUES ('160', '分组编辑', '157', '0', 'admin', 'api/apigroupedit', '1', '', '1', '1504004710', '1504004710');
INSERT INTO `ob_menu` VALUES ('161', '分组删除', '157', '0', 'admin', 'api/apigroupdel', '1', '', '1', '1504004732', '1504004732');
INSERT INTO `ob_menu` VALUES ('162', '接口列表', '157', '0', 'admin', 'api/apilist', '0', 'fa fa-fw fa-th-list', '1', '1504172326', '1504172326');
INSERT INTO `ob_menu` VALUES ('163', '接口添加', '157', '0', 'admin', 'api/apiadd', '0', 'fa fa-fw fa-plus', '1', '1504172352', '1504172352');
INSERT INTO `ob_menu` VALUES ('164', '接口编辑', '157', '0', 'admin', 'api/apiedit', '1', '', '1', '1504172414', '1504172414');
INSERT INTO `ob_menu` VALUES ('165', '接口删除', '157', '0', 'admin', 'api/apidel', '1', '', '1', '1504172435', '1504172435');
INSERT INTO `ob_menu` VALUES ('166', '优化维护', '0', '0', 'admin', 'maintain/index', '0', 'fa-legal', '1', '1509364516', '1505387256');
INSERT INTO `ob_menu` VALUES ('167', 'SEO管理', '166', '0', 'admin', 'seo/seolist', '0', 'fa-list', '1', '1506309608', '1505387303');
INSERT INTO `ob_menu` VALUES ('168', '数据库', '166', '0', 'admin', 'maintain/database', '0', 'fa-database', '1', '1505539670', '1505539394');
INSERT INTO `ob_menu` VALUES ('169', '数据备份', '168', '0', 'admin', 'database/databackup', '0', 'fa-download', '1', '1506309900', '1505539428');
INSERT INTO `ob_menu` VALUES ('170', '数据还原', '168', '0', 'admin', 'database/datarestore', '0', 'fa-exchange', '1', '1506309911', '1505539492');
INSERT INTO `ob_menu` VALUES ('171', '文件清理', '166', '0', 'admin', 'fileclean/cleanlist', '0', 'fa-file', '1', '1506310152', '1505788517');
INSERT INTO `ob_menu` VALUES ('172', '图片清理', '171', '0', 'admin', 'maintain/pictureclear', '0', 'fa-file-image-o', '-1', '1506310096', '1505789249');
INSERT INTO `ob_menu` VALUES ('173', '文件清理', '171', '0', 'admin', 'maintain/fileclear', '0', 'fa-file', '-1', '1506310100', '1505789307');
INSERT INTO `ob_menu` VALUES ('174', '行为日志', '166', '0', 'admin', 'log/loglist', '0', 'fa-street-view', '1', '1507201516', '1507200836');
INSERT INTO `ob_menu` VALUES ('176', '执行记录', '166', '0', 'admin', 'exelog/index', '0', 'fa-list-alt', '1', '1509433351', '1509433351');
INSERT INTO `ob_menu` VALUES ('177', '全局范围', '176', '0', 'admin', 'exelog/applist', '0', 'fa-tags', '1', '1509433570', '1509433570');
INSERT INTO `ob_menu` VALUES ('178', '接口范围', '176', '0', 'admin', 'exelog/apilist', '0', 'fa-tag', '1', '1509433591', '1509433591');
INSERT INTO `ob_menu` VALUES ('179', '友情链接', '68', '0', 'admin', 'blogroll/index', '0', 'fa-heart', '1', '1510641081', '1510641081');
INSERT INTO `ob_menu` VALUES ('180', '链接列表', '179', '0', 'admin', 'blogroll/blogrolllist', '0', 'fa-th', '1', '1510641658', '1510641658');
INSERT INTO `ob_menu` VALUES ('181', '链接添加', '179', '0', 'admin', 'blogroll/blogrolladd', '0', 'fa-plus', '1', '1510641739', '1510641739');
INSERT INTO `ob_menu` VALUES ('182', '链接编辑', '180', '0', 'admin', 'blogroll/blogrolledit', '1', 'fa-pencil-square-o', '1', '1510641816', '1510641816');
INSERT INTO `ob_menu` VALUES ('183', '链接删除', '180', '0', 'admin', 'blogroll/blogrolldel', '1', 'fa-trash-o', '1', '1510642626', '1510642626');

-- ----------------------------
-- Table structure for `ob_picture`
-- ----------------------------
DROP TABLE IF EXISTS `ob_picture`;
CREATE TABLE `ob_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '图片名称',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='图片表';

-- ----------------------------
-- Records of ob_picture
-- ----------------------------

-- ----------------------------
-- Table structure for `ob_region`
-- ----------------------------
DROP TABLE IF EXISTS `ob_region`;
CREATE TABLE `ob_region` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '地区名称',
  `level` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '深度',
  `upid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '父级',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=910007 DEFAULT CHARSET=utf8 COMMENT='省市县数据表';

-- ----------------------------
-- Records of ob_region
-- ----------------------------
INSERT INTO `ob_region` VALUES ('110000', '北京市', '1', '0');
INSERT INTO `ob_region` VALUES ('120000', '天津市', '1', '0');
INSERT INTO `ob_region` VALUES ('130000', '河北省', '1', '0');
INSERT INTO `ob_region` VALUES ('140000', '山西省', '1', '0');
INSERT INTO `ob_region` VALUES ('150000', '内蒙古', '1', '0');
INSERT INTO `ob_region` VALUES ('210000', '辽宁省', '1', '0');
INSERT INTO `ob_region` VALUES ('220000', '吉林省', '1', '0');
INSERT INTO `ob_region` VALUES ('230000', '黑龙江', '1', '0');
INSERT INTO `ob_region` VALUES ('310000', '上海市', '1', '0');
INSERT INTO `ob_region` VALUES ('320000', '江苏省', '1', '0');
INSERT INTO `ob_region` VALUES ('330000', '浙江省', '1', '0');
INSERT INTO `ob_region` VALUES ('340000', '安徽省', '1', '0');
INSERT INTO `ob_region` VALUES ('350000', '福建省', '1', '0');
INSERT INTO `ob_region` VALUES ('360000', '江西省', '1', '0');
INSERT INTO `ob_region` VALUES ('370000', '山东省', '1', '0');
INSERT INTO `ob_region` VALUES ('410000', '河南省', '1', '0');
INSERT INTO `ob_region` VALUES ('420000', '湖北省', '1', '0');
INSERT INTO `ob_region` VALUES ('430000', '湖南省', '1', '0');
INSERT INTO `ob_region` VALUES ('440000', '广东省', '1', '0');
INSERT INTO `ob_region` VALUES ('450000', '广西省', '1', '0');
INSERT INTO `ob_region` VALUES ('460000', '海南省', '1', '0');
INSERT INTO `ob_region` VALUES ('500000', '重庆市', '1', '0');
INSERT INTO `ob_region` VALUES ('510000', '四川省', '1', '0');
INSERT INTO `ob_region` VALUES ('520000', '贵州省', '1', '0');
INSERT INTO `ob_region` VALUES ('530000', '云南省', '1', '0');
INSERT INTO `ob_region` VALUES ('540000', '西　藏', '1', '0');
INSERT INTO `ob_region` VALUES ('610000', '陕西省', '1', '0');
INSERT INTO `ob_region` VALUES ('620000', '甘肃省', '1', '0');
INSERT INTO `ob_region` VALUES ('630000', '青海省', '1', '0');
INSERT INTO `ob_region` VALUES ('640000', '宁　夏', '1', '0');
INSERT INTO `ob_region` VALUES ('650000', '新　疆', '1', '0');
INSERT INTO `ob_region` VALUES ('710000', '台湾省', '1', '0');
INSERT INTO `ob_region` VALUES ('810000', '香　港', '1', '0');
INSERT INTO `ob_region` VALUES ('820000', '澳　门', '1', '0');
INSERT INTO `ob_region` VALUES ('110100', '北京市', '2', '110000');
INSERT INTO `ob_region` VALUES ('110200', '县', '2', '110000');
INSERT INTO `ob_region` VALUES ('120100', '市辖区', '2', '120000');
INSERT INTO `ob_region` VALUES ('120200', '县', '2', '120000');
INSERT INTO `ob_region` VALUES ('130100', '石家庄市', '2', '130000');
INSERT INTO `ob_region` VALUES ('130200', '唐山市', '2', '130000');
INSERT INTO `ob_region` VALUES ('130300', '秦皇岛市', '2', '130000');
INSERT INTO `ob_region` VALUES ('130400', '邯郸市', '2', '130000');
INSERT INTO `ob_region` VALUES ('130500', '邢台市', '2', '130000');
INSERT INTO `ob_region` VALUES ('130600', '保定市', '2', '130000');
INSERT INTO `ob_region` VALUES ('130700', '张家口市', '2', '130000');
INSERT INTO `ob_region` VALUES ('130800', '承德市', '2', '130000');
INSERT INTO `ob_region` VALUES ('130900', '沧州市', '2', '130000');
INSERT INTO `ob_region` VALUES ('131000', '廊坊市', '2', '130000');
INSERT INTO `ob_region` VALUES ('131100', '衡水市', '2', '130000');
INSERT INTO `ob_region` VALUES ('140100', '太原市', '2', '140000');
INSERT INTO `ob_region` VALUES ('140200', '大同市', '2', '140000');
INSERT INTO `ob_region` VALUES ('140300', '阳泉市', '2', '140000');
INSERT INTO `ob_region` VALUES ('140400', '长治市', '2', '140000');
INSERT INTO `ob_region` VALUES ('140500', '晋城市', '2', '140000');
INSERT INTO `ob_region` VALUES ('140600', '朔州市', '2', '140000');
INSERT INTO `ob_region` VALUES ('140700', '晋中市', '2', '140000');
INSERT INTO `ob_region` VALUES ('140800', '运城市', '2', '140000');
INSERT INTO `ob_region` VALUES ('140900', '忻州市', '2', '140000');
INSERT INTO `ob_region` VALUES ('141000', '临汾市', '2', '140000');
INSERT INTO `ob_region` VALUES ('141100', '吕梁市', '2', '140000');
INSERT INTO `ob_region` VALUES ('150100', '呼和浩特市', '2', '150000');
INSERT INTO `ob_region` VALUES ('150200', '包头市', '2', '150000');
INSERT INTO `ob_region` VALUES ('150300', '乌海市', '2', '150000');
INSERT INTO `ob_region` VALUES ('150400', '赤峰市', '2', '150000');
INSERT INTO `ob_region` VALUES ('150500', '通辽市', '2', '150000');
INSERT INTO `ob_region` VALUES ('150600', '鄂尔多斯市', '2', '150000');
INSERT INTO `ob_region` VALUES ('150700', '呼伦贝尔市', '2', '150000');
INSERT INTO `ob_region` VALUES ('150800', '巴彦淖尔市', '2', '150000');
INSERT INTO `ob_region` VALUES ('150900', '乌兰察布市', '2', '150000');
INSERT INTO `ob_region` VALUES ('152200', '兴安盟', '2', '150000');
INSERT INTO `ob_region` VALUES ('152500', '锡林郭勒盟', '2', '150000');
INSERT INTO `ob_region` VALUES ('152900', '阿拉善盟', '2', '150000');
INSERT INTO `ob_region` VALUES ('210100', '沈阳市', '2', '210000');
INSERT INTO `ob_region` VALUES ('210200', '大连市', '2', '210000');
INSERT INTO `ob_region` VALUES ('210300', '鞍山市', '2', '210000');
INSERT INTO `ob_region` VALUES ('210400', '抚顺市', '2', '210000');
INSERT INTO `ob_region` VALUES ('210500', '本溪市', '2', '210000');
INSERT INTO `ob_region` VALUES ('210600', '丹东市', '2', '210000');
INSERT INTO `ob_region` VALUES ('210700', '锦州市', '2', '210000');
INSERT INTO `ob_region` VALUES ('210800', '营口市', '2', '210000');
INSERT INTO `ob_region` VALUES ('210900', '阜新市', '2', '210000');
INSERT INTO `ob_region` VALUES ('211000', '辽阳市', '2', '210000');
INSERT INTO `ob_region` VALUES ('211100', '盘锦市', '2', '210000');
INSERT INTO `ob_region` VALUES ('211200', '铁岭市', '2', '210000');
INSERT INTO `ob_region` VALUES ('211300', '朝阳市', '2', '210000');
INSERT INTO `ob_region` VALUES ('211400', '葫芦岛市', '2', '210000');
INSERT INTO `ob_region` VALUES ('220100', '长春市', '2', '220000');
INSERT INTO `ob_region` VALUES ('220200', '吉林市', '2', '220000');
INSERT INTO `ob_region` VALUES ('220300', '四平市', '2', '220000');
INSERT INTO `ob_region` VALUES ('220400', '辽源市', '2', '220000');
INSERT INTO `ob_region` VALUES ('220500', '通化市', '2', '220000');
INSERT INTO `ob_region` VALUES ('220600', '白山市', '2', '220000');
INSERT INTO `ob_region` VALUES ('220700', '松原市', '2', '220000');
INSERT INTO `ob_region` VALUES ('220800', '白城市', '2', '220000');
INSERT INTO `ob_region` VALUES ('222400', '延边朝鲜族自治州', '2', '220000');
INSERT INTO `ob_region` VALUES ('230100', '哈尔滨市', '2', '230000');
INSERT INTO `ob_region` VALUES ('230200', '齐齐哈尔市', '2', '230000');
INSERT INTO `ob_region` VALUES ('230300', '鸡西市', '2', '230000');
INSERT INTO `ob_region` VALUES ('230400', '鹤岗市', '2', '230000');
INSERT INTO `ob_region` VALUES ('230500', '双鸭山市', '2', '230000');
INSERT INTO `ob_region` VALUES ('230600', '大庆市', '2', '230000');
INSERT INTO `ob_region` VALUES ('230700', '伊春市', '2', '230000');
INSERT INTO `ob_region` VALUES ('230800', '佳木斯市', '2', '230000');
INSERT INTO `ob_region` VALUES ('230900', '七台河市', '2', '230000');
INSERT INTO `ob_region` VALUES ('231000', '牡丹江市', '2', '230000');
INSERT INTO `ob_region` VALUES ('231100', '黑河市', '2', '230000');
INSERT INTO `ob_region` VALUES ('231200', '绥化市', '2', '230000');
INSERT INTO `ob_region` VALUES ('232700', '大兴安岭地区', '2', '230000');
INSERT INTO `ob_region` VALUES ('310100', '市辖区', '2', '310000');
INSERT INTO `ob_region` VALUES ('310200', '县', '2', '310000');
INSERT INTO `ob_region` VALUES ('320100', '南京市', '2', '320000');
INSERT INTO `ob_region` VALUES ('320200', '无锡市', '2', '320000');
INSERT INTO `ob_region` VALUES ('320300', '徐州市', '2', '320000');
INSERT INTO `ob_region` VALUES ('320400', '常州市', '2', '320000');
INSERT INTO `ob_region` VALUES ('320500', '苏州市', '2', '320000');
INSERT INTO `ob_region` VALUES ('320600', '南通市', '2', '320000');
INSERT INTO `ob_region` VALUES ('320700', '连云港市', '2', '320000');
INSERT INTO `ob_region` VALUES ('320800', '淮安市', '2', '320000');
INSERT INTO `ob_region` VALUES ('320900', '盐城市', '2', '320000');
INSERT INTO `ob_region` VALUES ('321000', '扬州市', '2', '320000');
INSERT INTO `ob_region` VALUES ('321100', '镇江市', '2', '320000');
INSERT INTO `ob_region` VALUES ('321200', '泰州市', '2', '320000');
INSERT INTO `ob_region` VALUES ('321300', '宿迁市', '2', '320000');
INSERT INTO `ob_region` VALUES ('330100', '杭州市', '2', '330000');
INSERT INTO `ob_region` VALUES ('330200', '宁波市', '2', '330000');
INSERT INTO `ob_region` VALUES ('330300', '温州市', '2', '330000');
INSERT INTO `ob_region` VALUES ('330400', '嘉兴市', '2', '330000');
INSERT INTO `ob_region` VALUES ('330500', '湖州市', '2', '330000');
INSERT INTO `ob_region` VALUES ('330600', '绍兴市', '2', '330000');
INSERT INTO `ob_region` VALUES ('330700', '金华市', '2', '330000');
INSERT INTO `ob_region` VALUES ('330800', '衢州市', '2', '330000');
INSERT INTO `ob_region` VALUES ('330900', '舟山市', '2', '330000');
INSERT INTO `ob_region` VALUES ('331000', '台州市', '2', '330000');
INSERT INTO `ob_region` VALUES ('331100', '丽水市', '2', '330000');
INSERT INTO `ob_region` VALUES ('340100', '合肥市', '2', '340000');
INSERT INTO `ob_region` VALUES ('340200', '芜湖市', '2', '340000');
INSERT INTO `ob_region` VALUES ('340300', '蚌埠市', '2', '340000');
INSERT INTO `ob_region` VALUES ('340400', '淮南市', '2', '340000');
INSERT INTO `ob_region` VALUES ('340500', '马鞍山市', '2', '340000');
INSERT INTO `ob_region` VALUES ('340600', '淮北市', '2', '340000');
INSERT INTO `ob_region` VALUES ('340700', '铜陵市', '2', '340000');
INSERT INTO `ob_region` VALUES ('340800', '安庆市', '2', '340000');
INSERT INTO `ob_region` VALUES ('341000', '黄山市', '2', '340000');
INSERT INTO `ob_region` VALUES ('341100', '滁州市', '2', '340000');
INSERT INTO `ob_region` VALUES ('341200', '阜阳市', '2', '340000');
INSERT INTO `ob_region` VALUES ('341300', '宿州市', '2', '340000');
INSERT INTO `ob_region` VALUES ('341500', '六安市', '2', '340000');
INSERT INTO `ob_region` VALUES ('341600', '亳州市', '2', '340000');
INSERT INTO `ob_region` VALUES ('341700', '池州市', '2', '340000');
INSERT INTO `ob_region` VALUES ('341800', '宣城市', '2', '340000');
INSERT INTO `ob_region` VALUES ('350100', '福州市', '2', '350000');
INSERT INTO `ob_region` VALUES ('350200', '厦门市', '2', '350000');
INSERT INTO `ob_region` VALUES ('350300', '莆田市', '2', '350000');
INSERT INTO `ob_region` VALUES ('350400', '三明市', '2', '350000');
INSERT INTO `ob_region` VALUES ('350500', '泉州市', '2', '350000');
INSERT INTO `ob_region` VALUES ('350600', '漳州市', '2', '350000');
INSERT INTO `ob_region` VALUES ('350700', '南平市', '2', '350000');
INSERT INTO `ob_region` VALUES ('350800', '龙岩市', '2', '350000');
INSERT INTO `ob_region` VALUES ('350900', '宁德市', '2', '350000');
INSERT INTO `ob_region` VALUES ('360100', '南昌市', '2', '360000');
INSERT INTO `ob_region` VALUES ('360200', '景德镇市', '2', '360000');
INSERT INTO `ob_region` VALUES ('360300', '萍乡市', '2', '360000');
INSERT INTO `ob_region` VALUES ('360400', '九江市', '2', '360000');
INSERT INTO `ob_region` VALUES ('360500', '新余市', '2', '360000');
INSERT INTO `ob_region` VALUES ('360600', '鹰潭市', '2', '360000');
INSERT INTO `ob_region` VALUES ('360700', '赣州市', '2', '360000');
INSERT INTO `ob_region` VALUES ('360800', '吉安市', '2', '360000');
INSERT INTO `ob_region` VALUES ('360900', '宜春市', '2', '360000');
INSERT INTO `ob_region` VALUES ('361000', '抚州市', '2', '360000');
INSERT INTO `ob_region` VALUES ('361100', '上饶市', '2', '360000');
INSERT INTO `ob_region` VALUES ('370100', '济南市', '2', '370000');
INSERT INTO `ob_region` VALUES ('370200', '青岛市', '2', '370000');
INSERT INTO `ob_region` VALUES ('370300', '淄博市', '2', '370000');
INSERT INTO `ob_region` VALUES ('370400', '枣庄市', '2', '370000');
INSERT INTO `ob_region` VALUES ('370500', '东营市', '2', '370000');
INSERT INTO `ob_region` VALUES ('370600', '烟台市', '2', '370000');
INSERT INTO `ob_region` VALUES ('370700', '潍坊市', '2', '370000');
INSERT INTO `ob_region` VALUES ('370800', '济宁市', '2', '370000');
INSERT INTO `ob_region` VALUES ('370900', '泰安市', '2', '370000');
INSERT INTO `ob_region` VALUES ('371000', '威海市', '2', '370000');
INSERT INTO `ob_region` VALUES ('371100', '日照市', '2', '370000');
INSERT INTO `ob_region` VALUES ('371200', '莱芜市', '2', '370000');
INSERT INTO `ob_region` VALUES ('371300', '临沂市', '2', '370000');
INSERT INTO `ob_region` VALUES ('371400', '德州市', '2', '370000');
INSERT INTO `ob_region` VALUES ('371500', '聊城市', '2', '370000');
INSERT INTO `ob_region` VALUES ('371600', '滨州市', '2', '370000');
INSERT INTO `ob_region` VALUES ('371700', '菏泽市', '2', '370000');
INSERT INTO `ob_region` VALUES ('410100', '郑州市', '2', '410000');
INSERT INTO `ob_region` VALUES ('410200', '开封市', '2', '410000');
INSERT INTO `ob_region` VALUES ('410300', '洛阳市', '2', '410000');
INSERT INTO `ob_region` VALUES ('410400', '平顶山市', '2', '410000');
INSERT INTO `ob_region` VALUES ('410500', '安阳市', '2', '410000');
INSERT INTO `ob_region` VALUES ('410600', '鹤壁市', '2', '410000');
INSERT INTO `ob_region` VALUES ('410700', '新乡市', '2', '410000');
INSERT INTO `ob_region` VALUES ('410800', '焦作市', '2', '410000');
INSERT INTO `ob_region` VALUES ('410900', '濮阳市', '2', '410000');
INSERT INTO `ob_region` VALUES ('411000', '许昌市', '2', '410000');
INSERT INTO `ob_region` VALUES ('411100', '漯河市', '2', '410000');
INSERT INTO `ob_region` VALUES ('411200', '三门峡市', '2', '410000');
INSERT INTO `ob_region` VALUES ('411300', '南阳市', '2', '410000');
INSERT INTO `ob_region` VALUES ('411400', '商丘市', '2', '410000');
INSERT INTO `ob_region` VALUES ('411500', '信阳市', '2', '410000');
INSERT INTO `ob_region` VALUES ('411600', '周口市', '2', '410000');
INSERT INTO `ob_region` VALUES ('411700', '驻马店市', '2', '410000');
INSERT INTO `ob_region` VALUES ('420100', '武汉市', '2', '420000');
INSERT INTO `ob_region` VALUES ('420200', '黄石市', '2', '420000');
INSERT INTO `ob_region` VALUES ('420300', '十堰市', '2', '420000');
INSERT INTO `ob_region` VALUES ('420500', '宜昌市', '2', '420000');
INSERT INTO `ob_region` VALUES ('420600', '襄樊市', '2', '420000');
INSERT INTO `ob_region` VALUES ('420700', '鄂州市', '2', '420000');
INSERT INTO `ob_region` VALUES ('420800', '荆门市', '2', '420000');
INSERT INTO `ob_region` VALUES ('420900', '孝感市', '2', '420000');
INSERT INTO `ob_region` VALUES ('421000', '荆州市', '2', '420000');
INSERT INTO `ob_region` VALUES ('421100', '黄冈市', '2', '420000');
INSERT INTO `ob_region` VALUES ('421200', '咸宁市', '2', '420000');
INSERT INTO `ob_region` VALUES ('421300', '随州市', '2', '420000');
INSERT INTO `ob_region` VALUES ('422800', '恩施土家族苗族自治州', '2', '420000');
INSERT INTO `ob_region` VALUES ('429000', '省直辖行政单位', '2', '420000');
INSERT INTO `ob_region` VALUES ('430100', '长沙市', '2', '430000');
INSERT INTO `ob_region` VALUES ('430200', '株洲市', '2', '430000');
INSERT INTO `ob_region` VALUES ('430300', '湘潭市', '2', '430000');
INSERT INTO `ob_region` VALUES ('430400', '衡阳市', '2', '430000');
INSERT INTO `ob_region` VALUES ('430500', '邵阳市', '2', '430000');
INSERT INTO `ob_region` VALUES ('430600', '岳阳市', '2', '430000');
INSERT INTO `ob_region` VALUES ('430700', '常德市', '2', '430000');
INSERT INTO `ob_region` VALUES ('430800', '张家界市', '2', '430000');
INSERT INTO `ob_region` VALUES ('430900', '益阳市', '2', '430000');
INSERT INTO `ob_region` VALUES ('431000', '郴州市', '2', '430000');
INSERT INTO `ob_region` VALUES ('431100', '永州市', '2', '430000');
INSERT INTO `ob_region` VALUES ('431200', '怀化市', '2', '430000');
INSERT INTO `ob_region` VALUES ('431300', '娄底市', '2', '430000');
INSERT INTO `ob_region` VALUES ('433100', '湘西土家族苗族自治州', '2', '430000');
INSERT INTO `ob_region` VALUES ('440100', '广州市', '2', '440000');
INSERT INTO `ob_region` VALUES ('440200', '韶关市', '2', '440000');
INSERT INTO `ob_region` VALUES ('440300', '深圳市', '2', '440000');
INSERT INTO `ob_region` VALUES ('440400', '珠海市', '2', '440000');
INSERT INTO `ob_region` VALUES ('440500', '汕头市', '2', '440000');
INSERT INTO `ob_region` VALUES ('440600', '佛山市', '2', '440000');
INSERT INTO `ob_region` VALUES ('440700', '江门市', '2', '440000');
INSERT INTO `ob_region` VALUES ('440800', '湛江市', '2', '440000');
INSERT INTO `ob_region` VALUES ('440900', '茂名市', '2', '440000');
INSERT INTO `ob_region` VALUES ('441200', '肇庆市', '2', '440000');
INSERT INTO `ob_region` VALUES ('441300', '惠州市', '2', '440000');
INSERT INTO `ob_region` VALUES ('441400', '梅州市', '2', '440000');
INSERT INTO `ob_region` VALUES ('441500', '汕尾市', '2', '440000');
INSERT INTO `ob_region` VALUES ('441600', '河源市', '2', '440000');
INSERT INTO `ob_region` VALUES ('441700', '阳江市', '2', '440000');
INSERT INTO `ob_region` VALUES ('441800', '清远市', '2', '440000');
INSERT INTO `ob_region` VALUES ('441900', '东莞市', '2', '440000');
INSERT INTO `ob_region` VALUES ('442000', '中山市', '2', '440000');
INSERT INTO `ob_region` VALUES ('445100', '潮州市', '2', '440000');
INSERT INTO `ob_region` VALUES ('445200', '揭阳市', '2', '440000');
INSERT INTO `ob_region` VALUES ('445300', '云浮市', '2', '440000');
INSERT INTO `ob_region` VALUES ('450100', '南宁市', '2', '450000');
INSERT INTO `ob_region` VALUES ('450200', '柳州市', '2', '450000');
INSERT INTO `ob_region` VALUES ('450300', '桂林市', '2', '450000');
INSERT INTO `ob_region` VALUES ('450400', '梧州市', '2', '450000');
INSERT INTO `ob_region` VALUES ('450500', '北海市', '2', '450000');
INSERT INTO `ob_region` VALUES ('450600', '防城港市', '2', '450000');
INSERT INTO `ob_region` VALUES ('450700', '钦州市', '2', '450000');
INSERT INTO `ob_region` VALUES ('450800', '贵港市', '2', '450000');
INSERT INTO `ob_region` VALUES ('450900', '玉林市', '2', '450000');
INSERT INTO `ob_region` VALUES ('451000', '百色市', '2', '450000');
INSERT INTO `ob_region` VALUES ('451100', '贺州市', '2', '450000');
INSERT INTO `ob_region` VALUES ('451200', '河池市', '2', '450000');
INSERT INTO `ob_region` VALUES ('451300', '来宾市', '2', '450000');
INSERT INTO `ob_region` VALUES ('451400', '崇左市', '2', '450000');
INSERT INTO `ob_region` VALUES ('460100', '海口市', '2', '460000');
INSERT INTO `ob_region` VALUES ('460200', '三亚市', '2', '460000');
INSERT INTO `ob_region` VALUES ('469000', '省直辖县级行政单位', '2', '460000');
INSERT INTO `ob_region` VALUES ('500100', '市辖区', '2', '500000');
INSERT INTO `ob_region` VALUES ('500200', '县', '2', '500000');
INSERT INTO `ob_region` VALUES ('500300', '市', '2', '500000');
INSERT INTO `ob_region` VALUES ('510100', '成都市', '2', '510000');
INSERT INTO `ob_region` VALUES ('510300', '自贡市', '2', '510000');
INSERT INTO `ob_region` VALUES ('510400', '攀枝花市', '2', '510000');
INSERT INTO `ob_region` VALUES ('510500', '泸州市', '2', '510000');
INSERT INTO `ob_region` VALUES ('510600', '德阳市', '2', '510000');
INSERT INTO `ob_region` VALUES ('510700', '绵阳市', '2', '510000');
INSERT INTO `ob_region` VALUES ('510800', '广元市', '2', '510000');
INSERT INTO `ob_region` VALUES ('510900', '遂宁市', '2', '510000');
INSERT INTO `ob_region` VALUES ('511000', '内江市', '2', '510000');
INSERT INTO `ob_region` VALUES ('511100', '乐山市', '2', '510000');
INSERT INTO `ob_region` VALUES ('511300', '南充市', '2', '510000');
INSERT INTO `ob_region` VALUES ('511400', '眉山市', '2', '510000');
INSERT INTO `ob_region` VALUES ('511500', '宜宾市', '2', '510000');
INSERT INTO `ob_region` VALUES ('511600', '广安市', '2', '510000');
INSERT INTO `ob_region` VALUES ('511700', '达州市', '2', '510000');
INSERT INTO `ob_region` VALUES ('511800', '雅安市', '2', '510000');
INSERT INTO `ob_region` VALUES ('511900', '巴中市', '2', '510000');
INSERT INTO `ob_region` VALUES ('512000', '资阳市', '2', '510000');
INSERT INTO `ob_region` VALUES ('513200', '阿坝藏族羌族自治州', '2', '510000');
INSERT INTO `ob_region` VALUES ('513300', '甘孜藏族自治州', '2', '510000');
INSERT INTO `ob_region` VALUES ('513400', '凉山彝族自治州', '2', '510000');
INSERT INTO `ob_region` VALUES ('520100', '贵阳市', '2', '520000');
INSERT INTO `ob_region` VALUES ('520200', '六盘水市', '2', '520000');
INSERT INTO `ob_region` VALUES ('520300', '遵义市', '2', '520000');
INSERT INTO `ob_region` VALUES ('520400', '安顺市', '2', '520000');
INSERT INTO `ob_region` VALUES ('522200', '铜仁地区', '2', '520000');
INSERT INTO `ob_region` VALUES ('522300', '黔西南布依族苗族自治州', '2', '520000');
INSERT INTO `ob_region` VALUES ('522400', '毕节地区', '2', '520000');
INSERT INTO `ob_region` VALUES ('522600', '黔东南苗族侗族自治州', '2', '520000');
INSERT INTO `ob_region` VALUES ('522700', '黔南布依族苗族自治州', '2', '520000');
INSERT INTO `ob_region` VALUES ('530100', '昆明市', '2', '530000');
INSERT INTO `ob_region` VALUES ('530300', '曲靖市', '2', '530000');
INSERT INTO `ob_region` VALUES ('530400', '玉溪市', '2', '530000');
INSERT INTO `ob_region` VALUES ('530500', '保山市', '2', '530000');
INSERT INTO `ob_region` VALUES ('530600', '昭通市', '2', '530000');
INSERT INTO `ob_region` VALUES ('530700', '丽江市', '2', '530000');
INSERT INTO `ob_region` VALUES ('530800', '思茅市', '2', '530000');
INSERT INTO `ob_region` VALUES ('530900', '临沧市', '2', '530000');
INSERT INTO `ob_region` VALUES ('532300', '楚雄彝族自治州', '2', '530000');
INSERT INTO `ob_region` VALUES ('532500', '红河哈尼族彝族自治州', '2', '530000');
INSERT INTO `ob_region` VALUES ('532600', '文山壮族苗族自治州', '2', '530000');
INSERT INTO `ob_region` VALUES ('532800', '西双版纳傣族自治州', '2', '530000');
INSERT INTO `ob_region` VALUES ('532900', '大理白族自治州', '2', '530000');
INSERT INTO `ob_region` VALUES ('533100', '德宏傣族景颇族自治州', '2', '530000');
INSERT INTO `ob_region` VALUES ('533300', '怒江傈僳族自治州', '2', '530000');
INSERT INTO `ob_region` VALUES ('533400', '迪庆藏族自治州', '2', '530000');
INSERT INTO `ob_region` VALUES ('540100', '拉萨市', '2', '540000');
INSERT INTO `ob_region` VALUES ('542100', '昌都地区', '2', '540000');
INSERT INTO `ob_region` VALUES ('542200', '山南地区', '2', '540000');
INSERT INTO `ob_region` VALUES ('542300', '日喀则地区', '2', '540000');
INSERT INTO `ob_region` VALUES ('542400', '那曲地区', '2', '540000');
INSERT INTO `ob_region` VALUES ('542500', '阿里地区', '2', '540000');
INSERT INTO `ob_region` VALUES ('542600', '林芝地区', '2', '540000');
INSERT INTO `ob_region` VALUES ('610100', '西安市', '2', '610000');
INSERT INTO `ob_region` VALUES ('610200', '铜川市', '2', '610000');
INSERT INTO `ob_region` VALUES ('610300', '宝鸡市', '2', '610000');
INSERT INTO `ob_region` VALUES ('610400', '咸阳市', '2', '610000');
INSERT INTO `ob_region` VALUES ('610500', '渭南市', '2', '610000');
INSERT INTO `ob_region` VALUES ('610600', '延安市', '2', '610000');
INSERT INTO `ob_region` VALUES ('610700', '汉中市', '2', '610000');
INSERT INTO `ob_region` VALUES ('610800', '榆林市', '2', '610000');
INSERT INTO `ob_region` VALUES ('610900', '安康市', '2', '610000');
INSERT INTO `ob_region` VALUES ('611000', '商洛市', '2', '610000');
INSERT INTO `ob_region` VALUES ('620100', '兰州市', '2', '620000');
INSERT INTO `ob_region` VALUES ('620200', '嘉峪关市', '2', '620000');
INSERT INTO `ob_region` VALUES ('620300', '金昌市', '2', '620000');
INSERT INTO `ob_region` VALUES ('620400', '白银市', '2', '620000');
INSERT INTO `ob_region` VALUES ('620500', '天水市', '2', '620000');
INSERT INTO `ob_region` VALUES ('620600', '武威市', '2', '620000');
INSERT INTO `ob_region` VALUES ('620700', '张掖市', '2', '620000');
INSERT INTO `ob_region` VALUES ('620800', '平凉市', '2', '620000');
INSERT INTO `ob_region` VALUES ('620900', '酒泉市', '2', '620000');
INSERT INTO `ob_region` VALUES ('621000', '庆阳市', '2', '620000');
INSERT INTO `ob_region` VALUES ('621100', '定西市', '2', '620000');
INSERT INTO `ob_region` VALUES ('621200', '陇南市', '2', '620000');
INSERT INTO `ob_region` VALUES ('622900', '临夏回族自治州', '2', '620000');
INSERT INTO `ob_region` VALUES ('623000', '甘南藏族自治州', '2', '620000');
INSERT INTO `ob_region` VALUES ('630100', '西宁市', '2', '630000');
INSERT INTO `ob_region` VALUES ('632100', '海东地区', '2', '630000');
INSERT INTO `ob_region` VALUES ('632200', '海北藏族自治州', '2', '630000');
INSERT INTO `ob_region` VALUES ('632300', '黄南藏族自治州', '2', '630000');
INSERT INTO `ob_region` VALUES ('632500', '海南藏族自治州', '2', '630000');
INSERT INTO `ob_region` VALUES ('632600', '果洛藏族自治州', '2', '630000');
INSERT INTO `ob_region` VALUES ('632700', '玉树藏族自治州', '2', '630000');
INSERT INTO `ob_region` VALUES ('632800', '海西蒙古族藏族自治州', '2', '630000');
INSERT INTO `ob_region` VALUES ('640100', '银川市', '2', '640000');
INSERT INTO `ob_region` VALUES ('640200', '石嘴山市', '2', '640000');
INSERT INTO `ob_region` VALUES ('640300', '吴忠市', '2', '640000');
INSERT INTO `ob_region` VALUES ('640400', '固原市', '2', '640000');
INSERT INTO `ob_region` VALUES ('640500', '中卫市', '2', '640000');
INSERT INTO `ob_region` VALUES ('650100', '乌鲁木齐市', '2', '650000');
INSERT INTO `ob_region` VALUES ('650200', '克拉玛依市', '2', '650000');
INSERT INTO `ob_region` VALUES ('652100', '吐鲁番地区', '2', '650000');
INSERT INTO `ob_region` VALUES ('652200', '哈密地区', '2', '650000');
INSERT INTO `ob_region` VALUES ('652300', '昌吉回族自治州', '2', '650000');
INSERT INTO `ob_region` VALUES ('652700', '博尔塔拉蒙古自治州', '2', '650000');
INSERT INTO `ob_region` VALUES ('652800', '巴音郭楞蒙古自治州', '2', '650000');
INSERT INTO `ob_region` VALUES ('652900', '阿克苏地区', '2', '650000');
INSERT INTO `ob_region` VALUES ('653000', '克孜勒苏柯尔克孜自治州', '2', '650000');
INSERT INTO `ob_region` VALUES ('653100', '喀什地区', '2', '650000');
INSERT INTO `ob_region` VALUES ('653200', '和田地区', '2', '650000');
INSERT INTO `ob_region` VALUES ('654000', '伊犁哈萨克自治州', '2', '650000');
INSERT INTO `ob_region` VALUES ('654200', '塔城地区', '2', '650000');
INSERT INTO `ob_region` VALUES ('654300', '阿勒泰地区', '2', '650000');
INSERT INTO `ob_region` VALUES ('659000', '省直辖行政单位', '2', '650000');
INSERT INTO `ob_region` VALUES ('110101', '东城区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110102', '西城区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110103', '崇文区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110104', '宣武区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110105', '朝阳区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110106', '丰台区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110107', '石景山区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110108', '海淀区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110109', '门头沟区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110111', '房山区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110112', '通州区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110113', '顺义区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110114', '昌平区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110115', '大兴区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110116', '怀柔区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110117', '平谷区', '3', '110100');
INSERT INTO `ob_region` VALUES ('110228', '密云县', '3', '110200');
INSERT INTO `ob_region` VALUES ('110229', '延庆县', '3', '110200');
INSERT INTO `ob_region` VALUES ('120101', '和平区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120102', '河东区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120103', '河西区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120104', '南开区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120105', '河北区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120106', '红桥区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120107', '塘沽区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120108', '汉沽区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120109', '大港区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120110', '东丽区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120111', '西青区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120112', '津南区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120113', '北辰区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120114', '武清区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120115', '宝坻区', '3', '120100');
INSERT INTO `ob_region` VALUES ('120221', '宁河县', '3', '120200');

-- ----------------------------
-- Table structure for `ob_seo`
-- ----------------------------
DROP TABLE IF EXISTS `ob_seo`;
CREATE TABLE `ob_seo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `url` varchar(40) NOT NULL DEFAULT '' COMMENT '模块',
  `seo_title` text NOT NULL COMMENT '标题',
  `seo_keywords` text NOT NULL COMMENT '关键字',
  `seo_description` text NOT NULL COMMENT '描述',
  `usable_val` varchar(255) NOT NULL DEFAULT '' COMMENT '可用变量',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='seo表';

-- ----------------------------
-- Records of ob_seo
-- ----------------------------
INSERT INTO `ob_seo` VALUES ('1', '文章详情页', 'home', '文章详情-{$info.title}', '文章详情-关键字', '文章详情-描述', '', '1', '-1', '0', '1505447057');
INSERT INTO `ob_seo` VALUES ('5', '首页', 'home', '首页标题', '首页关键字', '首页描述', '', '2', '-1', '0', '1505447062');
INSERT INTO `ob_seo` VALUES ('40', '首页SEO信息', 'index/index/index', 'OneBase 开发架构{$category_name}{$article_title}', 'OneBase,PHP,{$category_name},{$article_title}', '一款基于ThinkPHP5研发的开源免费基础架构，基于OneBase可以快速的研发各类Web应用。{$article_describe}', '{$category_name}，{$article_title}，{$article_describe}', '0', '1', '1505445912', '1505470293');
INSERT INTO `ob_seo` VALUES ('41', 'OneBase-系统登录', 'index/index/login', 'OneBase', 'OneBase', 'OneBase', '', '0', '1', '1505538002', '1505538026');
