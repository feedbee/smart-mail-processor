<?php

namespace Feedbee\Smp\Rule;

use Feedbee\Smp\Subject;

class Last extends Rule
{
	/**
	 * @param \Feedbee\Smp\Subject $subject
	 * @return bool|null|void
	 */
	public function apply(Subject $subject)
	{
		parent::apply($subject);

		return true; // stop processing
	}
}