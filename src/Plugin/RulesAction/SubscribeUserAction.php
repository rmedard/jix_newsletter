<?php

namespace Drupal\jix_newsletter\Plugin\RulesAction;

use Drupal;
use Drupal\Core\Entity\EntityInterface;
use Drupal\rules\Core\RulesActionBase;

/**
 * Class SubscribeUserAction
 * @package Drupal\jix_newsletter\Plugin\RulesAction
 *
 * @RulesAction(
 *     id = "rules_action_subscribe_user",
 *     label = @Translation("Subscribe User Action"),
 *     category = @Translation("Content"),
 *     context = {
 *      "entity" = @ContextDefinition(
 *          value = "entity",
 *          label = @Translation("Submission object"),
 *          description = @Translation("Submitted data")
 *       ),
 *     "newsletterId" = @ContextDefinition(
 *          value = "integer",
 *          label = @Translation("Newsletter ID"),
 *          description = @Translation("Identifier of the newsletter")
 *       )
 *     }
 * )
 */
class SubscribeUserAction extends RulesActionBase
{
    /**
     * @param EntityInterface $entity
     * @param $newsletterId integer newsletter identifier
     */
    protected function doExecute(EntityInterface $entity, $newsletterId)
    {
        $names = $entity->getElementData('gen_news_noms');
        $email = $entity->getElementData('gen_news_email');
        $config = Drupal::config('jix_newsletter.general.settings');
        $subscriptionUrl = $config->get('general_newsletter_url');
        $request = Drupal::httpClient()->post($subscriptionUrl, array(
            'form_params' => array(
                'email' => $email,
                'name' => $names,
                'newsletterId' => strval($newsletterId)
            )));
        Drupal::logger('jix_newsletter')->info(json_encode($request));
    }
}