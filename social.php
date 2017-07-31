<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <script>

if (navigator.onLine) {
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '344827722600977',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.9'
    });
    FB.AppEvents.logPageView();
    FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
        console.log('Logged in.');
        console.log(getFBUser());
      }
      else {
        FB.login(function(response) {
          if (response.authResponse) {
            getFBUser();
          } else {
            console.log('User cancelled login or did not fully authorize.');
          }
        });
      }
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   function getFBUser() {
     FB.api('/me', function(response) {
      showUser(response);
    });
   }

 }
 else {
   var fake_response = {};
   fake_response.id=0;
   fake_response.name='test';
   showUser(fake_response);
 }

 function showUser(response) {
   alert("Name: "+ response.name + "\nID: "+response.id);
  }

console.log('Bottom function');

</script>

  </body>
</html>
