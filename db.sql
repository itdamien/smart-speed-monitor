-- Cars table
CREATE TABLE cars (
    car_id TEXT PRIMARY KEY,
    owner_name TEXT,
    car_model TEXT
);

-- Locations table
CREATE TABLE locations (
    location_id TEXT PRIMARY KEY,
    road_name TEXT,
    speed_limit INTEGER
);

-- Speed Records table
CREATE TABLE speed_records (
    record_id INTEGER PRIMARY KEY AUTOINCREMENT,
    car_id TEXT,
    location_id TEXT,
    speed_kmh INTEGER,
    timestamp DATETIME,
    violation TEXT,
    FOREIGN KEY (car_id) REFERENCES cars(car_id),
    FOREIGN KEY (location_id) REFERENCES locations(location_id)
);



INSERT INTO cars VALUES
('CAR001','Alice','Toyota Corolla'),
('CAR002','Bob','Honda Civic'),
('CAR003','David','Nissan X-Trail'),
('CAR004','Eric','Toyota Hilux'),
('CAR005','Grace','Hyundai i10');



INSERT INTO locations VALUES
('LOC1','Road_A',50),
('LOC2','Road_B',60),
('LOC3','Road_C',40);



INSERT INTO speed_records (car_id, location_id, speed_kmh, timestamp, violation) VALUES
('CAR001','LOC1',52,'2026-03-18 08:00:12','YES'),
('CAR002','LOC1',45,'2026-03-18 08:01:45','NO'),
('CAR003','LOC2',68,'2026-03-18 08:02:30','YES'),
('CAR004','LOC3',39,'2026-03-18 08:03:10','NO'),
('CAR005','LOC2',72,'2026-03-18 08:04:55','YES'),
('CAR001','LOC1',50,'2026-03-18 08:05:22','NO'),
('CAR002','LOC3',44,'2026-03-18 08:06:40','YES'),
('CAR003','LOC2',58,'2026-03-18 08:07:15','NO'),
('CAR004','LOC1',61,'2026-03-18 08:08:05','YES'),
('CAR005','LOC3',37,'2026-03-18 08:09:33','NO');
