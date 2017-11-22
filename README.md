# Laravel Repositories
<p>
Laravel Repositories is a package for Laravel 5 that abstracts the database layer, making your app easier to maintain.
</p>

## Installation
<p>Run the following command:</p>

<pre>
composer require getwes/laravel-repositories
</pre>

<p>Add the <code>RepositoryServiceProvider</code> to your <code>config.app</code> file in the providers array.</p>

<pre>
WesMurray\Repositories\RepositoryServiceProvider::class
</pre>

<p>Once you have added the service provider to your config file, you can run <code>php artisan vendor:publish</code> to publish the <code>repository.php</code> config file.</p>

## Basic Usage
<p>Let's create a <code>user repository</code> class, Note that any concrete repository class MUST extend <code>WesMurray\Repositories\RepositoryAbstract</code> class and implement a <code>model()</code> method.</p>

<pre>
&lt?php

namespace App\Repositories;

use App\User;
use WesMurray\Repositories\RepositoryAbstract;

class UserRepository extends RepositoryAbstract implements RepositoryInterface
{
    public function model()
    {
        return User::class;
    }
}
</pre>

## Configuration

<p>Let's update our <code>repository.php</code> configuration file with the repository interface and concrete repository implementation, so the <code>RepositoryServiceProvider</code> can bind them into the application.</p>

<p><code>repository.php</code></p>
<pre>
&lt?php

return [

    'repositories' => [
        App\Repositories\Contracts\UserRepository::class => App\Repositories\UserRepository::class
        
        //
    ]
];
</pre>

<p>This saves you time NOT having to create your own <code>service provider</code> to bind the repository services to your application.</p>

<p>And finally, use the repository in the controller:</p>
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
<p>The following methods are available:</p>
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

<p>Criteria and Eager Loading usage to follow...</p>
