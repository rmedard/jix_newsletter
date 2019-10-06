<?php


namespace Drupal\jix_newsletter\Plugin\RulesAction;


use Drupal;
use Drupal\Core\Entity\EntityInterface;
use Drupal\rules\Core\RulesActionBase;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class SubscribeUserAction
 * @package Drupal\jix_newsletter\Plugin\RulesAction
 *
 * @RulesAction(
 *     id = "rules_action_unsubscribe_user",
 *     label = @Translation("Unsubscribe User Action"),
 *     category = @Translation("Content"),
 *     context = {
 *      "entity" = @ContextDefinition(
 *          value = "entity",
 *          label = @Translation("Submission object"),
 *          description = @Translation("Submitted data")
 *       )
 *     }
 * )
 */
class UnsubscribeUserAction extends RulesActionBase
{
    protected function doExecute(EntityInterface $entity) {
        $email = $entity->getElementData('gen_news_email');
        $config = Drupal::config('jix_newsletter.general.settings');
        $subscriptionUrl = $config->get('general_newsletter_url');
        try {
            $response = Drupal::httpClient()->delete($subscriptionUrl, array(
                'json' => array(
                    'email' => $email
                )));
            if ($response instanceof ResponseInterface) {
                Drupal::logger('jix_newsletter')->info('Response code: ' . $response->getStatusCode()
                    . ' | Phrase: ' . $response->getBody()->getContents());
            }
        } catch (ClientException $exception) {
            Drupal::logger('jix_newsletter')->error(json_encode($exception));
        }
    }
}