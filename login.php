<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <?php
    include("menu.php");
    ?>


    <div class="container pt-5">
        <?php
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            include("functions.php");

            $errors = [];


            $isValidEmail = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
            if (!$isValidEmail) {
                $errors[] = 'Az email invalid!<br>';
            } else {
                $lekerdezes = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$_POST["email"]}'");


                if (mysqli_num_rows($lekerdezes) === 0) {
                    $errors[] = 'A felhasználó nem található!';
                } else {
                    $user = mysqli_fetch_array($lekerdezes);
                }
            }


            if (count($errors) > 0) {
                $_SESSION["errors"] = $errors;
                $_SESSION["post"] = $_POST;
            } else {
                $loginressult = password_verify($_POST["password"], $user["password"]);

                if(!$loginressult){
                    $errors[] = 'Hibás jelszó!<br>';
                    $_SESSION['errors'] = $errors;
                    $_SESSION['post'] = $_POST;
                }else{
                    $_SESSION["user"] = $user;
                    $_SESSION["success"] = 'Sikeres belépés!';
                    header("location: profile.php" );
                exit;
                }

                $err = mysqli_error($connection);
                if ($err) {
                    die($err);
                }
                
            }
            if (isset($_SESSION["errors"])) {
                print '<div class="alert alert-danger" role="alert">';
                foreach ($_SESSION["errors"] as $err) {
                    print $err;
                }
                print '</div>';
                unset($_SESSION["errors"]);
            } 
                unset($_SERVER["REQUEST_METHOD"]);
            }

        ?>
        <div class="row">
            <h2 class="col-12 text-center">Belépés</h2>
            <form method="POST" action="" class="row g-3">
                <div class="col-md-12">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="Kérjük adja meg az email címét..." name="email">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword" class="form-label">Jelszó</label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Adja meg a jelszavát..." name="password">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Belépés</button>
                </div>
            </form>

        </div>
    </div>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
<?php unset($_SESSION["post"]) ?>