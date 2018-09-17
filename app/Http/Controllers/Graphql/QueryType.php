<?php

namespace App\Http\Controllers\Graphql;

use App\Account;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class QueryType extends ObjectType
{
    /**
     * QueryType constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $config = [
            'name' => 'Query',
            'description' => 'Graphql query',
            'fields' => [
                'account' => [
                    'type' => TypeRegistry::account(),
                    'description' => 'Returns account by accountId',
                    'args' => [
                        'accountId' => TypeRegistry::nonNull(TypeRegistry::string())
                    ]
                ]
            ],
            'resolveField' => function($val, $args, $context, ResolveInfo $info) {
                return $this->{$info->fieldName}($val, $args, $context, $info);
            }
        ];
        parent::__construct($config);
    }

    public function account($rootValue, $args, $context, ResolveInfo $info)
    {
        return Account::find($args['accountId']);
    }
}
