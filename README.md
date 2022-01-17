# Server specifications
* PHP >= 7.4
* Laravel 8
* Composer
* Git
* Apache | Nginx

# Installation

### Cloning the repository

```bash
git clone https://github.com/bakle/track.git  
```

### Installing the project 

```bash
composer install
```

# Answers to questions

### Question 1
The answer to question 1 is given in the feature test ``ShowAllPurchaseTest.php``.
There are several cases, and it shows the total price as well as the ordered items.


### Question 2
The answer to question 2 is given in the feature test ``ShowSpecificPurchaseTest.php``.
There are several cases, and it shows the total price (filtered) as well as the filtered console item.

# Additional

### Scenarios
Scenarios are different purchase cases.

* The ``default.json`` scenario is the one given in the test.
* The ``many_extras.json`` scenario test the ``maxExtras`` feature.

The other scenario is a bad-formed purchase structure to validate some

### Unit tests
There is a unit test called ``ValidatorTest.php`` that validates the json scenario format.


# Implemented Design Patterns

* The **Decorator Patter** was implemented to retrieve the total price of all items including their extras.
* The **Factory Method Pattern** was implemented to create each ``ElementItem`` object.


### Decorator Pattern
![Decorator Pattern](./public/img/decorator_pattern.jpg)

### Factory Method Pattern
![Factory Method Pattern](./public/img/factory_method.jpg)
