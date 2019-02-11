# vue-symfony

Skeleton setup for vue using symfony and webpack encore.

## Basic setup

```
composer create-project symfony/skeleton vue-symfony
cd vue-symfony
composer require asset
composer require doctrine
composer require router
composer require annotations
composer require encore
composer require form
composer require validator
composer require security-csrf
composer require twig
composer require assets
```

## For development purpose

```
composer require webserver --dev
composer require vardumper --dev
composer require orm-fixtures --dev
composer require cs-fixer --dev
```

## Also some webpack data

```
npm install sass-loader node-sass --save-dev
npm install postcss-loader autoprefixer --save-dev
npm install vue vue-loader vue-template-compiler --save-dev
npm install vue-router vuex --save-dev
```

## Server

```
sf server:start
```

## Database

```
sf doctrine:database:create
sf doctrine:schema:update --force
sf doctrine:fixtures:load
```

## Api docs, using swagger

```
composer require nelmio/api-doc-bundle
```
