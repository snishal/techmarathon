<?php

class Form {

	private $form = '';

	function startForm($action, $method, $extraParams = '') {

		if (array_key_exists('fieldset', $extraParams) && $extraParams['fieldset'] == "true") {
			$this->form = $this->form . "<fieldset>";
		}

		if (array_key_exists('legend', $extraParams)) {
			$this->form = $this->form . "<legend>" . $extraParams['legend'] . "</legend>";
		}

		$this->form = $this->form . "<form action='$action' method='$method' ";

		if (is_array($extraParams)) {

			foreach ($extraParams as $key => $value) {
				if ($key != 'header' && $key != 'fieldset') {
					$this->form = $this->form . " $key = '$value' ";
				}

			}
		}

		$this->form = $this->form . ">";

		if (isset($extraParams['header'])) {

			$this->form = $this->form . "<br/>" . $extraParams['header'] . "<br/>";

		}

	}

	function addItem($type = '', $name = '', $extraParams = '') {

		if (array_key_exists('div', $extraParams)) {
			$this->form = $this->form . $extraParams['div'];
		}

		if ($type == "textarea") {
			$this->form = $this->form . "<textarea name='$name'";

			if (is_array($extraParams)) {
				foreach ($extraParams as $key => $value) {
					if ($key != 'value' && $key != 'div' && $key != 'label') {

						$this->form = $this->form . " $key = '$value' ";

					}
				}
			}

			$this->form = $this->form . ">";

			if (isset($extraParams['value'])) {
				$this->form = $this->form . $extraParams['value'];
			}

			$this->form = $this->form . "</textarea><br/>";

		} else {
			$this->form = $this->form . "<input type='$type' name='$name' ";

			if (is_array($extraParams)) {
				foreach ($extraParams as $key => $value) {

					if ($key != 'div' && $key != 'label') {

						$this->form = $this->form . " $key = '$value' ";

					}
				}
			}

			$this->form = $this->form . "/>";
			if (array_key_exists('label', $extraParams) && array_key_exists('id', $extraParams)) {
				$this->form = $this->form . '<label for="' . $extraParams['id'] . '">' . $extraParams['label'] . '</label>';
			}
			$this->form = $this->form . "<br/>";
		}
		if (array_key_exists('div', $extraParams)) {
			$this->form = $this->form . "</div>";
		}

	}

	function endForm($extraParams = '') {
		if (array_key_exists('fieldset', $extraParams) && $extraParams['fieldset'] == "true") {
			$this->form = $this->form . "</fieldset>";
		}
		$this->form = $this->form . "</form>";
	}

	function displayForm() {
		echo $this->form;
	}

}

?>