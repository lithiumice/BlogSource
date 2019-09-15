---
title: install nodebb
date: 2019-09-10 14:12:31
tags:
---

## For Centos

```
yum -y install epel-release //for centos 7
yum -y groupinstall "Development Tools"
yum -y install git redis ImageMagick npm

curl https://raw.githubusercontent.com/creationix/nvm/v0.13.1/install.sh | bash
$ export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh"
source ~/.bash_profile
nvm list-remote
nvm install v0.12.7 # as of this writing check the result of the list-remote to see all choices
//use v6.9.5 as stable
$ export NVM_NODEJS_ORG_MIRROR=http://npm.taobao.org/mirrors/node
$ export NVM_IOJS_ORG_MIRROR=http://npm.taobao.org/mirrors/iojs
sudo npm config set registry http://registry.npm.taobao.org/

systemctl start redis
systemctl enable redis

cd /path/to/nodebb/install/location
git clone -b v1.10.x https://github.com/NodeBB/NodeBB nodebb
cd nodebb
./nodebb setup
firewall-cmd --zone=public --add-port=4567/tcp --permanent
//or  --add-service=http
firewall-cmd --reload
./nodebb start
```
if you come across **open '/opt/nodebb/node_modules/sharp/**,then try:
```
npm install
./nodebb setup
```

## For arch
```
 sudo pacman -S git nodejs npm redis imagemagick icu
 git clone -b v1.10.x https://github.com/NodeBB/NodeBB.git nodebb
 cd nodebb
 ./nodebb setup
 ./nodebb start
 ```

## proxy reverse
 ```
in httd.conf
LoadModule proxy_module /usr/lib/apache2/modules/mod_proxy.so
LoadModule proxy_http_module /usr/lib/apache2/modules/mod_proxy_http.so
<VirtualHost *:80>     
        DocumentRoot "/home/test/tomcat/webapps/ROOT”     
        ServerName test.test.test     
        ProxyPass /    http://127.0.0.1:8080/
        ProxyPassReverse /   http://127.0.0.1:8080/
</VirtualHost>

in apache2.configuration
Include ports.conf
Include httpd.conf
ServerName 127.0.0.1

sudo apache2ctl -k stop
sudo apache2ctl -k start
```
## nginx ProxyPassReverse
```
Insert the below lines into the location / {} segment:
  ##########################################
  server {
      listen 80;

      server_name www.xxx.com; # 你的域名

     location / {
          proxy_set_header X-Real-IP $remote_addr;
          proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
          proxy_set_header X-Forwarded-Proto $scheme;
          proxy_set_header Host $http_host;
          proxy_set_header X-NginX-Proxy true;

          proxy_pass http://127.0.0.1:4567;
          proxy_http_version 1.1;
          proxy_set_header X-Real-IP $remote_addr;
          proxy_set_header Host $host;
          proxy_set_header Upgrade $http_upgrade;
          proxy_set_header Connection 'upgrade';
          proxy_cache_bypass $http_upgrade;
          proxy_redirect off;

          # Socket.IO Support
          proxy_http_version 1.1;
          proxy_set_header Upgrade $http_upgrade;
          proxy_set_header Connection "upgrade";
      }

      # 配置 502 页? 参考: 高级 - 配置 Nginx
  }
  ##########################################

```

## use **forever** to manage NodeBB
npm install forever -g
 forever start app.js
