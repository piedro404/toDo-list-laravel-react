# Use a imagem base do PHP 8.3 com FPM
FROM php:8.3-fpm

# Defina argumentos de construção para o nome de usuário e UID
ARG user=todoList
ARG uid=1000

# Instale as dependências do sistema e Node.js, npm
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Limpe o cache do apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instale as extensões do PHP necessárias
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Obtenha o Composer mais recente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crie um usuário do sistema para rodar o Composer e comandos do Artisan
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Crie diretórios necessários e ajuste as permissões
RUN mkdir -p /var/www/storage/public/usersAvatar && chmod -R gu+w /var/www/storage/public/usersAvatar && \
    chmod -R gu+w /var/www/storage && \
    mkdir -p /var/www/storage/logs && chmod -R gu+w /var/www/storage/logs && \
    mkdir -p /var/www/storage/framework/sessions && chmod -R gu+w /var/www/storage/framework/sessions && \
    mkdir -p /var/www/node_modules && chmod -R gu+w /var/www/node_modules

# Instale e habilite a extensão redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Defina o diretório de trabalho
WORKDIR /var/www

# Copie configurações personalizadas do PHP
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Use o usuário definido para rodar o contêiner
USER $user
