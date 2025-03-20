![](logo.png)

# Compose Hub for Laravel 

Compose hub is your home for [Laravel](https://laravel.com) packages, application recipes, tools and more.

# Installing Locally

#### Clone the repo

```bash
git clone https://github.com/WyattCast44/laravel-hub.git
```

#### Move into project

```bash
cd compose-hub
```

#### Copy the env file

Make sure you set your local credentials in your `.env` file.

```bash
cp .env.example .env
```

#### Generate APP_KEY

```bash
php artisan key:generate
```

#### Install Composer dependencies

```bash
composer install
```

#### Install NPM dependencies (Optional)

```bash
yarn install
```

#### Create OAuth App

- [Create GitHub OAuth App](https://github.com/settings/applications/new)
- URL:
    - Authorization callback URL = http://hub.test/login/callback
- Add the client ID and secret to `.env` file

```bash
GITHUB_CLIENT_ID=your-id
GITHUB_CLIENT_SECRET=your-secret
GITHUB_REDIRECT="https://hub.test/login/callback"
```

#### Migrate Database

```bash
php artisan migrate --seed
```

# Testing

You can run the application test suite after setup by running the following command:

```bash
php artisan test --parallel
```