<?php

namespace App\Http\Controllers\Graphql;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use Throwable;

class GraphqlController extends Controller
{
    /**
     * @param Request $request
     * @return array|\GraphQL\Executor\ExecutionResult
     * @throws \Exception
     */
    public function graphql(Request $request)
    {

        $schema = new Schema([
            'query' => TypeRegistry::query()
        ]);

        $query = $request->get('query');
        $variables = $request->get('variables');

        try {
            return GraphQL::executeQuery($schema, $query, null, null, $variables);
        } catch (Throwable $e) {
            return [
                'errors' => [
                    [
                        'message' => $e->getMessage()
                    ]
                ]
            ];
        }
    }
}
