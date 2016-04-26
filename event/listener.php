<?php

/**
*
* Remove attachment extension extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace rmcgirr83\removeextension\event;

/**
* Event listener
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.parse_attachments_modify_template_data'	=> 'parse_attachments_modify_template_data',
		);
	}

	public function parse_attachments_modify_template_data($event)
	{
		$attachment = $event['attachment'];
		$block_array = $event['block_array'];

		$pieces = explode('.', $attachment['real_filename']);
		$new_real_filename = $pieces[0];

		$block_array['DOWNLOAD_NAME'] = $new_real_filename;
		$event['block_array'] = $block_array;
	}
}
