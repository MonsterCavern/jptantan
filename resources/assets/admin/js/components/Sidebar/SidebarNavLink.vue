<template>
  <a :href="url" class="nav-link">
    <i :class="icon"></i> {{name}}
    <span class="badge badge-success" :class="'badge-'+badge.variant">{{badge.text}}</span>
  </a>
</template>

<script>
export default {
  name: 'sidebar-nav-link',
  props: {
    name: {
      type: String,
      default: ''
    },
    url: {
      type: String,
      default: ''
    },
    icon: {
      type: String,
      default: ''
    },
    badge: {
      default: ''
    }
  }
}
</script>
