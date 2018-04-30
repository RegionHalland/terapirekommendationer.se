<?php

namespace RegionHalland\Theme;

class OwfRedirect
{
    public function __construct()
    {
		// Redirect to correct OWF diff function
		if ( isset($_GET['page']) && $_GET['page'] === 'oasiswf-revision') {
			$postID = $_GET['revision'];
			$url = get_admin_url() . 'admin.php?page=test-plugin&post=' . $postID;
			wp_redirect($url);
			exit;
		}
    }
}
