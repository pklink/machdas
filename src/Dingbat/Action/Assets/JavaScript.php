<?php

namespace Dingbat\Action\Assets;

use Assetic\Asset\AssetCache;
use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;
use Assetic\Cache\FilesystemCache;
use Dingbat\App;
use Dingbat\Action;
use Symfony\Component\HttpFoundation\Response;

class JavaScript extends Action
{

    public function run()
    {
        $rootDirectory = App::instance()->getConfig()->get('rootDirectory');
        $jsPath        = $rootDirectory . '/js';
        $cachePath     = $rootDirectory . '/tmp/cache';
        $collection    = new AssetCollection();

        // add scripts
        foreach (App::instance()->getConfig()->get('assets.scripts') as $script)
        {
            $collection->add(new FileAsset(sprintf('%s/%s.js', $jsPath, $script)));
        }

        $cachePath = new FilesystemCache($cachePath);
        $cache     = new AssetCache($collection, $cachePath);

        return new Response($cache->dump(), 200, ['Content-Type' => 'application/javascript']);
    }

}