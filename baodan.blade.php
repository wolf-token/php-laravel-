<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>接口文档</title>

    <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="http://cdn.bootcss.com/json2/20150503/json2.min.js"></script>
</head>

<style type="text/css">

    .main{
        width: 90%;
        margin: 30px auto;
        min-width: 960px;
        max-width: 1096px;
    }

    .color1 {
        color: #ce4844 !important;
    }

    .color2 {
        color: #cf4844 !important;
    }

    .fs{
        font-size: 100% !important;
    }
    .bs-callout-danger {
        border-left-color: #ce4844 !important;
    }
    .bs-callout-info {
        border-left-color: #1b809e !important;
    }
    .bs-callout {
        padding: 20px;
        margin: 20px 0;
        border: 1px solid #eee;
        border-left-width: 5px;
        border-radius: 3px;
    }
    .sider{
        cursor: pointer;
        margin: 0 auto;
        width: inherit;
    }
    .method{
        float: left;
        background: #5cb85c;
        padding: 5px;
        color: #ffffff;
        border-radius: .25em 0 0 .25em;
    }
    .uri{
        float: left;
        background-color: #d9edf7;
        padding: 5px 20px;
        border-radius: 0 .25em .25em 0;
        width: inherit;
    }
    .box{
        width: 90%;
        clear: both;
        border-radius: 0 0 .25em .25em;
        margin: 0 auto;
        padding-top: 5px;

        display: none;
    }

    .main_title {
        width: 90%;
        margin: 10px auto;
        cursor: pointer;
    }
</style>
<body>

<div class="main">
    <?php $k = 0 ?>

    @foreach($json as $comment)
        @foreach($comment as $doc)
            <?php $k++ ?>
            <h4 class="main_title" onclick="showBox({{$k}})"><code> <i class="glyphicon glyphicon-send"></i> {{$doc["comment"]["name"]["0"]}}</code></h4>

            <div class="sider" onclick="showBox({{$k}})" >
                <div class="method pull-left">{{strtoupper($doc["comment"]["method"]["0"])}}</div>
                <div class="uri">
                    <div class="pull-right">【{{$doc["comment"]["name"]["0"]}}】</div>
                    <div class="pull-left">{{$doc["comment"]["uri"]["0"]}}</div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="box" id="test_box_{{$k}}">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-1 control-label">Name</label>
                        <div class="col-md-4">
                            <h5><span class="label-info label fs">{{$doc["comment"]["name"]["0"]}}</span></h5>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-1 control-label">Host</label>
                        <div class="col-md-4">
                            <input type="text" id="host_{{$k}}" class="form-control auth-field" value="insurance.yichujilian.com">
                        </div>

                        <label class="col-md-1 control-label">Port</label>
                        <div class="col-md-2">
                            <input type="text" id="port_{{$k}}" class="form-control auth-field" value="80">
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-1 control-label">Uri</label>
                        <div class="col-md-4">
                            <input type="text" disabled id="uri_{{$k}}" class="form-control auth-field" value="{{$doc["comment"]["uri"]["0"]}}">
                        </div>

                        <label class="col-md-1 control-label">Method</label>
                        <div class="col-md-2">
                            <input type="text" disabled id="method_{{$k}}" class="form-control auth-field" value="{{$doc["comment"]["method"]["0"]}}">
                        </div>
                    </div>


                    <div class="bs-callout bs-callout-info">
                        <h3 class="color1">Params : </h3>
                        @if(isset($doc["comment"]["param"]))
                            @foreach($doc["comment"]["param"] as $param)
                                <div class="form-group">

                                    <label class="col-md-2 control-label">{{$param["name"]}} <br /><code>{{$param['type']}}</code></label>
                                    <div class="col-md-4">
                                        <input type="text" id="{{$param["name"]}}_{{$k}}" name="{{$param['name']}}" placeholder="{{$param['note']}}" class="form-control auth-field">
                                    </div>

                                </div>
                            @endforeach
                            <input type="hidden" id="params_{{$k}}" value="{{json_encode($doc["comment"]["param"])}}">

                        @endif

                        <button type="button" onclick="test({{$k}})" class="btn btn-primary col-sm-offset-1"> 提交 </button>
                    </div>

                    <div class="bs-callout bs-callout-danger">
                        <h3 class="color1">Response : </h3>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Status</label>
                            <div class="col-md-4">
                                <input type="text" disabled placeholder="返回的HTTP状态码" id="status_{{$k}}" class="form-control auth-field">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label">Data</label>
                            <div class="col-md-9">
                                <textarea id="data_{{$k}}" rows="9" class="form-control auth-field"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"></label>
                            <div class="col-md-9">
                                <table class="table table-bordered table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th>参数名称</th>
                                        <th>参数类型</th>
                                        <th class="center">备注信息</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($doc["comment"]["response"]))
                                        @foreach($doc["comment"]["response"] as $res)

                                            <tr>
                                                <td>{{$res['name']}}</td>
                                                <td>{{$res['type']}}</td>
                                                <td class="center">{{$res['note']}}</td>
                                            </tr>

                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>


                </form>


            </div>
            <div class="clearfix"></div>
            <br>

        @endforeach
    @endforeach

</div>

<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<script>
    function showBox(t){
        $("#test_box_"+t).toggle();
    }

    function getUrl(t){
        var host = "http://" + $("#host_"+t).val();
        var port = $("#port_"+t).val();
        var uri = $("#uri_"+t).val();
        var url = host+":"+port+uri;
        return url;
    }

    function test(t){
        var url = getUrl(t);

        var params = $("#params_"+t).val();

        var d = {};
        if (typeof(params) != "undefined") {
            $(JSON.parse(params)).each(function(i,v){
                d[v.name] = $("#"+v.name+"_"+t).val();

            });
        }


        console.log(d);

        $.ajax({
            type: "POST",
            url: url,
            //asyc: true,
            data: d,
            success: function (data, statusText, xhr) {
                //console.log(data)
                $("#status_"+t).val(xhr.status);
                $("#data_"+t).val(JSON.stringify(data, null, "\t"));

            },
            error: function (xhr) {

                $("#status_"+t).val(xhr.status);
                //$("#data_"+t).val(JSON.stringify(xhr.responseJSON, null, "\t"));
                $("#data_"+t).val(xhr.responseJSON);
                //console.log(xhr);
            },
            dataType: "json"
        });
    }
</script>

</body>
</html>