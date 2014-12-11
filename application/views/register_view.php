<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welcome</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style>
            html, body {height: 100%;}
            *{margin: 0px;padding: 0;}
            .container{
                width: 1000px;
                margin-left: auto;
                margin-right: auto;
                clear: both;
            }
            #header{
                height: 40px;
                background: #658CBF;
            }
            #content{
                padding: 10px;min-height:80%;
            } 
            .logo{padding: 3px 0px;font-size: 25px;color: #ffffff;}
            a{text-decoration: none;}
            input{
                padding:3px;
                color:#333333;
                border:1px solid #96A6C5;
                margin-top:2px;
                width:180px;
                font-size:11px;
            }
            input[type='radio']{
                width:30px;
            }
            #register_form input[type='submit']
            {
                margin-left: 57px;
                margin-top: 10px;
                width: 50px;
            }
            #register_form{
                width: 400px;
                float: left;
            }
            #register_form label{
                font-weight: bold;
                float: left;
                width: 108px; 
            }
            #login_form
            {   float: right;
                position: relative;
                margin-top: 8px !important;
            }
            .error{
                float:left;
                /*border: 1px solid #FF607D;*/
                padding: 10px;
            }
            .error p{
                color:#FF607D;
            }
        </style>
    </head>

    <body>
        <div id="header" >
            <div class="container">
                <a class="logo" style="float: left;" href="#">Ciapp</a>
                <div id="login_form">  
                    <form action="http://localhost/ciapp/index.php/user/login" method="post">
                        <label for="email">Email</label>
                        <input type="text" name="l_email" />
                        <label for="password">Password</label>
                        <input type="password" name="l_pass"/>
                        <input type="submit" value="Sign in" name="signin"/>
                    </form>
                </div>
            </div>
        </div>
        <div id="content" class="container">
            <div id="register_form">
                <h1>Sign Up</h1>
                <form action="http://localhost/ciapp/index.php/user/do_register" method="post" enctype="multipart/form-data">
                    <label for="username">User Name</label>
                    <input type="text" name="username" value="<?php echo set_value('username') ?>"/>
                    <label for="email">Email</label>
                    <input type="text" name="email" value="<?php echo set_value('email') ?>" />
                    <label for="password">Password</label>
                    <input type="password" name="password"/>
                    <div>
                        <label for="gender">Gender</label>
                        <input type="radio" name="gender" value="male" <?php echo set_radio('gender', 'male'); ?>/>Male
                        <input type="radio" name="gender" value="female" <?php echo set_radio('gender', 'female'); ?>/>Female
                    </div>
                    <div>
                        <label for="password">Upload your Photo</label>
                        <input type="file" name="photo"/>
                    </div>
                    <input type="submit" value="Sign up" name="register"/>
                </form>
            </div>
            <br />
            <div class="error">
                <?php echo validation_errors(); ?>
            </div>
            <div class="all_users" style="float:right;">
                <a href="<?php echo site_url('user/display_all') ?>" style="font-size: 18px; font-weight: bold;">All users</a>
                <br/>
                <a href="<?php echo site_url('Upload') ?>" style="font-size: 18px; font-weight: bold;">upload image</a>


            </div>


        </div>


        <div id="footer" class="container">
            <hr />
        </div>
    </body>
</html>