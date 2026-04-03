<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$a = \App\Models\Activity::first();
echo "Title: " . ($a->title ?? 'NULL') . "\n";
echo "Description: " . ($a->description ?? 'NULL') . "\n";
