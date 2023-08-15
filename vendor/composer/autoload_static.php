<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit31ff6f3de93cc7fd2706297e8c1a66aa
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'setasign\\Fpdi\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'setasign\\Fpdi\\' => 
        array (
            0 => __DIR__ . '/..' . '/setasign/fpdi/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'FPDF' => __DIR__ . '/..' . '/setasign/fpdf/fpdf.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit31ff6f3de93cc7fd2706297e8c1a66aa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit31ff6f3de93cc7fd2706297e8c1a66aa::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit31ff6f3de93cc7fd2706297e8c1a66aa::$classMap;

        }, null, ClassLoader::class);
    }
}