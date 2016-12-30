# gitmail
生成git更新邮件内容

手动写邮件很麻烦，随手写个脚本偷懒  
修改$projects数组，放到web目录访问，选择对应的项目点提交即可

```php
$projects = [
	'framework' => 'E:\wamp\www\pt_git\framework',
	'login' => 'E:\wamp\www\pt_git\login',
];
```

显示效果：  
```goalng
hi:
	framework需要更新，请更新master分支，信息如下
	更新内容：xxx底层逻辑变更
	git仓库：git@git.xxx.com:kkk/framework.git (fetch)
	commit: 6efdec1373347890f874572c1af093541bae62b8
	验证指纹文件：protected/models/mysql/ApiUser.php
	验证指纹MD5：0c8db9ed4456eb8a8f1cf0b882ec87f7

	login需要更新，请更新master分支，信息如下
	更新内容：加入xxx功能
	git仓库：git@git.xxx.com:kkk/login.git (fetch)
	commit: 58141421d37adf6a5f55dcc18194f2b8eb9ec4a0
	验证指纹文件：protected/components/Curl.php
	验证指纹MD5：fe071cc731b628ef7211ab7224b10999
```
