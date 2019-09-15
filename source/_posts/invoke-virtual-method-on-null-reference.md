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

### 获取当前Activity和Context
public MyLocationListener(View view){
    this.view=view;
}
View cv = getWindow().getDecorView();
getActivity().getApplicationContext()


### CoordinatorLayout layout_anchor 不正常
automatically offset a view to place it below the AppBarLayout. It only works with an AppBarLayout
app:layout_behavior="@string/appbar_scrolling_view_behavior"

### 在fragment view中添加baidumap的mapview方法
SDKInitializer.initialize(getActivity().getApplicationContext());
View view=inflater.inflate(R.layout.fragment_gallery,container,false);
mapView=view.findViewById(R.id.bmapview);
mapView.onCreate(getContext(),savedInstanceState);
