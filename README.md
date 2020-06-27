# Blog with tailwind and inertia and laravel

## Installation

After installing the project, run the following command from your project directory:

Installing project dependencies
```bash
composer install
```

Installing and compiling node modules
```bash
// using yarn
yarn && yarn dev
// or using npm
npm install && npm run dev
```

Setting up .env file then setup your database credentials
```bash
cp .env.example .env
```

Running migration with database seed
```bash
php artisan migrate --seed
```

