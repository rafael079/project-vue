export default {
    index() {
        return axios.get(route('v1.posts.list'));
    }
};
