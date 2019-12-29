<template>
    <div class="c">
        <div class="question-item">
            <div class="question-header">
                <h3>Are you married?</h3>
                <div class="yesno">
                    <a href="javascript:void(0)" @click.prevent="marriagestatus(1)" class="btn-yes">Yes</a>
                    <a href="javascript:void(0)" @click.prevent="marriagestatus(0)" class="btn-no">No</a>
                </div>
            </div>
            <a href="javascript:void(0)" @click.prevent="marriagestatus(2)" class="btn-skip">Skip</a>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            spouseDetails: [],
            formData: []
        }
    },
    created () {
        
    },
    mounted() {

    },
    methods: {
        marriagestatus(status) {
            if (status == 0) {
                this.formData = {is_married: "0"}
            } else if (status == 1) {
                this.formData = {is_married: "1"}
            } else if (status == 2) {
                this.formData = {is_married: "2"}
            }
            
            axios.post('spouse/updatemarriagestatus', this.formData)
            .then((response) => {
                if (status == '1') {
                    this.$router.push('/spouse');
                } else {
                    this.$router.push('/previous-spouse');
                }
            })
            .catch(function(){

            });
        }
    }
};
</script>