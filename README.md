# IOManagement-php

<h3>First it all, you should have installed composer in your computer:</h3>
  
  - How to install composer?  [click here](https://linuxhint.com/install-and-use-php-composer-ubuntu-22-04/)

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

  or this if you want to get a short documentation about the tests

  ```php
  php vendor/bin/phpunit --testdox
  ```
