FROM php:8.5.1

# Extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Configuración personalizada de PHP
COPY php.ini /usr/local/etc/php/php.ini

# Código de la aplicación
COPY . /usr/src/evimerce
WORKDIR /usr/src/evimerce

# Puerto HTTP
EXPOSE 80

# Servidor embebido de PHP escuchando en el puerto 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "."]
