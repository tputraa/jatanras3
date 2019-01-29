
$(document).ready(function(){
	jQuery.validator.addMethod("checkUsernameExists", function(value, element)
       {
           var response;
           var post_url_check_username = baseurl + "Admin/User/checkUsernameExists/";
           
               $.ajax({
                      type: "POST",
                      url: post_url_check_username,
                      data: {username : value},
                      dataType: "json",
                      async: false
               }).done(function(result){
                   //alert(result.status);
                    if(result.status == true){
                        response = false;
                    }else{
                        response = true;    
                    }
               });
               return response;
       }, "Username already taken.");
       
       
       jQuery.validator.addMethod("checkEmailExist", function(value, element)
       {
           var response = false;
           
           var post_url_check_email = baseurl +"Admin/User/checkEmailExist/";
           
           $.ajax({
                  type: "POST",
                  url: post_url_check_email,
                  data: {email : value},
                  dataType: "json",
                  async: false
           }).done(function(result){
                if(result.status == true){
                    response = false;
                }else{
                    response = true;    
                }
           });
           return response;
       }, "Email already taken.");
	
});