# myselfmvc

基于Composer的轻量级PHP应用框架
=======================================
- 基于composer的包管理器
- 路由规则灵活，可随意自定义路由规则
- 包含默认路由：controller/model/arg1/arg2...
- 轻量级的ORM ，轻松实现CRUD
- 轻量而强大的模版引擎，安全过滤各种有...
- 配置文件就是PHP数组，基本无配置
- 数据库迁移采用migration，so easy！

基本使用
---------------------------------
 1. composer create-project jinfatian/myselfmvc  myselfmvc
 2. 编辑 Apache下的httpd-vhost.conf文件，添加如下内容：
 
 **注意以下的目录改成自己对应的本地目录！**
 
     ```apache
     
    <Directory "D:/demos/MyMVCFramework/app/web">
         Options Indexes FollowSymLinks Includes ExecCGI
         AllowOverride All
         Require all granted
     </Directory>
    
     <VirtualHost *:80>
         ServerAdmin webmaster@my.com
         DocumentRoot "D:/demos/MyMVCFramework/app/web"
         ServerName my.mvc.com
         ErrorLog "logs/my.mvc.com.com-error.log"
         CustomLog "logs/my.mvc.com-access.log" common
     </VirtualHost>
     
 ```
 ```
 nginx
    
    location / {
          if (!-e $request_filename) {
             rewrite ^/(.*)$ /index.php?$1 last;
          }
          index index.html index.htm index.php;
          autoindex on;
      }
 ```
 
3. 启动服务器和MySQL
4. 在MySQL中创建一个数据库myselfmvc，用户名：xxx， 密码：xxxxxx。
当然了，如果本地已经有能用的数据库，那么可以去修改config/base.php中的配置即可。

 **注意：这个用户需要有全部的数据库操作权限！**
 
5. 访问：http://my.mvc.com/home/migrate 执行初始化，生成todo数据表。
6. 访问：http://my.mvc.com/todo/index  可以执行CRUD的各种操作。

 
补充
---------------------------------
1. 系统自带默认路由，一般情况不需要去配置路由，自定义路由请查看web目录下的base.php的示例。
 配置参考 <http://www.slimframework.com/docs/v3/tutorial/first-app.html>
2. 模版引擎参考 <https://latte.nette.org/>
3. ORM的使用参考 <https://github.com/lox/pheasant>

 

