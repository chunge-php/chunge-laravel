<?php

namespace Chunge\Laravel;

class Installer
{
    protected $commands_path = '/app/Console/Commands';
    public  function copyFiles()
    {
        $sourcePath = __DIR__ . '/Support'; // 指定要复制的文件夹路径
        $destinationPath = __DIR__ . '/demos'; // Laravel中公共文件夹的路径
        // 执行文件复制操作
        $this->recursiveCopy($sourcePath, $destinationPath);
        echo "执行成功 successfully!";
    }


    //创建artisan自定义命令
    private  function createCommands()
    {
        //创建数据库初始化命令
        $this->createInitTable();
    }

    protected function createInitTable()
    {
        //createInitTableDemo.stub
        $content = file_get_contents('./stubs/createInitTableDemo.stub');
        $project_path = $this->getBasePath();
        $file_path = '/InitTable.php';
        $file_dir_path =  $project_path . $this->commands_path  . $file_path;
        $this->createFileSend($file_dir_path, $content, '创建数据库初始化文件命令');
    }

    protected function getBasePath()
    {
        $project_path = explode('vendor', __DIR__);
        $project_path = $project_path[0];
        return $project_path;
    }
    /**
     * 执行文件创建
     */
    public function createFileSend($file_path, $source, $message = '')
    {
        $logic_file = dirname($file_path); //返回路径中的目录部分
        if (file_exists($logic_file)) {
            $this->error("{$message}文件已存在");
            exit;
        }
        //创建
        if (file_exists($logic_file) === false) {
            if (mkdir($logic_file, 0777, true) === false) {
                $this->error("{$message}目录" . $logic_file . '没有写入权限');
                exit;
            }
        }
        //写入
        if (!file_put_contents($file_path, $source)) {
            $this->error("{$message}创建失败！");
            exit;
        }
        $this->error("{$message}创建成功！");
    }

    protected function error($message)
    {
        echo $message . PHP_EOL;
    }
    private  function recursiveCopy($source, $destination)
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
