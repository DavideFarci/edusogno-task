<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4e6d0cddbdfd257f78d44c6dc38b6213
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4e6d0cddbdfd257f78d44c6dc38b6213::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4e6d0cddbdfd257f78d44c6dc38b6213::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4e6d0cddbdfd257f78d44c6dc38b6213::$classMap;

        }, null, ClassLoader::class);
    }
}
