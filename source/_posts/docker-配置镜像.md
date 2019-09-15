---
title: docker 配置镜像
top: true
cover: false
toc: true
mathjax: true
date: 2019-09-14 14:38:53
password:
summary:
tags: docker linux
categories:
---

## 常用的加速地址
http://f1361db2.m.daocloud.io
https://hub.daocloud.io/
https://c.163.com/hub#/m/home/
https://registry.docker-cn.com
http://hub-mirror.c.163.com
https://3laho3y3.mirror.aliyuncs.com
http://f1361db2.m.daocloud.io
https://mirror.ccs.tencentyun.com

## 使用shell命令配置
```shell
#!/bin/bash
sudo mkdir -p /etc/docker
sudo tee /etc/docker/daemon.json <<-'EOF'
{
  "registry-mirrors"["https://wl4i5g2z.mirror.aliyuncs.com"]
"live-restore": true
}
EOF
sudo systemctl daemon-reload
sudo systemctl restart docker
```

## 直接修改service文件
```
vim /usr/lib/systemd/system/docker.service

# 在dockerd后面加参数
ExecStart=/usr/bin/dockerd --registry-mirror=<your accelerate address>

sudo systemctl daemon-reload
sudo systemctl restart docker
```
