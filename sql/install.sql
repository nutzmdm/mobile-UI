--
-- Structure de la table `mod_mui_opt`
--
CREATE TABLE IF NOT EXISTS `mod_mui_opt` (
  `user_id` int(11) NOT NULL,
  `limit_display` int(11) NOT NULL DEFAULT '10',
  `script_execution_tempo` int(11) NOT NULL DEFAULT '1000',
  `theme` TINYINT(10) NOT NULL DEFAULT '1',
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Contenu de la table `topology`
--
INSERT INTO `topology` (`topology_id`, `topology_name`, `topology_icone`, `topology_parent`, `topology_page`, `topology_order`, `topology_group`, `topology_url`, `topology_url_opt`, `topology_popup`, `topology_modules`, `topology_show`, `topology_style_class`, `topology_style_id`, `topology_OnClick`, `readonly`) VALUES
('', 'Home (Mobile-UI)', NULL, NULL, 10, 100, NULL, './modules/mobile-UI/include/home/home.php', NULL, '0', '1', '0', NULL, NULL, NULL, '1'),
('', 'Hosts', '', 10, 1002, 10, NULL, '', '', '0', '1', '0', NULL, NULL, NULL, '1'),
('', 'Unhandled Problems', './img/icones/16x16/server_network_problem.gif', 1002, 100201, 11, NULL, './modules/mobile-UI/include/monitoring/hosts/monitoringHost.php', '&o=h_unhandled', '0', '1', '0', NULL, NULL, NULL, '1'),
('', 'Host Problems', './img/icones/16x16/server_network_problem.gif', 1002, 100202, 12, NULL, './modules/mobile-UI/include/monitoring/hosts/monitoringHost.php', '&o=hpb', '0', '1', '0', NULL, NULL, NULL, '1'),
('', 'Hosts', './img/icones/16x16/server_network.gif', 1002, 100203, 13, NULL, './modules/mobile-UI/include/monitoring/hosts/monitoringHost.php', '&o=h', '0', '1', '0', NULL, NULL, NULL, '1'),
('', 'Host Groups', './img/icones/16x16/clients.gif', 1002, 100204, 14, NULL, './modules/mobile-UI/include/monitoring/hostGroups/monitoringHostGroups.php', '&o=hg', '0', '1', '0', NULL, NULL, NULL, '1'),
('', 'Services', NULL, 10, 1003, 20, NULL, NULL, NULL, '0', '1', '0', NULL, NULL, NULL, '1'),
('', 'Unhandled Problems', './img/icones/16x16/row_delete.gif', 1003, 100301, 21, NULL, './modules/mobile-UI/include/monitoring/services/monitoringService.php', '&o=svc_unhandled', '0', '1', '0', NULL, NULL, NULL, '1'),
('', 'Service Problems', './img/icones/16x16/row_delete.gif', 1003, 100302, 22, NULL, './modules/mobile-UI/include/monitoring/services/monitoringService.php', '&o=svcpb', '0', '1', '0', NULL, NULL, NULL, '1'),
('', 'All Services', './img/icones/16x16/row.gif', 1003, 100303, 23, NULL, './modules/mobile-UI/include/monitoring/services/monitoringService.php', '&o=svc', '0', '1', '0', NULL, NULL, NULL, '1'),
('', 'Options', NULL, 10, 1005, 50, NULL, './modules/mobile-UI/include/options/options.php', NULL, '0', '1', '0', NULL, NULL, NULL, '1'),
('', 'Mobile-UI', NULL, 6, 628, 80, '1', './modules/mobile-UI/include/config/config.php', NULL, '0', '1', '1', NULL, NULL, NULL, '1');