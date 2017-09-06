# loader-mapper-pattern
This is a bare-bones example of the "loader-mapper" pattern.

There can be multiple layers on top of this for various reasons. For example, you may inject the mapper in a repository which has some caching functionality.

The reasoning behind building an `entity` like this would be 
 - easier unit testing
 - code reusability when switching datasource technologies
 - I dunno, maybe a few other things? Will update as I find more reasons

## Optional Dependencies for this example
 - [phive](https://github.com/phar-io/phive) to install build tools
 - [phpab](https://github.com/theseer/Autoload)(`phive install phpab`) to generate autoloader
 - [ant](http://ant.apache.org/manual/install.html) to use build.xml targets

```
    ./build/install-tools.sh
    ant
```
##To Run
```    
    php example.php
```