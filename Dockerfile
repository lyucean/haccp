# Используем официальный PHP-FPM образ
FROM php:8.3-fpm

# Устанавливаем системные зависимости
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libgd-dev \
    libicu-dev \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем Node.js и npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Устанавливаем рабочую директорию
WORKDIR /usr/share/nginx/html

# Копируем composer файлы
COPY composer.json composer.lock ./

# Устанавливаем PHP зависимости
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Копируем остальные файлы
COPY . .

# Устанавливаем права доступа
RUN chown -R www-data:www-data /usr/share/nginx/html \
    && chmod -R 755 /usr/share/nginx/html/storage \
    && chmod -R 755 /usr/share/nginx/html/bootstrap/cache

# Открываем порт 9000 для PHP-FPM
EXPOSE 9000

# Команда запуска PHP-FPM
CMD ["php-fpm"]
