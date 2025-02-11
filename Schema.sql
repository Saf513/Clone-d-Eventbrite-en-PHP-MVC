--creation de database 
create database event;


--creation de tableau de users COMMENT
CREATE TABLE users (
    user_id SERIAL PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL CHECK (role IN ('participant', 'organizer', 'admin')),
    full_name VARCHAR(100),
    avatar BYTEA,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


--table founder herite de tableau  users
CREATE TABLE founder (
    bio TEXT,
) INHERITS (users);

--table member herite de tableau users 
CREATE TABLE member (
    phone_number VARCHAR(20),
    address TEXT
) INHERITS (users);

--table des admins herite de users
CREATE TABLE admins (
) INHERITS (users);


--creation de table de category 
CREATE TABLE categories (
    category_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


--creation de table events
CREATE TABLE events (
    event_id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    date TIMESTAMP,
    location VARCHAR(255),
    category_id INT REFERENCES categories(category_id),
    capacity INT,
    price DECIMAL(10, 2),
    organizer_id INT REFERENCES organizers(user_id), -- Référence à l'organisateur
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--creation de table ticket 
CREATE TABLE tickets (
    ticket_id SERIAL PRIMARY KEY,
    event_id INT NOT NULL REFERENCES events(event_id) ON DELETE CASCADE, -- Lien avec l'événement
    ticket_type VARCHAR(50) NOT NULL CHECK (ticket_type IN ('gratuite', 'payant', 'VIP', 'early_bird')), -- Type de billet
    price DECIMAL(10, 2), -- Prix du billet, NULL pour les tickets gratuits
    capacity INT NOT NULL, -- Nombre de billets disponibles
    available INT NOT NULL, -- Nombre de billets restants
    start_date TIMESTAMP, -- Date de début de vente du billet
    end_date TIMESTAMP, -- Date de fin de vente du billet
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Date de création du billet
);


-- creation de table des paiements
CREATE TABLE payments (
    payment_id SERIAL PRIMARY KEY,  -- Identifiant unique pour chaque paiement
    user_id INT NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,  -- Lien avec l'utilisateur
    ticket_id INT NOT NULL REFERENCES tickets(ticket_id) ON DELETE CASCADE,  -- Lien avec le ticket acheté
    amount DECIMAL(10, 2) NOT NULL,  -- Montant payé
    payment_method VARCHAR(50) CHECK (payment_method IN ('Stripe', 'PayPal', 'Carte bancaire', 'Virement')),  -- Méthode de paiement
    payment_status VARCHAR(50) CHECK (payment_status IN ('En attente', 'Confirmé', 'Echoué', 'Annulé')),  -- Statut du paiement
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Date du paiement
    transaction_id VARCHAR(255),  -- Identifiant de la transaction
    refunded BOOLEAN DEFAULT FALSE,  -- Indique si le paiement a été remboursé
    refund_date TIMESTAMP  -- Date du remboursement, si applicable
);


--creation de tableau de notification 
CREATE TABLE notifications (
    notification_id SERIAL PRIMARY KEY,  -- Identifiant unique pour chaque notification
    user_id INT NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,  -- Lien avec l'utilisateur
    message TEXT NOT NULL,  -- Contenu du message de la notification
    notification_type VARCHAR(50) CHECK (notification_type IN ('Evenement', 'Rappel', 'Confirmation', 'Annulation', 'Promotion')),  -- Type de notification
    is_read BOOLEAN DEFAULT FALSE,  -- Indique si la notification a été lue
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Date de création de la notification
    read_at TIMESTAMP  -- Date à laquelle la notification a été lue (si applicable)
);


