<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h5>Materias del docente</h5>
                    </div>
                    <div class="col-md-2">
                        <button @click="AbrirModal()" class="btn btn-dark btn-block">Agregar Materia</button>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Materia</th>
                                        <th>Fecha de asignacion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr :key="index" v-for="(materia, index) of listaMateriasDocente">
                                        <td> {{ materia.nombre }} </td>
                                        <td> {{ materia.created_at }} </td>
                                        <td>
                                            <button  class="btn btn-outline-dark btn-rounded" data-toggle="tooltip" data-placement="top" title="Eliminar docente" ><i class="fas fa-trash-alt"  ></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <modal-template id="modal_materia" size="modal-md" titulo="Seleccionar Materia">

                <template slot="contenido">

                    <h4>Listado de materias</h4>
                    <br>

                    <div class="table-responsive-xl">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Materia</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr :key=index v-for="(materia,index) of listaMaterias">
                                    <td> {{ materia.nombre }} </td>
                                    <td>
                                        <button @click="AgregarMateria(materia.id)" class="btn btn-outline-dark" data-toggle="tooltip" data-placement="top" title="Agregar">Agregar <i class="fas fa-plus-square"></i></button> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </template>

                <template slot="botones">

                </template>

            </modal-template>

        </div>
    </div>
</template>

<script>
export default {

    props : [
        'id'
    ],

    data(){
        return{

            listaMateriasDocente : [],

            listaMaterias : [],

            id_materia : ""

        }
    },

    methods : {

        AbrirModal(){

            $("#modal_materia").modal();

        },

        ListarMateriasDocente(){

            axios.get(
                '../../api/docente/materias/con/' + this.id
            ).then( (Respuesta) => {

                this.listaMateriasDocente = Respuesta.data;

                console.log()

            });

        },

        ListarMaterias(){

            axios.get(
                '../../api/docente/materias/sin/' + this.id
            ).then( (Respuesta) => {

                this.listaMaterias = Respuesta.data;

            });

        },

        AgregarMateria(id_materia){

            let json = {
                id_materia : id_materia,
                id_docente : this.id
            };

            axios.post(
                '../../api/docente/materia',
                {"json" : JSON.stringify(json)}
            ).then( (Respuesta) => {

                toastr.success('La materia ha sido agregada al docente','Listo!');

                this.ListarMateriasDocente();
                this.ListarMaterias();

            });

        }


    },

    created(){

        this.ListarMaterias();
        this.ListarMateriasDocente();

    }

}
</script>