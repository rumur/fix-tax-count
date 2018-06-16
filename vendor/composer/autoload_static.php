<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1b379d4a7a9e563af7d1eac9182e27f9
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rumur\\App\\' => 10,
            'Rumur\\' => 6,
        ),
        'P' => 
        array (
            'Psr\\Container\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rumur\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Rumur\\' => 
        array (
            0 => __DIR__ . '/../..' . '/resources',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
        ),
    );

    public static $classMap = array (
        'Pimple\\Container' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Container.php',
        'Pimple\\Exception\\ExpectedInvokableException' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Exception/ExpectedInvokableException.php',
        'Pimple\\Exception\\FrozenServiceException' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Exception/FrozenServiceException.php',
        'Pimple\\Exception\\InvalidServiceIdentifierException' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Exception/InvalidServiceIdentifierException.php',
        'Pimple\\Exception\\UnknownIdentifierException' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Exception/UnknownIdentifierException.php',
        'Pimple\\Psr11\\Container' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Psr11/Container.php',
        'Pimple\\Psr11\\ServiceLocator' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Psr11/ServiceLocator.php',
        'Pimple\\ServiceIterator' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/ServiceIterator.php',
        'Pimple\\ServiceProviderInterface' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/ServiceProviderInterface.php',
        'Pimple\\Tests\\Fixtures\\Invokable' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Tests/Fixtures/Invokable.php',
        'Pimple\\Tests\\Fixtures\\NonInvokable' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Tests/Fixtures/NonInvokable.php',
        'Pimple\\Tests\\Fixtures\\PimpleServiceProvider' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Tests/Fixtures/PimpleServiceProvider.php',
        'Pimple\\Tests\\Fixtures\\Service' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Tests/Fixtures/Service.php',
        'Pimple\\Tests\\PimpleServiceProviderInterfaceTest' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Tests/PimpleServiceProviderInterfaceTest.php',
        'Pimple\\Tests\\PimpleTest' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Tests/PimpleTest.php',
        'Pimple\\Tests\\Psr11\\ContainerTest' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Tests/Psr11/ContainerTest.php',
        'Pimple\\Tests\\Psr11\\ServiceLocatorTest' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Tests/Psr11/ServiceLocatorTest.php',
        'Pimple\\Tests\\ServiceIteratorTest' => __DIR__ . '/..' . '/pimple/pimple/src/Pimple/Tests/ServiceIteratorTest.php',
        'Psr\\Container\\ContainerExceptionInterface' => __DIR__ . '/..' . '/psr/container/src/ContainerExceptionInterface.php',
        'Psr\\Container\\ContainerInterface' => __DIR__ . '/..' . '/psr/container/src/ContainerInterface.php',
        'Psr\\Container\\NotFoundExceptionInterface' => __DIR__ . '/..' . '/psr/container/src/NotFoundExceptionInterface.php',
        'Rumur\\Activation' => __DIR__ . '/../..' . '/resources/Activation.php',
        'Rumur\\Admin\\Admin' => __DIR__ . '/../..' . '/resources/Admin/Admin.php',
        'Rumur\\Admin\\Service\\AdminPage\\IAdminPage' => __DIR__ . '/../..' . '/resources/Admin/Service/AdminPage/IAdminPage.php',
        'Rumur\\Admin\\Service\\NoticeAdmin' => __DIR__ . '/../..' . '/resources/Admin/Service/NoticeAdmin.php',
        'Rumur\\Admin\\Service\\Options\\IOptions' => __DIR__ . '/../..' . '/resources/Admin/Service/Options/IOptions.php',
        'Rumur\\Admin\\Service\\Options\\Options' => __DIR__ . '/../..' . '/resources/Admin/Service/Options/Options.php',
        'Rumur\\App\\FixTaxCount' => __DIR__ . '/../..' . '/app/FixTaxCount.php',
        'Rumur\\Core\\Container' => __DIR__ . '/../..' . '/resources/Core/Container.php',
        'Rumur\\Core\\ServiceProvider' => __DIR__ . '/../..' . '/resources/Core/ServiceProvider.php',
        'Rumur\\Facades\\Facade' => __DIR__ . '/../..' . '/resources/Facades/Facade.php',
        'Rumur\\Facades\\NoticeAdmin' => __DIR__ . '/../..' . '/resources/Facades/NoticeAdmin.php',
        'Rumur\\Facades\\NoticeFront' => __DIR__ . '/../..' . '/resources/Facades/NoticeFront.php',
        'Rumur\\Facades\\View' => __DIR__ . '/../..' . '/resources/Facades/View.php',
        'Rumur\\Plugin' => __DIR__ . '/../..' . '/resources/Plugin.php',
        'Rumur\\Service\\Compat' => __DIR__ . '/../..' . '/resources/Service/Compat.php',
        'Rumur\\Service\\LoggerService' => __DIR__ . '/../..' . '/resources/Service/LoggerService.php',
        'Rumur\\Service\\NoticeService' => __DIR__ . '/../..' . '/resources/Service/NoticeService.php',
        'Rumur\\Service\\Notice\\INotice' => __DIR__ . '/../..' . '/resources/Service/Notice/NoticeInterface.php',
        'Rumur\\Service\\Notice\\Notice' => __DIR__ . '/../..' . '/resources/Service/Notice/Notice.php',
        'Rumur\\Service\\Notice\\NoticeException' => __DIR__ . '/../..' . '/resources/Service/Notice/NoticeExeptions.php',
        'Rumur\\Service\\Notice\\NoticeFront' => __DIR__ . '/../..' . '/resources/Service/Notice/NoticeFront.php',
        'Rumur\\Service\\ViewService' => __DIR__ . '/../..' . '/resources/Service/ViewService.php',
        'Rumur\\Service\\View\\IView' => __DIR__ . '/../..' . '/resources/Service/View/IView.php',
        'Rumur\\Service\\View\\View' => __DIR__ . '/../..' . '/resources/Service/View/View.php',
        'Rumur\\Service\\View\\ViewException' => __DIR__ . '/../..' . '/resources/Service/View/ViewExeptions.php',
        'Rumur\\Uninstall' => __DIR__ . '/../..' . '/resources/Uninstall.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1b379d4a7a9e563af7d1eac9182e27f9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1b379d4a7a9e563af7d1eac9182e27f9::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit1b379d4a7a9e563af7d1eac9182e27f9::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit1b379d4a7a9e563af7d1eac9182e27f9::$classMap;

        }, null, ClassLoader::class);
    }
}
