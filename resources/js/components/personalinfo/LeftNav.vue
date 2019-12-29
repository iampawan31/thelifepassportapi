<template>
    <div id="b">
        <nav>
            <div class="questions-list">
                <div class="item active">
                    <span class="item__status">
                        <i data-feather="check"></i>
                    </span>
                    <h3><router-link to="/" exact>Your personal details</router-link></h3>
                    <div class="item__meta">
                        <span class="item__last-updated">Last Updated: 10.09.2018</span> &nbsp;/&nbsp;
                        <a href="#">Edit</a>
                    </div>
                </div>

                <div class="item">
                    <span class="item__status"><i data-feather="check"></i></span>
                    <h3><a href="#">Are you married?</a></h3>
                    <div class="item__meta">
                    You answered: <strong>YES</strong><br />
                    <span class="item__last-updated">Last Updated: 10.09.2018</span> &nbsp;/&nbsp; <a href="#">Edit</a>
                    </div>
                </div>

                <div class="item">
                    <span class="item__status"><i data-feather="check"></i></span>
                    <h3><a href="#">Were you previously married?</a></h3>
                    <div class="item__meta">
                    You answered: <strong>No</strong><br />
                    <span class="item__last-updated">Last Updated: 10.09.2018</span> &nbsp;/&nbsp; <a href="#">Edit</a>
                    </div>
                </div>

                <div class="item current">
                    <span class="item__status"><i data-feather="chevron-right"></i></span>
                    <h3><a href="#">Would you like to add close family members including children?</a></h3>
                    <div class="item__meta">
                    Member added : <strong>06</strong><br />
                    <span class="item__last-updated">Last Updated: 10.09.2018</span> &nbsp;/&nbsp; <a href="#">Edit</a>
                    </div>
                </div>

                <div class="item item__no-data locked">
                    <span class="item__status"><i data-feather="lock"></i></span>
                    <h3>Would you like any close friends contacted?</h3>
                    <div class="item__meta">
                    <span class="item__last-updated">Not Visited</span>
                    </div>
                </div>

                <div class="item item__no-data locked">
                    <span class="item__status"><i data-feather="lock"></i></span>
                    <h3>Do you have any home assistants?</h3>
                    <div class="item__meta">
                    <span class="item__last-updated">Not Visited</span>
                    </div>
                </div>

                <div class="item item__no-data locked">
                    <span class="item__status"><i data-feather="lock"></i></span>
                    <h3>Do you have a religious or spiritual advisor?</h3>
                    <div class="item__meta">
                    <span class="item__last-updated">Not Visited</span>
                    </div>
                </div>
                <div class="item item__no-data locked">
                    <span class="item__status"><i data-feather="lock"></i></span>
                    <h3>Do you have a personal representative for your estate?</h3>
                    <div class="item__meta">
                    <span class="item__last-updated">Not Visited</span>
                    </div>
                </div>

                <div class="item item__no-data locked">
                    <span class="item__status"><i data-feather="lock"></i></span>
                    <h3>Does your spouse/life partner/signifcant other have a personal representative of their estate?</h3>
                    <div class="item__meta">
                    <span class="item__last-updated">Not Visited</span>
                    </div>
                </div>
                
                <!-- <router-link
                    to="/spouse-question"
                    v-slot="{ href, route, navigate, isActive, isExactActive }"
                >
				<div class="item">
                    <div :class="[isActive && 'active']">
                    
                        <span class="item__status">
                            <i data-feather="check"></i>
                        </span>
                        <h3><a :href="href" @click="navigate">Are you married?</a></h3>
                        <div class="item__meta">
                            You answered:
                            <strong>YES</strong>
                            <br />
                            <span class="item__last-updated">Last Updated: 10.09.2018</span> &nbsp;/&nbsp;
                            <a :href="href" @click="navigate">Edit</a>
                        </div>
						</div>
                        </div>
                </router-link>

				<router-link
                    to="/previous-spouse-question"
                    v-slot="{ href, route, navigate, isActive, isExactActive }"
                >
				<div class="item">
					<div :class="[isActive && 'active']">
						
						<span class="item__status">
							<i data-feather="check"></i>
						</span>
						<h3><a :href="href" @click="navigate">Were you previously married?</a></h3>
						<div class="item__meta">
							You answered:
							<strong>No</strong>
							<br />
							<span class="item__last-updated">Last Updated: 10.09.2018</span> &nbsp;/&nbsp;
							<a :href="href" @click="navigate">Edit</a>
						</div>
						</div>
					</div>
				</router-link>

				<router-link
                    to="/family-members-question"
                    v-slot="{ href, route, navigate, isActive, isExactActive }"
                >
					<div class="item">
					<div :class="[isActive && 'item active']">
						<span class="item__status">
							<i data-feather="check"></i>
						</span>
						<h3><a :href="href" @click="navigate">Would you like to add close family members including children?</a></h3>
						<div class="item__meta">
							Member added :
							<strong>06</strong>
							<br />
							<span class="item__last-updated">Last Updated: 10.09.2018</span> &nbsp;/&nbsp;
							<a :href="href" @click="navigate">Edit</a>
						</div>
					</div>
					</div>
				</router-link>

				<router-link
                    to="/close-friends-question"
                    v-slot="{ href, route, navigate, isActive, isExactActive }"
                >
				<div class="item">
					<div :class="[isActive && 'item active']">
						
						<span class="item__status">
							<i data-feather="check"></i>
						</span>
						<h3><a :href="href" @click="navigate">Would you like any close friends contacted?</a></h3>
						<div class="item__meta">
							Friends added :
							<strong>04</strong>
							<br />
							<span class="item__last-updated">Last Updated: 10.09.2018</span> &nbsp;/&nbsp;
							<a :href="href" @click="navigate">Edit</a>
						</div>
					</div>
					</div>
				</router-link>

				<router-link
                    to="/home-assistants-question"
                    v-slot="{ href, route, navigate, isActive, isExactActive }"
                >
                <div class="item item__no-data">
                    <h3><a :href="href" @click="navigate">Do you have any home assistants?</a></h3>
                    <div class="item__meta">
                        <span class="item__last-updated">Not Visited</span> &nbsp;/&nbsp;
                        <a href="#">Manage</a>
                    </div>
                </div>
				</router-link>

				<router-link
                    to="/close-friends-question"
                    v-slot="{ href, route, navigate, isActive, isExactActive }"
                >
                <div class="item item__no-data">
                    <h3><a :href="href" @click="navigate">Do you have a religious or spiritual advisor?</a></h3>
                    <div class="item__meta">
                        <span class="item__last-updated">Not Visited</span> &nbsp;/&nbsp;
                        <a href="#">Manage</a>
                    </div>
                </div>
				</router-link>

				<router-link
                    to="/estate-representative-question"
                    v-slot="{ href, route, navigate, isActive, isExactActive }"
                >
                <div class="item item__no-data">
                    <h3><a :href="href" @click="navigate">Do you have a personal representative for your estate?</a></h3>
                    <div class="item__meta">
                        <span class="item__last-updated">Not Visited</span> &nbsp;/&nbsp;
                        <a href="#">Manage</a>
                    </div>
                </div>
				</router-link>

				<router-link
                    to="/partner-estate-representative-question"
                    v-slot="{ href, route, navigate, isActive, isExactActive }"
                >
                <div class="item item__no-data">
                    <h3><a :href="href" @click="navigate">Does your spouse/life partner/signifcant other have a personal representative of their estate?</a></h3>
                    <div class="item__meta">
                        <span class="item__last-updated">Not Visited</span> &nbsp;/&nbsp;
                        <a href="#">Manage</a>
                    </div>
                </div>
				</router-link> -->
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            routeName: null
        };
    },
    mounted() {},
    watch: {
        $route: "currentRoute"
    },
    methods: {
        currentRoute() {
            this.$nextTick(() => {
                this.routeName = this.$route.name;
                console.log(this.routeName);
            });
        }
    }
};
</script>