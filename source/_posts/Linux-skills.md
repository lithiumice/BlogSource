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
## tips
```
ip addr show wlp3s0
sudo netstat -lntup | grep ":80"
sudo ss -lntu
sudo lsof -i :80
 sudo nmap -n -PN -sT -sU -p- localhost
tail -f file | grep --line-buffered pattern
sudo growpart /dev/xvda 1
sudo resize2fs /dev/xvda1
sudo timedatectl set-timezone Asia/Shanghai
sudo apt-get install python3-pip build-essential libssl-dev libffi-dev python3-dev
tar --exclude='./folder' --exclude='./upload/folder2' -zcvf /backup/filename.tgz .
mongodump --authenticationDatabase admin
firewall-cmd --permanent --zone=public --add-rich-rule='rule family="ipv4" source address="特定IP" port protocol="tcp" port="特定端口" accept'
tree -I '__pycache__|pyc|Logs' //过滤
find . -name "*.py" | xargs wc -l //统计代码行数
regex 匹配换行符 .*[.\n]+.* or /(.+)/is or [\r][\n] or (\s\S) or Pattern.compile("regex",Pattern.DOTALL);
regex 匹配一行 (.+) 所有英文 [ -~] 非英文[^-~]
使用rsync通过SSH从服务器拉取数据：
rsync -avzP -e "ssh -i ~/sshkey.pem" [email protected]:Projects/sample.csv ~/sample.csv
使用rsync备份服务器数据:
rsync -avzP -e "ssh -i ~/.ssh/id_rsa" root@47.102.85.59:/www/wwwroot/WebPage ./
上传文件:
rsync -avzP -e "ssh -i ~/.ssh/id_rsa" ./ root@47.102.85.59:/www/wwwroot/WebPage
scp ~/Pictures/wlop/* root@47.102.85.59:/www/wwwroot/
```
## 设置代理
```
Pip:
pip3.6 --proxy http://proxy:port install -r requirements.txt

为Git设置代理：
git config --global http.proxy http://proxy:port
git config --global http.sslverify "false"

vim /etc/apt/apt.conf.d/01turnkey
Acquire::http::Proxy "http://your.proxy.here:port/";
```

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
## clean space
sudo du -sh /var/cache/apt
sudo dpkg --list 'linux-image*'
du -sh ~/.cache/thumbnails
sudo apt-get install gtkorphan
use fslint or fdupes
```
set -eu
snap list --all | awk '/disabled/{print $1, $3}' |
    while read snapname revision; do
        snap remove "$snapname" --revision="$revision"
    done
    ```
## more
```
Exec=env LANG=he_IL.UTF-8 abiword %U
lsdesktopf --list gtk zh_TW,zh_CN,en_GB
gendesk -n --pkgname "$pkgname" --pkgdesc "$pkgdesc"
install -Dm644 "$pkgname.desktop" "$pkgdir/usr/share/applications/$pkgname.desktop"
 icotool -x <icon name>.ico
 $ find /path/to/source/package -regex ".*\.\(svg\|png\|xpm\|gif\|ico\)$"
```

## 终端快捷键
Ctrl+L 清屏
Ctrl+C 结束当前命令
Ctrl+A 光标移到行首
Ctrl+E 光标移到行尾
Ctrl+U 删除光标前内容
Ctrl+D 退出当前终端



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
-perm mode 完全匹配 /mode 任意匹配
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
xargs -n1 –i{} 类似for循环，-n1意思是一个一个对象的去处理，-i{} 把前面的对象使用{}取代，mv {} {}_bak 相当于 mv 1.txt 1.txt_bak

find ./*.txt -exec mv {} {}_bak \;  
```
shell file:
```
for file in $(ls $dir | grep .$oldext)
        do
        name=$(ls $file | cut -d. -f1)
        mv $file ${name}.$newext
        done
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
val=`expr $a + $b`
val=`expr 9 \* $b`
read a b c d
```
