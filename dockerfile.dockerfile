# Utilise une image officielle PHP avec Apache
FROM php:8.2-apache

# Installe les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip pdo pdo_mysql

# Active mod_rewrite pour Apache
RUN a2enmod rewrite

# Copie les fichiers de ton projet dans le dossier web d'Apache
COPY . /var/www/html/

# Change le propriétaire pour éviter des problèmes de permissions
RUN chown -R www-data:www-data /var/www/html

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installe les dépendances PHP (si tu as composer.json)
RUN composer install --no-dev --optimize-autoloader

# Expose le port 80 pour HTTP
EXPOSE 80

# Commande par défaut pour démarrer Apache en foreground
CMD ["apache2-foreground"]
