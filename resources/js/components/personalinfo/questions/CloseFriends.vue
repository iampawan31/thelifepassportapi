<template>
    <div class="c">
        <div
            class="question-item"
            data-nextpage="questions/home-assistants.php"
            data-viewpage="views/close-friends.php"
        >
            <div class="question-header">
                <h3>Would you like any close friends contacted?</h3>
                <div class="yesno">
                    <router-link to="/close-friends" class="btn-yes">Add</router-link>
                    <router-link to="" class="btn-no">No</router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {};
</script>
