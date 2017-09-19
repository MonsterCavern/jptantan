@extends('backend.login.master')
@section('content')
     <div class="row">
         <div class="col-md-4 col-md-offset-4">
             <div class="login-panel panel panel-default">
                 <div class="panel-heading">
                     <h3 class="panel-title">Please Sign In</h3>
                 </div>
                 <div class="panel-body">
                     <form id="login" role="form">
                         <fieldset>
                             <div class="form-group">
                                 <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                             </div>
                             <div class="form-group">
                                 <input class="form-control" placeholder="Password" name="password" type="password" value="">
                             </div>
                             <div class="checkbox">
                                 <label>
                                     <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                 </label>
                             </div>
                             <!-- Change this to a button or input when using this as a form -->
                             <a href="#" class="btn btn-lg btn-success btn-block">Login</a>
                         </fieldset>
                     </form>
                 </div>
             </div>
         </div>
     </div>
@endsection

@section('js')
  <script>
  requirejs(['/scripts/config.js'],function (app) {
     requirejs(['api!ajax'],function (ajax) {
       console.log(ajax());
     });
  });
  </script>

@endsection
