CMS Preview Preference
=================
Adds the ability for users to control the default CMS preview mode and size for their login.

## Maintainer Contact
* Ed Chipman ([UndefinedOffset](https://github.com/UndefinedOffset))

## Requirements
* SilverStripe CMS 4.0+


## Installation
```
composer require webbuilders-group/silverstripe-cmspreviewpreference
```


## Usage
When managing a user or a user views their profile in the CMS they will see the ability to toggle which preview mode is their default preview mode, after changing this the user will be asked to reload the cms to update the setting.

#### Default Preview Mode
The default preview mode is set to "content", you can change this in your config by setting the UserPreviewPreference.DefaultMode setting to one of the following: "content", "split" or "preview".

```yml
WebbuildersGroup\CMSPreviewPreference\Extensions\UserPreviewPreference:
    DefaultMode: "split"
```
