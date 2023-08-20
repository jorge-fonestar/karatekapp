<h1>Karatecas</h1>
<div class="btn btn-light" onclick='NewKarateca()'> <span class="glyphicon glyphicon-plus"></span> Nuevo Karateca </div><br><br>
<div class="card mb-3 bg-dark text-white" v-for="karateca in karatecas" :key="karateca.id" @click="loadKarateca(karateca.ID)">
    <div class="card-header">
        <span style="font-size: 16px;">{{ karateca.NOMBRE }}</span>
    </div>
</div>