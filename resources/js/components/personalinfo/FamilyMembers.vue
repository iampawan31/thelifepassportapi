<template>
	<div class="c">
		<div
			class="question-item"
			data-nextpage="questions/close-friends.php"
		>
			<h3 class="heading3">Close family members</h3>
			<div
				id="add-member"
				class="section-form"
			>
				<!-- Add Family member section -->
				<div class="form-wrapper form-family-member">
					<h3 class="heading4 uppercase">Add family member</h3>
					<div class="error-message"></div>
					<ValidationObserver
						ref="observer"
						v-slot="{ invalid }"
					>
						<form
							id="frmFamilyMember"
							name="frmFamilyMember"
							method="post"
							class="custom-form"
							@submit.prevent="handleSubmit"
						>
							<!-- Name section -->

							<div class="row">
								<div class="col">
									<div class="field-group">
										<label
											for="legal_name"
											class="input-label"
										>Name</label>
										<ValidationProvider
											name="Name"
											rules="required|alpha_spaces|max:50"
											v-slot="{ errors }"
										>
											<input
												type="text"
												name="legal_name"
												id="legal_name"
												class="field-input required"
												placeholder="Name"
												v-model="
                                                    legalName
                                                "
											/>
											<div
												class="invalid-feedback d-block"
												v-for="(error, index) in errors"
												v-bind:key="index"
											>
												{{ error }}
											</div>
										</ValidationProvider>
									</div>
								</div>
							</div>

							<!-- Relationship section -->
							<div class="row">
								<div class="col">
									<div class="field-group">
										<label
											name="Relationship"
											for="relationship"
											class="input-label"
										>Relationship</label>
										<validation-provider
											vid="relationship_selection"
											v-slot="{ errors }"
										>
											<Select2
												name="relationship"
												id="relationship"
												placeholder="Relationship"
												width="resolve"
												v-model="
                                                    relationshipId
                                                "
												:options="relationshipOptions"
												@change="
                                                    relationshipChangeEvent(
                                                        $event
                                                    )
                                                "
												@select="
                                                    relationshipSelectEvent(
                                                        $event
                                                    )
                                                "
											/>
											<span
												v-if="
                                                    errors != undefined &&
                                                        errors.length
                                                "
												class="invalid-feedback d-block"
											>
												{{ errors[0] }}
											</span>
										</validation-provider>
									</div>
								</div>
								<div
									class="col"
									v-if="isOtherSelected"
								>
									<div class="field-group">
										<label
											for="relationship"
											class="input-label"
										>Relationship</label>
										<validation-provider
											name="Other relationship"
											rules="required_if:relationship_selection,5|alpha_spaces|max:50"
											v-slot="{ errors }"
										>
											<input
												type="text"
												name="relatiionship_other"
												id="relatiionship_other"
												class="field-input"
												placeholder="Please specify relation"
												v-model="relationshipOther"
											/>
											<span
												v-if="
                                                    errors != undefined &&
                                                        errors.length
                                                "
												class="invalid-feedback d-block"
											>
												{{ errors[0] }}
											</span>
										</validation-provider>
									</div>
								</div>
							</div>

							<!-- Home addresss section -->
							<home-address
								v-model="address"
								@input="newAddress => {address = newAddress;}"
								address-type="personal"
							/>

							<!-- Phone number(s) section -->
							<div class="row">
								<div class="col">
									<phone-details
										v-model="phoneNumbers"
										@input="
                                        newPhoneNumbers => {
                                            phoneNumbers = newPhoneNumbers;
                                        }
                                    "
									/>
								</div>
							</div>

							<!-- Former spouse's Email address section -->
							<div class="row">
								<div class="col">
									<div class="field-group">
										<label
											for="email"
											class="input-label"
										>Email</label>
										<ValidationProvider
											name="Email address"
											rules="email"
											v-slot="{ errors }"
										>
											<input
												type="text"
												name="email"
												id="email"
												class="field-input required email"
												placeholder="Email address"
												v-model="email"
											/>
											<span
												v-if="
                                                    errors != undefined &&
                                                        errors.length
                                                "
												class="invalid-feedback d-block"
											>
												{{ errors[0] }}
											</span>
										</ValidationProvider>
									</div>
								</div>
							</div>

							<!-- Date of birth Section -->
							<div class="row">
								<div class="col">
									<div class="field-group">
										<label
											for="dob"
											class="input-label"
										>Date of Birth</label>
										<ValidationProvider
											v-slot="{ errors }"
											name="Date of Birth"
											rules="date"
										>
											<input
												v-model="dateOfBirth"
												v-mask="'##/##/####'"
												type="text"
												class="field-input"
												name="date"
												placeholder="mm/dd/yyyy"
											/>
											<span
												v-if="
                                                    errors != undefined &&
                                                        errors.length
                                                "
												class="invalid-feedback d-block"
											>
												{{ errors[0] }}
											</span>
										</ValidationProvider>
									</div>
								</div>
							</div>
							<div class="field-group clearfix">
								<input
									type="submit"
									class="field-submit btn-primary"
									:value="formSubmissionText"
								/>
							</div>
						</form>
					</ValidationObserver>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import Select2 from "v-select2-component";
