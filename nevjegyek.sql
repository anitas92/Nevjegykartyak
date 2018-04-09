
CREATE TABLE IF NOT EXISTS `nevjegyek` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `foto` varchar(64) DEFAULT '''nincskep.png''',
  `nev` varchar(20) DEFAULT NULL,
  `cegnev` varchar(30) DEFAULT NULL,
  `foglalkozas` varchar(8) DEFAULT NULL,
  `Email` varchar(18) DEFAULT NULL,
  `Mobil` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `nevjegyek` (`id`, `foto`, `nev`, `cegnev`, `foglalkozas`, `Email`, `Mobil`) VALUES
(1, 'nincskep.png', 'Orban Lehel', 'Kaniza TrendKft.', 'Mosogato', 'orban@lehel.hu', '(29) 234-0988'),
(2, 'nincskep.png', 'Pal Iza', 'Lufthansa', 'Takarito', 'isa32@lufthansa.de', '(49) 3455-67788'),
(3, '1523274658.jpg', 'Orban Kinga', 'Raniza Kft.', 'Forgato', 'orban@kil.hu', '(20) 234-09808'),
(4, 'nincskep.png', 'Pal Ivan', 'Lufs', 'Takargat', 'ivan32@hansa.de', '(49) 3455-60088'),
(5, 'nincskep.png', 'Nagy Lehel', 'Kaniza TrendKft', 'Motor', 'nagyn@lehel.hu', '(29) 234-0388'),
(6, 'nincskep.png', 'Kis Iza', 'Luftha', 'Takarito', 'se2@lufthansa.de', '(49) 3255-63788'),
(7, '1523274579.jpg', 'Borban Lehel', 'Kaniza TrendKft.', 'Mosogato', 'orban@lehel.hu', '(29) 234-0988'),
(8, 'nincskep.png', 'Paal Iza', 'Lufthansa', 'Takarito', 'isa32@lufthansa.de', '(49) 3455-67788'),
(9, '1523274594.jpg', 'Derban Kinga', 'Raniza Kft.', 'Forgato', 'orban@kil.hu', '(20) 234-09808'),
(10, 'nincskep.png', 'Tal Ivan', 'Lufs', 'Takargat', 'ivan32@hansa.de', '(49) 3455-60088'),
(11, 'nincskep.png', 'Kitegy Lehel', 'Kaniza TrendKft', 'Motor', 'nagyn@lehel.hu', '(29) 234-0388'),
(12, 'nincskep.png', 'REtKis Iza', 'Luftha', 'Takarito', 'se2@lufthansa.de', '(49) 3255-63788'),
(13, '1523274716.jpg', 'Weban Lehel', 'Kaniza TrendKft.', 'Mosogato', 'orban@lehel.hu', '(29) 234-0988'),
(14, '1523274690.jpg', 'Pal Izaura', 'Lufthansa', 'Takarito', 'isa32@lufthansa.de', '(49) 3455-67788'),
(15, 'nincskep.png', 'Cerban Kingacska', 'Raniza Kft.', 'Forgato', 'orban@kil.hu', '(20) 234-02808'),
(16, '1523274632.jpg', 'Magyal Ivan', 'Lufs', 'Takargat', 'ivan32@hansa.de', '(49) 3455-60088'),
(17, '1523274732.jpg', 'Nagyos Lehel', 'Kaniza TrendKft', 'Motor', 'nagyn@lehel.hu', '(29) 234-0388'),
(18, '1523274614.jpg', 'Kiscike Iza', 'Luftha', 'Takarito', 'se2@lufthansa.de', '(49) 3255-63788'),
(19, 'nincskep.png', 'On Lerel', 'Kaniza TrendKft.', 'Mosogato', 'orban@lehel.hu', '(29) 234-0988'),
(20, 'nincskep.png', 'Pal Iraza', 'Lufthansa', 'Takarito', 'isa32@lufthansa.de', '(49) 3455-67788'),
(21, 'nincskep.png', 'Orban Keaga', 'Raniza Kft.', 'Forgato', 'orban@kil.hu', '(20) 234-09808'),
(22, '1523274752.jpg', 'Pal Idevan', 'Lufs', 'Takargat', 'ivan32@hansa.de', '(49) 3455-60088'),
(23, 'nincskep.png', 'Deragy hcerel', 'Kaniza TrendKft', 'Motor', 'nagyn@lehel.hu', '(29) 234-0388'),
(24, 'nincskep.png', 'Retis Iza', 'Luftha', 'Takarito', 'se2@lufthansa.de', '(49) 3255-63788'),
(27, '1523274538.jpg', 'Augustus Zerfas', 'Siemens', NULL, 'aug@cdsim.com', '(44) 1223 34555');
COMMIT;

