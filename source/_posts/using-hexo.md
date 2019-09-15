---
title: using hexo
date: 2019-09-10 12:57:01
tags: Codes
---
- ## 在本机上安装
```
sudo pacman -S gem bundle
sudo gem install bundler jekyll
bundle exec jekyll serve
npm install hexo
hexo init blog &amp;&amp; cd blog
npm i hexo-generator-json-content --save &amp;&amp; npm i hexo-wordcount --save
```

- ## 使用主题
获取 Archer 主题：
git clone "https://github.com/fi3ework/hexo-theme-archer.git" themes/archer
覆盖 Hexo 默认配置文件：
cp ../hexo.config.yml _config.yml
覆盖 Archer 主题默认配置文件：
cp ../hexo.config-theme.archer.yml themes/archer/_config.yml
加入定制的页面布局：
cp ../post-footer.ejs themes/archer/layout/_partial/post-footer.ejs

- ## 安装 Hexo 站点：
npm install
使用hexo new [layout] &lt;title&gt;命令来创建一个文章，也可以手动把写好的文章拷贝到源目录(/docs/_posts/)中。
执行 hexo generate


- ## git and hexo
```
git config --global core.autocrlf false
useradd git
passwd git // 设置密码
su git // 这步很重要，不切换用户后面会很麻烦
cd /home/git/
mkdir -p projects/blog // 项目存在的真实目录
mkdir repos && cd repos
git init --bare blog.git // 创建一个裸露的仓库
cd blog.git/hooks
vi post-receive // 创建hook钩子函数，输入了内容如下（原理可以参考上面的链接）
#!/bin/sh
git --work-tree=/home/git/projects/blog --git-dir=/home/git/repos/blog.git checkout -f
chmod +x post-receive
exit // 退出到 root 登录
chown -R git:git /home/git/repos/blog.git // 添加权限
cat /etc/shells // 查看`git-shell`是否在登录方式里面，有则跳过
which git-shell // 查看是否安装
vi /etc/shells
```
```
git clone git@47.102.85.59:/home/git/repos/blog.git
ssh-copy-id -i /home/lithium/.ssh/id_rsa.pub git@47.102.85.59
ssh git@47.102.85.59
```
- ## 动漫图片
npm install --save hexo-helper-live2d
npm install --save live2d-widget-model-shizuku
