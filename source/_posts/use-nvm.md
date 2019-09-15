---
title: use nvm
date: 2019-09-11 21:59:05
tags:
---
### 先卸载系统的node
```shell
sudo rm /usr/local/bin/npm
sudo rm /usr/local/share/man/man1/node.1
sudo rm /usr/local/lib/dtrace/node.d
sudo rm -rf ~/.npm
sudo rm -rf ~/.node-gyp
sudo rm /opt/local/bin/node
sudo rm /opt/local/include/node
sudo rm -rf /opt/local/lib/node_modules
```
### 常用命令
```
nvm install 4.2.2
nvm ls-remote
nvm use 4.2.2
nvm use node //newest
nvm alias awesome-version 4.2.2
nvm run 4.2.2 --version
```

在当前终端的子进程中运行特定版本的 Node
`nvm exec 4.2.2 node --version`
