# 1. Utiliser une image PHP officielle avec Apache
FROM php:8.2-apache

# 2. Installer les extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 3. Copier le code de ton projet dans le dossier par défaut d'Apache
COPY . /var/www/html/

# 4. Copier le fichier .env si tu en as un
#    (Render permet d'ajouter des secrets .env, tu peux les copier ici)
# COPY .env /var/www/html/.env

# 5. Donner les droits corrects
RUN chown -R www-data:www-data /var/www/html/

# 6. Exposer le port 80 pour le serveur web
EXPOSE 80

# 7. Commande pour démarrer Apache en avant-plan
CMD ["apache2-foreground"]
