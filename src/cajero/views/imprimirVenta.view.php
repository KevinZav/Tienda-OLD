
<div class="nota">
    <h1 class="text-center">Nota de venta</h1>
    <div class="nota-head">
        cajero: <?=$appController->dataVenta['nombre'].' '.$appController->dataVenta['apellidos'];?>
        <br>
        fecha: <?=$appController->dataVenta['fecha'];?>
        <br>
        folio: <?=$appController->dataVenta['id'];?>
    </div>
    <div class="nota-body">
        <pre class="text-center">DESCRIPCION</pre>
        <pre class="text-center">CANT       PRECIO       SUBTOTAL</pre>

        <hr>

        <?php
            foreach( $appController->detallesVenta as $detalleVenta ):
        ?>

        <pre class="text-center"><?=$detalleVenta['descripcion_producto'];?></pre>
        <pre class="text-center"><?=$detalleVenta['cantidad']?>       <?=$detalleVenta['precio']?>       <?=$detalleVenta['cantidad'] * $detalleVenta['precio']?></pre>
        <hr>
        <?php
            endforeach;
        ?>
        <pre class="total">TOTAL: <?=$appController->dataVenta['total'];?></pre>
    </div>
    <pre class="text-center">¡Gracias por su compra!</pre>
</div>
<script src="<?=Router::getScriptRoute('imprimir.js')?>"></script>
