<!DOCTYPE html>
<html>
<head>
    <style>
        .email {
            width: 80%;
            margin: auto;
            box-shadow: 0 2px 0 rgb(0 0 150 / 3%), 2px 4px 0 rgb(0 0 150 / 2%);
            background: #fff;
        }
        .email .topbanner{
            background: #DDA72A;
            padding-left: 30px;
            overflow: hidden;
            max-height: 95px;
        }
        .email .topbanner img{
            width: 100%;
            height: auto;
        }
        .email .bodi{
            padding: 35px;
        }
        .text-blue-color {
            color: #667085;
            font-size: 14px;
            line-height: 22px;
        }
        .email .footer{
            background: #DDA72A;
            padding: 15px;
            color: #fff;
        }
        pre code {
            display: none;
            font-family: inherit;
            white-space: pre-wrap;
        }
        .email h2 {
            font-size: 32px;
            line-height: 42px;
            color: #1D2939;
        }
        .email strong {
            font-size: 16px;
            line-height: 24px;
            color: #1D2939;
        }
        .bmail{
            margin-top: 25px;
            background: #ffffff;
        }
        .bmail a {
            color: #ffffff;
            width: 250px;
            background: #E2B54D;
            border: 1px solid #E2B54D;
            box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
            border-radius: 3px;
            text-align: center;
            padding-top: 12px;
            padding-bottom: 12px;
        }
        .social a{
            text-decoration: none;
            margin-left: 3px;
            margin-right: 3px;
        }
        .social a img{
            width: 20px;
            height: auto;
        }

    </style>

</head>
<body style="background-color: #edf2f7; margin: 50px auto;">

<div class="email">
    <div class="topbanner">
        <img src="{{ url('') }}/images/topbanner.png">
    </div>

    <div class="bodi">

        <strong>Hello {{ $user->name }} {{ $user->firstname }},</strong>
        <div class="text-blue-color" mt-5 mb-3>
            @lang('global.verifyYourUser')
        </div>
        <div class="bmail">
            @component('mail::button', ['url' => $url])
                @lang('global.clickHereToVerify')
            @endcomponent
        </div>
    </div>
    <div class="footer">
        <h4>Connect with us:</h4>
        <div class="social">
            <a href="https://www.facebook.com/TheCitadelGCC"><img src="{{ url('') }}/images/facebook.png"></a>
            <a href="https://twitter.com/thecitadelgcc"><img src="{{ url('') }}/images/twitter.png"></a>
            <a href="https://instagram.com/thecitadelgcc"><img src="{{ url('') }}/images/instagram.png"></a>
            <a href="#"><img src="{{ url('') }}/images/tiktok.png"></a>
            <a href="https://www.youtube.com/c/CitadelGlobalOnline"><img src="{{ url('') }}/images/youtube.png"></a>
        </div>
    </div>
</div>
</body>
</html>
