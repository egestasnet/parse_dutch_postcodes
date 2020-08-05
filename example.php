<?php
include('parse_dutch_postcode.php');
?>

<hr />

<?php
if ( $_POST['pcinvoer'] )
{
	$postcodeResult = parsePostcode( htmlentities( sanitize ($_POST['pcinvoer'] ) ), isset( $_POST['keuze'] ) );
	echo '<pre>Result : ' . ( $postcodeResult <> '' ? $postcodeResult : 'Geen postcode gevonden...' ) . '</pre>' . PHP_EOL . PHP_EOL;
}
?>

<script>
function cleanInput()
{
	var regex = /(<([^>]+)>)/ig;
	var body   = document.getElementById('input').value;
	var result = body.replace(regex, "").trim();
	document.getElementById('input').value = result;
}
</script>

<form method="post" action="">
	<textarea maxlength="500" rows="15" id="input" name="pcinvoer" style="width: 90%; font-size: 120%;" placeholder="Characters between < and > are erased. So do not use that. Maximum 500 characters." onblur="cleanInput();" autofocus >value="Voorbeeld Postcode : = '1234ab ab 5520..zz...1091SC..%%8245BK%%.1234ab 1234ab';"</textarea><br />
	<label for="keuze">Met Quotes</label><input type="checkbox" id='keuze' name="keuze" value="Met quote" /> <input type="submit" name="" value="verzend" />
</form>
