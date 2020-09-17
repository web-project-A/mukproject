#!/bin/bash

# apply migrations onto db
php artisan migrate

# start app
php artisan serve --host=0.0.0.0
