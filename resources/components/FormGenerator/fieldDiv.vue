<template lang="html">
  <div 
       v-model="value"
       :disabled="schema.disabled"
       :maxlength="schema.max"
       :class="schema.class"
       :placeholder="schema.placeholder"
       :readonly="schema.readonly"
       @click = "schema.onclick"
       >
  {{ schema.text }}     
  </div>
</template>

<script>
import { abstractField } from "vue-form-generator";
export default {
  mixins: [abstractField]
};
</script>

<style lang="css">
</style>
