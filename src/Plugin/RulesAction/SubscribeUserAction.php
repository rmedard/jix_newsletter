<?php

namespace Drupal\jix_newsletter\Plugin\RulesAction;

use Drupal;
use Drupal\Core\Entity\EntityInterface;
use Drupal\rules\Core\RulesActionBase;

/**
 * Class JirTestAction
 * @package Drupal\jix_newsletter\Plugin\RulesAction
 *
 * @RulesAction(
 *     id = "rules_action_subscribe_user",
 *     label = @Translation("Subscribe User Action"),
 *     category = @Translation("Custom"),
 *     context = {
 *      "entity" = @ContextDefinition(
 *          value = "entity",
 *          label = @Translation("Submission object"),
 *          description = @Translation("Submitted data.")
 *       )
 *     }
 * )
 */
class SubscribeUserAction extends RulesActionBase
{
    /**
     * @param EntityInterface $entity
     */
    protected function doExecute(EntityInterface $entity) {
        Drupal::logger('jix_newsletter')->info('Action triggered, Names: ' . $entity->getElementData('gen_news_noms') . ' | Email: ' . $entity->getElementData('gen_news_email'));
    }
}