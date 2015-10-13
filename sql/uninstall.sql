
--
-- Suppression de la table des options
--
DROP TABLE IF EXISTS `mod_mui_opt`;

--
-- Suppression des entrées dans la table topology
--
DELETE FROM `topology` WHERE `topology_page` = 10;
DELETE FROM `topology` WHERE `topology_page` = 1002;
DELETE FROM `topology` WHERE `topology_page` = 100201;
DELETE FROM `topology` WHERE `topology_page` = 100202;
DELETE FROM `topology` WHERE `topology_page` = 100203;
DELETE FROM `topology` WHERE `topology_page` = 100204;
DELETE FROM `topology` WHERE `topology_page` = 1003;
DELETE FROM `topology` WHERE `topology_page` = 100301;
DELETE FROM `topology` WHERE `topology_page` = 100302;
DELETE FROM `topology` WHERE `topology_page` = 100303;
DELETE FROM `topology` WHERE `topology_page` = 1005;
DELETE FROM `topology` WHERE `topology_page` = 628;

