FORMAT: 1A

# VR项目接口
本文档主要对 VR项目中前端请求接口数据进行描述.
们在游戏验证启动之前 调用这个接口  传一个backhost参数   测试期间backhost为183.129.237.106:1280     测试通过之后  可以把backhost改为正式的上报地址vrapi.ledu.com

# Group device
		
## Device [/api/device/isreg{?device}]

### 该设备是否已注册 [GET]

+ Parameters

    + device: `DERFTYUGHUDTKD-DFGKGJ` (string, optional) - Search for a user by device
+ Request (application/json)
    
+ Response 200 (application/json)

    + Headers


    + Body

            {
              "code": 0,
			  "msg":"success",
			  "data":{
					"isreg":0,//未注册 1 已注册
			  }
            }

## Device [/api/device/getregnum{?device}]

### 获取机台注册ID号 [GET]

+ Parameters

    + device: `DERFTYUGHUDTKD-DFGKGJ` (string, optional) - Search for a user by device
+ Request (application/json)
    
+ Response 200 (application/json)

    + Headers


    + Body

            {
			"code": 0,
			"msg":"success",
			"data":{
				"device":"DERFTYUGHUDTKD-DFGKGJ",
				"machineId":2
				}
			}
	

## Device [/api/device/regData]

### 注册 [GET]
客户端初始化时的注册

+ Attributes (RegData Base)

+ Request (application/json)
    
+ Response 200 (application/json)

    + Headers


    + Body

            {
              "code":0,
			  "msg": "success",
			  "data": {
				"id": 2,//机台号
				"device": "DERFTYUGHUDTKD-DFGKGJ",//设备号
				}
            }
# Group Game
## Game [/api/game/getgamelist{?device}]

### 机台请求游戏列表 [GET]
用户页面展示游戏图片列表供用户点击选择游戏

+ Parameters

    + device: `DERFTYUGHUDTKD-DFGKGJ` (string, optional) - Search for a game by device

+ Request (application/json)
    
+ Response 200 (application/json)

    + Body

            /*{
				"code": 0,
				"msg": "success",
			  "data": {
					"gameList": [
					{
					"id": 1,
					"name": "DERFTYUGHUDTKD-DFGKGJ",//游戏名称
					"icon": "21",//游戏图标
					"desc": "23234324",//描述
					"package_url": "32423432",//地址包
					"state": 1,
					"duretime": 0,//游戏时长
					"money": 0,//游戏价格
					"create_time": 0,//创建时间
					"update_time": 0,
					"imgicons": [
					{
					"id": 1,
					"game_id": 1,//游戏ID
					"icon_min": "3435",//游戏小图标
					"icon_max": "3435",//游戏大图标
					},
					{
					"id": 2,
					"game_id": 1,
					"icon_min": "3435",//游戏小图标
					"icon_max": "3435",//游戏大图标
					}
					]
					},
					{
					"id": 2,
					"name": "DERFTYUGHUDTKD-DFGKss",
					"icon": "232",
					"desc": "23423432",
					"package_url": "2342342",
					"state": 1,
					"duretime": 0,
					"money": 0,
					"create_time": 0,
					"update_time": 0,
					"imgicons": [
					{
					"id": 3,
					"game_id": 2,
					"icon": "fgfgdf"
					},
					{
					"id": 4,
					"game_id": 2,
					"icon": "rtrttytry"
					}
					]
					}
					]
					}
            }*/
