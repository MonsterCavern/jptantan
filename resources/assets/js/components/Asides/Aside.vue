<template>
    <aside class="aside-menu">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" v-for="(tab,index) in tabs" :key="index">
              <a class="nav-link" data-toggle="tab" role="tab" :href="'#'+tab.name" :class="tab.class">
                <i class="material-icons">{{tab.icon}}</i>
              </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <Timeline id="timeline" :class="'active'"/>
            <Message id="message"/>
        </div>
    </aside>
</template>

<script>
import cSwitch from '../Switch'
import Timeline from './Timeline'
import Message from './Message'
export default {
    data() {
        return {
            tabs: [{
                name: 'timeline',
                icon: 'list',
                class: 'active'
            }, {
                name: 'message',
                icon: 'message',
            }]
        }
    },
    components: {
        cSwitch,
        Timeline,
        Message
    }
}
</script>
