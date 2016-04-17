[![travis](https://travis-ci.org/lukaszmakuch/property-setter.svg)](https://travis-ci.org/lukaszmakuch/property-setter)
# PropertySetter
Sets properties of already existing objects.
## Usage
### Different setters
#### PropertySetter
Describes how to use any property setter.
```php
use lukaszmakuch\PropertySetter\PropertySetter;

/* @var $propetySetter PropertySetter */
$propetySetter->setPropertiesOf($someObject);
```
#### SimplePropertySetter
Injects values obtained from a _value source_ to objects described by a _target specifier_ using some _property setting strategy_.

```php
use lukaszmakuch\PropertySetter\SimplePropertySetter;
use lukaszmakuch\PropertySetter\SettingStrategy\CallSetterMethod;
use lukaszmakuch\PropertySetter\TargetSpecifier\PickByClass;
use lukaszmakuch\PropertySetter\ValueSource\UseDirectly;

$setter = new SimplePropertySetter(
    new PickByClass(SomeClass::class),
    new CallSetterMethod("setParam"),
    new UseDirectly("param value")
);
```
#### SilentPropertySetter
It's a decorator that prevents the decorated setter from throwing the _UnsupportedTarget_ exception if some object is not supported.
```php
use lukaszmakuch\PropertySetter\SilentPropertySetter;
use lukaszmakuch\PropertySetter\PropertySetter;

/* @var $actualSetter PropertySetter */
$silentSetter = new SilentPropertySetter($actualSetter);
```
#### SimpleChainOfPropertySetters
It tries to set properties of an object using all of its setters. It doesn't prevent any exceptions.
```php
use lukaszmakuch\PropertySetter\SimpleChainOfPropertySetters;
use lukaszmakuch\PropertySetter\PropertySetter;

/* @var $firstSetter PropertySetter */
/* @var $anotherSetter PropertySetter */
$chain = (new SimpleChainOfPropertySetters())
    ->add($firstSetter)
    ->add($anotherSetter);
```
#### SilentChainOfPropertySetters
It's a decorator that ignores a situation when some setter doesn't support objects of some type. It prevents throwing the _UnsupportedTarget_ exception. When one of its setter throws an exception, it keeps trying to use other setters.
```php
use lukaszmakuch\PropertySetter\SilentChainOfPropertySetters;
use lukaszmakuch\PropertySetter\ChainOfPropertySetters;

/* @var $actualChain ChainOfPropertySetters */
$silentChain = new SilentChainOfPropertySetters($actualChain);
```
### Setting strategies
#### CallSetterMethod
Calls a setter in order to set a property.
```php
use lukaszmakuch\PropertySetter\SettingStrategy\CallSetterMethod;

$strategy = new CallSetterMethod("setParam"); //will call setParam
```
### Target specifiers
#### PickByClass
Selects targets by their classes.
```php
use lukaszmakuch\PropertySetter\TargetSpecifier\PickByClass;

$specifier = new PickByClass(\DateTime::class); //will support \DateTime
```
### Value Sources
#### UseDirectly
Simply holds some value without modyfing it before it's returned.
```php
use lukaszmakuch\PropertySetter\ValueSource\UseDirectly;

$valueSource = new UseDirectly(123); //will return 123
```
### Exceptions
#### UnableToSetProperty
_\lukaszmakuch\PropertySetter\Exception\UnableToSetProperty_

It's the parent of any exception that may be thrown by the _setPropertiesOf_ method.
When the setter method throws an exception, it's wrapped in this one (and becomes available by calling the _getPrevious_ method).
#### UnableToGetValue
_\lukaszmakuch\PropertySetter\Exception\UnableToGetValue_

Thrown when it's impossible to get a value (from a value source). It inherits from the _UnableToSetProperty_ exception.
#### UnableToGetValue
_\lukaszmakuch\PropertySetter\Exception\UnsupportedTarget_

Thrown when trying to set properties of an object that is not supported. It inherits from the _UnableToSetProperty_ exception.
## Installation
Use [composer](https://getcomposer.org) to get the latest version:
```
$ composer require lukaszmakuch/property-setter
```
