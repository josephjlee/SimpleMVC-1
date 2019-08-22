<?php
namespace Core;

class View {
	public $default_template = null;
	
	public function generate($content_view = null, $data = null, $template_view = null)
	{
		if($template_view === null && $this->default_template != null)
			$template_view = $this->default_template;
		
		if( is_array($data) ) 
			extract($data);
		
		if( file_exists("application/templates/".$template_view.".php") )
			include "application/templates/".$template_view.".php";
		else if( file_exists("application/views/".$content_view.".php") )
			include "application/views/".$content_view.".php";
	}
}
