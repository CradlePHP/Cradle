The config folder is where you put all arbitrary configuration for you project.
To call on a config you can do the following.

```php
cradle()->packages('global')->config('settings');
```

This will return all the array found in `config/settings.php`. To just return a
particular key you can do the following.

```php
cradle()->packages('global')->config('settings', 'environment');
```

This will return `dev` because if you look into `config/settings.php` that's what
`environment` is set to. You can also write to the config using the following command.

```php
cradle()->packages('global')->config('settings', 'environment', 'production');
```

This will set your project status to production mode.

> Please be sure to `$ chmod -R 777 ./config` or `chmod 777` particular
configs you want writable.

To create an entirely new configuration, you can do so with the following command.

```php
cradle()->packages('global')->config('settings', 'foobar', [
    'foo' => 'bar'
]);
``` 
