---
title: learn android
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-17 12:39:17
password:
summary:
tags:
categories:
---

##more
 android.os.Build.DEVICE
compile 'jp.wasabeef:glide-transformations:2.0.1'
greendao { schemaVersion 1 }
greendao { schemaVersion 2 }
http://47.102.85.59:8000/api/poetry/ {
    exclude group: 'com.intellij', module: 'annotations'
}
## set navigationView
ViewGroup.LayoutParams params = navigationView_main.getLayoutParams();
       params.width = getResources().getDisplayMetrics().widthPixels * 1 / 2;
       navigationView_main.setLayoutParams(params);

## linux ddms
/home/skart/ide/android/sdk/tools/lib/monitor-x86_64
/home/skart/ide/android/sdk/platform-tools
sudo chmod +x hprof-conv

## get fragment
mFirstFragment=getSupportFragmentManager();
mFragment=mFirstFragment.findFragmentById(R.id.animation_view);

## lines
<View  
   android:layout_width="fill_parent"  
    android:layout_height="1px"
   android:background="@android:color/darker_gray"  />

## android.os.NetworkOnMainThreadException
if (android.os.Build.VERSION.SDK_INT > 9) {
  StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
  StrictMode.setThreadPolicy(policy);
}
## more
keytool -importkeystore -srckeystore /home/lithium/myJks.jks -destkeystore /home/lithium/myJks.jks -deststoretype pkcs12

## Android API-23: InetAddressUtils replacement
<uses-library android:name="org.apache.http.legacy" android:required="false"/>
import java.net.Inet4Address;
android { useLibrary 'org.apache.http.legacy' }
if(!inetAddress.isLoopbackAddress() && inetAddress instanceof Inet4Address) {

## Android开发常用开源库

Glide.with(fragment)
    .load(url)
    .into(imageView);

implementation 'com.github.bumptech.glide:glide:4.9.0'
implementation 'de.hdodenhof:circleimageview:3.0.1'
 implementation 'com.github.AppIntro:AppIntro:5.1.0' //for androidx maven { url 'https://jitpack.io' }
 implementation ('com.github.AppIntro:AppIntro:5.1.0'){
       exclude group: "org.jetbrains", module: "annotations"
   }
implementation 'com.airbnb.android:lottie:$lottieVersion'
 compile 'com.github.daniel-stoneuk:material-about-library:2.4.2'

## invoke virtual method ... on null reference
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

## String to int
Resources res = TouchDeomActivity.this.getResources();  
		 int titleid=res.getIdentifier(title,//需要转换的资源名称
				"string",        //资源类型
		  		"com.spring.sky.cycle.touch");//R类所在的包名

String a=context.getString(resId);

## ClassCastException: androidx.appcompat.widget.Toolbar cannot be cast to android.widget.Toolbar
import androidx.appcompat.widget.Toolbar
import androidx.appcompat.app.ActionBar;


View headerLayout =
navigationView.inflateHeaderView(R.layout.navigation_header);
panel = headerLayout.findViewById(R.id.viewId);

### CoordinatorLayout layout_anchor 不正常
automatically offset a view to place it below the AppBarLayout. It only works with an AppBarLayout
app:layout_behavior="@string/appbar_scrolling_view_behavior"

### get file
```
Intent intent = new Intent(Intent.ACTION_GET_CONTENT);
                intent.setType("file/*");
                startActivityForResult(intent, code);
文件的路径是通过data.getData().getPath()
```

### 在fragment view中添加baidumap的mapview方法
SDKInitializer.initialize(getActivity().getApplicationContext());
View view=inflater.inflate(R.layout.fragment_gallery,container,false);
mapView=view.findViewById(R.id.bmapview);
mapView.onCreate(getContext(),savedInstanceState);
