<?php

/**
* @package   s9e\mediaembed
* @copyright Copyright (c) 2015-2016 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\Flarum\MediaEmbed;

use Flarum\Event\ConfigureFormatter;
use Illuminate\Events\Dispatcher;
use s9e\TextFormatter\Configurator\Bundles\MediaPack;

function subscribe(Dispatcher $events)
{
    $events->listen(
        ConfigureFormatter::class,
        function (ConfigureFormatter $event)
        {

            $event->configurator->Autoimage;
            (new MediaPack)->configure($event->configurator);

        }
    );
};

return __NAMESPACE__ . '\\subscribe';
