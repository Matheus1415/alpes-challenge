# =========================
# Dockerfile para Laravel
# =========================

# Usar PHP 8.2 com Apache
FROM php:8.2-apache

# Definir diretório de trabalho
WORKDIR /var/www/html

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip bcmath gd

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar todo o projeto para o container
COPY . .

# Instalar dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Cache Laravel
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Ajustar permissões para storage e bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expor porta 8080 para o Render
EXPOSE 8080

# Comando padrão para rodar a aplicação Laravel
CMD php artisan serve --host=0.0.0.0 --port=8080
