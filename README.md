<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel Version 10.44

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects.

###  Eloquent Relationships with Examples. 

#### Multiple Level Relationship - HasMany,HasManyThrough
We have multiple level Relationships.
Tables are `countries`,`city`,`shop`. Now we will create multilevel relationships with these tables.

1. We Have three level country has Many cities and 1 city has many shops.

Models `Country`, `City`, `Shop`


`php artisan make:model Country -mfs`

App\Models\Country

```
    protected $fillable = ['name'];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function shops(): HasManyThrough
    {
        return $this->hasManyThrough(Shop::class, City::class);
    }

```
```php artisan make:model City -mfs```

App\Models\City

```
    use HasFactory;
    
    protected $fillable = ['country_id','name'];

    public function shops(): HasMany
    {
        return $this->hasMany(Shop::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
```



```php artisan make:model Shop -mfs```

App\Models\Shop

```
    use HasFactory;
    
    protected $fillable = ['country_id','name'];

    public function shops(): HasMany
    {
        return $this->hasMany(Shop::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
```


Q Write a query to get country list with the amount of shop per country?

A. simple Eager Loading `with`

```
        $countries = Country::with('shops')->get();
        return view('welcome', compact('countries'));
```
```
       <table>
        <tr>
            <th>Country</th>
            <th>No of Shops</th>
        </tr>
        @foreach($countries as $country)
        <tr>
            <td>{{ $country->name }}</td>
            <td>{{ $country->shops->count() }}</td>
        </tr>
        @endforeach
       </table>
```

B. Eager Loading `withCount`
