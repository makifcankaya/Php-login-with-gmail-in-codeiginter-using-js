<html>
<head>
  <title> Gmail Login Page </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<!-- this is google's api and it should written your cliend id to content  -->
   <meta name="google-signin-client_id" content="your-id">
</head>

<body>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
<div class="container">

  <form class="form-signin" id="formLogin4"  method="post">

          <button class="btn btn-info "  type="submit"  id="login_gmailLogin"  name="login_gmail"><i class="fa fa-google" aria-hidden="true"></i> Login</button>
        <div id="gSignIn"></div>

    </form>

</div>
<script>
$("#formLogin").submit(function(e) {
       e.preventDefault();
       renderButton();

   });

   function onSuccess(googleUser) {

     var profile = googleUser.getBasicProfile();
     gapi.client.load('plus', 'v1', function () {
         var request = gapi.client.plus.people.get({
             'userId': 'me'
         });
         //Display the user details
         request.execute(function (resp) {
           var user_name = resp.displayName;
           var user_mail = resp.emails[0].value;
           var user_id = resp.id;

           $.ajax({
               type: "POST",
               url: "gmail/gmail_login",
                data:  "userName="+user_name+"&userMail=" + user_mail+"&id="+user_id,

               success: function(data) {
                   if(data == "connect")
                   {
                     alert("Your gmail is :"+ user_mail +"\nYour gmail's id is : " + user_id);
                     console.log("Your gmail is :"+ user_mail +"\nYour gmail's id is : " + user_id);
                   }
               },
           });

         });
     });
 }

 function onFailure(error) {

     console.log("error");
 }

 function renderButton() {

     gapi.signin2.render('gSignIn', {
         'scope': 'profile email',
         'width': 240,
         'height': 50,
         'longtitle': true,
         'theme': 'dark',
         'onsuccess': onSuccess,
         'onfailure': onFailure
     });
     $("#gSignIn").show();
 }

</script>
</body>
</html>
