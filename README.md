## How to use array_nested?
### Get deep value in nested array by keys
```php
$arr = ["deep" => ["vervy deep" => 123,],];
$val = array_nested($arr, ["deep", "vervy deep"]); // 123
```

### Set deep value with keys
```php
$arr = [42];
$prev = array_nested($arr, [1, 2, 3], "test"); // null
var_export($arr); // [0=>42, 1=>[2=>[3=>"test"]]]
```
