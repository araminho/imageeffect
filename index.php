<?php
header("Content-Type: text/html; charset=utf-8");

require_once('effect.php');
$effects = Effect::findAll();
//echo "<pre>"; print_r($effects); echo "</pre>"; exit;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
	<title>Plugin framework</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h3>Plugin framework</h3>
        </div>
		<div class="row form_container" style="margin:10px">
            <form action="/applyeffect.php" method="post" id="effectForm" enctype="multipart/form-data">
                <input type="file" name="image" class="file"/>

                <?php foreach ($effects as $effect) { ?>
                    <input type="checkbox" name="effect[<?php echo $effect->getId(); ?>]" />
                    <?php echo $effect->getName(); ?>
                <?php } ?>
                &nbsp; &nbsp; &nbsp;
                Parameter: <input type="text" name="parameter" class=""/>
                <input type="submit" value="Apply" class="form_submit" style="margin-left:50px"/>
            </form>
        </div>



    </div>
    <a href="javascript:void(0)" onclick="addFormRow()">Add more images</a>
    <script src="/js/jquery-1.10.2.min.js"></script>
    <script src="/js/js.js"></script>
  </body>
</html>