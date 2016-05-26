<div id="master-container" class="container">
    <div class="col-lg-4 col-sm-12 col-md-12 divMayor">
        <div id="pestañas">
            <!-- Nav tabs -->
            <ul id="myTabs" class="nav nav-tabs" role="tablist">
                <li  role="presentation" class="active"><a id="pestañaElementos" href="#elementos" aria-controls="elementos" role="tab" data-toggle="tab">Elementos</a></li>
                <li  role="presentation"><a id="pestañaPropiedades" href="#propiedades" aria-controls="propiedades" role="tab" data-toggle="tab">Propiedades</a></li>
                <li role="presentation"><a id="pestañaFormulario" href="#formulario" aria-controls="formulario" role="tab" data-toggle="tab">Formulario</a></li>
            </ul>


            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="elementos">                            
                    <div class="col-sm-6">
                        <button class="btn btn-default  btn-block new-element" data-type="element-text" style="width: 100%;">Campo de texto</button>
                        <button class="btn btn-default  btn-block new-element" data-type="element-paragraph-text" style="width: 100%;">Área de texto</button>
                        <button class="btn btn-default  btn-block new-element" data-type="element-multiple-choice" style="width: 100%;">Opciones</button>
                        <button class="btn btn-default  btn-block new-element" data-type="element-date" style="width: 100%;">Fecha</button>
                        <button class="btn btn-default  btn-block new-element" data-type="element-link" style="width: 100%;">Enlace</button>
                        <button class="btn btn-default  btn-block new-element" data-type="element-section-break" style="width: 100%;">Separador</button>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-default  btn-block new-element" data-type="element-number" style="width: 100%;">Campo numérico</button>
                        <button class="btn btn-default  btn-block new-element" data-type="element-checkboxes" style="width: 100%;">C. de verificación</button>
                        <button class="btn btn-default  btn-block new-element" data-type="element-dropdown" style="width: 100%;">Lista desplegable</button>
                        <button class="btn btn-default  btn-block new-element" data-type="element-time" style="width: 100%;">Hora</button>
                        <button class="btn btn-default  btn-block new-element" data-type="element-table" style="width: 100%;">Tabla</button>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="propiedades">
                    <div id="titulo">
                        <label>Nombre del campo</label>
                        <br>
                        <p>Digite aquí el nombre que se quiere para el elemento</p>
                        <input type="text" class="form-control" id="cambiarTitulo" onkeyup="cambiarTitulo();" onblur="limpiarTitulo();" />
                    </div>
                    <div id="requerido">
                        <label>Este campo será obligatorio</label><input id="obligatorio" type="checkbox"/> 
                    </div>
                    <div id="opciones"></div>
                    <div id="celdas"></div>
                    <div id="eliminarElemento">
                        <button class="btn btn-danger btn-block" id="eliminar" name="eliminar" onclick="eliminar();">Eliminar elemento</button>
                    </div>                            
                </div>
                <div role="tabpanel" class="tab-pane" id="formulario">                    
                    <div>
                        <label>Detalle de la modificación</label>
                        <textarea type="text" class="form-control" id="detForm" placeholder="Indique aquí la naturaleza del cambio y demas detalles de la modificación del contenido."></textarea>
                    </div>                    
                </div>
            </div>

        </div>               
    </div>
    <div class="col-lg-8 col-sm-12 col-md-12 divMayor" id="formBuilder">
        <table id="encabezado">
            <tr>
                <td ><h3> Nombre: <?php echo $_POST['nombreFormato']; ?></h3></td>
                <td ><h3> Código: <?php echo $_POST['codigoFormato']; ?> </h3></td>                    
                <td ><img class="img-responsive" src="../util/images/corporativo/logo_ceramica.png" alt="Cerámica Italia"></td>
            </tr>
        </table>
    </div>    
</div>
