<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Karatekapp</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto right">
      <li class="nav-item"><div class="nav-link" onclick="nav('combate', this)"><i class="fas fa-fist-raised"></i> Nuevo Combate</div></li>
      <li class="nav-item"><div class="nav-link" onclick="nav('historial', this)"><i class="fas fa-database"></i> Combates grabados</div></li>
      <li class="nav-item"><div class="nav-link" onclick="nav('karatecas', this)"><i class="fas fa-user-ninja"></i> Karatecas</div></li>
      <li class="nav-item"><div class="nav-link" onclick="nav('torneos', this)"><i class="fas fa-people-group"></i> Torneos</div></li>
      <li class="nav-item"><div class="nav-link" onclick="nav('perfil', this)"><i class="fas fa-user"></i> Perfil</div></li>
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