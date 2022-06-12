-- migrate:up
INSERT INTO roles(id,role) VALUES (1,'admin');
INSERT INTO roles(id,role) VALUES (2,'user');
INSERT INTO roles(id,role) VALUES (3,'driver');

-- migrate:down
DELETE FROM roles WHERE role = 'admin';
DELETE FROM roles WHERE role = 'user';
DELETE FROM roles WHERE role = 'driver';
