TYPE=VIEW
query=select `srefsmi`.`requerimiento`.`del` AS `del`,`srefsmi`.`requerimiento`.`delegoumae` AS `delegoumae`,sum(`srefsmi`.`requerimiento`.`excedentea`) AS `excedentea`,sum(`srefsmi`.`requerimiento`.`excedenteh`) AS `excedenteh`,sum(`srefsmi`.`requerimiento`.`faltantea`) AS `faltantea`,sum(`srefsmi`.`requerimiento`.`faltanteh`) AS `faltanteh`,count(distinct `srefsmi`.`requerimiento`.`clp`) AS `umconr` from `srefsmi`.`requerimiento` group by `srefsmi`.`requerimiento`.`del`
md5=f99ac0a7ffdafd885b7313ac48a4beb1
updatable=0
algorithm=0
definer_user=root
definer_host=%
suid=1
with_check_option=0
timestamp=2020-02-05 19:55:26
create-version=1
source=SELECT\n	`requerimiento`.`del` AS `del`,\n	`requerimiento`.`delegoumae` AS `delegoumae`,	\n	sum(\n		`requerimiento`.`excedentea`\n	)AS `excedentea`,\n	sum(\n		`requerimiento`.`excedenteh`\n	)AS `excedenteh`,\n	sum(\n		`requerimiento`.`faltantea`\n	)AS `faltantea`,\n	sum(\n		`requerimiento`.`faltanteh`\n	)AS `faltanteh`,\nCOUNT(DISTINCT(clp)) AS umconr\nFROM\n	`requerimiento`\nGROUP BY\n	`requerimiento`.`del`
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `srefsmi`.`requerimiento`.`del` AS `del`,`srefsmi`.`requerimiento`.`delegoumae` AS `delegoumae`,sum(`srefsmi`.`requerimiento`.`excedentea`) AS `excedentea`,sum(`srefsmi`.`requerimiento`.`excedenteh`) AS `excedenteh`,sum(`srefsmi`.`requerimiento`.`faltantea`) AS `faltantea`,sum(`srefsmi`.`requerimiento`.`faltanteh`) AS `faltanteh`,count(distinct `srefsmi`.`requerimiento`.`clp`) AS `umconr` from `srefsmi`.`requerimiento` group by `srefsmi`.`requerimiento`.`del`
