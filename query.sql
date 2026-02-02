DROP DATABASE evimerce;

CREATE DATABASE evimerce;

USE evimerce;

ALTER DATABASE evimerce CHARACTER
SET
    = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS
    users (
        id INT PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
        username VARCHAR(30) UNIQUE,
        password VARCHAR(60),
        create_at TIMESTAMP NOT NULL DEFAULT NOW(),
        last_login TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

CREATE TABLE IF NOT EXISTS user_sessions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    token VARCHAR(64) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NOT NULL,
    user_agent TEXT,
    ip_address VARCHAR(45),
    is_active TINYINT(1) DEFAULT 1,
    INDEX idx_token (token),
    INDEX idx_user_id (user_id),
    INDEX idx_expires (expires_at),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS
    categories (
        id INT PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
        name VARCHAR(60) NOT NULL UNIQUE,
        create_at TIMESTAMP NOT NULL DEFAULT NOW()
    );

-- Categoria por defecto para capturar cualquier producto
INSERT INTO
    categories (id, name)
VALUES
    (0, "Sin Categoria");

CREATE TABLE IF NOT EXISTS
    products (
        id INT PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
        is_visible BOOLEAN DEFAULT FALSE,
        name VARCHAR(255) NOT NULL,
        price FLOAT NOT NULL DEFAULT 0,
        w_tax_price FLOAT NOT NULL DEFAULT 0,
        description TEXT,
        short_description TEXT (300),
        stock INT NOT NULL DEFAULT 0,
        on_sale BOOLEAN DEFAULT FALSE,
        sale_discound FLOAT DEFAULT 0,
        category INT DEFAULT 0,
        FOREIGN KEY (category) REFERENCES categories (id) ON DELETE SET NULL,
        create_at TIMESTAMP NOT NULL DEFAULT NOW()
    );

CREATE TABLE IF NOT EXISTS
    customers (
        id INT PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
        name VARCHAR(30) NOT NULL,
        last_name VARCHAR(60),
        email VARCHAR(100) NOT NULL,
        dni VARCHAR(10) UNIQUE,
        phone_number VARCHAR(12) NOT NULL,
        address VARCHAR(250) NOT NULL,
        city VARCHAR(100) NOT NULL,
        cp VARCHAR(10) NOT NULL DEFAULT "4400",
        country VARCHAR(2) NOT NULL DEFAULT 'ES',
        password VARCHAR(60),
        create_at TIMESTAMP NOT NULL DEFAULT NOW()
    );

CREATE TABLE IF NOT EXISTS
    orders (
        id INT PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
        order_number VARCHAR(50) UNIQUE,
        customer_id INT NOT NULL,
        total_amount FLOAT NOT NULL DEFAULT 0,
        status VARCHAR(60) NOT NULL DEFAULT "pending",
        shipping_method VARCHAR(50),
        payment_method VARCHAR(50),
        received BOOLEAN NOT NULL DEFAULT FALSE,
        create_at TIMESTAMP NOT NULL DEFAULT NOW(),
        FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE CASCADE
    );

CREATE TABLE IF NOT EXISTS
    refounds (
        id INT PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
        orderId INT NOT NULL UNIQUE,
        refound_date TIMESTAMP NOT NULL DEFAULT NOW(),
        completed BOOLEAN NOT NULL DEFAULT FALSE,
        FOREIGN KEY (orderId) REFERENCES orders (id) ON DELETE CASCADE,
        create_at TIMESTAMP NOT NULL DEFAULT NOW()
    );

CREATE TABLE IF NOT EXISTS
    prodToOrder (
        id INT PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
        productId INT NOT NULL,
        orderId INT NOT NULL,
        quantity INT NOT NULL DEFAULT 1,
        unit_price FLOAT NOT NULL,
        total_price FLOAT NOT NULL,
        FOREIGN KEY (productId) REFERENCES products (id) ON DELETE CASCADE,
        FOREIGN KEY (orderId) REFERENCES orders (id) ON DELETE CASCADE,
        create_at TIMESTAMP NOT NULL DEFAULT NOW()
    );

CREATE TABLE IF NOT EXISTS
    shop (
        id INT AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY,
        name VARCHAR(60) NOT NULL DEFAULT 'EviMerce',
        slogan VARCHAR(120) DEFAULT NULL,
        description TEXT NOT NULL,
        primary_color VARCHAR(20) DEFAULT '#088395',
        secondary_color VARCHAR(20) DEFAULT '#7AB2B2',
        accent_color VARCHAR(20) DEFAULT '#09637E',
        background_color VARCHAR(20) DEFAULT '#EBF4F6',
        text_color VARCHAR(20) DEFAULT '#464e47',
        theme ENUM ('light', 'dark', 'auto') DEFAULT 'light',
        contact_email VARCHAR(120) DEFAULT NULL,
        contact_phone VARCHAR(30) DEFAULT NULL,
        whatsapp VARCHAR(30) DEFAULT NULL,
        address VARCHAR(255) DEFAULT NULL,
        city VARCHAR(80) DEFAULT NULL,
        postal_code VARCHAR(15) DEFAULT NULL,
        country VARCHAR(80) DEFAULT NULL,
        facebook_url VARCHAR(255) DEFAULT NULL,
        instagram_url VARCHAR(255) DEFAULT NULL,
        twitter_url VARCHAR(255) DEFAULT NULL,
        tiktok_url VARCHAR(255) DEFAULT NULL,
        youtube_url VARCHAR(255) DEFAULT NULL,
        meta_title VARCHAR(70) DEFAULT NULL,
        meta_description VARCHAR(160) DEFAULT NULL,
        meta_keywords VARCHAR(255) DEFAULT NULL,
        footer_text VARCHAR(255) DEFAULT NULL,
        copyright_text VARCHAR(255) DEFAULT '© 2026 EviMerce',
        currency VARCHAR(10) DEFAULT 'EUR',
        currency_symbol VARCHAR(5) DEFAULT '€',
        tax_percent DECIMAL(5, 2) DEFAULT 21.00,
        maintenance_mode BOOLEAN DEFAULT FALSE,
        is_active BOOLEAN DEFAULT TRUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

ALTER TABLE products CONVERT TO CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;

ALTER TABLE products MODIFY name VARCHAR(255) CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;

ALTER TABLE products MODIFY description TEXT CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;

ALTER TABLE products MODIFY short_description TEXT (300) CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;

ALTER TABLE shop CONVERT TO CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;

-- admin:admin
INSERT INTO
    users (username, password)
VALUES
    ("admin", "st6rObYN0yR42");

-- enrique:******
INSERT INTO
    users (username, password)
VALUES
    ("enrique", "st16RxGjFMm8k");

INSERT INTO
    shop (
        copyright_text,
        description,
        slogan,
        currency_symbol
    )
VALUES
    (
        '© 2026 EviMerce',
        'Entra en <a href="/admin">/admin</a> para configurar tu tienda!!! <br><br><br> Usuario: admin <br> Contraseña: admin',
        "Una tienda muy chula.",
        '€'
    );

DELIMITER $$

CREATE TRIGGER after_shop_tax_update
AFTER UPDATE ON shop
FOR EACH ROW
BEGIN
    -- Solo ejecutar si cambió el tax_percent
    IF OLD.tax_percent != NEW.tax_percent THEN
        -- Actualizar todos los productos con el nuevo cálculo de impuestos
        UPDATE products 
        SET w_tax_price = ROUND(price * (1 + NEW.tax_percent / 100), 2);
    END IF;
END$$

DELIMITER ;