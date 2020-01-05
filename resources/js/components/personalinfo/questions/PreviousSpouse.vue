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
                    <a href="javascript:void(0)" @click.prevent="prevmarriagestatus(1)" class="btn-yes">Yes</a>
                    <a href="javascript:void(0)" @click.prevent="prevmarriagestatus(0)" class="btn-no">No</a>
                </div>
            </div>
            <a href="javascript:void(0)" @click.prevent="prevmarriagestatus(2)" class="btn-skip">Skip</a>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            formData: []
        };
    },
    mounted() {
        this.updatestepinfo();
    },
    methods: {
        prevmarriagestatus(status) {
            if (status == 0) {
                this.formData = {is_married: "0"}
            } else if (status == 1) {
                this.formData = {is_married: "1"}
            } else if (status == 2) {
                this.formData = {is_married: "2"}
            }
            console.log(this.formData);
            axios.post('previousspouse/updatemarriagestatus', this.formData)
            .then((response) => {
                if (status == '1') {
                    this.$router.push('/previous-spouse');
                } else {
                    this.$router.push('/family-members');
                }
            })
            .catch(function(){

            });
        },
        updatestepinfo() {
            let data = {'step_id':3, 'is_visited': '1', 'is_filled' : '0', 'is_completed' : '0'}
            axios.post('/updatepersonalstep', data)
                .then((response) => {
                    
                })
                .catch(function(){

                });
        }
    }
};
</script>