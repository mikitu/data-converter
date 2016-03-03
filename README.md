# DataConverter

DataConverter is a small project that convert a custom data source into a specified structure.
### Version
1.0.0
### Install
------
Clone repository from:
```sh
https://github.com/mikitu/data-converter
```
```sh
composer install
```
### Runing tests
------
```sh
./vendor/bin/phpspec run
```
### Usage

```php
$converter = new DataConverter(new InputDataSource);
$converted = $converter
            ->convertTo(new OutputDataFormat)
            ->getConverted();
var_dump($converted);
```
* DataConverter is constructed with a InputDataSource object which must conform to \App\Contract\DataSourceInterface
* DataConverter::convertTo accept a OutputDataFormat object which conform to \App\Contract\OutputInterface
    * it converts InputDataSource to OutputDataFormat
    * to get the object converted the method DataConverter::getConverted must be called

### TODO
------
* Use Docker php7 container
* Refactor to use advantages of php7
