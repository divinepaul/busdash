-- migrate:up
CREATE TABLE bus_stops (
    id int AUTO_INCREMENT,
    name varchar(200) NOT NULL,
    loc_lat DECIMAL(8,6) CHECK(loc_lat IS NULL OR (loc_lat >= -90 AND loc_lat <= 90)),
    loc_long DECIMAL(9,6) CHECK(loc_lat IS NULL OR (loc_long >= -180 AND loc_long <= 180)),
    address TEXT NOT NULL, 
    PRIMARY KEY(id)
);

-- migrate:down
DROP TABLE bus_stops;

