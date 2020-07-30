<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title></title>
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
        <h1>Registrácia</h1>
        <div class="primary-text">
            Dobrý deň,<br><br>
            Vaša registrácia do aplikácie <a href="https://vymozete.sk">vymozete.sk</a> prebehla úspešne.
            Váš email {{$user['email']}}, ktorý ste použili pri registrácií môžete od teraz používať ako prihlasovacie meno do aplikácie.
        </div>
        <div class="secondary-text">
            <div class="text">
                You received this email because you just signed up for a new account. If it looks weird, view it in your browser.
                <br><br>
                If these emails get annoying, please feel free to unsubscribe.
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
