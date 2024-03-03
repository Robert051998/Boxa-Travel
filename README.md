To start the project
```
./vendor/bin/sail up
```

# Useful Artisan commands
To remove cache run following command
```
 ./vendor/bin/sail artisan cache:clear
```
Run migration with seed
```
./vendor/bin/sail artisan migrate:refresh --seed
```