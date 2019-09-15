---
title: docker+mailserver
url: 123.html
id: 123
categories:
  - docker
  - Linux
date: 2019-09-08 21:04:33
tags:
---

使用Ewomail搭建邮件服务器(需要纯洁系统环境) https://gitee.com/laowu5/EwoMail https://gitee.com/laowu5/EwoMail.git 后台管理端http://ip:8010 邮箱登录端http://IP:8000 使用docker运行mail容器: mkdir MailServer cd MailServer docker pull tvial/docker-mailserver:latest curl -o setup.sh https://raw.githubusercontent.com/tomav/docker-mailserver/master/setup.sh; chmod a+x ./setup.sh curl -o docker-compose.yml https://raw.githubusercontent.com/tomav/docker-mailserver/master/docker-compose.yml.dist curl -o .env https://raw.githubusercontent.com/tomav/docker-mailserver/master/.env.dist docker-compose up -d mail ./setup.sh email add <user@domain> \[<password>\] ./setup.sh config dkim 设置DNS域名解析: cat config/opendkim/keys/domain.tld/mail.txt 更新docker容器: docker-compose down docker pull tvial/docker-mailserver:latest docker-compose up -d mail 搭建邮箱服务器的方案: postfix dovecot postfix-admin(基本) iredmail, Ewomail(开源免费) sendcloud ,SendGrid、MailChimp、Amazon SES、SendCloud、Mailgun,Winmail、 Exchange、Mdaemon、Winwebmail、Imail、Coremail、U-Mail、TurboMail、iGENUS 、Icewarp、易邮、金笛、MagicMail等(收费)