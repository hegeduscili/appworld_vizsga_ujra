<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">napihírek.hu</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Kezdőlap</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Mai hírek</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Legtöbbször kattintott</a>
        </li>
        <?php
        if(!isset($_SESSION["user"])){
          print ' <li class="nav-item">
          <a class="nav-link" href="addcikk.php">Új cikk hozzáadása</a>
        </li>

          <li class="nav-item">
          <a class="nav-link" href="register.php">Regisztráció</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Bejelentkezés</a>
        </li>';
        }
        if(isset($_SESSION["user"])){
        print ' <li class="nav-item">
        <a class="nav-link" href="logout.php">Kijelentkezés</a>
      </li>';
        }
        ?>   
      

      </ul>
    </div>
  </div>
</nav>