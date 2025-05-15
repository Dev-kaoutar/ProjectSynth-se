-- Création de la base de données
CREATE DATABASE
IF NOT EXISTS GDS;
USE GDS;

-- Table Fournisseur
CREATE TABLE Fournisseur (
    id_fournisseur INT PRIMARY KEY AUTO_INCREMENT,
    nom_fournisseur VARCHAR(255),
    raison_social VARCHAR(255),
    telephone VARCHAR(20),
    email VARCHAR(255),
    adresse VARCHAR(255),
    ville VARCHAR(100),
    date_inscription DATE
);
            
-- Table Client
CREATE TABLE Client (
    id_client INT PRIMARY KEY AUTO_INCREMENT,
    nom_client VARCHAR(255),
    telephone VARCHAR(20),
    email VARCHAR(255),
    adresse VARCHAR(255),
    ville VARCHAR(100),
    date_inscription DATE
);

-- Table User
CREATE TABLE User (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    nom_complet VARCHAR(255),
    email VARCHAR(255),
    mot_de_passe VARCHAR(255)
);

-- Table Article
CREATE TABLE Article (
    id_article INT PRIMARY KEY AUTO_INCREMENT,
    reference VARCHAR(100),
    designation VARCHAR(255),
    marque VARCHAR(100),
    categorie VARCHAR(100),
    quantite_stock INT,
    prix_achat INT,
    prix_vente INT,
    description TEXT.
);

-- Table EntreeStock
CREATE TABLE EntreeStock (
    id_entree INT PRIMARY KEY AUTO_INCREMENT,
    date_entree DATE,
    id_fournisseur INT,
    FOREIGN KEY(id_fournisseur) REFERENCES Fournisseur(id_fournisseur)
);

-- Table LigneEntreeStock
CREATE TABLE LigneEntreeStock (
    id_ligne_entree INT PRIMARY KEY AUTO_INCREMENT,
    quantite INT,
    id_entree INT,
    id_article INT,
    FOREIGN KEY(id_entree) REFERENCES EntreeStock(id_entree),
    FOREIGN KEY(id_article) REFERENCES Article(id_article)
);

-- Table SortieStock
CREATE TABLE SortieStock (
    id_sortie INT PRIMARY KEY AUTO_INCREMENT,
    date_sortie DATE,
    id_client INT,
    FOREIGN KEY(id_client) REFERENCES Client(id_client)
);

-- Table LigneSortieStock
CREATE TABLE LigneSortieStock (
    id_ligne_sortie INT PRIMARY KEY AUTO_INCREMENT,
    quantite INT,
    id_sortie INT,
    id_article INT,
    FOREIGN KEY(id_sortie) REFERENCES SortieStock(id_sortie),
    FOREIGN KEY(id_article) REFERENCES Article(id_article)
);

-- Table Facture
CREATE TABLE Facture (
    id_facture INT PRIMARY KEY AUTO_INCREMENT,
    numero_facture VARCHAR(100),
    date_facture DATE,
    total_ht FLOAT,
    tva FLOAT,
    total_ttc FLOAT,
    mode_paiement VARCHAR(100),
    id_client INT,
    FOREIGN KEY(id_client) REFERENCES Client(id_client)
);

-- Table LigneFacture
CREATE TABLE LigneFacture (
    id_ligne INT PRIMARY KEY AUTO_INCREMENT,
    quantite INT,
    prix_unitaire FLOAT,
    total_ligne FLOAT,
    id_facture INT,
    id_article INT,
    FOREIGN KEY(id_facture) REFERENCES Facture(id_facture),
    FOREIGN KEY(id_article) REFERENCES Article(id_article)
);
