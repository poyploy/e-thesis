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
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href=" https://fonts.googleapis.com/css?family=Overpass:300,400,600,800" >
        <link href="https://fonts.googleapis.com/css?family=Kanit|Open+Sans" rel="stylesheet">
    
        <title>E-THESIS</title>
      </head>
      <style>
          /*
     CSS for the main interaction
    */
    .tabset > input[type="radio"] {
      position: absolute;
      left: -200vw;
    }
    
    .tabset .tab-panel {
      display: none;
    }
    
    .tabset > input:first-child:checked ~ .tab-panels > .tab-panel:first-child,
    .tabset > input:nth-child(3):checked ~ .tab-panels > .tab-panel:nth-child(2),
    .tabset > input:nth-child(5):checked ~ .tab-panels > .tab-panel:nth-child(3),
    .tabset > input:nth-child(7):checked ~ .tab-panels > .tab-panel:nth-child(4),
    .tabset > input:nth-child(9):checked ~ .tab-panels > .tab-panel:nth-child(5),
    .tabset > input:nth-child(11):checked ~ .tab-panels > .tab-panel:nth-child(6) {
      display: block;
    }
    
    /*
     Styling
    */
    body {
      font: 16px/1.5em "Overpass", "Open Sans", Helvetica, sans-serif;
      color: #333;
      font-weight: 300;
      text-align: center;
      background-color: #00adff4d;
      
    }
    .card{
        width: 80%;
        padding: 5% 5% 2% 5%;
        margin: auto;
    }
    .tabset > label {
      position: relative;
      display: inline-block;
      padding: 15px 15px 25px;
      border: 1px solid transparent;
      border-bottom: 0;
      cursor: pointer;
      font-weight: 600;
    }
    
    .tabset > label::after {
      content: "";
      position: absolute;
      left: 15px;
      bottom: 10px;
      width: 22px;
      height: 4px;
      background: #8d8d8d;
    }
    
    .tabset > label:hover,
    .tabset > input:focus + label {
      color: #06c;
    }
    
    .tabset > label:hover::after,
    .tabset > input:focus + label::after,
    .tabset > input:checked + label::after {
      background: #06c;
    }
    
    .tabset > input:checked + label {
      border-color: #fff;
      border-bottom: 1px solid #fff;
      margin-bottom: -1px;
    }
    
    .tab-panel {
      padding: 30px 0;
      border-top: 1px solid #fff;
    }

    #STUDENT.form-english{
            font:600 14px/1 'Roboto',sans-serif; 
            color:#ff0000;  
            float: left;;
            margin:0 0 25px 0; 
        }

    
    /*
     Demo purposes only
    */
    *,
    *:before,
    *:after {
      box-sizing: border-box;
    }
    
    body {
      padding: 30px;
    }
    
    .tabset {
      max-width: 65em;
    }
    
    .tabset > label:hover::after, .tabset > input:focus + label::after, .tabset > input:checked + label::after {
        background: #06c;
    }
    .tabset > label:hover::after, .tabset > input:focus + label::after, .tabset > input:checked + label::after {
        background: #06c;
    }
    .tabset > label:hover, .tabset > input:focus + label {
        color: black;
    }
      </style>
      <body>
        
        <div class="container">
    
        
        <div class="wrapper">
            <h1><b>E-THESIS REGISTER</b></h1>
        <div class="tabset">
            <!-- Tab 1 -->
            <input type="radio" name="tabset" id="tab1" aria-controls="customer" checked>
            <label for="tab1">STUDENT</label>
            <!-- Tab 2 -->
            <input type="radio" name="tabset" id="tab2" aria-controls="seller">
            <label for="tab2">TEACHER</label>
           
            
            <div class="tab-panels">
            <section id="STUDENT" class="tab-panel">
                {{-- <h2>สมัครสมาชิก</h2> --}}
                <p><strong>STUDENT: </strong> Register a student new membership</p>
               
                <div class="col-xs-12 card " >
                    <form method="post" action="{{ url('/register') }}">
                
                            {!! csrf_field() !!}
                
                            <input type="hidden" name="role" value="3">
                            <p class="form-english">*กรุณากรอกข้อมูลชื่อจริง-นามสกุลเป็นภาษาอังกฤษเท่านั้น</p>
                            <div class="form-group has-feedback{{ $errors->has('name_TH') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="name_TH" value="{{ old('name') }}" placeholder="ThaiName">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                
                                @if ($errors->has('name_TH'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name_TH') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group has-feedback{{ $errors->has('surname_TH') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="surname_TH" value="{{ old('name') }}" placeholder="SurName">
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
                                {{-- <div class="col-xs-8">
                                    <div class="checkbox icheck">
                                        <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms</a>
                                        </label>
                                    </div>
                                </div> --}}
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
            </section>
            


            {{-- teacher form --}}
            <section id="TEACHER" class="tab-panel">
                    {{-- <h2>สมัครสมาชิก</h2> --}}
                    <p><strong>TEACHER: </strong> Register a student new membership</p>
                   
                    <div class="col-xs-12 card " >
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
                                    {{-- <div class="col-xs-8">
                                        <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox"> I agree to the <a href="#">terms</a>
                                            </label>
                                        </div>
                                    </div> --}}
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
                </section>

            </div>
        </div>
        {{-- tabset --}}

        </div>
        {{-- wrapper --}}

        </div>
        {{-- container --}}

        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>  
    
            

</html>
