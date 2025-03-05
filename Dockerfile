FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm@latest

WORKDIR /usr/src/quiz-ai

# Sao chép file từ host vào container
COPY . .

# Cài đặt các dependencies của PHP và Node.js
RUN composer install --no-dev --optimize-autoloader && \
    npm install && npm run build

# Cấp quyền cho storage và bootstrap/cache
RUN chown -R www-data:www-data /usr/src/quiz-ai/storage /usr/src/quiz-ai/bootstrap/cache

EXPOSE 8000

# Chạy Laravel
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=8000 & npm run dev"]
