<template>
    <div class="card seccion-catalogo">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h3> Catalogo Materias  </h3>
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
                                <th>Nmobre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr :key="index" v-for="(materia,index) of Materias">
                                <td> {{ materia.nombre }} </td>
                                <td>
                                    <button @click="Buscar(materia.id)" class="btn btn-outline-dark btn-rounded"><i class="fas fa-pen"></i></button>
                                    <button @click="Eliminar(materia.id)" class="btn btn-outline-dark btn-rounded"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <modal-template id="modal_materia" size="modal-lg" :titulo=titulo_dinamico>

            <template slot="contenido">

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input v-model="nombre" type="text" class="form-control" placeholder="Ingrese el nombre de la materia">
                        <small class="error-campo" v-if="errores.nombre">{{ errores.nombre[0] }}</small>
                    </div>
                </div>

            </template>

            <template slot="botones">
                <button v-if="es_nuevo" @click="Crear()" class="btn btn-primary">Crear <i class="fas fa-save"></i></button>
                <button v-else @click="Actualizar()" class="btn btn-primary"> Guardar cambios <i class="fas fa-save"></i></button>
            </template>

        </modal-template>

    </div>
</template>

<script>
export default {

    data(){
        return{

            Materias : [],

            id : "",
            nombre : "",

            es_nuevo : true,

            errores : [],

            titulo_modal : ""

        }
    
    },

    methods: {

        AbrirModal(){

            if(!this.es_nuevo){

                this.LimpiarModelo();

                this.es_nuevo = true;
                this.errores = [];

            }

            $("#modal_materia").modal();

        },

        LimpiarModelo(){

            this.nombre = "";
            this.id = "";

        },

        Listar(){

            axios.get(
                'api/materia'
            ).then( (Respuesta) => {

                this.Materias = Respuesta.data;

            });

        },

        Crear(){

            let json = {
                nombre : this.nombre
            };

            axios.post(
                'api/materia',
                {"json": JSON.stringify(json)}
            ).then( (Respuesta) => {

                this.LimpiarModelo();
                this.Listar();

                $("#modal_materia").modal('hide');

                toastr.success('Materia creada','Hecho');

            }).catch( (error) => {
               
                if(error.response.status == 500)
                    this.errores = error.response.data.errors;

            });

        },

        Actualizar(){

            let json = {
                nombre : this.nombre,
                id : this.id
            };

            axios.post(
                'api/materia/update',
                {"json" : JSON.stringify(json)}
            ).then( (Respuesta) => {

                $("#modal_materia").modal('hide');

                this.es_nuevo = true;

                this.Listar();
                this.LimpiarModelo();

                toastr.success('Materia Actualizada','Hecho');

            }).catch( (error) => {
               
                if(error.response.status == 500)
                    this.errores = error.response.data.errors;

            });

        },

        Buscar(id){

            axios.get(
                'api/materia/' + id
            ).then( (Respuesta) => {

                this.nombre = Respuesta.data.nombre;
                this.id = Respuesta.data.id;

                this.es_nuevo = false;

                $("#modal_materia").modal();

            });

        },

        Eliminar(id){

            let json = {
                id : id
            };

            axios.post(
                'api/materia/delete',
                {"json" : JSON.stringify(json)}
            ).then( (Respuesta) => {

                toastr.success('Materia eliminada','Hecho');

                this.Listar();

            });

        }

    },

    created(){

        this.Listar();

    },

    computed : {

        titulo_dinamico : function(){

            if(this.es_nuevo)
                return "Nuevo"
            else
                return "Materia " + this.nombre;

        }

    }


}
</script>
