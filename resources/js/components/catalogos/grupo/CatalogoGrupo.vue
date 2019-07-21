<template>
    <div class="card seccion-catalogo">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h3> Catalogo Grupos <i class="fas fa-user-friends"></i> </h3>
                </div>
                <div class="col-md-2">
                    <button @click="AbrirModal()" class="btn btn-dark btn-block">Nuevo <i class="fas fa-plus-circle"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre del Grupo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr :key="index" v-for="(grupo,index) in Grupos">
                                <td> {{ grupo.nombre }} </td>
                                <td>
                                    <button class="btn btn-outline-dark btn-rounded"><i class="fas fa-pen"></i></button>
                                    <button @click="Eliminar(grupo.id)" class="btn btn-outline-dark btn-rounded"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <modal-template id="modal_grupo" size="modal-lg" :titulo=Titulo >

            <template slot="contenido">

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input v-model="Nombre" type="text" class="form-control" placeholder="Ingrese el nombre del grupo">
                        <small class="error-campo" v-if="Errores.nombre">{{ Errores.nombre[0] }}</small>
                    </div>
                </div>

            </template>

            <template slot="botones">
                <button @click="Crear()" class="btn btn-primary">Crear <i class="fas fa-save"></i></button>
            </template>

        </modal-template>

    </div>
</template>

<script>

export default{

    data(){
        return{

            Grupos : [],

            Nombre : "",

            EsNuevo : true,

            Titulo : "Nuevo",

            Errores : []

        }
    },

    methods : {

        AbrirModal(){

            $("#modal_grupo").modal();

        },

        LimpiarModelo(){

            this.Nombre = "";

        },

        Listar(){

            axios.get(
                'api/grupo'
            ).then( (Respuesta) => {

                this.Grupos = Respuesta.data;

            });

        },

        Crear(){

            let json = {
                nombre : this.Nombre
            };

            axios.post(
                'api/grupo',
                {"json" : JSON.stringify(json)}
            ).then( (Respuesta) => {

                toastr.success('Grupo creado','Hecho');

                $("#modal_grupo").modal('hide');

                this.Listar();

            }).catch( (error) => {
               
                if(error.response.status == 500)
                    this.Errores = error.response.data.errors;

            });

        },

        Eliminar(id){

            let json = {
                id : id
            };

            axios.post(
                'api/grupo/delete',
                {"json" : JSON.stringify(json)}
            ).then( (Respuesta) => {

                toastr.success('Grupo eliminado','Hecho');

                this.Listar();


            });

        }

    },

    created(){

        this.Listar();

    },

}


</script>