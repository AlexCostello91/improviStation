<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:AlexCostello91/improviStation.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('improvistation.co')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '~/ImproviStation')
    ->set('domain', 'improvistation.co')
    ->set('public_path','public')
    ->set('php_version', 8.1)
    ->set('db_type', 'mariadb')
    ->set('db_user', 'deployer')
    ->set('db_name', 'improvistation');

// Hooks
task('build', function () {
    cd('{{release_path}}');
    run('npm install');
    run('npm run build');
});

after('deploy:vendors', 'build');

after('deploy:failed', 'deploy:unlock');
