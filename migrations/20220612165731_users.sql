-- migrate:up
CREATE TABLE users (
    id int AUTO_INCREMENT,
    email varchar(256) UNIQUE NOT NULL, 
    name varchar(100) NOT NULL,
    password varchar(256) NOT NULL, 
    role int,
    PRIMARY KEY(id),
    FOREIGN KEY(role) REFERENCES roles(id) ON DELETE CASCADE
);

-- migrate:down
DROP TABLE users;

