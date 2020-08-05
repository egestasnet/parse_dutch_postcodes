&& is_numeric( substr( $postcode[$i], 0, 4 ) ) )
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
