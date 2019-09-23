---
title: BT linux
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-16 21:10:50
password:
summary:
tags:
categories:
---
```
Centos安装脚本
yum install -y wget && wget -O install.sh http://download.bt.cn/install/install.sh && sh install.sh
Ubuntu/Deepin安装脚本
wget -O install.sh http://download.bt.cn/install/install-ubuntu.sh && sudo bash install.sh
Debian安装脚本
wget -O install.sh http://download.bt.cn/install/install-ubuntu.sh && bash install.sh
Fedora安装脚本
wget -O install.sh http://download.bt.cn/install/install.sh && bash install.sh
卸载 /etc/init.d/bt stop && chkconfig --del bt && rm -f /etc/init.d/bt && rm -rf /www/server/panel
强制修改MySQL管理(root)密码，如要改成123456
cd /www/server/panel && python tools.py root 123456
查看宝塔日志
cat /tmp/panelBoot.pl
清理登陆限制
rm -f /www/server/panel/data/*.login
查看数据库错误日志
cat /www/server/data/*.err
站点配置文件目录(nginx)
/www/server/panel/vhost/nginx
数据库备份目录
/www/backup/database
数据存储目录
/www/server/data
