<?php
$_POST['base_dir'] = addslashes($_POST['base_dir']);

$base_dir = $_POST['base_dir'];
$base_url = $_POST['base_url'];
$site_name = $_POST['site_name'];
$curl_enabled = $_POST['curl_enabled'];
$mail_server = $_POST['mail_server'];
$mail_user = $_POST['mail_user'];
$mail_pw = $_POST['mail_pw'];
$sa_user = $_POST['sa_user'];
$sa_id = $_POST['sa_id'];
$sa_email = $_POST['sa_email'];
$pw_plain = $_POST['sa_password'];
    
$sql = file_get_contents('../sql/PHPLoginDB.sql');    

$_POST['sa_password'] = password_hash($pw_plain, PASSWORD_DEFAULT);

if (preg_match_all("/{{(.*?)}}/", $sql, $m)) {
  foreach ($m[1] as $i => $varname) {
    $sql = str_replace($m[0][$i], sprintf('%s', '\''.$_POST[$varname].'\''), $sql);
  }
}

echo '<b>1) Copy/Paste this SQL statement into your SQL client and execute as user with root privileges</b><br>
    <textarea id="sqlResults" class="form-control" rows="10" cols="70">'. $sql .'</textarea>
    <button id="copySql" class="btn btn-default col-md-4">Copy to Clipboard</button><span class="col-md-4" id="copyNotifSql"></span><br>
    <br><script>
     $("#copySql").click(function(){

        $("#sqlResults").select();
        document.execCommand("copy");

        $("#copyNotifSql").html("Copied text to clipboard</div>").fadeOut(2000);

    });</script>';

