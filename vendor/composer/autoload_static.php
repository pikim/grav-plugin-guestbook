<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfa74b862e735903dc3f9a91e1b697a8f
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Grav\\Plugin\\Guestbook\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Grav\\Plugin\\Guestbook\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Grav\\Plugin\\GuestbookPlugin' => __DIR__ . '/../..' . '/guestbook.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfa74b862e735903dc3f9a91e1b697a8f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfa74b862e735903dc3f9a91e1b697a8f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfa74b862e735903dc3f9a91e1b697a8f::$classMap;

        }, null, ClassLoader::class);
    }
}
