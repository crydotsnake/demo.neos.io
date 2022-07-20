<?php
namespace Neos\Demo\UserRegistration;

use Neos\Demo\UserRegistration\Domain\Service\Asset\AssetManipulator;
use Neos\Demo\UserRegistration\Domain\Service\Resource\ResourceManipulator;
use Neos\Flow\Core\Bootstrap;
use Neos\Flow\Package\Package as BasePackage;
use Neos\Media\Domain\Service\ThumbnailService;
use Neos\Neos\Controller\Backend\ContentController;
use Neos\Media\Domain\Service\AssetService;

class Package extends BasePackage
{
    public function boot(Bootstrap $bootstrap)
    {
        $dispatcher = $bootstrap->getSignalSlotDispatcher();
        $dispatcher->connect(AssetService::class, 'assetCreated', AssetManipulator::class, 'assetCreated');
        $dispatcher->connect(ContentController::class, 'assetUploaded', AssetManipulator::class, 'assetUploaded');
        $dispatcher->connect(ThumbnailService::class, 'thumbnailCreated', ResourceManipulator::class, 'thumbnailCreated');
    }
}
