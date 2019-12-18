<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        html,
        body {
            background-color: #fff;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .email-container {
            padding: 20px;
        }
        .email-container .email-head {
            text-align: center;
            font-size: 25px;
            margin: 75px auto 40px auto;
            background-color: #fa5a75;
        }
        .email-container .email-main {
            width: 475px;
            margin: 0 auto;
        }
        .email-box {}
        .email-box .box__head {}
        .email-box .box__head .title {
            font-size: 16px;
            font-weight: 700;
            color: #000;
        }
        .email-box .box__head .content {
            padding: 25px 0 36px 0;
        }

        .email-box .box__head .content .message{
            font-size: 14px;
        }
        .email-box .box__body {
            padding: 40px 0 36px 0;
        }

        .email-box .box__body .email-item {
            display: flex;
            font-size: 14px;
            height: 20px;
            line-height: 20px;
            margin-bottom: 10px;
        }
        .email-box .box__body .email-item:last-child {
            margin-bottom: 0;
        }

        .email-box .box__body .email-item .label{
            width: 80px;
            flex: 0 0 80px;
            margin-right: 10px;
            color: #000;
            font-size: 16px;
        }

        .email-box .box__body .email-item .value{
            flex: 1;
            color: #607581;
            text-align: right;
        }

        .split-1px {
            width: 100%;
            height: 0;
            display: block;
            content: "";
            border-bottom: 1px solid #95a0b9;
        }
    </style>
</head>

<body>
    <div class="email">
        <div class="email-container">
            <div class="email-head">
                <span>{{$email_title}}</span>
            </div>
            <div class="email-main">
                <div class="email-box">
                    <div class="box__head">
                        <div class="title">尊敬的{{$username}}用户您好！</div>
                        <div class="content">
                            <div class="message">{{$detail}}</div>
                        </div>
                        <div class="split-1px"></div>
                    </div>

                    <div class="box__body">

                        <div class="email-item">
                            <div class="label">设备名称：</div>
                            <div class="value">{{$equipment_name}}</div>
                        </div>

                        <div class="email-item">
                            <div class="label">设备编号：</div>
                            <div class="value">{{$equipment_sn}}</div>
                        </div>

                        <div class="email-item">
                            <div class="label">设备型号：</div>
                            <div class="value">{{$model}}</div>
                        </div>
                    </div>
                    <div class="split-1px"></div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
