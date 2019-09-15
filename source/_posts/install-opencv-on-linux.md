---
title: install opencv on linux
date: 2019-09-11 21:57:53
tags:
---
# simple guide to install opencv on ubuntu

## system depandencies
```
sudo apt-get install build-essential
sudo apt-get install cmake git libgtk2.0-dev pkg-config libavcodec-dev libavformat-dev libswscale-dev
sudo apt-get install python-dev python-numpy libtbb2 libtbb-dev libjpeg-dev libpng-dev libtiff-dev libjasper-dev libdc1394-22-dev
```

## build opencv
```
git clone https://github.com/opencv/opencv.git
git clone https://github.com/opencv/opencv_contrib.git
cd opencv
mkdir build && cd build
cmake -D CMAKE_BUILD_TYPE=Release -D CMAKE_INSTALL_PREFIX=/usr/local ..
cmake -DCMAKE_INSTALL_PREFIX=/usr
-DCMAKE_BUILD_TYPE=Release
-DENABLE_CXX11=ON
-DBUILD_PERF_TESTS=OFF
-DWITH_XINE=ON
-DBUILD_TESTS=OFF
-DENABLE_PRECOMPILED_HEADERS=OFF
-DCMAKE_SKIP_RPATH=ON
-DBUILD_WITH_DEBUG_INFO=OFF
-DBUILD_SHARED_LIBS=OFF
-Wno-dev .. && make

cd opencv/build/doc/
make -j7 html_docs
sudo make install
git clone https://github.com/opencv/opencv_extra.git
pkg-config –modversion opencv
```
```
## Description of some parameters
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
g++ -o main /home/lithium/Documents/opencv-lena.cpp `pkg-config opencv –cflags –libs`
sudo apt-get install libopencv-dev

## uninstall opencv
sudo rm -r /usr/local/include/opencv2 /usr/local/include/opencv /usr/include/opencv /usr/include/opencv2 /usr/local/share/opencv /usr/local/share/OpenCV /usr/share/opencv /usr/share/OpenCV /usr/local/bin/opencv* /usr/local/lib/libopencv*
sudo apt-get –purge remove opencv-doc opencv-data python-opencv
```

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
