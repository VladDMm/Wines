# Folosim o imagine de bază PHP cu Apache
FROM php:8.2-apache
# Instalăm extensia MySQLi
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copiază fișierele site-ului în folderul implicit al Apache
COPY . /var/www/html/

# Expune portul 80 pentru Apache
EXPOSE 80

# Comanda care pornește serverul
CMD ["apache2-foreground"]
