USE sacomici_concebir;
-- select usuario_id,usuario_nombre,usuario_apellido,usuario_email,usuario_clave,usuario_activo,p.perfil_id 
-- from usuario u inner join perfil p on u.perfil_id = p.perfil_id
-- where usuario_activo ='1';

-- select c.cita_id, c.cita_fecha, c.cita_fechareg from cita c order by 1 desc;
-- select * from api_doctores;
-- select * from api_especialidades;
-- select * from api_horas;
-- select * from cita;
-- select * from especialidad;
-- select * from estatus;
-- select * from formapago;
-- select * from horario;
-- select * from horario_trabajo;
-- select * from horario_trabajo_dias;
-- select * from pago;
-- select * from perfil;
-- select * from profesionales;
-- select * from profesionales2;
-- select * from sede;
-- select * from tipoestatus;
-- select * from usuario;
-- select usuario_nombre, usuario_apellido, usuario_email, usuario_clave from usuario;

-- select horario_fecha_fin, horario_diaini, horario_diafin, horario_horaini, horario_horafin, sede_id
-- from horario where usuario_id = 41 and sede_id=2;


-- select * from usuario where perfil_id = 2

-- select usuario_id, usuario_nombre as nombre, 
-- usuario_apellido as apellido, 
-- usuario_email as email, 
-- usuario_clave, perfil_id, usuario_activo as activo
-- from usuario 
-- where perfil_id = 2 
-- and usuario_activo=1 
-- and usuario_eliminado=0;

-- select * from pago;

-- select pago_id as ID, 
-- 			 pago_monto as monto, 
-- 			 pago_activo as act, 
-- 			 pago_eliminado as del,
-- 			 pago_fechareg,
-- 			 pago_fechapago,
-- 			 usuario_id as userid,
-- 			 cita_id as cita, 
-- 			 formapago_id as formapago, 
-- 			 estatus_id as est
-- from pago;

-- select * from especialidad;

-- select horario_id as id, 
-- 			 DATE_FORMAT(horario_fecha, "%Y-%m-%d") as fecha, 
-- 			 horario_fecha_fin as fecfin, 
-- 			 horario_diaini as diaini, 
-- 			 horario_diafin as diafin, 
-- 			 DATE_FORMAT(horario_horaini, "%H:%i:%s") as horaini, 
-- 			 DATE_FORMAT(horario_horafin, "%H:%i:%s") as horafin, 
-- 			 usuario_id as uid, 
-- 			 sede_id as sid,
-- 			 horario_activo as act,
-- 			 horario_eliminado as del
-- from horario where usuario_id = 61
-- and horario_activo=1 and horario_eliminado=0;


-- SELECT sede.sede_id, sede_nombre, usuariosede_id 
-- FROM sede 
-- inner join usuariosede on usuariosede.sede_id = sede.sede_id 
-- and usuario_id=44 and usuariosede_activo = 1 where sede_activo = 1

--/*************************************************************************************/
-- SELECT sede.sede_id, sede_nombre, usuariosede_id
-- from sede 
-- inner join usuariosede on usuariosede.sede_id = sede.sede_id		
-- and usuariosede.usuario_id = 44 and usuariosede_activo = 1
-- where sede_activo = 1
--/*************************************************************************************/





-- select sede_id, sede_nombre, 
-- 			 sede_img as img, 
-- 			 sede_nombrecorto as nomcorto, 
-- 			 sede_activo as act, sede_eliminado as del, 
-- 			 sede_fechareg as fecreg 
-- from sede;

-- select * from horario where usuario_id = 13;

-- select * from usuarioespecialidad;
-- select * from usuariosede;

-- _pk_cita
-- _pk_citaUUID
-- z_timestamp_create
-- z_timestamp_mod
-- _fk_Fecha
-- dia
-- _fk_medicoTratante
-- _fk_paciente
-- horaInicio
-- horaFin
-- modulos
-- status
-- notas
-- diagnostico
-- statusTexto
-- cancelada
-- urgencia
-- tipoCita
-- origenWEB
-- _fk_ubicacion

-- select _pk_cita,
-- _pk_citaUUID,
-- z_timestamp_create,
-- z_timestamp_mod,
-- _fk_Fecha,
-- dia,
-- _fk_medicoTratante,
-- _fk_paciente,
-- horaInicio, horafin, 
-- modulos, status, 
-- notas, diagnostico, 
-- statusTexto, cancelada, 
-- urgencia, diagnostico, 
-- origenWEB, _fk_ubicacion
-- from citas2

-- select * from citas2;

-- SELECT c.cita_id, c.usuario_idmedico, c.usuario_idpaciente, 
-- DATE_FORMAT(c.cita_fecha,'%d/%m/%Y %H:%i:%s') as cita_fecha, 
-- CONCAT(um.usuario_nombre,' ', um.usuario_apellido) AS medico, 
-- CONCAT(up.usuario_nombre,' ', up.usuario_apellido) AS paciente, 
-- e.especialidad_nombre, s.sede_nombre, 
-- DATE_FORMAT(c.cita_fechareg,'%d/%m/%Y %H:%i:%s') as cita_fechareg, c.cita_activo, 
-- IF(c.cita_activo = 1, 'Activo', 'Inactivo') AS estado, 
-- cita_precio, estatus_nombre, estatus.estatus_id 
-- FROM cita c LEFT JOIN sede s ON c.sede_id = s.sede_id 
-- INNER JOIN especialidad e ON c.especialidad_id = e.especialidad_id 
-- INNER JOIN usuario um ON c.usuario_idmedico = um.usuario_id 
-- INNER JOIN usuario up ON c.usuario_idpaciente = up.usuario_id 
-- INNER JOIN estatus on estatus.estatus_id = c.estatus_id 
-- WHERE c.cita_eliminado = '0';

