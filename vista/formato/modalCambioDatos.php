<!--Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">¿Desea guardar la información?</h4>
            </div>
            <div class="modal-body">
                <form class="">
                    <div class="form-group" >
                        <label>Código del formato</label>
                        <input id="codigoFormato" name="codigoFormato" type="text" maxlength="50" length="50" class="form-control" pattern="[0-9A-ZÑ\-]{1,50}" title="Digite un código válido">
                        <a class="btn btn-default remover" onclick="guardarDatoFormato('cod_formato', 'codigoFormato');" >Guardar código</a>
                    </div>
                    <div class="form-group">
                        <label>Nombre del formato</label>
                        <input id="nombreFormato" name="nombreFormato" type="text" maxlength="50" length="50" class="form-control" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ \s]{1,50}" title="Digite sólo letras" >
                        <a class="btn btn-default remover" onclick="guardarDatoFormato('nombre', 'nombreFormato');">Guardar nombre</a>                    
                    </div>
                    <div class="form-group">
                        <label>Procedimiento de trabajo</label>
                        <select id="procedimiento" name="procedimiento" class="form-control" >  
                            <option value="" disabled selected>Seleccione procedimiento</option>
                            <!--<option value="seleccione">Seleccione procedimiento</option>-->
                            <option value="Preparación pasta" >Preparación pasta</option>
                            <option value="Preparación esmalte">Preparación esmalte</option>                        
                            <option value="Líneas de ensamble">Líneas de ensamble</option>                        
                            <option value="Hornos">Hornos</option>                        
                            <option value="Materia prima">Materia prima</option>                        
                            <option value="Auditores de calidad">Auditores de calidad</option>                        
                            <option value="Certificación de producto">Certificación de producto</option>                        
                        </select>
                        <a class="btn btn-default remover" onclick="guardarDatoFormato('procedimiento', 'procedimiento');">Guardar procedimiento</a>
                    </div>
                    <div class="form-group">
                        <label>Director del procedimiento</label>
                        <select id="directorProcedimiento" name="directorProcedimiento" class="form-control">     
                            <option value="" disabled selected>Seleccione director</option>
                            <!--<option value="seleccione">Seleccione director</option>-->
                            <option value="Félix García" >Félix García</option>
                            <option value="Fabián Ríos" >Fabián Ríos</option>
                            <option value="Víctor González" >Víctor González</option>
                            <option value="Jaime Poveda">Jaime Poveda</option>                        
                            <option value="Hellar Gutiérrez">Hellar Gutiérrez</option>                                        
                            <option value="Carlos Jáuregui">Carlos Jáuregui</option>                                        
                            <option value="Duvín Blanco">Duvín Blanco</option>                                        
                            <option value="Isley Espitia">Isley Espitia</option>                                        
                        </select>
                        <a class="btn btn-default remover" onclick="guardarDatoFormato('jefe_procedimiento', 'directorProcedimiento');">Guardar director</a>
                    </div>
                    <div class="form-group">
                        <label>tipo de contenido</label>
                        <select id="tipoFormato" name="tipoFormato" class="form-control">
                            <option value="" disabled selected>Seleccione tipo</option>
                            <!--<option value="seleccione">Seleccione tipo</option>-->
                            <option value="Campos de entrada" >Campos de entrada</option>
                            <option value="Listas desplegables">Listas desplegables</option>                        
                            <option value="Casillas de opciones">Casillas de opciones</option>                        
                            <option value="Tablas de datos">Tablas de datos</option>                        
                            <option value="Tablas de listas">Tablas de listas</option>                        
                            <option value="Tablas mixtas">Tablas mixtas</option>                        
                            <option value="Múltiples tablas">Múltiples tablas</option>                        
                            <option value="Todas las opciones">Todas las opciones</option>                        
                        </select>
                        <a class="btn btn-default remover" onclick="guardarDatoFormato('descripcion_contenido', 'tipoFormato');">Guardar tipo</a>
                    </div>
                    <div class="form-group">
                        <label for="frecuenciaFormato">Frecuencia de uso</label>
                        <select id="frecuenciaFormato" name="frecuenciaFormato" class="form-control">
                            <option value="" disabled selected>Frecuencia del formato</option>
                            <!--<option value="seleccione">Frecuencia del formato</option>-->
                            <option value="1">Hora</option>
                            <option value="2">Turno operativo</option>                        
                            <option value="3">Turno administración</option>                        
                            <option value="4">Diario</option>                        
                            <option value="5">Semanal</option>                        
                            <option value="6">Ocasional</option>                        
                            <option value="7">Libre</option>                        
                        </select>
                        <a class="btn btn-default remover" onclick="guardarDatoFormato('frecuencia_uso', 'frecuenciaFormato');">Guardar frecuencia</a>
                    </div>
                    <div class="form-group">
                        <label for="version">Versión del formato</label>
                        <input id="versionFormato" name="versionFormato" type="text" maxlength="50" length="50" class="form-control" value="Versión 1" placeholder="Versión 1" pattern="^Versión [0-9]+" title="Escriba una versión válida, por ejemplo: Versión 1">
                        <a class="btn btn-default remover" onclick="guardarDatoFormato('version', 'versionFormato');">Guardar versión</a>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">CERRAR</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
