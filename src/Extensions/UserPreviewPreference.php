<?php
namespace WebbuildersGroup\CMSPreviewPreference\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Control\Controller;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Control\Session;
use SilverStripe\View\Requirements;
use SilverStripe\ORM\DataExtension;

class UserPreviewPreference extends DataExtension
{
    private static $db = [
        'DefaultPreviewMode' => "Enum(array('content', 'split', 'preview'), 'content')",
    ];

    private static $defaults = [
        'DefaultPreviewMode' => 'content',
    ];

    private $isSaving = false;


    /**
     * Updates the fields used in the cms
     * @param {FieldList} $fields Fields to be extended
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab(
            'Root.Main',
            $field = new OptionsetField(
                'DefaultPreviewMode',
                _t(__CLASS__ . '.DEFAULT_MODE', '_Default Preview Mode'),
                [
                    'content' => _t(__CLASS__ . '.CONTENT_MODE', '_Content Mode: Only menu and content areas are shown'),
                    'split' => _t(__CLASS__ . '.SPLIT_MODE', '_Split Mode: Side by Side editing and previewing'),
                    'preview' => _t(__CLASS__ . '.PREVIEW_MODE', '_Preview Mode: Only menu and preview areas are shown'),
                ],
                Config::inst()->get(UserPreviewPreference::class, 'DefaultMode')
            )
        );

        if (Controller::curr()->getRequest()->getSession()->get('ShowPreviewSettingChangeReload') == true) {
            $field->setMessage(_t(__CLASS__ . '.CHANGE_REFRESH', '_You have updated your preview preference, you must refresh your browser to see the updated setting'), 'warning');
            Requirements::javascript('webbuilders-group/silverstripe-cmspreviewpreference: javascript/clear-local-preference.js');

            if ($this->isSaving == false) {
                Controller::curr()->getRequest()->getSession()->clear('ShowPreviewSettingChangeReload');
            }
        }
    }

    /**
     * Ensures config defaults are enforced on write
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        if (empty($this->owner->DefaultPreviewMode)) {
            $this->owner->DefaultPreviewMode = Config::inst()->get(UserPreviewPreference::class, 'DefaultMode');
        }

        //If changed ensure their is a session message
        if ($this->owner->isChanged('DefaultPreviewMode')) {
            Controller::curr()->getRequest()->getSession()->set('ShowPreviewSettingChangeReload', true);
            $this->isSaving = true;
        }
    }
}
