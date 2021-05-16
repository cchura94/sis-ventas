@extends("layouts.admin")

@section("contenedor")

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h1>Fecha Pedido: {{ date("d/m/yy") }}</h1>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h1>Lista de Producto</h1>

  <input type="search" name="buscar" id="buscador" onkeyup="buscarProducto()" class="form-control" placeholder="buscar por nombre">
  
<table class="table table-striped table-hover">
    <thead>
    <tr>
            <td>NOMBRE</td>
            <td>CANTIDAD</td>
            <td>PRECIO</td>
            
            <td>CATEGORIA</td>
            <td>ACCIONES</td>
        </tr>
    </thead>
    <tbody id="datos">
    
    </tbody>

</table>

            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Carrito</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>NOMBRE</th>
                                    <th>CANTIDAD</th>
                                    <th>PRECIO</th>
                                    <th>SUB. T</th>
                                </tr>
                            </thead>
                            <tbody id="datoscarrito">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Cliente</h3>

                        <input type="search" name="buscar" id="buscadorclie" onkeyup="buscarCliente()" class="form-control" placeholder="buscar por nombre">
  
  <table class="table table-striped table-hover">
      <thead>
      <tr>
              <td>NOMBRE</td>
              <td>CI / NIT</td>
              <td>ACCIONES</td>
          </tr>
      </thead>
      <tbody id="datoscliente">
      
      </tbody>
  
  </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7"></div>
    <div class="col-md-3">
    <div class="card">
            <div class="card-body">
                <h2>Total: <p id="total"></p></h2>
            </div>
        </div>   
    </div>
    <div class="col-md-2">
        <div class="card">
            <div class="card-body">
            <button class="btn btn-success btn-block" onclick="realizarPedido()">Realizar Pedido</button>
            </div>
        </div>
    </div>

</div>

@endsection

@section("javascript")
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>

let total = 0;
let productos = [];
let carrito = [];
let clientes = [];
let id_cliente = 0;
function buscarProducto() {
    buscar = document.getElementById("buscador").value
    
    axios.get('/admin/producto/buscar?buscar='+buscar)
        .then(function (response) {
            // handle success
            console.log(response);
            productos = response.data
            listarProductos()

        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
}

function listarProductos() {
    let html = ``;
    for (let i = 0; i < productos.length; i++) {
        const element = productos[i];
        html += `
        <tr>
            <td>${element.nombre}</td>
            <td>${element.cantidad}</td>
            <td>${element.precio}</td>
            <td>${element.categoria_id}</td>
            <td>
                <button onclick="addCarrito(${i})" class="btn btn-success">add carrito</button>
            </td>
        </tr>
            
        `;

    }
    document.getElementById("datos").innerHTML = html;
}

function addCarrito(i) {
    
    carrito.push(productos[i]);
    actualizarCarrito();
}

function actualizarCarrito(){
    let html = ``;
    total = 0;
    for (let i = 0; i < carrito.length; i++) {
        
        const element = carrito[i];
        total += parseFloat(element.precio);
        html += `
        <tr>
            <td>${element.nombre}</td>
            <td>${element.cantidad}</td>
            <td>${element.precio}</td>
            <td>${element.precio}</td>
        </tr>
            
        `;

    }
    document.getElementById("total").innerHTML = total
    document.getElementById("datoscarrito").innerHTML = html;
}

function buscarCliente() {
    buscar = document.getElementById("buscadorclie").value
    
    axios.get('/admin/cliente/buscar?buscar='+buscar)
        .then(function (response) {
            // handle success
            console.log(response);
            clientes = response.data
            listarClientes()

        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
}

function listarClientes() {
    let html = ``;
    for (let i = 0; i < clientes.length; i++) {
        const element = clientes[i];
        html += `
        <tr>
            <td>${element.nombres}</td>
            <td>${element.ci_nit}</td>
            <td>
                <button onclick="selecCliente(${i})" class="btn btn-primary">seleccionar</button>
            </td>
        </tr>
            
        `;

    }
    document.getElementById("datoscliente").innerHTML = html;
}

function selecCliente(i) {
    
    id_cliente = clientes[i].id
    clientes = [];
    listarClientes();
}

function realizarPedido() {
    let prod_carrito = [];
    for (let i = 0; i < carrito.length; i++) {
        const prod = carrito[i];
        prod_carrito.push({producto_id: prod.id, cantidad: 1});        
    }
    let pedido = {
        cliente_id: id_cliente,
        carrito: prod_carrito
    }

    axios.post('/admin/pedido', pedido)
        .then(function (response) {
            // handle success
            alert("Pedido Realizar");

        })
        .catch(function (error) {
            // handle error
            console.log(error);
            alert("Ocurrió un error al realizar el pedido")
        });

}
</script>    

@endsection