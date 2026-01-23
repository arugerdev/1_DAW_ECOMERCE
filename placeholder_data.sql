USE evimerce;

INSERT INTO categories (name) VALUES
('Iluminación Técnica'),          -- id 2
('Cableado y Conectores'),        -- id 3
('Herramientas Eléctricas'),      -- id 4
('Automatización y PLC'),         -- id 5
('Material Eléctrico'),           -- id 6
('Iluminación Decorativa'),       -- id 7
('Componentes Electrónicos');     -- id 8


INSERT INTO products
(is_visible, name, price, short_description, description, stock, on_sale, sale_discound, category)
VALUES

-- ILUMINACIÓN TÉCNICA (2)
(TRUE,'Foco LED Industrial 50W',39.90,'Iluminación profesional',
'Foco LED de alta potencia diseñado para entornos industriales y comerciales. Ofrece una iluminación uniforme, alta eficiencia energética y carcasa de aluminio con disipación térmica optimizada.',45,TRUE,10,2),

(TRUE,'Pantalla LED Estanca IP65',54.95,'Uso industrial',
'Pantalla LED estanca con protección IP65, ideal para garajes, talleres y zonas húmedas. Luz blanca neutra con bajo consumo y larga vida útil.',30,FALSE,0,2),

(TRUE,'Proyector LED Exterior 100W',69.90,'Alta luminosidad',
'Proyector LED para exteriores con alto flujo lumínico, resistente a la intemperie. Ideal para fachadas, patios y zonas de carga.',25,TRUE,15,2),

-- CABLEADO Y CONECTORES (3)
(TRUE,'Cable Eléctrico Flexible 3x1.5mm² (10m)',18.50,'Instalaciones eléctricas',
'Cable eléctrico flexible de cobre con aislamiento PVC, adecuado para instalaciones domésticas e industriales de baja tensión.',120,FALSE,0,3),

(TRUE,'Bobina Cable UTP Cat6 (50m)',29.99,'Redes y datos',
'Cable de red UTP categoría 6 para instalaciones de datos y comunicaciones. Alta velocidad y baja interferencia.',60,TRUE,10,3),

(TRUE,'Conectores WAGO Compact (Pack 20)',12.90,'Conexión rápida',
'Conectores eléctricos de presión para empalmes rápidos y seguros. Apto para conductores rígidos y flexibles.',200,FALSE,0,3),

-- HERRAMIENTAS ELÉCTRICAS (4)
(TRUE,'Multímetro Digital Profesional',34.95,'Medición precisa',
'Multímetro digital con medición de voltaje, corriente, resistencia y continuidad. Pantalla LCD de alta precisión.',80,TRUE,10,4),

(TRUE,'Pelacables Automático',19.90,'Herramienta eléctrica',
'Herramienta profesional para pelado de cables de forma rápida y precisa sin dañar el conductor.',70,FALSE,0,4),

(TRUE,'Crimpadora Terminales Aislados',24.50,'Conexiones seguras',
'Crimpadora ergonómica para terminales eléctricos aislados. Garantiza conexiones firmes y duraderas.',55,FALSE,0,4),

-- AUTOMATIZACIÓN Y PLC (5)
(TRUE,'PLC Siemens LOGO! 8 12/24RCE',189.00,'Automatización industrial',
'Controlador lógico programable compacto ideal para automatización básica. Incluye entradas digitales, salidas por relé y conectividad Ethernet.',15,TRUE,5,5),

(TRUE,'Fuente Alimentación Carril DIN 24V 5A',39.95,'Uso industrial',
'Fuente de alimentación con montaje en carril DIN, diseñada para sistemas de automatización y control industrial.',40,FALSE,0,5),

(TRUE,'Módulo Relé Industrial 8 Canales',29.90,'Control eléctrico',
'Módulo de relés para control de cargas eléctricas desde PLC o microcontroladores. Aislamiento y alta fiabilidad.',50,FALSE,0,5),

-- MATERIAL ELÉCTRICO (6)
(TRUE,'Interruptor Magnetotérmico 16A',9.95,'Protección eléctrica',
'Interruptor automático magnetotérmico para protección de circuitos eléctricos frente a sobrecargas y cortocircuitos.',150,FALSE,0,6),

(TRUE,'Diferencial 40A 30mA',29.90,'Seguridad eléctrica',
'Interruptor diferencial para protección de personas frente a fugas de corriente. Uso residencial e industrial.',65,TRUE,10,6),

(TRUE,'Caja Estanca IP65',14.50,'Protección instalaciones',
'Caja estanca para protección de conexiones eléctricas en exteriores o ambientes húmedos.',110,FALSE,0,6),

-- ILUMINACIÓN DECORATIVA (7)
(TRUE,'Tira LED 12V Blanco Cálido (5m)',16.95,'Decoración interior',
'Tira LED flexible para iluminación decorativa. Ideal para muebles, estanterías y ambientes cálidos.',90,TRUE,10,7),

(TRUE,'Perfil Aluminio para Tira LED (2m)',11.90,'Instalación LED',
'Perfil de aluminio para montaje y disipación de tiras LED. Incluye difusor opal.',75,FALSE,0,7),

-- COMPONENTES ELECTRÓNICOS (8)
(TRUE,'Kit Termorretráctil Aislante (100 uds)',8.95,'Aislamiento eléctrico',
'Surtido de tubos termorretráctiles para aislamiento y protección de conexiones eléctricas.',300,FALSE,0,8),

(TRUE,'Relé Electromecánico 230V',6.50,'Componente electrónico',
'Relé electromecánico para aplicaciones de control eléctrico y automatización básica.',180,FALSE,0,8);
