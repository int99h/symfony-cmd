FROM php:8.0-alpine as builder

### Arguments
ARG BUILD_ENV
### Add env
ENV SYMFONY_ENV=${BUILD_ENV:-dev}

### Copy code
ADD --chown=www-data:www-data . /tmp/app

### Build code
USER www-data
RUN if [ "$SYMFONY_ENV" = "prod" ] ; \
    then cd /var/www/app && composer install --no-dev -n -q -o --no-suggest --no-scripts --no-progress; \
    else cd /var/www/app && composer install -n -q -o --no-scripts; \
    fi

### Put code to clear image
FROM php:8.0-alpine
COPY --from=builder /tmp/app /app
CMD /bin/true
