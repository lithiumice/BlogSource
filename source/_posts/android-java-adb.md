---
title: android java adb
top: false
cover: false
toc: true
mathjax: true
date: 2019-10-11 13:28:31
password:
summary:
tags:
categories:
---
## jar sign
keytool -genkeypair -alias roland.keystore -keyalg RSA -validity 500000 -keystore roland.keystore

jarsigner -verbose -keystore roland.keystore -signedjar test_signed.apk test.apk roland.keystore

jarsigner -verbose -keystore feelyou.keystore -storepass feelyou.info -signedjar signed.apk -digestalg SHA1 -sigalg MD5withRSA unsigned.apk feelyou

## adb commmands
adb install -r apk路径。
adb shell rm system/app/OutdoorMeter/OutdoorMeter.apk
adb shell rm -rf data/data/com.example.package/
adb reboot
