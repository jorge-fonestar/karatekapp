<h1>Torneos</h1>
<div class="btn btn-light right" @click='NewTorneo'> <span class="glyphicon glyphicon-plus"></span> Nuevo Torneo </div><br><br>
<div class="card mb-3 bg-dark text-white clickable" v-for="torneo in torneos" :key="torneo.id" @click="loadTorneo(torneo.ID)">
    <div class="card-header">
        <span style="font-size: 16px;">{{ torneo.NOMBRE }}</span>
    </div>
</div>