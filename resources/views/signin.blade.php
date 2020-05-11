<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="{{ url('css/font.css') }}" />
</head>

<body>

    <div class="wrapper">
        <div class="container max-six text-center margin-top-big">
            <h1>admin</h1>
            <p id="label_alert">
                It’s good to see you again. Sign in below.
            </p>
        </div>

        <div class="container max-four margin-top-bigger padding-bottom-huge">

            <form class="new_user" id="new_user" action="/signin" accept-charset="UTF-8" method="post" onsubmit="return login()">
                <div class="field">
                    <label for="user_email">admin Email</label>
                    <input class="input" type="email" required="required" value="" name="admin_email" id="admin_email" />
                </div>

                <div class="field">
                    <label for="user_password">Password</label>
                    <input class="input" required="required" minlength="6" type="password" name="password" id="password" />
                </div>

                <input type="submit" id="commit" name="commit" value="Sign in" class="button wide margin-vertical-big" data-disable-with="Sign in" />
            </form>
        </div>
    </div>
    <script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ url('bower_components/js-md5/build/md5.min.js') }}"></script>
    <script>
        function login(){
            $('#commit').attr('disabled', true);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: '/admin',
                dataType: 'json',
                type: 'POST',
                data: {
                    'admin_email': $('#admin_email').val(),
                    'md5_passwd': md5($('#password').val())
                },
                success: function(data) {
                    console.log(data);
                    $('#commit').attr('disabled', false);
                    if (data.err) {
                        $('#label_' + data.err_type).text(data.err_msg);
                    } else {
                        console.log('success');
                        window.location.href = '/admin/posts';
                    }
                }.bind(this),
                error: function(xhr, status, err) {
                    console.error(null, status, err.toString());
                }.bind(this)
            });
            return false;
        }
    </script>
</body>

</html>
