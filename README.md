Elasticsearch PHP Thrift transport client
========================

Low-level Elasticsearch Thrift transport plugin. The library is compatible with Elasticsearch 1.3.X

## Requirements

* Apache Thrift 0.9 or higher
* Elasticsearch 1.0.0 or higher with Thrift transport plugin

[https://github.com/elasticsearch/elasticsearch-transport-thrift]

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
require_once 'vendor/autoload.php';

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

### Index

```php
require_once 'vendor/autoload.php';

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

var_dump($result);
```

## Todo

1. Advanced DSL
2. Mapping feature
3. Cluster management