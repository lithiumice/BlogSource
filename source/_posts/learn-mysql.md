---
title: learn mysql
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-16 22:55:00
password:
summary:
tags:
categories:
---
show variables like port;
set name utf8;
source test.sql
mysqldump -u dbuser -p dbname > dbname.sql
mysql -uabc_f -p abc < abc.sql
mysqldump -u用户名 -p密码 -d 数据库名
`title`, `author`, `content`
mysqldump -u用户名 -p database
SELECT COUNT(*) FROM database
sed -i 's/tb_poems/poems/g' chinese-poetry-3.sql
ALTER TABLE poems DROP id;
ALTER TABLE poems ADD id int not null auto_increment,ADD primary key(id);


```
SELECT * FROM poems AS t1 JOIN(SELECT ROUND
RAND() * (SELECT MAX(id) FROM poems)) AS id) AS t2
WHERE t1.id >= t2.id
ORDER BY t1.id ASC LIMIT 5;

SELECT * FROM `table`
WHERE id >= (SELECT floor( RAND() * ((SELECT MAX(id) FROM `table`)-(SELECT MIN(id) FROM `table`)) + (SELECT MIN(id) FROM `table`))) 
ORDER BY id LIMIT 1;

SELECT *
FROM `table` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `table`)-(SELECT MIN(id) FROM `table`))+(SELECT MIN(id) FROM `table`)) AS id) AS t2
WHERE t1.id >= t2.id
ORDER BY t1.id LIMIT 1;

SELECT * FROM poems as u JOIN (SELECT ROUND(RAND() * (SELECT MAX(id) FROM poems)) AS id ) AS u2 WHERE u.id >= u2.id ORDER BY u.id DESC LIMIT 1;

explain select * from poems order by RAND() limit 1\G
```
1. best method
SELECT *
FROM poems AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM poems)-(SELECT MIN(id) FROM poems))+(SELECT MIN(id) FROM poems)) AS id) AS t2
WHERE t1.id >= t2.id
ORDER BY t1.id LIMIT 1;

2. second rank method
SELECT * FROM poems
WHERE t1.id >= (SELECT floor( RAND() * ((SELECT MAX(t1.id) FROM poems)-(SELECT MIN(t1.id) FROM poems)) + (SELECT MIN(t1.id) FROM poems))) 
ORDER BY t1.id LIMIT 1;
