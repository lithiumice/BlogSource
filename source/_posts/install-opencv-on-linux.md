---
title: install opencv on linux
date: 2019-09-11 21:57:53
tags:
---
# Linux 安装编译 opencv

## 对于Arch Linux
`
sudo pacman -Sy
sudo pacman -S cmake
sudo pacman -S opencv
set(OpenCV_DIR PATH_TO_BUILD)
`

## system depandencies
```
sudo apt-get install build-essential
sudo apt-get install cmake git libgtk2.0-dev pkg-config libavcodec-dev libavformat-dev libswscale-dev
sudo apt-get install python-dev python-numpy libtbb2 libtbb-dev libjpeg-dev libpng-dev libtiff-dev libjasper-dev libdc1394-22-dev
```

## build opencv with opencv_contrib
(nproc 查看可用编译CPU核数)
```

git clone https://github.com/opencv/opencv.git
git clone https://github.com/opencv/opencv_contrib.git
cd opencv
mkdir build && cd build

cmake \
-DCMAKE_INSTALL_PREFIX=/usr/local \
-DCMAKE_BUILD_TYPE=Release \
-D OPENCV_EXTRA_MODULES_PATH=~/Documents/opencv_contrib/modules \
-D INSTALL_C_EXAMPLES=ON \
-D INSTALL_PYTHON_EXAMPLES=OFF \
-D BUILD_EXAMPLES=ON .. \
-D ENABLE_CXX11=ON \
-D BUILD_PERF_TESTS=OFF \
-D WITH_XINE=ON \
-D BUILD_TESTS=OFF \
-D ENABLE_PRECOMPILED_HEADERS=OFF \
-D CMAKE_SKIP_RPATH=ON \
-D BUILD_WITH_DEBUG_INFO=OFF \
-D BUILD_SHARED_LIBS=OFF \
-Wno-dev .. && make -j7 && make install

cd /etc/ld.so.conf.d/
sudo touch opencv4.conf
sudo sh -c 'echo "/usr/local/lib" > opencv4.conf'
sudo ldconfig
sudo cp -f /usr/local/lib64/pkgconfig/opencv4.pc  /usr/lib/pkgconfig/

PKG_CONFIG_PATH=$PKG_CONFIG_PATH:/usr/lib/pkgconfig
export PKG_CONFIG_PATH
```
## 可选的安装包
```
cd opencv/build/doc/
make -j7 html_docs
sudo make install
git clone https://github.com/opencv/opencv_extra.git
pkg-config –modversion opencv
```

## Description of some parameters
```
build type: CMAKE_BUILD_TYPE=ReleaseDebug
to build with modules from opencv_contrib set OPENCV_EXTRA_MODULES_PATH to <path to opencv_contrib/modules/>
set BUILD_DOCS for building documents
set BUILD_EXAMPLES to build all examples
[optional] Building python. Set the following python parameters:
PYTHON2(3)_EXECUTABLE = <path to python>
PYTHON_INCLUDE_DIR = /usr/include/python<version>
PYTHON_INCLUDE_DIR2 = /usr/include/x86_64-linux-gnu/python<version>
PYTHON_LIBRARY = /usr/lib/x86_64-linux-gnu/libpython<version>.so
PYTHON2(3)_NUMPY_INCLUDE_DIRS = /usr/lib/python<version>/dist-packages/numpy/core/include/
[optional] Building java.
Unset parameter: BUILD_SHARED_LIBS
It is useful also to unset BUILD_EXAMPLES, BUILD_TESTS, BUILD_PERF_TESTS – as they all will be statically linked with OpenCV and can take a lot of memory.
```

## test your opencv
```
pkg-config --libs opencv4
pkg-config --cflags opencv4
pkg-config --modversion opencv4

g++ -o main /home/lithium/Documents/opencv-lena.cpp `pkg-config opencv –cflags –libs`
sudo apt-get install libopencv-dev
```

## uninstall opencv
```
sudo rm -r /usr/local/include/opencv2 /usr/local/include/opencv /usr/include/opencv /usr/include/opencv2 /usr/local/share/opencv /usr/local/share/OpenCV /usr/share/opencv /usr/share/OpenCV /usr/local/bin/opencv* /usr/local/lib/libopencv*
sudo apt-get –purge remove opencv-doc opencv-data python-opencv
```
or
`sudo make uinstall`

## config PATH
```
CPLUS_INCLUDE_PATH=$CPLUS_INCLUDE_PATH:/usr/include/libxml2:/usr/local/include/opencv4/opencv2
export CPLUS_INCLUDE_PATH
C_INCLUDE_PATH=/usr/include/libxml2:/usr/local/include/opencv4/opencv2/
export C_INCLUDE_PATH
LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/MyLib
export LD_LIBRARY_PATH
LIBRARY_PATH=$LIBRARY_PATH:/MyLib
export LIBRARY_PATH
```
