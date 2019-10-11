---
title: fussion app
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-30 22:31:31
password:
summary:
tags:
categories:
---
```
//网页即将加载
if(网页链接:find"url/.")then
  停止加载()
  进入子页面("游览",{链接=网页链接})
end

//加载本地网页
("file:///android_asset/drawable/index.html")

//如何调用浏览器打开当前页面？
import "android.content.Intent"
import "android.net.Uri"
url="https://www.lanzous.com/b251218"
viewIntent = Intent("android.intent.action.VIEW",Uri.parse(url))
activity.startActivity(viewIntent)
--浏览器打开链接

//收到新标题
设置顶栏标题(webView.title)

//项目点击事件
进入子页面("子页面名",{链接="url",标题="标题名"})

//去头部留白
document.body.style.paddingTop=0

//显示或隐藏悬浮按钮
--显示悬浮按钮
fltBtn.setVisibility(View.VISIBLE)
--隐藏悬浮按钮
fltBtn.setVisibility(View.GONE)
注:fltBtn为悬浮按钮的ID，不需要更改。

//悬浮点击事件
加载Js([[document.getElementsByClassName("apk_topbar_btn")[0].parentElement.onclick()]])

//悬浮选择点击事件
pop=PopupMenu(activity,fltBtn)
menu=pop.Menu
menu.add("选项一").onMenuItemClick=function(a)
进入子页面("子页面名",{链接="url1"..webView.getUrl()})
end
menu.add("选项二").onMenuItemClick=function(a)
进入子页面("子页面名",{链接="url2"..webView.getUrl()})
end
pop.show()

//设置屏幕方向
import "android.content.pm.ActivityInfo"
activity.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_SENSOR);
//视频解析播放
加载网页("vip解析url"..webView.getUrl());
--横屏
activity.setRequestedOrientation(0);
--竖屏
activity.setRequestedOrientation(1);

//各控件ID
searchEdtTxt       搜索栏
toolbar.parent        顶栏
toolbar             标题栏
titleTvw            顶栏标题
webView           浏览器
fltBtn              悬浮按钮
 pager             滑动窗体
popmenu_position     菜单栏
sidebar             侧滑栏显示图标
pgsBar             进度条
sideLvw           侧滑图标
menu_button       菜单图标
menuBtn          侧滑栏图标

//开启和关闭侧滑
--打开侧滑
drawerLayout.openDrawer(3)
--关闭侧滑
drawerLayout.closeDrawer(3)

--均放在点击事件
--自定义底栏点击事件

index=1--底栏项目序号

bmBarLin.getChildAt(index-1).onClick=function()
--点击事件
end

--自定义标签栏点击事件

local index=1--标签栏项目序号

tabBar.getChildAt(index-1).onClick=function()

 --点击事件

end
-- 多页面搜索 --
-- By: QQ3
local urls={"https://www.google.com/search?q=%s","https://m.baidu.com/s?wd=%s","https://m.so.com/s?q=%s","http://cn.bing.com/search?q=%s","http://m.chinaso.com/page/search.htm?keys=%s","https://m.sogou.com/web/searchList.jsp?keyword=%s","https://m.sm.cn/s?q=%s"}
searchEdtTxt.setOnEditorActionListener{
  onEditorAction=function(view,action,event)
    local text=tostring(view.text)
    if text~=nil and text~="" then
      searchEdtTxt.setHint(text)
      local URLEncodeer=import"java.net.URLEncoder"
      for index in pairs(urls) do
        if allWebView[index] and urls[index]~=nil and urls[index]~="" then
          local url=tostring(urls[index]):format(URLEncoder.encode(text))
          if pager.getCurrentItem()+1==index then
            task(100,function()allWebView[index].loadUrl(url)end)--解决当前页面无法加载（与默认搜索事件冲突被覆盖）的问题
          else
            allWebView[index].loadUrl(url)
          end
        end
      end
    else
      SearchEdtTxt.setHint("")
    end
  end
}
网页顶栏及头部空白物理遮盖
javascript:
if(document.getElementsByTagName('BODY')[0].scrollTop<46){
      document.getElementsByTagName('BODY')[0].scrollTop=46;
    } else {
      return false;
    }
浮动广告查杀脚本
var d=document;var s=d.createElement('script');s.setAttribute('src', 'https://greasyfork.org/scripts/7410-jskillad/code/jsKillAD.user.js');d.head.appendChild(s);
清除缓存
第一部分
//自定义事件 > 程序启动
function clr()  
  import "java.io.File"
  items={"浏览记录","缓存文件"}
  多选对话框=AlertDialog.Builder(this)
  .setTitle("清除记录")  
  .setPositiveButton("确定",function()
    if clearhistory==1 and clearall==1 then
      File(lstads).delete()
      File(lstwebads).delete()
      lst={}
      lstweb={}
      os.execute("pm clear "..activity.getPackageName())
    elseif clearhistory==0 and clearall==1 then
      os.execute("pm clear "..activity.getPackageName())
    elseif clearhistory==1 and clearall==0 then
      File(lstads).delete()
      File(lstwebads).delete()
      lst={}
      lstweb={}
    else return nil
    end
  end)
  .setMultiChoiceItems(items, nil,{ onClick=function(v,p)     
      if p==0 then clearhistory=1
      end    
      if p==1 then clearall=1
      end
    end})
  多选对话框.show();
  clearhistory=0
  clearall=0
end
第二部分 填入点击事件
clr()
```
