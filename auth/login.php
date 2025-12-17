<?php
require_once "../config.php";

if(isset($_POST['submits'])) { 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $role = $_POST['role'];

    if($password !== $cpassword){
        die('Les mots de passe sont différents !');
    }

    $hashpassword = password_hash($password, PASSWORD_DEFAULT);

    if($role !== 'admin' && $role !== 'agent'){
        die('Rôle invalide !');
    }

    $query = "SELECT * FROM utilisateur WHERE username='$name' OR email='$email'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        die('Le nom de utilisateur ou le email existe déjà. Veuillez en choisir un autre.');
    }

    $insert = "INSERT INTO utilisateur (username, email, password, role) 
               VALUES ('$name', '$email', '$hashpassword', '$role')";

    if(mysqli_query($conn, $insert)){
        echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
    } else {
        echo "Erreur lors de l'inscription:" . mysqli_error($conn);
    }
}
if(isset($_POST['submit'])){
    $names = $_POST['names'];
    $passwords = $_POST['passwords'];

    $query = "SELECT * FROM utilisateur WHERE username='$names'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result)===0){
        echo "ce compte n'existe pas";
    }
    else{
        $user=mysqli_fetch_assoc($result);
        if(password_verify($passwords,$user['password'])){
            session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['user_id'] = $user['id'];
            header("Location: ../dashboard/dashboard.php");
            exit();
        }else{
            echo "mot passe ou name inccorrect";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bankly V2</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { 
            margin:0;
            padding:0;
            box-sizing:border-box; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            text-decoration: none;
            list-style: none;
        }
        body { 
            display: flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
            background:linear-gradient(90deg , #e2e2e2 , #c9d6ff);
        }
        .container{
            position: relative;
            width: 850px;
            height: 650px;
            background: #fff;
            margin: 20px;
            border-radius: 30px;
            box-shadow: 0,0,30px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .container h1{
            font-size: 36px;
            margin: -10px 0;
        }
        .container p{
            font-size: 14px;
            margin: 15px 0;
        }
        form{
            width: 100%;
        }
        .form-box{
            position: absolute;
            right: 0;
            width: 50%;
            height: 100%;
            background-color: #fff;
            display: flex;
            align-items: center;
            text-align: center;
            color: #333;
            padding: 40px;
            z-index: 1;
            transition: 0.6s ease-in-out 1.2s, visibility 0s 1s;
        }
        .container.active .form-box{
            right: 50px;
        }
        .form-box.register{
            visibility: hidden;
            left: 0;
        }
        .container.active .form-box.register{
            visibility: visible;
        }
        .input-box{
            position: relative;
            margin: 30px 0;
        }
        .input-box input{
            width: 100%;
            padding: 13px 50px 13px 20px;
            background-color: #eee;
            border-radius: 8px;
            border: none;
            outline: none;
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }
        .input-box input::placeholder{
            color: #888;
            font-weight: 400;
        }
        .input-box i{
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
        }
        .input-box select{
            width: 100%;
            padding: 13px 50px 13px 20px;
            background-color: #eee;
            border-radius: 8px;
            border: none;
            outline: none;
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }
        .forgot-link{
            margin: -15px 0 15px;
        }
        .forgot-link a{
            font-size: 14px;
            color: #333;
        }
        .btn{
            width: 100%;
            height: 48px;
            background-color: #7494ec;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: 600;
        }
        .social-icons{
            display: flex;
            justify-content: center;

        }
        .social-icons a{
            display: inline-flex;
            padding: 10px;
            
            font-size: 24px;
            color: #333;
            margin: 0 8px;
        }
        .toggle-box{
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .toggle-box::before{
            content: '';
            position: absolute;
            left: -250%;
            width: 300%;
            height: 100%;
            background-color: #7494ec;
            border-radius: 150px;
            z-index: 2;
            transition: 1.8s ease-in-out;
        }
        .container.active .toggle-box::before{
            left: 50%;
        }
        .toggle{
            position: absolute;
            width: 50%;
            height: 100%;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 2;
            transition: 0.6s ease-in-out;
        }
        .toggle.toggle-left{
            left:0;
            transition-delay:1.2s;
        }
        .container.active .toggle.toggle-left{
            left: -50%;
            transition-delay: 0.6s;
        }
        .toggle.toggle-right{
            right: -50%;
            transition-delay: 0.6s;
        }
        .container.active .toggle.toggle-right{
            right: 0;
            transition-delay: 1.2s;
        }
        .toggle p{
            margin-bottom: 20px;
        }
        .toggle .btn{
            width: 160px;
            height: 46px;
            background: transparent;
            border:2px solid #fff ;
            box-shadow: none;
        }
        @media(max-width=465px){
        
             
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-box login">
            <form method="post">
                <h1>login</h1>
                <div class="input-box">
                    <input type="text" placeholder="Username" name="names" required>
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="password" name="passwords" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="forgot-link">
                    <a href="#">forget password</a>
                </div>
                <button type="submit" class="btn" name="submit">login</button>
                <p>or login with social platform</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>

                </div>
            </form>
        </div>
        <div class="form-box register">
            <form method="post">
                <h1>registration</h1>
                <div class="input-box">
                    <input type="text" placeholder="Username" name="name" required>
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="input-box">
                    <input type="email" placeholder="Email" name="email" required>
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="password" name="password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="confirm password" name="cpassword" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="input-box">
                    <select name="role" required>
                        <option value="">-- Choisir le rôle --</option>
                        <option value="admin">Admin</option>
                        <option value="agent">Agent</option>
                    </select>
                </div>
                <button type="submit" class="btn" name="submits">register</button>
                <p>or register with social platform</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle toggle-left">
                <h1>hello,welcome</h1>
                <p>don't have any account?</p>
                <button class="btn register-btn">register</button>
            </div>
            <div class="toggle toggle-right">
                <h1>welcome back</h1>
                <p>already have an account</p>
                <button class="btn login-btn">login</button>
            </div>
        </div>

    </div>

<script>
    const container = document.querySelector('.container');
    const btn_register = document.querySelector('.register-btn');
    const btn_login = document.querySelector('.login-btn');

    btn_register.addEventListener('click',()=>{
        container.classList.add('active');
    })
    btn_login.addEventListener('click',()=>{
        container.classList.remove('active');
    })
</script>
</body>
</html>
