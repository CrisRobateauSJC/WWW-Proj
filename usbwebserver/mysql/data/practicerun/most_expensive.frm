TYPE=VIEW
query=select `practicerun`.`inventory`.`ITEMNO` AS `ITEMNO`,`practicerun`.`inventory`.`ITEMDESC` AS `ITEMDESC`,`practicerun`.`inventory`.`QUANTITY` AS `QUANTITY`,`practicerun`.`inventory`.`PRICE` AS `PRICE`,`practicerun`.`inventory`.`SUPPLIERID` AS `SUPPLIERID`,`practicerun`.`inventory`.`BRAND` AS `BRAND` from `practicerun`.`inventory` order by `practicerun`.`inventory`.`PRICE` desc limit 3
md5=cc5ba1214c3c8acb0f37be18d8440baa
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2024-04-18 19:35:18
create-version=1
source=SELECT *\nFROM INVENTORY \nORDER BY PRICE DESC\nLIMIT 3
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select `practicerun`.`inventory`.`ITEMNO` AS `ITEMNO`,`practicerun`.`inventory`.`ITEMDESC` AS `ITEMDESC`,`practicerun`.`inventory`.`QUANTITY` AS `QUANTITY`,`practicerun`.`inventory`.`PRICE` AS `PRICE`,`practicerun`.`inventory`.`SUPPLIERID` AS `SUPPLIERID`,`practicerun`.`inventory`.`BRAND` AS `BRAND` from `practicerun`.`inventory` order by `practicerun`.`inventory`.`PRICE` desc limit 3
