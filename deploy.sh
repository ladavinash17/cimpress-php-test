#!/usr/bin/env bash
sudo php bin/console cache:clear --env=prod
sudo php bin/console assets:install --symlink
sudo chown -R www-data:www-data var/cache/
sudo chown -R www-data:www-data var/logs/
sudo chown -R www-data:www-data var/sessions/
sudo chown -R www-data:www-data web/bundles/
