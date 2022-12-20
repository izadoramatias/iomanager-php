# IOManagement-php

<h3>First it all, you should have installed composer and phpunit in your computer:</h3>
  
  - Install composer:
    How to install composer?  [click here](https://linuxhint.com/install-and-use-php-composer-ubuntu-22-04/)

  - Install phpunit on Linux:
    ```php
    composer require --dev phpunit/phpunit
    ```

<hr>

### After you have installed the composer, follow the next steps:

- Install composer dependencies:
  
  ```php
    composer install
  ```

- Run php built-in server:
  
  ```php
    php -S localhost:port -t public/
  ```
  
- Run the tests (you should be at the root of the project):

  ```php
  php vendor/bin/phpunit
  ```

  or

  ```php
  php vendor/bin/phpunit --testdox
  ```
