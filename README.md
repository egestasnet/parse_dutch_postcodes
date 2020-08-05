# Parse Dutch Postcodes

Submit a random text and _parse_dutch_postcode.php_ attempts to extract a single postcode or multiple postcodes.

You call the function as :
```
$foundPostcodes = parsePostcode( $_POST['postcode'], TRUE/FALSE );
```
FALSE returns a single, unquoted, postcode, usually the first one it finds.
TRUE returns a comma separated string with quoted postcodes.

If nothing is found, the result is empty.

A single postcode is meant for inserting an address into a database where the address usually has one postcode.
```
INSERT name, street, postcode, city INTO customers VALUES('Name', 'Streetname', 'Postcode', 'Cityname');
```
Multiple postcodes are meant for selecting adresses in a database, like ;
```
SELECT name, street, postcode, city FROM customers WHERE postcode IN ('Postcode1', 'Postcode2', 'Postcode3');
```
The demo uses a FORM and a TEXTAREA.
The method is POST.
The parse_dutch_postcode.php file is included at the top of the page.

To dynamically parse postcodes, you can use AJAX and then check the returned result before submitting the FORM.

One step further you can use the result to search a database with sanitized POSTNL addresses and their postcodes to minimize wrong entries by the user.

See sample POSTCODE as SQL.

Here's the QUERY to select multiple postcodes :
```
SELECT * FROM postcode_NL WHERE PostcodeVolledig IN ('1234AB','5520ZZ','1091SC','8245BK','1234AB','1234AB') ORDER BY Plaats DESC
```
Select a single postcode with number and letters combined.
Remove the space in the result :
```
$PostcodeVolledig = preg_replace( '/ /' , '', $foundPostcodes );
```
So 5621 BJ becomes 5621BJ.

Then query the database :
```
$query = 'SELECT * FROM postcode_NL WHERE PostcodeVolledig = "' . $PostcodeVolledig . '"';
```
(SELECT * FROM postcode_NL WHERE PostcodeVolledig = "5621BJ")

Select a single postcode with number and letters separated.
Split the result into an array.
```
$PostcodeSplit = explode( ' ', $foundPostcodes);
```
Then query the database :
```
$query = 'SELECT * FROM postcode_NL WHERE PostcodeNummers = "' . $PostcodeSplit[0] . '" && PostcodeLetters = "' . $PostcodeSplit[1] . '"';
```
(SELECT * FROM postcode_NL WHERE PostcodeNummers = "5621" && PostcodeLetters = "BJ")
