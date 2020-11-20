## laravel-seafile 包使用说明

##### laravel-seafile包是对seafile云盘接口的简单封装

##### 1、配置参数

SEAFILE_HOST：seafile地址 xx.xx.xx.xx

SEAFILE_PORT：seafile端口

SEAFILE_USER：seafile用户名

SEAFILE_PASSWORD：seafile密码

##### 2、上传文件到seafile

    Seafile::uploadFile(文件路径,上传到的目录);

    Seafile::uploadFile(public_path('robots.txt'),'/test1');
    
##### 3、获取文件的下载地址

    Seafile::getDownloadUrl(文件在云盘的相对路径);
    
    Seafile::getDownloadUrl('/test1/robots.txt');