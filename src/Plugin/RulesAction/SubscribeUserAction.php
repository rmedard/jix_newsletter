<?php

namespace Drupal\jix_newsletter\Plugin\RulesAction;

use Drupal;
use Drupal\rules\Core\RulesActionBase;

/**
 * Class JirTestAction
 * @package Drupal\jix_newsletter\Plugin\RulesAction
 *
 * @RulesAction(
 *     id = "rules_action_subscribe_user",
 *     label = @Translation("Subscribe User Action"),
 *     category = @Translation("Content"),
 *     context = {
 *      "names" = @ContextDefinition(
 *          value = "string",
 *          label = @Translation("Names"),
 *          description = @Translation("Names of the subscriber.")
 *       ),
 *     "email" = @ContextDefinition(
 *          value = "email",
 *          label = @Translation("Email"),
 *          description = @Translation("Email of the subscriber.")
 *       ),
 *     }
 * )
 */
class SubscribeUserAction extends RulesActionBase
{
    /**
     * @param $names string Names of subscriber
     * @param $email string email of subscriber
     */
    protected function doExecute($names, $email) {
        Drupal::logger('jix_newsletter')->info('Action triggered, Names: ' . $names . ' | Email: ' . $email);
    }
}