<?php

namespace microwin7\Configs;

class Path {
    public const ROOT_FOLDER = '/var/www/html/домен/';

    public const DB_LOG_FOLDER = '/var/www/db_logs/';

    public const SITE_TEMPLATES_FOLDER = 'templates/имя_шаблона/';

    public const SKIN_PATCH = self::ROOT_FOLDER . 'minecraft/skins/{LOGIN}.png';
    public const CAPE_PATCH = self::ROOT_FOLDER . 'minecraft/capes/{LOGIN}.png';

    public const ITEM_SHOP_IMAGES =  self::ROOT_FOLDER . '/' . self::SITE_TEMPLATES_FOLDER . 'images/item_shop/';
    public const URL_ITEM_SHOP_IMAGES =  '/' . self::SITE_TEMPLATES_FOLDER . 'images/item_shop/';

    public static function getSkinUrl($username) {
        return str_replace('{LOGIN}', $username, self::SKIN_PATCH);
    }
    public static function getCapeUrl($username) {
        return str_replace('{LOGIN}', $username, self::CAPE_PATCH);
    }
}