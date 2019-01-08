<!DOCTYPE html>
<html>
{{-- <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-THESIS | Registration Page</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="{{ url('/home') }}"><b>Register </b></a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>

        <form method="post" action="{{ url('/register') }}">

            {!! csrf_field() !!}

            <input type="hidden" name="role" value="2">
            <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full Name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="{{ url('/login') }}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->

    <br>
    <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>

        <form method="post" action="{{ url('/register') }}">

            {!! csrf_field() !!}

            <input type="hidden" name="role" value="3">
            <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full Name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('student_id') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="student_id" value="{{ old('student_id') }}" placeholder="Student Id">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    
                    @if ($errors->has('student_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('student_id') }}</strong>
                        </span>
                    @endif
                </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="{{ url('/login') }}" class="text-center">I already have a membership</a>
    </div>
</div>
<!-- /.register-box -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body> --}}


    <head>
        <meta charset="UTF-8">
        <title>AnimaForm</title>
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    </head>

    <style>
    /* Reset */
* {
	margin: 0;
	padding: 0;
	vertical-align: baseline;
	box-sizing: border-box;
	border: 0;
	outline: 0;
}


/* General */
body {
	width: 100%;
	font-family: Roboto, sans-serif;
	background: #3b4465;
}

button {
	position: relative;
	width: 160px;
	text-transform: uppercase;
	font-size: 14px;
	background-color: transparent;
}

form {
  position: relative;
	width: 260px;
	height: 350px;
	padding: 20px;
	background: #d7e7f1;
	border-radius: 5px;
}

form label, form input {
	display: block;
	opacity: 0;
}

legend {
  position: absolute;
  top: 0;
  left: -10000px;
}

label {
	padding-top: 15px;
	font-size: 14px;
	color: #a1b4b4;
	letter-spacing: 0.5px;
}

input:not([type="submit"]) {
	width: 220px;
	margin: 5px auto 0;
	padding: 0 15px;
	line-height: 40px;
	font-size: 14px;
	color: #3b4465;
	background: #eef9fe;
	border: 1px solid #cddbef;
	border-radius: 2px;
}

input[type="submit"] {
	float: right;
	width: 120px;
	margin-top: 30px;
	line-height: 40px;
	font-size: 18px;
	border-radius: 20px;
}


/* Buttons and Inputs */
.buttons,
.forms {
	display: flex;
	flex-flow: row nowrap;
	justify-content: center;
	width: 550px;
	margin: 0 auto;
}

.buttons {
	height: 100px;
	padding-top: 70px;
	text-align: center;
}

.forms {
  padding-top: 50px;
}

.log-link,
.sign-link {
  cursor: pointer;
  color: #bbb;
}

.log-link.login-button-active,
.sign-link.signup-button-active {
  cursor: default;
  color: #fff;
}

.login-underline,
.signup-underline {
	position: absolute;
	top: 35px;
	left: 30px;
	height: 2px;
	width: 100px;
	opacity: 0;
	background: #c8dfed;
}

.login-underline.login-button-active {
	animation: loginUnderlineActive .2s linear .1s forwards;
	transform-origin: right;
}

.login-underline.signup-button-active {
	animation: loginUnderlineInactive .3s linear forwards;
	transform-origin: right;
}

.signup-underline.signup-button-active {
	animation: signupUnderlineActive .2s linear .1s forwards;
	transform-origin: left;
}

.signup-underline.login-button-active {
	animation: signupUnderlineInactive .3s linear forwards;
	transform-origin: left;
}

.login-button-active {
  animation: buttonsMoveToRight .3s linear forwards;
}

.signup-button-active {
  animation: buttonsMoveToLeft .3s linear forwards;
}

.login-form.login-button-active label,
.login-form.login-button-active input {
  animation: fielsetSlideToRight .5s linear 0.25s forwards;
}

.signup-form.signup-button-active label,
.signup-form.signup-button-active input {
  animation: fieldsetSlideToLeft .5s linear 0.25s forwards;
}

.login-form input[type="submit"] {
	color: #fbfdff;
	background: #a7e245;
}

.signup-form input[type="submit"] {
	color: #a7e245;
	background: #fbfdff;
	box-shadow: inset 0 0 0 2px #a7e245;
}

.login-form {
  animation: loginToBottom .4s linear forwards;
}

.signup-form {
  animation: signUpToBottom .4s linear forwards;
}

.login-form.login-button-active {
  animation: loginToTop .4s linear forwards;
}

.signup-form.signup-button-active {
  animation: signUpToTop .4s linear forwards;
}


/* Animations */
@keyframes loginUnderlineActive {
	0% {
		transform: scale(0);
		opacity: 1;
	}
  
	100% {
		transform: scale(1);
		opacity: 1;
	}
}

@keyframes signupUnderlineActive {
	0% {
		transform: scale(0);
		opacity: 1;
	}
  
	100% {
		transform: scale(1);
		opacity: 1;
	}
}

@keyframes loginUnderlineInactive {
	0% {
		transform: scale(1);
		opacity: 1;
	}
  
	100% {
		transform: scale(0);
		opacity: 1;
	}
}

@keyframes signupUnderlineInactive {
	0% {
		transform: scale(1);
		opacity: 1;
	}
  
	100% {
		transform: scale(0);
		opacity: 1;
	}
}

@keyframes buttonsMoveToRight {
	0% {
		transform: translate(0);
	}
  
	100% {
		transform: translate(50px);
	}
}

@keyframes buttonsMoveToLeft {
	0% {
		transform: translate(0);
	}
  
	100% {
		transform: translate(-50px);
	}
}

@keyframes fielsetSlideToRight {
	0% {
		transform: translate(-15px);
		opacity: 0;
	}
  
	100% {
		transform: translate(0);
		opacity: 1;
	}
}

@keyframes fieldsetSlideToLeft {
	0% {
		transform: translate(15px);
		opacity: 0;
	}
  
	100% {
		transform: translate(0);
		opacity: 1;
	}
}

@keyframes loginToBottom {
	0% {
		transform: translate(100px);
		z-index: 10;
		background-color: #fff;
	}
  
	49% {
		transform: translate(0);
		z-index: 10;
	}
  
	50% {
		transform: translate(0);
		z-index: 1;
	}
  
	100% {
		transform: translate(100px, 20px);
		z-index: 1;
		background-color: #d7e7f1;
	}
}

@keyframes signUpToBottom {
	0% {
		transform: translate(-100px);
		z-index: 10;
		height: 360px;
		background-color: #fff;
	}
  
	49% {
		transform: translate(0);
		z-index: 10;
	}
  
	50% {
		transform: translate(0);
		z-index: 1;
	}
  
	100% {
		transform: translate(-100px, 20px);
		z-index: 1;
		height: 280px;
		background-color: #d7e7f1;
	}
}

@keyframes loginToTop {
	0% {
		transform: translate(100px, 20px);
		z-index: 1;
		background-color: #d7e7f1;
	}
  
	49% {
		transform: translate(0);
		z-index: 1;
	}
  
	50% {
		transform: translate(0);
		z-index: 10;
	}
  
	100% {
		transform: translate(100px);
		z-index: 10;
		background-color: #fff;
	}
}

@keyframes signUpToTop {
	0% {
		transform: translate(-100px, 20px);
		z-index: 1;
		background-color: #d7e7f1;
	}
  
	25% {
    height: 280px;
  }
  
	49% {
		transform: translate(0);
		z-index: 1;
	}
  
	50% {
		transform: translate(0);
		z-index: 10;
	}
	100% {
		transform: translate(-100px);
		z-index: 10;
		height: 360px;
		background-color: #fff;
	}
}
    </style>
    <body>
            <main>
                <div class="buttons login-button-active" data-action="animated">
                    <button class="login-button">
                        <span class="log-link login-button-active" data-action="animated">Login</span>
                        <span class="login-underline login-button-active" data-action="animated"></span>
                    </button>
                    <button class="signup-button">
                        <span class="sign-link" data-action="animated">Sign Up</span>
                        <span class="signup-underline login-button-active" data-action="animated"></span>
                    </button>
                </div>

                <div class="forms">
                    <form class="login-form login-button-active" action="{{ url('/register') }}" method="post" data-action="animated">
                        
                        {!! csrf_field() !!}

                        <input type="hidden" name="role" value="3">
                        <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full Name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
            
                        <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
            
                        <div class="form-group has-feedback{{ $errors->has('student_id') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="student_id" value="{{ old('student_id') }}" placeholder="Student Id">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                
                                @if ($errors->has('student_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('student_id') }}</strong>
                                    </span>
                                @endif
                        </div>
            
                        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
            
                        <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
            
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-xs-4">
                                    <a href="{{ url('/login') }}"><button type="submit" class="btn btn-primary btn-block btn-flat">Register</button></a>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                        {{-- <fieldset>
                            <legend>Please, enter your email and password for login.</legend>
                            <label for="login-email">E-mail</label>
                            <input id="login-email" type="email" name="email" required>
                            <label for="login-password">Password</label>
                            <input id="login-password" type="password" name="password" required>
                        </fieldset>
                        <input type="submit" value="Login">
                    </form> --}}
                    <form class="signup-form" action="#" method="post" data-action="animated">
                        <fieldset>
                            <legend>Please, enter your email, password and password confirmation for sign up.</legend>
                            <label for="signup-email">E-mail</label>
                            <input id="signup-email" type="email" name="email" required>
                            <label for="signup-password">Password</label>
                            <input id="signup-password" type="password" name="password" required>
                            <label for="signup-confirm-password">Confirm password</label>
                            <input id="signup-confirm-password" type="password" name="password" required>
                        </fieldset>
                        <input type="submit" value="Continue">
                    </form>
                </div>
            </main>
            <!-- /.register-box -->

            
            <script>
                const buttons = Array.from(document.querySelectorAll('.buttons > button'));
                const activeElements = Array.from(document.querySelectorAll('[data-action="animated"]'));

                function toggle() {
                    activeElements.forEach(item => {
                        item.classList.toggle('signup-button-active');
                        item.classList.toggle('login-button-active');
                    });
                };

                buttons.forEach(item => item.addEventListener('click', toggle));
            </script>
    </body>    
</html>
