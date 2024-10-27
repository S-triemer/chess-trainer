CREATE DATABASE IF NOT EXISTS `chess_trainer`;
USE `chess_trainer`;

CREATE TABLE IF NOT EXISTS users (
    user_id varchar(255) not null,
    username varchar(255) UNIQUE,
    password varchar(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    primary key (user_id)
);

CREATE TABLE IF NOT EXISTS openings (
    opening_id VARCHAR(255) not NULL,
    opening_name VARCHAR(255),
    opening_variation_name VARCHAR(255),
    PGN VARCHAR(255),
    primary key (opening_id)
);

CREATE TABLE IF NOT EXISTS cards (
    card_id varchar(255) not null,
    user_id VARCHAR(255),
    opening_id VARCHAR(255),
    lastTimeChecked TIMESTAMP,
    wasCorrect BOOLEAN,
    Foreign Key (user_id) REFERENCES users(user_id),
    Foreign Key (opening_id) REFERENCES openings(opening_id),
    primary key (card_id)
);