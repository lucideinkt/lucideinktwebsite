<?php

namespace App\Services;

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\OrderBy;
use Google\Analytics\Data\V1beta\OrderBy\MetricOrderBy;
use Google\Analytics\Data\V1beta\Filter;
use Google\Analytics\Data\V1beta\Filter\StringFilter;
use Google\Analytics\Data\V1beta\Filter\StringFilter\MatchType;
use Google\Analytics\Data\V1beta\FilterExpression;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class GoogleAnalyticsService
{
    protected BetaAnalyticsDataClient $client;
    protected string $propertyId;

    public function __construct()
    {
        $credentialsPath = base_path(config('services.google.ga4_credentials_path'));
        $this->propertyId = config('services.google.ga4_property_id');

        $this->client = new BetaAnalyticsDataClient([
            'credentials' => $credentialsPath,
        ]);
    }

    /**
     * Get overall summary metrics for a period.
     */
    public function getSummary(string $startDate, string $endDate): array
    {
        $cacheKey = "ga4_summary_{$startDate}_{$endDate}";

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($startDate, $endDate) {
            $response = $this->client->runReport([
                'property' => 'properties/' . $this->propertyId,
                'dateRanges' => [new DateRange(['start_date' => $startDate, 'end_date' => $endDate])],
                'metrics' => [
                    new Metric(['name' => 'sessions']),
                    new Metric(['name' => 'totalUsers']),
                    new Metric(['name' => 'newUsers']),
                    new Metric(['name' => 'screenPageViews']),
                    new Metric(['name' => 'bounceRate']),
                    new Metric(['name' => 'averageSessionDuration']),
                ],
            ]);

            $row = $response->getRows()[0] ?? null;
            if (!$row) {
                return [
                    'sessions' => 0, 'totalUsers' => 0, 'newUsers' => 0,
                    'pageViews' => 0, 'bounceRate' => 0, 'avgDuration' => 0,
                ];
            }

            $vals = $row->getMetricValues();
            return [
                'sessions'   => (int) $vals[0]->getValue(),
                'totalUsers' => (int) $vals[1]->getValue(),
                'newUsers'   => (int) $vals[2]->getValue(),
                'pageViews'  => (int) $vals[3]->getValue(),
                'bounceRate' => round((float) $vals[4]->getValue() * 100, 1),
                'avgDuration'=> (int) $vals[5]->getValue(), // seconds
            ];
        });
    }

    /**
     * Get sessions and page views per day.
     */
    public function getSessionsPerDay(string $startDate, string $endDate): Collection
    {
        $cacheKey = "ga4_sessions_per_day_{$startDate}_{$endDate}";

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($startDate, $endDate) {
            $response = $this->client->runReport([
                'property'   => 'properties/' . $this->propertyId,
                'dateRanges' => [new DateRange(['start_date' => $startDate, 'end_date' => $endDate])],
                'dimensions' => [new Dimension(['name' => 'date'])],
                'metrics'    => [
                    new Metric(['name' => 'sessions']),
                    new Metric(['name' => 'screenPageViews']),
                ],
                'orderBys' => [new OrderBy(['dimension' => new OrderBy\DimensionOrderBy(['dimension_name' => 'date'])])],
            ]);

            return collect($response->getRows())->map(function ($row) {
                $dims = $row->getDimensionValues();
                $vals = $row->getMetricValues();
                $raw  = $dims[0]->getValue(); // YYYYMMDD
                return [
                    'date'      => substr($raw, 0, 4) . '-' . substr($raw, 4, 2) . '-' . substr($raw, 6, 2),
                    'sessions'  => (int) $vals[0]->getValue(),
                    'pageViews' => (int) $vals[1]->getValue(),
                ];
            });
        });
    }

    /**
     * Get top pages by page views.
     */
    public function getTopPages(string $startDate, string $endDate, int $limit = 20): Collection
    {
        $cacheKey = "ga4_top_pages_{$startDate}_{$endDate}_{$limit}";

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($startDate, $endDate, $limit) {
            $response = $this->client->runReport([
                'property'   => 'properties/' . $this->propertyId,
                'dateRanges' => [new DateRange(['start_date' => $startDate, 'end_date' => $endDate])],
                'dimensions' => [
                    new Dimension(['name' => 'pagePath']),
                    new Dimension(['name' => 'pageTitle']),
                ],
                'metrics' => [
                    new Metric(['name' => 'screenPageViews']),
                    new Metric(['name' => 'sessions']),
                ],
                'orderBys' => [new OrderBy([
                    'metric' => new MetricOrderBy(['metric_name' => 'screenPageViews']),
                    'desc'   => true,
                ])],
                'limit' => $limit,
            ]);

            return collect($response->getRows())->map(function ($row) {
                $dims = $row->getDimensionValues();
                $vals = $row->getMetricValues();
                return [
                    'path'      => $dims[0]->getValue(),
                    'title'     => $dims[1]->getValue(),
                    'pageViews' => (int) $vals[0]->getValue(),
                    'sessions'  => (int) $vals[1]->getValue(),
                ];
            });
        });
    }

    /**
     * Get top traffic sources / channels.
     */
    public function getTopSources(string $startDate, string $endDate, int $limit = 15): Collection
    {
        $cacheKey = "ga4_top_sources_{$startDate}_{$endDate}_{$limit}";

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($startDate, $endDate, $limit) {
            $response = $this->client->runReport([
                'property'   => 'properties/' . $this->propertyId,
                'dateRanges' => [new DateRange(['start_date' => $startDate, 'end_date' => $endDate])],
                'dimensions' => [
                    new Dimension(['name' => 'sessionDefaultChannelGroup']),
                ],
                'metrics' => [
                    new Metric(['name' => 'sessions']),
                    new Metric(['name' => 'totalUsers']),
                ],
                'orderBys' => [new OrderBy([
                    'metric' => new MetricOrderBy(['metric_name' => 'sessions']),
                    'desc'   => true,
                ])],
                'limit' => $limit,
            ]);

            return collect($response->getRows())->map(function ($row) {
                $dims = $row->getDimensionValues();
                $vals = $row->getMetricValues();
                return [
                    'channel'  => $dims[0]->getValue(),
                    'sessions' => (int) $vals[0]->getValue(),
                    'users'    => (int) $vals[1]->getValue(),
                ];
            });
        });
    }

    /**
     * Get top countries by sessions.
     */
    public function getTopCountries(string $startDate, string $endDate, int $limit = 15): Collection
    {
        $cacheKey = "ga4_top_countries_{$startDate}_{$endDate}_{$limit}";

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($startDate, $endDate, $limit) {
            $response = $this->client->runReport([
                'property'   => 'properties/' . $this->propertyId,
                'dateRanges' => [new DateRange(['start_date' => $startDate, 'end_date' => $endDate])],
                'dimensions' => [
                    new Dimension(['name' => 'country']),
                    new Dimension(['name' => 'countryId']),
                ],
                'metrics' => [
                    new Metric(['name' => 'sessions']),
                    new Metric(['name' => 'totalUsers']),
                    new Metric(['name' => 'screenPageViews']),
                ],
                'orderBys' => [new OrderBy([
                    'metric' => new MetricOrderBy(['metric_name' => 'sessions']),
                    'desc'   => true,
                ])],
                'limit' => $limit,
            ]);

            return collect($response->getRows())->map(function ($row) {
                $dims = $row->getDimensionValues();
                $vals = $row->getMetricValues();
                return [
                    'country'     => $dims[0]->getValue(),
                    'countryCode' => strtolower($dims[1]->getValue()),
                    'sessions'    => (int) $vals[0]->getValue(),
                    'users'       => (int) $vals[1]->getValue(),
                    'pageViews'   => (int) $vals[2]->getValue(),
                ];
            });
        });
    }

    /**
     * Get top cities by sessions.
     */
    public function getTopCities(string $startDate, string $endDate, int $limit = 10): Collection
    {
        $cacheKey = "ga4_top_cities_{$startDate}_{$endDate}_{$limit}";

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($startDate, $endDate, $limit) {
            $response = $this->client->runReport([
                'property'   => 'properties/' . $this->propertyId,
                'dateRanges' => [new DateRange(['start_date' => $startDate, 'end_date' => $endDate])],
                'dimensions' => [
                    new Dimension(['name' => 'city']),
                    new Dimension(['name' => 'countryId']),
                ],
                'metrics' => [
                    new Metric(['name' => 'sessions']),
                ],
                'orderBys' => [new OrderBy([
                    'metric' => new MetricOrderBy(['metric_name' => 'sessions']),
                    'desc'   => true,
                ])],
                'limit' => $limit,
            ]);

            return collect($response->getRows())->map(function ($row) {
                $dims = $row->getDimensionValues();
                $vals = $row->getMetricValues();
                return [
                    'city'        => $dims[0]->getValue(),
                    'countryCode' => strtolower($dims[1]->getValue()),
                    'sessions'    => (int) $vals[0]->getValue(),
                ];
            });
        });
    }

    /**
     * Get device category breakdown.
     */
    public function getDevices(string $startDate, string $endDate): Collection
    {
        $cacheKey = "ga4_devices_{$startDate}_{$endDate}";

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($startDate, $endDate) {
            $response = $this->client->runReport([
                'property'   => 'properties/' . $this->propertyId,
                'dateRanges' => [new DateRange(['start_date' => $startDate, 'end_date' => $endDate])],
                'dimensions' => [new Dimension(['name' => 'deviceCategory'])],
                'metrics'    => [new Metric(['name' => 'sessions'])],
                'orderBys'   => [new OrderBy([
                    'metric' => new MetricOrderBy(['metric_name' => 'sessions']),
                    'desc'   => true,
                ])],
            ]);

            return collect($response->getRows())->map(function ($row) {
                return [
                    'device'   => $row->getDimensionValues()[0]->getValue(),
                    'sessions' => (int) $row->getMetricValues()[0]->getValue(),
                ];
            });
        });
    }

    /**
     * Get sessions by hour of day (aggregated for the period).
     */
    public function getHourlyData(string $startDate, string $endDate): Collection
    {
        $cacheKey = "ga4_hourly_{$startDate}_{$endDate}";

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($startDate, $endDate) {
            $response = $this->client->runReport([
                'property'   => 'properties/' . $this->propertyId,
                'dateRanges' => [new DateRange(['start_date' => $startDate, 'end_date' => $endDate])],
                'dimensions' => [new Dimension(['name' => 'hour'])],
                'metrics'    => [new Metric(['name' => 'sessions'])],
                'orderBys'   => [new OrderBy(['dimension' => new OrderBy\DimensionOrderBy(['dimension_name' => 'hour'])])],
            ]);

            $map = collect($response->getRows())->mapWithKeys(function ($row) {
                return [(int) $row->getDimensionValues()[0]->getValue() => (int) $row->getMetricValues()[0]->getValue()];
            });

            return collect(range(0, 23))->map(fn($h) => [
                'hour'     => $h,
                'sessions' => $map->get($h, 0),
            ]);
        });
    }

    /**
     * Convert a "period in days" to GA4 date strings.
     */
    public static function periodToDates(int $days): array
    {
        return [
            'startDate' => now()->subDays($days)->format('Y-m-d'),
            'endDate'   => 'today',
        ];
    }
}

