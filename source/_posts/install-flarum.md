---
title: install flarum
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-12 22:19:30
password:
summary:
tags:
categories:
---

## test flarum
[github](https://github.com/flarum/flarum.git)

1.install composer:
`composer create-project flarum/flarum . --stability=beta`
2.in order to use php
```
sudo apt-get -y install gcc make autoconf libc-dev pkg-config
sudo apt-get -y install php7.2-dev
sudo apt-get -y install libmcrypt-dev
sudo pecl install mcrypt-1.0.2 //for php>7.3
```
3.for arch
`extra/php-sodium`
`php-set = extension=sodium`in /etc/php/php.ini
