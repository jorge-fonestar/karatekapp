<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Karatekapp</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto right">
      <li class="nav-item"><a class="nav-link" href="combate"><i class="fas fa-fist-raised"></i> Nuevo Combate</a></li>
      <li class="nav-item"><a class="nav-link" href="historial"><i class="fas fa-database"></i> Combates grabados</a></li>
      <li class="nav-item"><a class="nav-link" href="karatecas"><i class="fas fa-user-ninja"></i> Karatecas</a></li>
      <li class="nav-item"><a class="nav-link" href="torneos"><i class="fas fa-people-group"></i> Torneos</a></li>
      <li class="nav-item"><a class="nav-link" href="perfil"><i class="fas fa-user"></i> Perfil</a></li>
    </ul>
  </div>
</nav>


<div class="fixed-bottom-menu">
  <div class="nav-link" onclick="nav('karatecas', this)"><i class="fas fa-user-ninja"></i></div>
  <div class="nav-link nav-selected" onclick="nav('historial', this)"><i class="fas fa-database"></i></div>
  <div class="nav-link" onclick="nav('combate', this)"><i class="fas fa-fist-raised"></i></div>
  <div class="nav-link" onclick="nav('torneos', this)"><i class="fas fa-people-group"></i></div>
  <div class="nav-link" onclick="nav('perfil', this)"><i class="fas fa-user"></i></div>
</div>