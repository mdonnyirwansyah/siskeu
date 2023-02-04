<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {

    public $vars = [
    	'header'    	   => 'admin/templates/header',
        'navbar'   		   => 'admin/templates/navbar',
        'sidebar'   	   => 'admin/templates/sidebar',
        'footer'   	   	   => 'admin/templates/footer',
        'script_general'   => 'admin/templates/script-general',
        'copyright' 	   => 'Copyright &copy; 2021 <div class="bullet"></div> Built By <a href="https://www.instagram.com/m.dony_irwansyah" target="_blank">M. Donny Irwansyah</a>',
        'versi'			   => '1.0'
    ];

}

/* End of file Admin_Controller.php */
