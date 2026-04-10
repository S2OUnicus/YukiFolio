<?php

declare(strict_types=1);

define('PROJECT_BOOTSTRAPPED', true);

define('PROJECT_ROOT_DIR', __DIR__);
define('PROJECT_CONFIG_DIR', dirname(__DIR__, 3) . '/Config/Project');
define('PROJECT_PHTML_DIR', __DIR__ . '/common');

final class HttpException extends RuntimeException
{
    public function __construct(private readonly int $statusCode, string $message = '')
    {
        parent::__construct($message !== '' ? $message : 'HTTP Error');
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}

function respondError(int $statusCode, string $message): never
{
    http_response_code($statusCode);
    header('Content-Type: text/html; charset=UTF-8');

    $safeTitle = $statusCode === 404 ? '404 Not Found' : '500 Internal Server Error';
    $safeMessage = htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

    echo <<<HTML
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$safeTitle} - プロジェクト ゆきフォリオ 公式 (Project YukiFolio Official)</title>
</head>
<body>
    <h1>{$safeTitle}</h1>
    <p>{$safeMessage}</p>
</body>
</html>
HTML;

    exit;
}

function abortRequest(int $statusCode, string $message): never
{
    throw new HttpException($statusCode, $message);
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function normalizeQueryKeys(array $query): array
{
    $normalized = [];

    foreach ($query as $key => $value) {
        $normalizedKey = strtolower((string) $key);
        $normalized[$normalizedKey] = is_array($value) ? '' : trim((string) $value);
    }

    return $normalized;
}

function getRelativeRequestPath(): string
{
    $requestUri = (string) ($_SERVER['REQUEST_URI'] ?? '/');
    $path = parse_url($requestUri, PHP_URL_PATH);

    if (!is_string($path) || $path === '') {
        return '/';
    }

    foreach (['/standalone/Project', '/Project'] as $basePath) {
        if (str_starts_with($path, $basePath)) {
            $relative = substr($path, strlen($basePath));
            return $relative === '' ? '/' : $relative;
        }
    }

    return $path;
}

function parseRoute(array $query): array
{
    $relativePath = getRelativeRequestPath();
    $trimmedPath = trim($relativePath, '/');
    $segments = $trimmedPath === '' ? [] : array_values(array_filter(explode('/', $trimmedPath), 'strlen'));
    $lowerSegments = array_map(static fn (string $segment): string => strtolower(rawurldecode($segment)), $segments);

    if ($segments === [] || $lowerSegments === ['index'] || $lowerSegments === ['index.php']) {
        return parseQueryRoute($query, 'project');
    }

    if (count($segments) === 1) {
        if ($lowerSegments[0] === 'page') {
            return parseQueryRoute($query, 'page');
        }

        if ($lowerSegments[0] === 'post') {
            return parseQueryRoute($query, 'post');
        }

        if ($lowerSegments[0] === 'special') {
            return parseQueryRoute($query, 'special');
        }

        abortRequest(404, '許可されていないパスです。');
    }

    if (count($segments) === 2 && $lowerSegments[0] === 'page') {
        if (!preg_match('/^[0-9]+$/', $segments[1])) {
            abortRequest(404, 'Page の ID は数字のみです。');
        }

        return [
            'type' => 'page',
            'id' => $segments[1],
        ];
    }

    if (count($segments) === 2 && $lowerSegments[0] === 'post') {
        if (!preg_match('/^[0-9]+$/', $segments[1])) {
            abortRequest(404, 'Post の ID は数字のみです。');
        }

        return [
            'type' => 'post',
            'id' => $segments[1],
        ];
    }

    if (count($segments) === 2 && $lowerSegments[0] === 'special') {
        if (!preg_match('/^[A-Za-z0-9]+$/', $segments[1])) {
            abortRequest(404, 'Special の p は英数字のみです。');
        }

        return [
            'type' => 'special',
            'name' => $segments[1],
        ];
    }

    abortRequest(404, '許可されていないパスです。');
}

function parseQueryRoute(array $query, string $pathContext): array
{
    $hasPage = array_key_exists('page', $query);
    $hasPost = array_key_exists('post', $query);
    $hasSpecial = array_key_exists('special', $query);

    $routeFlags = (int) $hasPage + (int) $hasPost + (int) $hasSpecial;
    if ($routeFlags > 1) {
        abortRequest(404, '複数のルート指定はできません。');
    }

    if ($pathContext === 'project' && $routeFlags === 0) {
        return ['type' => 'project'];
    }

    if ($pathContext === 'page' || $hasPage) {
        $id = '';

        if (array_key_exists('id', $query)) {
            $id = $query['id'];
        } elseif ($hasPage && $query['page'] !== '') {
            $id = $query['page'];
        }

        if ($id === '' || !preg_match('/^[0-9]+$/', $id)) {
            abortRequest(404, 'Page の ID が不正です。');
        }

        return [
            'type' => 'page',
            'id' => $id,
        ];
    }

    if ($pathContext === 'post' || $hasPost) {
        $id = '';

        if (array_key_exists('id', $query)) {
            $id = $query['id'];
        } elseif ($hasPost && $query['post'] !== '') {
            $id = $query['post'];
        }

        if ($id === '' || !preg_match('/^[0-9]+$/', $id)) {
            abortRequest(404, 'Post の ID が不正です。');
        }

        return [
            'type' => 'post',
            'id' => $id,
        ];
    }

    if ($pathContext === 'special' || $hasSpecial) {
        $name = '';

        if (array_key_exists('p', $query)) {
            $name = $query['p'];
        } elseif ($hasSpecial && $query['special'] !== '') {
            $name = $query['special'];
        }

        if ($name === '' || !preg_match('/^[A-Za-z0-9]+$/', $name)) {
            abortRequest(404, 'Special の p が不正です。');
        }

        return [
            'type' => 'special',
            'name' => $name,
        ];
    }

    abortRequest(404, '許可されていないクエリです。');
}

function ensureInsideBaseDir(string $baseDir, string $targetPath): string
{
    $normalizedBaseDir = rtrim(str_replace('\\', '/', $baseDir), '/');
    $normalizedTargetPath = str_replace('\\', '/', $targetPath);

    if (!str_starts_with($normalizedTargetPath, $normalizedBaseDir . '/')) {
        abortRequest(500, '不正なファイル参照を検出しました。');
    }

    return $targetPath;
}

function caseInsensitiveFilePath(string $directory, string $requestedName, string $extension = '.php'): string
{
    if (!is_dir($directory)) {
        abortRequest(500, 'ディレクトリが見つかりません。');
    }

    $entries = scandir($directory);
    if ($entries === false) {
        abortRequest(500, 'ディレクトリ一覧の取得に失敗しました。');
    }

    $target = strtolower($requestedName . $extension);

    foreach ($entries as $entry) {
        if (strtolower($entry) === $target) {
            $path = $directory . '/' . $entry;
            return ensureInsideBaseDir($directory, $path);
        }
    }

    abortRequest(404, '対象ファイルが見つかりません。');
}

function loadPhpVariables(string $filePath): array
{
    if (!is_file($filePath) || !is_readable($filePath)) {
        abortRequest(404, '設定ファイルが見つかりません。');
    }

    $data = (static function (string $__file): array {
        require $__file;
        unset($__file);
        return get_defined_vars();
    })($filePath);

    return $data;
}

function renderTemplate(string $templatePath, array $variables = []): string
{
    if (!is_file($templatePath) || !is_readable($templatePath)) {
        abortRequest(500, 'テンプレートが見つかりません。');
    }

    ob_start();

    try {
        extract($variables, EXTR_SKIP);
        require $templatePath;
        return (string) ob_get_clean();
    } catch (Throwable $throwable) {
        ob_end_clean();
        throw $throwable;
    }
}

function buildListItems(array $configVariables): array
{
    $items = [];

    foreach ($configVariables as $key => $value) {
        if (preg_match('/^list_[0-9]+$/', $key) === 1) {
            $items[$key] = (string) $value;
        }
    }

    if ($items === []) {
        abortRequest(500, 'list_* 変数が見つかりません。');
    }

    uksort(
        $items,
        static fn (string $left, string $right): int => strnatcmp($left, $right)
    );

    return array_values($items);
}

function resolveProjectView(): array
{
    $config = loadPhpVariables(ensureInsideBaseDir(PROJECT_CONFIG_DIR, PROJECT_CONFIG_DIR . '/Project.php'));

    return [
        'template' => ensureInsideBaseDir(PROJECT_PHTML_DIR, PROJECT_PHTML_DIR . '/Project.phtml'),
        'variables' => [
            'csn' => (string) ($config['csn'] ?? ''),
            'vsm' => (string) ($config['vsm'] ?? ''),
        ],
        'stageMode' => 'default',
        'title' => 'Project',
    ];
}

function resolvePageView(string $id): array
{
    $configPath = ensureInsideBaseDir(PROJECT_CONFIG_DIR, PROJECT_CONFIG_DIR . '/Page/' . $id . '.php');
    $config = loadPhpVariables($configPath);

    return [
        'template' => ensureInsideBaseDir(PROJECT_PHTML_DIR, PROJECT_PHTML_DIR . '/Page.phtml'),
        'variables' => [
            'items' => buildListItems($config),
            'pageId' => $id,
        ],
        'stageMode' => 'default',
        'title' => 'Page ' . $id,
    ];
}

function resolvePostView(string $id): array
{
    $configPath = ensureInsideBaseDir(PROJECT_CONFIG_DIR, PROJECT_CONFIG_DIR . '/Post/' . $id . '.php');
    $config = loadPhpVariables($configPath);

    return [
        'template' => ensureInsideBaseDir(PROJECT_PHTML_DIR, PROJECT_PHTML_DIR . '/Post.phtml'),
        'variables' => [
            'items' => buildListItems($config),
            'postId' => $id,
        ],
        'stageMode' => 'default',
        'title' => 'Post ' . $id,
    ];
}

function resolveSpecialView(string $name): array
{
    $configDirectory = ensureInsideBaseDir(PROJECT_CONFIG_DIR, PROJECT_CONFIG_DIR . '/Special');
    $templateDirectory = ensureInsideBaseDir(PROJECT_PHTML_DIR, PROJECT_PHTML_DIR . '/Special');

    $configPath = caseInsensitiveFilePath($configDirectory, $name);
    $templatePath = caseInsensitiveFilePath($templateDirectory, $name, '.phtml');
    $config = loadPhpVariables($configPath);

    $link = isset($config['link']) ? (string) $config['link'] : '';
    $title = isset($config['title']) ? (string) $config['title'] : '';

    if ($link === '' || $title === '') {
        abortRequest(500, 'Special の設定値が不足しています。');
    }

    if (filter_var($link, FILTER_VALIDATE_URL) === false) {
        abortRequest(500, 'Special の link が不正です。');
    }

    return [
        'template' => $templatePath,
        'variables' => [
            'link' => $link,
            'title' => $title,
        ],
        'stageMode' => 'replace',
        'title' => 'Special ' . $name,
    ];
}

try {
    $query = normalizeQueryKeys($_GET);
    $route = parseRoute($query);

    $view = match ($route['type']) {
        'project' => resolveProjectView(),
        'page' => resolvePageView($route['id']),
        'post' => resolvePostView($route['id']),
        'special' => resolveSpecialView($route['name']),
        default => throw new LogicException('未対応のルートです。'),
    };

    $content = renderTemplate($view['template'], $view['variables']);
} catch (HttpException $exception) {
    respondError($exception->getStatusCode(), $exception->getMessage());
} catch (Throwable $throwable) {
    error_log($throwable->getMessage());
    respondError(500, 'サーバー内部でエラーが発生しました。');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($view['title']) ?> - プロジェクト ゆきフォリオ 公式 (Project YukiFolio Official)</title>
</head>
<body>
    <noscript>JavaScript を有効にしてください。</noscript>
    <div id="stage">
        <?php if ($view['stageMode'] === 'replace'): ?>
            <?= $content ?>
        <?php else: ?>
            <header>
                <h1>This Page Requires Javascript.</h1>
            </header>
            <nav>
                <ul>
                    <li><a href="/standalone/Project/">Project</a></li>
                    <li><a href="/standalone/Project/Page/1">Page 1</a></li>
                    <li><a href="/standalone/Project/Post/1">Post 1</a></li>
                    <li><a href="/standalone/Project/Special/Dash">Special Dash</a></li>
                </ul>
            </nav>
            <main>
                <div id="pst_main">
                    <?= $content ?>
                </div>
            </main>
            <footer>
                <small>&copy; Project Footer</small>
            </footer>
        <?php endif; ?>
    </div>
</body>
</html>
