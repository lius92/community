<?php
/**
 * Created by PhpStorm.
 * User: paz
 * Date: 2019-12-31
 * Time: 14:31
 */

namespace Modules\Admin\Services;


abstract class BaseService
{
    protected $logger;

    public function __construct(
        //LoggerInterface $logger
    )
    {
        //$this->logger = $logger;
    }

    /**
     * 创建目录(可多级)
     * @param $path
     * @param int $mode
     */
    public function createDir($path, $mode = 0777)
    {
        if (!file_exists($path)) {
            $this->createDir(dirname($path), $mode);
            mkdir($path, $mode);
        }
    }

    /**
     * @param $dir
     * @return bool
     */
    public function deleteDir($dir)
    {
        if (!is_dir($dir)) {
            return false;
        }
        $handle = opendir($dir);
        while (($file = readdir($handle)) !== false) {
            if ($file != "." && $file != "..") {
                is_dir("$dir/$file") ? $this->deleteDir("$dir/$file") : @unlink("$dir/$file");
            }
        }
        if (readdir($handle) == false) {
            closedir($handle);
            @rmdir($dir);
        }
    }

    /**
     * @param $oldPath
     * @param $targetPath
     */
    public function renameDir($oldPath, $targetPath)
    {
        if (file_exists($oldPath)) {
            @rename($oldPath, $targetPath);
        }
    }

    /**
     * @param $url
     * @param $uploadPath
     * @return mixed
     */
    public function changeUploadPath($url, $uploadPath)
    {
        $tempPath = parse_url($url)['path'];
        $path = str_replace("/temp", '', $tempPath);

        $this->createDir(dirname(dirname($uploadPath) . $path));
        @copy(dirname($uploadPath) . $tempPath, dirname($uploadPath) . $path);

        return $path;
    }

    /**
     * @param $length
     * @return string
     */
    public function randomKeys($length)
    {
        $output = '';
        for ($n = 0; $n < $length; $n++) {
            $output .= chr(mt_rand(65, 90));
        }
        return $output;
    }

}
