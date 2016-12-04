# EntityInterface
### Basic interface for entities in OOP PHP
#### EntityInterface
**If you ever need to typehint or instanceof entities**, like in Symfony or to work with Doctrine for example, you may want to give all your entities a basic interface, to allow your code to be non-specific.
This interface will allow you to do so, while still ensuring you can call any identifier of such entities in an abstract way.

**By implementing this interface**, all your entities will have a common base, and a common method to get their identifier, whether it's a simple id attribute or something fancier. Juste mak it call and return your `get{identifier}()` method.
**Example:**
```php
/**
 * @return integer|string
 */
public function returnIdentifier()
{
    return $this->getName();
}
```
#### EntityNameInterface
**This interface works just the same as the first one**, except the second method which is made to return the class name, without namespace.
Much more Symfony-oriented, it's always useful when you want, for example, to be able to call any entity repository that may come.

To implement it, simply make it return the class name as a string.
**Example:**
```php
/**
 * @return string
 */
public function returnEntityType()
{
    return 'Invoice';
}
```

**Usage example:**
```php
if ($entity instanceof EntityNameInterface) {
    $newEntity = 
    $this
        ->entityManager
        ->getRepository('AppBundle:'.$entity->returnEntityType())
        ->find($someId);
}
```

**Thanks for your input.**
