//Listado de componentes

//Templates extras

//MODAL
Vue.component('modal-template', require('./components/templates/ModalTemplate.vue'));

//Catalogo grupo
Vue.component('catalogo-grupo',require('./components/catalogos/grupo/CatalogoGrupo.vue'));

//Catalogo cuatrimestre
Vue.component('catalogo-cuatrimestre', require('./components/catalogos/cuatrimestre/CatalogoCuatrimestre.vue'));

//Catalogo materia
Vue.component('catalogo-materia', require('./components/catalogos/materia/CatalogoMateria.vue'));

Vue.component('catalogo-docente', require('./components/catalogos/docente/CatalogoDocente.vue'));

Vue.component('detalle-docente', require('./components/catalogos/docente/detalles/Detalle.vue'));
Vue.component('deta-usuario', require('./components/catalogos/docente/detalles/components/Usuario.vue'))
Vue.component('materias-docente', require('./components/catalogos/docente/detalles/components/Materias.vue'));