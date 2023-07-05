# ImproviStation

This is a simple Laravel/Vue 3 project, utilizing VScode's devcontainer features.

## TO RUN LOCALLY
Requirements:
* [Docker](https://www.docker.com/)
* [VS Code](https://code.visualstudio.com/)
* openssl 

1. Generate self-signed SSL certs for nginx and place them in /docker/nginx/ssl/

    > openssl genrsa -out nginx.key 2048
    
    > openssl req -new -x509 -key nginx.key -out nginx.crt

2. Copy .env.example to .env

3. Open in VScode, install the devcontainers extension and use the "Reopen in Devcontainer" command.

    When presented with terminal, run: 
    
    > composer install 
    
    > php artisan migrate --seed
    
4. Make an exception for Vite's self-signed SSL certs by visiting `https://[::]:5173/@vite/client` in your browser. After that, the website should be available at `https://localhost`.


Alternatively, if you are already familiar with docker you can use the docker-compose file and configure the project how you like.

Also note that using Docker Desktop is not recommended, as it has many inconsistencies between host platforms and it raises configuration issues.

For more information, please see the [Overview](https://code.visualstudio.com/docs/devcontainers/containers) page for VS Code Dev Containers.
