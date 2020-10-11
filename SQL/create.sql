CREATE SCHEMA test;

CREATE TABLE t_cars (
    id serial PRIMARY KEY,
    brand varchar(30) NOT NULL,
    model varchar(50) NOT NULL,
    CONSTRAINT t_cars_unique_brand_model UNIQUE(brand, model)
);


INSERT INTO t_cars(brand, model) VALUES
    ('Kia', 'Sorento'),
    ('Chevrolet', 'Tahoe'),
    ('Audi', 'Q7'),
    ('Porsche', 'Cayenne'),
    ('BMW', 'X5'),
    ('Kia', 'Mohave')
RETURNING*
;