CREATE TABLE `info_res-1710` (
    `id` int(11) NOT NULL,
    `fecha_registro_sistema` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `fecha_formato_diligenciado` date NOT NULL,
    `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
    `estado` tinyint(4) NOT NULL,
    `informacion` text COLLATE utf8_spanish_ci NOT NULL,
    `observaciones` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `info_res-1710`
    ADD PRIMARY KEY (`id`),
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;