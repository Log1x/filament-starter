# Filament Starter

This is my preferred starting point to quickly bootstrap [TALL stack](https://tallstack.dev/) projects utilizing [Filament](https://filamentphp.com/) for the admin panel.

![Screenshot](https://i.imgur.com/NlYO6yn.png)

## Features

- 🚀 Quick, clean starting point with an example **Post** model and resource.
- 🧑‍💻 Fully pre-configured and [customized](#plugins-used) Filament panel with best practices in place.
- 🎨 Clean, minimally styled frontend powered by Livewire.
- 💄 TailwindCSS and Vite ready for immediate use.
- 👷 Pre-bundled Livewire and Alpine for easy extendability.
- ⚡️ SPA-ready in both Filament and the frontend.
- 🔨 GitHub Actions workflows for Pint with pre-configured Dependabot for dependencies.
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

After `.env` is configured, you can proceed to migrate & seed the database:

```sh
php artisan migrate:fresh --seed
```

Once the database is seeded, you can login at `/admin` using the default admin user:

```
Username: admin
Password: admin
```

### Build Assets

The project assets are compiled using Vite. This can be done by installing the dependencies and running the build command with Yarn.

```sh
yarn install
yarn build
```

## Plugins Used

The following [Filament plugins](https://filamentphp.com/plugins) come fully implemented and configured out of the box:

| **Plugin**                                                          | **Description**                                    | **Author**                                      |
| :------------------------------------------------------------------ | :------------------------------------------------- | :---------------------------------------------- |
| [Curator](https://github.com/awcodes/filament-curator)              | A beautiful media library.                         | [awcodes](https://github.com/awcodes)           |
| [Gravatar](https://github.com/awcodes/filament-gravatar)            | Easy avatar integration powered by Gravatar.       | [awcodes](https://github.com/awcodes)           |
| [Exceptions](https://github.com/bezhansalleh/filament-exceptions)   | A simple but powerful Exception viewer.            | [bezhansalleh](https://github.com/bezhansalleh) |
| [Jobs Monitor](https://github.com/croustibat/filament-jobs-monitor) | Easily monitor background jobs and their progress. | [croustibat](https://github.com/croustibat)     |
| [Breezy](https://github.com/jeffgreco13/filament-breezy)            | Customizable user profile pages and 2FA support.   | [jeffgreco13](https://github.com/jeffgreco13)   |
| [Peek](https://github.com/pboivin/filament-peek)                    | Quick & efficient front-end previews of resources. | [pboivin](https://github.com/pboivin)           |
| [Logger](https://github.com/z3d0x/filament-logger)                  | Zero-config resource activity logging.             | [z3d0x](https://github.com/z3d0x)               |

## Bug Reports

If you discover a bug in Filament Starter, please [open an issue](https://github.com/log1x/filament-starter/issues).

## Contributing

Contributing whether it be through PRs, reporting an issue, or suggesting an idea is encouraged and appreciated.

## License

Filament Starter is provided under the [MIT License](LICENSE.md).
