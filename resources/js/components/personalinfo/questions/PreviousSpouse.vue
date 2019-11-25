<template>
    <div class="c">
        <div
            class="question-item"
            data-nextpage="questions/family-members.php"
            data-viewpage="views/previous-spouse.php"
        >
            <div class="question-header">
                <h3>Were you previously married?</h3>
                <div class="yesno">
                    <router-link class="btn-yes" to="/previous-spouse">Yes</router-link>
                    <router-link class="btn-no" to="/">No</router-link>
                </div>
            </div>
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