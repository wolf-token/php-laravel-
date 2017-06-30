<?php
/**
 * Created by PhpStorm.
 * User: code
 * Date: 2017/3/15
 * Time: 下午4:40
 */

namespace App\Http\Controllers;


use App\Http\Models\Config;
use App\Http\Models\Driver;
use App\Http\Models\Members;
use App\Http\Models\Message;
use App\Http\Models\MessageUser;
use App\Http\Models\OrderCancel;
use App\Http\Models\Orders;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class BdController extends Controller {

    //
    public function __construct() {
        parent::__construct();
    }

    /**
     * @name 图片上传
     * @method post
     * @uri /App/Slip/img
     * @param type string 1为头像上传
     * @param file file 图片信息 
     * @response url string 图片路径
     */
    public function img() {

    }

    /**
     * @name 用户注册
     * @method post
     * @uri /App/Slip/register
     * @param mobile string 用户手机号
     * @param name string 姓名
     * @param start datetime 入职时间
     * @param number string 工号
     * @param hobby string 爱好
     * @param unit string 隶属单位
     * @param education string 学历
     * @param idcard string 身份证
     * @param native string 籍贯
     * @param avatar string 头像
     * @param sex int 性别:1男  2女
     * @param birthday datetime 生日
     * @param age string 年龄
     * @param address string 地址
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据(注册成功的用户的id)
     * @response ## ## ##
     */
    public function register() {

    }

    /**
     * @name 设置密码
     * @method post
     * @uri /App/Slip/set_pass
     * @param mobile string 用户手机号
     * @param pass string 密码
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     */
    public function set_pass() {

    }

    /**
     * @name 用户登陆
     * @method post
     * @uri /App/Slip/login
     * @param mobile string 用户手机号
     * @param pass string 密码
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据(登陆的用户信息)
     * @response ## ## ##
     * @response id string 用户ID
     * @response mobile string 用户手机号
     * @response name string 姓名
     * @response start datetime 入职时间
     * @response number string 工号
     * @response hobby string 爱好
     * @response unit string 隶属单位
     * @response education string 学历
     * @response idcard string 身份证
     * @response native string 籍贯
     * @response avatar string 头像
     * @response sex int 性别:1男  2女
     * @response birthday datetime 生日
     * @response age string 年龄
     * @response address string 地址
     * @response time datetime 注册时间
     * @response status string 审核状态：1未审核 2已审核
     * @response recommend string 推荐保险员的号码
     * @response service string 已签单数量
     * @response none string 未签单数量
     * @response test string 已成功任务数量
     */
    public function login() {

    }

    /**
     * @name 首页
     * @method post
     * @uri /App/Slip/index
     * @param mobile string 不用传
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response banners ## 轮播图数组
     * @response slide_id string 图片id
     * @response slide_pic string 图片
     * @response activity ## 活动数组
     * @response id string 活动id
     * @response post_title string 活动标题
     * @response posts ## 文章数组
     * @response id string 文章id
     * @response post_title string 文章标题
     * @response post_content string 文章内容
     * @response post_hits string 阅读次数
     * @response post_date datetime 发表时间
     * @response smeta string 图片
     */
    public function index() {

    }

    /**
     * @name 往期活动
     * @method post
     * @uri /App/Slip/old_active
     * @param keyword string 关键字搜索(可选)
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     * @response id string 文章id
     * @response post_title string 标题
     * @response post_content string 文章内容
     * @response smeta string 图片
     * @response post_hits string 阅读次数
     * @response post_date datetime 发表日期
     */
    public function old_active() {

    }

    /**
     * @name 文章活动内容
     * @method post
     * @uri /App/Slip/post_details
     * @param id string 文章id
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     * @response id string 文章id
     * @response post_title string 标题
     * @response post_content string 文章内容
     * @response smeta string 图片
     * @response post_hits string 阅读次数
     * @response post_date datetime 发表日期
     */
    public function post_details() {

    }

    /**
     * @name 个人中心信息
     * @method post
     * @uri /App/Test/center
     * @param id string 会员的id
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response city string 返回数据('城市的信息')
     * @response ## ## ##
     * @response id string 会员的id
     * @response name string 姓名
     * @response start datetime 入司时间
     * @response number string 工号
     * @response hobby string 爱好
     * @response unit string 隶属单位
     * @response education string 学历
     * @response idcard string 身份证号
     * @response native string 籍贯
     * @response avatar string 头像信息
     * @response sex int 性别： 1 男性 2 女性
     * @response age int 年龄
     * @response birthday datetime 生日
     * @response mobile string 手机号
     * @response address string 地址
     * @response time datetime 信息添加时间
     * @response status int 审核状态： 0 未审核 1 已审核
     * @response recommend string 推荐保险员的号码
     * @response pass string 密码
     * @response service int 已签单数量
     * @response none int 未签单数量
     * @response test int 已成功任务数量
     * @response both string 生日月日格式(提醒生日，后台使用)
     * @response city array 城市信息
     * @response city->id int 市级的id
     * @response city->name string 城市名称
     * @response city->pid int 省级的id
     * @response city->time datetime 添加时间
     */
    public function center() {

    }

    /**
     * @name 加载（我）个人信息修改页面
     * @method post
     * @uri /App/Test/edit
     * @param id string 会员的id
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     * @response id string 会员的id
     * @response name string 姓名
     * @response idcard string 身份证号
     * @response avatar string 头像信息
     * @response sex int 性别： 1 男性 2 女性
     * @response address string 地址
     */
    public function edit() {

    }

     /**
     * @name 修改（我）个人信息数据提交
     * @method post
     * @uri /App/Test/update
     * @param id string 会员的id
     * @param avatar string 头像url地址
     * @param name string 姓名
     * @param idcard string 身份证号
     * @param sex int 1男2女
     * @param address string 地址
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     */
    public function update() {

    }

     /**
     * @name 录入保单信息
     * @method post
     * @uri /App/Test/append
     * @param pid string 会员的id
     * @param cid string 市级地区的id
     * @param sid string 省级地区的id（即市级信息中的pid）
     * @param name string 宝妈姓名
     * @param age int 年龄
     * @param idcard string 身份证号
     * @param mobile string 手机号
     * @param address string 家庭地址
     * @param soname string 宝宝姓名
     * @param sex int 1男2女
     * @param soncard string 宝宝身份证号
     * @param sage int 宝宝年龄
     * @param birthday string 宝宝出生日期
     * @param status int 保单状态1已经签单2未签单
     * @param company int 是否发展为公司员工1是2不发展
     * @param number string 保险合同号(当status为1时填写)
     * @param type string 险种(当status为1时填写)
     * @param money string 平缴保费(当status为1时填写)
     * @param year int 缴费年限(当status为1时填写)
     * @param applicant string 投保人姓名(当status为1时填写)
     * @param favorer string 受益人姓名(当status为1时填写)
     * @param insured string 被保险人姓名(当status为1时填写)
     * @param staff string 员工姓名(当company为1时填写)
     * @param mark string 新员工工号(当company为1时填写)
     * @param come string 入职时间(当company为1时填写)
     * @param reason string 未能发展为公司员工原因(当company为2时填写)
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     */
    public function append() {

    }

     /**
     * @name 我的保单信息
     * @method post
     * @uri /App/Test/mine
     * @param id string 会员的id
     * @response status string 状态
     * @response explain string 提示
     * @response already string 返回已经签单的用户信息
     * @response none string 返回未签单的用户的信息
     * @response ## ## ##
     * @response id string 保单信息的id
     * @response name string 宝妈姓名
     * @response soname string 宝宝姓名
     */
    public function mine() {

    }

    /**
     * @name 保单信息详情
     * @method post
     * @uri /App/Test/particulars
     * @param id string 保单的id
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     * @response pid string 会员的id
     * @response family string 家庭成员信息： 1代表没有家庭成员信息 2 已存在家庭成员信息
     * @response city string 市级地区的id
     * @response country string 省级地区的id（即市级信息中的pid）
     * @response name string 宝妈姓名
     * @response age int 年龄
     * @response idcard string 身份证号
     * @response mobile string 手机号
     * @response address string 家庭地址
     * @response soname string 宝宝姓名
     * @response sex int 1男2女
     * @response soncard string 宝宝身份证号
     * @response sage int 宝宝年龄
     * @response birthday string 宝宝出生日期
     * @response status int 保单状态1已经签单2未签单
     * @response company int 是否发展为公司员工1是2不发展
     * @response number string 保险合同号(当status为1时有内容)
     * @response type string 险种(当status为1时有内容)
     * @response money string 平缴保费(当status为1时有内容)
     * @response year int 缴费年限(当status为1时有内容)
     * @response applicant string 投保人姓名(当status为1时有内容)
     * @response favorer string 受益人姓名(当status为1时有内容)
     * @response insured string 被保险人姓名(当status为1时有内容)
     * @response staff string 员工姓名(当company为1时有内容)
     * @response mark string 新员工工号(当company为1时有内容)
     * @response come string 入职时间(当company为1时有内容)
     * @response reason string 未能发展为公司员工原因(当company为2时有内容)
     * @response time int 信息添加时间（时间戳格式）
     * @response both string 生日月日信息(后台使用)
     * @response task json 任务完成状况(后台使用数据)
     * @response uid json 任务的id(后台使用数据)
     * @response sequence json 任务的排序信息(后台使用数据)
     */
    public function particulars() {

    }

     /**
     * @name 修改保单信息
     * @method post
     * @uri /App/Test/alter
     * @param pid string 负责此保单的会员id
     * @param id string 保单的id
     * @param name string 宝妈姓名
     * @param age int 年龄
     * @param idcard string 身份证号
     * @param mobile string 手机号
     * @param address string 家庭地址
     * @param soname string 宝宝姓名
     * @param sex int 1男2女
     * @param soncard string 宝宝身份证号
     * @param sage int 宝宝年龄
     * @param birthday string 宝宝出生日期
     * @param status int 保单状态1已经签单2未签单
     * @param company int 是否发展为公司员工1是2不发展
     * @param number string 保险合同号(当status为1时填写)
     * @param type string 险种(当status为1时填写)
     * @param money string 平缴保费(当status为1时填写)
     * @param year int 缴费年限(当status为1时填写)
     * @param applicant string 投保人姓名(当status为1时填写)
     * @param favorer string 受益人姓名(当status为1时填写)
     * @param insured string 被保险人姓名(当status为1时填写)
     * @param staff string 员工姓名(当company为1时填写)
     * @param mark string 新员工工号(当company为1时填写)
     * @param come string 入职时间(当company为1时填写)
     * @param reason string 未能发展为公司员工原因(当company为2时填写)
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     */
    public function alter() {

    }

     /**
     * @name 加载家庭情况信息
     * @method post
     * @uri /App/Test/family
     * @param id string 保单的id
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     * @response name string 姓名
     * @response age int 年龄
     * @response work string 工作
     * @response mobile string 手机号
     * @response other string 其他
     * @response marry string 结婚纪念日
     * @response address string 家庭住址
     * @response time int 信息添加时间
     * @response team int 保单的id
     * @response birthday string 生日日期
     * @response pid int 保险员的id
     * @response type string 家属类型1父亲2母亲3兄弟4姐妹5子女6其他7准客户
     * @response both string 生日月日信息(后台使用)
     */
    public function family() {

    }

     /**
     * @name 添加家庭信息
     * @method post
     * @uri /App/Test/home
     * @param pid string 保单的id
     * @param name string 姓名
     * @param age int 年龄
     * @param work string 工作
     * @param mobile string 手机号
     * @param other string 其他
     * @param marry string 结婚纪念日
     * @param address string 家庭住址
     * @param time int 信息添加时间
     * @param team int 保单的id
     * @param birthday string 生日日期
     * @param uid int 保险员的id
     * @param type string 家属类型1父亲2母亲3兄弟4姐妹5子女6其他7准客户
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     */
    public function home() {

    }

    /**
     * @name 加载所有拜访记录
     * @method post
     * @uri /App/Test/record
     * @param id string 保单的id
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     * @response id int 拜访记录的id
     * @response content string 记录情况
     * @response type string 成交险种
     * @response time int 拜访时间（返回的是时间戳）
     * @response pid int 拜访客户保单的id
     */
    public function record() {

    }

     /**
     * @name 添加拜访记录
     * @method post
     * @uri /App/Test/plus
     * @param id string 保单的id
     * @param content string 记录情况
     * @param type string 成交险种
     * @param time string 拜访时间
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     */
    public function plus() {

    }

    /**
     * @name 加载看具体的一条拜访记录修改页面
     * @method post
     * @uri /App/Test/compile
     * @param id string 拜访记录的id
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     * @response id int 拜访记录的id
     * @response content string 记录情况
     * @response type string 成交险种
     * @response time int 拜访时间（返回的是时间戳）
     * @response pid int 拜访客户保单的id
     */
    public function compile() {

    }

     /**
     * @name 修改具体的拜访记录
     * @method post
     * @uri /App/Test/amend
     * @param id string 拜访记录的id
     * @param content string 记录情况
     * @param type string 成交险种
     * @param time string 拜访时间
     * @response status string 状态
     * @response explain string 提示
     * @response content string 返回数据('success或'error')
     * @response ## ## ##
     */
    public function amend() {

    }


}