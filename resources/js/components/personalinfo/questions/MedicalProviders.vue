<template>
    <div class="c">
        <div
            class="question-item"
            data-nextpage="questions/health-surrogate.php"
            data-viewpage="views/medical-providers.php"
        >
            <div class="question-header">
                <h3>Who are your key medical and dental providers?</h3>
                <div class="yesno">
                    <router-link to="/medical-providers" class="btn-yes">Yes</router-link>
                    <router-link to="/health-surrogate-question" class="btn-no">No</router-link>
                </div>
            </div>
        </div>
    </div>
</template>