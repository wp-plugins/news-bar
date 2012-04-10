<?php

	// Enable cache
	if ( nb_get_option( 'cache' ) == 'on' ) {
		define( 'MAGPIE_CACHE_ON', 1 ); //2.7 Cache Bug
		define( 'MAGPIE_CACHE_AGE', 900 );
		define( 'MAGPIE_INPUT_ENCODING', 'UTF-8' );
		define( 'MAGPIE_OUTPUT_ENCODING', 'UTF-8' );
	}

	/**
	 * Add hyperlinks to tweets
	 */
	function nb_add_hyperlinks( $text ) {

		// Links target
		$target = ( nb_get_option( 'links-target' ) == 'on' ) ? ' target="_blank"' : '';

		// Props to Allen Shaw & webmancers.com
		// match protocol://address/path/file.extension?some=variable&another=asf%
		$text = preg_replace( '/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i', "<a href=\"$1\" class=\"twitter-link\"$target>$1</a>", $text );
		// match www.something.domain/path/file.extension?some=variable&another=asf%
		$text = preg_replace( '/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i', "<a href=\"http://$1\" class=\"twitter-link\"$target>$1</a>", $text );

		// match name@address
		$text = preg_replace( "/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i", "<a href=\"mailto://$1\" class=\"twitter-link\"$target>$1</a>", $text );
		//mach #trendingtopics. Props to Michael Voigt
		$text = preg_replace( '/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\"$target>#$2</a>$3 ", $text );
		return $text;
	}

	/**
	 * Get tweets by username
	 */
	function nb_get_tweets( $username = 'gn_themes', $limit = 3 ) {

		// Include RSS functions
		include_once( ABSPATH . WPINC . '/rss.php' );

		// Links target
		$target = ( nb_get_option( 'links-target' ) == 'on' ) ? ' target="_blank"' : '';

		// Get tweets
		$messages = fetch_rss( 'http://twitter.com/statuses/user_timeline/' . $username . '.rss' );

		// No tweets
		if ( empty( $messages->items ) ) {
			$return = array( __( 'Messages not found', NB_TEXTDOMAIN ) );
		}

		// Tweets exists
		else {

			// Counter
			$i = 0;

			// Loop through messages
			foreach ( $messages->items as $message ) {

				// Put messages in array
				$return[] = '<a href="http://twitter.com/' . $username . '"' . $target . '>@' . $username . '</a>: ' . nb_add_hyperlinks( substr( strstr( $message['description'], ': ' ), 2, strlen( $message['description'] ) ) );

				// Increase counter
				$i++;

				// Stop the loop
				if ( $i >= $limit )
					break;
			}
		}

		// Return results
		return $return;
	}

	function nb_get_feed( $feed, $limit, $category = false ) {

		// Include RSS functions
		include_once( ABSPATH . WPINC . '/rss.php' );

		// Links target
		$target = ( nb_get_option( 'links-target' ) == 'on' ) ? ' target="_blank"' : '';

		// Correct feed url by category parameter
		$feed = ( $category ) ? home_url( '/?feed=rss2&cat=' . $category ) : $feed;

		// Get messages
		$messages = fetch_rss( $feed );

		// No messages
		if ( empty( $messages->items ) ) {
			$return = array( __( 'Messages not found', NB_TEXTDOMAIN ) );
		}

		// Messages found
		else {

			// Counter
			$i = 0;

			// Loop through messages
			foreach ( $messages->items as $message ) {

				// Put results in array
				$return[] = '<a href="' . $message['link'] . '"' . $target . '>' . $message['title'] . '</a>';

				// Increase counter value
				$i++;

				// Stop the loop
				if ( $i >= $limit )
					break;
			}

			// Return results
			return $return;
		}
	}

?>