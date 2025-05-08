# NexoPOS Core
This package is a separation of the core features of NexoPOS from the POS related features.
All POS features has been removed and only the following are available:

- User Authentication
- Roles Management
- Module Support
- Widget Support
- Settings Support

## Installation
This package is available on packagist and can be installed as a package on a regular laravel installation:

```composer require nexopos/core```

Once it's installed, you'll have to run some of the following command to ensure the package is fully integrated to Laravel.

### Install Filesystem
The package include a command to write filesystem configuration to the filesystem.php. For that you need to run the command:

```
php artisan ns:install
```

### Publishing Configuration / Assets
Before proceeding it's also required to publis the configuration that include basic and necessary configuration for NexoPOS.

```
php artisan vendor:publish --tag nexopos-config
php artisan vendor:publish --tag nexopos-assets
```

### Install Dependency

This product uses various dependencies which has their own configuration. 

#### Laravel Sanctum
As the project relies on Laravel Sanctum, you need to run this command to install (publish) Larvel Sanctum configuration.
Note that the package is already a dependency.

```
php artisan install:api
```

### Installing NexoPOS Core
Similarily to Laravel Sanctum, NexoPOS Core needs some files to be published. Note that here, some of the existing file will be edted by the package as
it needs it to work properly. 

The impacted files are:

- config/filesystems.php
- routes/api.php

```
php artisan ns:install --filesystem --routes
```
This commands will perform two things:

- It will publish the filesystem required to the filesystems.php
- It will update your api.php to trigger an event.

## Authentication
NexoPOS Core uses it's own implementation of authentication. While it's created on top of laravel, it provides more features. Therefore, it's recommended to change the model provider on the config/auth.php. If you're using Laravel 12, you only need to set it using "AUTH_MODEL" on the environment file.

```
AUTH_MODEL = Ns\Models\User;
```

- Sanctum (publish vendors)