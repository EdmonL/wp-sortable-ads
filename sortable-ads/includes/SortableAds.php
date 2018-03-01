<?php
final class SortableAds {
    CONST AD_TAGS = [
        'Banner' => [
            'names' => ['Sortable_Banner1', 'Sortable_Banner2'],
            'size' => [468, 60],
            'responsive_sizes' => [[300, 250]]
        ],
        'Billboard' => [
            'names' => ['Sortable_Billboard1', 'Sortable_Billboard2'],
            'size' => [970, 250],
            'responsive_sizes' => [[300, 250]]
        ],
        'Button' => [
            'names' => ['Sortable_Button'],
            'size' => [125, 125]
        ],
        'Half Page' => [
            'names' => ['Sortable_Halfpage1', 'Sortable_Halfpage2'],
            'size' => [300, 600]
        ],
        'Large Rectangle' => [
            'names' => ['Sortable_LargeRec'],
            'size' => [336, 280]
        ],
        'Leaderboard' => [
            'names' => ['Sortable_Leaderboard1', 'Sortable_Leaderboard2'],
            'size' => [728, 90],
            'responsive_sizes' => [[300, 250]]
        ],
        'Medium Rectangle' => [
            'names' => ['Sortable_MedRec1', 'Sortable_MedRec2'],
            'size' => [300, 250]
        ],
        'Mobile Banner' => [
            'names' => ['Sortable_MobileBanner'],
            'size' => [300, 50]
        ],
        'Mobile Custom Rectangle' => [
            'names' => ['Sortable_MobileCustomRec'],
            'size' => [320, 100]
        ],
        'Sky' => [
            'names' => ['Sortable_Sky'],
            'size' => [120, 600]
        ],
        'Skyscraper' => [
            'names' => ['Sortable_Skyscraper1', 'Sortable_Skyscraper2'],
            'size' => [160, 600]
        ],
        'SuperLeader' => [
            'names' => ['Sortable_SuperLeader'],
            'size' => [970, 90],
            'responsive_sizes' => [[300, 250]]
        ],
        'Wide Mobile Banner' => [
            'names' => ['Sortable_WideMobileBanner1', 'Sortable_WideMobileBanner2'],
            'size' => [320, 50]
        ]
    ];

    private static $adTagGroups;
    private static $adTagList;

    public static function groupedAdTags() {
        if (empty(self::$adTagGroups)) {
            $adTags = [];
            foreach (self::AD_TAGS as $format => $tags) {
                $adTags[self::adTagGroup($format, $tags)] = $tags['names'];
            }
            self::$adTagGroups = $adTags;
        }
        return self::$adTagGroups;
    }

    public static function adTagList() {
        if (empty(self::$adTagList)) {
            $adTags = [];
            foreach (SortableAds::AD_TAGS as $format => $tags) {
                $size = SortableAds::formatSize($tags['size']);
                $responsive = !empty($tags['responsive_sizes']);
                foreach ($tags['names'] as $name) {
                    $adTags[$name] = [
                        'size' => $size,
                        'responsive' => $responsive
                    ];
                }
            }
            self::$adTagList = $adTags;
        }
        return self::$adTagList;
    }

    private static function adTagGroup($format, array $formatData) {
        $responsive = (empty($formatData['responsive_sizes'])
            ? ''
            : ', ' . SortableAds::formatSizes($formatData['responsive_sizes']));
        return "$format - " . SortableAds::formatSize($formatData['size']) . $responsive;
    }

    private static function formatSize(array $size) {
        return "$size[0]x$size[1]";
    }

    private static function formatSizes(array $sizes) {
        return join(', ', array_map([__CLASS__, 'formatSize'], $sizes));
    }
}
