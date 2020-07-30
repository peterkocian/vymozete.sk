<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        @media (prefers-color-scheme: light) {
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            body, html {
                font-family: 'Roboto', sans-serif;
                height: 100%;
                width: 100%;
                margin: 0;
            }

            .mail-wrapper {
                height: 100%;
                width: 100%;
                background-color: ghostwhite;
                display: flex;
                flex-direction: column;
            }

            .mail-header {
                min-height: 150px;
                background-color: #115063;
            }

            .mail-content {
                background-color: white;
                align-self: center;
                border-top-right-radius: 10px;
                border-top-left-radius: 10px;
            }

            .mail-content h1 {
                text-align: center;
                color: #115063;
            }

            .primary-text {
                padding-bottom: 30px;
                color: #115063;
                text-align: justify;
            }

            .secondary-text {
                background-color: #d3d3d3;
            }

            .primary-text, .secondary-text {
                padding: 20px 30px;
            }

            .mail-footer {
                align-self: center;
                padding: 20px 30px;
                width: 100%;
            }

            .width-wrapper {
                max-width: 600px;
                position: relative;
                top: -80px;
            }

            .mail-footer .contacts {
                display: flex;
                justify-content: space-between;
                padding: 20px 0;
            }

            .mail-footer .logo {
                display: block;
                text-align: center;
            }

            @media screen and (max-width: 470px) {
                .mail-footer .contacts {
                    display: block;
                }
            }
        }

    </style>
</head>
<body>
<div class="mail-wrapper">
    <div class="mail-header"></div>
    <div class="mail-content width-wrapper">
        <h1>Password Reset</h1>
        <div class="primary-text">
            {{ Illuminate\Mail\Markdown::parse($slot) }}
        </div>
        <div class="secondary-text">
            <div class="text">
                {{ $subcopy ?? '' }}
            </div>
        </div>
    </div>
    <div class="mail-footer width-wrapper">
        S pozdravom<br/><br/>
        iVymáhanie s.r.o.<br/>
        Zámocká 30<br/>
        811 01, Bratislava

        <div class="contacts">
            <div class="tel">tel: <a href="tel:+421 915 721 100">+421 915 721 100</a></div>
            <div class="email">email: <a href="mailto:pohladavky@vymozete.sk">pohladavky@vymozete.sk</a></div>
        </div>

        <a class="logo" href="{{ config('app.url')}}" target="_blank"><img width="150" src="{{asset('images/logo.png')}}" alt="vymozete.sk"/></a>
    </div>
</div>
</body>
</html>
