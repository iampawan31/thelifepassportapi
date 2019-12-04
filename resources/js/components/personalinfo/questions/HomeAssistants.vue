<template>
    <div class="c">
        <div
            class="question-item"
            data-nextpage="questions/spiritual-advisor.php"
            data-viewpage="views/home-assistants.php"
        >
            <div class="question-header">
                <h3>Do you have any home assistants?</h3>
                <div class="yesno">
                    <router-link to="/home-assistants" class="btn-yes">Yes</router-link>
                    <router-link to="" class="btn-no">No</router-link>
                </div>
            </div>
            <div class="question-content hidden"></div>
        </div>
    </div>
</template>