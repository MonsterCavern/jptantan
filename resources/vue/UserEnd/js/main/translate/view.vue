<template lang="html">
    <div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-title">
                        <h4>預覽</h4>
                    </div>
                    <div class="card-body">
                        <!-- <div v-html="preview"></div> -->
                        <iframe src="https://ncode.syosetu.com/n2267be/2/" width="100%" height="100%" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item" v-for="(tab,index) in tabs" :key="index">
                                <a class="nav-link" data-toggle="tab" role="tab" :href="'#'+tab.name" :class="tab.class">
                                  {{ tab.name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- <div v-html="preview"></div> -->
                        <div class="tab-content">
                          <div :id="tab.name" :class="tab.class" class="tab-pane" role="tabpanel" v-for="(tab,index) in tabs" :key="index">
                            Message
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import fab from "vue-fab";
export default {
  components: {
    fab
  },
  props: ["id"],
  data() {
    console.log(this);
    return {
      tabs: [
        {
          name: "google",
          class: "active"
        },
        {
          name: "自己"
        }
      ],
      createFABs: [
        {
          name: "goPage",
          icon: "undo",
          tooltip: "返回"
        }
      ]
    };
  },
  methods: {
    goPage: function(val) {
      // 回傳 給父組件
      this.$emit("changeComponent", val);
    }
  }
};
</script>

<style lang="css">
</style>
