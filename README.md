## 关于Fidis

Fidis（全称Flexible information data integrate system，柔性信息与数据集成系统），作为智物联工业物联网体系中的应用系统平台，承担着MixIOT应用数据的展示，以及与MixIOT系统的操作和交互。

同时，Fidis系统作为底层应用平台，支持基于OpenFrame开发框架进行应用的二次开发。

## 入门指导

#### 1. 运行环境
- PHP >= 7.1.3
- laravel/framework >= 5.7.0
- nwidart/laravel-modules >= 4.0
- mysql >= 5.7.21
- PHP OpenSSL 扩展
- PHP PDO 扩展
- PHP Mbstring 扩展
- PHP Tokenizer 扩展
- PHP XML 扩展
- PHP Ctype 扩展
- PHP JSON 扩展

#### 2.快速上手

- **源码下载**：
  
  - 直接从当前仓库下载或clone代码到本地；
  
  - 通过论坛置顶帖中的源码包下载源码，论坛地址：[MixIOT论坛]( http://mixiot.mixlinker.com/)
  
- **环境安装**

  - Laravel运行环境及依赖组件安装，如下：

    ```shell
    composer install
    ```

  - Vue运行环境及依赖组件安装，如下：

    ```shell
    #原生镜像
    npm install
    
    #淘宝镜像
    cnpm install
    ```

- **系统配置**

  - 系统配置，修改fidis/config/system.php配置文件中相关地址为实际MixIOT系统地址；
  - 虚拟主机，本地或者服务器上，在Nginx/Apache中配置虚拟主机，映射到fidis/public目录下，再通过虚拟域名访问系统；

- **运行测试**

  在浏览器中，输入配置的虚拟域名，访问Fidis系统，即可进入门户中心系统登录界面，输入对应的账号、密码就可登录到门户中心系统中。

## 文档手册

MixIOT&Fidis相关介绍文档：[Mixlinker知识体系](http://doc.mixlinker.com/)

Fidis系统开发手册：[Fidis系统手册](http://mixiot.mixlinker.com/forum.php)


## License

The Fidis is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
