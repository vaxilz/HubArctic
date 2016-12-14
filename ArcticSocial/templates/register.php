<div class="container">
    <h1 class="well">Registration Form</h1>
    <?php
    if ($_POST) {
        $reg_errors = array();
        //Pregs
            if (preg_match('/^[A-Z \'.-]{2,45}$/i', $_POST['firstname'])) {
                $firstname = trim($_POST['firstname']);
            } else {
                $reg_errors['firstname'] = 'Please enter your first name!';
            }
            //2. Check for a last name:
            //  rules:  same as first name           
            if (preg_match('/^[A-Z \'.-]{2,45}$/i', $_POST['lastname'])) {
                $lastname = trim($_POST['lastname']);
            } else {
                $reg_errors['lastname'] = 'Please enter your last name!';
            }
            //3. Check for email (valid email address format)
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = trim($_POST['email']);
            } else {
                $reg_errors['email'] = 'Please enter a valid email!';
            }
        //Check to see if password meets requirements
        if (preg_match('/^^[a-zA-Z]\w{4,60}$/',$_POST['password1'])) {
                if ($_POST['password1'] == $_POST['password2']) {
                    $password2 = strip_tags($_POST['password2']);
                } else {
                    $reg_errors['password2'] = 'Your password did not match the confirmed password!';
                }
            } else {
            $reg_errors['password1'] = 'Password must be between 4 and 60 characters long, 
                   and one number.!';
        }
        if (empty($reg_errors)) {
            //Validation OK: Create User 
            var_dump($_POST);
            //exit();
            // reading post params
            if(isset($_POST['submit'])){
            
            $Address = $_POST['address'];
            $Birthdate = $_POST['birthday'];
            $City = $_POST['city'];
            $email = $_POST['email'];
            $password = $_POST['password1'];
            $first_name = $_POST['firstname'];
            $last_name = $_POST['lastname'];
            $Phone_Num = $_POST['phone_num'];
            $Postal_Code = $_POST['postal_code'];
            $Province = $_POST['province'];
            $User_Name = $_POST['User_name'];
            $data = $dbh->createUser($Address, $Birthdate,
                    $City, $email, $password, 
                     $first_name, $last_name, $Phone_Num, $Postal_Code, $Province, $User_Name);
            //var_dump($data);
            
            if ($data['error'] == false) {
                $active = $data['active'];
                //it worked
                echo '<div class="alert alert-success"><strong>Account Registered</strong>';
            }
        } else {
             echo '<div class="alert alert-danger">';
                echo '<ul>';
                foreach($reg_errors as $error){
                    echo "<li>$error</li>";
        }
        echo '</ul></div>';
        }
    }
    }
    ?>
    <div class="col-lg-12 well">
        <div class="row">
            <form class="form-horizontal" role="form" method="post" action="register.php">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Username</label>
                            <input type="text" placeholder="Enter your desired username.." class="form-control"
                                   id="User_name" name="User_name" 
                                   onvalid="this.setCustomValidity('Please enter a user name')"
                                   oninput="setCustomValidity('')" maxlength="60"
                                   value="<?php if (isset($_POST['User_name'])) echo $_POST['User_name']; ?>" required>

                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Password</label>
                            <input type="password" placeholder="Enter your desired password.." class="form-control"
                                   name="password1" id="password1"
                                   onvalid="this.setCustomValidity('Please enter a password')"
                                   oninput="setCustomValidity('')" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Re-Enter Password</label>
                            <input type="password" placeholder="Enter previously typed password" class="form-control"
                                   name="password2" id="password2" 
                                   onvalid="this.setCustomValidity('Please re-enter password')"
                                   oninput="setCustomValidity('')" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>First Name</label>
                            <input type="text" placeholder="Enter First Name Here.." class="form-control"
                                   name="firstname" id="firstname" 
                                   oninvalid ="this.setCustomValidity('Please enter your first name!')"
                                   oninput="setCustomValidity('')"  maxlength="45"
                                   required autofocus value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>">
                        </div>
                    </div>					
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Last Name</label>
                            <input type="text" placeholder="Enter Last Name Here.." class="form-control"
                                   name="lastname" id="lastname" maxlength="45"
                                   oninvalid="this.setCustomValidity('Please enter last name')" 
                                   oninput="setCustomValidity('')" required
                                   value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Address</label>
                            <input type="text" placeholder="Enter Last Address here.." class="form-control"
                                   id="address" name="address" maxlength="100"
                                   onvalid="this.setCustomValidity('Please enter your address')"
                                   oninput="setCustomValidity('')" required
                                   value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>">
                        </div>	
                    </div>
                    <div class=" col-sm-12 form-group">
                        <div class="form-group">
                            <label for="birthDate">Date of Birth</label>
                            <input type="date" id="birthday" name ="birthday" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>City</label>
                            <input type="text" placeholder="Enter City Name Here.." class="form-control"
                                   id='city' name='city' onvalid="this.setCustomValidity('Please enter your City')"                                  
                                   oninput="setCustomValidity('')" required maxlength="50"
                                   value="<?php if (isset($_POST['city'])) echo $_POST['city']; ?>">
                        </div>	
                        <div class="col-sm-4 form-group">
                            <label>Province</label>
                            <select name="province" class="form-control">
                                <option value="AB">Alberta</option>
                                <option value="BC">British Columbia</option>
                                <option value="MB">Manitoba</option>
                                <option value="NB">New Brunswick</option>
                                <option value="NL">Newfoundland and Labrador</option>
                                <option value="NS">Nova Scotia</option>
                                <option value="ON">Ontario</option>
                                <option value="PE">Prince Edward Island</option>
                                <option value="QC">Quebec</option>
                                <option value="SK">Saskatchewan</option>
                                <option value="NT">Northwest Territories</option>
                                <option value="NU">Nunavut</option>
                                <option value="YT">Yukon</option>
                            </select>	
                        </div>	
                        <div class="col-sm-4 form-group">
                            <label>Postal Code</label>
                            <input type="text" placeholder="Enter Postal Code Here.." class="form-control" required maxlength="7"
                                   id="postal_code" name="postal_code" value="<?php if (isset($_POST['postal_code'])) echo $_POST['postal_code']; ?>">
                        </div>		
                    </div>			
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" placeholder="Enter Phone Number Here.." class="form-control"
                               id="phone_num" name="phone_num" required maxlength="15"
                               value="<?php if (isset($_POST['phone_num'])) echo $_POST['phone_num']; ?>">
                    </div>		
                    <div class="form-group">
                        <label for='email'>Email Address</label>
                        <input type="email" placeholder="Enter Email Address Here.." class="form-control"
                               name="email" id="email" required maxlength="80"
                               value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                    </div>	
                    <button type="submit" class="btn btn-lg btn-info">Submit</button>					
                </div>
            </form> 
            <?php var_dump($_POST); ?>
            <?php if (!empty($data['register'])) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <ul>
                        <?php
                        //print_r($data['contact']);
                        $errors = $data['register'];
                        foreach ($errors as $error):
                            echo "<li>$error</li>";
                        endforeach;
                        ?>       
                    </ul>
                </div>  
            <?php } ?>
        </div>
    </div>
</div>