DROP TABLE IF EXISTS carts_products;
DROP TABLE IF EXISTS carts;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS products;

CREATE TABLE IF NOT EXISTS users (
    user_pid INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(25),
    username VARCHAR(25) NOT NULL UNIQUE KEY,
    email VARCHAR(255) NOT NULL UNIQUE KEY,
    password VARCHAR(65) NOT NULL,
    contact VARCHAR(10) NOT NULL
);

CREATE TABLE IF NOT EXISTS carts (
    user_pid INT UNSIGNED PRIMARY KEY,
    total_amount INT UNSIGNED DEFAULT 0,
    total_items INT UNSIGNED DEFAULT 1,
    CONSTRAINT fk_carts_users
        FOREIGN KEY(user_pid)
            REFERENCES users(user_pid)
);

CREATE TABLE IF NOT EXISTS products (
    product_pid INT UNSIGNED PRIMARY KEY,
    price INT UNSIGNED,
    name VARCHAR(50),
    image_url VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS carts_products (
    cart_product_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_carts_products_users
        FOREIGN KEY(user_id)
            REFERENCES users(user_pid),
    CONSTRAINT fk_carts_products_products
        FOREIGN KEY(product_id)
            REFERENCES products(product_pid)
);

INSERT INTO products(product_pid, name, image_url, price) VALUES (1, "Velvet Noir", "IMG/Hazelnut-Mocha-Cafe-Latte-Imperial.jpg", 250);
INSERT INTO products(product_pid, name, image_url, price) VALUES (2, "Midnight Whisper", "IMG/Black Cherry Coffee Float_0.jpg.webp", 250);
INSERT INTO products(product_pid, name, image_url, price) VALUES (3, "Crimson Sunrise", "IMG/ORANGE ZEST COF.jpeg", 250);
INSERT INTO products(product_pid, name, image_url, price) VALUES (4, "Jade Serenity", "IMG/matcha-espresso-fusion1.jpg", 250);
INSERT INTO products(product_pid, name, image_url, price) VALUES (5, "Elysian Dream", "IMG/MILKLAB-Lactose-Free-Dairy-Milk-white-chocolate-and-lavender-latte.jpg", 250);
INSERT INTO products(product_pid, name, image_url, price) VALUES (6, "Ivory Cascade", "IMG/IMG_5210-featured-360x480.webp", 250);
INSERT INTO products(product_pid, name, image_url, price) VALUES (7, "Mocha Mystic", "IMG/Iced_Cafe_Mocha.jpg", 250);
INSERT INTO products(product_pid, name, image_url, price) VALUES (8, "Aeropress", "IMG/aeropress.jpg", 3800);
INSERT INTO products(product_pid, name, image_url, price) VALUES (9, "Hario Cold Brew Maker", "IMG/cold-brew-coffee-pot-lifestyle-1_b5f21298-e2b6-498a-b4ea-8a4685a1e8c4_1200x1200.jpg", 2000);
INSERT INTO products(product_pid, name, image_url, price) VALUES (10, "Aeropress Filters", "IMG/aeropress-filters-2.jpg", 650);
INSERT INTO products(product_pid, name, image_url, price) VALUES (11, "Coffee Grinder", "IMG/coffee grinder.jpeg.webp", 2500);
INSERT INTO products(product_pid, name, image_url, price) VALUES (12, "Hario v60 Natural Filter Paper", "IMG/natural filter paper.webp", 470);
INSERT INTO products(product_pid, name, image_url, price) VALUES (13, "Hario v60 White Filter Paper", "IMG/white filter paper.jpg", 470);
INSERT INTO products(product_pid, name, image_url, price) VALUES (14, "Arabica Beans", "IMG/arabica-coffee-bean-1695031594-7087052.jpeg", 800);
INSERT INTO products(product_pid, name, image_url, price) VALUES (15, "Robusta Beans", "IMG/robusta.jpeg", 650);
INSERT INTO products(product_pid, name, image_url, price) VALUES (16, "Excelsa Beans", "IMG/Arabica-coffee-Beans.jpg", 650);
INSERT INTO products(product_pid, name, image_url, price) VALUES (17, "Liberica Beans", "IMG/illustration-super-close-shot-piece-liberica-coffee-bean_945369-13880.jpg.avif", 700);
