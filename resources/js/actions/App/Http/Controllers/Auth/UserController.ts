import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Auth\UserController::index
 * @see app/Http/Controllers/Auth/UserController.php:12
 * @route '/users'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/users',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Auth\UserController::index
 * @see app/Http/Controllers/Auth/UserController.php:12
 * @route '/users'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\UserController::index
 * @see app/Http/Controllers/Auth/UserController.php:12
 * @route '/users'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Auth\UserController::index
 * @see app/Http/Controllers/Auth/UserController.php:12
 * @route '/users'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})
const UserController = { index }

export default UserController