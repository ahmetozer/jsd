<?php
$dosyaismi = $_REQUEST['file'];
$file = getcwd() . "/writes" . $dosyaismi . '.txt';
include 'config.php';
$yaziurl = "$yazisayfaurl" . $dosyaismi;
$yazikonum = $dosyaismi .'.txt';
////////// 
$parts = explode('/',$yazikonum);
//$dir = $_SERVER['SERVER_NAME'];
for ($i = 0; $i < count($parts) - 1; $i++) {
 $dosyadir .= $parts[$i] . "/";
}
//////////
if (isset($_GET['worker'])) {
	if ( $_GET['worker'] == 'folder') {
		mkdir(substr("/writes" . $dosyadir, 1, -1), 0777, true);
		header("location:/editor.php?file=$dosyaismi");
	}
	if ( $_GET['worker'] == 'file') {
		$current = "Dosya oluşturma tarihi " . date("Y/m/d");
		file_put_contents($file, $current);
		header("location:/editor.php?file=$dosyaismi");
	}
	
} else {
if (!file_exists(getcwd() . "/writes" . $dosyadir)) {
	$text = "
	
	Klasör Bulunamadı
	'$dosyadir' 
	".substr("/writes" . $dosyadir, 1 , -1);
	$dosyayok='1';
} else {
if (file_exists($file)) {

	// configuration

	$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	

	// check if form has been submitted
	if (isset($_POST['text']))
	{
		// save the text contents
	file_put_contents($file, $_POST['text']);
	$fileuft8 = file_get_contents("$file");
	$fileuft8 = str_replace("\r", "", $fileuft8);
	file_put_contents("$file", $fileuft8);

		// redirect to form again
		header("location:/editor.php?file=$dosyaismi");
		printf('<a href="%s">Moved</a>.', htmlspecialchars($url));
		exit();
	}

	// read the textfile
	$dosyayok='0';
	$text = file_get_contents($file);
} else {
    $text = "
	
	Dosya Bulunamadı 
	'$file' 
	";
	$dosyayok='2';
}
}
}
?>
<!-- HTML form -->
<style type="text/css">
textarea {
  width: 100%;
  height: 85%;
		border:none;
		font-family: Verdana, Geneva, sans-serif;
		font-size: 20px;
		background-color: #38342D;
		color: white;
 margin: 0px;
}
body {
    background-color: #060807;
				 margin: 0px;
}
.button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 1% 1%;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
   # margin: 4px 2px;
    cursor: pointer;
				 margin: 0px;
}
.adress {
	border:none;
		font-family: Verdana, Geneva, sans-serif;
		font-size: 30px;
		background-color: Black;
		color: white;
 margin: 5px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div > <a href="<?php echo $yaziurl; ?>" class="adress"> Yazıyı Görüntüle </a>
<a href="https://www.google.com/webmasters/tools/submit-url?urlnt=<?php echo $yaziurl; ?>"class="adress"> Google Pingle </a></div>


<?php if ($dosyayok == 0): ?>
<form action="?save" method="post" id="form1">
<input type="hidden" name="file" value="<?php echo $dosyaismi; ?>">
<textarea name="text" id="text"><?php echo htmlspecialchars($text) ?></textarea>
<input type="submit" class="button" value="Kaydet"/>
<input type="reset" class="button" value="Geri al"/>
</form>
<?php endif; ?>

<?php if ($dosyayok == 1): ?>
<form action="?save" method="get" id="form1">
<input type="hidden" name="file" value="<?php echo $dosyaismi; ?>">
<textarea name="text" id="text"><?php echo htmlspecialchars($text) ?></textarea>
<input type="hidden" name="worker" value="folder">
<input type="submit" class="button" value="Klasör Oluştur"/>
</form>
<?php endif; ?>

<?php if ($dosyayok == 2): ?>
<form action="?save" method="get" id="form1">
<input type="hidden" name="file" value="<?php echo $dosyaismi; ?>">
<textarea name="text" id="text"><?php echo htmlspecialchars($text) ?></textarea>
<input type="hidden" name="worker" value="file">
<input type="submit" class="button" value="Dosya Oluştur"/>
</form>
<?php endif; ?>

<script>
$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
			document.getElementById("form1").submit();
            break;
        case 'f':
            event.preventDefault();
            alert('ctrl-f');
            break;
        case 'g':
            event.preventDefault();
			document.getElementById("form1").reset();
            break;
        }
    }
});
$("textarea").keydown(function(e) {
    if(e.keyCode === 9) { // tab was pressed
        // get caret position/selection
        var start = this.selectionStart;
        var end = this.selectionEnd;

        var $this = $(this);
        var value = $this.val();

        // set textarea value to: text before caret + tab + text after caret
        $this.val(value.substring(0, start)
                    + "\t"
                    + value.substring(end));

        // put caret at right position again (add one for the tab)
        this.selectionStart = this.selectionEnd = start + 1;

        // prevent the focus lose
        e.preventDefault();
    }
});
</script>
