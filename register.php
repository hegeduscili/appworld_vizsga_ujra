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
            include('functions.php');


            $name_length = strlen($_POST["name"]);
            $errors = [];

            if ($name_length > 40 || $name_length < 3) {
                $errors[] = 'A névnek, minimum 3, maximum 40 karakterből kell állnia!<br>';
            }

            $isValidEmail = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
            if (!$isValidEmail) {
                $errors[] = 'Az email invalid!<br>';
            } else {
                $lekerdezes = mysqli_query($connection, "SELECT id FROM users WHERE email = '{$_POST["email"]}'");


                if (mysqli_num_rows($lekerdezes) > 0) {
                    $errors[] = 'Ez az email már használatban van!';
                }
            }
            $password_length = strlen($_POST["password"]);

            if ($password_length < 4) {
                $errors[] = 'A jelszónak legalább 4 karakterből kell állnia!<br>';
            }
            if ($_POST["password"] !== $_POST["password_confirmation"]) {
                $errors[] = 'A két jelszó nem egyezik!<br>';
            }

            if (count($errors) > 0) {
                $_SESSION["errors"] = $errors;
                $_SESSION["post"] = $_POST;
            } else {
                $hashpass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                mysqli_query($connection, "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('{$_POST["name"]}', '{$_POST["email"]}', '$hashpass')");
            }
            $err = mysqli_error($connection);
            if ($err) {
                die($err);
            }
            $_SESSION["success"] = 'Sikeres regisztráció!';


            header("location:" . $_SERVER["HTTP_REFERER"]);
            exit;
        }

        if (isset($_SESSION["errors"])) {
            print '<div class="alert alert-danger" role="alert">';
            foreach ($_SESSION["errors"] as $err) {
                print $err;
            }
            print '</div>';
            unset($_SESSION["errors"]);
        } elseif (isset($_SESSION["success"])) {
            print '<div class="alert alert-success" role="alert">';
            foreach ($_SESSION["success"] as $succ) {
                print $succ;
                print '</div>';
            }
        }


        ?>
        <div class="row">
            <h2 class="col-12 text-center">Regisztráció</h2>
            <form method="POST" action="" class="row g-3">
                <div class="col-12">
                    <label for="inputName" class="form-label">Név</label>
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Kérjük adja meg a nevét...">
                </div>
                <div class="col-md-12">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Kérjük adja meg az email címét...">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword" class="form-label">Jelszó</label>
                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Adja meg a jelszavát...">
                </div>
                <div class="col-12">
                    <label for="inputPasswordConfirmation" class="form-label">Jelszó ismét</label>
                    <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" placeholder="Adja meg a jelszavát ismét...">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success" name="submitted">Regisztráció</button>
                </div>
            </form>


        </div>
    </div>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
<?php unset($_SESSION["post"]) ?>