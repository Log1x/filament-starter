# Filament Starter

This is my preferred defaults to quickly bootstrap a project utilizing the TALL stack with Filament for the admin panel.

## Features

- 🚀 Quick, clean starting point with an example **Post** model and resource.
- 🧑‍💻 Fully pre-configured and customized Filament panel with best practices in place.
- 💄 TailwindCSS and Vite ready for immediate use.
- 🎨 Pre-bundled Livewire and Alpine for easy extendability.
- ⚡️ SPA-ready in both Filament and the frontend.
- 👷 GitHub Actions workflows for Pint with pre-configured Dependabot for dependencies.
- 🔍️ Easy programmatic SEO using [romanzipp/laravel-seo](https://github.com/romanzipp/Laravel-SEO).
- 📝 Automatic sitemap generation using [spatie/laravel-sitemap](https://github.com/spatie/laravel-sitemap).

## Requirements

Make sure all dependencies have been installed before moving on:

- [PHP](https://secure.php.net/manual/en/install.php) >= 8.1
- [Composer](https://getcomposer.org/download/)
- [Node.js](http://nodejs.org/) >= 18
- [Yarn](https://yarnpkg.com/en/docs/install)

## Getting Started

Start by cloning the Filament Starter repository and initializing the `.env` file:

```sh
git clone --depth=1 git@github.com:log1x/filament-starter.git
cd filament-starter
cp .env.example .env
composer install
php artisan key:generate
```

After `.env` is configured, you can proceed to seed the database:

```sh
$ php artisan migrate:fresh --seed
```

Once the database is seeded, you can login at `/admin` using the default admin user:

```
Username: admin
Password: admin
```

![Filament Screenshot](https://i.imgur.com/Zi1XGMd.png)

### Build Assets

The project assets are compiled using Vite. This can be done by installing the dependencies and running the build command with Yarn.

```sh
$ yarn install
$ yarn build
```

## Bug Reports

If you discover a bug in Filament Starter, please [open an issue](https://github.com/log1x/filament-starter/issues).

## Contributing

Contributing whether it be through PRs, reporting an issue, or suggesting an idea is encouraged and appreciated.

## License

Filament Starter is provided under the [MIT License](LICENSE.md).
