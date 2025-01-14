<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit906e616a66825d97168aaa44168b4cc6
{
    public static $prefixLengthsPsr4 = array (
        'k' => 
        array (
            'kornrunner\\' => 11,
        ),
        'H' => 
        array (
            'Hathoriel\\Utils\\' => 16,
            'Hathoriel\\NftMaker\\' => 19,
        ),
        'D' => 
        array (
            'Datachin\\XdcDatachainGateway\\' => 29,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'kornrunner\\' => 
        array (
            0 => __DIR__ . '/..' . '/kornrunner/keccak/src',
        ),
        'Hathoriel\\Utils\\' => 
        array (
            0 => __DIR__ . '/..' . '/tatum/utils/src',
        ),
        'Hathoriel\\NftMaker\\' => 
        array (
            0 => __DIR__ . '/..' . '/tatum/nft-maker/src',
        ),
        'Datachin\\XdcDatachainGateway\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
            1 => __DIR__ . '/../..' . '/src/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Datachin\\XdcDatachainGateway\\Activator' => __DIR__ . '/../..' . '/inc/Activator.php',
        'Datachin\\XdcDatachainGateway\\Assets' => __DIR__ . '/../..' . '/inc/Assets.php',
        'Datachin\\XdcDatachainGateway\\Core' => __DIR__ . '/../..' . '/inc/Core.php',
        'Datachin\\XdcDatachainGateway\\Localization' => __DIR__ . '/../..' . '/inc/Localization.php',
        'Datachin\\XdcDatachainGateway\\base\\Core' => __DIR__ . '/../..' . '/inc/base/Core.php',
        'Datachin\\XdcDatachainGateway\\base\\UtilsProvider' => __DIR__ . '/../..' . '/inc/base/UtilsProvider.php',
        'Datachin\\XdcDatachainGateway\\connectors\\DbConnector' => __DIR__ . '/../..' . '/inc/connectors/DbConnector.php',
        'Datachin\\XdcDatachainGateway\\rest\\XdcDatachainApi' => __DIR__ . '/../..' . '/inc/rest/XdcDatachainApi.php',
        'Datachin\\XdcDatachainGateway\\services\\XdcService' => __DIR__ . '/../..' . '/inc/services/XdcService.php',
        'Datachin\\XdcDatachainGateway\\utils\\Constants' => __DIR__ . '/../..' . '/inc/utils/Constants.php',
        'Datachin\\XdcDatachainGateway\\view\\menu\\Page' => __DIR__ . '/../..' . '/inc/view/menu/Page.php',
        'Datachin\\XdcDatachainGateway\\view\\widget\\Widget' => __DIR__ . '/../..' . '/inc/view/widget/Widget.php',
        'Hathoriel\\NftMaker\\Connectors\\DbConnector' => __DIR__ . '/..' . '/tatum/nft-maker/src/Connectors/DbConnector.php',
        'Hathoriel\\NftMaker\\Connectors\\IpfsConnector' => __DIR__ . '/..' . '/tatum/nft-maker/src/Connectors/IpfsConnector.php',
        'Hathoriel\\NftMaker\\Connectors\\ScConnector' => __DIR__ . '/..' . '/tatum/nft-maker/src/Connectors/ScConnector.php',
        'Hathoriel\\NftMaker\\Connectors\\TatumConnector' => __DIR__ . '/..' . '/tatum/nft-maker/src/Connectors/TatumConnector.php',
        'Hathoriel\\NftMaker\\Hooks\\AdminHooks' => __DIR__ . '/..' . '/tatum/nft-maker/src/Hooks/AdminHooks.php',
        'Hathoriel\\NftMaker\\Hooks\\PublicHooks' => __DIR__ . '/..' . '/tatum/nft-maker/src/Hooks/PublicHooks.php',
        'Hathoriel\\NftMaker\\Services\\AuctionService' => __DIR__ . '/..' . '/tatum/nft-maker/src/Services/AuctionService.php',
        'Hathoriel\\NftMaker\\Services\\DokanService' => __DIR__ . '/..' . '/tatum/nft-maker/src/Services/DokanService.php',
        'Hathoriel\\NftMaker\\Services\\EstimateService' => __DIR__ . '/..' . '/tatum/nft-maker/src/Services/EstimateService.php',
        'Hathoriel\\NftMaker\\Services\\MintService' => __DIR__ . '/..' . '/tatum/nft-maker/src/Services/MintService.php',
        'Hathoriel\\NftMaker\\Services\\NftService' => __DIR__ . '/..' . '/tatum/nft-maker/src/Services/NftService.php',
        'Hathoriel\\NftMaker\\Services\\SetupService' => __DIR__ . '/..' . '/tatum/nft-maker/src/Services/SetupService.php',
        'Hathoriel\\NftMaker\\Utils\\AddressValidator' => __DIR__ . '/..' . '/tatum/nft-maker/src/Utils/AddressValidator.php',
        'Hathoriel\\NftMaker\\Utils\\BlockchainLink' => __DIR__ . '/..' . '/tatum/nft-maker/src/Utils/BlockchainLink.php',
        'Hathoriel\\NftMaker\\Utils\\Constants' => __DIR__ . '/..' . '/tatum/nft-maker/src/Utils/Constants.php',
        'Hathoriel\\NftMaker\\Utils\\UtilsProvider' => __DIR__ . '/..' . '/tatum/nft-maker/src/Utils/UtilsProvider.php',
        'Hathoriel\\NftMaker\\Utils\\Utils\\Activator' => __DIR__ . '/..' . '/tatum/nft-maker/src/Utils/Utils/Activator.php',
        'Hathoriel\\NftMaker\\Utils\\Utils\\Assets' => __DIR__ . '/..' . '/tatum/nft-maker/src/Utils/Utils/Assets.php',
        'Hathoriel\\NftMaker\\Utils\\Utils\\Base' => __DIR__ . '/..' . '/tatum/nft-maker/src/Utils/Utils/Base.php',
        'Hathoriel\\NftMaker\\Utils\\Utils\\Core' => __DIR__ . '/..' . '/tatum/nft-maker/src/Utils/Utils/Core.php',
        'Hathoriel\\NftMaker\\Utils\\Utils\\Localization' => __DIR__ . '/..' . '/tatum/nft-maker/src/Utils/Utils/Localization.php',
        'Hathoriel\\NftMaker\\Utils\\Utils\\PackageLocalization' => __DIR__ . '/..' . '/tatum/nft-maker/src/Utils/Utils/PackageLocalization.php',
        'Hathoriel\\NftMaker\\Utils\\Utils\\PluginReceiver' => __DIR__ . '/..' . '/tatum/nft-maker/src/Utils/Utils/PluginReceiver.php',
        'Hathoriel\\NftMaker\\Utils\\Utils\\Service' => __DIR__ . '/..' . '/tatum/nft-maker/src/Utils/Utils/Service.php',
        'Hathoriel\\Utils\\Activator' => __DIR__ . '/..' . '/tatum/utils/src/Activator.php',
        'Hathoriel\\Utils\\Assets' => __DIR__ . '/..' . '/tatum/utils/src/Assets.php',
        'Hathoriel\\Utils\\Base' => __DIR__ . '/..' . '/tatum/utils/src/Base.php',
        'Hathoriel\\Utils\\Core' => __DIR__ . '/..' . '/tatum/utils/src/Core.php',
        'Hathoriel\\Utils\\Localization' => __DIR__ . '/..' . '/tatum/utils/src/Localization.php',
        'Hathoriel\\Utils\\PackageLocalization' => __DIR__ . '/..' . '/tatum/utils/src/PackageLocalization.php',
        'Hathoriel\\Utils\\PluginReceiver' => __DIR__ . '/..' . '/tatum/utils/src/PluginReceiver.php',
        'Hathoriel\\Utils\\Service' => __DIR__ . '/..' . '/tatum/utils/src/Service.php',
        'kornrunner\\Keccak' => __DIR__ . '/..' . '/kornrunner/keccak/src/Keccak.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit906e616a66825d97168aaa44168b4cc6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit906e616a66825d97168aaa44168b4cc6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit906e616a66825d97168aaa44168b4cc6::$classMap;

        }, null, ClassLoader::class);
    }
}
