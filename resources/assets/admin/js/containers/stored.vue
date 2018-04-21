<template>
  <div class="container py-5">
      <div class="row">
          <div class="col-md-12">
              <div class="row">
                  <div class="col-md-6 mx-auto">
                      <div class="card rounded-0">
                          <div class="card-header">
                              <h3 class="mb-0">儲值</h3>
                          </div>
                          <!-- <div class="card-body">
                                  <div class="form-group">
                                      <label>選擇儲值對象</label>
                                      <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Right-aligned menu
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                          <button class="dropdown-item" type="button">Action</button>
                                          <button class="dropdown-item" type="button">Another action</button>
                                          <button class="dropdown-item" type="button">Something else here</button>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label>輸入儲值金額</label>
                                      <input type="text" v-bind:readonly="true" v-model="userEmail" class="form-control form-control-lg rounded-0" required="">
                                  </div>
                                  <button type="submit" class="btn btn-success btn-lg float-right" v-on:click="update">儲存</button>
                          </div> -->
                          <div class="container">
  <h2>Dropdowns</h2>
  <p>The .dropdown class is used to indicate a dropdown menu.</p>
  <p>Use the .dropdown-menu class to actually build the dropdown menu.</p>
  <p>To open the dropdown menu, use a button or a link with a class of .dropdown-toggle and data-toggle="dropdown".</p>
  <div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      Dropdown button
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Link 1</a>
      <a class="dropdown-item" href="#">Link 2</a>
      <a class="dropdown-item" href="#">Link 3</a>
    </div>
  </div>
</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      // 初始化
      isReadOnly:true,
      userName:'',
      userEmail:''
    }
  },
  methods: {
    update: function() {
    console.log('更新');
    if (!this.userName.replace(/\s/g, '').length) {
        alert('請輸入姓名');
        return
    }
    var google_id = localStorage.getItem('google_id');
    var self = this;
    var item = {
      google_id:google_id,
      name: self.userName
    };

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "PUT",
      url: '/api/userInfo',
      data: item,
      success: function(data) {
        alert(data.message);
        self.isReadOnly=true;
      },
      error: function(data, textStatus, errorThrown) {
        alert('修改失敗' + textStatus + errorThrown);
      },
    });
  },
  edit: function() {
    console.log('點擊編輯');
    this.isReadOnly=false;
  }
  },
  mounted() {
    console.log('page add');
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
  },
  created: function() {
      //var googleID = '102838189176578023662';
      let url = 'http://upay.test/getUserInfoById/' + google_id;
      var self = this;
      $.get(url, function(data) {
        console.log(data);
        self.userName = data.data.name
        self.userEmail = data.data.email
      });
  }
}
</script>
