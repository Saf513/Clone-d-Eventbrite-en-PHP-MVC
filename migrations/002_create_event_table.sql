CREATE TABLE events (
    id SERIAL PRIMARY KEY,
    organizer_id INT REFERENCES users(id) ON DELETE CASCADE,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(50),
    tags TEXT[],
    location VARCHAR(255),
    date TIMESTAMP NOT NULL,
    price DECIMAL(10,2) CHECK (price >= 0),
    capacity INT CHECK (capacity > 0),
    status VARCHAR(20) CHECK (status IN ('pending', 'approved', 'rejected', 'completed')) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
