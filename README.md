# laravel-linfo
This is a Laravel 5 Wrapper for the linfo package from jrgp - https://github.com/jrgp/linfo

## Installation

Add the following lines to your _composer.json_ or require the package via command line `composer require linfo\laravel` and run `composer update` to load the new package. 

```json
{
    "require": {
        "linfo/laravel": "~1.0"
    }
}
```

After this add the ServiceProvider in your _config/app.php_ in the providers array

```php
Linfo\Laravel\LinfoServiceProvider::class,
```

## Usage

### Model

Now you simply can create a new instance of the delivered model with `$linfo = new Linfo\Laravel\Models\Linfo();` from there you can mostly use it like a normal Laravel model. Included are the **original** output from the linfo package, the a bit transformed **attributes** and a **processed** array with calculated, merged and transformed values. And you can use the singular functions to get single elements.

```php
$linfo = new Linfo\Laravel\Models\Linfo();
$originals = $linfo->getOriginals();
$originalCpu = $linfo->getOriginal('Cpu');
$attributes = $linfo->getAttributes();
$attributeCpu = $linfo->getAttribute('cpu);
$processeds = $linfo->getProcesseds();
$processedCpu = $linfo->getProcessed('cpu');
```

If you want to extend the attributes setter and getter you can and it's also possible to make your own processed elements - everything in the normal Laravel way.

```php
namespace App;

use Linfo\Laravel\Models\Linfo as LinfoModel;
use Carbon\Carbon;

class CustomLinfo extends LinfoModel
{
    public function setUptimeAttribute($value)
    {
        $this->attributes['uptime'] = $this->asDateTime($value['bootedtimestamp']);
    }
    
    public function getUptimeAttribute(Carbon $value)
    {
        return $value->diffForHumans();
    }
    
    public function setCustomProcessed()
    {
        return 'here you can do whatever you want and return it';
    }
}
```

```php
$linfo = new App\CustomLinfo();
$processedCustom = $linfo->getProcessed('custom');
```

### Artisan

In the current dev version is also the first Artisan command included - it's a simple getter that prints the cpu, ram or mounts data in the console.

* ```artisan linfo:get cpu```
* ```artisan linfo:get ram```
* ```artisan linfo:get mounts```

## Demo

Please look at the demo site for more examples, usage and installation instructions. - [http://linfo.gummibeer.de](http://linfo.gummibeer.de)

## ToDo

* extend the artisan get command with more possible datasets
* create events for critical loads
* create a artisan check command that check all the loads and fires the events