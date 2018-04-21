<template>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h3 class="mb-0">個人資訊</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>姓名</label>
                            <input type="text" v-bind:readonly="isReadOnly" v-model="userName" class="form-control form-control-lg rounded-0" name="uname1" required="">
                        </div>
                        <div class="form-group">
                            <label>信箱</label>
                            <input type="text" v-bind:readonly="true" v-model="userEmail" class="form-control form-control-lg rounded-0" required="">
                        </div>
                        <div v-if="isReadOnly == false">
                            <button type="submit" class="btn btn-success btn-lg float-right" v-on:click="update">儲存</button>
                        </div>
                        <div v-else>
                            <button type="submit" class="btn btn-success btn-lg float-right" v-on:click="edit">編輯</button>
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
            isReadOnly: true,
            userName: "",
            userEmail: ""
        };
    },
    methods: {
        update: function() {
            console.log("更新");
            if (!this.userName.replace(/\s/g, "").length) {
                alert("請輸入姓名");
                return;
            }
            let google_id = localStorage.getObject("user")["googleID"];
            var self = this;
            var item = {
                google_id: google_id,
                name: self.userName
            };

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                type: "PUT",
                url: "/api/userInfo",
                data: item,
                success: function(data) {
                    alert(data.message);
                    self.isReadOnly = true;
                },
                error: function(data, textStatus, errorThrown) {
                    alert("修改失敗" + textStatus + errorThrown);
                }
            });
        },
        edit: function() {
            console.log("點擊編輯");
            this.isReadOnly = false;
        }
    },
    mounted() {},
    created: function() {
        //var googleID = '102838189176578023662';
        let google_id = localStorage.getObject("user")["googleID"];
        let url = "api/userInfo/" + google_id;
        var self = this;
        $.get(url, function(data) {
            console.log(data);
            self.userName = data.data.name;
            self.userEmail = data.data.email;
        });
    }
};
</script>
