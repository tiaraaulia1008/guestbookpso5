# ==========================================
# STAGE 1: Build Frontend Assets (Node.js)
# ==========================================
FROM node:20-alpine AS frontend-builder
WORKDIR /app

# Copy package.json untuk install dependensi node
COPY package*.json ./
RUN npm install

# Copy seluruh kode untuk melakukan compilation
COPY . .
# Jalankan build sesuai config (Laravel modern biasanya 'npm run build' untuk Vite)
# Jika kamu pakai Laravel lama/Mix, ganti menjadi 'npm run prod'
RUN npm run build

# ==========================================
# STAGE 2: Production Environment (PHP + Apache)
# ==========================================
FROM php:8.2-apache

# Install system dependencies & ekstensi PHP untuk PostgreSQL (Supabase)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Aktifkan mod_rewrite Apache supaya routing web Laravel berfungsi (.htaccess)
RUN a2enmod rewrite

# Ubah Document Root Apache ke folder /public milik Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set working directory di dalam container
WORKDIR /var/www/html

# Copy source code aplikasi Laravel
COPY . .

# Copy hasil build frontend dari STAGE 1 (folder public/build atau public/css/js)
# Sesuaikan jika kamu menggunakan Laravel Mix (biasanya copy public/css dan public/js)
COPY --from=frontend-builder /app/public/build ./public/build

# Install Composer bawaan resmi langsung ke dalam container
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependensi PHP tanpa mode development agar ringan dan cepat
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Atur permissions folder storage dan cache agar Laravel bisa menulis file log/session
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Port default Apache
EXPOSE 80

CMD ["apache2-foreground"]