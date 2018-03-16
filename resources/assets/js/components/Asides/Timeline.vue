<template lang="html">
  <div class="tab-pane" role="tabpanel">
    <Callout class="m-0 py-2 text-muted text-center bg-light text-uppercase">
        <small><b>Today</b></small>
    </Callout>
    <hr class="transparent mx-3 my-0">
    <Callout variant="warning" class="m-0 py-3">
        <div class="avatar float-right">
            <img src="static/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
        </div>
        <div>Meeting with <strong>Lucas</strong></div>
        <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
        <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA </small>
    </Callout>
    
    <hr class="mx-3 my-0">
    <Callout variant="info" class="m-0 py-3">
        <div class="avatar float-right">
            <img src="static/img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
        </div>
        <div>Skype with <strong>Megan</strong></div>
        <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 4 - 5pm</small>
        <small class="text-muted"><i class="icon-social-skype"></i>&nbsp; On-line </small>
    </Callout>
  </div>
</template>

<script>
import Callout from '../Callout'
export default {
  name:'timeline',
  components:{
    Callout
  }
  
}
</script>

<style lang="css">
</style>
