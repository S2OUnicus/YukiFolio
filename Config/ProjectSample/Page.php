<?php

declare(strict_types=1);

require_once __DIR__ . '/Project.php';

$pageId = project_validate_id($_GET['id'] ?? null);
$pageTitle = 'Page ' . $pageId;
$listItems = project_load_list_data('Page', $pageId);
