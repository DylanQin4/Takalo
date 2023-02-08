-- MySQL
CREATE DATABASE takalo;
USE takalo;

-- TABLE --
CREATE TABLE client (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    name_client VARCHAR(20) NOT NULL,
    first_name VARCHAR(20),
    contact VARCHAR(14) NOT NULL
);
INSERT INTO client VALUES
    (NULL, 'QIN', 'Dylan', '0224578377'),
    (NULL, 'Jean', 'Jean', '0347896354');


CREATE TABLE user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT REFERENCES client(client_id),
    pass VARCHAR(20) NOT NULL,
    email VARCHAR(25) UNIQUE NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE
);
INSERT INTO user VALUES 
    (NULL, 1, 'admin', 'dylan@gmail.com', TRUE),
    (NULL, 2, '123', 'jean@gmail.com', FALSE);


CREATE TABLE category (
    id_category INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(25) UNIQUE NOT NULL
);
INSERT INTO category VALUES
    (NULL, 'Electronique'),
    (NULL, 'Telephone'),
    (NULL, 'Voiture'),
    (NULL, 'Vetement');

CREATE TABLE object (
    id_object INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT REFERENCES client(client_id),
    id_category INT REFERENCES category(id_category),
    name_object VARCHAR(20) NOT NULL,
    title VARCHAR(20),
    description TEXT,
    estimated_price DECIMAL(10,2)
);
INSERT INTO object VALUES
    (NULL, 1, 1, 'Objet 3', 'Titre', 'Description 3', 2000.01);

CREATE TABLE object_image (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_object INT REFERENCES object(object_id),
    name_file VARCHAR(25) NOT NULL
);

CREATE TABLE exchange (
    id_exchange INT AUTO_INCREMENT PRIMARY KEY,
    id_object1 INT REFERENCES object(object_id),
    id_object2 INT REFERENCES object(object_id),
    sender INT REFERENCES client(client_id),
    receiver INT REFERENCES client(client_id),
    status INT(2) NOT NULL, -- -1(annule), 1(en attente), 11(accepte)
    exchange_date DATETIME
);

CREATE TABLE historyOwner (
    id_history INT AUTO_INCREMENT PRIMARY KEY,
    id_object INT REFERENCES object(object_id),
    id_client1 INT REFERENCES client(client_id),
    id_client2 INT REFERENCES client(client_id),
    ch_date DATETIME
);



