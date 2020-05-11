<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>reset password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="{{ url('css/font.css') }}" />
</head>

<body>

    <div class="wrapper">
        <div class="container max-six text-center margin-top-big">
            <h2>重置密码</h2>
            <p>
            请联系系统管理员重置密码
            </p>
        </div>
        <div class="container max-four margin-top-bigger padding-bottom-huge">
            <form class="new_user" id="new_user" action="/password" accept-charset="UTF-8" method="post">
                <p class="text-smaller text-center">
                    <a href="/signin">Return to sign in</a>
                </p>
            </form>
        </div>
    </div>
    <script async src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script>
    </script>
</body>

</html>
