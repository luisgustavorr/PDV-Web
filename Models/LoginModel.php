<?php 

    namespace Models;

    class LoginModel
    {
        public static function enviarFormulario(){
//             $senha = "galo1313";

// // Criar o hash da senha
// $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
// $hashDaSenhaNoBanco = $senhaCriptografada;
@session_start();
        

if( \Painel::logado()==false){
    if(isset($_POST['logar'])){

    $user = $_POST['login'];
    $senha = $_POST['senha'];

    $logar = \MySql::conectar()->prepare('SELECT * FROM  `tb_adminstradores` WHERE `user` = ?');
    $logar->execute(array($user));
    $logar = $logar->fetch();
    print_r($logar);
    if(password_verify($senha, $logar['senha'])){
        $_SESSION['login'] = true;
        $_SESSION['user'] = $user;
        $_SESSION['password'] = $senha;
        
        echo"<script>location.href='RelatorioABC'</script>";

    }else{
    $GLOBALS['display'] = 'block';

    }
    }
}else{
    $_SESSION['login'] = true;
    echo"<script>location.href='RelatorioABC'</script>";
}

        }
        }
    

?>