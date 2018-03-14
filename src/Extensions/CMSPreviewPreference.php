<?php
namespace WebbuildersGroup\CMSPreviewPreference\Extensions;

use SilverStripe\Core\Config\Config;
use SilverStripe\Security\Member;
use SilverStripe\View\Requirements;
use SilverStripe\Core\Extension;

class CMSPreviewPreference extends Extension {
    public function init() {
        $mode=Config::inst()->get('UserPreviewPreference', 'DefaultMode');
        $userMode=Member::currentUser()->DefaultPreviewMode;
        
        if(!empty($userMode)) {
            $mode=$userMode;
        }
        
        
        Requirements::javascriptTemplate('webbuilders-group/silverstripe-cmspreviewpreference: javascript/preview-mode.template.js', array(
                                                                                                                                            'PreviewMode'=>$mode
                                                                                                                                        ), 'cms-preview-mode');
    }
}
?>