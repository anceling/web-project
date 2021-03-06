<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfd2e169cc1bb027eba6dd7234f80bcd4
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfd2e169cc1bb027eba6dd7234f80bcd4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfd2e169cc1bb027eba6dd7234f80bcd4::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitfd2e169cc1bb027eba6dd7234f80bcd4::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
