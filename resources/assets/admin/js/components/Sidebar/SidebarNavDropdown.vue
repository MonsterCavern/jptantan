<template>
  <li tag="li" class="nav-item nav-dropdown" :to="url" disabled>
    <div class="nav-link nav-dropdown-toggle" @click="handleClick"><i :class="icon"></i> {{name}}</div>
    <ul class="nav-dropdown-items" style="padding-left:5px;">
      <slot></slot>
    </ul>
  </li>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      default: ""
    },
    url: {
      type: String,
      default: ""
    },
    icon: {
      type: String,
      default: ""
    }
  },
  methods: {
    handleClick(e) {
      e.preventDefault();
      e.target.parentElement.classList.toggle("open");
    }
  }
};
</script>
