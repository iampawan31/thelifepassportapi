<template>
    <div class="field-group">
        <label for="phone_nubmer">Phone Numbers</label>
        <div class="add-anohter-field">
            <div class="field-wrapper" v-for="(phone, index) in phones" v-bind:key="index">
                <input
                    type="text"
                    v-model="phone.number"
                    numeric-keyboard-toggle
                    class="field-input input-mobile"
                    placeholder="Phone number"
                    value=""
                    name="phone[]"
                />
                <a href="javascript:void(0);" v-if="index != 0" class="btn-remove" @click="removePhone(index)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                </a>
            </div>
            <div class="btn-add">
                <a href="javascript:void(0);" @click="addPhone">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Add another
                </a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            phones: [],
            blockRemoval: true,
        }
    },
    watch: {
        phones () {
            this.blockRemoval = this.phones.length <= 1
        }
    },
    methods: {
        addPhone () {
            // let checkEmptyLines = this.lines.filter(line => line.number === null)
            // console.log(checkEmptyLines);
            // if (checkEmptyLines.length >= 1 && this.lines.length > 0) return

            this.phones.push({number: null})
        },
        removePhone (lineId) {
            if (!this.blockRemoval) this.phones.splice(lineId, 1)
        }
    },
    mounted () {
        this.addPhone()
    }
}
</script>
