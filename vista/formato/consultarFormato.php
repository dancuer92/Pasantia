
<div id="consultarFormat" class="contenido">
    <form class="s12 m4" id="formConsFormat" method="POST" action=""> 
        <div class="center" >
            <h3><i class="material-icons prefix" style="font-size: 2.92rem">search</i> Consultar Formato</h3>
            <div class="input-field col s12 m12 l12">
                <i class="material-icons prefix">description</i>
                <input id="cod_formato" name="cod_formato" type="text" maxlength="15" class="validate" required onkeyup="autocompletarFormato();">
                <label for="cod_formato">Seleccione un formato</label>                           
            </div>
            <div class="col s12 m12 l12">
                <table id="tabla_formatos" class="highlight responsive-table">
                    <thead>
                        <tr>
                            <th data-field="codigo"> Código</th>
                            <th data-field="nombre"> Nombre</th>
                            <th data-field="observaciones"> Observaciones</th>
                            <th data-field="procedimiento"> Procedimiento</th>
                            <th data-field="jefe"> Director</th>
                            <th data-field="opciones"> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>                        
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
<div id="asignarFormato" class="modal" >
    <form class="s12" action="controlador/Formato_controller.php" method="post">
        <div class="modal-content" >
            <h3>Asignar Formato</h3>
            <div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="formatoAsignar" type="hidden" name="formatoAsignar" value="">
                        <input id="cod_usuario" name="cod_usuario" type="text" class="validate" required onkeyup="autocompletarUsuario()">
                        <label for="cod_usuario">Nombre de Usuario</label>
                        <div id="usuarios" class="collection">                            
                        </div>
                    </div>                    
                </div>

            </div>
        </div>

        <!-- Modal Footer de Inicio de sesión-->
        <div class="modal-footer">
            <button id="asignarFormatoButton" class="modal-action btn waves-effect waves-light hoverable" type="submit" name="action" disabled="true">Asignar
                <i class="material-icons right">send</i>
            </button>            
            <a class="modal-action modal-close waves-effect waves-red btn-flat hoverable">Cancelar
                <i class="material-icons right">cancel</i></a>
            <!--<a class="modal-trigger" href="#modalCambioPass">Reestablecer contraseña</a>-->
        </div>        
    </form>
</div>