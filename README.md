# Laravel Nova Events
Exposes some simple event functionality within Laravel Nova.

## Installation
Installation for this package is simple, just require the package via composer:

```bash
composer require creode/laravel-nova-events
```

## Usage

### Migrations
Once installed, you will need to run the migrations to create the required database tables:

```bash
php artisan migrate
```

### Configuration
You will also need to publish the config file to set up the required settings:

```bash
php artisan vendor:publish --tag="nova-events-config"
```

This will create a `config/nova-blog.php` file which you can use to configure the package.

### Customising the Events Model
The default Event model can be replaced to allow you to add new features to it within your main application. This can easily be done by changing the model in the `config/nova-events.php` file:

```php
// config/nova-events.php
return [
    ...
    'event_model' => App\NovaEvent::class,
    ...
];
```

### Querying Events
You can make queries on blogs by using the Repository class:

```php
use Creode\LaravelNovaEvents\Repositories\EventRepository;

$eventRepository = new EventRepository();
$events = $eventRepository->all();
```

### Seeding Events
You can seed events using the EventFactory:

```bash
php artisan db:seed --class="Creode\LaravelNovaEvents\Database\Seeders\EventsDatabaseSeeder"
```
