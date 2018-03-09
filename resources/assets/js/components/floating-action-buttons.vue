<template lang="html">
    <div class="btn-toolbar">
      <div class="btn-group-sm mr-2" style="margin:20px;">
        <button 
          v-for="(subButton,idx) in subButtons" 
          :key="idx" 
          :class="subButton.class"
          type="button" 
          class="btn bmd-btn-fab" 
          >
          <i class="material-icons">{{ subButton.icon }}</i>
        </button>
      </div>
      
      <div class="btn-group">
        <button type="button" class="btn btn-danger bmd-btn-fab" id="main">
          <i class="material-icons">grade</i>
        </button>
      </div>
    </div>
  
</template>

<script>
export default {
    data() {
        return {
            direction: '',//'btn-group-vertical',
            subButtons: [
                {
                    id: 'autre',
                    icon: 'grade',
                    class: 'btn-danger'
                },
                {
                    id: 'sms',
                    icon: 'grade',
                    class: 'btn-primary'
                },
                // {
                //     id: 'mail',
                //     icon: 'grade',
                //     class: 'btn-danger'
                // }
            ]
        };
    },
    methods:{
        setSubButtonStyle: function(arr){
            console.log(arr);
            
            let style = 'top: -'+arr.length+'px;';

            return style;
        }
    }
};
</script>

<style lang="css">
/* .btn-group-sm .bmd-btn-fab{
  position: fixed !important;
  right: 29px;
}
.btn-group .bmd-btn-fab{
  position: fixed !important;
  right: 20px;
} */
</style>
