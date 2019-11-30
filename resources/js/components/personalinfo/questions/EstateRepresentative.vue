<template>
    <div class="c">
        <div
            class="question-item"
            data-nextpage="questions/partner-estate-representative.php"
            data-viewpage="views/estate-representative.php"
        >
            <div class="question-header">
                <h3>Do you have a personal representative for your estate?</h3>
                <div class="yesno">
                    <router-link to="/estate-representative" class="btn-yes">Yes</router-link>
                    <router-link to="/partner-estate-representative-question" class="btn-no">No</router-link>
                </div>
            </div>
        </div>
    </div>
</template>