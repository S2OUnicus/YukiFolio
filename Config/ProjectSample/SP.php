<?php

declare(strict_types=1);

require_once __DIR__ . '/Project.php';

$word = project_validate_word($_GET['wd'] ?? null);
$pageTitle = 'SP ' . $word;
$spData = project_load_sp_data($word);
