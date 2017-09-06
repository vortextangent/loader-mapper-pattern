# loader-mapper Data Persistence Pattern

## What is this?
This is a bare-bones example of the "loader-mapper" pattern.

There can be multiple layers on top of this for various reasons. For example, you may inject the mapper in a repository which has some caching functionality.

The reasoning behind building an `entity` like this would be 
 - easier unit testing
 - code reusability when switching datasource technologies
 - I dunno, maybe a few other things? Will update as I find more reasons

## What is a `Loader`?
The loader has the [single responsibility](https://en.wikipedia.org/wiki/Single_responsibility_principle) of loading requested data from a datasource.

## What is a `Mapper`?
The `Mapper` has the single responsibility of mapping data from the `Loader` (in the form of an array usually) into an `Entity` object.
This is accomplished via the private `map()` function.
> I prefer to have this function return an `EntityCollection` rather than an array so you will always know what you are dealing with.

## What is an `Entity`?
Generic placeholder for whatever object you are trying to create. (User, Session, Book, etc.)

# To Run
```    
    php example.php
```

# Optional Dependencies
 - [phive](https://github.com/phar-io/phive) to install build tools
 - [phpab](https://github.com/theseer/Autoload)(`phive install phpab`) to generate autoloader
 - [ant](http://ant.apache.org/manual/install.html) to use build.xml targets

``` 
    ./build/install-tools.sh
    ant
```