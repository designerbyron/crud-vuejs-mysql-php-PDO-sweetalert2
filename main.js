//Guardamos en una variable la conexion con el CRUD php
var url = "bd/crud.php";

var appMoviles = new Vue({
    el: '#appMoviles',
    data: {
        
            moviles:[],
            marca:"",
            modelo:"",
            stock:"",
            total:0
       
    },
    methods: {
        //Creamos nuestros botones enlazado con sweet Alert
        btnAlta: async function(){
            //usamos sweet alert
             const {value:formValues}= await Swal.fire({
                title: 'Nuevo Movil',
                html:
                    '<div class="row"><label class="col-sm-3 col-form-label">Marca</label><div class="col-sm-7"><input id="marca" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Modelo</label><div class="col-sm-7"><input id="modelo" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Stock</label><div class="col-sm-7"><input id="stock" type="text" class="form-control"></div></div>',
                focusConfirm:false,    
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                //confirmButtonColor:'#1cc88a',
                //cancelButtonColor:'#3085d6',

                showLoaderOnConfirm: true,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-primary btn-lg',
                cancelButtonClass: 'btn btn-secondary btn-lg',
                preConfirm: function(){
                    return[
                        this.marca = document.getElementById('marca').value,
                        this.modelo = document.getElementById('modelo').value,
                        this.stock = document.getElementById('stock').value
                    
                    ]
                }
            })
            if(this.marca == "" || this.modelo == "" || this.stock == 0){
                Swal.fire({
                    type: 'info',
                    title: 'Datos Imcompletos',
                })
            }else{
                this.altaMovil();
                //Aquí hacemos el llamado para la funcion alta movil

                //Aqui mostramos que fue agregado exitosamente nuestro registro
                const Toast = Swal.mixin({
                    Toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    type: 'success',
                    title: '¡Producto Agregado!'
                })
            }
            //Final sweet alert
        },
        btnEditar: async (id, marca, modelo, stock)=>{

        await Swal.fire({
            title:'EDITAR',
            html: '<div class="row"><label class="col-sm-3 col-form-label">Marca</label><div class="col-sm-7"><input value="'+marca+'" id="marca" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Modelo</label><div class="col-sm-7"><input id="modelo" value="'+modelo+'" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Stock</label><div class="col-sm-7"><input id="stock" value="'+stock+'" type="text" class="form-control"></div></div>',
            focusConfirm:false,
            showCancelButton: true,
        }).then((result)=>{
            if(result.value){
                //Se toman los nuevos datos si es que los hemos modificado
                marca = document.getElementById('marca').value,
                modelo = document.getElementById('modelo').value,
                stock = document.getElementById('stock').value,

                this.btnEditar(id,marca,modelo,stock);

                //Se lanza un notificacion
                Swal.fire(
                    '¡Actualizado!',
                    'El registro ha sido actualizado',
                    'success'
                )

            }
        })
        },
        btnBorrar: (id)=>{
            Swal.fire({
                title:'Estas seguro de eliminar este registro:'+id+" ?",
                type:'warning',
                showCancelButton:true,
                confirmButtonClass: 'btn btn-primary btn-lg',
                cancelButtonClass: 'btn btn-secondary btn-lg',
                confirmButtonText:'Borrar'
            }).then((result)=>{
                if(result.value){
                    this.borrarMovil(id);

                    //Mostramos mensaje acerca de lo eliminado
                    Swal.fire(
                        '¡Eliminado!',
                        'El registro ha sido borrado correctamente',
                        'success'
                    )
                }
            })
        },

        //Procedimientos
        //Listar los datos
        cargarDatos(){
            //invocamos axios para procesar la informacion
            axios.post(url, {opcion:4}).then(response =>{
                this.moviles = response.data;
                //console.log(this.moviles);
            });
        },
        //creamos procedimiento para crear nuevos registros (altaMovil())
        altaMovil:function(){
            //invocamos axios para procesar la informacion
            axios.post(url, {opcion:1, marca:this.marca, modelo:this.modelo, stock:this.stock}).then(response =>{
                this.cargarDatos();
                //console.log(this.moviles);
            });
        },
    },
    created(){
        this.cargarDatos();
    },
    computed: {
        totalStock(){
            this.total= 0;
            for(movil of this.moviles){
                this.total = this.total + parseInt(movil.stock);
            }
            return this.total;
        }
    },
})