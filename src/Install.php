<?php
/**
 * @brief hScroll, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul and contributors
 *
 * @copyright Franck Paul carnet.franck.paul@gmail.com
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
declare(strict_types=1);

namespace Dotclear\Plugin\hScroll;

use Dotclear\App;
use Dotclear\Core\Process;
use Exception;

class Install extends Process
{
    public static function init(): bool
    {
        return self::status(My::checkContext(My::INSTALL));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        try {
            $old_version = App::version()->getVersion(My::id());

            if (version_compare((string) $old_version, '2.0', '<')) {
                // Rename settings namespace
                if (App::blog()->settings()->exists('hscroll')) {
                    App::blog()->settings()->delWorkspace(My::id());
                    App::blog()->settings()->renWorkspace('hscroll', My::id());
                }
            }
        } catch (Exception $e) {
            App::error()->add($e->getMessage());
        }

        return true;
    }
}
