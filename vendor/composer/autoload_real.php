<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit59e3571d2b02f6eb4585923ccdf1e283
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit59e3571d2b02f6eb4585923ccdf1e283', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit59e3571d2b02f6eb4585923ccdf1e283', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit59e3571d2b02f6eb4585923ccdf1e283::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
