use datafill_ot;
select 

ss.K_IDORDER as ORDEN, ss.K_IDCLARO AS ACTIVIDAD,
service.N_TYPE AS TIPO, 
ss.n_cantidad as CANT, 

/*s.N_NAME as ESTACION, */
u.N_NAME as NOMBRE_ING, 
u.N_LASTNAME AS APELLIDO_ING, 
ss.D_DATE_START_P as F_ASIFGNACION, 
ss.D_DATE_FINISH_R as F_CIERRE_ING, 
ss.D_CLARO_F as F_EJECUCION, 
ss.N_ESTADO as ESTADO, 
ss.N_PROYECTO as PROYECTO

from specific_service ss
inner join user u
on ss.K_IDUSER = u.K_IDUSER
inner join site s
on ss.K_IDSITE = s.K_IDSITE
inner join service
on ss.K_IDSERVICE = service.K_IDSERVICE

order by ss.K_IDORDER asc
;