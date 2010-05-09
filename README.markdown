php-5gig
========

PHP library for easy access to 5gig's API.

Usage example
-------------

    require 'fivegig.php';
    $fg = new FiveGig($my_api_key);
    try {
    	$artist = $fg->artistGetEvents('Justin Bieber', 'us');
    } catch (Exception $e) {
    	echo $e->getMessage()."\n";
    }
