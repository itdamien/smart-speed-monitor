CREATE DATABASE car_monitor;

USE car_monitor;

CREATE TABLE car_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_id VARCHAR(50),
    speed FLOAT,
    status VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
