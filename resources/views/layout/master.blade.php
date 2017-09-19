<!DOCTYPE html>
<html lang="en">
@include('layout.header')
    <body>
        <div class="ui borderless stackable main menu" style="">
          <div class="ui text container">
            <div href="#" class="header item">
              <img class="logo" src="assets/images/logo.png">
              JPTanTan
            </div>
            <a href="#" class="item">小說</a>
            <a href="#" class="item">新聞</a>
            <a href="#" class="item">Blog</a>
            <a href="#" class="ui right floated dropdown item" tabindex="0">
              功能選單 <i class="dropdown icon"></i>
              <div class="menu transition hidden" tabindex="-1">
                <div class="item">書籤</div>
                <div class="item">頁面顏色</div>
              </div>
            </a>
          </div>
        </div>
        <div id="pro-info" class="col-md-3 col-xs-12 pull-right">

            <div class="form">
                <v-login-form>
                </v-login-form>
            </div>
            <div class="ui fluid card hidden">
                <div class="content">
                  <img class="right floated small ui image" src="/images/avatar2/large/kristy.png">
                  <div class="header">
                    Elliot Fu
                  </div>
                  <div class="meta">
                    Friends of Veronika
                  </div>
                  <div class="description">
                    <div class="ui blue progress">
                      <div class="bar">
                        <div class="label">Rating</div>
                      </div>

                    </div>

                  </div>
                </div>
                <div class="extra content">
                  <div class="ui two buttons">
                    <div class="ui basic green button">Approve</div>
                    <div class="ui basic red button">Decline</div>
                  </div>
                </div>
            </div>
        </div>
        <div id="{{ $filename }}" class="container">
            @yield('content')
        </div>
    </body>
@include('layout.footer')

</html>
@yield('js')
@include('layout.cdn')

<script>

$(document).ready(function () {
    // fix main menu to page on passing
    $('.main.menu').visibility({
        type: 'fixed'
    });
    // show dropdown on hover
    $('.main.menu  .ui.dropdown').dropdown({
        on: 'hover'
    });

    // $(document).on('click','.login',function() {
    //     $this = $(this);
    //     formData = $this.parents('form').serializeObject();
    //     console.log(formData);
    // });

});



</script>
