-- CREATE TABLE `info_test2` (
--     `id` int(11) NOT NULL,
--     `fecha_registro_sistema` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
--     `fecha_formato_diligenciado` date NOT NULL,
--     `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
--     `estado` tinyint(4) NOT NULL,
--     `informacion` text COLLATE utf8_spanish_ci NOT NULL,
--     `observaciones` text COLLATE utf8_spanish_ci NULL,
--     `campos_clave` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
--     `fechas_modificaciones` text COLLATE utf8_spanish_ci NULL,
--     `usuarios_modificaciones` text COLLATE utf8_spanish_ci NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- 
-- ALTER TABLE `info_test2`
--     ADD PRIMARY KEY (`id`),
--     ADD UNIQUE (`campos_clave`),
--     MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



--Rename table info_tabla_nueva to info_test

-- alter table infp_test rename as info_nuevo_nombre;


--UPDATE `info_test` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`=''




-- ALTER TABLE `pasantia`.`info_ctrl-atm35-40` 
-- ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
-- ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
-- ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
-- UPDATE `pasantia`.`info_ctrl-atm35-40` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
-- ALTER TABLE `pasantia`.`info_ctrl-atm35-40` 
-- ADD UNIQUE (`campos_clave`);
