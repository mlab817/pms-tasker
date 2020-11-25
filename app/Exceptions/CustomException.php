<?php

namespace App\Exceptions;

use Exception;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;

class CustomException extends Exception implements RendersErrorsExtensions
{
    protected $reason;

	/**
	 * CustomException constructor.
	 *
	 * @param \App\Exceptions\string $message
	 * @param \App\Exceptions\string $reason
	 */
	public function __construct(string $message, string $reason)
    {
	    parent::__construct($message);

	    $this->reason = $reason;
    }

	public function isClientSafe()
	{
		return true;
	}

	public function getCategory()
	{
		return 'custom';
	}

	public function extensionsContent(): array
	{
		return [
			'message' => 'additional information',
			'reason' => $this->reason
		];
	}
}
