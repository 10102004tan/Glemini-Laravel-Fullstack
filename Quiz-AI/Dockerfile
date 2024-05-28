FROM php:8.2-cli
WORKDIR /usr/src/quiz-ai

# Install some dependencies
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# extension php pdo_mysql
RUN docker-php-ext-install pdo_mysql

# Sao chép entrypoint script
COPY entrypoint.sh /usr/src/quiz-ai/entrypoint.sh

# Cấp quyền thực thi cho entrypoint script
RUN chmod +x /usr/src/quiz-ai/entrypoint.sh

# Thay đổi lệnh CMD
CMD ["/usr/src/quiz-ai/entrypoint.sh"]
