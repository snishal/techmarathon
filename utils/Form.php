<?php

class Form {

	private $form = '';

	function startForm($action, $method, $extraParams = '') {

		$this->form = $this->form . "<form action='$action' method='$method' ";

		if (is_array($extraParams)) {
			foreach ($extraParams as $key => $value) {
				if ($key != 'header') {
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
		if ($type == "textarea") {
			$this->form = $this->form . "<textarea name='$name'";

			if (is_array($extraParams)) {
				foreach ($extraParams as $key => $value) {
					if ($key != 'value') {

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

					$this->form = $this->form . " $key = '$value' ";

				}
			}

			$this->form = $this->form . "/><br/>";
		}
	}

	function endForm() {
		$this->form = $this->form . "</form>";
	}

	function displayForm() {
		echo $this->form;
	}

}

?>