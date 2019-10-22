<?
include 'session.php';

$action = isset($_POST['action']) ? $_POST['action'] : null;

$return = [];

$reqErr = 'Houve um erro ao enviar a requisição. Por favor, recarregue a página e tente novamente.';


if ($action == 'login') { // REQUISIÇÃO PARA FAZER LOGIN
     $table = 'users';
     $email = isset($_POST['email']) ? $_POST['email'] : null;
     $pass = isset($_POST['password']) ? $_POST['password'] : null;

     $userBD = CRUD::SELECT('', $table, 'email=:email', array('email' => $email), '');

     if (count($userBD) > 0) {
          if ($userBD[0]['attempts'] > 0) {
               if (md5($pass) == $userBD[0]['password']) {
                    $_SESSION['user'] = $userBD[0];
                    CRUD::UPDATE($table, array('attempts' => 5), $userBD[0]['id']);
                    $return['code'] = 0;
               } else {
                    $return['code'] = 1;
                    $return['msg'] = 'Senha incorreta.';
                    $return['attempts'] = $userBD[0]['attempts'];
                    CRUD::UPDATE($table, array('attempts' => $userBD[0]['attempts'] - 1), $userBD[0]['id']);
               }
          } else {
               $return['code'] = 3;
               $return['msg'] = 'Usuário bloqueado por excesso de tentativas de login. Por favor, entre em contato com o administrador do sistema.';
          }
     } else {
          $return['code'] = 2;
          $return['msg'] = 'Endereço de e-mail não encontrado.';
     }
     
} else if ($action == 'logout') { // REQUISIÇÃO PARA FAZER LOGOUT
     if(session_unset()){
          $return['code'] = 0;
     } else {
          $return['code'] = 100;
          $return['msg'] = $reqErr;
     }
} else if ($action == 'force-att') {
     $_SESSION['checked'] = false;
     $return['code'] = 0;
}




else {
     $return['code'] = 100;
     $return['msg'] = $reqErr;
}

echo json_encode($return);
