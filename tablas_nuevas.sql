-- CREATE TABLE `horario` (
--   `horario_id` int(11) NOT NULL,
--   `horario_fecha` datetime DEFAULT NULL,
--   `horario_fecha_fin` datetime DEFAULT NULL,
--   `horario_diaini` varchar(20) DEFAULT NULL,
--   `horario_diafin` varchar(20) DEFAULT NULL,
--   `horario_horaini` datetime DEFAULT NULL,
--   `horario_horafin` datetime DEFAULT NULL,
--   `usuario_id` int(11) DEFAULT NULL,
--   `sede_id` int(11) DEFAULT NULL,
--   `horario_fechareg` datetime DEFAULT NULL,
--   `horario_activo` int(11) DEFAULT NULL,
--   `horario_eliminado` int(11) DEFAULT NULL,
--   `usuario_idreg` int(11) DEFAULT NULL,
--   `horario_intervalo` int(11) DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- CREATE TABLE `profesionales` (
--   `_pk_doctor` varchar(255) NOT NULL,
--   `z_timestamp_create` datetime DEFAULT NULL,
--   `z_timestamp_mod` datetime DEFAULT NULL,
--   `name` varchar(255) DEFAULT NULL,
--   `name_ap_pat` varchar(255) DEFAULT NULL,
--   `name_ap_mat` varchar(255) DEFAULT NULL,
--   `especialidad` varchar(255) DEFAULT NULL,
--   `tieneagenda` int(11) DEFAULT NULL,
--   `email` varchar(255) DEFAULT NULL,
--   `esdoctor` int(11) DEFAULT NULL,
--   `horadesde` time DEFAULT NULL,
--   `horahasta` time DEFAULT NULL,
--   `horamodulo` time DEFAULT NULL,
--   `horatexto` varchar(255) DEFAULT NULL,
--   `esbiologo` int(11) DEFAULT NULL,
--   `esobstetra` int(11) DEFAULT NULL,
--   `esobstetraplus` int(11) DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `horario2` (
_pk_horario varchar(255) NOT NULL ,
dia_semana_numero int(11) DEFAULT NULL,
z_timestamp_create datetime DEFAULT NULL, 
z_timestamp_mod datetime DEFAULT NULL,
_fk_doctor varchar(255) NOT NULL,
fechaInicio datetime DEFAULT NULL,
fechaFin datetime DEFAULT NULL,
horaTermino time DEFAULT NULL,
horaInicio time DEFAULT NULL,
diaSemana varchar(100) DEFAULT NULL,
horario1Lunes varchar(100) DEFAULT NULL,
horario2Martes varchar(100) DEFAULT NULL,
horario3Miercoles varchar(100) DEFAULT NULL,
horario4Jueves varchar(100) DEFAULT NULL,
horario5Viernes varchar(100) DEFAULT NULL,
horario6Sabado varchar(100) DEFAULT NULL,
horario7Domingo varchar(100) DEFAULT NULL,
vigencia text DEFAULT NULL,
ubicacion1Lunes varchar(100) DEFAULT NULL,
ubicacion2Martes varchar(100) DEFAULT NULL,
ubicacion3Miercoles varchar(100) DEFAULT NULL,
ubicacion4Jueves varchar(100) DEFAULT NULL,
ubicacion5Viernes varchar(100) DEFAULT NULL,
ubicacion6Sabado varchar(100) DEFAULT NULL,
ubicacion7Domingo varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `bloqueos` (
`_pk_bloqueo` int(11) NOT NULL,
`_fk_doctor` varchar(255) NOT NULL,
`fecha` datetime DEFAULT NULL,
`horaInicio` time DEFAULT NULL,
`horaTermino` time DEFAULT NULL,
`z_timestamp_create` datetime DEFAULT NULL,
`z_timestamp_mod` datetime DEFAULT NULL,
`horarioBloqueo` varchar(100) DEFAULT NULL,
`motivo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `citas2` (
`_pk_cita` int(11) NOT NULL AUTO_INCREMENT,
`_pk_citaUUID` varchar(255) NOT NULL,
`z_timestamp_create` datetime DEFAULT NULL,
`z_timestamp_mod` datetime DEFAULT NULL,
`_fk_Fecha` date NOT NULL, 
`dia` int(11) DEFAULT NULL,
`_fk_medicoTratante` varchar(255) NOT NULL,
`_fk_paciente` int(11) NOT NULL,
`horaInicio` time DEFAULT NULL,
`horaFin` time DEFAULT NULL,
`modulos` int(11) DEFAULT NULL,
`status` varchar(100) DEFAULT NULL,
`notas` varchar(100) DEFAULT NULL,
`diagnostico` varchar(100) DEFAULT NULL,
`statusTexto` varchar(255) DEFAULT NULL,
`cancelada` int(11) DEFAULT NULL,
`urgencia` int(11) DEFAULT NULL,
`tipoCita` varchar(100) DEFAULT NULL,
`origenWEB` int(11) DEFAULT NULL,
`_fk_ubicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `ubicaciones` (
`_pk_ubicacion` int(11) NOT NULL,
`nombre` varchar(255) NOT NULL,
`z_timestamp_create` datetime DEFAULT NULL,
`z_timestamp_mod` datetime DEFAULT NULL,
`direccion` varchar(255) DEFAULT NULL,
`fono` varchar(255) DEFAULT NULL,
`direccion2` varchar(255) DEFAULT NULL,
`comuna` varchar(255) DEFAULT NULL,
`ciudad` varchar(255) DEFAULT NULL,
`sigla` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `status` (
`_pk_status` varchar(255) NOT NULL,
`nomstatus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `status`
  ADD PRIMARY KEY (`_pk_status`);

ALTER TABLE `status`
  MODIFY `_pk_status` int(11) NOT NULL;


ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`_pk_ubicacion`);

ALTER TABLE `ubicaciones`
  MODIFY `_pk_ubicacion` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `bloqueos`
  ADD PRIMARY KEY (`_pk_bloqueo`);

ALTER TABLE `bloqueos`
  MODIFY `_pk_bloqueo` int(11) NOT NULL AUTO_INCREMENT;  


ALTER TABLE `horario2`
  ADD PRIMARY KEY (`_pk_horario`);


ALTER TABLE `citas2`
  ADD PRIMARY KEY (`_pk_cita`,`_pk_citaUUID`);

ALTER TABLE `citas2`
  MODIFY `_pk_cita` int(11) NOT NULL AUTO_INCREMENT; 


INSERT INTO `status`(`_pk_status`, `nomstatus`) VALUES ('STA000000001','Reservado')
INSERT INTO `status`(`_pk_status`, `nomstatus`) VALUES ('STA000000002','Confirmado');
INSERT INTO `status`(`_pk_status`, `nomstatus`) VALUES ('STA000000003','Esperando');
INSERT INTO `status`(`_pk_status`, `nomstatus`) VALUES ('STA000000004','Atendido');
INSERT INTO `status`(`_pk_status`, `nomstatus`) VALUES ('STA000000005','Falta sin aviso');
INSERT INTO `status`(`_pk_status`, `nomstatus`) VALUES ('STA000000006','Falta con aviso');
INSERT INTO `status`(`_pk_status`, `nomstatus`) VALUES ('STA000000007','Sobrecupo');