DROP DATABASE IF EXISTS `xdwsy`;
CREATE DATABASE `xdwsy` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

GRANT all ON xdwsy.* TO 'ledu'@'%' IDENTIFIED BY 'ledugamecmsad';

USE `xdwsy`;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `id` int(11) NOT NULL  auto_increment comment 'UID',
    `username` varchar(250) NOT NULL default ''  comment '用户名',
    `mobile` char(20) NOT NULL default ''  comment '手机号',
    `email` varchar(250) NOT NULL default ''  comment '邮箱',
    `password` varchar(250) NOT NULL default ''  comment '加密密码',
    `reg_time` int(11) NOT NULL default '0'  comment '注册时间戳',
    `mobile_bind_time` int(11) NOT NULL default '0'  comment '手机绑定时间戳',
    `email_bind_time` int(11) NOT NULL default '0'  comment '邮箱绑定时间戳',
    `source` int(2) NOT NULL default '0'  comment '来源1:1自然量2公会',
    `ucode` int(11) NOT NULL default '0'  comment '来源2:渠道标识',
    `subucode` varchar(250) NOT NULL default ''  comment '来源3:子渠道扩展标示',
    `ip` varchar(250) NOT NULL default '0'  comment '注册ip',
    `ua` varchar(250) NOT NULL default ''  comment '注册ua',
    `os` int(2) NOT NULL default '0'  comment '操作系统:0-pc;1-android;2-ios',
    `device_id` varchar(250) NOT NULL default ''  comment '注册设备id',
    `imei` varchar(250) NOT NULL default ''  comment '物理标识:android为imei；ios为idfa',
    `nickname` varchar(250) NOT NULL default ''  comment '昵称',
    `sex` int(2) NOT NULL default '0'  comment '性别:1男2女',
    `head_icon` varchar(250) NOT NULL default ''  comment '头像',
    `idcard` char(18) NOT NULL   comment '',
    `realname` varchar(250) NOT NULL   comment '',
    `salt` char(20) NOT NULL default ''  comment '盐值', 
    PRIMARY KEY  (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='用户' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `third_user`;
CREATE TABLE `third_user` (
    `id` int(11) NOT NULL  auto_increment comment 'ID',
    `user_id` int(11) NOT NULL default '0'  comment 'UID:user表用户id',
    `app_type` varchar(250) NOT NULL default ''  comment '开放平台标示:如weixin',
    `openid` varchar(250) NOT NULL default ''  comment '开放平台用户标示',
    `access_token` varchar(250) NOT NULL default ''  comment '开放平台访问令牌',
    `token_expire_time` int(11) NOT NULL default '0'  comment '令牌实效时间',
    `refresh_token` int(11) NOT NULL default '0'  comment '刷新令牌',
    `user_info` text NOT NULL default ''  comment '开放平台返回的用户信息', 
    PRIMARY KEY  (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='第三方用户' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `game_user`;
CREATE TABLE `game_user` (
    `id` int(11) NOT NULL  auto_increment comment 'ID',
    `game_id` int(11) NOT NULL default '0'  comment '游戏id',
    `user_id` int(11) NOT NULL default '0'  comment '平台用户id',
    `name` varchar(250) NOT NULL default ''  comment '游戏用户名',
    `ucode` int(11) NOT NULL default '0'  comment '渠道标示',
    `subucode` varchar(250) NOT NULL default ''  comment '子渠道标示',
    `ip` varchar(100) NOT NULL default ''  comment '注册ip',
    `ua` varchar(250) NOT NULL default ''  comment '注册ua',
    `os` int(2) NOT NULL default '0'  comment '操作系统:0-pc;1-android;2-ios',
    `device_id` varchar(250) NOT NULL default ''  comment '注册设备id',
    `imei` varchar(250) NOT NULL default ''  comment '特理标识:android为imei；ios为idfa',
    `version` varchar(250) NOT NULL default ''  comment '版本',
    `reg_time` int(11) NOT NULL default '0'  comment '注册时间戳', 
    PRIMARY KEY  (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='用户游戏表' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `user_login_log`;
CREATE TABLE `user_login_log` (
    `id` int(11) NOT NULL  auto_increment comment 'ID',
    `user_id` int(11) NOT NULL default '0'  comment '用户id',
    `username` varchar(250) NOT NULL default ''  comment '用户名',
    `mobile` char(20) NOT NULL default ''  comment '手机号',
    `email` varchar(100) NOT NULL default ''  comment '邮箱',
    `login_time` int(11) NOT NULL default '0'  comment '登陆时间戳',
    `ucode` int(11) NOT NULL default '0'  comment '来源渠道标示',
    `subucode` varchar(250) NOT NULL default ''  comment '子渠道标示',
    `ip` varchar(100) NOT NULL default ''  comment '注册ip',
    `ua` varchar(250) NOT NULL default ''  comment '注册ua',
    `os` int(2) NOT NULL default '0'  comment '操作系统:0pc;1android;2ios',
    `device_id` varchar(250) NOT NULL default ''  comment '注册设备id',
    `imei` varchar(250) NOT NULL default ''  comment '物理标识:android为imei；ios为idfa',
    `version` varchar(250) NOT NULL default ''  comment '版本', 
    PRIMARY KEY  (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='用户登陆' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `game_entity`;
CREATE TABLE `game_entity` (
    `id` int(11) NOT NULL  auto_increment comment 'ID',
    `name` varchar(250) NOT NULL default ''  comment '游戏主体名称',
    `enable` int(2) NOT NULL default '0'  comment '状态:1启用2禁用',
    `create_time` int(11) NOT NULL default '0'  comment '创建时间戳',
    `update_time` int(11) NOT NULL default '0'  comment '更新时间戳',
    `create_by` varchar(250) NOT NULL default ''  comment '创建者',
    `update_by` varchar(250) NOT NULL default ''  comment '更新者',
    `discount` float(10,2) NOT NULL default '0'  comment '代充折扣',
    `back_pay` float(10,2) NOT NULL default '0'  comment '充值返点',
    `status` int(2) NOT NULL default '0'  comment '上架状态', 
    PRIMARY KEY  (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='游戏' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
    `id` int(11) NOT NULL  auto_increment comment 'ID',
    `entity_id` int(11) NOT NULL default '0'  comment '主体id',
    `name` varchar(250) NOT NULL default ''  comment '游戏名称',
    `name_en` varchar(250) NOT NULL default ''  comment '拼音简写',
    `icon` varchar(250) NOT NULL default ''  comment '图标',
    `desc` text NOT NULL default ''  comment '描述',
    `category` varchar(250) NOT NULL default ''  comment '类型',
    `rank` varchar(250) NOT NULL default ''  comment '分级:ABC3类',
    `os` int(2) NOT NULL default '0'  comment '系统类别:默认为1android',
    `common_sign_key` char(250) NOT NULL default ''  comment '普通签名key',
    `confirm_sign_key` char(255) NOT NULL default ''  comment '确认接口签名key',
    `pay_sign_key` char(255) NOT NULL default ''  comment '冲值签名key',
    `pay_callback` varchar(255) NOT NULL default ''  comment '冲值回调url',
    `coin_unit` varchar(255) NOT NULL default ''  comment '游戏币名称:如钻石',
    `coin_rate` int(11) NOT NULL default '0'  comment '兑换率:1元人民币兑换多少游戏币',
    `ucode` int(11) NOT NULL default '0'  comment '原始ucode:对应渠道标记为0',
    `version` varchar(255) NOT NULL default ''  comment '版本',
    `package_url` varchar(255) NOT NULL default ''  comment '包地址',
    `create_time` int(11) NOT NULL default '0'  comment '创建时间戳',
    `update_time` int(11) NOT NULL default '0'  comment '更新时间戳',
    `create_by` varchar(255) NOT NULL default ''  comment '创建者',
    `update_by` varchar(255) NOT NULL default ''  comment '更新者', 
    PRIMARY KEY  (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='游戏渠道包' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `game_config_switch`;
CREATE TABLE `game_config_switch` (
    `game_id` int(11) NOT NULL default '0'  comment '游戏id',
    `ad_stat_switch` int(2) NOT NULL default '0'  comment '广告统计app开关:1开启;2关闭',
    `ad_stat_key` varchar(255) NOT NULL default ''  comment '广告统计参数',
    `weixin_switch` int(2) NOT NULL default '0'  comment '微信开关:1开启;2关闭',
    `weixin_app_id` varchar(255) NOT NULL default ''  comment 'app id',
    `weixin_app_key` varchar(255) NOT NULL default ''  comment 'app key',
    `weixin_app_secret` varchar(255) NOT NULL default ''  comment 'app secret',
    `show_platform_switch` int(2) NOT NULL default '0'  comment '平台闪屏开关:游戏启动动画是否播放平台logo',
    `bind_mobile_when_pay_switch` int(2) NOT NULL default '0'  comment '充值邦定手机提示',
    `one_key_registe_switch` int(2) NOT NULL default '0'  comment '一键注册开关',
    `create_time` int(11) NOT NULL default '0'  comment '创建时间戳',
    `update_time` int(11) NOT NULL default '0'  comment '更新时间戳',
    `create_by` varchar(255) NOT NULL default ''  comment '创建者',
    `update_by` varchar(255) NOT NULL default ''  comment '更新者', 
    PRIMARY KEY  (`game_id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='游戏开关' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
    `id` int(11) NOT NULL  auto_increment comment 'ID',
    `user_id` int(11) NOT NULL default '0'  comment '平台用户id',
    `game_id` int(11) NOT NULL default '0'  comment '游戏id',
    `game_order_id` varchar(255) NOT NULL default ''  comment '游戏订单号',
    `ucode` int(11) NOT NULL default '0'  comment '渠道标示',
    `subucode` varchar(255) NOT NULL default ''  comment '子渠道标示',
    `server_id` varchar(255) NOT NULL default ''  comment '游戏服务器',
    `role_name` varchar(255) NOT NULL default ''  comment '游戏角色名',
    `desc` varchar(255) NOT NULL default ''  comment '订单描述',
    `order_coin` int(11) NOT NULL default '0'  comment '游戏币数量',
    `order_money` float(11,2) NOT NULL default '0'  comment '订单金额',
    `pay_channel_id` int(2) NOT NULL default '0'  comment '支付方式:0-平台币;pay_channel里的id',
    `pay_point` int(11) NOT NULL default '0'  comment '支付平台币数量',
    `pay_point_free` int(11) NOT NULL default '0'  comment '支付的平台赠送平台币数量',
    `pay_money` float(11,2) NOT NULL default '0'  comment '实际支付金额',
    `extra` varchar(255) NOT NULL default ''  comment '透传字段:SDK提交过来需透传的字段',
    `pay_virtual_point` int(11) NOT NULL default '0'  comment '支付的虚拟货币',
    `create_time` int(11) NOT NULL default '0'  comment '创建时间戳',
    `update_time` int(11) NOT NULL default '0'  comment '更新时间戳',
    `status` int(2) NOT NULL default '0'  comment '订单状态:1-已创建；2-已提交第三方；3-第三方充值成功；4-调用游戏后台接口下发游戏币成功；5-等待继续支付；6-支付超时；7-支付失败', 
    PRIMARY KEY  (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='订单' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `user_point`;
CREATE TABLE `user_point` (
    `id` int(11) NOT NULL  auto_increment comment 'ID',
    `user_id` int(11) NOT NULL default '0'  comment 'user表用户id',
    `point` float(11,2) NOT NULL default '0'  comment '平台币',
    `point_free` int(11) NOT NULL default '0'  comment '赠送的平台币数量',
    `update_time` int(11) NOT NULL default '0'  comment '更新时间戳',
    `last_pay_game_id` int(11) NOT NULL default '0'  comment '最近充值游戏',
    `last_pay_server_id` varchar(255) NOT NULL default ''  comment '最近充值游戏服务器',
    `last_pay_channel_id` int(11) NOT NULL default '0'  comment '最近付费渠道id',
    `last_pay_money` float(11,2) NOT NULL default '0'  comment '最近充值金额', 
    PRIMARY KEY  (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='平台币' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `user_point_log`;
CREATE TABLE `user_point_log` (
    `id` int(11) NOT NULL  auto_increment comment 'ID',
    `user_id` int(11) NOT NULL default '0'  comment '平台用户id',
    `before_point` int(11) NOT NULL default '0'  comment '变更前平台币',
    `point` int(11) NOT NULL default '0'  comment '变更的平台币',
    `after_point` int(11) NOT NULL default '0'  comment '变更后的平台币',
    `before_point_free` int(11) NOT NULL default '0'  comment '变更前赠送平台币',
    `point_free` int(11) NOT NULL default '0'  comment '变更的赠送平台币',
    `after_point_free` int(11) NOT NULL default '0'  comment '变更后的赠送平台币',
    `type` varchar(255) NOT NULL default ''  comment '变更类型',
    `desc` varchar(255) NOT NULL default ''  comment '变更说明',
    `create_time` int(11) NOT NULL default '0'  comment '变更时间戳', 
    PRIMARY KEY  (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='平台币日志' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `order_log`;
CREATE TABLE `order_log` (
    `id` int(11) NOT NULL  auto_increment comment 'ID',
    `user_id` int(11) NOT NULL default '0'  comment '平台用户id',
    `order_id` int(11) NOT NULL default '0'  comment 'order表id',
    `action_name` varchar(255) NOT NULL default ''  comment '动作名称',
    `action_param` varchar(255) NOT NULL default ''  comment '动作参数',
    `action_res` varchar(255) NOT NULL default ''  comment '动作结果',
    `create_time` int(11) NOT NULL default '0'  comment '时间戳', 
    PRIMARY KEY  (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='订单变更日志' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `user_virtual_point`;
CREATE TABLE `user_virtual_point` (
    `id` int(11) NOT NULL  auto_increment comment 'ID',
    `user_id` int(11) NOT NULL default '0'  comment '用户id',
    `game_id` int(11) NOT NULL default '0'  comment '游戏id',
    `type` int(2) NOT NULL default '0'  comment '类型',
    `point` int(11) NOT NULL default '0'  comment '余额', 
    PRIMARY KEY  (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='限定币' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `user_virtual_point_log`;
CREATE TABLE `user_virtual_point_log` (
    `id` int(11) NOT NULL  auto_increment comment 'ID',
    `user_id` int(11) NOT NULL default '0'  comment '平台用户id',
    `game_id` int(11) NOT NULL default '0'  comment '游戏id',
    `before_point` int(11) NOT NULL default '0'  comment '变更前虚拟币',
    `point` int(11) NOT NULL default '0'  comment '变更的虚拟币',
    `after_point` int(11) NOT NULL default '0'  comment '变更后的虚拟币',
    `type` varchar(255) NOT NULL default ''  comment '变更类型',
    `desc` varchar(255) NOT NULL default ''  comment '变更说明',
    `create_time` int(11) NOT NULL default '0'  comment '变更时间戳', 
    PRIMARY KEY  (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='限定币变更日志' AUTO_INCREMENT=1;

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
    `created_time` int(10) unsigned    comment '创建时间', 
    PRIMARY KEY  (`power_role_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色管理' AUTO_INCREMENT=1;