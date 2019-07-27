<template>

    <div>

        <div style="padding-left:10px" class="row justify-content-start">
            <div class="col-md-4">
                <h2>Detalles del docente</h2>
                <a href="../">Docentes</a> / Detalle
            </div>
        </div>

                        <br>


        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li @click="seccion = 1" class="nav-item">
                <a  class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Usuario</a>
            </li>
            <li @click="seccion = 2" class="nav-item">
                <a  class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Materias</a>
            </li>
            <li @click="seccion = 3" class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Proyectos Asignados</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <deta-usuario :id="id" v-if="seccion == 1" ></deta-usuario>
            <materias-docente v-if="seccion == 2"></materias-docente>
        </div>
    </div>
</template>

<script>
export default {

    props : [
        'id'
    ],

    data(){
        return {

            seccion : 1

        }
    },

}
</script>