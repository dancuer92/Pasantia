CREATE TABLE `info` (
    `id` int(11) NOT NULL,
    `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `usuario` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
    `estado` tinyint(4) NOT NULL,
    `informacion` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

ALTER TABLE `info`
    ADD PRIMARY KEY (`id`),
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;