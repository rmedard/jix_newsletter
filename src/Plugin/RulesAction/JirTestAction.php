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
 *     id = "rules_action_test_action",
 *     label = @Translation("Rules action test action"),
 *     category = @Translation("Content"),
 *     context = {
 *      "entity" = @ContextDefinition("entity", label = @Translation("Entity"),
 *          description = @Translation("Specifies the entity, which should be saved permanently."))
 *     }
 * )
 */
class JirTestAction extends RulesActionBase
{
    /**
     * @param EntityInterface $entity
     */
    protected function doExecute(EntityInterface $entity) {
        Drupal::logger('jix_newsletter')->info('Action triggered in entity: ' . $entity->id());
    }
}