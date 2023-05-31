#Appname

This is a laravel project, utilizing VScode's devcontainer features. It requires docker to run locally.

## TO RUN LOCALLY
Generate SSL certs for nginx and place them in /docker/nginx/ssl/
Copy .env.example to .env
Open in VScode, install the devcontainers extension and use the "Reopen in Devcontainer" command.
When presented with terminal, run: 
> composer install 

> php artisan migrate --seed

> npm run dev


Note, using DOcket Desktop is not recommended, as it has many inconsistencies between host platforms and it raises configuration issues.
