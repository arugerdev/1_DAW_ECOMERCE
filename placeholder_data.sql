USE evimerce;

INSERT INTO categories (name) VALUES ('Iluminación'),('Decoración'),('Electrónica'),('Hogar'),('Oficina'),('Gaming'),('Jardín'),('Cocina');

INSERT INTO products (is_visible, name, price, short_description, description, stock, on_sale, sale_discound, category) VALUES
(TRUE,'Lámpara LED Minimalista',29.99,'Lámpara moderna','Lámpara LED de diseño minimalista para interiores.',120,TRUE,10,1),
(TRUE,'Lámpara de Escritorio Flex',19.95,'Flexible y compacta','Lámpara ajustable ideal para estudiar o trabajar.',80,FALSE,0,1),
(TRUE,'Guirnalda LED Exterior',14.50,'Decoración jardín','Guirnalda resistente al agua para exteriores.',200,TRUE,15,7),
(TRUE,'Bombilla Smart WiFi',12.99,'Control por app','Bombilla inteligente compatible con Alexa y Google.',150,TRUE,20,3),
(TRUE,'Cuadro Decorativo Abstracto',39.90,'Arte moderno','Cuadro abstracto impreso en lienzo premium.',25,FALSE,0,2),

(TRUE,'Reloj de Pared Vintage',22.00,'Estilo retro','Reloj silencioso con diseño vintage.',40,FALSE,0,2),
(TRUE,'Altavoz Bluetooth',49.99,'Sonido portátil','Altavoz bluetooth con batería de larga duración.',60,TRUE,10,3),
(TRUE,'Teclado Mecánico RGB',89.99,'Gaming RGB','Teclado mecánico con switches azules.',30,TRUE,5,6),
(TRUE,'Ratón Gaming 7200DPI',34.99,'Alta precisión','Ratón ergonómico con iluminación RGB.',45,FALSE,0,6),
(TRUE,'Alfombrilla XL Gaming',19.99,'Superficie grande','Alfombrilla antideslizante tamaño XL.',70,FALSE,0,6),

(TRUE,'Silla Oficina Ergonómica',159.00,'Comodidad total','Silla ergonómica con soporte lumbar.',15,TRUE,20,5),
(TRUE,'Mesa Escritorio Moderna',249.99,'Minimalista','Mesa de escritorio de madera y acero.',10,FALSE,0,5),
(TRUE,'Soporte Monitor Ajustable',39.95,'Mejora postura','Soporte regulable para monitores.',35,FALSE,0,5),
(TRUE,'Organizador de Cables',9.99,'Orden total','Organizador flexible para cables.',200,FALSE,0,5),
(TRUE,'Lámpara Pie Salón',89.00,'Iluminación ambiente','Lámpara de pie elegante para salón.',20,TRUE,15,1),

(TRUE,'Set Cuchillos Cocina',79.90,'Acero inoxidable','Set profesional de cuchillos.',25,TRUE,10,8),
(TRUE,'Sartén Antiadherente',24.50,'Cocina saludable','Sartén sin PFOA.',100,FALSE,0,8),
(TRUE,'Cafetera Italiana',19.99,'Clásica','Cafetera moka de aluminio.',90,FALSE,0,8),
(TRUE,'Tostadora Doble',34.95,'Desayuno rápido','Tostadora con control de tostado.',50,FALSE,0,8),
(TRUE,'Batidora de Mano',29.99,'Potente','Batidora 600W multifunción.',65,TRUE,10,8),

(TRUE,'Maceta Decorativa',12.50,'Interior','Maceta moderna para interior.',120,FALSE,0,7),
(TRUE,'Regadera Metálica',18.90,'Estilo vintage','Regadera decorativa y funcional.',40,FALSE,0,7),
(TRUE,'Luces Solares Jardín',22.99,'Energía solar','Luces LED solares para jardín.',150,TRUE,20,7),
(TRUE,'Barbacoa Portátil',99.00,'Exterior','Barbacoa portátil de carbón.',12,FALSE,0,7),
(TRUE,'Tumbona Plegable',59.90,'Relax','Tumbona ajustable para exterior.',18,TRUE,15,7),

(TRUE,'Espejo Decorativo Redondo',45.00,'Elegante','Espejo decorativo para pared.',22,FALSE,0,2),
(TRUE,'Estantería Modular',129.99,'Almacenaje','Estantería modular de madera.',14,FALSE,0,4),
(TRUE,'Almohada Viscoelástica',29.90,'Descanso','Almohada ergonómica visco.',70,TRUE,10,4),
(TRUE,'Edredón Nórdico',69.00,'Invierno','Edredón térmico premium.',35,FALSE,0,4),
(TRUE,'Difusor Aromas',24.99,'Relajante','Difusor ultrasónico de aromas.',60,TRUE,5,4),

(TRUE,'Cámara Seguridad WiFi',79.99,'Vigilancia','Cámara HD con visión nocturna.',40,TRUE,15,3),
(TRUE,'Enchufe Inteligente',14.99,'Domótica','Controla dispositivos desde el móvil.',90,FALSE,0,3),
(TRUE,'Regleta USB',17.90,'Carga múltiple','Regleta con puertos USB.',110,FALSE,0,3),
(TRUE,'Powerbank 20000mAh',34.95,'Alta capacidad','Batería externa rápida.',55,TRUE,10,3),
(TRUE,'Auriculares Inalámbricos',59.99,'Bluetooth','Auriculares con cancelación pasiva.',65,TRUE,20,3),

(TRUE,'Caja Organizadora',15.00,'Orden','Caja plástica multiuso.',140,FALSE,0,4),
(TRUE,'Perchero Metálico',49.90,'Entrada','Perchero moderno de metal.',18,FALSE,0,4),
(TRUE,'Lámpara Mesilla',19.95,'Dormitorio','Lámpara pequeña y elegante.',85,FALSE,0,1),
(TRUE,'Panel LED RGB',69.99,'Decoración gamer','Paneles LED modulares RGB.',28,TRUE,15,6),
(TRUE,'Soporte Cascos Gaming',24.99,'Organización','Soporte con iluminación RGB.',45,FALSE,0,6);


INSERT INTO customers (name,last_name,email,dni,phone_number,address,city,cp,country,password) VALUES
('Juan','Pérez','juan@test.com','12345678A','600111222','Calle Mayor 1','Madrid','28001','ES','pass1'),
('Laura','Gómez','laura@test.com','87654321B','600333444','Av. Sol 22','Barcelona','08001','ES','pass2'),
('Carlos','Ruiz','carlos@test.com','11223344C','600555666','C/ Luna 8','Valencia','46001','ES','pass3');

INSERT INTO orders (order_number, customer_id, total_amount, status, shipping_method, payment_method, received, create_at) VALUES
('ORD-0001',1,129.24,'paid','standard','card',TRUE, '2026-1-11'),
('ORD-0002',2,59.52,'pending','express','paypal',FALSE, '2026-1-15'),
('ORD-0003',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0005',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0006',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0007',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0008',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0009',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0010',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0011',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0012',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0013',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0014',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0015',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0016',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0017',3,199.53,'paid','standard','card',TRUE, '2026-1-20'),
('ORD-0004',2,91.22,'paid','standard','card',true, '2026-1-15');

INSERT INTO prodToOrder (productId, orderId, quantity, unit_price, total_price) VALUES
(1,1,2,29,58),
(7,1,1,49,49),
(12,2,1,159,159),
(33,3,2,59,118),
(9,3,1,34,34);
