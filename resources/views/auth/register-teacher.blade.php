   {{-- <h2>สมัครสมาชิก</h2> --}}
   <p><strong>TEACHER: </strong> Register a student new membership</p>
                   
   <div class="col-xs-12 card " >
       <form method="post" action="{{ url('/register') }}">
   
               {!! csrf_field() !!}
   
               <input type="hidden" name="role" value="2">
               <div class="form-group has-feedback{{ $errors->has('name_TH') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="name_TH" value="{{ old('name_TH') }}" placeholder="ชื่อ (ภาษาไทย)*">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
    
                    @if ($errors->has('name_TH'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name_TH') }}</strong>
                        </span>
                    @endif
                </div>
   
                <div class="form-group has-feedback{{ $errors->has('surname_TH') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="surname_TH" value="{{ old('surname_TH') }}" placeholder="นามสกุล (ภาษาไทย)*">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
    
                    @if ($errors->has('surname_TH'))
                        <span class="help-block">
                            <strong>{{ $errors->first('surname_TH') }}</strong>
                        </span>
                    @endif
                </div>
   
                <div class="form-group has-feedback{{ $errors->has('name_EN') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="name_EN" value="{{ old('name_EN') }}" placeholder="ชื่อ (ภาษาอังกฤษ)*">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
    
                    @if ($errors->has('name_EN'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name_EN') }}</strong>
                        </span>
                    @endif
                </div>
   
                <div class="form-group has-feedback{{ $errors->has('surname_EN') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="surname_EN" value="{{ old('surname_EN') }}" placeholder="นามสกุล (ภาษาอังกฤษ)*">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
    
                    @if ($errors->has('surname_EN'))
                        <span class="help-block">
                            <strong>{{ $errors->first('surname_EN') }}</strong>
                        </span>
                    @endif
                </div>
   
               <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                   <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="อีเมล์*">
                   <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
   
                   @if ($errors->has('email'))
                       <span class="help-block">
                           <strong>{{ $errors->first('email') }}</strong>
                       </span>
                   @endif
               </div>
   
               <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                   <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน*">
                   <span class="glyphicon glyphicon-lock form-control-feedback"></span>
   
                   @if ($errors->has('password'))
                       <span class="help-block">
                           <strong>{{ $errors->first('password') }}</strong>
                       </span>
                   @endif
               </div>
   
               <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                   <input type="password" name="password_confirmation" class="form-control" placeholder="ยืนยันรหัสผ่าน">
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