ExtendableAction
==========

Laravel packages that allows you to make your laravel project extendable and easy to include new features without touching old
code throgh Extendable Actions .

## Why ExtendableAction?

Having a large codebase and dynamic features leads to a missy codebase with huge maintainability
headache!
This package implements the main concept of WordPress pluggable features by using of Filters and Actions (
See [WordPress Hooks](https://developer.wordpress.org/plugins/hooks/) ) that allow you to expand your codebase in a
pluggable way.

## Installation


1. Install via composer

```bash
$ composer require attia-ahmed/extendable-action
```

or add it by hand to your `composer.json` file.

2. Publish the config file with:

```bash
php artisan vendor:publish --provider="AttiaAhmed\ExtendableAction\ExtendableActionBaseServiceProvider"
```

## Usage

1. make your extendable action:

Which is the main functionality that needs to be extended. You can make your extendable action by
extending `ExtendableAction` class and define the ```run``` method that take any number of parameters (will be modified
by filters) and return result (will be modified by actions) then it will be called as Invokable Class
Example:

```php
class ExampleExtendableAction extends ExtendableAction
{
    public function run($name)
    {
        return "Hello " . $name;
    }
}
```

2. make your filters:

Which are classes that modifies the `ExtendableAction` input parameters or do some logic/check before running the main
functionality. You can make your Filter by extending `Filter` class and override the ```apply``` method that
takes ```run``` method parameters of `ExtendableAction` as an array and returns array of parameters to be modified with
another filters or to be passed to main `ExtendableAction`
Example:

```php
class ExampleFilter extends Filter
{
    public function apply(array $args): array
    {
        $args["name"] = "Mr. " . $args["name"];
        return $args;
    }
}
```

3. make your actions:

Which are classes that modifies the `ExtendableAction` result or do some logic/check after running the main
functionality. You can make your Action by extending `Action` class and override the ```apply``` method that takes the
result of```run``` method of `ExtendableAction`  and returns new result to be modified with another actions or to be
final return result of `ExtendableAction` functionality. Example:

```php
class ExampleAction extends Action
{
    public function apply($result)
    {
        return "<h1>{$result}</h1>";
    }
}
```

4. Link your Filters and Actions to your Extendable action :

You can link your Filters and Action to your Extendable Action by adding new element to `extendable-action.php`
or by your custom implementation by overriding ```getFilters``` and ```getFilters``` of ```ExtendableAction``` class
Example `extendable-action.php`:

```php
return [
    ExampleExtendableAction::class => [
        "filters" => [
            ExampleFilter::class
        ],
        "actions" => [
            ExampleAction::class
        ]
    ],
];
```

5. Call your Extendable action :

```ExtendableAction``` is an Invokable Class and can be called by as one of following examples:


```php
//RECOMMENDED so it automatically be executed it while injecting its dependencies
$result = app(ExampleExtendableAction::class)(...$args);
```
or
```php
$result = (new ExampleExtendableAction())(...$args);
```

# Usage Notes

## *⚠️This package is a proof of concept and IS NOT READY for production.⚠️*

