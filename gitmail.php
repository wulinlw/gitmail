<?php
$projects = [
	'framework' => 'E:\wamp\www\pt_git\framework',
	'login' => 'E:\wamp\www\pt_git\login',
	
];
if(empty($_POST)){
?>

<form method="post">
	<?php foreach ($projects as $k=>$v):?>
	<input type="checkbox" name="project[]" value="<?php echo $k; ?>" /><?php echo $k; ?>
	<?php endforeach; ?>
	<button type="submit">submit</button>
</form>

<?php
}else{

$body = "hi:\r\n";
foreach ($_POST['project'] as $key => $value) {
	$info = getLastCommitInfo($projects[$value]);
	$body .= genereteEmailBody($info, $value);
}
echo "<pre>$body</pre>";
}?>

<?php
function getLastCommitInfo($path){
	$return = [];
	//获取git仓库地址
	$command0 = substr($path, 0,2)." && cd {$path} && git remote -v";
	exec ($command0,$re0);
	$address = explode("\t",$re0[0])[1];
 
 	//获取最后一次commitid
	$command1 = substr($path, 0,2)." && cd {$path} && git log -1";
	exec ($command1,$re1);
	$commitId = explode(" ",$re1[0])[1];
	
	//取出一个最后更新的文件
	$command2 = substr($path, 0,2)." && cd {$path} &&  git show --stat ";
	exec ($command2,$re2);

	//计算文件md5
	$tmp = explode('|', $re2[count($re2)-2]);
	$checkFile = $path.'\\'.trim($tmp[0]);
	$c = file_get_contents($checkFile);
	$md5 = md5($c);
	return $return = [
		'address' => $address,
		'commitId' => $commitId,
		'msg' => trim($re1[4]),
		'file' => trim($tmp[0]),
		'md5' => $md5
	];
}
function genereteEmailBody($info, $project){
	$body = <<<EOT
	平台{$project}需要更新，请更新master分支，信息如下
	更新内容：{$info['msg']}
	git仓库：{$info['address']}
	commit: {$info['commitId']}
	验证指纹文件：{$info['file']}
	验证指纹MD5：{$info['md5']}\r\n

EOT;
	return $body;
}








