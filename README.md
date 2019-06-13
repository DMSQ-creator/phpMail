# phpmail
## 欢迎来到phpMail wiki！
此程序测试完成ssl加密发邮件、

需要自行配置i.php

## 测试环境xampp Apache

## 相关问题总结：

*  XAMPP 开启 SSL （https）
编辑 ..xampp/apache/bin/php.ini 文件，找到 “;extension=php_openssl.dll” (去掉前面的;号注释)

   我的 XAMPP 没有找到这句话 ，直接添加 extension=php_openssl.dll  大概988行
另外，需要配置 httpd-ssl.conf 文件（*\xampp\apache\conf\extra\httpd-ssl.conf）
大概86行 配置 DocumentRoot 和 ServerName ，改成自己定义的（如果没有更改默认配置的话就不用再配置了）

## 有问题反馈
在使用中有任何问题，欢迎反馈给我，可以用以下联系方式跟我交流

* 邮件(3121236898#qq.com, 把#换成@)
* QQ: 3121236898
