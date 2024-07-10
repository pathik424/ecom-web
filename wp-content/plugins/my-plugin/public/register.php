<?php

if (!defined('ABSPATH')) {
    header("Location: /customeplgin");
    die("can't Access");
}


if (isset($_POST['register'])) {
    global $wpdb;
    $fname = $wpdb->escape($_POST['user_fname']);
    $lname = $wpdb->escape($_POST['user_lname']);
    $username = $wpdb->escape($_POST['username']);
    $email = $wpdb->escape($_POST['user_email']);
    $pass = $wpdb->escape($_POST['user_pass']);
    $con_pass = $wpdb->escape($_POST['user_con_pass']);

    if ($pass == $con_pass) {

        $user_data = array(

            'user_login' => $username,
            'user_email' => $email,
            'first_name' => $fname,
            'last_name' => $lname,
            'display_name' => $fname . ' ' . $lname,
            'user_pass' => $pass,

        );

        $result = wp_insert_user($user_data);

        if (!is_wp_error($result)) {
            echo 'User Created ID:' . $result;
            add_user_meta($result, 'type', 'faculty');
            update_user_meta($result, 'show_admin_bar_front', false);
        } else {
            echo $result->get_error_message();
        }
    }
} else {
    echo "password Must Match";
}
?>
<div class="wrapper">
    <div class="login-form">
        <h1 class="form-title">Login Now</h1>
        <img src="https://res.cloudinary.com/debbsefe/image/upload/f_auto,c_fill,dpr_auto,e_grayscale/image_fz7n7w.webp" alt="header-image" class="cld-responsive">
        <form action="<?php echo get_the_permalink(); ?>" method="post">
            <input type="text" placeholder="username" name="username" id="login-username">
            <input type="password" placeholder="password" type="password" name="pass" id="login-pass">
            <input type="submit" class="button" name="user_login" value="login">
        </form>
    </div>
</div>


<div class="container">
    <div class="content">
        <img src="https://res.cloudinary.com/debbsefe/image/upload/f_auto,c_fill,dpr_auto,e_grayscale/image_fz7n7w.webp" alt="header-image" class="cld-responsive">
        <h1 class="form-title">Register Here</h1>
        <form method="post" action="<?php echo get_the_permalink(); ?>">
            <input type="text" placeholder="First name" name="user_fname" id="user_fname">
            <input type="text" placeholder="Last name" name="user_lname" id="user_lname">
            <input type="text" placeholder="email" name="user_email" id="user_email">
            <input type="text" placeholder="username" name="username" id="username">
            <input type="password" placeholder="password" type="password" name="user_pass" id="user_pass">
            <input type="password" placeholder="Confirm password" type="password" name="user_con_pass" id="user_con_pass">
            <input type="submit" class="button" name="register" value="Register">
        </form>
    </div>
</div>


<style>
    /*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}*/
    html,
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #008cba;
        height: 100%;
    }

    .container {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .wrapper {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-form {
        background-color: white;
        width: 500px;
        height: 400px;
    }

    .content {
        background-color: white;
        width: 500px;
        height: 700px;
    }

    img {
        width: 100%;
        height: 25%;
    }

    .form-title {
        padding: 10px 40px 0px;
    }

    form {
        padding: 0px 40px;
    }

    input[type=text],
    [type=email] {
        border: none;
        border-bottom: 1px solid black;
        outline: none;
        width: 100%;
        margin: 8px 0;
        padding: 10px 0;
    }

    input[type=number] {
        border: none;
        border-bottom: 1px solid black;
        outline: none;
        margin: 8px 0;
        padding: 5px 0;
    }

    input :hover {
        background-color: red;
    }

    select {
        border: none;
        border-bottom: 1px solid black;
        outline: none;
        margin: 8px 0;
        padding: 5px 0;
        width: 50%;
    }

    .beside {
        display: flex;
        justify-content: space-between;
    }

    button {
        color: #ffffff;
        background-color: #4caf50;
        height: 40px;
        width: 25%;
        margin-top: 15px;
        cursor: pointer;
        border: none;
        border-radius: 2%;
        outline: none;
        text-align: center;
        font-size: 16px;
        text-decoration: none;
        -webkit-transition-duration: 0.4s;
        transition-duration: 0.4s;
    }

    button:hover {
        background-color: #333333;
    }

    input#user_pass,
    input#user_con_pass {
        border: none;
        border-bottom: 1px solid black;
        outline: none;
        width: 100%;
        margin: 8px 0;
        padding: 10px 0;
    }

    input#login-pass {
        border: none;
        border-bottom: 1px solid black;
        outline: none;
        width: 100%;
        margin: 8px 0;
        padding: 10px 0;
    }
    .page-content {
    display: flex;
    gap: 50px;
    align-items: start;
}
</style>