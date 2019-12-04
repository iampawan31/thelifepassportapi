<template>
	<div class="c">
		<div class="question-item" data-nextpage="questions/spouse.php" data-prevpage>
			<h3 class="heading3">Enter your personal details:</h3>
			<div class="form-wrapper">
				<ValidationObserver ref="observer" v-slot="{ invalid }">
				<form id="frmPersonalDetails" name="frmPersonalDetails" method="post" class="custom-form" @submit.prevent="handleSubmit()">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="field-group">
								<label for="legal_name" class="input-label">Legal Name</label>
								<ValidationProvider name="Legal Name" rules="required" v-slot="{ errors }">
									<input type="text" name="legal_name" v-model="personalDetail.legal_name" id="legal_name" class="field-input required" placeholder="Legal Name" />
									<div class="invalid-feedback" v-for="(error, index) in errors" v-bind:key="index">{{ error }}</div>
								</ValidationProvider>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="field-group">
								<label for="nickname" class="input-label">Nickname or Prior Name</label>
								<input type="text" name="nickname" id="nickname" v-model="personalDetail.nickname" class="field-input"
									placeholder="Nickname or prior name" />
							</div>
						</div>
					</div>

					<div class="field-group">
						<label for="home_address">Home Address</label>
						<textarea rows="2" name="home_address" id="home_address" v-model="personalDetail.home_address" class="field-input"
							placeholder="Street Address, Town, City, State, Zipcode and country"></textarea>
					</div>

					<phone></phone>

					<div class="field-group">
						<label for="dob" class="input-label">Date of Birth</label>
						<date-picker name="dob" id="dob" v-model="personalDetail.dob" valueType="format" :first-day-of-week="1"
							:lang="lang" format="MM/DD/YYYY" placeholder="MM/DD/YYYY" width="100%"
							class="field-datepicker field-input">
						</date-picker>
					</div>

					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="field-group">
								<label for="citizenship" class="input-label">Citizenship</label>
								<Select2 name="citizenship" id="citizenship" width="resolve"
									placeholder="Select an Options" v-model="personalDetail.citizenshipValue"
									:options="citizenshipOptions" @change="citizenshipChangeEvent($event)"
									@select="citizenshipSelectEvent($event)" />
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="field-group">
								<label for="passport_number" class="input-label">Passport Number</label>
								<input type="text" name="passport_number" id="passport_number" v-model="personalDetail.passport_number" class="field-input"
									placeholder="Passport Number" />
							</div>
						</div>
					</div>

					<div class="field-group">
						<label for="father_name" class="input-label">Father's name and birth place</label>
						<div class="fields-group clearfix">
							<input type="text" name="father_name" id="father_name" v-model="personalDetail.father_name" class="field-input"
								placeholder="Father's Name" />
							<input type="text" name="father_birth_place" id="father_birth_place" v-model="personalDetail.father_birth_place"
								class="field-input field-input__last" placeholder="Birth place" />
						</div>
					</div>
					<div class="field-group">
						<label for="mother_name" class="input-label">Mother's name and birth place</label>
						<div class="fields-group clearfix">
							<input type="text" name="mother_name" id="mother_name" class="field-input" v-model="personalDetail.mother_name"
								placeholder="Mother's Name" />
							<input type="text" name="mother_birth_place" id="mother_birth_place" v-model="personalDetail.mother_birth_place"
								class="field-input field-input__last" placeholder="Birth place" />
						</div>
					</div>

					<h4 class="form-subhead">Email Addresses</h4>
					<email></email>

					<h4 class="form-subhead">Social Media</h4>
					<social></social>

					<h4 class="form-subhead">Current Employers including self employment</h4>
					<employee></employee>

					<div class="field-group field-group__action clearfix">
						<input type="submit" class="field-submit btn-primary" value="Save and continue" />
					</div>
				</form>
				</ValidationObserver>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</template>
<script>
	import DatePicker from 'vue2-datepicker';
	import Select2 from 'v-select2-component';
	import Phone from './Phone.vue';
	import Email from './Email.vue';
	import Social from './Social.vue';
	import Employee from './Employee.vue';
	import { ValidationObserver, ValidationProvider } from "vee-validate";
	import { async } from 'q';
	import VueRouter from 'vue-router';
	//import { required, email, minLength } from "vuelidate/lib/validators";

	export default {
		components: {
			Phone,
			Email,
			DatePicker,
			Social,
			Employee,
			Select2,
			ValidationObserver,
			ValidationProvider
		},
		data() {
			return {
				errors: [],
				personalDetail: {
					legal_name: '',
					nickname: '',	
					dob: '',
					home_address: '',
					passport_number: '',
					passport_number: '',
					father_name: '',
					father_birth_place: '',
					mother_name: '',
					mother_birth_place: '',
					citizenshipValue: '',
				},
				// citizenshipOptions: [
				//     {
				//         text: "India",
				//         value: "IN"
				//     }, 
				//     {
				//         text: "United State",
				//         value: "US"
				//     }, 
				//     {
				//         text: "United Kingdom",
				//         value: "UK"
				//     }
				// ],
				
				citizenshipOptions: ['op1', 'op2', 'op3'],
				result2: "",
				lang: {
					days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
					months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
					pickers: ['next 7 days', 'next 30 days', 'previous 7 days', 'previous 30 days'],
					placeholder: {
						date: 'Select Date',
						dateRange: 'Select Date Range'
					}
				},
				submitted: false
			};
		},
		mounted() {},
		methods: {

			async handleSubmit(e){
				this.submitted = true;
				const isValid = await this.$refs.observer.validate();

				if(!isValid){

				}else{
					this.$router.push('/spouse-question');
				}

				
			},

			citizenshipChangeEvent(val) {
				console.log(val);
			},
			citizenshipSelectEvent({
				id,
				text
			}) {
				console.log({
					id,
					text
				})
			}
		}
	};

</script>
