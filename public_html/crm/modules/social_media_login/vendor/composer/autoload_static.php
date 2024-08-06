<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb723386215cd551d9dd7270db40279df
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hybridauth\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hybridauth\\' => 
        array (
            0 => __DIR__ . '/..' . '/hybridauth/hybridauth/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb723386215cd551d9dd7270db40279df::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb723386215cd551d9dd7270db40279df::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb723386215cd551d9dd7270db40279df::$classMap;

        }, null, ClassLoader::class);
    }
}