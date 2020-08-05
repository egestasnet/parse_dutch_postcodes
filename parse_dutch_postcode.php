<?php
function parsePostcode( $postcode , $quote = TRUE ) 
{
	$apostr   = ( $quote == TRUE ? "'" : '' );
		//echo 'a. ' . $postcode . '<br />' . PHP_EOL;
	$postcode = strtoupper( $postcode );
		//echo 'b. ' . $postcode . '<br />' . PHP_EOL;
	$postcode = trim( preg_replace("/[^a-zA-Z0-9]/", " ", $postcode ) );
		echo 'Input : ' . $postcode . '<br />' . PHP_EOL;
	$postcode = preg_split( "/[\s]+/", $postcode );
		echo '<pre>before : ' . print_r( $postcode, TRUE ) . '</pre>' . PHP_EOL . PHP_EOL;
	$count    = ( $quote == TRUE ? count( $postcode ) : count( $postcode ) );

	for ( $i = 0; $i < $count; $i++ )
	{
		if (
			( strlen( $postcode[$i] ) == 4 && is_numeric( $postcode[$i] ) )
			&&
			( strlen( $postcode[$i + 1] ) == 2 && !is_numeric( $postcode[$i + 1] ) )
		)
		{
			$postcode[$i] = $apostr . $postcode[$i] . ' ' . $postcode[$i + 1] . $apostr;
			unset( $postcode[$i+1] );
		}

		elseif (
			( strlen( $postcode[$i] ) == 4 ) && is_numeric( $postcode[$i] )
			&&
			( strlen( $postcode[$i + 1] ) >= 2 )
		)
		{
			unset( $postcode[$i] );
		}

		elseif (
			strlen( $postcode[$i] ) == 2 && strlen( $postcode[$i+1] ) == 2
		)
		{
			$postcode[$i+1] = $postcode[$i] . $postcode[$i+1];
			unset( $postcode[$i] );
		}

		elseif ( strlen( $postcode[$i] ) == 6 && is_numeric( substr( $postcode[$i], 0, 4 ) ) )
		{
			$postcode[$i] = $apostr . substr( $postcode[$i], 0, 4 ) . ' ' .  substr( $postcode[$i], 4 ) . $apostr;
		}

		elseif ( strlen( $postcode[$i] ) == 6 && is_numeric( substr( $postcode[$i], 4 ) ) )
		{
			$postcode[$i] = $apostr . substr( $postcode[$i], 2 ) . ' ' .  substr( $postcode[$i], 0, 2 ) . $apostr;
		}

		elseif ( $postcode[$i] == '' || $postcode[$i] == ' ' )
		{
			unset( $postcode[$i] );
		}

		elseif ( strlen( $postcode[$i] ) > 6 )
		{
			unset( $postcode[$i] );
		}

		elseif ( $postcode[$i] == '' )
		{
			unset( $postcode[$i] );
		}

		else
		{
			$postcode[$i] = $apostr . $postcode[$i] . $apostr;
		}
	}

	foreach ( $postcode as $key => $value )
	{
		if ( $quote == TRUE )
		{
			if ( strlen( $value ) < 9 ) {
				unset( $postcode[$key] );
			}
		}
		else
		{
			if( strlen( $value ) < 7 )
			{
				unset( $postcode[$key] );
			}
		}
	}

	$postcode = array_values( $postcode );
	echo '<pre>after : ' . print_r( $postcode, TRUE ) . '</pre>' . PHP_EOL . PHP_EOL;
	$postcode = ( $quote == TRUE ? implode( ',', $postcode ) : $postcode[0] );
	return $postcode;
}

/**
* Cleans the input and normalizes.
* Removes non-alphanumeric characters and
* uppercases the result
*
* @param string $postcode Postcode to sanitize
* @return string
*/
function sanitize( $postcode )
{
	return preg_replace( "/[^A-Za-z0-9]/", ' ', strtoupper( $postcode ) );
}

?>
