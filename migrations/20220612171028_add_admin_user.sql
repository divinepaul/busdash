-- migrate:up
INSERT INTO users (
    id,name,email,password,role
) VALUES (1,'admin','admin@busdash.com','$2y$10$FKGUs9fwXa1OlkpkkyopP.p2H5YnZHvbh8RJhEED8uHofFNe96jj.',1);

-- migrate:down
DELETE FROM users
    WHERE email = 'admin@busdash.com';

