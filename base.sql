CREATE DATABASE base;

--Structure de la table pour la table `activite`
--

CREATE TABLE activite (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    responsable VARCHAR(255) NOT NULL,
    maximum INT NOT NULL
);

ALTER TABLE activite
ADD nb_inscrits INT DEFAULT 0,
ADD places_restantes INT;
UPDATE activite SET places_restantes = maximum;


--
-- Données pour la table `activite`
--
-- INSERT INTO `activite` (`nom`, `responsable`, `maximum`, `nb_inscrits`, `places_restantes`) VALUES
--('basketball', 'Arthur', 25, 4, 3),
--('handball', 'Junior', 20, 5, 10),
--('volleyball', 'Cedric', 15, 14, 12),
--('natation', 'William', 10, 20, 4);

-- --------------------------------------------------------

--
-- Structure de la table pour la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `activ` varchar(255) NOT NULL,
  `motivation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


--
-- Données pour la table `inscription`
--
-- INSERT INTO `inscription` (`nom`, `prenom`, `date`, `sexe`, `activite`, `motivation`) VALUES
-- ('William', 'david', 'Date', 'masculin', 'football', 'bonjour');

-- --------------------------------------------------------

--
-- Structure de la table pour la table `utilisateurs`
--

CREATE TABLE utilisateurs (
    id INT(11) PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(300) NOT NULL
);
-- Données pour la table `utilisateur`
--INSERT INTO utilisateurs (username, password) VALUES ('admin', 'qqq');





