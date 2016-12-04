# DeepCompare
### Recursive comparison tool

**The static function `DeepCompare::compare()` allows you to recursively compare any two given vars**.
Whether it be integer, string, array or object, you can parse through multi-level variables and compare them. All you have to do is to implement updating tools when the function returns false, and eventually failsaves to prevent infinite loops for objects with relationships.

*Every specific function throws InvalidArgumentException if called with different types of vars*

#### `DeepCompare::compare`
Generic recursive function, used for generic purpose, called in the non-scalar comparing functions.
#### `DeepCompare::compareArray`
Deep array parsing comparison function. Calls `DeepCompare::compare` to parse through sub arrays.
#### `DeepCompare::compareObject`
Deep object parsing comparison function. Calls `DeepCompare::compare` to parse through sub objects.
#### `DeepCompare::compareScalar`
Simple scalar values comparison tool.

**Usage example (updating):**
```php
        // Parse properties
        foreach($refVar->getProperties() as $property) {
            $property->setAccessible(true);
            $getter = 'get'.ucfirst($property->getName());
            /--> $setter = 'set'.ucfirst($property->getName());
            // Compare properties values
            if(!self::compare($var1->$getter(), $var2->$getter()))
                /--> $var1->$setter($var2->$getter());
                /--> $entityManager->flush();
                return false;
        }
```
**Usage Example (failsafe):**
```php
        // Parse properties
        foreach($refVar->getProperties() as $property) {
            $property->setAccessible(true);
            $getter = 'get'.ucfirst($property->getName());
            //--> When parsing for sub-objects of an Example entity
            /--> if ($var1 instanceof Example) {
                return true;
            }
            // Compare properties values
            if(!self::compare($var1->$getter(), $var2->$getter()))
                return false;
        }
```
