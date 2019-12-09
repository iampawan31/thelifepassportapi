<template>
	<div id="b">
		<div class="questions-list">
			<div class="item active">
				<span class="item__status">
					<i data-feather="check"></i>
				</span>
				<h3>
					<router-link to="/" exact>Your personal details</router-link>
				</h3>
				<div class="item__meta">
					<span class="item__last-updated">Last Updated: 10.09.2018</span> &nbsp;/&nbsp;
					<a href="#">Edit</a>
				</div>
			</div>
			<div class="item">
				<span class="item__status">
					<i data-feather="check"></i>
				</span>
				<h3><a>Are you married?</a></h3>
				<div class="item__meta">
					You answered:
					<strong>YES</strong>
					<br />
					<span class="item__last-updated">Last Updated: 10.09.2018</span> &nbsp;/&nbsp;
					<a href="#">Edit</a>
				</div>
			</div>
			<div class="item">
				<span class="item__status">
					<i data-feather="check"></i>
				</span>
				<h3>Were you previously married?</h3>
				<div class="item__meta">
					You answered:
					<strong>No</strong>
					<br />
					<span class="item__last-updated">Last Updated: 10.09.2018</span> &nbsp;/&nbsp;
					<a href="#">Edit</a>
				</div>
			</div>

			<div class="item">
				<span class="item__status">
					<i data-feather="check"></i>
				</span>
				<h3>Would you like to add close family members including children?</h3>
				<div class="item__meta">
					Member added :
					<strong>06</strong>
					<br />
					<span class="item__last-updated">Last Updated: 10.09.2018</span> &nbsp;/&nbsp;
					<a href="#">Edit</a>
				</div>
			</div>

			<div class="item">
				<span class="item__status">
					<i data-feather="check"></i>
				</span>
				<h3>Would you like any close friends contacted?</h3>
				<div class="item__meta">
					Friends added :
					<strong>04</strong>
					<br />
					<span class="item__last-updated">Last Updated: 10.09.2018</span> &nbsp;/&nbsp;
					<a href="#">Edit</a>
				</div>
			</div>

			<div class="item item__no-data">
				<h3>Do you have any home assistants?</h3>
				<div class="item__meta">
					<span class="item__last-updated">Not Visited</span> &nbsp;/&nbsp;
					<a href="#">Manage</a>
				</div>
			</div>
			<div class="item item__no-data">
				<h3>Do you have a religious or spiritual advisor?</h3>
				<div class="item__meta">
					<span class="item__last-updated">Not Visited</span> &nbsp;/&nbsp;
					<a href="#">Manage</a>
				</div>
			</div>
			<div class="item item__no-data">
				<h3>Do you have a personal representative for your estate?</h3>
				<div class="item__meta">
					<span class="item__last-updated">Not Visited</span> &nbsp;/&nbsp;
					<a href="#">Manage</a>
				</div>
			</div>
			<div class="item item__no-data">
				<h3>Does your spouse/life partner/signifcant other have a personal representative of their estate?</h3>
				<div class="item__meta">
					<span class="item__last-updated">Not Visited</span> &nbsp;/&nbsp;
					<a href="#">Manage</a>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {};
	},
	mounted() {},
	methods: {}
};
</script>