export default {
    checkUsername(username) {
        return axios.get(
            route('v1.users.check-username', {
                username: username
            })
        );
    },
    checkEmail(email) {
        return axios.get(
            route('v1.users.check-email', {
                email: email
            })
        );
    },
    following(username) {
        return axios.post(route('v1.users.follow.store'), {
            username: username
        });
    }
};
