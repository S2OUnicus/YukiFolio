<?php

declare(strict_types=1);

require_once __DIR__ . '/Project.php';

$postId = project_validate_id($_GET['id'] ?? null);
$pageTitle = 'Post ' . $postId;
$listItems = project_load_list_data('Post', $postId);
