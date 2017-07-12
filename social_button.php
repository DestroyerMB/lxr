<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
  FB.init({
    appId            : '344827722600977',
    autoLogAppEvents : true,
    xfbml            : true,
    version          : 'v2.9'
  });
  FB.Event.subscribe('auth.statusChange', getFBUser);
  FB.Event.subscribe('edge.create', function(response) {
    // like clicked
    alert(response);
    console.log('like');
  });
};

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=344827722600977";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


  function getFBUser(response) {
      if(response.authResponse.userID != "undefined") {
        renderLoginButton();
      }

     FB.api('/me', function(response) {
      console.log(response);
      //var img_link = "http://graph.facebook.com/"+response.id+"/picture"
    });
  }

  function renderLoginButton() {
      document.getElementById('controlls').innerHTML =`<div id="login_button" class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with"
data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>`;

  }

</script>

<div id="controlls"></div>
<script>
renderLoginButton();
</script>

<!-- Your like button code -->
<div class="fb-like"
  data-href="<? echo 'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>"
  data-layout="button_count"
  data-action="like"
  data-share="true"
  data-show-faces="false">
</div>

  </body>
</html>
