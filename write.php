<html>

<head>
<link rel="stylesheet" href="style.css" type = "text/css" />
</head>

<body link = "black" vlink = "black" alink = "#696969">
<table>
<form method = "POST" action = "notes.php">

<tr>
<td>
<?php 
$cal = include 'cal1.php';
$curDate = $_POST['date'];
$_GET['tt'] = $_GET['m_n'];
?>
</td>
<td>
<select required name = 'hours'><option disabled>hh</option>
  <?php 
	/*
	foreach (range('0', '23') as $value)
	{
		print "<option>".$value."</option>";
	}
	/*/
	$hArr = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19',
				  '20', '21', '22', '23');
	foreach ($hArr as $hour)
	{
		print "<option>" . $hour . "</option>";
	}
	// */
  ?>
</select>
:
<select required name = 'minutes'><option disabled>mm</option>
  <?php 
	/*
	foreach (range('0', '60') as $value1)
	{
		print "<option>".$value1."</option>";
	}
	/*/
	
	$mArr = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19',
				  '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39',
				  '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59');
	foreach ($mArr as $minut)
	{
		print "<option>" . $minut . "</option>";
	}
	// */

  ?>
</select>
<input type = "checkbox" name = "type" value = "1" id = "A" /><label for = "A">Публичная заметка</label>
<p align = "center">
    <textarea name = "note" cols = "120" class = "data"></textarea>
    <input type = "hidden" name = "dm" value = "<?php echo $_GET['m'];?>">
	<input type = "submit" name = "input" value = "Записать" />
</p>
<p>Сортировать:</p>
	<p>
	<input type = "radio" name = "dataSort" value = "date" id = "d" /><label for = "d">по дате</label>
	<input type = "radio" name = "dataSort" value = "time" id = "t" /><label for = "t">по добавлению</label>
	<select name = 'viewType'>
	<option disabled>Показать:</option>
	<option value = "2">Все заметки</option>
	<option value = "1">публичные заметки</option>
	<option value = "0">личные заметки</option>
	</select>
	<input type = "submit" name = "inpt" value = "Посмотреть" />
	</p>
</form> 
</td>
</tr>
</table>
</body>
</html>

