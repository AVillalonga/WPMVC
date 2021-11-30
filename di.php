<?php

/**
 * @package WPMVC
 */

namespace WPMVC;

use ReflectionClass;
use ReflectionObject;

if (!class_exists("StaticDependencyInjector")) {
    class StaticDependencyInjector
    {
        private static array $__dependencies = [];

        public static function get_instance(string $class): object|callable { return self::$__dependencies[$class]; }
        
        public static function autoload(string $class): object|callable {
            $reflection = new \ReflectionClass(new $class());
            $constructor = $reflection->getConstructor();
            $constructor_parameters = $constructor !== null ? $constructor->getParameters() : [];
            foreach($constructor_parameters as $i=>$cp) {
                if(($cp->getType() === null) && (!$cp->isOptional())) {
                    throw new \Error('Missing Type "' . $constructor_parameters[$i]->getName() . '" in class "' . $class . '"');
                }
            }
            $constructor_args = self::__load_args($constructor_parameters);
        }

        private static function __load_args(array $parameters) {
            return array_map() /** @todo : OK */
        }

        private static function __has_trait(\ReflectionClass $reflection, string $trait_name): bool {
            return in_array($trait_name, $reflection->getTraitNames()); 
        }
    }
}


if (!trait_exists('Dependency')) {
    trait Dependency
    {
        public static function get_instance(...$args): object
        {
            $class = get_called_class();
            $instance = StaticDependencyInjector::get_instance('SINGLETON', $class);
            if($instance !== null) return is_callable($instance) ? $instance() : $instance;
            else $instance = StaticDependencyInjector::autoload($class);
        }
    }
}

if (!trait_exists('Singleton')) {
    trait Singleton { use Dependency; }
}

if (!trait_exists('Transient')) {
    trait Transient { use Dependency; }
}
