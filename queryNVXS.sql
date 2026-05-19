CREATE TABLE IF NOT EXISTS utenti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    creato_il TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS offerte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utente_id INT NOT NULL,
    prodotto_id INT NOT NULL,
    prezzo_offerta INT NOT NULL,
    stato VARCHAR(20) DEFAULT 'IN ATTESA',
    creato_il TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE utenti ADD COLUMN ruolo VARCHAR(20) DEFAULT 'user';


CREATE TABLE IF NOT EXISTS acquisti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utente_id INT NOT NULL,
    prodotto_id INT NOT NULL,
    prezzo_pagato INT NOT NULL,
    quantita INT DEFAULT 1,
    stato_ordine VARCHAR(50) DEFAULT 'ELABORATO',
    acquistato_il TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE offerte ADD COLUMN taglia VARCHAR(10) DEFAULT 'none';

INSERT INTO utenti(id, username, email, PASSWORD, ruolo) VALUES
(01, "admin", "admin@mail.com", "$2y$10$9XhW5SqFXwO7We9AqIVX1O.OYYa7rZhnrD6HAaKRN7jCTNY.aoF8.", "admin");