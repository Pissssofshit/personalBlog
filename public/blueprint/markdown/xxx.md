FORMAT: 1A

# Example API

order

## 订单 [/order]

### 获取订单数据 [GET]

+ Parameters
    + order_id (string)

        订单id.

+ Response 200 (application/json)
{
            "error": "1", 
            "msg": "错误说明",
            "data": [{
                "order_id": "1",
                "money": "1000.09",
                "create_time": "2018-10-18 09:00:00",
                "user_id": "666"
            }]
 }
 
 
### 创建订单 [POST]


+ Parameters
    + user_id (string)

        用户id.
    + money (string)
    
        金额.

+ Response 200 (application/json)
{
            "error": "1", 
            "msg": "错误说明",
            "data": []
 }
   
   
