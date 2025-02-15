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
    bio TEXT
) INHERITS (users);

ALTER TABLE founder ADD PRIMARY KEY (user_id);

--table member herite de tableau users 
CREATE TABLE member (
    phone_number VARCHAR(20),
    address TEXT
) INHERITS (users);

ALTER TABLE member ADD PRIMARY KEY (user_id);

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
    founder_id INT REFERENCES founder(user_id), -- Référence à l'organisateur
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

Alter Table tickets ADD member_id INT NOT NULL REFERENCES member (user_id) ON DELETE CASCADE;


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



-- Insert 3 users into the 'users' table
INSERT INTO admins (email, password, role, full_name)
VALUES
    ('john.doe@example.com', 'password123', 'participant', 'John Doe'),
    ('jane.smith@example.com', 'securepassword', 'organizer', 'Jane Smith'),
    ('admin.user@example.com', 'adminpassword', 'admin', 'Admin User');


-- Insert 3 founders into the 'founder' table
INSERT INTO founder (bio, user_id, email, password, role, full_name)
VALUES
    ('Founder of Tech Innovations, passionate about AI and startups.', 1, 'tech.founder@example.com', 'techpassword', 'organizer', 'Alice Thompson'),
    ('Experienced in event management, loves organizing large conferences.', 2, 'event.maker@example.com', 'eventpassword', 'organizer', 'Bob Johnson'),
    ('Entrepreneur with over 10 years of experience in the entertainment industry.', 3, 'entertainment.founder@example.com', 'entertainmentpassword', 'organizer', 'Charlie Lee');



INSERT INTO categories (name, description)
VALUES
    ('Music', 'Events related to music performances, concerts, and festivals.'),
    ('Technology', 'Events focusing on technology, innovation, and development.'),
    ('Education', 'Workshops, seminars, and conferences for educational purposes.'),
    ('Art', 'Art exhibitions, galleries, and creative workshops.'),
    ('Food & Drink', 'Events related to food festivals, tastings, and cooking classes.'),
    ('Sports', 'Sports events, tournaments, and physical activities.'),
    ('Health & Wellness', 'Events focused on fitness, health, and well-being.'),
    ('Business', 'Business conferences, networking events, and professional gatherings.');


-- Insert data into the 'events' table
INSERT INTO events (title, description, date, location, category_id, capacity, price, founder_id)
VALUES
    ('Rock Concert 2025', 'A live performance by popular rock bands.', '2025-06-15 20:00:00', 'Madison Square Garden, NYC', 1, 500, 100.00, 1),
    ('Tech Innovations Expo', 'Explore the latest in tech, gadgets, and innovation.', '2025-07-10 09:00:00', 'Silicon Valley Convention Center', 2, 100, 150.00, 2),
    ('AI in Education Conference', 'Discussing the role of AI in transforming education.', '2025-08-20 10:00:00', 'Harvard University', 3, 300, 75.00, 3),
    ('Art Gala 2025', 'An exclusive art exhibition featuring renowned artists.', '2025-09-25 18:00:00', 'The Louvre, Paris', 4, 200, 250.00, 3),
    ('International Food Festival', 'Experience food from around the world.', '2025-10-05 12:00:00', 'Berlin City Center', 5, 200, 40.00, 1),
    ('Summer Basketball Tournament', 'A thrilling basketball tournament with top teams.', '2025-11-01 14:00:00', 'Los Angeles Sports Arena', 6, 150, 25.00, 2),
    ('Yoga and Wellness Retreat', 'A relaxing weekend focused on yoga and wellness.', '2025-12-12 08:00:00', 'Bali Retreat Center', 7, 100, 300.00, 3),
    ('Global Business Summit', 'Networking and keynotes from the world top business leaders.', '2026-01-18 09:00:00', 'New York Hilton', 8, 400, 500.00, 2);


-- Insert tickets
INSERT INTO tickets (event_id, ticket_type, price, capacity, available, start_date, end_date, member_id)
VALUES
    (30, 'gratuite', NULL, 500, 500, '2025-01-01 00:00:00', '2025-06-15 20:00:00', 16),  -- Free tickets
    (32, 'payant', 100.00, 1000, 1000, '2025-01-01 00:00:00', '2025-06-15 20:00:00', 16),  -- Paid tickets
    (33, 'payant', 250.00, 100, 100, '2025-01-01 00:00:00', '2025-06-15 20:00:00', 16),  -- VIP tickets
    (32, 'payant', 75.00, 200, 200, '2025-01-01 00:00:00', '2025-06-01 00:00:00', 17);  -- Early Bird tickets