# Usar la imagen oficial de PHP con Apache
FROM php:8.3-apache

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el contenido del directorio actual al contenedor
COPY . /var/www/html

# Instalar extensiones necesarias para PHP (PDO y MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Cambiar permisos para que Apache pueda acceder
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Exponer el puerto 80 de Apache
EXPOSE 80








