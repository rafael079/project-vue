import { usePage } from '@inertiajs/vue3';

export default function useAuth() {
    const checkAuth = (emitter = null) => {
        const auth = usePage().props.auth.user;

        if (!auth) {
            if (emitter) {
                emitter.emit('openLoginForm');
            }
            return false;
        }
        return true;
    };

    return { checkAuth };
}
