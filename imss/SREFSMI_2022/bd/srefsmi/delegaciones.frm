TYPE=VIEW
query=select `srefsmi`.`cat_clues`.`del` AS `del`,`srefsmi`.`cat_clues`.`delegoumae` AS `delegoumae`,count(distinct `srefsmi`.`cat_clues`.`clp2`) AS `unidades`,sum(`srefsmi`.`cat_clues`.`registro`) AS `registradas` from `srefsmi`.`cat_clues` group by `srefsmi`.`cat_clues`.`del`
md5=34ae465e4f8cddbadfcc70a2a4f20085
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=1
with_check_option=0
timestamp=2019-12-19 16:16:59
create-version=1
source=select `cat_clues`.`del` AS `del`,`cat_clues`.`delegoumae` AS `delegoumae`,count(distinct `cat_clues`.`clp2`) AS `unidades`,sum(`cat_clues`.`registro`) AS `registradas` from `cat_clues` group by `cat_clues`.`del`
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `srefsmi`.`cat_clues`.`del` AS `del`,`srefsmi`.`cat_clues`.`delegoumae` AS `delegoumae`,count(distinct `srefsmi`.`cat_clues`.`clp2`) AS `unidades`,sum(`srefsmi`.`cat_clues`.`registro`) AS `registradas` from `srefsmi`.`cat_clues` group by `srefsmi`.`cat_clues`.`del`