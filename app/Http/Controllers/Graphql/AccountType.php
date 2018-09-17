<?php

namespace App\Http\Controllers\Graphql;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class AccountType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Account',
            'description' => 'Jobjet account',
            'fields' => [
                'accountId' => Type::string(),
                'name' => Type::string(),
            ],

            'resolveField' => function($value, $args, $context, ResolveInfo $info) {
                $method = 'resolve' . ucfirst($info->fieldName);
                if (method_exists($this, $method)) {
                    return $this->{$method}($value, $args, $context, $info);
                } else {
                    return $value->{$info->fieldName};
                }
            }
        ];
        parent::__construct($config);
    }
}
