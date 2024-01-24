# Address Parser

A PHP library splits a full address into country, city, street, and postcode.


## Installation
This project can be installed via Composer:
```shell
$ composer require staffnowa/address-parser
```

## How to use
You can use the service as follows:

```
$actualAddress = 'Vilkpėdės g. 12, LT-03151 Vilnius, Lithuania';
$parser = AddressParserFactory::createParser($actualAddress);
$parsedAddress = $parser->parseAddress($actualAddress);

var_dump([
     'country' => $parsedAddress->getCountry(),
     'city' => $parsedAddress->getCity(),
     'street' => $parsedAddress->getStreet(),
     'postocde' => $parsedAddress->getPostcode(),
]);

```

The output of this command will be:
```
array(4) {
  ["country"]=>
  string(2) "LT"
  ["city"]=>
  string(7) "Vilnius"
  ["street"]=>
  string(17) "Vilkpėdės g. 12"
  ["postocde"]=>
  string(5) "03151"
}
```


