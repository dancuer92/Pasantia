CREATE TABLE `info` (
    `id` int(11) NOT NULL,
    `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
    `estado` tinyint(4) NOT NULL,
    `informacion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `info`
    ADD PRIMARY KEY (`id`),
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;