-- select * from profesionales2

-- select _pk_doctor,
-- 			 z_timestamp_create,
-- 	     z_timestamp_mod,
-- 	     name,
-- 	     name_ap_pat,
-- 	     name_ap_mat,
-- 	     especialidad,
-- 	     tieneagenda,
-- 	     email,
-- 	     esdoctor,
-- 	     horadesde,
-- 	     horahasta,
-- 	     horamodulo,
-- 	     horatexto,
-- 	     esbiologo,
-- 	     esobstetra,
-- 	     esobstetraplus    
-- from profesionales2
-- where name_ap_pat like '%delgado%';

-- select * from usuarioespecialidad;

-- select * from horario2 where _fk_doctor = "PRO000000014";
-- select horaInicio from citas2 where _fk_medicoTratante = "PRO000000014";
select horaInicio from citas2 where _fk_medicoTratante = "PRO000000014" 

-- select _pk_cita, 
-- 			 _pk_citaUUID,
-- 			 c.z_timestamp_create,
-- 			 c.z_timestamp_mod,
-- 			 _fk_Fecha,
-- 			 dia,
-- 			 _fk_medicoTratante,
-- 			 _fk_paciente,
-- 			 horaInicio,
-- 			 horaFin,
-- 			 modulos,
-- 			 status,
-- 			 notas,
-- 			 diagnostico,
-- 			 statusTexto,
-- 			 cancelada,
-- 			 urgencia,
-- 			 tipoCita,
-- 			 origenWEB,
-- 			 _fk_ubicacion
-- from citas2 c 
-- LEFT JOIN ubicaciones u ON c._fk_ubicacion = u._pk_ubicacion
-- INNER JOIN profesionales2 p ON c._fk_medicoTratante = p._pk_doctor;
-- INNER JOIN usuario up ON c._fk_paciente = up.usuario_id;

-- SELECT sede.sede_id, sede.sede_nombre, sede.sede_nombrecorto, sede.sede_img 
-- FROM sede 
-- WHERE sede_activo = '1' ORDER BY sede_nombre asc;

-- SELECT sede.sede_id, sede.sede_nombre, sede.sede_nombrecorto, sede.sede_img FROM sede WHERE sede_activo = '1' ORDER BY sede_nombre asc

-- Select * from ubicaciones;

-- Select ubi._pk_ubicacion, 
-- 			 ubi.nombre, 
-- 			 ubi.sigla 
-- from ubicaciones ubi 
-- order by ubi.nombre asc;

-- Select ubi._pk_ubicacion, 
-- 			  ubi.nombre, 
-- 			  ubi.sigla
-- from ubicaciones ubi 
-- where ubi._pk_ubicacion = 'A'

-- SELECT usuario.usuario_id, 
-- 			 usuario.usuario_nombre, 
-- 			 usuario.usuario_apellido, 
-- 			 usuario.usuario_email, 
-- 			 usuario.usuario_clave, 
-- 			 usuario.usuario_dni, 
-- 			 usuario.usuario_celular, 
-- 			 usuario.usuario_img, 
-- 			 usuario.perfil_id, 
-- 			 usuario.usuario_activo,
-- 			 usuario.usuario_eliminado, 
-- 			 usuario.usuario_idreg, 
-- 			 DATE_FORMAT(usuario_fechareg,'%d/%m/%Y %H:%i:%s') as usuario_fechareg
-- FROM usuario INNER JOIN usuariosede ON usuariosede.usuario_id = usuario.usuario_id
-- WHERE usuario_activo = '1' AND perfil_id = '2' 
-- AND usuariosede_activo = '1' 
-- AND usuariosede.sede_id = '' 		

-- select _pk_doctor, 
-- 			 z_timestamp_create, 
-- 			 z_timestamp_mod, 
-- 			 name, 
-- 			 name_ap_pat, 
-- 			 name_ap_mat, 
-- 			 especialidad, 
-- 			 tieneagenda, 
-- 			 email, +´-//741												
-- 			 esdoctor, 
-- 			 horadesde, 
-- 			 horahasta, 
-- 			 horamodulo, 
-- 			 horatexto, 
-- 			 esbiologo, 
-- 			 esobstetra, 
-- 			 esobstetraplus
-- from profesionales2
-- where _pk_doctor='PRO000000020';

-- SELECT ubi._pk_ubicacion, ubi.nombre, ubi.sigla, '0.jpg' as 
-- FROM ubicaciones ubi 
-- ORDER BY ubi.nombre asc


-- select count(*) as total_citas
-- from citas2


-- select count(*) as total_citas
-- from citas2 c 
-- LEFT JOIN ubicaciones u ON c._fk_ubicacion = u._pk_ubicacion
-- INNER JOIN profesionales2 p ON c._fk_medicoTratante = p._pk_doctor;
-- INNER JOIN usuario up ON c._fk_paciente = up.usuario_id;

-- select * from ubicaciones;