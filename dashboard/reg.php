<?php
 session_start();
$isUserLoggedIn = isset($_SESSION['username']  ) ? true : false;
$customerId = $isUserLoggedIn && is_numeric($_SESSION['customerId']) ? intval($_SESSION['customerId']) : 0;

if ($isUserLoggedIn) {    
         // echo 'done';
         header("Location: index.php");
    exit;

}     
 include '../header.php';
 ?>
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<div class="h-screen bg-gray-900 font-nunito">
    <div id="app">
        <nav class="bg-gray-800 shadow-sm">
            <div class="container flex justify-between items-center mx-auto px-6 py-4">
                <div>
                    <a href="index.php" class="text-xl text-white">Market for sale </a>
                </div>

                <div>
                    <a href="login.php" class="text-gray-400 font-light mx-4 hover:underline">Login</a>
                    <a href="#" class="text-gray-400 font-light hover:underline">Register</a>
                </div>
            </div>
        </nav>

        <main>
            <div class="flex items-center justify-center mt-16 mx-6">
                <div class="p-6 max-w-sm w-full bg-gray-800 shadow rounded-md">
                    <h3 class="text-white text-xl text-center">Register</h3>
                    <div class="RE"> </div> 

                    <form class="mt-4" method="POST" action="">
                        <input type="hidden" name="_token" value="96LGLQC0ylNCwHDLyTqFuBvSMwOqHi7voLu8lwj4">

                        <label class="block">
                            <span class="text-white text-sm">Full Name </span>
                            <input type="text" id="name" name="username" class="form-input mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white" value="" required autocomplete="username" autofocus>
                        </label>

                        <label class="block">
                            <span class="text-white text-sm">username</span>
                            <input type="text" id="username" name="username" class="form-input mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white" value="" required autocomplete="username" autofocus>
                        </label>
                        
                        
                        <label class="block">
                            <span class="text-white text-sm">E-Mail Address</span>
                            <input type="email" id="email" name="email" class="form-input mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white" value="" required autocomplete="email" autofocus>

                        </label>


                        <label class="block mt-3">
                            <span class="text-white text-sm">Password</span>
                            <input id="password1" type="password"  class="form-input mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white" name="password" required autocomplete="current-password">

                        </label>

                        <label class="block mt-3">
                            <span class="text-white text-sm"> Re-Password</span>
                            <input id="password2" type="password"  class="form-input mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white" name="password" required autocomplete="current-password">

                        </label>


                        <!-- <div class="flex justify-between items-center mt-4">
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-blue-500 bg-gray-800 border-gray-600" name="remember" id="remember" >
                                    <span class="mx-2 text-gray-200 text-sm">Remember Me</span>
                                </label>
                            </div>

                            <div>
                                <a class="block text-sm text-blue-500 hover:underline" href="http://localhost:8000/password/reset">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div> -->

                        <div class="mt-6">
                            <button type="submit" class="w-full py-2 px-4 text-center bg-blue-600 rounded-md text-white text-sm hover:bg-blue-500 focus:outline-none registration">
                            registration
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

  <?php include '../footer.php'; ?>
  <script type="text/javascript">

$(document).ready(function() {


    $('.registration').click(function(e){
      e.preventDefault();

      $.ajax({
          type: "POST",
          url: "ajax/registration.php",
          dataType: "json",
          data: { name:$("#name").val() , username: $("#username").val(), email: $("#email").val(), password1:$("#password1").val() , password2:$("#password2").val(),},


         success : function(data){
              if (data.status == "done"){
                 $(".RE").html(data.msg);
                setTimeout(function(){ window.location.href= 'login.php';}, 2000);

              } else {
              $(".RE").html(data.msg);
              }
          } 
      });


    });
});


</script>
</body>

</html>