<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <!-- Bootstrap 4.4.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <!-- Font Awesome 5.11.2-->
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    
</head>
<body>
<header class="text-center"><span class="badge badge-success">CRUD con VUE.js</span></header>


<div id="appMoviles">
    <div class="container">
        <div class="row">
            <div class="col">
                <button @click="btnAlta" class="btn btn-success"><i class="fas fa-plus-circle"></i></button>
            </div>
            <div class="col">
                <h5 class="text-right">Stock Total: <span class="badge badge-success">{{totalStock}}</span></h5>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <table class="table table-stripped">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>ID</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(movil , indice) of moviles">
                            <td>{{movil.id}}</td>
                            <td>{{movil.marca}}</td>
                            <td>{{movil.modelo}}</td>
                            <td>
                                <div class="col-md-8">
                                    <input type="number" v-model.number="movil.stock" class="form-control text-right" disabled>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-secondary" title="Editar" @click="btnEditar(movil.id,movil.marca, movil.modelo, movil.stock)"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger" title="Eliminar" @click="btnEditar(movil.id)"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    <script src="jquery/jquery-3.4.1.min.js"></script>

    <script src="popper/popper.min.js"></script>

    <script src="bootstrap/bootstrap.min.js"></script>
    <!-- Bootstrap.js 4.4.1 -->
    <script src="plugins/vue.js"></script>
    <!-- Enlace CDN de vue.js -->

    <script src="plugins/axios.min.js"></script>
    <!-- Enlace axios para peticiones ajax  -->

    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- Sweet Alert para mensajes mas amigables y faciles  -->
    <script src="main.js"></script>

</body>
</html>