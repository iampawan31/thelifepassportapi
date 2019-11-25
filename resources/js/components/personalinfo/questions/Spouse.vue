<template>
    <div class="c">
        <div
            class="question-item"
            data-nextpage="questions/previous-spouse.php"
            data-viewpage="views/spouse.php"
            data-prevpage="views/personal-details.php"
        >
            <div class="question-header">
                <h3>Are you married?</h3>
                <div class="yesno">
                    <router-link class="btn-yes" to="/spouse">Yes</router-link>
                    <router-link class="btn-no" to="/">No</router-link>
                    <!--<a href="#" class="btn-yes">Yes</a>
                    <a href="#" class="btn-no">No</a>-->
                </div>
            </div>
            <a href="#" class="btn-skip">Skip</a>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {};
    },
    mounted() {},
    methods: {}
};
</script>