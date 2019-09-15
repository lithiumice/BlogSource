---
title: apache-php-config
date: 2019-09-10 21:12:03
tags:
---
vim /usr/local/apache2/conf/httpd.conf
<Directory />
    Options FollowSymLinks
    AllowOverride None
    Order deny,allow
    Deny from all          
</Directory>

AddType application/x-gzip .gz .tgz
在其下面添加：
ddType application/x-httpd-php .php

<IfModule dir_module>
    DirectoryIndex index.html//DirectoryIndex index.html index.htm index.php
</IfModule>

ServerName localhost:80  
/usr/local/apache2/bin/apachectl -t
