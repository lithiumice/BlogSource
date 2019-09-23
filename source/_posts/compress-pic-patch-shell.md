---
title: compress PIC shell 批量压缩图片脚本
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-14 23:03:28
password:
summary:
tags:
categories:
---
<!-- col l8 offset-l2 m10 offset-m1 s10 offset-s1 center-align text -->
<!-- coverPostsCount > 0 && theme.cover.showPrevNext -->
在写博客的时候需要将图片上传到服务器,很显然如果一张图片未经压缩有时会达到2-3M,严重影响访问者的加载速度. 所以我写了一个脚本放在博客根目录,能够历遍文件夹下的所以图片并将大于指定大小的图片进行压缩.

```shell
#!/bin/bash

SPATH=./
maxsize=921600 #900KB
AFTERFIX=""

COMPRESS () {
        imgpath=$1
        filesize=`ls -l $imgpath | awk '{ print $5 }'`
        echo $filesize
        if [ $filesize -ge $maxsize ]
            then
              echo compressing $file
              afterfix=${filename##*.}
              name=${filename%.*}
              convert -quality 80% $imgpath $imgpath
              # convert -quality 80% $imgpath "${name}s.${afterfix}"
              echo compressed $imgpath
            else
              echo skiped $imgpath
        fi
      }


echo "begin"
filelist=`find $1 -regex ".*/.*.jpg" -o -regex ".*/.*.png"`
for file in $filelist
 do
  if [ -f $file ]
   then
    COMPRESS $file
  fi
done
echo "finished"

```
