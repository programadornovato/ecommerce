$(document).ready(function () {
    $.ajax({
        type: "post",
        url: "ajax/leerCarrito.php",
        dataType: "json",
        success: function (response) {
            llenaCarrito(response);
        }
    });
    $("#agregarCarrito").click(function (e) { 
        e.preventDefault();
        var id=$(this).data('id');
        var nombre=$(this).data('nombre');
        var web_path=$(this).data('web_path');
        var cantidad=$("#cantidadProducto").val();
        $.ajax({
            type: "post",
            url: "ajax/agregarCarrito.php",
            data: {"id":id,"nombre":nombre,"web_path":web_path,"cantidad":cantidad},
            dataType: "json",
            success: function (response) {
                llenaCarrito(response);
                $("#badgeProducto").hide(500).show(500).hide(500).show(500).hide(500).show(500);
                $("#iconoCarrito").click();
            }
        });
    });
    function llenaCarrito(response){
        var cantidad=Object.keys(response).length;
        if(cantidad>0){
            $("#badgeProducto").text(cantidad);
        }else{
            $("#badgeProducto").text("");
        }
        $("#listaCarrito").text("");
        response.forEach(element => {
            $("#listaCarrito").append(
                `
                <a href="index.php?modulo=detalleproducto&id=${element['id']}" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="${element['web_path']}" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                ${element['nombre']}
                                <span class="float-right text-sm text-primary"><i class="fas fa-eye"></i></span>
                            </h3>
                            <p class="text-sm">Cantidad ${element['cantidad']}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                `
            );
        });
        $("#listaCarrito").append(
            `
            <a href="#" class="dropdown-item dropdown-footer text-danger" id="borrarCarrito">
                Borrar carrito 
                <i class="fa fa-trash"></i>
            </a>
            `
        );
    }
    $(document).on("click","#borrarCarrito",function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "ajax/borrarCarrito.php",
            dataType: "json",
            success: function (response) {
                llenaCarrito(response);
            }
        });
    });
});