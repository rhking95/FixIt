<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerKsfoc4w\appDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerKsfoc4w/appDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerKsfoc4w.legacy');

    return;
}

if (!\class_exists(appDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerKsfoc4w\appDevDebugProjectContainer::class, appDevDebugProjectContainer::class, false);
}

return new \ContainerKsfoc4w\appDevDebugProjectContainer(array(
    'container.build_hash' => 'Ksfoc4w',
    'container.build_id' => '6e176613',
    'container.build_time' => 1563645150,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerKsfoc4w');
