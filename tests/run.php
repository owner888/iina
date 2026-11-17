<?php
declare(strict_types=1);

require __DIR__ . '/../boot.php';
require dirname((new ReflectionClass(\MyPHP\App::class))->getFileName(), 2) . '/tests/Headless.php';

use MyPHP\Tests\Headless;
use MyPHP\UI\Content;
use MyPHP\UI\MediaPlayerState;

$state = new MediaPlayerState();
$content = Content::file(__DIR__ . '/../view.php', $state);
$h = new Headless($content->view, 960, 540);
$h->frame(2);

if ($state->player !== null || $state->error !== '') {
    fwrite(STDERR, "FAIL: initial state should be idle\n");
    exit(1);
}

echo "OK: iina view rendered headlessly (960x540)\n";
