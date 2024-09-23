<?php

namespace Drupal\visitor_counter;

use Drupal\Core\Controller\ControllerBase;

class VisitorCounterController extends ControllerBase
{
    public function dailyCount(): array
    {
        $visitor_count = visitor_counter_get_daily_count();
        return [
            '#markup' => $this->t('Today\'s unique visitors: @count', ['@count' => $visitor_count]),
        ];
    }
}
