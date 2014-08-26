Elasticsearch PHP Thrift transport client
========================

Low-level Elasticsearch Thrift transport plugin. The library is compatible with Elasticsearch 1.3.X

## Requirements

* Apache Thrift 0.9 or higher
* Elasticsearch 1.0.0 or higher with Thrift transport plugin

[https://github.com/elasticsearch/elasticsearch-transport-thrift]

## Performance

Official PHP Client


## Usage

1. Install Thrift C++ Transport Extension for **performance** (Optional)

    ```shell
    cd lib/ThriftExt/thrift_protocol
    phpize --clean && phpize
    ./configure
    make
    sudo make install
    ```
2. Create `composer.json`:

    ```json
    {
        "require" : {
            "trk54ylmz/elasticsearch-thrift": "dev-master"
        }
    }
    ```
3. Include `vendor/autoload.php`


### Search

```php
require 'vendor/autoload.php';

$elasticsearch = new Elasticsearch\Client();

$body = '
{
    "query" : {
        "match_all" : {}
    }
}
';

$elasticsearch->setIndex('twitter');
$elasticsearch->setType('users');
$elasticsearch->setBody($body);

$result = $elasticsearch->search();

var_dump($result->hits);
```

### Index a document

```php
$elasticsearch = new Elasticsearch\Client();

$body = array(
    'username' => 'trK54Ylmz',
    'email' => 'tarik@example.com',
    'country' => 'TR',
    'logged' => false
);

$elasticsearch->setIndex('twitter');
$elasticsearch->setType('users');
$elasticsearch->setBody($body);

$result = $elasticsearch->index();
```

### Get a document

```php
$elasticsearch = new Elasticsearch\Client();

$elasticsearch->setIndex('twitter');
$elasticsearch->setType('users');
$elasticsearch->setId('1');

$result = $elasticsearch->get();
```

## Todo

1. Advanced DSL
2. Mapping feature
3. Cluster management
