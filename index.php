<script src="https://code.jquery.com/jquery-3.2.1.min.js" charset="utf-8"></script>
<script type="text/javascript">
if (localStorage.getItem("theme") == "light") {
  $('html').css({background:'white', color:'black'});
  $('img').css({background:'white'});

}
if (localStorage.getItem("theme") == "night") {
  $('html').css({background:'black', color:'white'});
  $('img').css({background:'white'});

}

</script>

<?php
 
if (@$_REQUEST['text'] && @$_REQUEST['name']) {
          $text = $_REQUEST['text'];
          $name = $_REQUEST['name'];

          $name = htmlspecialchars($name);
          $text = htmlspecialchars($text);
          $text = preg_replace('/^(.*)(\r?\n)/mi', "$1<br>", $text);
          $text = preg_replace('/ /mi', "&nbsp", $text);
          if (preg_match('/\[b\](.*)\[\/b\]/mi', $text)) {
            $text = preg_replace('/\[b\](.*)\[\/b\]/mi', "<b>$1</b>", $text);
          }
          if (preg_match('/\[i\](.*)\[\/i\]/mi', $text)) {
            $text = preg_replace('/\[i\](.*)\[\/i\]/mi', "<i>$1</i>", $text);
          }

          if (preg_match('/\[h[1-6]\](.*)\[\/h[1-6]\]/mi', $text)) {
            $text = preg_replace('/\[h([1-6])\](.*)\[\/h[1-6]\]/mi', "<h$1>$2</h$1>", $text);
          }

          if (preg_match('/\[a&nbsphref=(.*?)\](.*)\[\/a\]/mi', $text)) {

            $text = preg_replace('/\[a&nbsphref=(.*?)\](.*)\[\/a\]/mi', "<a href='$1'>$2</a>", $text);
          }


          if (preg_match('/\[u\](.*)\[\/u\]/mi', $text)) {
              $text = preg_replace('/\[u\](.*)\[\/u\]/mi', "<u>$1</u>", $text);
          }

          if (preg_match('/\[strike\](.*)\[\/strike\]/mi', $text)) {
              $text = preg_replace('/\[strike\](.*)\[\/strike\]/mi', "<strike>$1</strike>", $text);
          }

          echo "<br>Отправитель: $name<br>";
          echo "Письмо: <br>" . $text . "<br><br>";
          }





?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Редактор</title>
    <style media="screen">

      body {
        width: 100%;
        word-wrap: break-word;
      }
      form {
        width: 100%;
      }
      img {
        padding: 0.260416666667%;
        max-width: 100%;
        width: 1.5625%;
        border: 1px solid #000;
        border-radius: 50px;
        background-color: white;
      }

      textarea {
        width: 40.04166666666667%;
        height: 100px;

      }

      input {
        width: 40.04166666666667%;
        height: 50px;
      }

      .switchs {
        width: 3%;
      }


    </style>

  </head>
  <body>

<div class="links">
  Панель управления:<br>
  <i>Здесь вы можете оставить свой комментарий!<br> Просто выделите текст и нажмите соответствующию иконку! <b><br>ВНИМАНИЕ! У ВАС ДОЛЖЕН БЫТЬ ВКЛЮЧЕН JAVASCRIPT</b></i><br><br>
  <div class="panel">
  <a id="button-b" href="#"><img src="bt.jpg"></a>
  <a id="button-i" href="#"><img src="it.png"></a>
  <a id="button-u" href="#"><img src="ui.png"></a>
  <a id="button-s" href="#"><img src="a2i.png"></a>
  <a id="button-a" href="#"><img src="li.png"></a>
  <a id="button-h" href="#"><img src="hi.png"></a>
</div>
</div>

<script>

function addTag(open, close) {
	var control = $('#texta')[0];
	var start = control.selectionStart;
	var end = control.selectionEnd;
	if (start != end) {
		var text = $(control).val();
		$(control).val(text.substring(0, start) + open + text.substring(start, end) + close + text.substring(end));
		$(control).focus();
		var sel = end + (open + close).length;
		control.setSelectionRange(sel, sel);
	}
	return false;
}

// Жирный
$('#button-b').click(function(){
	return addTag('[b]', '[/b]');
});

// Курсив
$('#button-i').click(function(){
	return addTag('[i]', '[/i]');
});

// Подчеркнутый
$('#button-u').click(function(){
	return addTag('[u]', '[/u]');
});

// Зачеркнутый
$('#button-s').click(function(){
	return addTag('[strike]', '[/strike]');
});

// Ссылка
$('#button-a').click(function(){
	return addTag('[a href="' + prompt('Введите адрес', '') + '"]', '[/a]');
});


$('#button-h').click(function(){
  headSize = prompt("Введите размер заголовка(1-6): ");
	return addTag('[h' + headSize + ']', '[/h' + headSize +']');
});
// При клике на кнопки не снимаем фокус с textarea.
$('a').on('mousedown', function() {
	return false;
});



</script>
    <form  action=<?=$_SERVER['SCRIPT_NAME'];?> method="post">
          <textarea name="text" id="texta"></textarea><br>
          <input type="text" name="name"><br>
          <input type="submit" value="Send"><br>

    </form>
    Тёмная тема: <input type="radio" name="switcher" value="night" class="switchs" id="switchs"><br>
    Светлая тема:<input type="radio" name="switcher" value="night" class="switchs" id="switchs2">
    <script type="text/javascript">
    switchs.addEventListener("click", function() {
      if (localStorage.getItem("theme") == "night") {
        $('html').css({background:'black', color:'white'});
        $('img').css({background:'white'});
      }
      else if ($('#switchs').val() == "night") {
        $('html').css({background:'black', color:'white'});
        $('img').css({background:'white'});
        localStorage.setItem("theme", "night");
      }

    })
    switchs2.addEventListener("click", function() {
      if (localStorage.getItem("theme") == "light") {
        $('html').css({background:'white', color:'black'});
      } else if ($('#switchs2').val() == "night") {
        localStorage.setItem("theme", "light");
        $('html').css({background:'white', color:'black'});
      }
    })
    </script>
  </body>
</html>
