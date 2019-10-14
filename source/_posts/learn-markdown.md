---
title: learn markdown
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-14 18:26:40
password:
summary:
tags:
categories:
---
|  表头   | 表头  |
|  ----  | ----  |
| 单元格  | 单元格 |
| 单元格  | 单元格 |

-: 设置内容和标题栏居右对齐。\
:- 设置内容和标题栏居左对齐。\
:-: 设置内容和标题栏居中对齐。

<img src="./screenshot/main.jpg" width="360" height="640">
![](screenshot/his.jpg)
[base64str]:data:image/png;base64,iVBORw0......
<img src="./xxx.png" width = "300" height = "200" alt="图片名称" align=center />


#write{
       max-width:  660px;
}
#img { zoom: 50%; }


+-- _config.yml
+-- _drafts
|   +-- begin-with-the-crazy-ideas.textile
|   +-- on-simplicity-in-technology.markdown
tree --dirsfirst --charset=ascii /path/to/directory

pandoc -o hello.docx hello.md
hexo g --debug

R:67 G:142 B:219
