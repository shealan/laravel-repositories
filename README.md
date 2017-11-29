# Laravel Repositories
Laravel Repositories is a package for Laravel 5 that abstracts the database layer, making your app easier to maintain.


## Installation
Run the following command:

<pre>
composer require getwes/laravel-repositories
</pre>

Add the <code>RepositoryServiceProvider</code> to your <code>config.app</code> file in the providers array.

<pre>
WesMurray\Repositories\RepositoryServiceProvider::class
</pre>

Once you have added the service provider to your config file, you can run <code>php artisan vendor:publish</code> to publish the <code>repository.php</code> config file.

## Basic Usage
Let's create a <code>user repository</code> class, Note that any concrete repository class MUST extend <code>WesMurray\Repositories\RepositoryAbstract</code> class and implement a <code>model()</code> method.

<pre>
&lt?php

namespace App\Repositories;

use App\User;
use WesMurray\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\UserRepository as RepositoryInterface;

class UserRepository extends RepositoryAbstract implements RepositoryInterface
{
    public function model()
    {
        return User::class;
    }
}
</pre>

## Configuration

Let's update our <code>repository.php</code> configuration file with the repository interface and concrete repository implementation, so the <code>RepositoryServiceProvider</code> can bind them into the application.

<code>config/repository.php</code>
<pre>
&lt?php

return [

    'repositories' => [
        App\Repositories\Contracts\UserRepository::class => App\Repositories\UserRepository::class
        
        //
    ]
];
</pre>

This saves you time NOT having to create your own <code>service provider</code> to bind the repository services to your application.

And finally, use the repository in the controller:
<pre>
&lt?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Http\Controllers\Controller;
Use App\Repositories\Contracts\UserRepository;

class UserController extends Controller
{
    protected $users;
    
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
    
    public function index()
    {
        return $this->users->get();
    }
}
</pre>

## Available Methods
The following methods are available:
<br>
<code>WesMurray\Repositories\Traits\RepositoryAbstractMethodsTrait</code>

<pre>
public function get();
public function store(array $data);
public function update($id, array $data);
public function delete($id);
public function forceDelete($id); // If SoftDeletes() are enabled.
public function paginate($count);
public function findById($id);
public function findByLogin($id);
public function findBySlug($id);
</pre>

<pre>
<strong>Need more custom methods?</strong>
Contribute by creating a <code>fork</code> of this repository... Update and <code>create a pull request</code> for review.
</pre>

## Criteria
Criteria is a easy way to apply conditions to your query. Note your critiera class must extend the <code>WesMurray\Repositories\Criteria\CriterionInterface</code>.

### Example
Let's get a listing of `users` that must be `verified` before they can be displayed in the application.

In your <code>App\Http\Controllers\UserController.php</code>, lets add the criteria.

<pre>
&lt?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Http\Controllers\Controller;
Use App\Repositories\Contracts\UserRepository;

// Import Criteria
use App\Repositories\Criteria\UserMustBeVerified;

class UserController extends Controller
{
    protected $users;
    
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
    
    public function index()
    {
        return $this->users->withCriteria(new UserMustBeVerified())->get();
    }
}
</pre>

Let's create the <code>App\Repositories\Criteria\UserMustBeVerified.php</code>.

<pre>
&lt?php

namespace App\Repositories\Criteria;

use WesMurray\Repositories\Criteria\CriterionInterface;

class UserMustBeVerified extends CriterionInterface
{
    public function apply($model)
    {
        return $model->whereNotNull('verified_at');
    }
}
</pre>

## Eager Loading
Sometimes you may want to load relationships into your query. You can also apply `eager loading` along with additional criteria if you have any already defined.

### Example
Let's extend our listing of `users` and also get all of their `posts` they have created.

<code>App\Http\Controllers\UserController.php</code>

<pre>
&lt?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Http\Controllers\Controller;
Use App\Repositories\Contracts\UserRepository;

// Import Criteria
use App\Repositories\Criteria\UserMustBeVerified;

// Import EagerLoad
use WesMurray\Repositories\Eloquent\Criteria\EagerLoad;

class UserController extends Controller
{
    protected $users;
    
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
    
    public function index()
    {
        return $this->users->withCriteria([
            new UserMustBeVerified(), new EagerLoad('posts')
        ])->get();
    }
}
</pre>

<hr>

Code with <3 by <a href="https://github.com/getwes">getwes</a>
