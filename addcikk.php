<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Új cikk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?php 
        include("menu.php");
    ?>
    <div class="container pt-5">

        <div class="mb-3">
            <label for="cikkcime" class="form-label">Cikk címe</label>
            <input type="text" class="form-control" id="cikkcime" placeholder="A cikk címe...">
        </div>
        <div class="mb-3">
            <label for="rovidism" class="form-label">Cikk rövid ismertetője</label>
            <input type="text" class="form-control" id="rovidism" placeholder="Rövid ismertető...">
        </div>
        <div class="mb-3">
            <label for="szerzo" class="form-label">Cikk szerzője</label>
            <input type="text" class="form-control" id="szerzo" placeholder="A szerző neve...">
        </div>
        <div class="mb-3">
            <label for="tartalom" class="form-label">Tartalom</label>
            <textarea class="form-control" id="tartalom" rows="10" placeholder="A cikk tartalma..."></textarea>
        </div>
        <button class="btn btn-success mt-3">Feltöltés</button>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>