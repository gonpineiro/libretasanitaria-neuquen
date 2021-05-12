SELECT
sol.id as id,
wap_te.Documento as dni_te,
wap_te.Genero as genero_te,
wap_te.nombre as nombre_te,
wap_te.Celular as telefono_te,
wap_te.CorreoElectronico as email_te,
wap_te.DomicilioReal as direccion_te,
wap_te.FechaNacimiento as fecha_nac_te,
wap_do.Documento as dni_do,
wap_do.Genero as genero_do,
wap_do.nombre as nombre_do,
wap_do.Celular as telefono_do,
wap_do.CorreoElectronico as email_do,
wap_do.DomicilioReal as direccion_do,
wap_do.FechaNacimiento as fecha_nac_do,
cap.nombre as nombre_capacitador,
cap.apellido as apellido_capacitador,
cap.matricula as matricula,
cap.lugar_capacitacion as lugar_capacitacion,
cap.municipalidad_nqn as municipalidad_nqn,
cap.fecha_capacitacion as fecha_capacitacion,
cap.fecha_alta as fecha_alta_capacitacion,
cap.path_certificado as path_certificado,
sol.tipo_empleo as tipo_empleo,
sol.renovacion as renovacion,
sol.nro_recibo as nro_recibo,
sol.estado as estado,
sol.retiro_en as retiro_en,
sol.fecha_evaluacion as fecha_evaluacion,
sol.fecha_vencimiento as fecha_vencimiento,
sol.observaciones as observaciones,
sol.fecha_alta as fecha_alta_sol,
sol.path_comprobante_pago as path_comprobante_pago,
usu.telefono as usu_telefono,
usu.email as usu_email,
wap_adm.nombre as adm_nombre
FROM libretas_solicitudes sol
LEFT OUTER JOIN (
	dbo.wappersonas as wap_te
	left join libretas_usuarios usu_te ON wap_te.ReferenciaID = usu_te.id_wappersonas
) ON sol.id_usuario_solicitante = usu_te.id
LEFT OUTER JOIN (
	dbo.wappersonas as wap_do
	left join libretas_usuarios usu_do ON wap_do.ReferenciaID = usu_do.id_wappersonas
) ON sol.id_usuario_solicitado = usu_do.id
LEFT OUTER JOIN (
	dbo.wappersonas as wap_adm
	LEFT JOIN libretas_usuarios usu_adm ON wap_adm.ReferenciaID = usu_adm.id_wappersonas
) ON sol.id_usuario_admin = usu_adm.id
LEFT JOIN dbo.libretas_capacitadores cap ON sol.id_capacitador = cap.id
LEFT JOIN dbo.libretas_usuarios usu ON sol.id_usuario_solicitante = usu.id


/*  */
SELECT 
id,
id_wappersonas,
wap.ReferenciaID,
wap.Documento,
wap.Nombre 
FROM dbo.libretas_usuarios usu
LEFT JOIN wappersonas wap ON wap.ReferenciaID  = usu.id_wappersonas 