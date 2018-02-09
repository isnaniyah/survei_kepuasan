<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class captchaResources extends CI_Controller {

	public function get($p_FileName = null) {
		if (empty($p_FileName)) return;

		$path = FCPATH . 'application' . DIRECTORY_SEPARATOR. 'libraries' . DIRECTORY_SEPARATOR. 'botdetect' . DIRECTORY_SEPARATOR. 'lib' . DIRECTORY_SEPARATOR . 'botdetect' . DIRECTORY_SEPARATOR .'public' . DIRECTORY_SEPARATOR . $p_FileName;
		$fileInfo  = pathinfo($path);
		$this->output
			    ->set_content_type($fileInfo['extension'])
			    ->set_output(file_get_contents($path));
	}
}
