<?php

require './vendor/autoload.php';

$domain = json_decode(file_get_contents('./config.json'), true)['domain'];
$giae = new \juoum\GiaeConnect\GiaeConnect($domain);

if(!isset($_GET['callback']) or !isset($_GET['app_name']) or !isset($_GET['tos_pp'])){
    echo "400 - Bad Request";
    http_response_code(400);
    die();
}

$app_name = $_GET['app_name'];
$tos_pp = $_GET['tos_pp'];
$callback = $_GET['callback'];

if(isset($_POST['user']) and isset($_POST['password'])){
    $postedUser = $_POST['user'];
    $postedPass = $_POST['password'];
    if(!empty($giae->session = $giae->getSession($postedUser, $postedPass))){
        $callbackUrl = $callback . "?sessioncookie=" . $giae->session;
        header("Location: $callbackUrl");
        die();
    } elseif(empty($giae->getSession($postedUser, $postedPass))){
        echo "<div class='alert alert-danger m-4' role='alert'>
        Credenciais erradas. Tenta novamente.
      </div>";
    }
}

?>


<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIAE Auth | <?php echo $app_name?></title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/logins/login-7/assets/css/login-7.css">
</head>
<body>

    <!-- Login 7 - Bootstrap Brain Component -->
    <section class="p-3 p-md-4 p-xl-5">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
            <div class="card border border-light-subtle rounded-4">
            <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="row">
                <div class="col-12">
                    <div class="mb-5">
                    <h4 class="text-center">A aplicação "<?php echo $app_name?>" está a pedir acesso à tua conta GIAE</h4>
                    <h6 class="text-center">A efetuar login em <strong><?php echo $domain?></strong></h6>
                    </div>
                </div>
                </div>
                <form method="POST">
                <div class="row gy-3 overflow-hidden">
                    <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="user" id="user" placeholder="a0000" required>
                        <label for="email" class="form-label">Utilizador / Nº Cartão</label>
                    </div>
                    </div>
                    <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                        <label for="password" class="form-label">Palavra-passe</label>
                    </div>
                    </div>
                    <div class="col-12">
                    </div>
                    <div class="col-12">
                    <div class="d-grid">
                        <button class="btn bsb-btn-xl btn-primary" type="submit">Permitir</button>
                    </div>
                    </div>
                </div>
                </form>
                <div class="row">
                <div class="col-12">
                    <hr class="mt-5 mb-4 border-secondary-subtle">
                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                    <a href="<?php echo $tos_pp?>" class="link-secondary text-decoration-none">Termos e Política de Privacidade</a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>


    <!-- You're free to remove this if you wish, however, keeping it helps spreading the word about the project. Thank you! -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="text-center my-auto">
                <span>Com tecnologia de <a href="https://github.com/itsjuoum/GIAEConnect" target="_blank">GIAEConnect</a> </span> 
            </div>
        </div>
    </footer>
    
</body>
</html>