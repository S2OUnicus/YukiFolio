<?php

declare(strict_types=1);

require_once __DIR__ . '/base.set.php';

if (!defined('PROJECT_BOOTSTRAPPED')) {
    define('PROJECT_BOOTSTRAPPED', true);
}

if (!function_exists('project_h')) {
    function project_h(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('project_abort')) {
    function project_abort(int $statusCode = 404, string $message = 'Not Found'): never
    {
        http_response_code($statusCode);
        header('Content-Type: text/plain; charset=UTF-8');
        exit($message);
    }
}

if (!function_exists('project_validate_id')) {
    function project_validate_id(mixed $value): int
    {
        $stringValue = is_string($value) || is_int($value) ? (string) $value : '';

        if ($stringValue === '' || preg_match('/\A\d+\z/', $stringValue) !== 1) {
            project_abort(404, 'Invalid id.');
        }

        return (int) $stringValue;
    }
}

if (!function_exists('project_validate_word')) {
    function project_validate_word(mixed $value): string
    {
        $stringValue = is_string($value) ? $value : '';

        if ($stringValue === '' || preg_match('/\A[A-Za-z0-9]+\z/', $stringValue) !== 1) {
            project_abort(404, 'Invalid word.');
        }

        return $stringValue;
    }
}

if (!function_exists('project_safe_file')) {
    function project_safe_file(string $baseDir, string $fileName): string
    {
        $resolvedBaseDir = realpath($baseDir);

        if ($resolvedBaseDir === false) {
            project_abort(500, 'Base directory is unavailable.');
        }

        $targetFile = $resolvedBaseDir . DIRECTORY_SEPARATOR . $fileName;
        $resolvedTarget = realpath($targetFile);

        if ($resolvedTarget === false || !is_file($resolvedTarget)) {
            project_abort(404, 'Data file was not found.');
        }

        if (strncmp($resolvedTarget, $resolvedBaseDir . DIRECTORY_SEPARATOR, strlen($resolvedBaseDir . DIRECTORY_SEPARATOR)) !== 0) {
            project_abort(403, 'Access denied.');
        }

        return $resolvedTarget;
    }
}

if (!function_exists('project_load_index_data')) {
    function project_load_index_data(): array
    {
        $dataFile = project_safe_file(__DIR__, 'index_im.php');

        $csn = null;
        $vsm = null;
        require $dataFile;

        if (!is_scalar($csn) || !is_scalar($vsm)) {
            project_abort(500, 'Index data is invalid.');
        }

        return [
            'csn' => (string) $csn,
            'vsm' => (string) $vsm,
        ];
    }
}

if (!function_exists('project_load_list_data')) {
    function project_load_list_data(string $type, int $id): array
    {
        $allowedTypes = ['Page', 'Post'];

        if (!in_array($type, $allowedTypes, true)) {
            project_abort(500, 'Unsupported data type.');
        }

        $dataDir = __DIR__ . '/Data/' . $type;
        $dataFile = project_safe_file($dataDir, $id . '.php');

        require $dataFile;
        $definedVariables = get_defined_vars();

        $items = [];

        foreach ($definedVariables as $key => $value) {
            if (preg_match('/\Alist-(\d+)\z/', $key, $matches) === 1) {
                $items[(int) $matches[1]] = is_scalar($value) ? (string) $value : '';
            }
        }

        if ($items === []) {
            project_abort(500, 'List data is empty.');
        }

        ksort($items);

        return $items;
    }
}

if (!function_exists('project_load_sp_data')) {
    function project_load_sp_data(string $word): array
    {
        $dataDir = __DIR__ . '/Data/SP';
        $dataFile = project_safe_file($dataDir, $word . '.php');

        $link = null;
        $title = null;
        require $dataFile;

        if (!is_string($link) || $link === '' || !is_string($title) || $title === '') {
            project_abort(500, 'SP data is invalid.');
        }

        if (filter_var($link, FILTER_VALIDATE_URL) === false) {
            project_abort(500, 'SP link is invalid.');
        }

        return [
            'link' => $link,
            'title' => $title,
        ];
    }
}

if (!function_exists('project_current_uri')) {
    function project_current_uri(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/Project/';
        return is_string($uri) ? $uri : '/Project/';
    }
}
