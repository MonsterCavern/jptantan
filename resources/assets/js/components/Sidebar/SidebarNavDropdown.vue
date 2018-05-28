<template>
  <router-link tag="li" class="nav-item nav-dropdown" :to="url" disabled>
    <div class="nav-link nav-dropdown-toggle" @click="handleClick"><i :class="icon"></i> {{name}}</div>
    <ul class="nav-dropdown-items" :style="NDIstyle">
      <slot></slot>
    </ul>
  </router-link>
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
        },
        NDIstyle: {
            type: String,
            default: "padding-left: 5px;"
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
