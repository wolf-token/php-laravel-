<?php

Route::group(['middleware' => ['web'], 'prefix' => 'v1'], function () {
    Route::group(['prefix' => 'member'], function () {
        Route::post("/register","MemberController@register");
        Route::post("/login","MemberController@login");
        Route::post("/logout","MemberController@logout");
        Route::post("/todriver","MemberController@toDriver");
        Route::post("/modify","MemberController@modify");
        Route::post("/avatar","MemberController@avatar");
        Route::post("/orders","MemberController@orders");
        Route::post("/order_info","MemberController@orderInfo");
        Route::post("/cancel","MemberController@cancel");
        Route::post("/message","MemberController@message");
        Route::post("/readmsg","MemberController@readmsg");
        Route::post("/change_pwd","MemberController@changePwd");
        Route::post("/get_pwd","MemberController@getPwd");
        Route::post("/config","MemberController@config");
    });

    Route::group(['prefix' => 'driver'], function () {
        Route::post("/addcar","DriverController@addCar");
        Route::post("/info","DriverController@info");
        Route::post("/orders","DriverController@orders");
        Route::post("/cancel","DriverController@cancel");
        Route::post("/message","DriverController@message");
        Route::post("/readmsg","DriverController@readmsg");
        Route::post("/car_info","DriverController@carInfo");
        Route::post("/car_switch","DriverController@carSwitch");
        Route::post("/mycar","DriverController@mycar");
        Route::post("/up_car_img","DriverController@updateCarImg");
    });

    Route::group(['prefix' => 'position'], function () {
        Route::post("/upload","PositionController@upload");
        Route::post("/get_drivers","PositionController@getDrivers");
        Route::post("/driver","PositionController@driver");
    });

    Route::group(['prefix' => 'order'], function () {
        Route::post("/call","OrderController@call");
        Route::post("/info","OrderController@info");
        Route::post("/check_order","OrderController@checkOrders");
        Route::post("/accept","OrderController@acceptOrder");
        Route::post("/cancel","OrderController@cancel");
        Route::post("/receive","OrderController@receive");
        Route::post("/finish","OrderController@finish");
        Route::post("/collect_money","OrderController@collectMoney");
        Route::post("/pay_info","OrderController@payInfo");
        Route::post("/price","OrderController@price");
        Route::post("/comment","OrderController@comment");
        Route::post("/get","OrderController@getOrder");
        Route::post("/upload","OrderController@uploadOrder");
        Route::post("/details","OrderController@details");
        Route::post("/appointment","OrderController@appointment");
    });

    Route::group(['prefix' => 'pay'], function () {
        Route::post("/alipay","PayController@alipay");
        Route::post("/alipay_notify","PayController@alipayNotify");
        Route::post("/alinotify","PayController@aliNotify");
        Route::post("/wxpay","PayController@wxPay");
        Route::post("/wxpay_notify","PayController@wxNotify");
        Route::post("/cash","PayController@cash");
    });

    Route::group(['prefix' => 'sms'], function () {
        Route::post("/send","SMSController@send");
    });

    Route::group(['prefix' => 'ad'], function () {
        Route::post("/get","AdvertController@getAdvert");
    });

    Route::group(['prefix' => 'wechat'/*,'middleware' => ['wechat.oauth']*/], function () {
        Route::get("/login","MemberController@wxlogin");
        Route::get("/callback","MemberController@wxcallback");
    });
});




Route::get("/doc","DocController@testview");
Route::get("/bd","BaodanController@testview");
