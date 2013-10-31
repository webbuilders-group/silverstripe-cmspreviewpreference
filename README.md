CMS Preview Preference
=================
Adds the ability for users to control the default CMS preview mode and size for their login.

## Maintainer Contact
* Ed Chipman ([UndefinedOffset](https://github.com/UndefinedOffset))

## Requirements
* SilverStripe CMS 3.1.x


## Installation
* Download the module from here https://github.com/webbuilders-group/silverstripe-translatablerouting/archive/master.zip
* Extract the downloaded archive into your site root so that the destination folder is called translatablerouting, opening the extracted folder should contain _config.php in the root along with other files/folders
* Run dev/build?flush=all to regenerate the manifest


## Usage
When managing a user or a user views their profile in the CMS they will see the ability to toggle which preview mode is their default preview mode, after changing this the user will be asked to reload the cms to update the setting.

#### Default Preview Mode
The default preview mode is set to "content", you can change this in your config by setting the UserPreviewPreference.DefaultMode setting to one of the following: "content", "split" or "preview".

```yml
UserPreviewPreference:
    DefaultMode: "split"
```
