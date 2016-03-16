
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