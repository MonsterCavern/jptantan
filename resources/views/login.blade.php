<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Upay Login</title>

    <!-- Icons -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <div class="input-group mb-3">
                              <span class="input-group-addon"><i class="icon-user"></i></span>
                              <input type="text" class="form-control" placeholder="Username">
                            </div>
                            <div class="input-group mb-4">
                              <span class="input-group-addon"><i class="icon-lock"></i></span>
                              <input type="password" class="form-control" placeholder="Password">
                            </div>
                            {{--  --}}
                            <div class="row">
                              <div class="col-6">
                                <button type="button" class="btn btn-primary px-4">Login</button>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="card py-5 d-md-down-none info" style="width: 20rem;">
                        <div class="card-body">
                            <div class="card-title">
                                <img src="/images/logo.png" class="card-img-top">
                            </div>
                            <p class="text-muted card-text"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://apis.google.com/js/api:client.js"></script>

    <script src="js/pro.js"></script>
    <script>
    $(document).ready(function() {
        if (localStorage.getObject('user') !== null) {
        }
        data = {
          
        };
        $json = $.ajax({
            url:'/admin/auth',
            method:"post",
            data: data
        });
        console.log($json);
    });
    </script>

</body>

</html>
