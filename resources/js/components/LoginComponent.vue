<template>
	<div class="card">
		<div class="card-body">
			
			<div class="alert alert-dismissible alert-danger" v-if="hasError">
				Something went wrong
			</div>
			
			<form @submit.prevent="onSubmit" novalidate>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" v-model="email" class="form-control" id="email"
					       v-bind:class="[hasError ? 'border-danger' : '']">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" v-model="password" class="form-control" id="password"
					       v-bind:class="[hasError ? 'border-danger' : '']">
				</div>
				
				<hr />
				
				<button type="submit" class="btn btn-outline-primary">Login</button>
			</form>
		</div>
	</div>
</template>

<script>
	import axios from "axios";
	
	export default {
		name: "LoginController",
		data() {
			return {
				email: '',
				password: '',
				hasError: false,
			}
		},
		methods: {
			onSubmit(event) {
				let self = this;
				
				let postData = {
					email: self.email,
					password: self.password,
				};
				
				axios
					.post('/user/login-check', postData)
					.then(function(response) {
						if(response.data.status === 'ok') {
							window.location.href = '/';
						}
					})
					.catch(function (error) {
						if (error.response) {
						
						} else if (error.request) {
						
						} else {
							console.log('Error', error.message);
						}
						
						self.hasError = true;
					});
			}
		}
	}
</script>

<style scoped>

</style>