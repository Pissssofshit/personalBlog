# 开发环境
### 说明
    开发环境皆使用docker实现，对资源消耗有所要求（特别于是WIN7，基于VitualBox虚拟机实现）
    建议配置：
        1、固态硬盘 + 8G内存
        2、>=16G内存
    如当前无法达到该要求，建议开发过程中控制软件的开启数量（如浏览器不要开多个），关掉杀毒软件，IDE尽可能用轻量级的。

### 数据库（v5.6）
    数据库建表语句：database/autophp/schema.sql, 导入数据库即可
    配置文件连接的host：mysql, 请保mysql的host正确。 容器关联mysql容器会生成.
    
### PHP( > v7.1.3)
    Laravel: v5.7
    本框架自带composer.phar文件，执行composer可以以（php composer.phar）来执行。

### 开发目录
    以下脚本的皆默认开发目录为：当前用户目录下的www目录。
    如：Windows的当前用户为mujoy, 其项目所在目录为: C:\Users\miaoju\www
    开发目录中会有个image目录，其对应的域名为: image.ledu.com, 可设置hosts直接访问。
    

# 容器（项目环境初始化）
### WIN7
    容器软件：ftp://10.66.10.73/DockerToolbox.exe
    命令终端工具：Docker Quickstart Terminal
```bash
# 设置项目名
export PROJECT="test.mjutech.com";
# 1、启动数据库。
docker run --name mysql -p 3306:3306 -e MYSQL_ROOT_PASSWORD=123456 -d ccr.ccs.tencentyun.com/miaoju/mysql:5.6
# 2、启动项目开发容器（这里使用80端口，确认80端口未被占用或使用其它端口）
docker run -d --name $PROJECT --link mysql:mysql -e git="git@gitlab.mjutech.com:base/laravel-autophp-blade" -e project="$PROJECT" -e frame='laravel' -v $HOME/www:/data/web/yaf  -p 80:80 ccr.ccs.tencentyun.com/miaoju/php:7.1.8-dev 
# 3、设置hosts（加入一行：192.168.99.100 test.mjutech.com ）
# 4、访问：http://test.mjutech.com
```

### WIN10
    容器软件：ftp://10.66.10.73/Docker%20for%20Windows%20Installer.exe
    命令终端工具：PowerShell(在运行中直接输入PowerShell)
```bash
# 设置项目名
$PROJECT="test.mjutech.com";
# 1、启动数据库。
docker run --name mysql -p 3306:3306 -e MYSQL_ROOT_PASSWORD=123456 -d ccr.ccs.tencentyun.com/miaoju/mysql:5.6
# 2、启动项目开发容器（这里使用80端口，确认80端口未被占用或使用其它端口）
mkdir www  #docker没有权限创建目录，需要手工创建
docker run -d --name $PROJECT --link mysql:mysql -e git="git@gitlab.mjutech.com:base/laravel-autophp-blade" -e project="$PROJECT" -e frame='laravel' -v $HOME/www:/data/web/yaf  -p 80:80 ccr.ccs.tencentyun.com/miaoju/php:7.1.8-dev 
# 3、设置hosts（加入一行：127.0.0.1 test.mjutech.com）
# 4、访问：http://test.mjutech.com
```

### MAC
    容器软件：ftp://10.66.10.73/Docker.dmg
    命令终端工具：系统Terminal
```bash
# 设置项目名
export PROJECT="test.mjutech.com";
# 1、启动数据库。
docker run --name mysql -p 3306:3306 -e MYSQL_ROOT_PASSWORD=123456 -d ccr.ccs.tencentyun.com/miaoju/mysql:5.6
# 2、启动项目开发容器（这里使用80端口，确认80端口未被占用或使用其它端口）
docker run -d --name $PROJECT --link mysql:mysql -e git="git@gitlab.mjutech.com:base/laravel-autophp-blade" -e project="$PROJECT" -e frame='laravel' -v $HOME/www:/data/web/yaf  -p 80:80 ccr.ccs.tencentyun.com/miaoju/php:7.1.8-dev 
# 3、设置hosts
sudo echo "127.0.0.1 test.mjutech.com" >> /etc/hosts
# 4、访问：http://test.mjutech.com
```


# AUTOPHP（项目框架初始化）
### 访问路径
    1、打开：http://test.mjutech.com
    2、点击：AUTOPHP，进入代码生成工具
    3、手工指定xml文件，如?xml=pop
    4、点击生成代码，确认输出“生成完成”字样
    5、点击导入数据库，确认输入“导入完成”字样，点击“autophp浏览”
    6、基本表的操作模型生成。
### 生成文件路径
    1、C（控制器）：app/Http/Controllers/Autophp/
    2、M（数据库模型）：app/Database/Models/
    3、M（数据操作模型）：app/Http/Models/Autophp/
    4、V（视图Smarty）：resources/views/autophp/
    5、R（路由restful）: routes/autophp.php
    6、D（数据库文件目录）：database/autophp/