<?php

namespace Drupal\routing;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoutingController extends ControllerBase
{
    public function loadMoreArticles($term_id, $offset): JsonResponse
    {
        $articles = $this->getRecentArticles($term_id, $offset);
        return new JsonResponse(['articles' => $articles]);
    }

    private function getRecentArticles($term_id, $offset = 0): array
    {
        $query = \Drupal::entityQuery('node')
            ->condition('type', 'article')
            ->condition('status', 1)
            ->condition('field_category.target_id', $term_id)
            ->sort('created', 'DESC')
            ->range($offset, 2)
            ->accessCheck(FALSE);

        $article_ids = $query->execute();

        if (!empty($article_ids)) {
            $articles = Node::loadMultiple($article_ids);
            return $this->mapArticles($articles);
        }

        return [];
    }

    private function mapArticles(array $articles): array
    {
        $mapped_articles = [];

        foreach ($articles as $article) {
            $mapped_articles[] = [
                'title' => $article->label(),
                'url' => \Drupal::service('path_alias.manager')->getAliasByPath('/node/' . $article->id()),
                'image' => $this->getFieldImage($article->get('field_image')->entity),
                'body' => $this->getBody($article->get('body')->value),
            ];
        }

        return $mapped_articles;
    }

    private function getFieldImage($media): string
    {
        if ($media && $media->hasField('field_media_image')) {
            $image = $media->get('field_media_image')->entity;
            if ($image && $image->hasField('uri')) {
                return \Drupal::service('file_url_generator')->generateAbsoluteString($image->get('uri')->value);
            }
        }
        return '';
    }

    private function getBody(string $body): string
    {
        return mb_strimwidth($body, 0, 200, '...');
    }
}
