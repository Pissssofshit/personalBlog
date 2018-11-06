DROP DATABASE IF EXISTS `h5yun`;
CREATE DATABASE `h5yun` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

GRANT all ON h5yun.* TO 'yun_h5'@'%' IDENTIFIED BY 'yun_h5';

USE `h5yun`;

DROP TABLE IF EXISTS `h5_cp_game`;
CREATE TABLE `h5_cp_game` (
    `game_id` int(11) NOT NULL  auto_increment comment '自增id',
    `game_name` varchar(50) NOT NULL   comment '游戏名',
    `game_en_name` varchar(20)  default ''  comment '游戏拼音简写',
    `game_developer` varchar(50)  default ''  comment '游戏研发商',
    `login_url` varchar(255)  default ''  comment '游戏登陆接口地址',
    `pay_url` varchar(255)  default ''  comment '游戏充值接口地址',
    `login_key` varchar(100)  default ''  comment '登陆秘钥',
    `pay_key` varchar(100)  default ''  comment '充值秘钥',
    `create_time` int(11)  default '0'  comment '创建时间',
    `update_time` int(11)  default '0'  comment '更新时间',
    `operation_state` int(2)  default '1'  comment '运营状态:1正常，2下线',
    `game_rate` int(11)  default '1'  comment '游戏兑换比例:1元兑换多少游戏币',
    `login_https_url` varchar(255)  default ''  comment '游戏登陆接口:https地址',
    `entry_url` varchar(255)  default ''  comment '游戏入口地址', 
    PRIMARY KEY  (`game_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CP游戏' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `h5_gm_pt_appid_relation`;
CREATE TABLE `h5_gm_pt_appid_relation` (
    `id` int(11) NOT NULL  auto_increment comment '自增id',
    `platform_id` int(11) NOT NULL   comment '平台id',
    `game_id` int(11) NOT NULL   comment '游戏id',
    `operation_state` int(2)  default '1'  comment '运营状态:1正常，2下线',
    `create_time` int(11)  default '0'  comment '创建时间',
    `update_time` int(11)  default '0'  comment '更新时间',
    `game_plat_key` varchar(255)  default ''  comment '游戏平台key',
    `game_plat_id` varchar(32)  default ''  comment '游戏平台id',
    `game_entry_url` varchar(255)  default 'NULL'  comment '游戏入口地址',
    `platform_ext` varchar(255)  default ''  comment '平台特殊字段',
    `game_plat_pay_key` varchar(255)  default 'NULL'  comment '游戏平台支付key',
    `pay_public_key` text    comment '支付公钥',
    `pay_private_key` text    comment '支付私钥', 
    PRIMARY KEY  (`id`), 
    KEY fk_game_id(`game_id`), 
    KEY fk_platform_id(`platform_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='游戏平台分包关联表' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `h5_gm_pt_relation`;
CREATE TABLE `h5_gm_pt_relation` (
    `id` int(11) NOT NULL  auto_increment comment '自增id',
    `platform_id` int(11) NOT NULL   comment '平台id',
    `game_id` int(11) NOT NULL   comment '游戏id',
    `operation_state` int(2)  default '1'  comment '运营状态:1正常，2下线',
    `create_time` int(11)  default '0'  comment '创建时间',
    `update_time` int(11)  default '0'  comment '更新时间',
    `game_plat_key` varchar(255)  default ''  comment '游戏平台key',
    `game_plat_id` varchar(32)  default ''  comment '游戏平台id',
    `game_entry_url` varchar(255)  default 'NULL'  comment '游戏入口地址',
    `platform_ext` varchar(255)  default ''  comment '平台特殊字段',
    `game_plat_pay_key` varchar(255)  default 'NULL'  comment '游戏平台支付key',
    `pay_public_key` text    comment '支付公钥',
    `pay_private_key` text    comment '支付私钥',
    `is_charge` int(2)  default '1'  comment '是否开启充值', 
    PRIMARY KEY  (`id`), 
    KEY fk_game_id(`game_id`), 
    KEY fk_platform_id(`platform_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='平台游戏配置' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `h5_yun_active`;
CREATE TABLE `h5_yun_active` (
    `yun_uid` int(11) NOT NULL   comment '用户id',
    `game_id` int(11) NOT NULL default '0'  comment '游戏id',
    `platform_id` int(11)  default '0'  comment '平台id',
    `platform_user_id` varchar(50)  default ''  comment '用户id',
    `platform_user_name` varchar(100)  default ''  comment '用户名',
    `first_login_time` int(11)  default '0'  comment '游戏首次激活时间',
    `last_login_time` int(11)  default '0'  comment '最后登陆时间',
    `first_pay_time` int(11)  default '0'  comment '游戏首次充值时间',
    `last_pay_time` int(11)  default '0'  comment '最后充值时间',
    `first_login_ip` varchar(30)  default ''  comment '首次登陆ip',
    `last_login_ip` varchar(30)  default ''  comment '最后一次登陆ip', 
    PRIMARY KEY  (`yun_uid`), 
    KEY fk_game_id(`game_id`), 
    KEY fk_platform_id(`platform_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户激活' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `h5_yun_login_log`;
CREATE TABLE `h5_yun_login_log` (
    `id` int(11) NOT NULL  auto_increment comment '自增id',
    `game_id` int(11)  default '0'  comment '游戏id',
    `platform_id` int(11)  default '0'  comment '平台id',
    `platform_user_id` varchar(50)  default ''  comment '用户id',
    `platform_user_name` varchar(100)  default ''  comment '用户名',
    `login_time` int(11)  default '0'  comment '游戏首次激活时间',
    `login_ip` varchar(30)  default ''  comment '首次登陆ip',
    `yun_uid` int(11)  default '0'  comment 'yun uid', 
    PRIMARY KEY  (`id`), 
    KEY fk_game_id(`game_id`), 
    KEY fk_platform_id(`platform_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户登陆' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `h5_yun_order`;
CREATE TABLE `h5_yun_order` (
    `order_id` int(11) NOT NULL  auto_increment comment '自增id',
    `yun_uid` int(11)  default '0'  comment '云用户id',
    `game_id` int(11)  default '0'  comment '游戏id',
    `platform_id` int(11)  default '0'  comment '平台id',
    `platform_user_id` varchar(50)  default ''  comment '用户id',
    `platform_user_name` varchar(100)  default ''  comment '用户名',
    `money` int(11)  default '0.00'  comment '充值金额',
    `coin` int(11)  default '0.00'  comment '充值游戏币',
    `free_coin` int(11)  default '0'  comment '赠送游戏币',
    `pay_time` int(11)  default '0'  comment '游戏充值时间',
    `pay_ip` varchar(30)  default ''  comment '充值ip',
    `pay_status` int(2)  default '0'  comment '支付状态:0创建，1成功，2失败',
    `update_time` int(11)  default '0'  comment '订单更新时间',
    `server_id` varchar(100)  default ''  comment '游戏服标记',
    `game_order_id` varchar(50)  default ''  comment '游戏订单号',
    `role_name` varchar(50)  default ''  comment '游戏角色名',
    `platform_order_id` varchar(50)  default ''  comment '平台订单号',
    `game_extra` varchar(255)  default ''  comment '游戏额外参数，原样回传游戏', 
    PRIMARY KEY  (`order_id`), 
    KEY fk_game_id(`game_id`), 
    KEY fk_platform_id(`platform_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='充值订单' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `h5_yun_platform`;
CREATE TABLE `h5_yun_platform` (
    `platform_id` int(11) NOT NULL  auto_increment comment '自增id',
    `platform_name` varchar(50) NOT NULL   comment '平台名称',
    `platform_url` varchar(255)  default ''  comment '平台地址',
    `platform_key` varchar(100)  default ''  comment '通信密钥',
    `create_time` int(11)  default '0'  comment '创建时间',
    `update_time` int(11)  default '0'  comment '更新时间',
    `pay_white_ips` varchar(255)  default ''  comment '充值ip白名单:逗号隔开，为空则只能127.0.0.1能访问',
    `operation_state` int(2)  default '1'  comment '运营状态:1正常，2下线',
    `is_sign` int(1)  default '1'  comment '是否验证签名',
    `platform_en_name` varchar(32)  default 'NULL'  comment '平台简称', 
    PRIMARY KEY  (`platform_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='平台' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `h5_yun_share_log`;
CREATE TABLE `h5_yun_share_log` (
    `id` int(11) NOT NULL  auto_increment comment '自增id',
    `game_id` int(11)  default '0'  comment '游戏id',
    `platform_id` int(11)  default '0'  comment '平台id',
    `platform_user_id` varchar(50)  default ''  comment '用户id',
    `platform_user_name` varchar(100)  default ''  comment '用户名',
    `yun_uid` int(11)  default '0'  comment 'yun uid',
    `share_title` varchar(255)  default ''  comment '分享标题',
    `share_desc` varchar(255)  default ''  comment '分享描述',
    `share_path` varchar(255)  default ''  comment '分享路径',
    `share_img` varchar(255)  default ''  comment '分享图片地址',
    `create_time` int(11)  default '0'  comment '分享时间',
    `share_ip` varchar(30)  default ''  comment '分享ip',
    `share_brand` varchar(255)  default ''  comment '手机品牌',
    `share_model` varchar(255)  default ''  comment '手机型号',
    `share_version` varchar(255)  default ''  comment '微信版本号',
    `share_system` varchar(255)  default ''  comment '手机系统版本号',
    `share_platform` varchar(255)  default ''  comment '客户端平台',
    `share_network` varchar(255)  default ''  comment '网络类型',
    `share_scene` varchar(255)  default ''  comment '分享场景',
    `share_sdk_version` varchar(20)  default ''  comment 'sdk版本号', 
    PRIMARY KEY  (`id`), 
    KEY fk_game_id(`game_id`), 
    KEY fk_platform_id(`platform_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分享日志' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `h5_yun_user`;
CREATE TABLE `h5_yun_user` (
    `yun_uid` int(11) NOT NULL  auto_increment comment '自增id',
    `platform_id` int(11)  default '0'  comment '平台id',
    `platform_user_id` varchar(50)  default ''  comment '平台用户id',
    `platform_user_name` varchar(100)  default ''  comment '平台用户名',
    `create_time` int(11)  default '0'  comment '创建时间', 
    PRIMARY KEY  (`yun_uid`), 
    KEY fk_platform_id(`platform_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='注册用户' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `h5_yun_user_ad`;
CREATE TABLE `h5_yun_user_ad` (
    `id` int(11) NOT NULL  auto_increment comment '自增id',
    `game_id` int(11)  default '0'  comment '游戏id',
    `platform_id` int(11)  default '0'  comment '平台id',
    `platform_user_id` varchar(50)  default ''  comment '平台用户id',
    `watch_time` int(11)  default '0'  comment '创建时间',
    `is_ended` int(11)  default '0'  comment '观看是否完整:0不完整,1完整,2banner广告',
    `ad_type` int(11)  default '0'  comment '广告类型：1是banner，2是video',
    `ad_unit` varchar(255)  default ''  comment '广告ID', 
    PRIMARY KEY  (`id`), 
    KEY fk_game_id(`game_id`), 
    KEY fk_platform_id(`platform_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='看广告记录' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `h5_yun_user_log`;
CREATE TABLE `h5_yun_user_log` (
    `id` int(11) NOT NULL  auto_increment comment '自增id',
    `game_id` int(11)  default '0'  comment '游戏id',
    `platform_id` int(11)  default '0'  comment '平台id',
    `platform_user_id` varchar(50)  default ''  comment '用户id',
    `platform_user_name` varchar(100)  default ''  comment '用户名',
    `yun_uid` int(11)  default '0'  comment 'yun uid',
    `create_time` int(11)  default '0'  comment '创建时间',
    `ip` varchar(30)  default ''  comment 'ip',
    `op_type` int(2)  default '0'  comment '操作类型，0选择区服，1创角',
    `role_id` varchar(255)  default ''  comment '角色id',
    `role_level` varchar(255)  default ''  comment '角色等级',
    `role_name` varchar(255)  default ''  comment '角色名',
    `server_id` varchar(255)  default ''  comment '服id',
    `server_name` varchar(255)  default ''  comment '服名',
    `reg_time` int(11)  default '0'  comment '创建时间', 
    PRIMARY KEY  (`id`), 
    KEY fk_game_id(`game_id`), 
    KEY fk_platform_id(`platform_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户操作日志' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `h5_yun_user_log`;
CREATE TABLE `h5_yun_user_log` (
    `id` int(11) NOT NULL  auto_increment comment '自增id',
    `game_id` int(11)  default '0'  comment '游戏id',
    `platform_id` int(11)  default '0'  comment '平台id',
    `platform_user_id` varchar(50)  default ''  comment '用户id',
    `platform_user_name` varchar(100)  default ''  comment '用户名',
    `yun_uid` int(11)  default '0'  comment 'yun uid',
    `create_time` int(11)  default '0'  comment '创建时间',
    `ip` varchar(30)  default ''  comment 'ip',
    `op_type` int(2)  default '0'  comment '操作类型，0选择区服，1创角',
    `role_id` varchar(255)  default ''  comment '角色id',
    `role_level` varchar(255)  default ''  comment '角色等级',
    `role_name` varchar(255)  default ''  comment '角色名',
    `server_id` varchar(255)  default ''  comment '服id',
    `server_name` varchar(255)  default ''  comment '服名',
    `reg_time` int(11)  default '0'  comment '创建时间', 
    PRIMARY KEY  (`id`), 
    KEY fk_game_id(`game_id`), 
    KEY fk_platform_id(`platform_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户操作日志' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `h5_yun_xcx_user_session`;
CREATE TABLE `h5_yun_xcx_user_session` (
    `id` int(11) NOT NULL  auto_increment comment '自增id',
    `login_token` varchar(255)  default ''  comment '登录态',
    `game_id` int(11)  default '0'  comment '游戏id',
    `platform_id` int(11)  default '0'  comment '平台id',
    `platform_user_id` varchar(50)  default ''  comment '用户id',
    `platform_user_name` varchar(100)  default ''  comment '用户名',
    `yun_uid` int(11)  default '0'  comment 'yun uid',
    `create_time` int(11)  default '0'  comment '创建时间',
    `update_time` int(11)  default '0'  comment '更新时间',
    `expire_time` int(11)  default '0'  comment '过期时间',
    `session_key` varchar(255)  default ''  comment '微信登录态',
    `open_id` varchar(255)  default ''  comment 'open_id',
    `unionid` varchar(255)  default ''  comment 'unionid',
    `nick_name` varchar(50)  default ''  comment '昵称',
    `gender` varchar(10)  default ''  comment '性别',
    `city` varchar(50)  default ''  comment '城市',
    `province` varchar(50)  default ''  comment '省份',
    `country` varchar(50)  default ''  comment '国家',
    `avatar_url` varchar(255)  default ''  comment '头像',
    `first_brand` varchar(255)  default ''  comment '首次登录品牌',
    `last_brand` varchar(255)  default ''  comment '最后登录品牌',
    `first_model` varchar(255)  default ''  comment '首次登录型号',
    `last_model` varchar(255)  default ''  comment '最后登录型号',
    `first_version` varchar(255)  default ''  comment '首次登录微信版本',
    `last_version` varchar(255)  default ''  comment '最后登录微信版本',
    `first_system` varchar(255)  default ''  comment '首次登录系统版本',
    `last_system` varchar(255)  default ''  comment '最后登录系统版本',
    `first_platform` varchar(255)  default ''  comment '首次登录平台',
    `last_platform` varchar(255)  default ''  comment '最后登录平台',
    `first_network` varchar(255)  default ''  comment '首次登录网络',
    `last_network` varchar(255)  default ''  comment '最后登录网络',
    `first_scene` varchar(255)  default ''  comment '首次登录场景',
    `last_scene` varchar(255)  default ''  comment '最后登录场景',
    `first_sdk_version` varchar(20)  default ''  comment '首次登录sdk',
    `last_sdk_version` varchar(20)  default ''  comment '最后登录sdk',
    `wx_query` varchar(2000)  default ''  comment '来源入口参数',
    `wx_group_id` varchar(255)  default ''  comment '来源群id',
    `referrer_app_id` varchar(255)  default ''  comment '来源app_id',
    `referrer_extra` varchar(2000)  default ''  comment '来源额外参数',
    `rank` int(11)  default '0'  comment '分享裂变层级',
    `inviter` varchar(255)  default ''  comment '邀请者',
    `leader` varchar(255)  default ''  comment '第一用户', 
    PRIMARY KEY  (`id`), 
    KEY fk_game_id(`game_id`), 
    KEY fk_platform_id(`platform_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信小游戏用户' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `power_user`;
CREATE TABLE `power_user` (
    `power_user_id` int(10) unsigned NOT NULL  auto_increment comment 'ID编号',
    `power_user_name` char(30) NOT NULL   comment '用户帐号',
    `truename` char(30) NOT NULL   comment '真实姓名',
    `password` char(32) NOT NULL   comment '密码',
    `power_role_id` int(10) NOT NULL   comment '角色类型',
    `is_root` boolean NOT NULL default '0'  comment '是否超管：0否，1是',
    `is_admin` boolean NOT NULL default '0'  comment '是否普管：0否，1是',
    `last_login_time` int(10) unsigned    comment '最后登陆时间',
    `login_count` int(10) unsigned  default '0'  comment '登陆次数',
    `created_time` int(10) unsigned    comment '创建时间',
    `updated_time` int(10) unsigned    comment '更新时间', 
    PRIMARY KEY  (`power_user_id`), 
    KEY fk_user_role(`power_role_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户管理' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `power_role`;
CREATE TABLE `power_role` (
    `power_role_id` int(10) unsigned NOT NULL  auto_increment comment 'ID编号',
    `power_role_name` char(30) NOT NULL   comment '角色名称',
    `content` text    comment '角色权限内容',
    `created_time` int(10) unsigned    comment '创建时间', 
    PRIMARY KEY  (`power_role_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色管理' AUTO_INCREMENT=1;