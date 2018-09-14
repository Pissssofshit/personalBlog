DROP DATABASE IF EXISTS `pop`;
CREATE DATABASE `pop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

GRANT all ON pop.* TO 'pop_user'@'%' IDENTIFIED BY 'pop_password';

USE `pop`;

DROP TABLE IF EXISTS `rem_account`;
CREATE TABLE `rem_account` (
    `account_id` int(10) unsigned NOT NULL  auto_increment comment '账号ID',
    `account_name` varchar(40) NOT NULL   comment '账号名称',
    `account_url` varchar(255)  default 'new_p.ledu.com'  comment '账号域名',
    `company_id` int(10) unsigned NOT NULL   comment '公司id', 
    PRIMARY KEY  (`account_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='账号列表' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `rem_game`;
CREATE TABLE `rem_game` (
    `game_id` int(10) unsigned NOT NULL  auto_increment comment '游戏ID',
    `partner_id` int(10) unsigned NOT NULL   comment '平台ID',
    `game_name` varchar(40) NOT NULL   comment '游戏名',
    `state` boolean NOT NULL default '0'  comment '是否启用',
    `category_id` int(4) unsigned NOT NULL   comment '类型',
    `game_url` varchar(255) NOT NULL   comment '官网地址/包地址',
    `new_server` int(4) unsigned NOT NULL   comment '是否最新服', 
    PRIMARY KEY  (`game_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='游戏列表' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `rem_site`;
CREATE TABLE `rem_site` (
    `site_id` int(10) unsigned NOT NULL  auto_increment comment '站点ID',
    `channel_id` int(10) unsigned NOT NULL   comment '渠道ID',
    `site_name` varchar(40) NOT NULL   comment '站点名',
    `state` boolean NOT NULL default '0'  comment '是否启用',
    `category_id` int(4) unsigned NOT NULL   comment '类型',
    `pay_way_id` int(4) unsigned NOT NULL   comment '结算方式',
    `describe` varchar(100) NOT NULL   comment '具体描述', 
    PRIMARY KEY  (`site_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='站点列表' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `cfg_category`;
CREATE TABLE `cfg_category` (
    `category_id` int(4) unsigned NOT NULL  auto_increment comment '类型ID',
    `category_name` varchar(20) NOT NULL   comment '类型名', 
    PRIMARY KEY  (`category_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='类型定义' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `rem_plan`;
CREATE TABLE `rem_plan` (
    `plan_id` int(10) unsigned NOT NULL  auto_increment comment '计划ID',
    `plan_name` varchar(40) NOT NULL   comment '计划名',
    `account_id` int(10) unsigned NOT NULL   comment '账号id',
    `game_id` int(10) unsigned NOT NULL   comment '游戏id',
    `site_id` int(10) unsigned NOT NULL   comment '站点id',
    `state` int(4) unsigned NOT NULL default '1'  comment '状态',
    `is_1st` int(2) unsigned NOT NULL default '0'  comment '是否启用过',
    `category_id` int(4) unsigned NOT NULL   comment '类型',
    `mode_id` int(4) unsigned NOT NULL   comment '推广方式',
    `created_time` int(10) unsigned    comment '创建时间',
    `updated_time` int(10) unsigned    comment '更新时间', 
    PRIMARY KEY  (`plan_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='类型定义' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `cfg_mode`;
CREATE TABLE `cfg_mode` (
    `mode_id` int(4) unsigned NOT NULL  auto_increment comment '推广方式ID',
    `mode_name` varchar(30) NOT NULL   comment '推广方式', 
    PRIMARY KEY  (`mode_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='推广方式定义' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `sys_plan_material`;
CREATE TABLE `sys_plan_material` (
    `id` int(10) unsigned NOT NULL  auto_increment comment '没用的主键',
    `plan_id` int(10) unsigned NOT NULL   comment '计划id',
    `material_id` int(10) unsigned NOT NULL   comment '素材id',
    `weight` int(10) unsigned NOT NULL   comment '权重', 
    PRIMARY KEY  (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='计划素材关联' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `rem_channel`;
CREATE TABLE `rem_channel` (
    `channel_id` int(10) unsigned NOT NULL  auto_increment comment '渠道ID',
    `channel_name` varchar(40) NOT NULL   comment '渠道名',
    `category_id` int(4) unsigned NOT NULL   comment '类型',
    `state` boolean NOT NULL default '0'  comment '是否启用',
    `callback_url` varchar(255) NOT NULL   comment '回调地址', 
    PRIMARY KEY  (`channel_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='渠道列表' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `cfg_pay_way`;
CREATE TABLE `cfg_pay_way` (
    `id` int(4) unsigned NOT NULL  auto_increment comment '结算方式ID',
    `name` varchar(30) NOT NULL   comment '结算方式', 
    PRIMARY KEY  (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='结算方式定义' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `sys_account_site`;
CREATE TABLE `sys_account_site` (
    `id` int(10) unsigned NOT NULL  auto_increment comment '没用的主键',
    `account_id` int(10) unsigned NOT NULL   comment '账号id',
    `site_id` int(10) unsigned NOT NULL   comment '站点id', 
    PRIMARY KEY  (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='账号站点关联' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `rem_channel_type`;
CREATE TABLE `rem_channel_type` (
    `id` int(10) unsigned NOT NULL  auto_increment comment 'id',
    `name` varchar(40) NOT NULL   comment '类型名',
    `state` boolean NOT NULL default '0'  comment '是否启用',
    `describe` varchar(100) NOT NULL   comment '具体描述', 
    PRIMARY KEY  (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='渠道类型列表' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `sys_channel_channeltype`;
CREATE TABLE `sys_channel_channeltype` (
    `id` int(10) unsigned NOT NULL  auto_increment comment '没用的主键',
    `channel_id` int(10) unsigned NOT NULL   comment '渠道id',
    `channel_type_id` int(10) unsigned NOT NULL   comment '类型id', 
    PRIMARY KEY  (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='渠道类型关联' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `id` int(10) unsigned NOT NULL  auto_increment comment '没用的主键',
    `uid` int(10) unsigned NOT NULL   comment '平台ID',
    `passport` varchar(40) NOT NULL   comment '平台账号名',
    `partner_id` int(10) unsigned NOT NULL   comment '平台ID',
    `plan_id` int(10) unsigned NOT NULL   comment '计划id',
    `account_id` int(10) unsigned NOT NULL   comment '账号id',
    `game_id` int(10) unsigned NOT NULL   comment '游戏id',
    `material_id` int(10) unsigned NOT NULL   comment '素材id',
    `site_id` int(10) unsigned NOT NULL   comment '站点id',
    `is_role` boolean NOT NULL default '0'  comment '是否创角',
    `is_reg` boolean NOT NULL default '1'  comment '是否新注册用户',
    `reg_time` int(10) unsigned NOT NULL   comment '注册时间',
    `subsist_sign` varchar(100) NOT NULL   comment '留存标记',
    `category_id` int(4) unsigned NOT NULL   comment '类型', 
    PRIMARY KEY  (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `cfg_subsist_sign`;
CREATE TABLE `cfg_subsist_sign` (
    `subsist_day` int(10) unsigned NOT NULL  auto_increment comment '第n日留存',
    `subsist_num` varchar(100) NOT NULL   comment '对应标记', 
    PRIMARY KEY  (`subsist_day`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='留存标记' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `rem_partner`;
CREATE TABLE `rem_partner` (
    `partner_id` int(10) unsigned NOT NULL  auto_increment comment '平台id',
    `partner_name` varchar(40) NOT NULL   comment '平台名',
    `check_url` varchar(255) NOT NULL default 'http://pass.ledu.com/api/check/username?username={passport}'  comment '账号注册检查链接',
    `reg_url` varchar(255) NOT NULL default 'http://p.ledu.com/service_user/reg?username={passport}#password={pwd}#fromwd={fromwd}'  comment '账号注册链接',
    `login_url` varchar(255) NOT NULL default 'http://p.ledu.com/service_user/login?username={passport}#password={pwd}#fromwd={fromwd}'  comment '账号登录链接',
    `search_url` varchar(255) NOT NULL default 'http://act.xdwan.com/api/userinfo/userinfo/user_id/{uid}/server_id/{serverId}/game_id/{game_id}/y_id/{y_id}'  comment '账号查询链接',
    `server_url` varchar(255)    comment '获取服务器列表链接',
    `cdn_url` varchar(255)  default 'http://pop.img.ledu.com'  comment '素材链接', 
    PRIMARY KEY  (`partner_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='平台列表' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `rem_company`;
CREATE TABLE `rem_company` (
    `company_id` int(10) unsigned NOT NULL  auto_increment comment '公司ID',
    `company_name` varchar(40) NOT NULL   comment '公司名', 
    PRIMARY KEY  (`company_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='公司列表' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `rem_plan_append`;
CREATE TABLE `rem_plan_append` (
    `plan_id` int(10) unsigned NOT NULL  auto_increment comment '计划ID',
    `ios_game_id` int(10) unsigned NOT NULL   comment 'ios游戏id',
    `re_yun_url` varchar(255)    comment '热云url',
    `package_url` varchar(255)    comment '渠道包地址',
    `version` varchar(40) NOT NULL   comment '版本号',
    `status` int(4) unsigned NOT NULL default '0'  comment '打包状态',
    `count_down` int(4) unsigned NOT NULL default '0'  comment '倒计时', 
    PRIMARY KEY  (`plan_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='类型定义' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `channel_callback`;
CREATE TABLE `channel_callback` (
    `id` int(10) unsigned NOT NULL  auto_increment comment '没用的主键',
    `uid` int(10) unsigned NOT NULL   comment '平台ID',
    `passport` varchar(40) NOT NULL   comment '平台账号名',
    `partner_id` int(10) unsigned NOT NULL   comment '平台ID',
    `game_id` int(10) unsigned NOT NULL   comment '游戏id',
    `server_id` int(10) unsigned NOT NULL   comment '服id',
    `site_id` int(10) unsigned NOT NULL   comment '站点id',
    `res` varchar(255)    comment '回调参数值',
    `info` varchar(255)    comment '回调返回值',
    `insert_time` int(10) unsigned NOT NULL   comment '插入时间',
    `notice_time` int(10) unsigned NOT NULL   comment '回调时间', 
    PRIMARY KEY  (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='页游渠道回调' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `pay_log`;
CREATE TABLE `pay_log` (
    `id` int(10) unsigned NOT NULL  auto_increment comment '没用的主键',
    `order_id` varchar(32) NOT NULL   comment '订单号',
    `uid` int(10) unsigned NOT NULL   comment '平台ID',
    `partner_id` int(10) unsigned NOT NULL   comment '平台ID',
    `game_id` int(10) unsigned NOT NULL   comment '游戏id',
    `server_id` int(10) unsigned NOT NULL   comment '服id',
    `site_id` int(10) unsigned NOT NULL   comment '站点id',
    `reg_time` int(10) unsigned NOT NULL   comment '注册时间',
    `pay_time` int(10) unsigned NOT NULL   comment '充值时间',
    `pay_money` int(10) unsigned NOT NULL   comment '类型',
    `is_1st_pay` int(2) unsigned NOT NULL default '0'  comment '首充', 
    PRIMARY KEY  (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='充值订单表' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
    `id` int(10) unsigned NOT NULL  auto_increment comment '没用的主键',
    `type_alias` varchar(40) NOT NULL   comment '渠道回调方法名',
    `partner_id` int(10) unsigned NOT NULL   comment '平台ID',
    `plan_id` int(10) unsigned NOT NULL   comment '计划id',
    `game_id` int(10) unsigned NOT NULL   comment '游戏id',
    `site_id` int(10) unsigned NOT NULL   comment '站点id',
    `click_id` varchar(255)    comment '设备号',
    `category_id` int(4) unsigned NOT NULL   comment '设备类型',
    `ip` varchar(32)    comment 'ip',
    `callback_url` varchar(255)    comment '回调链接',
    `insert_time` int(10) unsigned NOT NULL   comment '插入时间',
    `notice_time` int(10) unsigned NOT NULL   comment '回调时间',
    `match_time` int(10) unsigned NOT NULL   comment '匹配时间', 
    PRIMARY KEY  (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='手游渠道回调' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `rem_company`;
CREATE TABLE `rem_company` (
    `id` int(10) unsigned NOT NULL  auto_increment comment '没用的主键',
    `type_alias` varchar(40) NOT NULL   comment '渠道回调方法名',
    `channel_id` int(10) unsigned NOT NULL   comment '渠道ID', 
    PRIMARY KEY  (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='公司列表' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `day_plan_cost`;
CREATE TABLE `day_plan_cost` (
    `id` int(10) unsigned NOT NULL  auto_increment comment '没用的主键',
    `day_time` int(10) unsigned NOT NULL   comment '成本所属时间戳',
    `day_date` varchar(10) NOT NULL   comment '成本所属日期',
    `plan_id` int(10) unsigned NOT NULL   comment '计划id',
    `account_id` int(10) unsigned NOT NULL   comment '账号id',
    `game_id` int(10) unsigned NOT NULL   comment '游戏id',
    `site_id` int(10) unsigned NOT NULL   comment '站点id',
    `cost` float(30,2) NOT NULL   comment '游戏币成本',
    `rmb_cost` float(30,2) NOT NULL   comment '人民币成本',
    `rate` float(3,2) NOT NULL   comment '币单价',
    `create_by` varchar(255)    comment '提交者',
    `pass_by` varchar(255)    comment '通过者',
    `is_passed` int(2) unsigned NOT NULL default '0'  comment '是否已经通过',
    `created_time` int(10) unsigned    comment '创建时间',
    `pass_time` int(10) unsigned    comment '通过时间', 
    PRIMARY KEY  (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='成本提交表' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `power_user`;
CREATE TABLE `power_user` (
    `power_user_id` int(10) unsigned NOT NULL  auto_increment comment 'ID编号',
    `power_user_name` char(30) NOT NULL   comment '用户帐号',
    `truename` char(30) NOT NULL   comment '真实姓名',
    `password` char(32) NOT NULL   comment '密码',
    `power_role_id` int(10) NOT NULL   comment '角色类型',
    `created_time` int(10) unsigned    comment '创建时间', 
    PRIMARY KEY  (`power_user_id`), 
    KEY fk_user_role(`power_role_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户管理' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `power_role`;
CREATE TABLE `power_role` (
    `power_role_id` int(10) unsigned NOT NULL  auto_increment comment 'ID编号',
    `power_role_name` char(30) NOT NULL   comment '角色名称',
    `content` text    comment '角色权限内容',
    `company_ids` varchar(500) NOT NULL   comment '可浏览公司',
    `created_time` int(10) unsigned    comment '创建时间', 
    PRIMARY KEY  (`power_role_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色管理' AUTO_INCREMENT=1;