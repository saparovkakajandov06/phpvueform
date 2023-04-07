var app = new Vue({
	el: '#register',
	data:{
		successMessage: "",
		errorMessage: "",
		errorEmail: "",
		errorPassword: "",
		users: [],
		regDetails: {firstname: '', lastname: '', email: '', password: ''},
	},

	mounted: function(){
		this.getAllUsers();
	},

	methods:{
		getAllUsers: function(){
			axios.get('api.php')
				.then(function(response){
					if(response.data.error){
						app.errorMessage = response.data.message;
					}
					else{
						app.users = response.data.users;
					}
				});
		},

		userReg: function(){
			var regForm = app.toFormData(app.regDetails);
			axios.post('api.php?action=register', regForm)
				.then(function(response){
					console.log(response);

					if(response.data.firstname){
						app.errorFirstname = response.data.message;
						app.focusFirstname();
						app.clearMessage();
					}

					else if(response.data.lastname){
						app.errorLastname = response.data.message;
						app.focusLastname();
						app.clearMessage();
					}

					else if(response.data.email){
						app.errorEmail = response.data.message;
						app.focusEmail();
						app.clearMessage();
					}

					else if(response.data.password){
						app.errorPassword = response.data.message;
						app.errorEmail='';
						app.focusPassword();
						app.clearMessage();
					}

					else if(response.data.error){
						app.errorMessage = response.data.message;
						app.errorFirstname='';
						app.errorLastname='';
						app.errorEmail='';
						app.errorPassword='';
					}
					else{
						app.successMessage = response.data.message;
					 	app.regDetails = {firstname: '', lastname: '', email: '', password:''};
						app.errorFirstname='';
						app.errorLastname='';
					 	app.errorEmail='';
						app.errorPassword='';
					 	app.getAllUsers();
					}
				});
		},

		focusFirstname: function(){
			this.$refs.firstname.focus();
		},

		focusLastname: function(){
			this.$refs.lastname.focus();
		},

		focusEmail: function(){
			this.$refs.email.focus();
		},

		focusPassword: function(){
			this.$refs.password.focus();
		},

		keymonitor: function(event) {
       		if(event.key == "Enter"){
         		app.userReg();
        	}
       	},

		toFormData: function(obj){
			var form_data = new FormData();
			for(var key in obj){
				form_data.append(key, obj[key]);
			}
			return form_data;
		},

		clearMessage: function(){
			app.errorMessage = '';
			app.successMessage = '';
		}

	}
});