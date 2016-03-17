<div id="registrarUser" class="contenido">
    <form class="s12 m4" id="formRegUser" method="post"> 
        <div class="center" >
            <h3><i class="material-icons prefix" style="font-size: 2.92rem">person_add</i> Registrar Usuario</h3>
            <div>
                <div class="row">
                    <div class="input-field col s12 m6 l3">
                        <i class="material-icons prefix">person_pin</i>
                        <input id="codigo" name="codigo" type="text" maxlength="10" class="validate" required>
                        <label for="codigo">Código</label>                           
                    </div>
                    <div class="input-field col s6 m6 l3">
                        <i class="material-icons prefix">person_pin</i>
                        <input id="nombre" name="nombre" type="text" maxlength="30" class="validate" required>
                        <label for="nombre">Nombre</label>                           
                    </div>
                    <div class="input-field col s6 m6 l3">
                        <i class="material-icons prefix">person_pin</i>
                        <input id="apellido" name="apellido" type="text" maxlength="30" class="validate" required>
                        <label for="apellido">Apellido</label>                                                      
                    </div>                               
                    <div class="input-field col s12 m6 l3">
                        <i class="material-icons prefix">person_pin</i>
                        <input id="numDoc" name="numDoc" type="number" maxlength="15" class="validate" required>
                        <label for="numDoc">Número de cédula</label>                                                      
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <i class="material-icons prefix">email</i>
                        <input id="correo" name="correo" type="email" maxlength="50" class="validate" required>
                        <label for="correo">Correo electrónico</label>                                                      
                    </div>
                    <div class="input-field col s6 m6 l3">
                        <i class="material-icons prefix">lock</i>
                        <input id="pass" name="pass" type="password" maxlength="50" class="validate" required>
                        <label for="pass">Password</label>                                                      
                    </div>
                    <div class="input-field col s6 m6 l3">
                        <i class="material-icons prefix">lock</i>
                        <input id="confirmPass" name="confirmPass" type="password" maxlength="50" class="validate" required>
                        <label for="confirmPass">Confirmar password</label>                                                      
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <i class="material-icons prefix">work</i>
                        <input id="cargo" name="cargo" type="text" maxlength="50" class="validate" required>
                        <label for="cargo">Cargo</label>                                                      
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <i class="material-icons prefix">work</i>
                        <input id="departamento" name="departamento" type="text" maxlength="30" class="validate" required>
                        <label for="departamento">Departamento</label>                                                      
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <i class="material-icons prefix">phone</i>
                        <input id="telefono" name="telefono" type="number" maxlength="20" class="validate" required>
                        <label for="telefono">Teléfono</label>                            
                    </div>
                    <div class="input-field col s6 m6 l3">
                        <select id="tipoUser" name="tipoUser" class="validate" required >                        
                            <option value="0" >Operario</option>
                            <option value="1">Administrador</option>                        
                        </select>                                  
                        <label for="tipoUser">Tipo de usuario</label>
                    </div>
                    <div class="input-field col s6 m6 l3">
                        <select id="estado" name="estado" class="validate" required >                        
                            <option value="1" >Activo</option>
                            <option value="0">Inactivo</option>                        
                        </select>                                  
                        <label for="estado">Estado</label>
                    </div>
                </div>

            </div> 

        <!--<input id="opcion" name="opcion" type="hidden" value="registrar">-->
            <a id="registroUsuario" class="btn waves-effect waves-light hoverable" onclick="registrarUser()">Registrar
                <i class="material-icons right">send</i>
            </a>           
            <a class="waves-effect waves-red btn-flat hoverable" onclick="limpiar()">Limpiar
                <i class="material-icons right">cancel</i></a>        
        </div>
    </form>
    <div id="regUserForm"></div>

</div>
