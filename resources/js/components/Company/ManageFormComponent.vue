<template>
	<form @submit.prevent="onSubmit" enctype="multipart/form-data" method="post">
		<div class="form-group" v-bind:class="[hasErrors ? 'has-errors' : '']">
			<label for="name">Company name</label>
			<input type="text" class="form-control" v-model="name" id="name">
		</div>
		
		<div class="form-group" v-bind:class="[hasErrors ? 'has-errors' : '']">
			<label for="email">Company email</label>
			<input type="email" class="form-control" v-model="email" id="email">
		</div>
		
		<div class="form-group" v-bind:class="[hasErrors ? 'has-errors' : '']">
			<label for="webUrl">Company website</label>
			<input type="url" class="form-control" v-model="web" id="webUrl">
		</div>
		
		<div class="mb-3">
			<label for="logo" class="form-label">Logo</label>
			<input class="form-control" type="file" id="logo" @change="onChange">
			
			<div id="logo-preview" v-if="imageSrc" class="my-5">
				<img v-bind:src="imageSrc" class="w-50 h-25" />
			</div>
		</div>
		
		<hr />
		
		<button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
	</form>
</template>

<script>
	import axios from 'axios';
	
	export default {
		name: "ManageFormComponent",
		props: {
			company: null
		},
		data() {
			return {
				name: '',
				email: '',
				logo: '',
				web: '',
				hasErrors: false,
				imageSrc: '',
			}
		},
		mounted() {
			this.getCompanyData(this.$props.company);
		},
		methods: {
			getCompanyData(jsonString) {
				let companyData = JSON.parse(jsonString)
				
				this.email = companyData.email;
				this.name = companyData.name;
				this.web = companyData.web_url;
				this.imageSrc = companyData.logo_url;
			},
			onSubmit() {
				let self = this;
				
				const companyData = new FormData();
				companyData.append('name', this.name);
				companyData.append('email', this.email);
				companyData.append('logo', this.logo);
				companyData.append('web', this.web);
				
				axios
					.post('/company/save', companyData)
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
				
			},
			onChange: function (event) {
				let self = this;
				
				let files = event.target.files || event.dataTransfer.files;
				
				if (this.target || this.target !== '') {
					self.createImage(files[0]);
					
					self.logo = files[0];
				}
			},
			createImage(file) {
				let image = new Image(),
				    reader = new FileReader(),
				    vm = this;
				
				reader.onload = (e) => {
					vm.imageSrc = e.target.result;
				};
				reader.readAsDataURL(file);
			},
		}
	}
</script>

<style scoped>
	.has-errors label {
		color: red;
	}
	
	.has-errors input {
		border-color: red;
	}
</style>