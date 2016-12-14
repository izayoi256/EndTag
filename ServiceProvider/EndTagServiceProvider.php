<?php
/*
 * Copyright(c) 2000-2016 Daisy CO., LTD. All Rights Reserved.
 *
 * http://daisy.link/
 */

namespace Plugin\EndTag\ServiceProvider;

use Eccube\Application;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

class EndTagServiceProvider implements ServiceProviderInterface
{
    public function register(BaseApplication $app)
    {
        $this->initForm($app);
    }

    public function initForm(BaseApplication $app)
    {
        $app['form.type.extensions'] = $app->share(
            $app->extend(
                'form.type.extensions',
                function ($extensions) use ($app) {
                    $extensions[] = new \Plugin\EndTag\Form\Extension\Front\EntryTypeExtension();

                    return $extensions;
                }
            )
        );
    }

    public function boot(BaseApplication $app)
    {
    }
}