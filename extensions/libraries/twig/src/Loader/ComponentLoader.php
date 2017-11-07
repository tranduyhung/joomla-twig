<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Loader
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Loader;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

/**
 * Joomla component file system loader.
 *
 * @since  1.0.0
 */
final class ComponentLoader extends ExtensionLoader
{
	/**
	 * Namespace applicable to this extension.
	 *
	 * @var  string
	 */
	protected $extensionNamespace = 'component';

	/**
	 * Get the paths to search for templates.
	 *
	 * @return  array
	 */
	protected function getTemplatePaths()
	{
		$paths = [];

		$tplOverrides = JPATH_THEMES . '/' . Factory::getApplication()->getTemplate() . '/html';

		if (is_dir($tplOverrides))
		{
			$paths[] = $tplOverrides;
		}

		$paths[] = $this->getBaseAppPath() . '/components';

		return $paths;
	}

	/**
	 * Parse a received extension name.
	 *
	 * @param   string  $name  Name of the template to search
	 *
	 * @return  string
	 */
	protected function parseExtensionName($name)
	{
		$nameParts = explode('/', $name);

		if (!isset($nameParts[2]))
		{
			return $name;
		}

		array_splice($nameParts, 2, 1, ['views', $nameParts[2], 'tmpl']);

		return implode('/', $nameParts);
	}
}
