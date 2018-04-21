<template>
  <div class="card p-4">
    <div class="card-body">
          <div id="google-signin-btn" class="g-signin2" data-width="250" data-height="50" data-longtitle="true"></div>
    </div>
  </div>
</template>

<script>
    export default {
        methods: {
            onSignIn(user) {
                const profile = user.getBasicProfile()
                var isUfispaceEmail = profile.getEmail().match('ufispace.com') != null ? true : false;
                if (isUfispaceEmail == true) {
                    this.checkUser(user)
                } else {
                    alert("非本公司帳號無法使用喔～～");
                    this.signOut();
                    location.reload();
                }
            },
            signOut() {
                var auth2 = gapi.auth2.getAuthInstance();
                auth2.signOut().then(function() {
                    console.log('User signed out.');
                });
            },
            checkUser: function(user) {
                const profile = user.getBasicProfile()
                console.log("ID: " + profile.getId());
                console.log('Full Name: ' + profile.getName());
                console.log('Given Name: ' + profile.getGivenName());
                console.log('Family Name: ' + profile.getFamilyName());
                console.log("Image URL: " + profile.getImageUrl());
                console.log("Email: " + profile.getEmail());

                var id_token = user.getAuthResponse().id_token;
                console.log("ID Token: " + id_token);

                var self = this;
                var item = {
                    email: profile.getEmail(),
                    image_url: profile.getImageUrl(),
                    user_id: profile.getId(),
                    user_name: profile.getName(),
                    user_token: user.getAuthResponse().id_token
                };
                // localStorage.userEmail = this.email;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '/api/checkUser',
                    data: item,
                    success: function(data) {
                        alert(data.message);
                        localStorage['google_id'] = profile.getId();
                        window.open("/index", "_self");
                        // if (data.errorCode === 200) {
                        //   alert(data.message);
                        //   //window.open("/index", "_self");
                        // } else {
                        //   alert(data.message);
                        // }
                    },
                    error: function(data, textStatus, errorThrown) {
                        alert('登入失敗' + textStatus + errorThrown);
                    },
                });
            }
        },
        mounted() {
            console.log(gapi);
            // gapi.signin2.render('google-signin-btn', {
            //     onsuccess: this.onSignIn
            // })
        }
    }
</script>
