-- migrate:up
CREATE TABLE roles (
    id int AUTO_INCREMENT,
    role varchar(100),
    PRIMARY KEY(id)
);


-- migrate:down
DROP TABLE roles;
