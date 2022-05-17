<?php
$token = "Qb58w5ECBx8U6P9QwEvDvA6Lph3ftjgX";
if(isset($_GET["secret"]) && $_GET["secret"] === $token){
	function call_job($job){
		global $token;
		$url = "https://jenkins.asicde.online/buildByToken/build?job=".$job."&token=".$token."&cause=github+webhook+action";
		file_get_contents($url);
		echo "Job called\n";
		echo $url;
	}
    $signature = @$_SERVER['HTTP_X_HUB_SIGNATURE'];
    $event = @$_SERVER['HTTP_X_GITHUB_EVENT'];
    $delivery = @$_SERVER['HTTP_X_GITHUB_DELIVERY'];
	
	$payload = file_get_contents('php://input');
	$payload = json_decode($payload, true);
	
	$branch = preg_replace("/^refs\/heads\//", '', $payload["ref"]);
	$repository = $payload["repository"]["full_name"];
	
	/*
	$fp = fopen('payloads.txt', 'a');
	fwrite($fp, $repository);  
	fwrite($fp, "\n");  
	fwrite($fp, $branch);  
	fwrite($fp, "\n\n\n\n");  
	fclose($fp);
	*/
	
	switch($repository){
		case "ASICDE/asicde-docker":
			if($branch == "new-vps"){
				call_job("ASICDE-deploy-dev");
			}
			break;
		case "ASICDE/asicde-frontend":
			if($branch == "dev"){
				call_job("ASICDE-dev-frontend");
			}
			break;
		case "ASICDE/asicde-backend":
			if($branch == "dev"){
				call_job("ASICDE-dev-backend");
			}
			break;
		case "ASICDE/asicde-api":
			if($branch == "dev"){
				call_job("ASICDE-dev-api");
			}
			break;
		case "ASICDE/asicde-parent":
			if($branch == "dev"){
				call_job("ASICDE-dev-parent");
			}
			break;
		case "ASICDE/asicde-router":
			if($branch == "master"){
				call_job("ASICDE-router");
			}
			break;
		case "ASICDE/asicde-chat":
			if($branch == "master"){
				call_job("ASICDE-chat");
			}
			break;
		case "ASICDE/asicde-collab":
			if($branch == "master"){
				call_job("ASICDE-collab");
			}
			break;
		default:
			echo "No job for this repository";
	}
}
