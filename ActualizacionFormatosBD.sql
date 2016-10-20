ALTER TABLE `pasantia`.`info_ctrl-atm35-40` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_ctrl-atm35-40` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_ctrl-atm35-40` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_fl-crtl-ate` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_fl-crtl-ate` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_fl-crtl-ate` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_fl-ctrl-prensas-pasta` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_fl-ctrl-prensas-pasta` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_fl-ctrl-prensas-pasta` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_li-001` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_li-001` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_li-001` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_molino1234` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_molino1234` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_molino1234` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_res-1710` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_res-1710` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_res-1710` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_res-1715` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_res-1715` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_res-1710` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_res-1720` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_res-1720` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_res-1720` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_res-1725` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_res-1725` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_res-1725` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_rho-1500` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_rho-1500` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_rho-1500` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_rle-1400` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_rle-1400` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_rle-1400` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_rle-1407` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_rle-1407` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_rle-1407` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_rle-1411` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_rle-1411` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_rle-1411` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_rmo-1100` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_rmo-1100` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_rmo-1100` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_rpp-1902` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_rpp-1902` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_rpp-1902` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_rpr-1300` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_rpr-1300` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_rpr-1300` 
ADD UNIQUE (`campos_clave`);

ALTER TABLE `pasantia`.`info_test` 
ADD `campos_clave` VARCHAR(255) NOT NULL AFTER `observaciones`, 
ADD `fechas_modificaciones` TEXT NULL AFTER `campos_clave`, 
ADD `usuarios_modificaciones` TEXT NULL AFTER `fechas_modificaciones`;
UPDATE `pasantia`.`info_test` info SET `campos_clave`= concat('fecha_registro=',info.fecha_registro_sistema) WHERE `campos_clave`='';
ALTER TABLE `pasantia`.`info_test` 
ADD UNIQUE (`campos_clave`);
