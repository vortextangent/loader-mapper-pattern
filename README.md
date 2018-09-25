# loader-mapper Data Persistence Pattern

## What is this?
This is a bare-bones example of the "loader-mapper" pattern.

There can be multiple layers on top of this for various reasons. For example, you may inject the mapper in a repository which has some caching functionality.  This pattern employs the [separation of concerns](https://en.wikipedia.org/wiki/Separation_of_concerns) design principle.

The reasoning behind building an `entity` like this would be 
 - Easy unit testing (because of [DI](https://en.wikipedia.org/wiki/Dependency_injection))
 - Code reusability
 - Ability to easily switch datasource technologies
 - Easier refactoring
 - Less / Easier to manage merge conflicts

## What is a `Loader`?
The loader has the [single responsibility](https://en.wikipedia.org/wiki/Single_responsibility_principle) of loading requested data from a datasource. The data is, usually, returned as a flat array for mapping to a "dumb" object ([POPO](https://en.wikipedia.org/wiki/Plain_old_Java_object)) 

## What is a `Mapper`?
The `Mapper` has the single responsibility of mapping data from the `Loader` into an `Entity` object.
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
