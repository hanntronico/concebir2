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

select usuario_id, usuario_nombre as nombre, usuario_apellido as apellido, usuario_email as email, usuario_clave, usuario_dni, perfil_id 
from usuario where perfil_id = 2;

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

SELECT sede.sede_id, sede_nombre, usuariosede_id
from sede 
inner join usuariosede on usuariosede.sede_id = sede.sede_id		
and usuariosede.usuario_id = 44 and usuariosede_activo = 1
where sede_activo = 1


-- select sede_id, sede_nombre, 
-- 			 sede_img as img, 
-- 			 sede_nombrecorto as nomcorto, 
-- 			 sede_activo as act, sede_eliminado as del, 
-- 			 sede_fechareg as fecreg 
-- from sede;

-- select * from horario where usuario_id = 13;

-- select * from usuarioespecialidad;
-- select * from usuariosede;