import HomeAddress from "./elements/Address";
import PhoneDetails from "./elements/PhoneDetails.vue";
import Email from "./elements/Email.vue";
import { ValidationObserver, ValidationProvider } from "vee-validate";

export default {
	components: {
		PhoneDetails,
		Email,
		HomeAddress,
		Select2,
		ValidationObserver,
		ValidationProvider
	},
	computed: {
		isOtherSelected() {
			return this.relationshipId === "5" ? true : false;
		},
		formSubmissionText() {
			return this.familyMemberId ? "Update and Continue" : "Add Member";
		}
	},
	data() {
		return {
			legalName: "",
			relationshipId: "",
			phoneNumbers: [],
			email: "",
			address: {
				street_address1: null,
				street_address2: null,
				city: null,
				state: null,
				zipcode: null
			},
			dateOfBirth: "",
			relationshipOther: "",
			memberDetails: [],
			relationshipOptions: [],
			familyMemberId: "",
			submitted: false
		};
	},
	created() {
		this.familyMemberId = this.$route.params.id;
		this.getFamilyRelations();
		if (this.familyMemberId) {
			this.getFamilyMemberInfo();
		} else {
			this.populateNewForm();
		}
	},
	methods: {
		async handleSubmit(e) {
			this.submitted = true;

			const isValid = await this.$refs.observer.validate();
			if (!isValid) {
				// Do Something
			} else {
				const formData = this.getFormData(e);

				if (this.familyMemberId) {
					formData.append("_method", "put");
					axios
						.post("/personal/family/" + this.familyMemberId, formData)
						.then(response => {
							console.log(response);
							this.$router.push("/family-members-question");
						})
						.catch(function() {});
				} else {
					axios
						.post("/personal/family", formData)
						.then(response => {
							console.log(response);
							this.$router.push("/family-members-question");
						})
						.catch(function() {});
				}
			}

			//this.$router.push("/close-friends-question");
		},
		getFormData(e) {
			const form = e.target;
			const formData = new FormData(form);

			formData.append("legal_name", this.legalName);
			formData.append("relationship_id", this.relationshipId);
			formData.append("relationship_other", this.relationshipOther);
			formData.append("dob", this.dateOfBirth);
			formData.append("email", this.email);
			formData.append("phones", JSON.stringify(this.phoneNumbers));
			formData.append("address", JSON.stringify(this.address));

			return formData;
		},
		populateNewForm() {
			this.name = "";
			this.relationship = "";
			this.phoneNumbers = [{ phone: null }];
			this.email = "";
			this.address = {
				street_address1: null,
				street_address2: null,
				city: null,
				state: null,
				zipcode: null
			};
		},
		populateData(familyMember) {
			this.memberId = familyMember.id;
			this.legalName = familyMember.legal_name ? familyMember.legal_name : "";
			this.relationshipId = familyMember.relationship_id
				? familyMember.relationship_id
				: "";
			this.email = familyMember.email ? familyMember.email : "";

			this.dateOfBirth = familyMember.dob;

			if (familyMember.phone.length > 0) {
				this.phoneNumbers = familyMember.phone;
			} else {
				this.phoneNumbers = [{ phone: null }];
			}

			this.relationshipOther = familyMember.relationship_other;

			if (familyMember.address) {
				this.address.street_address1 = familyMember.address.street_address1
					? familyMember.address.street_address1
					: "";
				this.address.street_address2 = familyMember.address.street_address2
					? familyMember.address.street_address2
					: "";
				this.address.city = familyMember.address.city
					? familyMember.address.city
					: "";
				this.address.state = familyMember.address.state
					? familyMember.address.state
					: "";
				this.address.zipcode = familyMember.address.zipcode
					? familyMember.address.zipcode
					: "";
			}
		},
		relationshipChangeEvent(event) {
			console.log(event);
		},
		relationshipSelectEvent(event) {
			console.log(event);
		},
		updatePhoneNumbers(data) {
			this.phoneNumbers = data;
		},
		getFamilyRelations() {
			axios.get("/personal/family/create").then(response => {
				if (response.status == 200) {
					this.relationshipOptions = response.data.data;
				}
			});
		},
		getFamilyMemberInfo() {
			if (this.familyMemberId) {
				axios
					.get("/personal/family/" + this.familyMemberId + "/edit")
					.then(response => {
						if (response.status == 200) {
							// console.log(response.data.data);
							this.populateData(response.data.data);
						}
					});
			}
		},
		updateHomeAddress(data) {
			this.address = data;
		}
	}
};
</script>
