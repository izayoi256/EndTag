<?php
/*
 * Copyright(c) 2000-2016 Daisy CO., LTD. All Rights Reserved.
 *
 * http://daisy.link/
 */

namespace Plugin\BlankPlugin\ServiceProvider;

use Eccube\Application;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

class BlankPluginServiceProvider implements ServiceProviderInterface
{
    public function register(BaseApplication $app)
    {
        $this->initConfig($app);
        $this->initRoute($app);
        $this->initForm($app);
        $this->initDoctrine($app);
        $this->initService($app);
        $this->initTranslator($app);
    }

    public function initConfig(BaseApplication $app)
    {
        $app['config'] = $app->share(
            $app->extend(
                'config',
                function ($configAll) {

                    $ymlPath = __DIR__ . '/../config';
                    $configYml = $ymlPath . '/config.yml';
                    $configAll['plg_blank'] = array();

                    if (file_exists($configYml)) {
                        $config = Yaml::parse($configYml);
                        if (is_array($config)) {
                            $configAll['plg_blank'] = array_merge($configAll['plg_blank'], $config);
                        }
                    }

                    return $configAll;
                }
            )
        );
    }

    public function initRoute(BaseApplication $app)
    {
        if (version_compare(\Eccube\Common\Constant::VERSION, '3.0.3', '<=')) {

            $post = $delete = 'match';
        } else {

            $post = 'post';
            $delete = 'delete';
        }

        $app->match(sprintf('/%s/plugin/BlankPlugin/config', $app['config']['admin_route']), '\Plugin\BlankPlugin\Controller\ConfigController::index')
            ->bind('plugin_BlankPlugin_config');
        $app->match('/blank/{id}', '\Plugin\BlankPlugin\Controller\BlankController::index')
            ->assert('id', '^\d+$')
            ->bind('blank');
    }

    public function initForm(BaseApplication $app)
    {
        $app['form.types'] = $app->share(
            $app->extend(
                'form.types',
                function ($types) use ($app) {
                    $types[] = new \Plugin\BlankPlugin\Form\Type\BlankType($app);

                    return $types;
                }
            )
        );
        $app['form.type.extensions'] = $app->share(
            $app->extend(
                'form.type.extensions',
                function ($extensions) use ($app) {
                    $extensions[] = new \Plugin\BlankPlugin\Form\Extension\BlankTypeExtension($app);

                    return $extensions;
                }
            )
        );
    }

    public function initDoctrine(BaseApplication $app)
    {
        $app['plugin.blank.repository.blank'] = $app->share(
            function () use ($app) {
                return $app['orm.em']->getRepository('Plugin\BlankPlugin\Entity\Blank');
            }
        );
    }

    public function initService(BaseApplication $app)
    {
        $app['plugin.blank.service.blank'] = $app->share(function () use ($app) {
            return new \Plugin\BlankPlugin\Service\BlankService($app);
        });
    }

    public function initTranslator(BaseApplication $app)
    {
        $app['translator'] = $app->share(
            $app->extend(
                'translator',
                function ($translator, \Silex\Application $app) {
                    $translator->addLoader('yaml', new \Symfony\Component\Translation\Loader\YamlFileLoader());

                    $file = __DIR__ . '/../Resource/locale/message.' . $app['locale'] . '.yml';
                    if (file_exists($file)) {
                        $translator->addResource('yaml', $file, $app['locale']);
                    }

                    return $translator;
                }
            )
        );
    }

    public function boot(BaseApplication $app)
    {
    }
}