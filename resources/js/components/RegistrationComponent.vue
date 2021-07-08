<template>
	<div class="card">
		<div class="card-header">
            <div class="alert alert-dismissible alert-danger" v-if="status > 200 &&
            message.length > 0">
                {{ message }}
            </div>
        </div>
		<div class="card-body">
			<form @submit.prevent="onSubmit" name="registration" action="user/create">
				<div class="form-group needs-validation">
					<label for="email">Email</label> <input class="form-control" id="email"
					                                        required type="email" v-model="email">
				</div>
				<div class="form-group">
					<label for="first_name">First name</label> <input class="form-control"
					                                                  id="first_name"
					                                                  required v-model="firstName">
				</div>
				<div class="form-group">
					<label for="last_name">Last name</label> <input class="form-control"
					                                                id="last_name"
					                                                required v-model="lastName">
				</div>
				<div class="form-group">
					<label for="phone">Phone</label> <input class="form-control" id="phone"
					                                        pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$"
					                                        required
					                                        v-model="phone"> <span
						class="text-muted small">Available formats: +(###)###-###-###,
                                                   (###)###-###-###, +#-###-###-###</span>
				</div>
				<div class="form-group">
					<label for="password">Password</label> <input class="form-control"
					                                              id="password" type="password"
					                                              v-model="password">
				</div>
				
				<hr />
				
				<button class="btn btn-sm btn-outline-primary" type="submit">Register</button>
			</form>
		</div>
		<div class="card-footer"></div>
	</div>
</template>

<script>
	import axios from "axios"
	
	export default {
		data() {
			return {
				email: '',
				password: '',
				firstName: '',
				lastName: '',
				phone: '',
                message: '',
                status: 0,
			}
		},
		methods: {
			onSubmit(event) {
				let self = this;
				
				let postData = {
					email: self.email,
					password: self.password,
					firstName: self.firstName,
					lastName: self.lastName,
					phone: self.phone
				};
				
				axios
					.post('/user/create', postData)
					.then(function(response) {
					    if(response.data.user) {
					        window.location.href = '/user/login';
                        }
                    })
                    .catch(function (error) {
                        if (error.response) {
                            self.message = error.response.data.message ?? null;
                            self.status = error.response.status ?? 500;
        
                        } else if (error.request) {
        
                        } else {
                            console.log('Error', error.message);
                        }
                    });
			}
		}
	}
</script>
