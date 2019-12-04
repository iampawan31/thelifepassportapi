<template>
    <div class="c">
        <div
            class="question-item"
            data-nextpage="questions/belong.php"
            data-viewpage="views/partner-estate-representative.php"
        >
            <div class="question-header">
                <h3>Does your spouse/life partner/signifcant other have a personal representative of their estate?</h3>
                <div class="yesno">
                    <router-link to="/partner-estate-representative" class="btn-yes">Yes</router-link>
                    <router-link to="/belong-question" class="btn-no">No</router-link>
                </div>
            </div>
        </div>
    </div>
</template>