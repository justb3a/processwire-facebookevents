<?php namespace ProcessWire;

/**
 * Class FacebookEventsConfig
 */
class FacebookEventsConfig extends ModuleConfig {

  /**
   * array Default config values
   */
  public function getDefaults() {
    return array(
      'clientId' => '',
      'clientSecret' => '',
      'pageId' => '',
      'pageName' => '',
      'cacheExpire' => 'daily',
      'accessToken' => ''
    );
  }

  /**
   * Retrieves the list of config input fields
   * Implementation of the ConfigurableModule interface
   *
   * @return InputfieldWrapper
   */
  public function getInputfields() {
    // get submitted data
    $cacheExpire = isset($this->data['cacheExpire']) ? $this->data['cacheExpire'] : 'daily';

    $inputfields = parent::getInputfields();

    // field app ID
    $field = $this->modules->get('InputfieldText');
    $field->name = 'clientId';
    $field->label = __('Facebook App ID');
    $field->columnWidth = 50;
    $field->required = 1;
    $inputfields->add($field);

    // field app secret
    $field = $this->modules->get('InputfieldText');
    $field->name = 'clientSecret';
    $field->label = __('Facebook App Secret');
    $field->columnWidth = 50;
    $field->required = 1;
    $inputfields->add($field);

    // field page Name
    $field = $this->modules->get('InputfieldText');
    $field->name = 'pageName';
    $field->label = __('Facebook Page Name');
    $field->description = __('You can either enter the facebook page name or ID.');
    $field->notes = __('https://www.facebook.com/XXX/');
    $field->required = 1;
    $field->columnWidth = 50;
    $inputfields->add($field);

    // field page ID
    $field = $this->modules->get('InputfieldText');
    $field->name = 'pageId';
    $field->label = __('Facebook Page ID');
    $field->columnWidth = 50;
    $field->collapsed = Inputfield::collapsedNoLocked;
    $inputfields->add($field);

    // Fb Access Token
    $field = $this->modules->get('InputfieldText');
    $field->name = 'accessToken';
    $field->label = __('Facebook Access Token');
    $field->columnWidth = 50;
    $field->collapsed = Inputfield::collapsedHidden;
    $inputfields->add($field);

    // field cache ID
    $field = $this->modules->get('InputfieldSelect');
    $field->label = 'Cache expires';
    $field->description = __('By default a cache lasts for one day. You could select another lifetime.');
    $field->attr('name', 'cacheExpire');
    $field->attr('value', $cacheExpire);
    $field->columnWidth = 100;
    $field->required = 1;
    $lifetimes = array('never', 'save', 'now', 'hourly', 'daily', 'weekly', 'monthly');
    foreach($lifetimes as $lifetime) {
      $field->addOption($lifetime, $lifetime);
    }
    $inputfields->add($field);

    return $inputfields;
  }

}
