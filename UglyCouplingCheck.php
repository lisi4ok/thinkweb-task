<?php

declare(strict_types=1);
/**
 * This script analyzes dependencies between different modules in a PHP application by scanning the
 * /src/ directory for PHP class files and extracting use statements.
 * It identifies coupling between modules by detecting when one module imports classes from another.
 * @param string $dir
 * @param array $results
 * @return array
 */
function getDirContents(string $dir, array &$results = []) : array
{
    $files = scandir($dir);

    foreach ($files as $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            $results[] = $path;
        }
        elseif ($value !== "." && $value !== "..") {
            getDirContents($path, $results);
            $results[] = $path;
        }
    }

    return $results;
}

$appPath = __DIR__ . '/src/';
$correctedAppPath = str_replace('/', DIRECTORY_SEPARATOR, $appPath);
$modules = [];

foreach (getDirContents($appPath) as $fullPath) {
    $exploded = explode(DIRECTORY_SEPARATOR, $fullPath);
    if (substr($fullPath, -4) !== '.php' || !ctype_upper(end($exploded)[0])) {
        continue;
    }

    $pos = strpos($fullPath, $correctedAppPath);
    if ($pos !== false) {
        $classname = 'App\\' . explode('.php', substr_replace($fullPath, '', $pos, strlen($correctedAppPath)))[0];
        $content = file_get_contents($fullPath);

        $classparts = explode('\\', $classname);
        $module = $classparts[1];
        $submodule = $classparts[2] ?? '';

        $regex = '/\nuse [a-zA-Z_][a-zA-Z0-9_\\\\]*[a-zA-Z0-9_]/';
        preg_match_all($regex, $content, $matches);
        $useStatements = array_map(fn($val) => trim(str_replace('use ', '', $val)), $matches[0]);

        foreach ($useStatements as $useStatement) {
            if (empty($useStatement)) {
                continue;
            }

            if (stripos($useStatement, 'App\\') === 0) {
                $usedModule = explode('\\', $useStatement)[1];
            }
            else {
                $usedModule = explode('\\', $useStatement)[0];
            }

            if (!empty($usedModule) && $usedModule !== $module) {
                $modules[$module][$usedModule] = $usedModule;
                if (in_array($submodule, ['Application', 'Domain', 'Infrastructure'])) {
                    $modules[$module . '\\' . $submodule][$usedModule] = $usedModule;
                }
            }
        }
    }
}

foreach ($modules as $id => $module) {
    $modules[$id] = implode(', ', array_keys($module));
}
print_r($modules);
