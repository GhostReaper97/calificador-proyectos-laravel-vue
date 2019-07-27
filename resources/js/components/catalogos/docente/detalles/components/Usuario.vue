<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Usuario del docente</h5>
                    </div>
                    <div style="text-align: end" class="col-md-6">
                        <button @click="AbrirModalUsuario()" v-if="!existeCuenta" class="btn btn-dark">Crear cuenta</button>
                        <button v-else class="btn btn-dark">Cambiar contraseña</button>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12">
                        <h6>Datos de la cuenta</h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label>Username</label>
                            <input :disabled="!existeCuenta ? true : false" v-model="userameCuenta" type="text" class="form-control" placeholder="Nombre del usuario" >
                        </div>
                        
                        <div class="form-group">
                            <label>Email</label>
                            <input :disabled="!existeCuenta ? true : false" v-model="emailCuenta" type="email" class="form-control" placeholder="Correo del usuario">
                        </div>

                        <div style="text-align : end" class="form-group">
                            <button  :disabled="!existeCuenta ? true : false" class="btn btn-primary">Guardar</button>
                        </div>


                    </div>
                    <div class="col-md-4">

                        Estado : 
                        <span v-if="existeCuenta" class="badge badge-success">Disponible</span>
                        <span v-else class="badge badge-danger">No disponible</span>

                    </div>
                </div>

            </div>

            <modal-template id="modal_usuario" titulo="Crear usuario" >

                <template slot="contenido">

                    <div class="form-group">
                        <label for="">Username</label>
                        <input v-model="username" type="text" class="form-control" placeholder="Ingrese el nombre del usuario" >
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input v-model="password" type="password" class="form-control" placeholder="Ingrese la contraseña" >
                    </div>

                </template>

                <template slot="botones">
                    <button @click="CrearUsuario()" class="btn btn-primary">Crear usuario</button>
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

            existeCuenta : true,

            username : "",
            password : "",
            email : "",

            userameCuenta : "",
            emailCuenta : "",

            id_persona : "",



        }
    },

    methods : {

        ConsultarUsuario(){

            axios.get(
                '../../api/docente/persona/' + this.id
            ).then( (Respuesta) => {

                if(Respuesta.data.persona.id_user == 0)
                    this.existeCuenta = false;
                else {

                    this.VerificarUsuario(Respuesta.data.id_persona);

                }


            });

        },

        VerificarUsuario(id_persona){

            axios.get(
                '../../api/docente/usuario/' + id_persona
            ).then( (Respuesta) => {

                this.userameCuenta = Respuesta.data.user.name;
                this.emailCuenta = Respuesta.data.user.email;

            });

        },

        AbrirModalUsuario(){

            $("#modal_usuario").modal();

        },


        CrearUsuario(){

            let json = {
                username : this.username,
                password : this.password,
                id : this.id
            };

            axios.post(
                '../../api/docente/usuario',
                {"json" : JSON.stringify(json)}
            ).then( (Respuesta) => {
                
                $("#modal_usuario").modal('hide');

                this.userameCuenta = Respuesta.data.user.name;
                this.emailCuenta = Respuesta.data.user.email;

                this.existeCuenta = true;

                

            })

        }

    },

    mounted(){

        this.ConsultarUsuario();


    },

    

}
</script>