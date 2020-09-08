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
select usuario_nombre, usuario_apellido, usuario_email, usuario_clave from usuario;
-- select * from usuarioespecialidad;
-- select * from usuariosede;






