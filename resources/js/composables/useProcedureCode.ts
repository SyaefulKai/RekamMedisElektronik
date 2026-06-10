import { RouteDefinition } from "@/wayfinder";
import { router } from "@inertiajs/vue3"
import { useDebounceFn } from "@vueuse/core"

export function useProcedureCode() {
    const debouncedSearch = useDebounceFn(
        (route: RouteDefinition<'get'>, query: Record<string, any>) => {
            router.get(route.url, {
                filter: query
            }, {
                preserveState: true,
                preserveScroll: true,
            })
        },
        500
    )

    /**
 * Search the procedure code through server side search
 * @param query search query
 */
    function search(route: RouteDefinition<'get'>, query: Record<string, any>) {
        debouncedSearch(route, query)
    }

    return {
        search
    }
}
