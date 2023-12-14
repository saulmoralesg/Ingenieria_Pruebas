TYPE=VIEW
query=select `srefsmi`.`requerimiento`.`clp` AS `clp`,`srefsmi`.`requerimiento`.`grupo` AS `grupo`,`srefsmi`.`requerimiento`.`especialidad` AS `especialidad`,sum(`srefsmi`.`requerimiento`.`excedentea`) AS `excedentea`,sum(`srefsmi`.`requerimiento`.`excedenteh`) AS `excedenteh`,sum(`srefsmi`.`requerimiento`.`faltantea`) AS `faltantea`,sum(`srefsmi`.`requerimiento`.`faltanteh`) AS `faltanteh` from `srefsmi`.`requerimiento` group by `srefsmi`.`requerimiento`.`clp`,`srefsmi`.`requerimiento`.`grupo`,`srefsmi`.`requerimiento`.`especialidad`
md5=7c7cf1400b365c4e2615039673fd7146
updatable=0
algorithm=0
definer_user=root
definer_host=%
suid=2
with_check_option=0
timestamp=2020-01-20 23:07:10
create-version=1
source=SELECT\nrequerimiento.clp,\nrequerimiento.grupo,\nrequerimiento.especialidad,\nsum(excedentea) AS excedentea,\nsum(excedenteh) AS excedenteh,\nsum(faltantea) AS faltantea,\nsum(faltanteh) AS faltanteh\nFROM\nrequerimiento\nGROUP BY\nclp, grupo, especialidad
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `srefsmi`.`requerimiento`.`clp` AS `clp`,`srefsmi`.`requerimiento`.`grupo` AS `grupo`,`srefsmi`.`requerimiento`.`especialidad` AS `especialidad`,sum(`srefsmi`.`requerimiento`.`excedentea`) AS `excedentea`,sum(`srefsmi`.`requerimiento`.`excedenteh`) AS `excedenteh`,sum(`srefsmi`.`requerimiento`.`faltantea`) AS `faltantea`,sum(`srefsmi`.`requerimiento`.`faltanteh`) AS `faltanteh` from `srefsmi`.`requerimiento` group by `srefsmi`.`requerimiento`.`clp`,`srefsmi`.`requerimiento`.`grupo`,`srefsmi`.`requerimiento`.`especialidad`
