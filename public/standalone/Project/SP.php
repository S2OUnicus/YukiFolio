<?php

declare(strict_types=1);

require_once dirname(__DIR__, 3) . '/Config/Project/SP.php';
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <?php require_once $common_dir . '/meta.phtml'; ?>
        <title><?= project_h($pageTitle); ?></title>
        <?php require_once $common_dir . '/link.phtml'; ?>
        <?php require_once $common_dir . '/pwa.phtml'; ?>
        <?php require_once $common_dir . '/css.phtml'; ?>
        <?php require_once $common_dir . '/script_first.phtml'; ?>
    </head>
    <body>
        <?php require_once $common_dir . '/noscript.phtml'; ?>
        <div id="stage">
            <?php require_once $inner_dir . '/SP.phtml'; ?>
        </div>
        <?php require_once $common_dir . '/script_last.phtml'; ?>
    </body>
</html>
