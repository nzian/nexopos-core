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