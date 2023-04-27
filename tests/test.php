<?php declare(strict_types=1);

require_once dirname(__DIR__) . '/bootstrap.php';
require_once 'test_email.php';

$functions = array_filter(get_defined_functions()['user'], function (string $fn) {
    return strpos($fn, 'test_') === 0;
});

foreach ($functions as $function_name) {
    try {
        (new ReflectionFunction($function_name))->invoke();
    } catch (AssertionError $e) {
        print "\033[31m[FAIL]\033[0m {$function_name}: {$e->getMessage()}\n";
        continue;
    }

    print "\033[32m[OK]\033[0m {$function_name}\n";
}
