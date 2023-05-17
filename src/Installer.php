<?php

namespace Chunge\Laravel;

class Installer
{
    public static function copyFiles()
    {
        $sourcePath = __DIR__ . '/Support'; // 指定要复制的文件夹路径
        $destinationPath = __DIR__ .'/demos'; // Laravel中公共文件夹的路径
        // 执行文件复制操作
        self::recursiveCopy($sourcePath, $destinationPath);
        echo "执行成功 successfully!";
    }

    private static function recursiveCopy($source, $destination)
    {
        $dir = opendir($source);

        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        while (($file = readdir($dir)) !== false) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $sourcePath = $source . '/' . $file;
            $destinationPath = $destination . '/' . $file;

            if (is_dir($sourcePath)) {
                self::recursiveCopy($sourcePath, $destinationPath);
            } else {
                copy($sourcePath, $destinationPath);
            }
        }

        closedir($dir);
    }
}
