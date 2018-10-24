<?php

namespace Tests\Traits;

use PHPUnit_Framework_MockObject_MockObject;
use ReflectionClass;
use ReflectionMethod;

trait TestCaseHelperTrait
{
    /**
     * Returns the method name from a callable.
     *
     * <p>
     * This method supports both array-style as well as string-style callables:
     * <code>
     *   ['ClassName', 'methodName']
     *   [$instance, 'methodName]
     *   'ClassName::methodName'
     * </code>
     *
     * <p>
     * This is a convenience method to use with PHPUnit expectations. When an PHPUnit expectation needs a method name,
     * pass it using this method. That way whenever a method name is needed, you are working with an actual callback
     * instead of a plain string. This will ensure that the test will not break whenever a method name changes, as the
     * IDE will automatically refactor the method name used in the callback as well.
     *
     * @param callable $callable an array-style or string-style callable
     *
     * @throws \ReflectionException      thrown if the given method does not exist
     * @throws \InvalidArgumentException thrown if the given callable is unsupported or invalid
     *
     * @return string the method name
     */
    protected function methodName($callable)
    {
        if (is_string($callable)) {
            $callable = explode('::', $callable);
        }

        if (is_array($callable) && count($callable) === 2 && isset($callable[0], $callable[1])) {
            return (new ReflectionMethod($callable[0], $callable[1]))->getName();
        }

        throw new \InvalidArgumentException('Unsupported or invalid callable');
    }

    /**
     * @param string $className
     * @param array  $keepOriginalMethods The method names of methods to not mock
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockForConcreteClass($className, array $keepOriginalMethods = [])
    {
        return $this->getMockBuilder($className)
            ->disableOriginalConstructor()
            ->setMethods(array_diff($this->getAllPublicMethods($className), $keepOriginalMethods))
            ->getMockForAbstractClass();
    }

    /**
     * Returns a list of all public class methods.
     *
     * @param string $className
     *
     * @throws \ReflectionException
     *
     * @return array list of method names
     */
    private function getAllPublicMethods($className)
    {
        $methods = (new ReflectionClass($className))
            ->getMethods(ReflectionMethod::IS_PUBLIC);

        return array_map(
            function (ReflectionMethod $method) {
                return $method->getName();
            },
            $methods
        );
    }
}
