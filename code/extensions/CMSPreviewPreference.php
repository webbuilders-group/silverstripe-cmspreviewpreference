<?php
class CMSPreviewPreference extends Extension {
    public function init() {
        $mode=Config::inst()->get('UserPreviewPreference', 'DefaultMode');
        $userMode=Member::currentUser()->DefaultPreviewMode;
        
        if(!empty($userMode)) {
            $mode=$userMode;
        }
        
        
        Requirements::javascriptTemplate(CMSPREVIEWPREFERENCE_BASE.'/javascript/preview-mode.template.js', array(
                                                                                                                'PreviewMode'=>$mode
                                                                                                            ), 'cms-preview-mode');
    }
}
?>