NYTimes-APIs
============

##PHP wrapper for NYTimes APIs.

####Are you a PHP dev? Try out these php bindings for the NYTimes API.

Use the Composer dependency manager to easily include these bindings into your project. In the composer.json file in your root directory add the following require entry:

```
"require" : {
    "amy/nytimes-apis": "dev-master"
}
```

Then run:

```
composer install
```

### NYTimes APIs Currently Supported
* Article Search API

###Documentation
(More thorough documentation to come!)
Creating request response objects are now super easy for PHP devs! Here's an example use for the Article Search API:

```
$search = new ArticleSearch(
    "The key you received upon registering app",
    "YourQuery"
);

$json = $search
           ->filteredQuery('source:("The%20New%20York%20Times")')
           ->beginDate(2013, 12, 20)
           ->query();
```

### Authors and Contributors
Amy Chen (@amy)

### Contact
Reach out to me at ac1084@scarletmail.rutgers.edu
