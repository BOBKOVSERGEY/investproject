<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit567cf503b976c3b08c0acfff427f69f7
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit567cf503b976c3b08c0acfff427f69f7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit567cf503b976c3b08c0acfff427f69f7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}