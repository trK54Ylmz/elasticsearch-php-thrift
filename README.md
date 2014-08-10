elasticsearch-php-thrift
========================

ElasticSearch PHP Thrift transport client


## Requirements

* Thrift 0.9 or higher
* ElasticSearch 1.0.0 or higher with Thrift Plugin

[https://github.com/elasticsearch/elasticsearch-transport-thrift]

## Usage

1. Install Thrift C Transport Extension for **performance** (Optional) [compatible with Elasticsearch 1.3.X]
2. Copy src dir in your development path
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