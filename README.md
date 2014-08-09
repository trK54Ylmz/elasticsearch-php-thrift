elasticsearch-php-thrift
========================

ElasticSearch PHP Thrift transport client


## Requirements

* Thrift 0.9 or higher
* ElasticSearch 1.0.0 or higher with Thrift Plugin

[https://github.com/elasticsearch/elasticsearch-transport-thrift]

## Usage

1. Install Thrift C Transport Extension for performance (Optional)
2. Copy src dir in your development path
3. Include `autoload.php`

```php
require_once 'autoload.php';

$elasticsearch = new Elasticsearch();

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
