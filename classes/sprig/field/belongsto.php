<?php defined('SYSPATH') or die('No direct script access.');

class Sprig_Field_BelongsTo extends Sprig_Field_ForeignKey {

	public $in_db = TRUE;

	public function input($name, $value, array $attr = NULL)
	{
		$model = Sprig::factory($this->model);

		$choices = $model->select_list($model->pk());

		if ($this->empty)
		{
			Arr::unshift($choices, '', '-- '.__('None'));
		}

		return Form::select($name, $choices, $this->verbose($value), $attr);
	}

	/**
	 * Get and optionally set the public $this->column property, based on
	 * $field_name.  Provided as a method, so that the behavior can be
	 * easily overridden.
	 *
	 * @param string $field_name
	 *
	 * @return string
	 */
	protected function column($field_name = null)
	{
		if (null !== $field_name)
		{
			if (isset($this->foreign_key) AND $this->foreign_key)
			{
				$fk = $this->foreign_key;
			}
			else
			{
				$fk = Sprig::factory($this->model)->fk();
			}

			$this->column = $fk;
		}
		return $this->column;
	}

} // End Sprig_Field_BelongsTo
