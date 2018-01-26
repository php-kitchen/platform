<?php

namespace PHPKitchen\Platform\Mixin;

use PHPKitchen\Platform\Exception\Runtime\Property\InvalidAccessException;
use PHPKitchen\Platform\Exception\Runtime\Property\UndefinedPropertyException;

/**
 * Represents implementation of properties for PHP classes.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
trait Properties {
    /**
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when executing `$value = $object->property;`.
     *
     * @param string $name the property name
     *
     * @return mixed the property value
     * @throws UndefinedPropertyException if the property is not defined
     * @throws InvalidAccessException if the property is write-only
     * @see getProperty()
     * @see __set()
     */
    public function __get($name) {
        return $this->getProperty($name);
    }

    /**
     * Returns the value of an object property.
     *
     * @param string $property the property name
     *
     * @return mixed the property value
     * @throws UndefinedPropertyException if the property is not defined
     * @throws InvalidAccessException if the property is write-only
     * @see setProperty()
     */
    protected function getProperty(string $property) {

        if ($this->hasGetterFor($property)) {
            return $this->{'get' . $property}();
        } elseif ($this->hasCondition($property)) {
            return $this->$property();
        } elseif ($this->hasSetterFor($property)) {
            throw new InvalidAccessException('Getting write-only property: ' . static::class . '::' . $property);
        }

        throw new UndefinedPropertyException('Getting unknown property: ' . static::class . '::' . $property);
    }

    /**
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when executing `$object->property = $value;`.
     *
     * @param string $name the property name
     * @param mixed $value the property value
     *
     * @throws UndefinedPropertyException if the property is not defined
     * @throws InvalidAccessException if the property is read-only
     * @see setProperty()
     * @see __get()
     */
    public function __set($name, $value) {
        $this->setProperty($name, $value);
    }

    /**
     * Sets value of an object property.
     *
     * @param string $name the property name
     * @param mixed $value the property value
     *
     * @throws UndefinedPropertyException if the property is not defined
     * @throws InvalidAccessException if the property is read-only
     * @see getProperty()
     */
    protected function setProperty(string $name, $value): void {
        $setter = 'set' . $name;
        if ($this->hasMethod($setter)) {
            $this->$setter($value);
        } elseif ($this->hasMethod('get' . $name)) {
            throw new InvalidAccessException('Setting read-only property: ' . static::class . '::' . $name);
        } else {
            throw new UndefinedPropertyException('Setting unknown property: ' . static::class . '::' . $name);
        }
    }

    /**
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when executing `isset($object->property)`.
     *
     * @param string $name the property name
     *
     * @return bool whether the named property is set (not null).
     * @see isPropertySet
     * @see http://php.net/manual/en/function.isset.php
     */
    public function __isset($name) {
        return $this->isPropertySet($name);
    }

    /**
     * Checks if a property is set, i.e. defined and not null.
     *
     * Note that if the property is not defined, false will be returned.
     *
     * @param string $name the property name
     *
     * @return bool whether the named property is set (not null).
     */
    public function isPropertySet(string $name): bool {
        $getter = 'get' . $name;
        if ($this->hasMethod($getter)) {
            return $this->$getter() !== null;
        }

        return false;
    }

    /**
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when executing `unset($object->property)`.
     *
     * @param string $name the property name
     *
     * @throws InvalidAccessException if the property is read only.
     * @see unSetProperty
     * @see http://php.net/manual/en/function.unset.php
     */
    public function __unset($name) {
        $this->unSetProperty($name);
    }

    /**
     * Sets an object property to null.
     *
     * Note that if the property is not defined, this method will do nothing.
     * If the property is read-only, it will throw an exception.
     *
     * @param string $name the property name
     *
     * @throws InvalidAccessException if the property is read only.
     */
    public function unSetProperty(string $name): void {
        $setter = 'set' . $name;
        if ($this->hasMethod($setter)) {
            $this->$setter(null);
        } elseif ($this->hasMethod('get' . $name)) {
            throw new InvalidAccessException('Unsetting read-only property: ' . static::class . '::' . $name);
        }
    }

    /**
     * Returns a value indicating whether a property is defined.
     *
     * A property is defined if:
     *
     * - the class has a getter or setter method associated with the specified name
     *   (in this case, property name is case-insensitive);
     * - the class has a member variable with the specified name;
     *
     * @param string $name the property name
     *
     * @return bool whether the property is defined
     * @see canGetProperty()
     * @see canSetProperty()
     */
    public function hasProperty($name): bool {
        return $this->canGetProperty($name) || $this->canSetProperty($name);
    }

    /**
     * Returns a value indicating whether a condition property is defined.
     *
     * A condition property is defined if:
     * - the class has a "is" method associated with the specified name;
     * - the class has a "has" method associated with the specified name;
     *
     * Note: property name is case-insensitive
     *
     * @param string $name the property name
     *
     * @return bool whether the condition property is defined
     */
    public function hasCondition($name): bool {
        return $this->hasMethod($name) && (strpos($name, 'is') === 0 || strpos($name, 'has') === 0);
    }

    /**
     * Returns a value indicating whether a property can be read.
     *
     * A property is readable if:
     *
     * - the class has a getter method associated with the specified name
     *   (in this case, property name is case-insensitive);
     * - the class has a member variable with the specified name;
     *
     * @param string $property the property name
     *
     * @return bool whether the property can be read
     * @see canSetProperty()
     */
    public function canGetProperty(string $property): bool {
        return $this->hasGetterFor($property) || $this->hasField($property) || $this->hasCondition($property);
    }

    /**
     * Returns a value indicating whether a property can be set.
     *
     * A property is writable if:
     * - the class has a setter method associated with the specified name
     *   (in this case, property name is case-insensitive);
     * - the class has a member variable with the specified name;
     *
     * @param string $property the property name
     *
     * @return bool whether the property can be written
     * @see canGetProperty()
     */
    public function canSetProperty(string $property): bool {
        return $this->hasSetterFor($property) || $this->hasField($property);
    }

    /**
     * Returns a value indicating whether a class field is defined.
     *
     * @param string $name the field name
     *
     * @return bool whether the field is defined
     */
    public function hasField(string $name): bool {
        return property_exists($this, $name);
    }

    /**
     * Returns a value indicating whether a getter is defined for property.
     *
     * @param string $property the property name
     *
     * @return bool whether the getter is defined
     */
    public function hasGetterFor(string $property): bool {
        return $this->hasMethod('get' . $property);
    }

    /**
     * Returns a value indicating whether a setter is defined for property.
     *
     * @param string $property the property name
     *
     * @return bool whether the getter is defined
     */
    public function hasSetterFor(string $property): bool {
        return $this->hasMethod('set' . $property);
    }

    /**
     * Returns a value indicating whether a method is defined.
     *
     * The default implementation is a call to php function `method_exists()`.
     * You may override this method when you implemented the php magic method `__call()`.
     *
     * @param string $name the method name
     *
     * @return bool whether the method is defined
     */
    public function hasMethod(string $name): bool {
        return method_exists($this, $name);
    }
}