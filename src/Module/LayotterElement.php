<?php

namespace Sloth\Module;

class LayotterElement extends \Layotter_Element {
	public static $module;

	public function attributes() {
		$class_name  = get_class( $this );
		$module_name = $class_name::$module;
		$module      = new $module_name;

		$layotter_data     = $module->get_layotter_attributes();
		$this->field_group = $layotter_data['field_group'];
		$this->title       = $layotter_data['title'];
		$this->description = $layotter_data['description'];
		$this->icon        = $layotter_data['icon'];
	}

	public function frontend_view( $fields ) {

		$options = func_get_args();

		$fields['_layotter.passed'] = [
			'class' => $options[1],
			'col_options' => $options[2],
			'row_options' => $options[3],
			'post_options' => $options[4]
		];


		$class_name  = get_class( $this );
		$module_name = $class_name::$module;
		$module      = new $module_name;
		$module->set( $fields );
		if ( ! is_admin() ) {
			$module->render();
		}
	}

	public function backend_view( $fields ) {
		echo '<h1><i class="fa fa-' . $this->icon . '"></i> ' . $this->title . ' </h1>';
		echo '<p>' . $this->description . ' </p>';
	}
}