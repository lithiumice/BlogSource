---
title: greendao
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-30 22:37:18
password:
summary:
tags:
categories:
---
## 注解
@Entity（）括号内可加入更详细的设置，如：
nameInDb =“TABLE_NAME” ——> 声明该表的表名，默认取类名
createInDb = true ——> 是否创建表，默认为true
generateConstructors = true ——> 是否生成含所有参数的构造函数，默认为true
generateGettersSetters = true ——> 是否生成getter/setter，默认为true

@Id（）括号可加入autoincrement = true表明自增长
@Property(nameInDb = “URL”) 用来声明某变量在表中的实际字段
@Transient 用来声明某变量不被映射到数据表中
@ToOne(joinProperty = "fk_schoolId")
 @ToMany(referencedJoinProperty = "fk_schoolId")
 @ToMany
    @JoinEntity(
            entity = StudentWithCourse.class,
            sourceProperty = "sId",
            targetProperty = "cId"
    )

## API
mUserDao.insertInTx(listUserCollect);
mUserDao.insertOrReplace(userCollect);//单个数据 通过主键判断
mUserDao.deleteByKey(l);
mUserDao.deleteAll();
mUserDao.deleteInTx(listUserCollect）;
  mMovieCollectDao.queryBuilder().where(MovieCollectDao.Properties.Title.eq("肖申克的救赎")).unique(); //.list()
  .like("我的%") //开头
  .orderAsc(MovieCollectDao.Properties.Year)
  daoSession .clear(); //cache

## migrate helper
```
public class MyOpenHelper extends DaoMaster.OpenHelper {
    public MyOpenHelper(Context context, String name, SQLiteDatabase.CursorFactory factory) {
        super(context, name, factory);
    }

    @Override
    public void onUpgrade(Database db, int oldVersion, int newVersion) {

        //把需要管理的数据库表DAO作为最后一个参数传入到方法中
        MigrationHelper.migrate(db, new MigrationHelper.ReCreateAllTableListener() {

            @Override
            public void onCreateAllTables(Database db, boolean ifNotExists) {
                DaoMaster.createAllTables(db, ifNotExists);
            }

            @Override
            public void onDropAllTables(Database db, boolean ifExists) {
                DaoMaster.dropAllTables(db, ifExists);
            }
        },  MovieCollectDao.class);
    }
}
```
