<template>
    <div class="c">
        <div
            class="question-item"
            data-nextpage="questions/medical-providers.php"
            data-viewpage="views/computer-passwords.php"
        >
            <div class="question-header">
                <h3>Do you have computers/devices do you utilize that are password protected?</h3>
                <div class="yesno">
                    <router-link to="/computer-passwords" class="btn-yes">Yes</router-link>
                    <router-link to="/medical-providers-question" class="btn-no">No</router-link>
                </div>
            </div>
        </div>
    </div>
</template>