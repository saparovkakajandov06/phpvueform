<!DOCTYPE html>
<html>
<head>
	<title>Vue.js Registration with PHP/MySQLi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h1 class="page-header text-center">PHP Форма с Vue</h1>
	<div id="register">
		<div class="col-md-4">
			
			<div class="panel panel-primary">
			  	<div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Регистрация Пользователя </div>
			  	<div class="panel-body">

                    <label>Имя:</label>
                    <input type="text" class="form-control" ref="firstname" v-model="regDetails.firstname" v-on:keyup="keymonitor">
                    <div class="text-center" v-if="errorFirstname">
                        <span style="font-size:13px;">{{ errorFirstname }}</span>
                    </div>

                    <label>Фамилия:</label>
                    <input type="text" class="form-control" ref="lastname" v-model="regDetails.lastname" v-on:keyup="keymonitor">
                    <div class="text-center" v-if="errorLastname">
                        <span style="font-size:13px;">{{ errorLastname }}</span>
                    </div>

                    <label>Email:</label>
			    	<input type="text" class="form-control" ref="email" v-model="regDetails.email" v-on:keyup="keymonitor">
			    	<div class="text-center" v-if="errorEmail">
			    		<span style="font-size:13px;">{{ errorEmail }}</span>
			    	</div>

			    	<label>Пароль:</label>
			    	<input type="password" class="form-control" ref="password" v-model="regDetails.password" v-on:keyup="keymonitor">
			    	<div class="text-center" v-if="errorPassword">
			    		<span style="font-size:13px;">{{ errorPassword }}</span>
			    	</div>

			  	</div>
			  	<div class="panel-footer">
			  		<button class="btn btn-primary btn-block" @click="userReg();"><span class="glyphicon glyphicon-check"></span> Добавить </button>
			  	</div>
			</div>

			<div class="alert alert-danger text-center" v-if="errorMessage">
				<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-alert"></span> {{ errorMessage }}
			</div>

			<div class="alert alert-success text-center" v-if="successMessage">
				<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-check"></span> {{ successMessage }}
			</div>

		</div>

		<div class="col-md-8">
			<h3>Пользователи</h3>
			<table class="table table-bordered table-striped">
				<thead>
					<th>ID</th>
					<th>Имя</th>
					<th>Фамилия</th>
					<th>Email</th>
					<th>Пароль</th>
				</thead>
				<tbody>
					<tr v-for="user in users">
						<td>{{ user.userid }}</td>
						<td>{{ user.firstname }}</td>
						<td>{{ user.lastname }}</td>
						<td>{{ user.email }}</td>
						<td>{{ user.password }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="vue.js"></script>
<script src="axios.js"></script>
<script src="app.js"></script>
</body>
</html>