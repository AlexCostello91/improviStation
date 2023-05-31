This is a laravel project, utilizing VScode's devcontainer features.

Local Development Requirements:
Docker

To run:
Generate SSL certs for nginx and place them in /docker/nginx/ssl/
Open in VScode, install the devcontainers extension and use the "Reopen in Devcontainer" command.


Note, for best results use with the command like version of docker. Docker Desktop has many inconsistencies between host platforms and it raises configuration issues.

Also, note that this project folder will need 1000/1000 permissions on the host, as well as SELinux permissions if applicable. Otherwise your project will be unreachable for the containers.1