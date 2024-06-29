<?php

require 'config/database.php';

if(isset($_POST['submit'])){
$firtsname = filter_var($_POST['firtsname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$username = filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
$createpassword = filter_var($_POST['createpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$confirmpassword = filter_var($_POST['confirmpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$avatar = $_FILES['avatar'];

if(!$firtsname){
$_SESSION['signup']= 'Por favor insira seu primeiro nome';
}
elseif(!$lastname){
    $_SESSION['signup']= 'Por favor insira seu sobrenome';
    }
    elseif(!$username){
        $_SESSION['signup']= 'Por favor insira seu nome de usuario';
        }
        elseif(!$email){
            $_SESSION['signup']= 'Por favor insira seu email';
            }
            elseif(strlen($createpassword) < 8 || strlen($confirmpassword) < 8){
                $_SESSION['signup']= 'A senha deve ter 8+ caracteres';
                }
                elseif(!$avatar['name']){
                    $_SESSION['signup']= 'Por favor insira uma imagem de perfil';
                    } 
                    else{
                        if($createpassword!==$confirmpassword){
                            $_SESSION['signup'] = 'As senhas precisam ser iguais';
                        }else{
                            $hashed_password = password_hash($createpassword,PASSWORD_DEFAULT);
                           $user_check_query = "SELECT * FROM users WHERE username ='$username' OR email ='$email'";
                           $user_check_result = mysqli_query($connection,$user_check_query);
                           if(mysqli_num_rows($user_check_result)> 0){
                            $_SESSION['signup'] = 'Usuario ou email ja existem';
                           }else{
                            $time = time();
                            $avatar_name = $time . $avatar['name'];
                            $avatar_tmp_name = $avatar['tmp_name'];
                            $avatar_destination_path ='images/'.$avatar_name;

                            $allowed_files = ['png', 'jpg', 'jpeg'];
                            $extention = explode('.', $avatar_name);
                            $extention = end($extention);
                            if(in_array($extention, $allowed_files)){
                                if($avatar['size']< 1000000){
                                    move_uploaded_file($avatar_tmp_name,$avatar_destination_path);
                                }else{
                                    $_SESSION['signup'] ='A imagem deve ter menos de 1mb';
                                }

                            }else{
                                $_SESSION['signup'] = 'A imagem deve ser png, jpeg or jpg';
                            }
                           }
                        }
                    }
if(isset($_SESSION['signup'])){
    $_SESSION['signup-data']=$_POST;
    header('location:'. ROOT_URL . 'signup.php');
    die();
}else{
    $insert_user_query ="INSERT INTO users SET firtsname='$firtsname', lastname='$lastname', username='$username', email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=0";
    $insert_user_result = mysqli_query($connection,$insert_user_query);

    if(!mysqli_errno($connection)){
        $_SESSION['signup-success']= 'Cadastrado com sucesso, por favor realize o login';
        header('location:'. ROOT_URL . 'signin.php');
        die();
    }
}
}else{
    header('location: '. ROOT_URL . 'signup.php');
    die();
}
?>