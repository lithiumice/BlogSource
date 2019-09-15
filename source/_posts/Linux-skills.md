---
title: Linux skills
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-12 22:31:18
password:
summary:
tags:
categories:
---

## 使用命令压缩图片
安装`sudo pacman -S imagemagick`
支持JPG, BMP, PCX, GIF, PNG, TIFF, XPM和XWD等

1.转换格式`convert 1.jpg 1.png`
2.-resize 1080x780
3.-sample 50%x50%
4.-rotate 272
5.-fill black -pointsize 60 -front helvetica -draw 'hello' //front use Ghostscript
5.-quality 0-100

### 批量转换
`for %f in (*.jpg) do convert "%f" "%~nf.png"`
`for %f in (*.jpg) do convertv -quality 70 "%f" "%~nf.jpg"`
`convert -quality 70 *.jpg`
composite加水印

## Linux 设置swap分区
```
dd if=/dev/zero of=/mnt/swap bs=1m count=1024 #1G
mkswap /mnt/swap
swapon /mnt/swap

hostnamectl set-hostname mail.ewomail.cn
https://github.com/gyxuehu/EwoMail.git
sh ./start.sh ewomail.cn -f
```
