export default {
    index(category = null) {
        return axios.get(route('v1.posts.list', { category: category }));
    }
};
