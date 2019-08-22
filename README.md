[![Build Status](https://travis-ci.org/nationalarchives/ds-wp-plugin-newsletter.svg?branch=develop)](https://travis-ci.org/nationalarchives/ds-wp-plugin-newsletter)

<p align="center">
  <a href="https://www.nationalarchives.gov.uk">
    <img style="display:inline-block;" alt="The National Archives"  src="https://user-images.githubusercontent.com/5245264/63532708-28b47680-c503-11e9-92fa-b2a87ce8ba56.png" width="90" />
  </a>  
</p>

# Digital Service Newsletter Wordpress Plugin
## Usage

```[tna-newsletter]```

### Development machine configuration

**Download the repository.**

  Get the latest files from the repository

  ```sh
  # Download the project on your development machine on your preferred location
  git clone git@github.com:nationalarchives/ds-wp-plugin-newsletter.git
  ```
### Composer dependency management

Composer is used for dependency management, initially for PHPUnit but extending to other dependencies as needed. 

#### Installing Composer

To install Composer, from within the ```ds-wp-plugin-newsletter``` directory open the Terminal and execute this command: 

```curl -sS https://getcomposer.org/installer | php```

This downloads the Composer installer script with ```curl``` and executes it with PHP, resulting in a ```composer.phar``` file (the Composer binary) being placed in the current working directory. 

Having done this follow these steps:

* Type ```sudo mv composer.phar /usr/local/bin/composer``` into the Terminal
* Append this line to your ```~/.bash_profile``` file ```PATH=/usr/local/bin:$PATH```

At this stage you should be able to execute the ```composer``` command in the Terminal to see all the available options.

#### Obtaining dependencies via Composer

Having followed the steps above you will be able to install dependencies by typing ```composer install``` at the Terminal.

### PHPUnit

Having followed the steps under 'Installing Composer' type ```vendor/bin/phpunit -c phpunit.xml``` from within the ```ds-wp-plugin-newsletter``` directory to run Unit Tests for the project.
