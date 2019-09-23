---
title: learn php
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-16 21:06:34
password:
summary:
tags:
categories:
---
### for php > 7.2
```
pecl install libsodium
extension=sodium.so
```
## install php
```
pecl install libsodium
extension=sodium.so >> php.ini
php -a //interactive shell

$ sudo add-apt-repository ppa:ondrej/php
$ sudo apt-get update
$ sudo apt-get upgrade php
$ sudo apt-get install php7.2-（*）
$ sudo apt-get install php7.2-mbstring php7.2-mysql

sudo pacman -S php-apache php-cgi php-fpm php-gd  php-embed php-intl php-imap  php-redis php-snmp //basic
pacman -Qi php-fpm
```

## don't show error information
```
vim /etc/php.ini
error_reporting = E_ALL
display_errors = On

error_reporting(-1);
ini_set('display_errors', 1);
$img = imagecreatefromjpeg("myimage.jpg");   // load the image-to-be-saved

// 50 is quality; change from 0 (worst quality,smaller file) - 100 (best quality)
imagejpeg($img,"myimage_new.jpg",50);

unlink("myimage.jpg");

$url='http://www.baidu.com/';
$html = file_get_contents($url);
//print_r($http_response_header);
ec($html);
printhr();
printarr($http_response_header);
printhr();
```

## prevent SQL inject
just use code like below:
```
$mysqli=new mysqli("localhost","mysql_user","mysql_pwd");
if (mysqli_connect_errno())
{
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
$username = $_POST['user'];
$password = $_POST['pwd'];
if ($stmt = $mysqli->prepare("SELECT * FROM Person WHERE username=? AND password=?"))
{
  $stmt->bind_param("ss",$username,$password);
  $stmt->execute();
}
$mysqli->close();
```

### mysql command
```
';'
?         (\?) Synonym for `help'.
clear     (\c) Clear the current input statement.
connect   (\r) Reconnect to the server. Optional arguments are db and host.
delimiter (\d) Set statement delimiter.
edit      (\e) Edit command with $EDITOR.
ego       (\G) Send command to MariaDB server, display result vertically.
exit      (\q) Exit mysql. Same as quit.
go        (\g) Send command to MariaDB server.
help      (\h) Display this help.
nopager   (\n) Disable pager, print to stdout.
notee     (\t) Don't write into outfile.
pager     (\P) Set PAGER [to_pager]. Print the query results via PAGER.
print     (\p) Print current command.
prompt    (\R) Change your mysql prompt.
quit      (\q) Quit mysql.
rehash    (\#) Rebuild completion hash.
source    (\.) Execute an SQL script file. Takes a file name as an argument.
status    (\s) Get status information from the server.
system    (\!) Execute a system shell command.
tee       (\T) Set outfile [to_outfile]. Append everything into given outfile.
use       (\u) Use another database. Takes database name as argument.
charset   (\C) Switch to another charset. Might be needed for processing binlog with multi-byte charsets.
warnings  (\W) Show warnings after every statement.
nowarning (\w) Don't show warnings after every statement.
```

## 服务器php设置
```
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
#或者
location / {
    if (!-d $request_filename){
        set $rule_0 1$rule_0;
    }
    if (!-f $request_filename){
        set $rule_0 2$rule_0;
    }
    if ($rule_0 = "21"){
        rewrite ^/(.*)$ /index.php?/$1 last;
    }
}
```