//2018-06-25 变更新增 (VR1.2.0.0)
			{
				"code": 0,
				"msg": "success",
				"data": {
						"gameList": [
								{
									"id": 1,
									"name": "DERFTYUGHUDTKD-DFGKGJ",//游戏名称
									"icon": "21",//游戏图标 （游戏列表主图）
									"desc": "23234324",//描述
									"package_url": "32423432",//地址包
									"state": 1,
									"duretime": 0,//游戏时长，单位s
									"money": 0,//游戏价格
									"create_time": 0,//创建时间
									"update_time": 0,
									"loading_time":0,//加截时长，单位s
									"enjoy_price":0,//畅玩价
									"enjoy_time":0,//畅玩时长，单位s
									"imgicons": [
											{
												"id": 1,
												"game_id": 1,//游戏ID
												"filetype":0,//资源类型：0图片，1视频
												"icon_max": "3435",//地址
											},
											{
												"id": 2,
												"game_id": 1,
												"filetype":0,//资源类型：0图片，1视频
												"icon_max": "3435",//地址
											}
									],
									"banners": [
											{
												"id": 1,
												"game_id": 1,//游戏ID
												"filetype":0,//资源类型：0图片，1视频
												"url": "3435",//玩法介绍（加载页面的）
											},
											{
												"id": 2,
												"game_id": 1,
												"filetype":0,//资源类型：0图片，1视频
												"url": "3435",//玩法介绍（加载页面的）
											}
									]
								},
								{
									"id": 1,
									"name": "DERFTYUGHUDTKD-DFGKGJ",//游戏名称
									"icon": "21",//游戏图标
									"desc": "23234324",//描述
									"package_url": "32423432",//地址包
									"state": 1,
									"duretime": 0,//游戏时长
									"money": 0,//游戏价格
									"create_time": 0,//创建时间
									"update_time": 0,
									"loading_time":0,//加截时长，单位s
									"enjoy_price":0,//畅玩价
									"enjoy_time":0,//畅玩时长，单位s
									"imgicons": [
											{
												"id": 1,
												"game_id": 1,//游戏ID
												"filetype":0,//资源类型：0图片，1视频
												"icon_max": "3435",//地址
											},
											{
												"id": 2,
												"game_id": 1,
												"filetype":0,//资源类型：0图片，1视频
												"icon_max": "3435",//地址
											}
									],
									"banners": [
											{
												"id": 1,
												"game_id": 1,//游戏ID
												"filetype":0,//资源类型：0图片，1视频
												"url": "3435",//玩法介绍（加载页面的）
											},
											{
												"id": 2,
												"game_id": 1,
												"filetype":0,//资源类型：0图片，1视频
												"url": "3435",//玩法介绍（加载页面的）
											}
									]
								}
						]
				}
			 }

##Game [/api/game/getgamedetail{?gameuniqureid,device}]

### 获取某次游戏信息 [GET]
根据某次游戏的唯一标识获取游戏包地址及剩余时间等信息

+ Parameters

    + gameuniqureid: `1234567891234567` (string, optional) - Search for a game by gameuniqureid
	+ device: `DERFTYUGHUDTKD-DFGKGJ` (string, optional) - Search for a game by device

+ Request (application/json)
    
+ Response 200 (RegData Base)

    + Headers


    + Body
	
			{
              "code": 0,
				"msg": "success",
				"data": {
				"id": 123,
				"game_id": 1,//游戏id
				"user_id": 0,//用户
				"state": 0,//0 未开始  1已开始 2 已结束
				"start_time": 0,//开始时间
				"update_time": 0,
				"duretime": 0,//游戏总时长 
				"use_duretime": 0,//游戏已用时长
				"gameurl": "",//游戏包地址
				"device": "DERFTYUGHUDTKD-DFGKGJ",//设备号
				}
            }
			
##Game [/api/game/gameprocess{?gameuniqureid,device,oparate}]

### 游戏进程结束或超时结束 [GET]
oparate 1 开始  2 游戏中途退出 3游戏正常结束退出 4H5计时结束

+ Parameters

    + gameuniqureid: `1234567891234567` (string, optional) - Search for a game by gameuniqureid
	+ device: `DERFTYUGHUDTKD-DFGKGJ` (string, optional) - Search for a game by device
	+ oparate:  0 (int, optional) - Search for a game by device

+ Request (application/json)
    
+ Response 200 (RegData Base)

    + Headers


    + Body
	
			{
              "code": 0,
			  "msg": "success",
            }
			
##Game [/api/game/continuegame{?gameuniqureid,device,gameid}]

### 点击继续游戏获取包地址时间等 [GET]

+ Parameters

    + gameuniqureid: `1234567891234567` (string, optional) - Search for a game by gameuniqureid
	+ device: `DERFTYUGHUDTKD-DFGKGJ` (string, optional) - Search for a game by device
	+ gameid:  1 (int, optional) - Search for a game by device

+ Request (application/json)
    
+ Response 200 (RegData Base)

    + Headers


    + Body
	
			{
              "code": 0,
			  "msg": "success",
			  "data":{
				"gameurl":"d://qq.exe",//支付成功后拉起的游戏进程地址
				"duratime":300,//游戏时长
				"gameuniqureid":"123456",游戏唯一标识
				}
            }
