# BigNumber.php

A PHP package for arbitrary-precision decimal and non-decimal arithmetic inspired by bignumber.js

Installation
----

``` bash
composer require kabbouchi/bignumber
```
## Usage

```php
use KABBOUCHI\BigNumber;

BigNumber::of(123)->plus(12)->div(1234)->toString();

BigNumber::of(1)
  	->div(5)
  	->times(BigNumber::of(10)->pow(9))
  	->div(1.453)
  	->negated()
  	->abs()
  	->toFixed(4);
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
