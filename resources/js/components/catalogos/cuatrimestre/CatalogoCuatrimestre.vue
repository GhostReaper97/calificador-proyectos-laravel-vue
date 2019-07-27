<template>
    <div class="card seccion-catalogo">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h3> Catalogo Cuatrimestre </h3>
                </div>
                <div class="col-md-2">
                    <button @click="AbrirModal()" class="btn btn-dark btn-block">Nuevo</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre del cuatrimestre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr :key="index" v-for="(cuatrimestre,index) of Cuatrimestres">
                                <td> {{ cuatrimestre.nombre }} </td>
                                <td>
                                    <button class="btn btn-outline-dark btn-rounded"><i class="fas fa-pen"></i></button>
                                    <button @click="Eliminar(cuatrimestre.id)" class="btn btn-outline-dark btn-rounded"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <modal-template id="modal_cuatrimestre" size="modal-lg" :titulo=titulo_modal >
            <template slot="contenido">

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input v-model="nombre" type="text" class="form-control" placeholder="Ingrese el nombre del grupo">
                        <small class="error-campo" v-if="errores.nombre">{{ errores.nombre[0] }}</small>
                    </div>
                </div>

            </template>

            <template slot="botones">
                <button v-if="esnuevo" @click="Crear()" class="btn btn-primary">Crear</button>
            </template>

        </modal-template>

    </div>
</template>

<script>
export default {
    data(){
        return{

            Cuatrimestres : [],

            nombre : "",

            esnuevo : true,

            titulo_modal : "Nuevo",

            errores : []

        }
    },

    methods : {

        AbrirModal(){

            $("#modal_cuatrimestre").modal();

        },

        Limpiar(){

            this.nombre = "";

        },

        Listar(){

            axios.get(
                'api/cuatrimestre'
            ).then( (Respuesta) => {

                this.Cuatrimestres = Respuesta.data;

            });

        },

        Crear(){

            let json = {
                nombre : this.nombre
            };

            axios.post(
                'api/cuatrimestre',
                {"json" : JSON.stringify(json)}
            ).then( (Respuesta) => {

                toastr.success('Cuatrimestre creado','Hecho');

                $("#modal_cuatrimestre").modal('hide');

                this.Listar();
                this.Limpiar();

            });

        },

        Eliminar(id){

            let json = {
                id : id
            };

            axios.post(
                'api/cuatrimestre/delete',
                {"json" : JSON.stringify(json)}
            ).then( (Respuesta) =>  {
                
                toastr.success('Cuatrimestre eliminado','Hecho');

                this.Listar();


            })

        }

    },

    created(){

        this.Listar();

    }
}
</script>
