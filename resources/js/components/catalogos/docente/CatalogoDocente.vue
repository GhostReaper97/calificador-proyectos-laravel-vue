<template>
    <div class="card seccion-catalogo">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h3> Catalogo Docentes </h3>
                </div>
                <div class="col-md-2">
                    <button @click="AbrirModal()" class="btn btn-dark btn-block">Nuevo <i class="fas fa-plus-circle"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive-md">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Matricula</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Acciones</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr :key="index" v-for="(docente,index) of Docentes" >
                                    <td> {{ docente.docente.matricula }} </td>
                                    <td> {{ docente.nombre }} </td>
                                    <td> {{ docente.apellido }} </td>
                                    <td> {{ docente.email }} </td>
                                    <td>
                                        <button  @click="Buscar(docente.id)" class="btn btn-outline-dark btn-rounded" data-toggle="tooltip" data-placement="top" title="Editar docente" ><i class="fas fa-pen"></i></button>
                                        <button @click="Eliminar(docente.id)" class="btn btn-outline-dark btn-rounded" data-toggle="tooltip" data-placement="top" title="Eliminar docente" ><i class="fas fa-trash-alt"  ></i></button>
                                    </td>
                                    <td >
                                        <a class="btn btn-outline-dark btn-rounded" data-toggle="tooltip" data-placement="top" title="Ver detalles" :href='"docente/detalle/" + docente.docente.id'> <i class="fas fa-address-card"></i>  </a>
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <modal-template id="modal_docente" size="modal-lg" :titulo=titulo_dinamico>

            <template slot="contenido">

                <div v-if="!es_nuevo" class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Matricula</label>
                    <div class="col-sm-10">
                        <input disabled v-model="matricula" type="text" class="form-control" placeholder="Ingrese el nombre del docente">
                    </div>
                </div>
            
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input v-model="nombre" type="text" class="form-control" placeholder="Ingrese el nombre del docente">
                        <small class="error-campo" v-if="errores.nombre">{{ errores.nombre[0] }}</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Apellido</label>
                    <div class="col-sm-10">
                        <input v-model="apellido" type="text" class="form-control" placeholder="Ingrese el apellido del docente">
                        <small class="error-campo" v-if="errores.apellido">{{ errores.apellido[0] }}</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Edad</label>
                    <div class="col-sm-10">
                        <input v-model="edad" type="text" class="form-control" placeholder="Ingrese la edad del docente">
                        <small class="error-campo" v-if="errores.edad">{{ errores.edad[0] }}</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Correo</label>
                    <div class="col-sm-10">
                        <input v-model="email" type="text" class="form-control" placeholder="Ingrese el correo del docente">
                        <small class="error-campo" v-if="errores.email">{{ errores.email[0] }}</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Estado</label>
                    <div class="col-sm-10">
                        <input v-model="Estado" type="text" class="form-control" placeholder="Ingrese el estado del docente">
                        <small class="error-campo" v-if="errores.Estado">{{ errores.Estado[0] }}</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Municipio</label>
                    <div class="col-sm-10">
                    <input v-model="municipio" type="text" class="form-control" placeholder="Ingrese el municipio del docente">
                        <small class="error-campo" v-if="errores.municipio">{{ errores.municipio[0] }}</small>
                    </div>
                </div>
                
            </template>

            <template slot="botones">
                <button v-if="es_nuevo" @click="Crear()" class="btn btn-primary">Crear <i class="fas fa-save"></i></button>
                <button v-else class="btn btn-primary">Guardar cambios<i class="fas fa-save"></i></button>
            </template>

        </modal-template>

    </div>
</template>

<script>
export default {
    
    data(){
        return {

            Docentes : [],

            id : "",
            nombre : "",
            apellido : "",
            edad : "",
            email : "",
            Estado : "",
            municipio : "",
            matricula : "",

            errores : [],

            titulo_modal : "Nuevo",

            es_nuevo : true

        }
    },

    methods : {

        AbrirModal(){

            if(!this.es_nuevo){

                this.LimpiarModelo();
                
                this.errores = []
                this.es_nuevo = true;

            }

            $("#modal_docente").modal();

        },

        LimpiarModelo(){

            this.id = "";
            this.nombre = "";
            this.apellido = "";
            this.edad = "";
            this.email = "";
            this.Estado = "";
            this.municipio = "";
            this.matricula = "";

        },

        Listar(){

            axios.get(
                'api/docente'
            ).then( (Respuesta) => {

                this.Docentes = Respuesta.data;

            });

        },

        Buscar(id){

            axios.get(
                'api/docente/' + id
            ).then( (Respuesta) => {

                this.es_nuevo = false;

                this.nombre = Respuesta.data.nombre;
                this.apellido = Respuesta.data.apellido;
                this.email = Respuesta.data.email;
                this.edad = Respuesta.data.edad;
                this.Estado = Respuesta.data.Estado;
                this.municipio = Respuesta.data.municipio;
                this.matricula = Respuesta.data.docente.matricula;
                this.id = Respuesta.data.id;

                $("#modal_docente").modal();

            });

        },

        Eliminar(id){

        },

        Crear(){

            let json = {
                nombre : this.nombre,
                apellido : this.apellido,
                edad : this.edad,
                email : this.email,
                Estado : this.Estado,
                municipio : this.municipio,
                matricula : this.matricula
            };

            axios.post(
                'api/docente',
                {"json" : JSON.stringify(json)}
            ).then( (Respuesta) => {

                this.LimpiarModelo();
                this.Listar();

                $("#modal_docente").modal('hide');

                toastr.success('Docente creado','hecho');

            });

        },



    },

    created(){

        this.Listar();

    },

    computed : {

        titulo_dinamico : function(){

            if(this.es_nuevo)
                return this.titulo_modal = "Nuevo";
            else
                return this.titulo_modal = "Docente " + this.nombre + " " + this.apellido;

        }

    }

}
</script>
