CREATE TABLE billets (
    id SERIAL PRIMARY KEY,
    participant_id INT NOT NULL,
    evenement_id INT NOT NULL,
    type VARCHAR(50) CHECK (type IN ('gratuit', 'payant', 'VIP', 'early_bird')),
    prix DECIMAL(10,2) NOT NULL,
    statut VARCHAR(20) CHECK (statut IN ('actif', 'annulé', 'remboursé')) DEFAULT 'actif',
    date_achat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (participant_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (evenement_id) REFERENCES events(id) ON DELETE CASCADE
);