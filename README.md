#Laravel array formatter similarity DTO#

## Introduction

Laravel can serialize EloquentModel or EloquentCollection to array, but it can't get only certain data (for example: return JSON from controller). DTO can return to response only certain data large nested.

## Installation

Require this package in your `composer.json` and update composer. This will download the package.

```php
"valeryq/dto": "1.0.0"
```

After updating composer, add the ServiceProvider to the providers array in `app/config/app.php`

```php
'Valeryq\DTO\DTOServiceProvider',
```

You can use the facade for shorter code. Add this to your aliases:

```php
'DTO' => 'Valeryq\DTO\DTOFacade',
```

## How it use

**Eloquent model example:**

```php
class UserController extends \BaseController 
{
    public function getUser() 
    {
        $user = UserModel::find(1);

        return DTO::make($user)->only(['id', 'firstname']);

        or
     
        return DTO::make($user)->except(['lastname']);
    }   
}
```

**Eloquent collection example:**

```php
class UserController extends \BaseController 
{
    public function getUser() 
    {
        $user = UserModel::where('firstname', 'Test')->get();

        return DTO::make($user)->only(['id', 'firstname']);

        or
     
        return DTO::make($user)->except(['lastname']);
    }   
}
```

**Nested objects:**

```php
class UserController extends \BaseController 
{
    public function getUser() 
    {
        $user = UserModel::with('posts')->find(1);

        return DTO::make($user)->only(['id', 'firstname', 'posts.id', 'posts.body']);

        or
     
        return DTO::make($user)->except(['lastname', 'posts.body']);
    }   
}
```
