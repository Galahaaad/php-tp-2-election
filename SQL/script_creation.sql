CREATE TABLE groupes (
                         id INT PRIMARY KEY AUTO_INCREMENT,
                         nom VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE personnes (
                           id INT PRIMARY KEY AUTO_INCREMENT,
                           prenom VARCHAR(100) NOT NULL,
                           nom VARCHAR(100) NOT NULL,
                           groupe_id INT,
                           FOREIGN KEY (groupe_id) REFERENCES groupes(id) ON DELETE CASCADE
);

CREATE TABLE elections (
                           id INT PRIMARY KEY AUTO_INCREMENT,
                           groupe_id INT,
                           tour INT DEFAULT 1,
                           cloture BOOLEAN DEFAULT FALSE,
                           FOREIGN KEY (groupe_id) REFERENCES groupes(id) ON DELETE CASCADE
);

CREATE TABLE votes (
                       id INT PRIMARY KEY AUTO_INCREMENT,
                       election_id INT,
                       votant_id INT,
                       candidat_id INT,
                       type_vote ENUM('valide', 'blanc', 'nul') DEFAULT 'valide',
                       FOREIGN KEY (election_id) REFERENCES elections(id) ON DELETE CASCADE,
                       FOREIGN KEY (votant_id) REFERENCES personnes(id) ON DELETE CASCADE,
                       FOREIGN KEY (candidat_id) REFERENCES personnes(id) ON DELETE CASCADE
);