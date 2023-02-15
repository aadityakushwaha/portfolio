function onSignIn(googleUser) {
  // Get user information
  var profile = googleUser.getBasicProfile();
  var id_token = googleUser.getAuthResponse().id_token;
  var name = profile.getName();
  var email = profile.getEmail();
  var image = profile.getImageUrl();
  
  // Set the values to the HTML elements
  document.getElementById("name").innerHTML = name;
  document.getElementById("email").innerHTML = email;
  document.getElementById("image").setAttribute("src", image);

  // Send the id token to your server-side for validation
  // using an AJAX call, for example:
  /*
  $.ajax({
    type: "POST",
    url: "your_server_url",
    data: {
      id_token: id_token
    },
    success: function(response) {
      console.log(response);
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
  */
}

function signout() {
  // Sign out the user from Google
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    console.log('User signed out.');
  });
}

