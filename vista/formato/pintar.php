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
        <tr>
            <td>' . $array["cod_formato"] . '</td>
            <td>' . $array["nombre"] . '</td>
            <td>' . $array["observaciones"] . '</td>
            <td>' . $array["procedimiento"] . '</td>                        
            <td>' . $array["jefe_procedimiento"] . '</td>                        
            <td>
                <a class="hoverable colorTexto tooltipped" data-position="top" data-delay="50" data-tooltip="Diligenciar" href="#Diligenciar"> <i class="material-icons">keyboard</i></a>
            </td>
        </tr>
    </tbody>
</table>
<ul id="tabla_formatos" class="collection">
    <li class="collection-item avatar">
        <i class="large material-icons left grey-text">description</i>
        <p><strong>' . $array["cod_formato"] . '</strong></p>
        <p>' . $array["nombre"] . '</p>
        <p>' . $array["observaciones"] . '</p>
        <p>' . $array["procedimiento"] . '</p>
        <p>' . $array["jefe_procedimiento"] . '</p>';
        <a class="hoverable colorTexto tooltipped" data-position="top" data-delay="50" data-tooltip="Diligenciar" href="#Diligenciar"> <i class="material-icons">keyboard</i></a>';
    </li>
</ul>