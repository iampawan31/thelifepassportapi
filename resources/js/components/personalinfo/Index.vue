<template>
    <div class="wrapper">
        <leftnav></leftnav>
        <router-view></router-view>
    </div>
</template>
<script>
import leftnav from "./LeftNav.vue";
import personalForm from "./PersonalDetails.vue";

export default {
    components: {
        leftnav,
        personalForm
    },
    data() {
        return {};
    },
    mounted() {},
    methods: {}
};
</script>