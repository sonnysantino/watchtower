Watchtower
====

[![Packagist](https://img.shields.io/packagist/v/santiripper/watchtower.svg)]()
[![Packagist](https://img.shields.io/packagist/l/santiripper/watchtower.svg)]()

Watchtower is a Laravel wrapper for sending custom metrics to Amazon AWS CloudWatch in a really pleasant & powerful way.

Be sure to read the [CloudWatch docs](http://docs.aws.amazon.com/aws-sdk-php/v2/guide/service-cloudwatch.html) first.

# Requirements
* PHP >= 5.6
* Laravel >= 5.1
* [Laravel AWS SDK](https://github.com/aws/aws-sdk-php-laravel) >= 3
* An [Amazon AWS Cloudwatch](http://aws.amazon.com/cloudwatch) account

# Installation 

Via Composer by running

```
composer require santiripper/watchtower
```

Or editing composer.json

```json
{
    "require": {
        "santiripper/watchtower" : "dev-master"
    }
}
```

To use the Watchtower Service Provider, you must register the provider when bootstrapping your Laravel application.

Find the providers key in your `config/app.php` and register the Watchtower Service Provider.

```php
'providers' => array(
    // ...
    Santiripper\Watchtower\WatchtowerServiceProvider::class,
)
```

Optional, find the aliases key in your `config/app.php` and register the Watchtower Service Provider.

```php
'aliases' => array(
    // ...
    'Watchtower' => Santiripper\Watchtower\Facade::class`
)
```


# Configuration

Publish the config file by running

```php
php artisan vendor:publish --tag=watchtower
```

It will create the file `app/config/watchtower.php`  

Be sure to configure the [Laravel AWS PHP SDK](https://github.com/aws/aws-sdk-php-laravel) properly (regions & credentials)

# Usage
You can usage it via helper function

```php
cloudwatch()->on(...);
```

Or by facade

```php
Cloudwatch::on(...);
```

## Namespaces

Watchtower supports multiple Cloudwatch namespaces. 
To select the namespace of the metric you have to specify it using the method `on`, for ex if our namespace is called `AwesomeApp`:

```php
$awesomeApp = cloudwatch()->on('AwesomeApp');
```

Facade way:

```php
$awesomeApp = Cloudwatch::on('AwesomeApp');
```

Also you can use the helper shortcut by passing the metric namespace as parameter to the main function:

```php
$awesomeApp = cloudwatch('AwesomeApp');
```

## Adding metrics


```php
$dimensions = [
    cloudwatch()->dimension('NameDimension1', 'ValueDimension2'),
    cloudwatch()->dimension('NameDimension1', 'ValueDimension2'),
];
$awesomeApp->newMetric('MetricName', 14, 'Count', $dimensions);
```

## Setting default dimensions

You can configure default metric dimensions on namespaces that will be included on all related metrics.

Programatically:

```php
$dimension = watchtower()->dimension('name', 'value');
$awesomeApp->addDefaultDimension($dimension);
```

Or by config on the `conig/watchtower.php`  file:

```php
'default_dimensions' => [
    'on' => [
        //Namespace
        'AwesomeApp' => [
            ['name' => 'test_name_1', 'value' => 'test_value_2'],
            ['name' => 'test_name_2', 'value' => 'test_value_2'],
        ],
    ],
],
```

## Sending

By defaults, watchtower queues metrics on memory and sends it automatically when the scripts shutdown.
You can configure this behavior on the watchtower config.

If you need to send the metrics at the moment you can do it by executing the sent method:

```php
cloudwatch()->send();
```

# ToDo
- [ ] Add StatisticValues support
- [ ] Add support to output to aws console
- [ ] Write tests