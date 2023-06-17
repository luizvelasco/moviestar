CREATE TABLE reviews (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    rating INT,
    review TEXT,
    users_id INT(11) UNSIGNED,
    movies_id INT(11) UNSIGNED,
    Foreign Key (users_id) REFERENCES users(id),
    Foreign Key (movies_id) REFERENCES movies(id)
);