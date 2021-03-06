<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc18254e476b436e3190b06c58a3774c9
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'OneSheet\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'OneSheet\\' => 
        array (
            0 => __DIR__ . '/..' . '/nimmneun/onesheet/src/OneSheet',
        ),
    );

    public static $classMap = array (
        'XLSXWriter' => __DIR__ . '/..' . '/mk-j/php_xlsxwriter/xlsxwriter.class.php',
        'XLSXWriter_BuffererWriter' => __DIR__ . '/..' . '/mk-j/php_xlsxwriter/xlsxwriter.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc18254e476b436e3190b06c58a3774c9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc18254e476b436e3190b06c58a3774c9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc18254e476b436e3190b06c58a3774c9::$classMap;

        }, null, ClassLoader::class);
    }
}
