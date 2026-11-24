PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS order_product;
DROP TABLE IF EXISTS "order";
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS client;
DROP TABLE IF EXISTS shop;

CREATE TABLE shop (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    address TEXT NOT NULL
);

CREATE TABLE client (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    phone TEXT NOT NULL,
    name TEXT NOT NULL
);

CREATE TABLE product (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    price REAL NOT NULL,
    count INTEGER NOT NULL,
    shop_id INTEGER NOT NULL,
    FOREIGN KEY (shop_id) REFERENCES shop (id)
);

CREATE TABLE "order" (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    created_at TEXT NOT NULL,
    client_id INTEGER NOT NULL,
    shop_id INTEGER NOT NULL,
    FOREIGN KEY (client_id) REFERENCES client (id),
    FOREIGN KEY (shop_id) REFERENCES shop (id)
);

CREATE TABLE order_product (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    order_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    price REAL NOT NULL,
    FOREIGN KEY (order_id) REFERENCES "order" (id),
    FOREIGN KEY (product_id) REFERENCES product (id)
);

INSERT INTO shop (name, address) VALUES
    ('Магазин на Ленина', 'ул. Ленина, 10'),
    ('Техника Плюс', 'пр. Мира, 25'),
    ('Дом Быта', 'ул. Гагарина, 5'),
    ('Северный', 'ул. Полярная, 7'),
    ('Центральный', 'пл. Революции, 1');

INSERT INTO client (phone, name) VALUES
    ('+7 900 111-11-11', 'Иванов Иван'),
    ('+7 900 222-22-22', 'Петрова Мария'),
    ('+7 900 333-33-33', 'Сидоров Алексей'),
    ('+7 900 444-44-44', 'Кузнецова Ольга'),
    ('+7 900 555-55-55', 'Смирнов Дмитрий');

INSERT INTO product (name, price, count, shop_id) VALUES
    ('Ноутбук', 50000, 10, 1),
    ('Смартфон', 30000, 15, 1),
    ('Пылесос', 12000, 8, 2),
    ('Чайник', 2500, 20, 3),
    ('Наушники', 4000, 12, 4);

INSERT INTO "order" (created_at, client_id, shop_id) VALUES
    ('2025-01-05 10:00:00', 1, 1),
    ('2025-01-06 12:30:00', 2, 2),
    ('2025-01-07 09:15:00', 3, 3),
    ('2025-01-08 18:45:00', 4, 4),
    ('2025-01-09 20:00:00', 5, 1);

INSERT INTO order_product (order_id, product_id, price) VALUES
    (1, 1, 50000),
    (1, 2, 30000),
    (2, 3, 12000),
    (3, 4, 2500),
    (4, 5, 4000),
    (5, 2, 29000);