# Group Order
##Order [/api/order/createpayurl{?gameid,device}]

### 生成支付二维码 [GET]
用户点击游戏生成付款二维码

+ Parameters

    + device: `DERFTYUGHUDTKD-DFGKGJ` (string, optional) - Search for a order by device
	+ gameid: `123` (string, optional) - Search for a user by gameid
	+ type: `0` (int, optional) - 游戏类型：是否续费
	+ gameuniqureid: `1` (string, optional) -单次 游戏的唯一的标识
	+ pricetype: 1 (int, optional) - 订单价格类型：0体验价，1畅玩价  (新增 2018-06-25 VR1.2.0.0)

+ Request (application/json)
    
+ Response 200 (application/json)

    + Headers


    + Body

            {
              "code":0,
			  "data":{
				"payurl":"host/order/payurl?orderid=1234567",//支付二维码链接
			     "payuuid":"1234567",//二维码uuid 用于请求是否被扫码
				}
            }

##Order [/api/order/h5endgame{?orderid,device,oparate}]

### H5页面倒计时已扫描未支付 [GET]
H5页面已扫描未支付倒计时结束时调用通知服务器

+ Parameters

    + orderid: `111` (string, optional) - Search for a order by device
	+ device: `DERFTYUGHUDTKD-DFGKGJ` (string, optional) - Search for a order by device
	+ oparate: 11 (int, optional) - Search for a user by gameid

+ Request (application/json)
    
+ Response 200 (application/json)

    + Headers


    + Body

            {
              "code":0,//0成功 1失败
			  "msg":"success"
			
##Order [/api/order/qrcodehasscanning{?uuid,device}]
### 检测二维码是否被扫描过 [GET]

+ Parameters

    + device: `DERFTYUGHUDTKD-DFGKGJ` (string, optional) - Search for a order by device
	+ uuid: `123` (string, optional) - Search for a user by order

+ Request (application/json)
    
+ Response 200 (application/json)

    + Headers


    + Body

            {
			code: 0,//0 正常 1参数错误
			msg: "success",
			data: {
			  isscanning: "1234566",//是否被扫描过  null 0 都为未扫描 已扫描时返回订单号
			}
			}
			
##Order [/api/order/checkhaspay{?orderid}]

### 检测游戏是否支付成功 [GET]
用户扫描二维码后检测是否支付成功

+ Parameters

    + orderid: `1234567891234567` (string, optional) - Search for a order by orderid

+ Request (application/json)
    
+ Response 200 (application/json)

    + Headers


    + Body

            {
              "code":0,//0支付成功 1未支付成功
			  "msg":"paysuccess",
			  "data":{
				"gameurl":"d://qq.exe",//支付成功后拉起的游戏进程地址
				"duratime":300,//游戏时长
				"gameuniqureid":"123456",游戏唯一标识
				}
            }
			
# Group Heart
##Game [/api/game/heartcheck{?device}]

### 心跳检测URL [GET]
用于客户端调用心跳检测

+ Parameters

    + device: `DERFTYUGHUDTKD-DFGKGJ` (string, optional) - Search for a order by device

+ Request (application/json)
    
+ Response 200 (application/json)

    + Headers


    + Body

            {
              "code":0,
			  "msg":"success"
            }

			
##Device [/api/device/h5isok{?device}]

### h5检测URL [GET]
用于h5检测是否在线

+ Parameters

    + device: `DERFTYUGHUDTKD-DFGKGJ` (string, optional) - Search for a order by device

+ Request (application/json)
    
+ Response 200 (application/json)

    + Headers


    + Body

            {
			code: 0,
			message: "success",
			}


# Data Structures

## RegData Base (object)
+ id: 机台号(string)

    请求后台返回的机台号.
	
+ device: 客户端设备号 (string)

    从客户端获取的设备号.

+ device_name: 机台名称 (string)

    机台命名，字符串.
	
+ province: 省 (string)

    地区：省.
	
+ province_code: 省 (string)

    地区：省.id形式
	
+ city: 市 (string)

    地区：市.
	
+ city_code: 市 (string)

    地区：市.id形式
	
+ area: 区(string)

	 地区：区.
	
+ area_code: 区(string)

	 地区：区.id形式
	
+ address: 详细地址(string)

	地区：详细地址.
	
	
	