## Wiki Browser

### Getting Started

First clone the application:

```bash
git clone https://github.com/donaldp/wiki-browser
```

Install PHP dependencies:

```bash
composer install
```

Install JavaScript dependencies (Optional):

> Run only if you would like to make changes to the front-end

```bash
npm install
```

Rename `.env.example` to `.env` then set the app key by running the following command:

```bash
php artisan key:generate --ansi
```

Create a new Database and configure it in the `.env` then run the `migrate` command:

Run the application!

```bash
php artisan serve
```

> Alternatively, you can use [Laravel Codespace](https://github.com/donaldp/laravel-codespace) on Visual Studio Codespace.

## Security Vulnerabilities

If you discover a security vulnerability within this Application, please send an e-mail to Donald Pakkies via [donaldpakkies@gmail.com](mailto:donaldpakkies@gmail.com). All security vulnerabilities will be promptly addressed.

## License

This Todo application is a open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).