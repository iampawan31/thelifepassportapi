<template>
    <div class="c">
        <div
            class="question-item"
            data-nextpage="questions/close-friends.php"
            data-viewpage="views/family-members.php"
        >
            <div class="question-header">
                <h3>Would you like to add close family members including children?</h3>
                <div class="yesno">
                    <router-link class="btn-yes" to="/family-members">Yes</router-link>
                    <router-link class="btn-no" to="/close-friends-question">No</router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>