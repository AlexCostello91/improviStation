# ImproviStation

This is a simple Laravel/Vue 3 project, utilizing VScode's devcontainer features.

## TO RUN LOCALLY

Dev Containers require docker. Generate self-signed SSL certs for nginx and place them in /docker/nginx/ssl/

> openssl genrsa -out nginx.key 2048
> openssl req -new -x509 -key nginx.key -out nginx.crt

Copy .env.example to .env

Open in VScode, install the devcontainers extension and use the "Reopen in Devcontainer" command.

When presented with terminal, run: 

> composer install 

> php artisan migrate --seed

> npm run dev

Note that you may need to click the link provided by Vite in the terminal, as your browser might complain about the self-sgned certs. After doing that, the app should be running on `localhost`


Also note that using Docker Desktop is not recommended, as it has many inconsistencies between host platforms and it raises configuration issues.

For more information, please see the [Overview](https://code.visualstudio.com/docs/devcontainers/containers) page for VS Code Dev Containers.
