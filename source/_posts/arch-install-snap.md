---
title: arch install snap
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-17 12:45:11
password:
summary:
tags:
categories:
---
## Arch 上安装snap
1. 编译安装
git clone https://aur.archlinux.org/snapd.git
cd snapd
makepkg -si
sudo systemctl enable --now snapd.socket
sudo ln -s /var/lib/snapd/snap /snap
systemctl enable --now apparmor.service
systemctl enable --now snapd.apparmor.service
snapd安装脚本/etc/profile.d/snapd.sh
2. 直接安装
sudo pacman -S snapd

## 出现`Post https://api.snapcraft.io/v2/snaps/refresh:invalid proxy URL port "port"`错误的解决方法
cd /etc/systemd/system/snapd.service.d
cp override.conf override.conf.bak
sudo nano override.conf
`
Environment="http_proxy=http://127.0.0.1:port"
Environment="https_proxy=http://127.0.0.1:port"
`
sudo systemctl daemon-reload
sudo systemctl restart snapd
## 安装redis-desktop-manager
sudo snap install redis-desktop-manager
如果你无法找到redis-desktop-manager命令,那么应该是环境变量错误:
`
sudo nano /etc/profile
在后面加入$PATH=$PATH:/var/lib/snapd/snap/bin/
`
也可以直接执行/var/lib/snapd/snap/bin/redis-desktop-manager.rdm
