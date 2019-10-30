<template>
    <div class="wrapper">
        <leftnav></leftnav>
        <personal-form></personal-form>
    </div>
</template>
<script>
import leftnav from './LeftNav.vue';
import personalForm from './PersonalDetails.vue';

export default {
    components: {
        leftnav,
        personalForm
    },
    data() {
        return {

        }
    },
    mounted() {
            
    },
    methods:{

    }
}
</script>