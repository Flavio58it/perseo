<?php

namespace PerSeo;

class NewApp extends \DI\Bridge\Slim\App
{
    protected function configureContainer(\DI\ContainerBuilder $builder)
    {
        $settings = file_exists(\PerSeo\Path::CONF_PATH.\PerSeo\Path::DS.'settings.php') ? \PerSeo\Path::CONF_PATH.\PerSeo\Path::DS.'settings.php' : \PerSeo\Path::CONF_PATH.\PerSeo\Path::DS.'default.php';
        $version = \PerSeo\Path::CONF_PATH.\PerSeo\Path::DS.'version.php';
        $builder->addDefinitions($settings);
        $builder->addDefinitions($version);
    }
}
