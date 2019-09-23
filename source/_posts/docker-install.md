---
title: docker install
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-19 20:46:22
password:
summary:
tags:
categories:
---
## one command
```
sudo groupadd docker
sudo usermod -aG docker $USER
newgrp docker
sudo mkdir -p /etc/docker
sudo tee /etc/docker/daemon.json <<-'EOF'
{
  "registry-mirrors": ["https://registry.docker-cn.com","http://hub-mirror.c.163.com","http://f1361db2.m.daocloud.io"]
}
EOF
sudo systemctl daemon-reload
sudo systemctl restart docker
```
## in centos
```
yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo
yum install -y yum-utils device-mapper-persistent-data lvm2
yum list docker-ce --showduplicates | sort -r
yum install docker-ce
sudo systemctl start docker
sudo systemctl enable docker
docker version
```

## use portainer to manage
docker pull portainer/portainer:latest
docker volume create portainer_data
docker run -d -p 9000:9000 -v /var/run/docker.sock:/var/run/docker.sock -v portainer_data:/data portainer/portainer(LINUX)
or docker run -d -p 8000:8000 -p 9000:9000 --name portainer --restart always -v \\.\pipe\docker_engine:\\.\pipe\docker_engine -v portainer_data:C:\data portainer/portainer(WIN)

## use bt panel
通过host模式运行宝塔镜像
docker run -tid --name baota --net=host --privileged=true --restart always -v ~/wwwroot:/www/wwwroot pch18/baota
通过bridge模式运行宝塔镜像
docker run -tid --name baota -p 80:80 -p 443:443 -p 8888:8888 -p 888:888 --privileged=true --restart always -v ~/wwwroot:/www/wwwroot pch18/baota
登陆地址 http://{{面板ip地址}}:8888 初始账号 username 初始密码 password
