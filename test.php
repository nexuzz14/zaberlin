<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = Illuminate\Http\Request::create('/video', 'POST', [
    'title' => 'Test',
    'category' => 'podcast',
    'type' => 'youtube',
    'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    'owner_name' => 'Test Owner'
]);

try {
    $controller = $app->make('App\Http\Controllers\VideoController');
    $response = $controller->store($request);
    echo "Success: " . get_class($response) . "\n";
} catch (\Exception $e) {
    echo "Error: " . get_class($e) . "\n";
    echo $e->getMessage() . "\n";
    if ($e instanceof \Illuminate\Validation\ValidationException) {
        print_r($e->errors());
    }
}
