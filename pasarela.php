<form action="index.php?modulo=factura" method="post" id="payment-form">
    <table class="table table-striped table-inverse" id="tablaPasarela">
        <thead class="thead-inverse">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div class="form-row">
        <h4 class="mt3">Datos de su tarjeta</h4>
        <div id="card-element" class="form-control">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>
    <div class="mt-3">
        <h4>Terminos y condiciones</h4>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima, soluta non quibusdam, assumenda mollitia expedita nihil quisquam sapiente optio rem reiciendis voluptatum laborum eos consectetur obcaecati sint incidunt doloribus placeat!
        Lorem, ipsum dolor sit amet consectetur (le entrego mi alrma a programamdor novato y acepto dar like) adipisicing elit. Minima, soluta non quibusdam, assumenda mollitia expedita nihil quisquam sapiente optio rem reiciendis voluptatum laborum eos consectetur obcaecati sint incidunt doloribus placeat!
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima, soluta non quibusdam, assumenda mollitia expedita nihil quisquam sapiente optio rem reiciendis voluptatum laborum eos consectetur obcaecati sint incidunt doloribus placeat!
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
            Acepto los terminos y condiciones
          </label>
        </div>
    </div>
    <div class="mt-3">
        <a class="btn btn-warning" href="index.php?modulo=envio" role="button">Ir a envio</a>
        <button type="submit" class="btn btn-primary float-right">Pagar</button>
    </div>
</form>
