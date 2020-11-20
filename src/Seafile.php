<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2020/11/19
 * Time: 9:42
 */

namespace Jiajiale\LaravelSeafile;


use Illuminate\Support\Facades\Cache;
use Jiajiale\LaravelSeafile\Http\Client;
use Jiajiale\LaravelSeafile\Resource\Auth;
use Jiajiale\LaravelSeafile\Resource\Directory;
use Jiajiale\LaravelSeafile\Resource\File;
use Jiajiale\LaravelSeafile\Resource\Library;

class Seafile
{
    protected $config;
    protected $baseUri;
    protected $client;
    protected $library;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->baseUri = 'http://' . $this->config['seafile']['host'] . ':' . $this->config['seafile']['port'];
    }

    /**
     * 获取上传客户端
     */
    public function getClient(){
        $token = Cache::get("seafile:token");
        if(!$token){
            $authResource = new Auth(new Client([
                'base_uri' => $this->baseUri,
            ]));
            $token = $authResource->getToken($this->config['seafile']['username'],$this->config['seafile']['password']);
            Cache::put("seafile:token",$token,1440);
        }
        $this->client = new Client(
            [
                'base_uri' => $this->baseUri,
                'debug' => false,
                'headers' => [
                    'Authorization' => 'Token ' . $token
                ]
            ]
        );
    }

    /**
     * 获取上传根目录
     */
    public function getLibrary(){
        if(!$this->client){
            $this->getClient();
        }
        $libraryResource = new Library($this->client);
        $this->library = $libraryResource->getById('7a8a830b-d305-4760-b602-7414f9ca598e');
    }

    /**
     * 上传文件
     * @param $filePath
     * @param $directory
     * @return string
     */
    public function uploadFile($filePath,$directory){
        set_time_limit(30);

        try{
            if(!$this->library){
                $this->getLibrary();
            }

            $directoryResource = new Directory($this->client);
            $parentDir = '/';
            if($directoryResource->exists($this->library, $directory, $parentDir) === false) {
                $directoryResource->create($this->library, $directory, $parentDir, true);
            }

            $fileResource = new File($this->client);

            $response = $fileResource->upload($this->library, $filePath, $directory);
            $uploadedFileId = (string)$response->getBody();
            return $uploadedFileId;
        }catch(\Exception $e){
            var_dump($e);
        }

    }

    /**
     * 获取文件下载地址
     * @param $path
     * @return string
     */
    public function getDownloadUrl($path){
        try{
            if(!$this->library){
                $this->getLibrary();
            }
            $fileResource = new File($this->client);
            $directoryItem = $fileResource->getFileDetail($this->library,  $path);
            return $fileResource->getDownloadUrl($this->library,$directoryItem,dirname($path) . '/');
        }catch(\Exception $e){

        }
    }
}