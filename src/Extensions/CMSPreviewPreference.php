<?php
namespace WebbuildersGroup\CMSPreviewPreference\Extensions;

use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Extension;
use SilverStripe\Security\Security;
use SilverStripe\View\Requirements;

class CMSPreviewPreference extends Extension
{
    public function onAfterInit()
    {
        $mode = Config::inst()->get(UserPreviewPreference::class, 'DefaultMode');
        $userMode = null;
        if (Security::getCurrentUser()) {
            $userMode = Security::getCurrentUser()->DefaultPreviewMode;
        }
        if (!empty($userMode)) {
            $mode = $userMode;
        }


        Requirements::javascriptTemplate(
            'webbuilders-group/silverstripe-cmspreviewpreference: javascript/preview-mode.template.js',
            [
                'PreviewMode' => $mode,
            ],
            'cms-preview-mode'
        );
    }
}
