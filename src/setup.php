<?php


// 源文件路径
$sourceFile = __DIR__ . '/src/Support/Helper.php';

// 目标文件夹路径
$targetFolder = __DIR__ . '/../../../app/Support';

// 如果目标文件夹不存在，创建它
if (!file_exists($targetFolder)) {
    mkdir($targetFolder, 0755, true);
}

// 目标文件路径
$targetFile = $targetFolder . '/Helper.php';

// 复制文件
if (!file_exists($targetFile)) {
    copy($sourceFile, $targetFile);
}