---
title: linux shell intro
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-14 14:22:43
password:
summary:
tags: linux shell
categories: linux shell
---
## 终端快捷键
Ctrl+L 清屏
Ctrl+C 结束当前命令
Ctrl+A 光标移到行首
Ctrl+E 光标移到行尾
Ctrl+U 删除光标前内容
Ctrl+D 退出当前终端

## get string slice


## find命令
```
find ./ -name "name*"
find / -type f -size +10M -exec ls -lh {} \;
find . -name "[A-Za-b]*" -print
find -L . 跟随所以符号链接
-regex ".*/[0-9]*/.c"
-ipath,-iregex,-iwholename,-iname 对大小写不敏感
-size ‘M’:for Megabytes (units of 1048576 bytes)
-exec ls -l {} \;
-atime/天，-amin/分 ：用户最近一次访问时间。
-mtime/天，-mmin/分：文件最后一次修改时间。
-ctime/天，-cmin/分 ：文件数据元最后一次修改时间
-type f:file d:dir l:linkfile s:socket b:block c:charDevice p:pipfile
字符设备:可以顺序读取(字符寻址) 块设备512B:可随机访问
-regex不是匹配文件名，而是匹配完整的文件名（包括路径）
-ok 确认

-perm
-perm mode       File's  permission  bits  are  exactly mode.
-perm -mode     All  of the permission bits mode are set for the file.
-perm /mode     Any of the permission bits mode are set for the file.

-printf
%p: 输出文件名，包括路径名
%f: 输出文件名，不包括路径名
%m: 以8进制方式输出文件的权限
%g: 输出文件所属的组
%h: 输出文件所在的目录名
%u: 输出文件的属主名
```

## rename 命令
```
1、删除所有的 .bak 后缀：
rename 's/\.bak$//' *.bak

2、把 .jpe 文件后缀修改为 .jpg：
rename 's/\.jpe$/\.jpg/' *.jpe

3、把所有文件的文件名改为小写：
rename 'y/A-Z/a-z/' *

4、将 abcd.jpg 重命名为 abcd_efg.jpg：
for var in *.jpg; do mv "$var" "${var%.jpg}_efg.jpg"; done

5、将 abcd_efg.jpg 重命名为 abcd_lmn.jpg：
for var in *.jpg; do mv "$var" "${var%_efg.jpg}_lmn.jpg"; done

6、把文件名中所有小写字母改为大写字母：
for var in `ls`; do mv -f "$var" `echo "$var" |tr a-z A-Z`; done

7、把格式 *_?.jpg 的文件改为 *_0?.jpg：
for var in `ls *_?.jpg`; do mv "$var" `echo "$var" |awk -F '_' '{print $1 "_0" $2}'`; done

8、把文件名的前三个字母变为 vzomik：
for var in `ls`; do mv -f "$var" `echo "$var" |sed 's/^.../vzomik/'`; done

9、把文件名的后四个字母变为 vzomik：
for var in `ls`; do mv -f "$var" `echo "$var" |sed 's/....$/vzomik/'`; done

10. 把.txt变成.txt_bak 的后缀

ls *.txt|xargs -n1 -i{} mv {} {}_bak
xargs -n1 –i{} 类似for循环，-n1意思是一个一个对象的去处理，-i{} 把前面的对象使用{}取代，mv {} {}_bak 相当于 mv 1.txt 1.txt_bak

find ./*.txt -exec mv {} {}_bak \;  
```
```
$#	 传递到脚本的参数个数
 $*	 以一个单字符串显示所有向脚本传递的参数。如”$*”用「”」括起来的情况、以”$1 $2 … $n”的形式输出所有参数。即无法用for…in遍历每一个元素
 $$	 脚本运行的当前进程ID号
 $!	 后台运行的最后一个进程的ID号
 $@	 与$*相同，但是使用时加引号，并在引号中返回每个参数。 如”$@”用「”」括起来的情况、以”$1” “$2” … “$n” 的形式输出所有参数。
 $-	 显示Shell使用的当前选项，与set命令功能相同。
 $?	 显示最后命令的退出状态。0表示没有错误，其他任何值表明有错误。”　

 运算符	 说明	 举例
 只支持数字
 -eq	 检测两个数是否相等，相等返回 true。	 [ $a -eq $b ] 返回 false。
 -ne	 检测两个数是否相等，不相等返回 true。	 [ $a -ne $b ] 返回 true。
 -gt	 检测左边的数是否大于右边的，如果是，则返回 true。	  [ $a -gt $b ] 返回 false。
 -lt	 检测左边的数是否小于右边的，如果是，则返回 true。	 [ $a -lt $b ] 返回 true。
 -ge	 检测左边的数是否大于等于右边的，如果是，则返回 true。	  [ $a -ge $b ] 返回 false。
 -le	 检测左边的数是否小于等于右边的，如果是，则返回 true。	  [ $a -le $b ] 返回 true。


 运算符	 说明	 举例
 =	 检测两个字符串是否相等，相等返回 true。	 [ $a = $b ] 返回 false。
 !=	 检测两个字符串是否相等，不相等返回 true。	 [ $a != $b ] 返回 true。
 -z	 检测字符串长度是否为0，为0返回 true。	 [ -z $a ] 返回 false。
 -n	 检测字符串长度是否为0，不为0返回 true。	  [ -n $a ] 返回 true。
 str	 检测字符串是否为空，不为空返回 true。	 [ $a ] 返回 true。

 [-f file] 检测文件是否为普通文件
　　[-d file] 检测是否为目录
　　[-s file] 检测文件是否为空
　　[-e file] 检测文件是否存在
　　[-r file] 检测文件是否可读
　　[-w file] 检测文件是否可写
　　[-x file] 检测文件是否可执行
```

## 基本语法
```
var=`ls`
for file in $var
do
echo $file
done
readonly var
unset var
echo ${var[@]}
echo ${var[*]}
[$a -eq $b]

```
