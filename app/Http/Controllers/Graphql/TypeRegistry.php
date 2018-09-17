<?php

namespace App\Http\Controllers\Graphql;


use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\Type;

class TypeRegistry
{
    private static $account;
    private static $query;

    /**
     * @return QueryType
     * @throws \Exception
     */
    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    public static function account()
    {
        return self::$account ?: (self::$account = new AccountType());
    }

    /**
     * @param $type
     * @return NonNull
     * @throws \Exception
     */
    public static function nonNull($type)
    {
        return new NonNull($type);
    }

    public static function id()
    {
        return Type::id();
    }

    public static function string()
    {
        return Type::string();
    }
}
