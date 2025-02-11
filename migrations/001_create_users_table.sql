CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    role VARCHAR(20) CHECK (role IN ('participant', 'organisateur', 'admin')) NOT NULL,
    full_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    avatar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
