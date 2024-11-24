FROM php:8.3-apache

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del frontend al contenedor
COPY . /var/www/html

# Cambiar permisos para que Apache pueda acceder
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

