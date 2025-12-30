
<?php

// Enable error reporting for debugging Vercel 500 errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<!-- Debug Start -->";

// Check for vendor directory
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    die("<h1>Critical Error</h1><p>vendor/autoload.php is MISSING. Composer did not run successfully.</p>");
}

// Check if public index exists
if (!file_exists(__DIR__ . '/../public/index.php')) {
    die("<h1>Critical Error</h1><p>public/index.php is MISSING.</p>");
}

// Try to require public index
try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    echo "<h1>Fatal Laravel Error</h1>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
