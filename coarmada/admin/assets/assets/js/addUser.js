
$(document).ready(function(){
	var addUserForm = $("#addUser");
	
	var validator = addUserForm.validate({
		
		rules:{
			nama_lengkap :{ required : true },
			email : { required : true, email : true, remote : { url : baseURL + "Admin/User/checkEmailExists", type :"post"} },
			username : { required : true, remote : { url : baseURL + "Admin/User/checkUsernameExists", type :"post"} },
			password : { required : true }
		},
		messages:{
			nama_lengkap :{ required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			username : { required : "This field is required", username : "Please enter valid username address", remote : "Username already taken" },
			password : { required : "This field is required" }
		}
	});
});