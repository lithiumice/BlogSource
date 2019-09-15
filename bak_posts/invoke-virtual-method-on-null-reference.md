---
title: invoke virtual method ... on null reference
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-14 14:59:23
password:
summary:
tags:
categories:
---

在fragment中调用显示布局文件,需要先获得View对象,然后才能使用findViewById方法:
```
View v = inflater.inflate(R.layout.fragment, container, false);
listView = v.findViewById(R.id.list_view);

MyDialog myDialog = new MyDialog(getContext());
myDialog.show();
```
