<div id="registrarUser" class="contenido">
    <form class="s12 m4" id="formRegUser" method="post"> 
        <div class="center" >
            <h3><i class="material-icons prefix" style="font-size: 2.92rem">person_add</i> Registrar Usuario</h3>
            <div>
                <div class="row">
                    <div class="input-field col s6 m6 l3">
                        <select id="tipoUser" name="tipoUser" class="validate" required >                        
                            <option value="0" >Operario</option>
                            <option value="1">Administrador</option>                        
                            <option value="2">Asistente del SGC</option>                        
                            <option value="3">Supervisor</option>                        
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
                    <div class="input-field col s12 m6 l3">
                        <i class="material-icons prefix">person_pin</i>
                        <input id="codigo" name="codigo" type="text" maxlength="30" length="30"class="validate" pattern="[a-z]{1,30}" title="Digite sólo letras minúsculas y sin espacios" required>
                        <label for="codigo">Usuario de red</label>                           
                    </div>
                    <div class="input-field col s6 m6 l3">
                        <i class="material-icons prefix">person_pin</i>
                        <input id="nombre" name="nombre" type="text"  maxlength="50" length="50" class="validate" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]{1,50}" title="Digite sólo letras" required>
                        <label for="nombre">Nombre</label>                           
                    </div>
                    <div class="input-field col s6 m6 l3">
                        <i class="material-icons prefix">person_pin</i>
                        <input id="apellido" name="apellido" type="text"  maxlength="50" length="50" class="validate" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]{1,50}" title="Digite sólo letras" required>
                        <label for="apellido">Apellido</label>                                                      
                    </div>                               
                    <div class="input-field col s12 m6 l3">
                        <i class="material-icons prefix">person_pin</i>
                        <input id="numDoc" name="numDoc" type="text" maxlength="15" length="15" class="validate" pattern="[0-9]{1,15}" title="Digite sólo números" required>
                        <label for="numDoc">Número de cédula</label>                                                      
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <i class="material-icons prefix">email</i>
                        <input id="correo" name="correo" type="email" maxlength="50" length="50" class="validate" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="ejemplo: ejemplo@cisa.com" required>
                        <label for="correo">Correo electrónico</label>                                                      
                    </div>
                    <div class="input-field col s6 m6 l3">
                        <i class="material-icons prefix">lock</i>
                        <input id="pass" name="pass" type="password"  maxlength="50" length="50" class="validate" pattern="(?=.*\d)(?=.*[+-._,*/])(?=.*[a-z]).{8,}" title="La contraseña debe ser mayor a ocho(8) caracteres y debe contener al menos un número y un caracter especial(+-._,*/)" required>
                        <label for="pass">Password</label>                                                      
                    </div>
                    <div class="input-field col s6 m6 l3">
                        <i class="material-icons prefix">lock</i>
                        <input id="confirmPass" name="confirmPass" type="password"  maxlength="50" length="50" class="validate" required>
                        <label for="confirmPass">Confirmar password</label>                                                      
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <i class="material-icons prefix">work</i>
                        <input id="cargo" name="cargo" type="text"  maxlength="50" length="50" class="validate" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]{1,50}" title="Digite sólo letras"required>
                        <label for="cargo">Cargo</label>                                                      
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <i class="material-icons prefix">work</i>
                        <input id="departamento" name="departamento" type="text"  maxlength="50" length="50" class="validate" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]{1,50}" title="Digite sólo letras"required>
                        <label for="departamento">Departamento</label>                                                      
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <i class="material-icons prefix">phone</i>
                        <input id="telefono" name="telefono" type="tel"  maxlength="20" length="20" class="validate" pattern="[0-9]{1,15}" title="Digite sólo números" required>
                        <label for="telefono">Teléfono</label>                            
                    </div>                    
                </div>

            </div> 

        <!--<input id="opcion" name="opcion" type="hidden" value="registrar">-->
            <!--            <a id="registroUsuario" class="btn waves-effect waves-light hoverable" onclick="registrarUser()">Registrar
                            <i class="material-icons right">send</i>
                        </a>           -->
            <button id="registroUsuario" class="btn waves-effect waves-light hoverable" type="submit" name="action" >Registrar
                <i class="material-icons right">send</i>
            </button>
            <a class="waves-effect waves-red btn-flat hoverable" onclick="limpiar()">Limpiar
                <i class="material-icons right">cancel</i></a>        
        </div>
    </form>
    <div id="regUserForm"></div>

</div>
