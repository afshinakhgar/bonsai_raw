<?php
return [
    // Renderer settings
	'view' => [
	    'blade_template_path' => '../resources/view/', // String or array of multiple paths
	    'blade_cache_path'    => '../resources/view/cache', // Mandatory by default, though could probably turn caching off for development
	    'template'    => 'bonsai', // template name
	    'admin_template'    => 'admin', // template name
	],
];
?>
