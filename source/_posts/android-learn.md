---
title: android learn
top: false
cover: false
toc: true
mathjax: true
date: 2019-10-10 15:55:53
password:
summary:
tags:
categories:
---

## float menu button
```
/**
 * 打开动画
 */
private void showAnimation() {
    // 获取子view的个数，进行遍历
    for (int i = 0; i < rlMenuWrap.getChildCount(); i++) {
        // 获取到相应的子view
        final View child = rlMenuWrap.getChildAt(i);
        // 关闭按钮和背景进行跳过
        if (child.getId() == R.id.fab_close_more_menu || child.getId() == R.id.rl_bg) {
            continue;
        }
        // 先暂时隐藏
        child.setVisibility(View.INVISIBLE);
        mHandler.postDelayed(new Runnable() {

            @Override
            public void run() {
                //显示菜单
                child.setVisibility(View.VISIBLE);
                // Y轴位移动画 从800移动到当前位置
                ValueAnimator fadeAnim = ObjectAnimator.ofFloat(child, "translationY", 600, 0);
                //动画时长
                fadeAnim.setDuration(200);
                // 自定义差值器
                KickBackAnimator kickAnimator = new KickBackAnimator();
                //设置速度
                kickAnimator.setDuration(100);
                // 设置差值器
                fadeAnim.setEvaluator(kickAnimator);
                //开始动画
                fadeAnim.start();
            }
        }, i * 60);// 根据下标延迟执行动画
    }
}

public class KickBackAnimator implements TypeEvaluator<Float> {
    private final float s = 1.70158f;
    float mDuration = 0f;

    public void setDuration(float duration) {
        mDuration = duration;
    }

    public Float evaluate(float fraction, Float startValue, Float endValue) {
        float t = mDuration * fraction;
        float b = startValue.floatValue();
        float c = endValue.floatValue() - startValue.floatValue();
        float d = mDuration;
        float result = calculate(t, b, c, d);
        return result;
    }

    public Float calculate(float t, float b, float c, float d) {
        return c * ((t = t / d - 1) * t * ((s + 1) * t + s) + 1) + b;
    }
}


/**
 * 关闭动画
 *
 */
private void closeAnimation() {
    // 获取所有的子view
    for (int i = 0; i < rlMenuWrap.getChildCount(); i++) {
        final View child = rlMenuWrap.getChildAt(i);
        // 判断  关闭按钮和背景不进入动画
        if (child.getId() == R.id.fab_close_more_menu || child.getId() == R.id.rl_bg) {
            continue;
        }
        mHandler.postDelayed(new Runnable() {

            @Override
            public void run() {
                // 显示
                child.setVisibility(View.VISIBLE);
                // Y轴位移动画 从当前位置到600
                ValueAnimator fadeAnim = ObjectAnimator.ofFloat(child, "translationY", 0, 600);
                fadeAnim.setDuration(200);
                KickBackAnimator kickAnimator = new KickBackAnimator();
                kickAnimator.setDuration(100);
                fadeAnim.setEvaluator(kickAnimator);
                fadeAnim.start();
                fadeAnim.addListener(new BaseAnimatorListener() {
                    @Override
                    public void onAnimationEnd(Animator animation) {
                        // 动画完成后隐藏menu
                        child.setVisibility(View.INVISIBLE);
                    }
                });
            }
        }, (rlMenuWrap.getChildCount() - i - 1) * 30);// 设置和打开相反的延迟时长

        //第0个
        if (i == 0) {
            mHandler.postDelayed(new Runnable() {

                @Override
                public void run() {
                    // 隐藏menu
                    rlMoreMenuRoot.setVisibility(View.GONE);
                }
            }, (rlMenuWrap.getChildCount() - i) * 30 + 80);
        }
    }

}


/**
 * 旋转菜单按钮
 */
private void rotationActionMenu(int from, int to) {
    ValueAnimator fadeAnim = ObjectAnimator.ofFloat(fabCloseMoreMenu, "rotation", from, to);
    fadeAnim.setDuration(300);
    KickBackAnimator kickAnimator = new KickBackAnimator();
    kickAnimator.setDuration(150);
    fadeAnim.setEvaluator(kickAnimator);
    fadeAnim.start();
}
```
