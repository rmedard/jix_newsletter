<?php


namespace Drupal\jix_newsletter\Form;


use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class NewsletterSettingsForm extends ConfigFormBase
{

    const SETTINGS = 'jix_newsletter.general.settings';

    /**
     * Gets the configuration names that will be editable.
     *
     * @return array
     *   An array of configuration object names that are editable if called in
     *   conjunction with the trait's config() method.
     */
    protected function getEditableConfigNames()
    {
        return [static::SETTINGS];
    }

    /**
     * Returns a unique string identifying the form.
     *
     * The returned ID should be a unique string that can be a valid PHP function
     * name, since it's used in hook implementation names such as
     * hook_form_FORM_ID_alter().
     *
     * @return string
     *   The unique string identifying the form.
     */
    public function getFormId()
    {
        return 'jix_newsletter_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state){
        $config = $this->config(static::SETTINGS);
        $form['general_newsletter_url'] = [
            '#type' => 'textfield',
            '#title' => t('General newsletter subscription url'),
            '#default_value' => $config->get('general_newsletter_url'),
            '#description' =>t('Enter a valid and absolute URL. No query parameters.')
        ];
        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        $url = $form_state->getValue('general_newsletter_url');
        if (isset($url) and !UrlHelper::isValid($url, true)){
            $form_state->setErrorByName('general_newsletter_url', 'Invalid URL. This url has to be valid and absolute.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state){
        $this->configFactory->getEditable(static::SETTINGS)
            ->set('general_newsletter_url', $form_state->getValue('general_newsletter_url'))
            ->save();
        parent::submitForm($form, $form_state);
    }
}