<?php

declare(strict_types=1);

/**
 * Prisma 11 - Sequential Release Tagger
 *
 * Automatically inspects existing git tags matching 'v1.0.*',
 * calculates the next sequential patch version (e.g., v1.0.1 -> v1.0.2),
 * creates the annotated git tag, and pushes it to origin.
 */

echo "=== Prisma 11 Sequential Release Tagger (v1.0.*) ===\n\n";

// 1. Fetch remote tags to ensure we have the latest list
echo "1. Obteniendo tags remotos desde origin...\n";
exec('git fetch origin --tags', $fetchOutput, $fetchStatus);

// 2. List all v1.0.* tags
exec('git tag -l "v1.0.*"', $tags, $listStatus);

if ($listStatus !== 0) {
    echo "Error al listar los tags de git.\n";
    exit(1);
}

$patchVersions = [];
foreach ($tags as $tag) {
    $tag = trim($tag);
    if (preg_match('/^v1\.0\.(\d+)$/', $tag, $matches)) {
        $patchVersions[] = (int) $matches[1];
    }
}

$nextPatch = empty($patchVersions) ? 0 : (max($patchVersions) + 1);
$nextTag = "v1.0.{$nextPatch}";

echo "Últimos tags encontrados: " . (empty($tags) ? "Ninguno" : implode(', ', $tags)) . "\n";
echo "-> Siguiente versión calculada en secuencia: {$nextTag}\n\n";

// 3. Create annotated git tag
$message = "Release {$nextTag}: Prisma 11 core updates";
echo "2. Creando git tag {$nextTag}...\n";
$cmdTag = sprintf('git tag -a %s -m %s', escapeshellarg($nextTag), escapeshellarg($message));
exec($cmdTag, $tagOutput, $tagStatus);

if ($tagStatus !== 0) {
    echo "Error al crear el tag {$nextTag}: " . implode("\n", $tagOutput) . "\n";
    exit(1);
}

echo "Tag {$nextTag} creado localmente con éxito.\n";

// 4. Push tag to origin
echo "3. Enviando tag {$nextTag} a origin...\n";
$cmdPush = sprintf('git push origin %s', escapeshellarg($nextTag));
exec($cmdPush, $pushOutput, $pushStatus);

if ($pushStatus !== 0) {
    echo "Error al enviar el tag a origin: " . implode("\n", $pushOutput) . "\n";
    exit(1);
}

echo "\n¡Tag {$nextTag} publicado exitosamente en GitHub!\n";
echo "Packagist detectará automáticamente la versión {$nextTag}.\n";
