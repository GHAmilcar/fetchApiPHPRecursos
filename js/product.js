const formPerson = document.querySelector("#formProduct"); // Capturamos nuestro formulario con el id que le asignamos
    formPerson.addEventListener('submit', (e) => { // agregamos addEvenListener para decirle que queremos capturar con submit
        e.preventDefault();     // Para evitar recargar la pagina;
        const datos = new FormData(document.getElementById('formProduct')); // Obtenemos toda las data del formulario y la guardamos en data
        let nomProduct = datos.get('productName');
        let description = datos.get('productDescription');
        let category = datos.get('categoria_id');
        let mensajes =  document.querySelector("#mensajes");
        mensajes.innerHTML = "";
        if (nomProduct == "") {
            let tipo_mensaje = "Debes de ingresar un nombre";
            error(tipo_mensaje);
            return false;
        } else if(description == "") {
            let tipo_mensaje = "Debes de ingresar tus apellidos";
            error(tipo_mensaje);
            return false;
        } else if(category  == "" || category == "seleccionar"){
             let tipo_mensaje = "Debes de seleccionar el tipo de sexo";
            error(tipo_mensaje);
            return false;
        }
        console.log(nomProduct,description,category);

        var url = "../modelo/Product.php";
        fetch(url,{
            method:'post',
            body:datos
        })
        .then (data => data.json())
        .then (data =>{
            console.log('success', data);
            pintar_tabla_resultados(data);
            formPerson.reset();
        })
        .catch(function(error){
            console.log('error',error);
        });

    });

    const error = (tipo_mensaje) => {
        mensajes.innerHTML +=`
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Error!</h4>
                    <P> *${tipo_mensaje}</P>
                </div>
            </div>
    
        </div>
    
        `;
    }

    const pintar_tabla_resultados = (data) =>{
        let tab_datos = document.querySelector("#tabla_productos");
        tab_datos.innerHTML = "";
        for(let item of data){
            tab_datos.innerHTML +=`
            <tr>
            <td>${item.product_name}</td>
            <td>${item.description}</td>
            <td>${item.category_name}</td>
            <td class="text-center">
            <button class="btn btn-primary btn-sm" onclick="editar(${item.id})">Editar...</button>
            <button class="btn btn-danger btn-sm" onclick="eliminar(${item.id})">eliminar</button>
            </td>
            </tr>
            `;
        }
   } // Fin del metodo pintar tabla sin recargar

   const eliminar = (id) =>{
    Swal.fire({
    title: 'Estas seguro de eliminar el registro',
    text: "Ya no se podra recuperar el registro",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            var url = "./modelo/ejecutarconsultas.php";
            var formdata = new FormData();
            formdata.append('tipo_operacion', 'eliminar');
            formdata.append('id', id);
            fetch(url, {
                method: 'post',
                body: formdata
            }).then(data => data.json())
            .then(data => {
                console.log('Success:', data)
                pintar_tabla_resultados(data);
                Swal.fire(
                'Eliminado', 
                'El registro se elimino correctamente.',
                'success'
                )
            })
            .catch(error => console.error('Error:', error));
           
        }
    })
} // Fin metodo eliminar




