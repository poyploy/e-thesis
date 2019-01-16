<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Thesis</title>

    {{-- <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    {{-- <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css"> --}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition login-page">
    @include('vendor.flash.message')
    {{-- <div class="login-box">


        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="login-logo">
                <a>
                    <b>SIGN IN </b></a>
            </div>

            <form method="post" action="{{ url('/login') }}">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif

                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{ url('/password/reset') }}">I forgot my password</a><br>
            <a href="{{ url('/register') }}" class="text-center">Register a new membership</a>

        </div>
        <!-- /.login-box-body -->
    </div> --}}
    <!-- /.login-box -->


    <!-- Styles -->
    <style>
        html, body{
            height:100%;
        }
        body{
            background:#283593; 
            display:flex; 
            justify-content:center; 
            align-items:center; 
            max-width:1200px; 
            margin:0 auto;

        background-image:
            linear-gradient(to right bottom,
            /* rgba(76, 216, 255, 0.8),
            rgba(76, 216, 255, 0.8), */
            rgba(192, 192, 192, 0.8),
            /* rgba(30, 108, 217, 0.8), */
            rgba(192, 192, 192, 0.8)),
            url('https://www.su.ac.th/th/images/about_slide3.jpg');

        background-size: cover;
        background-position: top;
        position: relative;
        }
        #signin{
            width:40%; 
            background:#00a5e5; 
            margin:100px 50px; 
            box-shadow:0 0 64px rgba(0,0,0,0.5); 
            padding:100px; 
            position:relative; 
            overflow:hidden;
        }
        #signin .form-title{
            font:500 40px/1 'Roboto',sans-serif; 
            color:#fff; 
            text-align:center; 
            margin:35px 0;
        }

        #signin .input-field{
            position:relative; 
            height:50px; 
            margin:35px 0; 
            transition:all 300ms;
            }
        #signin .input-field i{
            position:absolute; 
            bottom:28px; left:15px; 
            color:#BBBBBB; height:0; 
            visibility:hidden; 
            font-size:100%; 
            transition:height 250ms;
        }
        #signin .input-field label{
            width:100%; 
            height:100%; 
            position:absolute; 
            margin-top:20px; 
            left:4px; 
            font:400 16px/1 'Roboto',sans-serif; 
            color:#FFF; 
            opacity:1; 
            transition:all 300ms;
        }
        #signin .input-field input{
            width:calc(100% - 70px); 
            height:4px; 
            font:500 16px/1 'Roboto',sans-serif; 
            padding:0 20px 0 50px; border:none; 
            box-shadow:0 10px 10px rgba(0,0,0,0.25); 
            color:#606060; 
            border-radius:6px; 
            outline:0; 
            overflow:hidden; 
            position:absolute; 
            bottom:0; 
            left:0; 
            transition:all 300ms;
        }

        #signin .help-block{
            color: #ff0a00;
            width: 100%;
            height: 100%;
            position: absolute;
            margin:50px 0 0 0;
        }

        #signin .forgot-pw{
            font:600 14px/1 'Roboto',sans-serif; 
            color:#2E3C89; 
            text-decoration:none; 
            float:right;
            margin:0 0 25px 0; 
            display:block;
        }

        #signin .register{
            font:600 14px/1 'Roboto',sans-serif; 
            color:#2E3C89; 
            text-decoration:none; 
            float:left;
            margin:0 0 25px 0; 
            display:block;
        }
        #signin button.login{
            min-height:60px; 
            font:500 16px/1 'Roboto',sans-serif; 
            width:100%; 
            padding:20px; 
            display:block; 
            background:#324192; 
            color:#FFF; 
            border:none; 
            outline:0; 
            cursor:pointer; 
            position:absolute; 
            left:0; bottom:0;
        }
        #signin .check{
            width:100%; 
            height:100%; 
            background:#324192; 
            position:absolute; 
            top:100%; 
            left:0; 
            text-align:center; 
            visibility:hidden; 
            transition:all 1s;
        }
        #signin .check.in{
            visibility:visible; 
            top:0;
        }
        #signin .check i{
            color:#FFF; 
            font-size:64px; 
            line-height:7.4;
        }

        #signin .input-field input:focus{
            color:#333;
        }
        #signin .input-field input:focus, #signin .input-field input.not-empty{
            height:auto; 
            padding:14px 20px 14px 50px;
        }
        #signin .input-field input:focus + i, #signin .input-field input.not-empty + i{
            font-size:24px; 
            bottom:26px; 
            height:10px; 
            visibility:visible;
        }
        #signin .input-field input:focus + i + label, #signin .input-field input.not-empty + i + label{
            font-size:12px; 
            margin-top:-15px; 
            opacity:0.7; 
            animation:label 300ms 1;
        }

        @keyframes label{
	        0%{margin-top:-15px;}
	        50%{margin-top:-25px;}
	        100%{margin-top:-15px;}
        }

        #gif{width:50%;}
        #gif a img{max-width:100%; box-shadow:0 0 64px rgba(0,0,0,0.5);}
    </style>

        <div id="signin">
            <form method="post" action="{{ url('/login') }}">

                {!! csrf_field() !!}

                <div class="form-title">LOG IN</div>
                <div class="input-field {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" id="email" name="email"  value="{{ old('email') }}"/>
                    <i class="material-icons">email</i>
                    <label for="email">Email</label>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="input-field {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" id="password" name="password"/>
                    <i class="material-icons">lock</i>
                    <label for="password">Password</label>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <a href="" class="forgot-pw">Forgot Password ?</a>
                <a href="{{ url('/register') }}" class="register">Register !</a>

                <div>
                    <button class="login" type="submit">Submit</button>
                </div>       
                <div class="check">
                    <i class="material-icons">check</i>
                </div>
            </form>
        </div>



    <div id="gif">
        <a href="https://dribbble.com/shots/2197140-New-Material-Text-Fields">
            <img src="https://d13yacurqjgara.cloudfront.net/users/472930/screenshots/2197140/efsdfsdae.gif" alt="">
        </a>
    </div>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    {{-- <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script> --}}

    <script>
    $("input").on('focusout', function(){
        $(this).each(function(i, e){
            if($(e).val() != ""){
                $(e).addClass('not-empty');
            }else{
                $(e).removeClass('not-empty');
            }
        });
    });
    
    $(".login").on('click', function(){
        $(this).animate({
            fontSize : 0
        }, 300, function(){
            $(".check").addClass('in');
        });
    });
    </script>
</body>

</html>