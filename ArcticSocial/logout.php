<?php
    include 'includes/header.php';//header
 // Destroy the SESSION object     
    $_SESSION = array(); //destroy session variables (new empty array)
    session_destroy();   //destroy the session itself
    setcookie(session_name(),'', time()-300); //destroy session cookie
?>
    <div class="page-header">
        <div class="container">
            <h2>Logged Out</h2>
            <div class="alert alert-success">
                <p>Thank you for visiting, You are now logged out.  <br>
                   </p>
                   <?php
                                        
                     echo"<br>";
                     echo'<p> You will be automatically redirected to the home page in <span id="count">5</span> seconds...</p>';
                        echo "<script>
                        var delay = 5 ;
                        var url = 'logins.php';
                        function countdown() {
                                setTimeout(countdown, 1000) ;
                                $('#count').html(delay);
                                delay --;
                                if (delay < 0 ) {
                                        window.location = url ;
                                        delay = 0 ;
                                }
                        }
                        countdown() ;   
                      </script>";
                        // finish page: hide form
                        echo  '</div>
                            </div>';
                           include 'includes/footer.php';
                            exit();
                            ?>
            </div>
        </div>
    </div>
<?php

