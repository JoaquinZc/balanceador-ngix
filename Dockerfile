FROM php:apache
RUN apt-get update && apt-get upgrade -y
RUN apt-get install php-mysql