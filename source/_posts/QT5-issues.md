---
title: QT5 issues
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-16 18:41:24
password:
summary:
tags:
categories:
---
## qt6 libraries errors
```
strings /usr/lib64/libstdc++.so.6 | grep GLIBC
echo 'LD_LIBRARY_PATH=/usr/local/qt5.13.0/5.13.0/gcc_64/lib/' >> sudo tee ~/.bashrc
echo 'export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/usr/bin' >> sudo tee ~/.bashrc
source ~/.bashrc
```
or
```
echo 'LD_LIBRARY_PATH=/usr/local/qt5.13.0/5.13.0/gcc_64/lib/' | sudo tee -a /etc/profile
echo 'export LD_LIBRARY_PATH=$LD_LIBRARY_PATH' | sudo tee -a /etc/profile
source /etc/profile
```
cp /etc/skel/.profile

## as for zsh bash
```
strings /usr/lib64/libstdc++.so.6 | grep GLIBC
echo 'LD_LIBRARY_PATH=/usr/local/qt5.13.0/5.13.0/gcc_64/lib/' >> sudo tee ~/.zshrc
echo 'export LD_LIBRARY_PATH=$LD_LIBRARY_PATH' >> sudo tee ~/.zshrc
source ~/.zshrc
```


add a custom .conf file to /etc/ld.so.conf.d, for example
sudo gedit /etc/ld.so.conf.d/randomLibs.conf
inside the file you are supposed to write the complete path to the directory that contains all the libraries that you wish to addcman to the system, for example:
```
/usr/local/qt5.13.0/5.13.0/gcc_64/lib
/lib/x86_64-linux-gnu
```

## update qt gcc lib
```
cp /home/gcc-5.2.0/gcc-temp/stage1-x86_64-unknown-linux-gnu/libstdc++-v3/src/.libs/libstdc++.so.6.0.21 /usr/lib64
cd /usr/lib64
rm -rf libstdc++.so.6
ln -s libstdc++.so.6.0.21 libstdc++.so.6
```

```
sudo rm -f /usr/plugins/imageformats/libqico.so
sudo ln -s /usr/local/Qt5.13.0/5.13.0/gcc_64/plugins/imageformats/libqico.so
 /usr/plugins/imageformats/libqico.so
export LD_PRELOAD=/usr/local/Qt5.13.0/5.13.0/gcc_64/plugins/imageformats/libqico.so

```

## lib errors
```
cat /etc/ld.so.conf
echo "/usr/local/lib" | sudo tee /etc/ld.so.conf
sudo ldconfig
```
or
```
$libfiles=`find /usr/local/qt5.13.0/5.13.0/gcc_64/`
for libfile in $libfiles
  do
    filename=${$libfile}
